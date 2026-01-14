<?php
// Включаем вывод ошибок для отладки
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("DB_connect.php");   // Файл для подключения к БД
require_once("functions.php");     // Если понадобятся дополнительные функции

// Обработка отправки формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем и фильтруем входные данные
    $author = trim($_POST['author'] ?? '');
    $content = trim($_POST['content'] ?? '');

    // Проверка на пустые значения
    if (!empty($author) && !empty($content)) {
        // Подготовленный запрос для предотвращения SQL-инъекций
        $stmt = $pdo->prepare("INSERT INTO forum_posts (author, content) VALUES (?, ?)");
        $stmt->execute([$author, $content]);

        // Перенаправляем для предотвращения повторной отправки формы
        header("Location: forum.php");
        exit;
    }
}

// Получаем все сообщения для отображения (от новых к старым)
$query = "SELECT * FROM forum_posts ORDER BY created_at DESC";
$stmt = $pdo->query($query);
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Простой форум</title>
    <link rel="stylesheet" type="text/css" href="/style.css">
    <style>
      .forum-container { max-width: 760px; margin: 20px auto; padding: 10px; }
      .forum-form input, .forum-form textarea { width: 100%; padding: 8px; margin-bottom: 8px; }
      .forum-form button { padding: 8px 16px; }
      .post { border-bottom: 1px solid #ccc; padding: 10px 0; }
      .post:last-child { border-bottom: none; }
      .post p { margin: 5px 0; }
      .post-header { font-size: 0.9em; color: #555; }
    </style>
</head>
<body>

<?php include(__DIR__ . "/header.inc"); ?>

<div class="content forum-container">
    <h1>Форум</h1>
    <form action="forum.php" method="post" class="forum-form">
        <input type="text" name="author" placeholder="Ваше имя" required>
        <textarea name="content" placeholder="Ваше сообщение" rows="4" required></textarea>
        <button type="submit">Отправить</button>
    </form>

    <div class="forum-posts">
        <?php if(!empty($posts)): ?>
            <?php foreach ($posts as $post) : ?>
                <div class="post">
                    <div class="post-header">
                        <strong><?=htmlspecialchars($post['author'])?></strong>
                        <span>(<?=htmlspecialchars($post['created_at'])?>)</span>
                    </div>
                    <p><?=nl2br(htmlspecialchars($post['content']))?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Сообщений пока нет. Будьте первым!</p>
        <?php endif; ?>
    </div>
</div>

<?php include(__DIR__ . "/footer.inc"); ?>

</body>
</html>
