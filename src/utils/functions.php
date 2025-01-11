<?php

// Add class "active" to navbar element (script version)
function isActiveScript($pagename)
{
    if (basename($_SERVER['PHP_SELF']) == $pagename) {
        echo " class='active' ";
    }
}

// Add class "active" to navbar element (query version)
function isActiveQuery($pagename)
{
    if (isset($_GET['page']) && $_GET['page'] == $pagename) {
        echo " class='active' ";
    }
}

function getIdFromName($name)
{
    return preg_replace("/[^a-z]/", '', strtolower($name));
}

function isUserLoggedIn()
{
    return isset($_SESSION["logged"]) && isset($_SESSION["admin"]) && $_SESSION["logged"] && !$_SESSION["admin"];
}

function isAdminLoggedIn()
{
    return isset($_SESSION["logged"]) && isset($_SESSION["admin"]) && $_SESSION["logged"] && $_SESSION["admin"];
}

function registerLoggedUser($user)
{
    $_SESSION["logged"] = true;
    $_SESSION["admin"] = false;
    $_SESSION["username"] = $user["username"];
    $_SESSION["name"] = $user["name"];
    $_SESSION["surname"] = $user["surname"];
    $_SESSION["email"] = $user["email"];
}

function registerAdminLogged($admin)
{
    $_SESSION["username"] = $admin["username"];
    $_SESSION["logged"] = true;
    $_SESSION["admin"] = true;
}

function logout()
{
    unset($_SESSION["logged"]);
    unset($_SESSION["admin"]);
    unset($_SESSION["username"]);
    unset($_SESSION["name"]);
    unset($_SESSION["surname"]);
    unset($_SESSION["email"]);
    unset($_SESSION["card_number"]);
}

function updateUser($templateParams)
{
    $_SESSION["name"] = $templateParams["userInfo"][0]["name"];
    $_SESSION["surname"] = $templateParams["userInfo"][0]["surname"];
    $_SESSION["email"] = $templateParams["userInfo"][0]["email"];
    $_SESSION["birthday"] = $templateParams["userInfo"][0]["birthday"];
    $_SESSION["card_number"] = $templateParams["userInfo"][0]["card_number"];
}

function getCartTotal($templateParams)
{
    $total = 0;
    foreach ($templateParams["cart"] as $product) {
        $total += $product["price"] * $product["quantity"];
    }
    return $total;
}

function generateOrderMessage($id_order, $username, $products)
{
    $message = "A new order has been placed with id " . $id_order . " by the user " . $username;
    $message .= "\nThe order will be delivered to the following address: " . "Via dell'università 50, Cesena, FC";
    foreach ($products as $product) {
        $total = $product["price"] * $product["quantity"];
        $message .= "\n" . $product["quantity"] . "x " . $product["name"] . " - " . $total . "€";
    }

    return $message;
}

// TODO: rewrite for empty product (only in the case we decide to opt for a separate edit page)
// function getEmptyArticle()
// {
//     return array("idarticolo" => "", "titoloarticolo" => "", "imgarticolo" => "", "testoarticolo" => "", "anteprimaarticolo" => "", "categorie" => array());
// }

// TODO: adapt it for product edit page (coupled with function above)
// function getAction($action)
// {
//     $result = "";
//     switch ($action) {
//         case 1:
//             $result = "Inserisci";
//             break;
//         case 2:
//             $result = "Modifica";
//             break;
//         case 3:
//             $result = "Cancella";
//             break;
//     }

//     return $result;
// }

function uploadImage($path, $image)
{
    $imageName = basename($image["name"]);
    $fullPath = $path . $imageName;

    $maxKB = 500;
    $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
    $result = 0;
    $msg = "";
    // Check if it's really an image
    $imageSize = getimagesize($image["tmp_name"]);
    if ($imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }
    // Check if image size < 500KB
    if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }

    // Check file extension
    $imageFileType = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $acceptedExtensions)) {
        $msg .= "Accettate solo le seguenti estensioni: " . implode(",", $acceptedExtensions);
    }

    // Check if a file with that name already exists, proceeds to rename it if found
    if (file_exists($fullPath)) {
        $i = 1;
        do {
            $i++;
            $imageName = pathinfo(basename($image["name"]), PATHINFO_FILENAME) . "_$i." . $imageFileType;
        }
        while (file_exists($path . $imageName));
        $fullPath = $path . $imageName;
    }

    // Check if there are errors, then move image from temp location to destination location
    if (strlen($msg) == 0) {
        if (!move_uploaded_file($image["tmp_name"], $fullPath)) {
            $msg .= "Errore nel caricamento dell'immagine.";
        } else {
            $result = 1;
            $msg = $imageName;
        }
    }
    return array($result, $msg);
}

?>