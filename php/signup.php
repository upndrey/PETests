<?php
require_once "./connection.php";
$login = $_POST['rLogin'];
$result = mysqli_query($connection, "(SELECT id FROM users WHERE login='$login')");
if(!$result){
    $pass = $_POST['rPass'];
    mysqli_query($connection, "INSERT INTO users (login, password) VALUES ('$login', '$pass')");
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>