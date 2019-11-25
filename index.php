<?
session_start();
if($_SESSION['login'] != NULL){
    $_SESSION['login'] = NULL;
    $_SESSION['test1'] = NULL;
    $_SESSION['test2'] = NULL;
    $_SESSION['test3'] = NULL;
}

require_once "./php/connection.php";
require_once "partials/header.php";
require_once "partials/main.php";
require_once "partials/footer.php";
?>