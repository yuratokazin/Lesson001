<?php
require_once("DB_connect.php");
require_once("functions.php");
$page = "products";
$PageInfo = get_Page($page);
$ProductInfo = get_Products;
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
<title><?=$PageInfo['page_title'];?></title>
<meta charset="Windows-1251">
<meta name="description"
content="<?=$PageInfo['page_description'];?>">
<meta name="keywords"
content="<?=$PageInfo['page_keywords'];?>">
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="header">
<? include "header.inc"; ?>
</div>
<div class="nav">
<? include "nav.inc"; ?>
</div>
<div class="content">
<h1><?=$PageInfo['page_header']; ?></h1>
<ul>
<li><a href="beer.php">Пиво</a></li>
<li><a href="non_alco.php">Безалкогольные
напитки</a></li>
<li><a href="malt.php">Солод</a></li>
</ul>
</div>
<div class="footer">
<? include "footer.inc"; ?>
</div>
</body>
</html>
