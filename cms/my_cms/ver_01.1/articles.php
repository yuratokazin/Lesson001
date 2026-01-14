<?php
// отладочный вывод
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// подключение к базе данных
require_once("DB_connect.php");
require_once("functions.php");

$page = "news";
$PageInfo = get_Page($page);
$ArticleInfo = get_Articles();
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <title><?= htmlspecialchars($PageInfo['page_title'] ?? 'Новости'); ?></title>
    <meta name="description" content="<?= htmlspecialchars($PageInfo['page_description'] ?? 'Описание отсутствует'); ?>">
    <meta name="keywords" content="<?= htmlspecialchars($PageInfo['page_keywords'] ?? 'новости'); ?>">
    <link rel="stylesheet" href="style_index.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<?php include(__DIR__ . "/header.inc"); ?>
<?php include(__DIR__ . "/nav.inc"); ?>

    <div class="content">
<!-- отладочный вывод  --> <pre><?php print_r($ArticleInfo); ?></pre><!-- *** -->
        <h1><?= htmlspecialchars($PageInfo['page_header'] ?? 'Новости'); ?></h1>
        <div class="ArticleList">
            <table>
                <?php if (!empty($ArticleInfo)): ?>
                    <?php foreach ($ArticleInfo as $article): ?>
                        <tr>
                            <td><?= htmlspecialchars($article['article_title'] ?? 'Без заголовка'); ?></td>
                            <td><?= htmlspecialchars($article['article_date'] ?? 'Дата не указана'); ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"><?= htmlspecialchars($article['article_content'] ?? 'Содержание отсутствует'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">Нет доступных статей.</td>
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
