<?php

session_start();

if(!$_SESSION['login'] || $_SESSION['login'] != 'admin'){
    header('Location: ../');
}

require_once "connection.php";

$query = "(SELECT id, result FROM health)";
$resultHealth = mysqli_query($connection, $query);
while($funcHealthPoints = mysqli_fetch_array($resultHealth)) {
    $result_100 = 0;
    $result_counter = 18.6;
    for($i = 100; $i >= 1; $i--) {
        if($funcHealthPoints[1] >= $result_counter) {
            $result_100 = $i;
            break;
        }

        $result_counter -= 0.2;
        $i--;
        if($funcHealthPoints[1] >= $result_counter) {
            $result_100 = $i;
            break;
        }

        $result_counter -= 0.3;
        $i--;
        if($funcHealthPoints[1] >= $result_counter) {
            $result_100 = $i;
            break;
        }

        $result_counter -= 0.2;
    }
    $query = "UPDATE health SET result_100 = '$result_100' WHERE id = '$funcHealthPoints[0]'";
    mysqli_query($connection, $query);
}
header('Location: ' . $_SERVER['HTTP_SERVER'] . '/pages/admin.php');