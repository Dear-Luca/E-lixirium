<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "E-lixirium - Home";
// TODO: replace with actual products and categories getters
// $templateParams["categorie"] = $dbh->getCategories();
// $templateParams["articolicasuali"] = $dbh->getRandomPosts(2);

if (!isset($_GET["page"])) {
    $_GET["page"] = "home";
}
switch ($_GET["page"]) {
    case "home":
        // Home Template
        // $templateParams["nome"] = "lista-articoli.php";
        // $templateParams["articoli"] = $dbh->getPosts(2);
        break;
    case "products":
        // $templateParams["nome"] = "lista-articoli.php";
        // $templateParams["articoli"] = $dbh->getPosts();
        break;
    case "about":
        // $templateParams["nome"] = "contatti.php";
        // $templateParams["autori"] = $dbh->getAuthors();
        break;
    case "login":
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
            if (count($login_result) == 0) {
                //Login failed
                $templateParams["errorelogin"] = "Error! Check username or password!";
            } else {
                registerLoggedUser($login_result[0]);
            }
        }

        if (isUserLoggedIn()) {
            $templateParams["titolo"] = "E-lixirium - Admin";
            $templateParams["nome"] = "login-home.php";
            // $templateParams["articoli"] = $dbh->getPostByAuthorId($_SESSION["idautore"]);
            if (isset($_GET["formmsg"])) {
                $templateParams["formmsg"] = $_GET["formmsg"];
            }
        } else {
            $templateParams["titolo"] = "E-lixirium - Login";
            $templateParams["nome"] = "login-form.php";
        }
        break;
    case "profile":
        // $templateParams["nome"] = "contatti.php";
        // $templateParams["autori"] = $dbh->getAuthors();
        break;
    case "shopping kart":
        // $templateParams["nome"] = "contatti.php";
        // $templateParams["autori"] = $dbh->getAuthors();
        break;
    case "orders":
        // $templateParams["nome"] = "contatti.php";
        // $templateParams["autori"] = $dbh->getAuthors();
        break;
    case "logout":
        // $templateParams["nome"] = "contatti.php";
        // $templateParams["autori"] = $dbh->getAuthors();
        break;
    default:
    // Same as home
    // $templateParams["nome"] = "lista-articoli.php";
    // $templateParams["articoli"] = $dbh->getPosts(2);
}

require 'template/base.php';
?>