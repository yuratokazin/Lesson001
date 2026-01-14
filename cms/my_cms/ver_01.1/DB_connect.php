<?php
// Подключение к базе данных
$host = 'localhost';
$username = 'root';
$password = 'new_password';
$database = 'bryanskpivo';

// Создание соединения
$link = new mysqli($host, $username, $password, $database);

// Установка кодировки на utf8mb4
if (!$link->set_charset('utf8mb4')) {
    echo "Ошибка при установке кодировки: " . $link->error;
    exit();
}

// Проверка на ошибки соединения
if ($link->connect_error) {
    echo 'Ошибка подключения к базе данных (' . $link->connect_errno . '): ' . $link->connect_error;
    exit();
}

//echo "Соединение установлено успешно!";
?>
