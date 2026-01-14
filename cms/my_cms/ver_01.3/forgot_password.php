<?php
require_once("DB_connect.php");

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);

    if (!empty($email)) {
        try {
            // Проверка, существует ли email в базе данных
            $query = "SELECT user_id FROM users WHERE email = :email";
            $stmt = $link->prepare($query);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Генерация кода подтверждения
                $verificationCode = bin2hex(random_bytes(16));
                $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));

                // Сохранение кода в базе данных
                $query = "UPDATE users SET verification_code = :verificationCode, expires_at = :expiresAt WHERE email = :email";
                $stmt = $link->prepare($query);
                $stmt->bindParam(':verificationCode', $verificationCode, PDO::PARAM_STR);
                $stmt->bindParam(':expiresAt', $expiresAt, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();

                // Отправка письма
                if (sendVerificationCode($email, $verificationCode)) {
                    $message = "Код подтверждения отправлен на вашу электронную почту.";
                } else {
                    $message = "Ошибка при отправке письма. Попробуйте позже.";
                }
            } else {
                $message = "Электронная почта не найдена.";
            }
        } catch (PDOException $e) {
            $message = "Ошибка базы данных: " . htmlspecialchars($e->getMessage());
        }
    } else {
        $message = "Пожалуйста, введите ваш email.";
    }
}

// Функция для отправки кода подтверждения на email
function sendVerificationCode($email, $verificationCode) {
    $subject = "Восстановление пароля";
    $resetLink = "https://yourwebsite.com/reset_password.php?email=" . urlencode($email);
    $message = "Здравствуйте,\n\n"
             . "Вы запросили восстановление пароля.\n"
             . "Ваш код подтверждения: $verificationCode\n"
             . "Перейдите по ссылке для сброса пароля: $resetLink\n\n"
             . "Срок действия кода: 1 час.\n\n"
             . "Если вы не запрашивали восстановление, просто проигнорируйте это письмо.\n\n"
             . "С уважением,\nКоманда поддержки.";

    $headers = "From: no-reply@yourwebsite.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Отправка письма
    return mail($email, $subject, $message, $headers);
}

?>

<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Запрос восстановления пароля</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<div class="content">
    <h1>Восстановление пароля</h1>
    <?php if (!empty($message)): ?>
        <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    <form method="POST" action="forgot_password.php">
        <label for="email">Введите вашу электронную почту:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <button type="submit" class="submit-btn">Отправить код подтверждения</button>
    </form>
    <br>
    После отправки запроса на получение кода подтверждения, откройте вашу электронную почту и перейдите по ссылке для восстановления пароля.
</div>
</body>
</html>
