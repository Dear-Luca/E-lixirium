<?php
session_start();
define("UPLOAD_DIR", "./upload/");
define("SCRIPTS_DIR", "./js/");
require_once("utils/functions.php");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "e-lixirium", 3306);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>