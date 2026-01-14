<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("DB_connect.php");

// вывод содержимого переменной $link
echo "<pre>";
var_dump($link);
echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из формы
    $title = $_POST['title'] ?? '';
    $date = $_POST['date'] ?? '';
    $content = $_POST['content'] ?? '';

    // Проверка заполненности полей
    if (!empty($title) && !empty($date) && !empty($content)) {
        $query = "INSERT INTO articles (article_title, article_date, article_content) VALUES (?, ?, ?)";
        $stmt = $link->prepare($query);

        if ($stmt) {
            $stmt->bind_param("sss", $title, $date, $content);
            if ($stmt->execute()) {
                $message = "Новость успешно добавлена!";
            } else {
                $message = "Ошибка выполнения: " . $stmt->error;
            }
        } else {
            $message = "Ошибка подготовки запроса: " . $link->error;
        }
    } else {
        $message = "Пожалуйста, заполните все поля!";
    }
}
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Добавление новости</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Добавление новости</h1>
    <?php if (!empty($message)): ?>
        <p><?= htmlspecialchars($message); ?></p>
    <?php endif; ?>
    <form method="POST" action="addnews.php">
        <label for="title">Заголовок:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="date">Дата:</label><br>
        <input type="date" id="date" name="date" required><br><br>

        <label for="content">Содержание:</label><br>
        <textarea id="content" name="content" rows="5" required></textarea><br><br>

        <button type="submit">Добавить новость</button>
    </form>
</body>
</html>
