<?php
//Подключение БД
$link = mysql_connect('localhost', 'root', '');
$db = mysql_select_db('bryanskpivo');
mysql_query("set names 'CP1251'");
if (mysqli_connect_errno()) {
echo 'Ошибка подключения к базе данных
('.mysqli_connect_errno(). '): '.mysqli_connect_error();
exit();
}
?>
