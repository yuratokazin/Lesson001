<?php
require_once("DB_connect.php");
require_once("functions.php");

$page = "articles";
$PageInfo = get_Page($page); // Проверяем, возвращается ли массив
$ArticleInfo = get_Articles() ?? []; // Гарантируем, что $ArticleInfo всегда массив
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8"> <!-- Указание кодировки -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Для адаптивного дизайна -->
    <link rel="stylesheet" type="text/css" href="/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title><?= htmlspecialchars($PageInfo['page_title'] ?? 'Новости'); ?></title>
    <meta name="description" content="<?= htmlspecialchars($PageInfo['page_description'] ?? 'Описание отсутствует'); ?>">
    <meta name="keywords" content="<?= htmlspecialchars($PageInfo['page_keywords'] ?? 'новости'); ?>">
</head>
<body>
    <?php include(__DIR__ . "/header.inc"); ?>

    <div class="content">
        <?php include(__DIR__ . "/nav.inc"); ?>
        <!-- Отображаем HTML-контент -->
        <p><?= $PageInfo['page_content'] ?? 'Контент отсутствует'; ?></p>

        <h1><?= htmlspecialchars($PageInfo['page_header'] ?? 'Рекомендации по запуску НКО'); ?></h1>

        <div class="ArticleList">
            <?php if (!empty($ArticleInfo)): ?>
                <?php foreach ($ArticleInfo as $article): ?>
                    <!-- Выводим HTML-контент статьи -->
                    <div>
                        <?= $article['article_content'] ?? 'Содержание отсутствует'; ?> <!-- Не используем htmlspecialchars -->
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Нет доступных статей.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer">
        <?php include(__DIR__ . "/footer.inc"); ?>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const hamburger = document.querySelector('.hamburger');
            const navMenu = document.querySelector('.nav ul');

            hamburger?.addEventListener('click', (event) => { // Проверяем наличие элементов
                event.stopPropagation();
                navMenu.classList.toggle('active');
                console.log('Класс active применён:', navMenu.classList.contains('active'));
            });

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
