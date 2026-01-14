<?php
require_once("DB_connect.php");
require_once("functions.php");
$page = "main";
$PageInfo = get_Page($page);
//print_r($PageInfo);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="/style_index.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<title>НКО "Развитие СПО и ЦТ"</title>
</head>
<body>
<!-- Подключите библиотеку Font Awesome -->
<script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>

<?php include(__DIR__ . "/header.inc"); ?>
<?php include(__DIR__ . "/nav.inc"); ?>

<div class="content">
  <h2>Форма регистрации</h2>
  <form action="register.php" method="POST">
    <div class="form-group">
      <label for="username">Имя пользователя:</label>
      <input type="text" id="username" name="username" required>
    </div>
    <div class="form-group">
      <label for="email">Электронная почта:</label>
      <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
      <label for="password">Пароль:</label>
      <input type="password" id="password" name="password" required>
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
  hamburger.addEventListener('click', () => {
    navMenu.classList.toggle('active');
    console.log('Класс active применён:', navMenu.classList.contains('active'));
    console.log('Элемент hamburger:', hamburger);
    console.log('Элемент navMenu (ul):', navMenu);
  });

  // Закрытие меню при клике в любом месте страницы
  document.addEventListener('click', (event) => {
    // Проверяем, что клик был не на меню и не на кнопке "гамбургер"
    if (!navMenu.contains(event.target) && !hamburger.contains(event.target)) {
      navMenu.classList.remove('active');
      console.log('Класс active удалён: меню закрыто');
    }
  });
});
</script>

</body>
</html>
