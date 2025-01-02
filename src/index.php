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
        $templateParams["title"] = "E-lixirium - Home";
        // $templateParams["content"] = "PAGE.php";
        break;
    case "products":
        $templateParams["title"] = "E-lixirium - Products";
        // $templateParams["content"] = "PAGE.php";
        break;
    case "about":
        $templateParams["title"] = "E-lixirium - About Us";
        // $templateParams["content"] = "PAGE.php";
        break;
    case "register":
        if (!isUserLoggedIn() && !isAdminLoggedIn()) {
            $templateParams["title"] = "E-lixirium - Register";
            $templateParams["content"] = "register-form.php";
            if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["birthday"])) {
                $register_result = $dbh->checkRegister($_POST["username"]);
                if (count($register_result)) {
                    // Registration failed
                    $templateParams["error"] = "A user with that username already exists";
                } else {
                    $dbh->insertUser($_POST["name"], $_POST["surname"], $_POST["username"], $_POST["email"], $_POST["password"], $_POST["birthday"]);
                    $templateParams["error"] = "Registration succesfull";
                    header("Location: ?page=login");
                }
            }
        } else {
            header("Location: ?page=account");
        }
        break;
    case "login":
        if (!isUserLoggedIn() && !isAdminLoggedIn()) {
            $templateParams["title"] = "E-lixirium - Login";
            $templateParams["content"] = "login-form.php";
            if (isset($_POST["username"]) && isset($_POST["password"])) {
                $login_result = $dbh->checkAdmin($_POST["username"], $_POST["password"]);
                if (count($login_result) != 0) {
                    // Admin login
                    registerAdminLogged($login_result[0]);
                    header("Location: ?page=account");
                } else {
                    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
                    if (count($login_result) == 0) {
                        // Login failed
                        $templateParams["error"] = "Error! Check username or password!";
                    } else {
                        // User login
                        registerLoggedUser($login_result[0]);
                        header("Location: ?page=account");
                    }
                }
            }
        } else {
            header("Location: ?page=account");
        }
        break;
    case "account":
        if (isUserLoggedIn() || isAdminLoggedIn()) {
            $templateParams["title"] = "E-lixirium - Account";
            // $templateParams["content"] = "PAGE.php"
        } else {
            header("Location: ?page=login");
        }
        break;
    case "cart":
        if (isUserLoggedIn()) {
            $templateParams["title"] = "E-lixirium - Shopping cart";
            // $templateParams["content"] = "PAGE.php"
        } else {
            header("Location: ?page=home");
        }
        break;
    case "orders":
        if (isUserLoggedIn()) {
            $templateParams["title"] = "E-lixirium - Orders";
            // $templateParams["content"] = "PAGE.php";
        } else {
            header("Location: ?page=home");
        }
        break;
    case "logout":
        if (isUserLoggedIn() || isAdminLoggedIn()) {
            logout();
            header("Location: ?page=login");
        } else {
            header("Location: ?page=home");
        }
        break;
    default:
        $templateParams["title"] = "E-lixirium - Home";
}

require 'template/base.php';
?>