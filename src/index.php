<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["title"] = "E-lixirium - Home";
$templateParams["js"] = array("global.js");
$templateParams["categories"] = $dbh->getCategories();
// TODO: replace with actual products and categories getters
// $templateParams["articolicasuali"] = $dbh->getRandomPosts(2);

if (!isset($_GET["page"])) {
    $_GET["page"] = "home";
}

switch ($_GET["page"]) {
    case "home":
        $templateParams["title"] = "E-lixirium - Home";
        $templateParams["content"] = "home.php";
        $templateParams["products"] = $dbh->getTopProducts(6);
        $templateParams["categories"] = $dbh->getCategories(6);
        break;
    case "products":
        foreach ($dbh->getCategories() as $category) {
            $categories[] = $category["name"];
        }
        $templateParams["title"] = "E-lixirium - Products";
        if (isset($_GET["category"]) && in_array($_GET["category"], $categories)) {
            $templateParams["header"] = $_GET["category"];
            $templateParams["products"] = $dbh->getProductsOfCategory($_GET["category"]);
        } else {
            $templateParams["header"] = "All products";
            $templateParams["products"] = $dbh->getProducts();
        }
        $templateParams["content"] = "product-list.php";
        break;
    case "about":
        $templateParams["title"] = "E-lixirium - About Us";
        $templateParams["content"] = "about.php";
        break;
    case "product":
        // Admin
        if (isAdminLoggedIn() && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["amount"]) && isset($_POST["id_product"])) {
            if (count($dbh->getProduct($_POST["id_product"]))) {
                // Product existing
                $dbh->updateProduct($_POST["id_product"], $_POST["description"], $_POST["price"], $_POST["amount"]);
            }
        }

        // Review
        if (isset($_POST["rating"]) && isset($_POST["comment"]) && isset($_POST["id_product"]) && isUserLoggedIn()) {
            if (count($dbh->getProduct($_POST["id_product"]))) {
                // Product existing
                if (count($dbh->checkReview($_POST["id_product"], $_SESSION["username"]))) {
                    // Review existing
                    $dbh->updateReview($_POST["id_product"], $_SESSION["username"], $_POST["rating"], $_POST["comment"]);
                } else {
                    // Review not existing
                    $dbh->insertReview($_POST["id_product"], $_SESSION["username"], $_POST["rating"], $_POST["comment"]);
                }
                $dbh->updateProductStars($_POST["id_product"], $_POST["rating"]);
            }
        }

        // Cart
        if (isset($_POST["amount"]) && isUserLoggedIn()) {
            $cartProduct = $dbh->checkCartProduct($_SESSION["username"], $_POST["id_product"]);
            if (count($cartProduct)) {
                $dbh->updateCartQuantity($_SESSION["username"], $_POST["id_product"], $_POST["amount"] + $cartProduct[0]["quantity"]);
            } else {
                $dbh->insertIntoCart($_POST["id_product"], $_SESSION["username"], $_POST["amount"]);
            }
            header("Location: ?page=cart");
            exit();
        }

        // Product page
        if (isset($_GET["id"])) {
            $templateParams["product"] = $dbh->getProduct($_GET["id"]);
            if (count($templateParams["product"])) {
                // Product existing
                $templateParams["title"] = "E-lixirium - " . $templateParams["product"][0]["name"];
                if (isAdminLoggedIn()) {
                    $templateParams["content"] = "product-admin.php";
                } else {
                    $templateParams["content"] = "product-user.php";
                }
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
                if (count($dbh->checkAdmin($_POST["username"])) || count($dbh->checkUsername($_POST["username"]))) {
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
                $login_result = $dbh->checkAdminLogin($_POST["username"], $_POST["password"]);
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
                    if (($_POST["username"] == $_SESSION["username"]) || (count($dbh->checkUsername($_POST["username"])) == 0)) {
                        if ($_POST["card_number"] == "") {
                            $_POST["card_number"] = NULL;
                        }
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
            $templateParams["categories"] = $dbh->getCategories();
            //add category
            if (isset($_POST["categoryName"])) {
                $dbh->insertCategory($_POST["categoryName"]);
                $templateParams["error"] = "Category added successfully";
                $templateParams["categories"] = $dbh->getCategories();
            }

            // add product
            if (isset($_POST["productName"]) && isset($_POST["productDescription"]) && isset($_POST["productPrice"]) && isset($_POST["productAmount"]) && isset($_POST["duration"]) && isset($_POST["productImages"]) && isset($_POST["category"]) && is_array($_POST['category'])) {
                $dbh->insertProduct($_POST["productName"], $_POST["productDescription"], $_POST["productPrice"], $_POST["productAmount"], $_POST["duration"], $_POST["productImages"], 0.0);
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

            $templateParams["total"] = getCartTotal($templateParams);

            //upate quantity product
            if (isset($_POST["update_quantity"]) && isset($_POST["quantity"])) {
                $dbh->updateCartQuantity($_SESSION["username"], $_POST["id_product"], $_POST["quantity"]);
                $templateParams["cart"] = $dbh->getCartProducts($_SESSION["username"]);
                $templateParams["total"] = getCartTotal($templateParams);
            }

            //remove product from cart
            if (isset($_POST["remove_product"]) && isset($_POST["remove"])) {
                $dbh->deleteCartProduct($_SESSION["username"], $_POST["id_product"]);
                $templateParams["cart"] = $dbh->getCartProducts($_SESSION["username"]);
                $templateParams["total"] = getCartTotal($templateParams);
            }

            if (isset($_POST["checkout-confirm"])) {
                if ($dbh->getCreditCard($_SESSION["username"])[0]["card_number"] == NULL) {
                    $templateParams["error"] = "You need to insert a card number in your account";
                } else {
                    $dbh->insertOrder($_SESSION["username"]);
                    $id_order = $dbh->getLastInsertId();
                    foreach ($templateParams["cart"] as $product) {
                        $dbh->insertIncludeOrder($product["id_product"], $id_order, $product["quantity"]);
                        $dbh->updateAmountLeft($product["id_product"], $product["quantity"]);
                    }
                    $templateParams["admins"] = $dbh->getAdmins();
                    foreach ($templateParams["admins"] as $admin) {
                        $dbh->insertNotification("New order", generateOrderMessage($id_order, $_SESSION["username"], $templateParams["cart"]), admin: $admin["username"]);
                    }
                    $dbh->insertNotification("New order", generateOrderMessage($id_order, $_SESSION["username"], $templateParams["cart"]), username: $_SESSION["username"]);
                    $dbh->deleteCart($_SESSION["username"]);
                    header("Location: ?page=orders");
                }
            }


        } else {
            header("Location: ?page=home");
        }
        break;
    case "orders":
        if (isUserLoggedIn()) {
            $templateParams["title"] = "E-lixirium - Orders";
            $templateParams["content"] = "orders.php";
            $templateParams["orders"] = $dbh->getOrders($_SESSION["username"]);

        } else {
            header("Location: ?page=home");
        }
        break;
    case "order_detail":
        if (isUserLoggedIn()) {
            if (isset($_GET["id_order"])) {
                $templateParams["title"] = "E-lixirium - Order Detail";
                $templateParams["content"] = "order-detail.php";
                $templateParams["order-detail"] = $dbh->getOrderDetail($_GET["id_order"]);
            } else {
                header("Location: ?page=orders");
            }
        } else {
            header("Location: ?page=home");
        }
        break;
    case "notifications":
        if (isUserLoggedIn() || isAdminLoggedIn()) {
            $templateParams["title"] = "E-lixirium - Notifications";
            $templateParams["content"] = "notifications.php";
            $templateParams["notifications"] = $dbh->getNotifications($_SESSION["username"]);
        } else {
            header("Location: ?page=home");
        }
        break;
    case "notification-detail":
        if (isUserLoggedIn() || isAdminLoggedIn()) {
            if (isset($_GET["id"])) {
                $templateParams["title"] = "E-lixirium - Notification Detail";
                $templateParams["content"] = "notification-detail.php";
                $templateParams["notification-detail"] = $dbh->getNotificationDetail($_GET["id"]);
                //var_dump($templateParams["notification-detail"]);
            } else {
                header("Location: ?page=notifications");
            }
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