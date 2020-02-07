<?php
require_once "./connection.php";
$login = $_POST['login'];
$login = mysqli_real_escape_string($connection, $login);

$result = mysqli_query($connection, "(SELECT id FROM users WHERE login='$login')");
$result =  mysqli_fetch_array($result);
if(!$result){
    $_SESSION['message'] = "";
    $pass = $_POST['pass'];
    $pass = mysqli_real_escape_string($connection, $pass);
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $group = $_POST['group'];
    $group = mysqli_real_escape_string($connection, $group);

    $firstName = $_POST['firstName'];
    $firstName = mysqli_real_escape_string($connection, $firstName);

    $lastName = $_POST['lastName'];
    $lastName = mysqli_real_escape_string($connection, $lastName);

    $sex = $_POST['sex'];
    $sex = mysqli_real_escape_string($connection, $sex);

    $query = "INSERT INTO users (login, password, group_name, firstName, lastName, sex) VALUES ('$login', '$hash', '$group', '$firstName', '$lastName', '$sex')";
    mysqli_query($connection, $query);
    session_start();
    $_SESSION['login'] = $login;
    if($login == "admin")
        header('Location: /pages/admin.php');
    else
        header('Location: /pages/tests.php');
    exit;
}
else{
    session_start();
    $_SESSION['message'] = "Аккаунт с таким именем уже существует";
    header('Location: ../index.php');
}
?>