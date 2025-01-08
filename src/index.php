<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["title"] = "E-lixirium - Home";
$templateParams["js"] = array("scripts.js");
$templateParams["categories"] = $dbh->getCategories();
// TODO: replace with actual products and categories getters
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
        foreach ($dbh->getCategories() as $category) {
            $categories[] = $category["name"];
        }
        $templateParams["title"] = "E-lixirium - Products";
        // if (!isset($_GET["nav-search"])) {
        //     // TODO
        //     $templateParams["products"] = $dbh->searchProducts($_GET["nav-search"]);
        //     $templateParams["header"] = "Search results";
        // }
        if (isset($_GET["category"]) && in_array($_GET["category"], $categories)) {
            $templateParams["header"] = $_GET["category"];
            $templateParams["products"] = $dbh->getProductsOfCategory($_GET["category"]);
        } else {
            $templateParams["header"] = "All products";
            $templateParams["products"] = $dbh->getProducts();
        }
        //var_dump($templateParams["products"]);
        $templateParams["content"] = "product-list.php";
        break;
    case "about":
        $templateParams["title"] = "E-lixirium - About Us";
        // $templateParams["content"] = "PAGE.php";
        break;
    case "product":
        if (isset($_GET["id"])) {
            $templateParams["product"] = $dbh->getProduct($_GET["id"]);
            if (count($templateParams["product"])) {
                // Product existing
                $templateParams["title"] = "E-lixirium - " . $templateParams["product"][0]["name"];
                $templateParams["content"] = "product.php";
            } else {
                // Product not existing
                header("Location: ?page=products");
            }
        } else {
            header("Location: ?page=products");
        }
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
                    if (!count($login_result)) {
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
        if (isUserLoggedIn()) {
            $templateParams["title"] = "E-lixirium - Account";
            $templateParams["content"] = "account-user.php";
            $templateParams["userInfo"] = $dbh->getUserInfo($_SESSION["username"]);
            if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["birthday"]) && isset($_POST["card_number"]) && isset($_POST["password"])) {
                if ($_POST["password"] == $_POST["confirmPassword"]) {
                    // if username does't change or new username is not used
                    if (($_POST["username"] == $_SESSION["username"]) || (count($dbh->checkRegister($_POST["username"])) == 0)) {
                        $dbh->updateUser($_POST["name"], $_POST["surname"], $_POST["username"], $_POST["email"], $_POST["birthday"], $_POST["card_number"], $_POST["password"], $_SESSION["username"]);
                        $templateParams["error"] = "Update successful";
                        $_SESSION["username"] = $_POST["username"];
                        $templateParams["userInfo"] = $dbh->getUserInfo($_SESSION["username"]);
                        // update variable session
                        updateUser($templateParams);
                    } else {
                        $templateParams["error"] = "A user with that username already exists";
                    }
                } else {
                    $templateParams["error"] = "You need to confirm the password";
                }
            }

        } else if (isAdminLoggedIn()) {
            $templateParams["title"] = "E-lixirium - Admin";
            $templateParams["content"] = "account-admin.php";
            //add category
            if (isset($_POST["categoryName"])) {
                $dbh->insertCategory($_POST["categoryName"]);
                $templateParams["error"] = "Category added successfully";
            }

            // add product
            if (isset($_POST["productName"]) && isset($_POST["productDescription"]) && isset($_POST["productPrice"]) && isset($_POST["productAmount"]) && isset($_POST["duration"]) && isset($_POST["productImages"]) && isset($_POST["category"]) && is_array($_POST['category'])) {
                $dbh->insertProduct($_POST["productName"], $_POST["productDescription"], $_POST["productPrice"], $_POST["productAmount"], $_POST["duration"], $_POST["productImages"]);
                $templateParams["error"] = "Insertion successful";
                $id = $dbh->getLastInsertId();
                foreach ($_POST["category"] as $category) {
                    //var_dump($id, $category);
                    $dbh->insertProductIsCategory($category, $id);
                }
            }
        } else {
            header("Location: ?page=login");
        }
        break;
    case "cart":
        if (isUserLoggedIn()) {
            $templateParams["title"] = "E-lixirium - Shopping cart";
            $templateParams["content"] = "cart.php";
            $templateParams["cart"] = $dbh->getCartProducts($_SESSION["username"]);
            $total = 0;
            
            foreach($templateParams["cart"] as $product){
                $total += $product["price"] * $product["quantity"];
            }
            $templateParams["total"] = $total;

            //$templateParams["total"] = 
            //upate quantity product
            if (isset($_POST["update_quantity"]) && isset($_POST["quantity"])){
                // need to add control to check if a product is available
                $dbh->updateCartQuantity($_SESSION["username"], $_POST["id_product"] ,$_POST["quantity"]);
                $templateParams["cart"] = $dbh->getCartProducts($_SESSION["username"]);
            }

            //remove product from cart
            if (isset($_POST["remove_product"]) && isset($_POST["remove"])) {
                $dbh->deleteCartProduct($_SESSION["username"], $_POST["id_product"]);
                $templateParams["cart"] = $dbh->getCartProducts($_SESSION["username"]);
            }
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