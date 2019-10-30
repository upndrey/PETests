<?php
require_once "./connection.php";
$login = $_POST['login'];
$pass = $_POST['pass'];
$result = mysqli_query($connection, "(SELECT id FROM users WHERE login='$login' AND password='$pass')");
$rows = mysqli_fetch_array($result);
if($rows){
    header('Location: tests.php');
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>