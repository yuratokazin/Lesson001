<?php
require_once("DB_connect.php");
require_once("functions.php");
$page = "contacts";
$PageInfo = get_Page($page);
$ContactInfo = get_Contacts();
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
<table>
<? foreach($ContactInfo as $contact):?>
<tr>
<td><?=$contact['contact_type'];?></td>
<td><?=$contact['contact_caption'];?></td>
</tr>
<?endforeach;?>
</table>
</div>
<div class="footer">
<? include "footer.inc"; ?>
</div>
</body>
</html>
