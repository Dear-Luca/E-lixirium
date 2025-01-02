<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["title"] = "E-lixirium - Home";
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
    case "register":
        $templateParams["nome"] = "register-form.php";
        if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["birthday"])) {
            $register_result = $dbh->checkRegister($_POST["username"]);
            if (count($register_result)) {
                // Registration failed
                $templateParams["error"] = "A user with that username already exists";
            } else {
                $dbh->insertUser($_POST["name"], $_POST["surname"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["birthday"]);
                $templateParams["error"] = "Registration succesfull";
                header("Location: index.php?page=login");
            }
        }
        break;
    case "login":
        $templateParams["nome"] = "login-form.php";
        if (isset($_POST["username"]) && isset($_POST["password"])) {
            $login_result = $dbh->checkAdmin($_POST["username"], $_POST["password"]);
            if (count($login_result) != 0) {
                // Admin login
                registerAdminLogged($login_result[0]);
                header("Location: index.php?page=account");
            } else {
                $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
                //var_dump($login_result);
                if (count($login_result) == 0) {
                    // Login failed
                    $templateParams["error"] = "Error! Check username or password!";
                } else {
                    // User login
                    registerLoggedUser($login_result[0]);
                    header("Location: index.php?page=account");
                }
            }
        }

        // if (isUserLoggedIn()) {
        //     $templateParams["title"] = "E-lixirium - Admin";
        //     $templateParams["nome"] = "login-home.php";
        //     // $templateParams["articoli"] = $dbh->getPostByAuthorId($_SESSION["idautore"]);
        //     if (isset($_GET["formmsg"])) {
        //         $templateParams["formmsg"] = $_GET["formmsg"];
        //     }
        // } else {
        //     $templateParams["title"] = "E-lixirium - Login";
        //     $templateParams["nome"] = "login-form.php";
        // }
        break;
    case "account":
        // $templateParams["nome"] = "contatti.php";
        // $templateParams["autori"] = $dbh->getAuthors();
        break;
    case "cart":
        // $templateParams["nome"] = "contatti.php";
        // $templateParams["autori"] = $dbh->getAuthors();
        break;
    case "orders":
        // $templateParams["nome"] = "contatti.php";
        // $templateParams["autori"] = $dbh->getAuthors();
        break;
    case "logout":
        logout();
        header("Location: index.php?page=login");
        break;
    default:
    // Same as home
    // $templateParams["nome"] = "lista-articoli.php";
    // $templateParams["articoli"] = $dbh->getPosts(2);
}

require 'template/base.php';
?>