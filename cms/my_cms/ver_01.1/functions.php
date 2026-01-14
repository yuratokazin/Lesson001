<?php
function get_Page($page) {
    global $link; // Используем глобальную переменную $link для подключения
    $sql = "SELECT * FROM `pages` WHERE `page_name` = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $page);
    $stmt->execute();
    $result = $stmt->get_result();
    $PageData = $result->fetch_assoc();
    return $PageData;
}

function get_Articles() {
    global $link;
    $sql = "SELECT * FROM `articles` ORDER BY `article_date` DESC LIMIT 10";
    $result = $link->query($sql);
    $ArticleData = [];
    while ($MyRow = $result->fetch_assoc()) {
        $ArticleData[] = $MyRow;
    }
    return $ArticleData;
}

function get_Products($product_type) {
    global $link;
    $sql = "SELECT * FROM `products` WHERE `product_type` = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("s", $product_type);
    $stmt->execute();
    $result = $stmt->get_result();
    $ProductData = [];
    while ($MyRow = $result->fetch_assoc()) {
        $ProductData[] = $MyRow;
    }
    return $ProductData;
}

function get_Promo() {
    global $link;
    $sql = "SELECT * FROM `promo` ORDER BY `promo_date` DESC LIMIT 10";
    $result = $link->query($sql);
    $PromoData = [];
    while ($MyRow = $result->fetch_assoc()) {
        $PromoData[] = $MyRow;
    }
    return $PromoData;
}

function get_Photo() {
    global $link;
    $sql = "SELECT * FROM `photos`";
    $result = $link->query($sql);
    $PhotoData = [];
    while ($MyRow = $result->fetch_assoc()) {
        $PhotoData[] = $MyRow;
    }
    return $PhotoData;
}

function get_Contacts() {
    global $link;
    $sql = "SELECT * FROM `contacts`";
    $result = $link->query($sql);
    $ContactsData = [];
    while ($MyRow = $result->fetch_assoc()) {
        $ContactsData[] = $MyRow;
    }
    return $ContactsData;
}
?>
