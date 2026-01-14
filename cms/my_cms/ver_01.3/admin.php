<?php
session_start();

// Ограничение доступа: проверка авторизации
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit();
}

// Настройки безопасности сессии
ini_set('session.cookie_httponly', true);
ini_set('session.cookie_secure', true); // Только если работает HTTPS
session_regenerate_id(true); // Регистрация нового ID сессии для предотвращения угона

// Отображение ошибок для разработки
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("DB_connect.php");

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Очистка входных данных
    $title = htmlspecialchars(trim($_POST['title'] ?? ''));
    $date = htmlspecialchars(trim($_POST['date'] ?? ''));
    $content = htmlspecialchars(trim($_POST['content'] ?? ''));

    // Валидация входных данных
    if (!empty($title) && !empty($date) && !empty($content)) {
        try {
            // Используем PDO для работы с БД
            $query = "INSERT INTO articles (article_title, article_date, article_content) VALUES (:title, :date, :content)";
            $stmt = $link->prepare($query);

            // Привязка параметров
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $message = "Новость успешно добавлена!";
            } else {
                $message = "Ошибка выполнения запроса.";
            }
        } catch (PDOException $e) {
            $message = "Ошибка базы данных: " . htmlspecialchars($e->getMessage());
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="/style.css" rel="stylesheet">
</head>
<body>
<script src="https://kit.fontawesome.com/yourkit.js" crossorigin="anonymous"></script>

<?php include(__DIR__ . "/header.inc"); ?>
<?php include(__DIR__ . "/nav.inc"); ?>

<div class="content">
    <h1>Добавление новости</h1>
    <?php if (!empty($message)): ?>
        <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>
    <form method="POST" action="admin.php">
        <div class="form-group">
            <label for="title">Заголовок:</label><br>
            <input type="text" id="title" name="title" required><br><br>
        </div>
        <div class="form-group">
            <label for="date">Дата:</label><br>
            <input type="date" id="date" name="date" required><br><br>
        </div>
        <div class="form-group">
            <label for="content">Содержание:</label><br>
            <textarea id="content" name="content" rows="5" required></textarea><br><br>
        </div>
        <button type="submit" class="submit-btn">Добавить новость</button>
    </form>
</div>

<div class="footer">
<?php include(__DIR__ . "/footer.inc"); ?>
</div>

</body>
</html>
