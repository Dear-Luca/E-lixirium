<?php
require_once 'bootstrap.php';

if (!isset($_GET["value"])) {
    header("location: ./?page=products");
    exit();
}

$templateParams["title"] = "E-lixirium - Search results";
$templateParams["products"] = $dbh->searchProducts($_GET["value"]);
$templateParams["categories"] = $dbh->getCategories();
$templateParams["js"] = array("global.js");
if (count($templateParams["products"]) > 0) {
    $templateParams["header"] = 'Search results for "' . $_GET["value"] . '"';
} else {
    $templateParams["header"] = 'No results found for "' . $_GET["value"] . '"';
}
$templateParams["content"] = "product-list.php";

require 'template/base.php';
?>