<?php
session_start();
define("UPLOAD_DIR", "./upload/");
define("SCRIPTS_DIR", "./js/");
require_once("utils/functions.php");
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "e-lixirium", 3306);
?>