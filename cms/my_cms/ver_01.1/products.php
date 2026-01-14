<?php
require_once("DB_connect.php");
require_once("functions.php");
$page = "beer";
$product_type = "beer";
$PageInfo = get_Page($page);
$ProductInfo = get_Products($product_type);
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
что переменная $ProductInfo содержит данные -->
<pre><?php print_r($ProductInfo); ?></pre>

    <table>
        <tr>
            <th>Название</th>
            <th>Описание</th>
        </tr>
        <!-- Цикл foreach -->
        <?php foreach ($ProductInfo as $product): ?>
        <tr>
            <td><?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?= htmlspecialchars($product['product_desc'], ENT_QUOTES, 'UTF-8'); ?></td>
        </tr>
        <?php endforeach; ?>
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
