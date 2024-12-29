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
    return !empty($_SESSION["username"]);
}

function registerLoggedUser($user)
{
    $_SESSION["username"] = $user["username"];
    $_SESSION["name"] = $user["name"];
    $_SESSION["surname"] = $user["surname"];
    $_SESSION["email"] = $user["email"];
}

function logout(){
    unset($_SESSION["username"]);
    unset($_SESSION["name"]);
    unset($_SESSION["surname"]);
    unset($_SESSION["email"]);
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