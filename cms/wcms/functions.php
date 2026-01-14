<?php
function get_Page($page) {
$sql = "SELECT * FROM `pages` WHERE `page_name`=
'$page'";
$result = mysql_query($sql);
//var_dump($result);
//return $result;
$PageData = mysql_fetch_assoc($result);
return $PageData;
}
function get_Articles() {
$sql = "SELECT * FROM `articles` ORDER BY `article_date`
DESC LIMIT 10";
$result = mysql_query($sql);
$arr = array();
while ($MyRow = mysql_fetch_assoc($result)) {
$ArticleData[] = $MyRow;
}
return $ArticleData;
}
function get_Products($product_type) {
$sql = "SELECT * FROM `products`WHERE `product_type` =
'$product_type'";
$result = mysql_query($sql);
$arr = array();
while ($MyRow = mysql_fetch_assoc($result)) {
$ProductData[] = $MyRow;
}
return $ProductData;
print_r($ProductData);
}
function get_Promo() {
$sql = "SELECT * FROM `promo` ORDER BY `promo_date` DESC
LIMIT 10";
$result = mysql_query($sql);

$arr = array();
while ($MyRow = mysql_fetch_assoc($result)) {
$PromoData[] = $MyRow;
}
return $PromoData;
}
function get_Photo() {
$sql = "SELECT * FROM `photos`";
$result = mysql_query($sql);
$arr = array();
while ($MyRow = mysql_fetch_assoc($result)) {
$PhotoData[] = $MyRow;
}
return $PhotoData;
}
function get_Contacts() {
$sql = "SELECT * FROM `contacts`";
$result = mysql_query($sql);
$arr = array();
while ($MyRow = mysql_fetch_assoc($result)) {
$ContactsData[] = $MyRow;
}
return $ContactsData;
}
?>
