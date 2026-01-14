<?php
require_once("DB_connect.php");
require_once("functions.php");
$page = "permit";
$PageInfo = get_Page($page);
$PhotoInfo = get_Photo();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/style.css">
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

<h2>Галерея</h2>
<table align="center">
    <?php if (!empty($PhotoInfo)): ?>
        <?php foreach ($PhotoInfo as $photo): ?>
            <tr>
                <td>
                    <?php if (!empty($photo['photo_name'])): ?>
                        <img src="<?= htmlspecialchars($photo['photo_name'], ENT_QUOTES, 'UTF-8'); ?>" alt="Фото">
                    <?php else: ?>
                        <p>Изображение отсутствует.</p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td><?= htmlspecialchars($photo['photo_caption'] ?? 'Без подписи', ENT_QUOTES, 'UTF-8'); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td>Фотографии отсутствуют.</td>
        </tr>
    <?php endif; ?>
</table>

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
