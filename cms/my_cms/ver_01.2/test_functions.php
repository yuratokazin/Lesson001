<?php
// Включаем вывод ошибок для отладки
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Подключаем DB_connect.php и functions.php
require_once("DB_connect.php");
require_once("functions.php");

// Проверяем работу функции get_Page()
$page = "main";
$PageInfo = get_Page($page);

echo "<h1>Тест функции get_Page</h1>";
if ($PageInfo) {
    echo "<p>Заголовок страницы: " . $PageInfo['page_title'] . "</p>";
    echo "<p>Описание страницы: " . $PageInfo['page_description'] . "</p>";
    echo "<p>Контент страницы: " . $PageInfo['page_content'] . "</p>";
} else {
    echo "<p>Страница не найдена в базе данных.</p>";
}

// Проверяем работу функции get_Articles()
echo "<h1>Тест функции get_Articles</h1>";
$articles = get_Articles();
if ($articles) {
    foreach ($articles as $article) {
        echo "<p>Название статьи: " . $article['article_title'] . "</p>";
    }
} else {
    echo "<p>Статьи не найдены.</p>";
}

// Протестируйте остальные функции аналогичным образом
?>
