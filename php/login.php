<?php
require_once "./connection.php";
$login = $_POST['login'];
$login = mysqli_real_escape_string($connection, $login);
$pass = $_POST['pass'];
$pass = mysqli_real_escape_string($connection, $pass);
$result = mysqli_query($connection, "(SELECT password FROM users WHERE login='$login')");
$hash = mysqli_fetch_array($result);
if(password_verify($pass, $hash[0])){
    session_start();
    $_SESSION['login'] = $login;
    if($login == "admin")
        header('Location: /pages/admin.php');
    else
        header('Location: /pages/tests.php');
    exit;
}
else
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>