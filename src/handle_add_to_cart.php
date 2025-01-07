<?php
require_once 'bootstrap.php';

if (!isset($_POST["duration"]) || !isset($_POST["amount"])) {
    header("location: ./?page=products");
    exit();
}
if (!isUserLoggedIn()) {
    header("location: ./?page=login");
    exit();
}

// TODO: add to cart

?>