<?php
require_once("DB_connect.php");
require_once("functions.php");
$page = "history";
$PageInfo = get_Page($page);
?>
<!DOCTYPE html>
<html lang="ru-RU">
<head>
<link rel="stylesheet" type="text/css" href="/style.css">
<title><?=$PageInfo['page_title']?></title>
<meta name="description" content="<?=$PageInfo[
'page_description']?>">
<meta name="keywords"
content="<?=$PageInfo['page_keywords']?>">
</head>
<body>
<div class="header">
<? include "/header.inc";?>
</div>
<div class="nav">
<? include "/nav.inc";?>
</div>
<div class="content">
<p><?=$PageInfo['page_content']?></p>
</div>
<div class="footer">
<? include"/footer.inc"; ?>
</div>
</body>
</html>
