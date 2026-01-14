<?php
require_once("DB_connect.php");
require_once("functions.php");
$page = "beer";
$product_type = "beer";
$PageInfo = get_Page($page);
$ProductInfo = get_Products($product_type);
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
<table>
<tr>
<th>Название</th>
<th>Описание</th>
</tr>
<? foreach($ProductInfo as $product):?>
<tr>
<td><?=$product['product_name'];?></td>
<td><?=$product['product_desc'];?></td>
</tr>
</table>
</div>
<div class="footer">
<? include "footer.inc"; ?>
</div>
</body>
</html>
