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
<link rel="stylesheet" type="text/css" href="/style_index.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<title><?=$PageInfo['page_title']?></title>
<meta name="description" content="<?=$PageInfo[
'page_description']?>">
<meta name="keywords"
content="<?=$PageInfo['page_keywords']?>">
</head>
<body>
<?php include(__DIR__ . "/header.inc"); ?>
<?php include(__DIR__ . "/nav.inc"); ?>
<div class="content">
<p><?=$PageInfo['page_content']?></p>
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
