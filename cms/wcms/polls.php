<?php
require_once("DB_connect.php");
require_once("functions.php");
$page = "polls";
$PageInfo = get_Page($page);
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);
include('webPoll.class.php');
webPoll::vote();
?>
<html>
<head>
<title><?=$dataPages['title'];?></title>
<meta name="description"
content="<?=$dataPages['description'];?>">
<meta name="keywords"
content="<?=$dataPages['keywords'];?>">
<link rel="stylesheet" href="style.css" type="text/css">
<link rel="stylesheet" href="poll.css" type="text/css">
<!--[if IE]>
<style> body { behavior: url("res/hover.htc"); } </style>
<![endif]-->
</head>
<body>
<div class="header">
<? include "/header.inc";?>
</div>
<div class="nav">
<? include "nav.inc"; ?>
</div>
<div class="content">
<table>
<tr>
<td>
<?
$a = new webPoll(array(
'Вам нравится наш сайт?',
'Да, круто!',
'Хороший',
'Ну нормальный',
'Можно было и лучше',
'Ужасно!'));
?>
</td>
<td>
<?
$b = new webPoll(array(
'Вам нравится продукция АО "Брянскпиво"?',
'Да!',
'Нет!'));
?>
</td>
</tr>
</table>
</div>
<div class="footer">
<? include("/footer.inc"); ?>
</div>
</body>
</html>
