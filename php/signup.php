<?php
require_once "./connection.php";
$login = $_POST['login'];
$login = mysqli_real_escape_string($connection, $login);

$result = mysqli_query($connection, "(SELECT id FROM users WHERE login='$login')");
$result =  mysqli_fetch_array($result);
$pass = $_POST['pass'];
if(!$result){
    $pass = mysqli_real_escape_string($connection, $pass);
    mysqli_query($connection, "INSERT INTO users (login, password) VALUES ('$login', '$pass')");
    header('Location: ' . $_SERVER['HTTP_REFERER'] . 'pages/tests.php');
}
else
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>