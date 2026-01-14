<?php
session_start();
require_once("DB_connect.php");

// Инициализация сообщения об ошибке
$error_message = '';

// Проверка, отправлена ли форма
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $password = htmlspecialchars(trim($_POST['password'] ?? ''));

    // Проверка заполненности полей
    if (!empty($username) && !empty($password)) {
        try {
            // Запрос для проверки логина
            $query = "SELECT user_id, password FROM users WHERE username = :username";
            $stmt = $link->prepare($query);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Авторизация успешна
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $username;

                // Перенаправление на страницу admin.php
                header('Location: admin.php');
                exit();
            } else {
                $error_message = 'Неправильный логин или пароль.';
            }
        } catch (PDOException $e) {
            $error_message = "Ошибка базы данных: " . htmlspecialchars($e->getMessage());
        }
    } else {
        $error_message = 'Пожалуйста, заполните все поля.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/style.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<title>Вход</title>
</head>
<body>
<?php include(__DIR__ . "/header.inc"); ?>

<div class="content">
<?php include(__DIR__ . "/nav.inc"); ?>

<h2>Вход</h2>
<?php if (!empty($error_message)): ?>
    <p style="color: red;"><?= htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>
<form method="POST" action="login.php">
    <div class="form-group">
        <label for="username">Логин:</label><br>
        <input type="text" id="username" name="username" required><br><br>
    </div>
    <div class="form-group">
        <label for="password">Пароль:</label><br>
        <input type="password" id="password" name="password" required><br><br>
    </div>
    <button type="submit" class="submit-btn">Войти</button>
</form>
<p>
    <a href="forgot_password.php" style="text-decoration: none; color: #007BFF;">Забыли пароль?</a>
</p>

<h2>Регистрация</h2>
<form action="register.php" method="POST">
    <div class="form-group">
        <label for="reg-username">Имя пользователя:</label><br>
        <input type="text" id="reg-username" name="username" required><br><br>
    </div>
    <div class="form-group">
        <label for="reg-email">Электронная почта:</label><br>
        <input type="email" id="reg-email" name="email" required><br><br>
    </div>
    <div class="form-group">
        <label for="reg-password">Пароль:</label><br>
        <input type="password" id="reg-password" name="password" required><br><br>
    </div>
    <button type="submit" class="submit-btn">Зарегистрироваться</button>
</form>

</div>

<div class="footer">
<?php include(__DIR__ . "/footer.inc"); ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const hamburger = document.querySelector('.hamburger');
  const navMenu = document.querySelector('.nav ul');

  // Открытие/закрытие меню при клике на иконку "гамбургер"
  hamburger.addEventListener('click', (event) => {
    event.stopPropagation(); // Предотвращает распространение клика
    navMenu.classList.toggle('active'); // Переключает видимость меню
    console.log('Класс active применён:', navMenu.classList.contains('active'));
  });

  // Закрытие меню при клике вне области меню
  document.addEventListener('click', (event) => {
    if (!navMenu.contains(event.target) && !hamburger.contains(event.target)) {
      navMenu.classList.remove('active');
      console.log('Класс active удалён: меню закрыто');
    }
  });
});
</script>

</body>
</html>
