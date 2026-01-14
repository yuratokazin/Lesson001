<?php
require_once("DB_connect.php");
require_once("functions.php");
$page = "gallery";
$PageInfo = get_Page($page);
$PhotoInfo = get_Photo();
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
<title><?=$PageInfo['page_title'];?></title>
<meta charset="utf-8">
<meta name="description"
content="<?=$PageInfo['page_description'];?>">
<meta name="keywords"
content="<?=$PageInfo['page_keywords'];?>">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="style_index.css">
</head>
<body>

<?php include(__DIR__ . "/header.inc"); ?>
<?php include(__DIR__ . "/nav.inc"); ?>

<div class="content">
<!-- добавил отладочный вывод перед HTML-таблицей, чтобы убедиться,
что переменная $PhotoInfo содержит данные -->
<pre><?php print_r($PhotoInfo); ?></pre>

<h1><?= htmlspecialchars($PageInfo['page_header'] ?? 'Галерея'); ?></h1>

<table align="center">
    <?php if (!empty($PhotoInfo)): ?>
        <?php foreach ($PhotoInfo as $photo): ?>
            <tr>
                <td>
                    <?php if (!empty($photo['photo_name'])): ?>
                        <img src="<?= htmlspecialchars($photo['photo_name']); ?>" alt="Фото">
                    <?php else: ?>
                        <p>Изображение отсутствует.</p>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td><?= htmlspecialchars($photo['photo_caption'] ?? 'Без подписи'); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td>Фотографии отсутствуют.</td>
        </tr>
    <?php endif; ?>
</table>

</div>
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
