<?php
require_once("DB_connect.php");
require_once("functions.php");
$page = "news";
$PageInfo = get_Page($page);
$ArticleInfo = get_Articles();
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
<title><?=$PageInfo['page_title'];?></title>
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
<div class="ArticleList">
<table>
<? foreach($ArticleInfo as $article):?>
<tr>
<td><?=$article['article_title'];?></td>
<td><?=$article['article_date'];?></td>
</tr>
<tr>
<td
colspan="2"><?=$article['article_desc'];?></td>
</tr>
<tr>
</tr>
<?endforeach;?>
</table>
</div>
</div>
<div class="footer">
<? include "footer.inc"; ?>
</div>
</body>
</html>
