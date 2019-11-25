<?php
require_once "./connection.php";
$login = $_POST['login'];
$login = mysqli_real_escape_string($connection, $login);

$result = mysqli_query($connection, "(SELECT id FROM users WHERE login='$login')");
$result =  mysqli_fetch_array($result);
if(!$result){
    $pass = $_POST['pass'];
    $pass = mysqli_real_escape_string($connection, $pass);

    $group = $_POST['group'];
    $group = mysqli_real_escape_string($connection, $group);

    $firstName = $_POST['firstName'];
    $firstName = mysqli_real_escape_string($connection, $firstName);

    $lastName = $_POST['lastName'];
    $lastName = mysqli_real_escape_string($connection, $lastName);

    $query = "INSERT INTO users (login, password, group_name, firstName, lastName) VALUES ('$login', '$pass', '$group', '$firstName', '$lastName')";
    mysqli_query($connection, $query);
    session_start();
    $_SESSION['login'] = $login;
    header('Location: ' . $_SERVER['HTTP_REFERER'] . 'pages/tests.php');
}
else
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>