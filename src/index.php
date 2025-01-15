<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["title"] = "E-lixirium - Home";
$templateParams["js"] = array("global.js");
$templateParams["categories"] = $dbh->getCategories();

if (!isset($_GET["page"])) {
    $_GET["page"] = "home";
}


switch ($_GET["page"]) {
    case "home":
        $templateParams["title"] = "E-lixirium - Home";
        $templateParams["content"] = "home.php";
        $templateParams["products"] = $dbh->getTopProducts(6);
        $templateParams["categories"] = $dbh->getCategories(6);
        // EXECUTE JUST ONE TIME!
        // insertAdmin($dbh);
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
        // Admin delete
        if (isAdminLoggedIn() && isset($_POST["delete-confirm"]) && isset($_POST["id_product_delete"])) {
            if (count($dbh->getProduct($_POST["id_product_delete"]))) {
                // Product existing
                if (
                    $dbh->deleteCategoriesOfProduct($_POST["id_product_delete"]) &&
                    $dbh->deleteReviewsOfProduct($_POST["id_product_delete"]) &&
                    $dbh->deleteProductFromCarts($_POST["id_product_delete"]) &&
                    $dbh->deleteProductFromOrders($_POST["id_product_delete"])
                ) {
                    // If other deletions succeded
                    $dbh->deleteProduct($_POST["id_product_delete"]);
                }
            }
        }

        // Admin update
        if (isAdminLoggedIn() && isset($_POST["description"]) && isset($_POST["price"]) && isset($_POST["amount"]) && isset($_POST["id_product_update"])) {
            if (count($dbh->getProduct($_POST["id_product_update"]))) {
                // Product existing
                $dbh->updateProduct($_POST["id_product_update"], $_POST["description"], $_POST["price"], $_POST["amount"]);
            }
        }

        // Review
        if (isset($_POST["rating"]) && isset($_POST["comment"]) && isset($_POST["id_product_review"]) && isUserLoggedIn()) {
            if (count($dbh->getProduct($_POST["id_product_review"]))) {
                // Product existing
                $success = false;
                if (count($dbh->checkReview($_POST["id_product_review"], $_SESSION["username"]))) {
                    // Review existing
                    $success = $dbh->updateReview($_POST["id_product_review"], $_SESSION["username"], $_POST["rating"], $_POST["comment"]);
                } else {
                    // Review not existing
                    $success = $dbh->insertReview($_POST["id_product_review"], $_SESSION["username"], $_POST["rating"], $_POST["comment"]);
                }
                if ($success) {
                    $dbh->updateProductStars($_POST["id_product_review"], $_POST["rating"]);
                }
            }
        }

        // Cart
        if (isset($_POST["amount"]) && isset($_POST["id_product_cart"]) && isUserLoggedIn()) {
            $cartProduct = $dbh->checkCartProduct($_SESSION["username"], $_POST["id_product_cart"]);
            if (count($cartProduct)) {
                $dbh->updateCartQuantity($_SESSION["username"], $_POST["id_product_cart"], $_POST["amount"] + $cartProduct[0]["quantity"]);
            } else {
                $dbh->insertIntoCart($_POST["id_product_cart"], $_SESSION["username"], $_POST["amount"]);
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
                    $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $dbh->insertUser($_POST["name"], $_POST["surname"], $_POST["username"], $_POST["email"], $hashedPassword, $_POST["birthday"]);
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
                // get hashed admin password 
                $adminResult = $dbh->getHashedPasswordAdmin($_POST["username"]);
                if (!empty($adminResult) && isset($adminResult[0]["password"])) {
                    $hashedPassword = $adminResult[0]["password"];
                    $loginResult = password_verify($_POST["password"], $hashedPassword);
                    if ($loginResult) {
                        // Admin login
                        registerAdminLogged($_POST);
                        header("Location: ?page=account");
                        exit();
                    }
                }

                // try with the user
                $userResult = $dbh->getHashedPasswordUser($_POST["username"]);
                if (!empty($userResult) && isset($userResult[0]["password"])) {
                    $hashedPassword = $userResult[0]["password"];
                    $loginResult = password_verify($_POST["password"], $hashedPassword);
                    if ($loginResult) {
                        // User login
                        $user = $dbh->getUserInfo($_POST["username"])[0];
                        registerLoggedUser($user);
                        header("Location: ?page=account");
                        exit();
                    } else {
                        $templateParams["error"] = "Error! Check username or password!";
                    }
                } else {
                    $templateParams["error"] = "Error! Check username or password!";
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
            $templateParams["cart"] = $dbh->getCartProducts($_SESSION["username"]);

            if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["birthday"]) && isset($_POST["card_number"]) && isset($_POST["password"])) {
                if ($_POST["password"] == $_POST["confirmPassword"]) {
                    $_POST["card_number"] = $_POST["card_number"] == "" ? NULL : $_POST["card_number"];
                    // var_dump($_SESSION);
                    $userInfo = $dbh->getUserInfo($_SESSION["username"]);
                    if ($userInfo && isset($userInfo[0])) {
                        $hashedPassword = $_POST["password"] == "" ? $userInfo[0]["password"] : password_hash($_POST["password"], PASSWORD_DEFAULT);
                        $username = $_POST["username"] ?? $userInfo[0]["username"]; // Usa il valore di default se `username` non è impostato
                        
                        $dbh->updateUser($_POST["name"], $_POST["surname"], $username, $_POST["email"], $_POST["birthday"], $_POST["card_number"], $hashedPassword);
                        $templateParams["error"] = "Update successful";
                        $templateParams["userInfo"] = $dbh->getUserInfo($_SESSION["username"]);
                        updateUser($templateParams);
                    } else {
                        $templateParams["error"] = "User not found";
                    }
                } else {
                    $templateParams["error"] = "You need to confirm the password";
                }
            }

            // check products in cart and update them
            foreach ($templateParams["cart"] as $product) {
                $amountLeft = $dbh->getProduct($product["id_product"])[0]["amount_left"];
                if ($amountLeft == 0) {
                    // remove product
                    $dbh->deleteProductFromCart($product["id_product"], $_SESSION["username"]);
                    // notify user
                    $description = outOfStockMessageUser($_SESSION["username"], $product["name"]);
                    $dbh->insertNotification("Product out of stock", $description, username: $_SESSION["username"]);
                } elseif ($product["quantity"] > $amountLeft) {
                    $description = amountChangedMessage($_SESSION["username"], $product["name"]);
                    $dbh->insertNotification("Availability changed", $description, username: $_SESSION["username"]);
                    $dbh->updateCartQuantity($_SESSION["username"], $product["id_product"], $amountLeft);
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
            if (isset($_POST["productName"]) && isset($_POST["productDescription"]) && isset($_POST["productPrice"]) && isset($_POST["productAmount"]) && isset($_POST["duration"]) && isset($_FILES["productImages"]) && isset($_POST["category"]) && is_array($_POST['category'])) {
                list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["productImages"]);
                if ($result != 0) {
                    $imgname = $msg;
                    $id = $dbh->insertProduct($_POST["productName"], $_POST["productDescription"], $_POST["productPrice"], $_POST["productAmount"], $_POST["duration"], $imgname, 0.0);
                    if ($id != false) {
                        foreach ($_POST["category"] as $category) {
                            $dbh->insertProductIsCategory($category, $id);
                        }
                        $templateParams["error"] = "Insertion successful";
                    } else {
                        $templateParams["error"] = "Insertion failed";
                    }
                } else {
                    $templateParams["error"] = $msg;
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
            $templateParams["admins"] = $dbh->getAdmins();
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

            // checkout
            if (isset($_POST["checkout-confirm"])) {
                if ($dbh->getCreditCard($_SESSION["username"])[0]["card_number"] == NULL) {
                    $templateParams["error"] = "You need to insert a card number in your account";
                } else {
                    $dbh->insertOrder($_SESSION["username"]);
                    $id_order = $dbh->getLastInsertId();
                    foreach ($templateParams["cart"] as $product) {
                        $dbh->insertIncludeOrder($product["id_product"], $id_order, $product["quantity"]);
                        $dbh->updateAmountLeft($product["id_product"], $product["quantity"]);

                        // notify admin if product is out of stock
                        $amountLeft = $dbh->getProduct($product["id_product"])[0]["amount_left"];
                        if ($amountLeft == 0) {
                            foreach ($templateParams["admins"] as $admin) {
                                $description = outOfStockMessageAdmin($admin["username"], $product["name"], $product["id_product"]);
                                $dbh->insertNotification("Product out of stock", $description, admin: $admin["username"]);
                            }
                        }
                    }
                    foreach ($templateParams["admins"] as $admin) {
                        $description = orderMessage($id_order, $_SESSION["username"], $templateParams["cart"]);
                        $dbh->insertNotification("New order", $description, admin: $admin["username"]);
                    }
                    $description = orderMessage($id_order, $_SESSION["username"], $templateParams["cart"]);
                    $dbh->insertNotification("New order", $description, username: $_SESSION["username"]);
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
                $templateParams["notifications"] = $dbh->getNotifications($_SESSION["username"]);
                if ($templateParams["notification-detail"][0]["seen"] == 0) {
                    $dbh->updateNotificationStatus(1, $templateParams["notification-detail"][0]["id_notification"]);
                }
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
        $templateParams["content"] = "home.php";
        $templateParams["products"] = $dbh->getTopProducts(6);
        $templateParams["categories"] = $dbh->getCategories(6);
}

require 'template/base.php';
?>