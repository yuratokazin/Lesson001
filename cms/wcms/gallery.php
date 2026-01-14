<?php
require_once("DB_connect.php");
require_once("functions.php");
$page = "gallery";
$PageInfo = get_Page($page);
$PhotoInfo = get_Photo();
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
<table align="center">
<? foreach($PhotoInfo as $photo):?>
<tr>
<td><img
src='<?=$photo['photo_name'];?>'></td>
</tr>
<tr>
<td><?=$photo['photo_caption'];?></td>
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
