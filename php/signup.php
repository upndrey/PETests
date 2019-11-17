<?php
require_once "./connection.php";
$login = $_POST['login'];
$login = mysqli_real_escape_string($connection, $login);

$result = mysqli_query($connection, "(SELECT id FROM users WHERE login='$login')");
$result =  mysqli_fetch_array($result);
if(!$result){
    $pass = $_POST['pass'];
    $pass = mysqli_real_escape_string($connection, $pass);
    $query = "INSERT INTO results (user_id, test_id, points) VALUES ('$loginId[0]', $testId, '$weightsSum')";
    $query = "INSERT INTO users (login, password) VALUES ('$login', '$pass')";
    mysqli_query($connection, $query);
    header('Location: ' . $_SERVER['HTTP_REFERER'] . 'pages/tests.php');
}
else
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>