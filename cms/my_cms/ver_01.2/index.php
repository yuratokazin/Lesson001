<?php
require_once("DB_connect.php");
require_once("functions.php");
$page = "index";
$PageInfo = get_Page($page);
//print_r($PageInfo);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/style_index.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<title><?=$PageInfo['page_title']?></title>
<meta name="description" content="<?=$PageInfo['page_description']?>">
<meta name="keywords" content="<?=$PageInfo['page_keywords']?>">
</head>
<body>
<?php include(__DIR__ . "/header.inc"); ?>

<div class="content">
<?php include(__DIR__ . "/nav.inc"); ?>

<p><?=$PageInfo['page_content']?></p>

<h2>Заполните форму регистрации</h2>
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
