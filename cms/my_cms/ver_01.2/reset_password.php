<?php
require_once("DB_connect.php");

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $new_password = htmlspecialchars(trim($_POST['new_password'] ?? ''));
    $entered_code = htmlspecialchars(trim($_POST['verification_code'] ?? ''));

    if (!empty($email) && !empty($new_password) && !empty($entered_code)) {
        try {
            // Проверка, существует ли пользователь с указанным email и кодом подтверждения
            $query = "SELECT user_id, verification_code, expires_at FROM users WHERE email = :email";
            $stmt = $link->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && $user['verification_code'] === $entered_code && strtotime($user['expires_at']) > time()) {
                // Хэширование нового пароля
                $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

                // Обновление пароля и удаление кода подтверждения
                $query = "UPDATE users SET password = :password, verification_code = NULL, expires_at = NULL WHERE user_id = :user_id";
                $stmt = $link->prepare($query);
                $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
                $stmt->bindParam(':user_id', $user['user_id'], PDO::PARAM_INT);
                $stmt->execute();

                // Перенаправление на страницу входа в аккурант
                header("Location: /login.php");
                exit();
            } else {
                $message = "Код подтверждения неверный или срок его действия истёк. Попробуйте снова.";
            }
        } catch (PDOException $e) {
            $message = "Ошибка базы данных: " . htmlspecialchars($e->getMessage());
        }
    } else {
        $message = "Пожалуйста, заполните все поля.";
    }
}
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Сброс пароля</title>
    <link rel="stylesheet" href="/style_index.css">
</head>
<body>
<div class="content">
    <h1>Сброс пароля</h1>
    <?php if (!empty($message)): ?>
        <p style="color: red;"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    <form method="POST" action="reset_password.php">
        <label for="email">Электронная почта:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="verification_code">Код подтверждения:</label><br>
        <input type="text" id="verification_code" name="verification_code" required><br><br>

        <label for="new_password">Новый пароль:</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>

        <button type="submit" class="submit-btn">Обновить пароль</button>
    </form>
</div>
</body>
</html>
