<?php

session_start();

if(!$_SESSION['login'] || $_SESSION['login'] != 'admin'){
    header('Location: ../');
}

require_once "../php/connection.php";


$query = "(SELECT * FROM health)";
$resultHealth = mysqli_query($connection, $query);

while($health = mysqli_fetch_array($resultHealth)) {
    $query = "(SELECT id, sex FROM users WHERE id='$health[1]')";
    $resultLoginId = mysqli_query($connection, $query);
    $loginId = mysqli_fetch_array($resultLoginId);

    $id = $health[0];
    $weight = $health[3];
    $height = $health[4];
    $lung_capacity = $health[5];
    $dynamo = $health[6];
    $heart_rate = $health[7];
    $arterial_press = $health[8];
    $recovery = $health[9];
    $stat = [0, 0, 0, 0, 0];

    $temp =  round( $weight / ($height * $height), 1);
    if($loginId[1] == "мужской"){
        if($temp >= 28.1)
            $stat[0] = -2;
        elseif($temp >= 25.1)
            $stat[0] = -1;
        elseif($temp >= 20.1)
            $stat[0] = 0;
        elseif($temp > 18.9)
            $stat[0] = -1;
        elseif($temp <= 18.9)
            $stat[0] = -2;
    }
    else{
        if($temp >= 26.1)
            $stat[0] = -2;
        elseif($temp >= 23.9)
            $stat[0] = -1;
        elseif($temp >= 18.1)
            $stat[0] = 0;
        elseif($temp > 16.9)
            $stat[0] = -1;
        elseif($temp <= 16.9)
            $stat[0] = -2;
    }

    $temp =  round( $lung_capacity / $weight, 1);
    if($loginId[1] == "мужской"){
        if($temp >= 66)
            $stat[1] = 3;
        elseif($temp >= 61)
            $stat[1] = 2;
        elseif($temp >= 56)
            $stat[1] = 1;
        elseif($temp > 50)
            $stat[1] = 0;
        elseif($temp <= 50)
            $stat[1] = -1;
    }
    else{
        if($temp >= 56)
            $stat[1] = 3;
        elseif($temp >= 51)
            $stat[1] = 2;
        elseif($temp >= 46)
            $stat[1] = 1;
        elseif($temp > 40)
            $stat[1] = 0;
        elseif($temp <= 40)
            $stat[1] = -1;
    }

    $temp =  round( $dynamo * 100 / $weight, 1);
    if($loginId[1] == "мужской"){
        if($temp >= 81)
            $stat[2] = 3;
        elseif($temp >= 71)
            $stat[2] = 2;
        elseif($temp >= 66)
            $stat[2] = 1;
        elseif($temp > 60)
            $stat[2] = 0;
        elseif($temp <= 60)
            $stat[2] = -1;
    }
    else{
        if($temp >= 61)
            $stat[2] = 3;
        elseif($temp >= 56)
            $stat[2] = 2;
        elseif($temp >= 51)
            $stat[2] = 1;
        elseif($temp > 40)
            $stat[2] = 0;
        elseif($temp <= 40)
            $stat[2] = -1;
    }

    $temp =  round($heart_rate * $arterial_press / 100, 1);
    if($loginId[1] == "мужской"){
        if($temp <= 70)
            $stat[3] = 5;
        elseif($temp <= 85)
            $stat[3] = 3;
        elseif($temp <= 95)
            $stat[3] = 0;
        elseif($temp < 111)
            $stat[3] = -1;
        elseif($temp >= 111)
            $stat[3] = -2;
    }
    else{
        if($temp <= 70)
            $stat[3] = 5;
        elseif($temp <= 85)
            $stat[3] = 3;
        elseif($temp <= 95)
            $stat[3] = 0;
        elseif($temp < 111)
            $stat[3] = -1;
        elseif($temp >= 111)
            $stat[3] = -2;
    }

    $temp = $recovery;
    if($loginId[1] == "мужской"){
        if($temp <= 60)
            $stat[4] = 7;
        elseif($temp <= 90)
            $stat[4] = 5;
        elseif($temp <= 120)
            $stat[4] = 3;
        elseif($temp <= 180)
            $stat[4] = 1;
        elseif($temp > 180)
            $stat[4] = -2;
    }
    else{
        if($temp <= 60)
            $stat[4] = 7;
        elseif($temp <= 90)
            $stat[4] = 5;
        elseif($temp <= 120)
            $stat[4] = 3;
        elseif($temp <= 180)
            $stat[4] = 1;
        elseif($temp > 180)
            $stat[4] = -2;
    }
    $result = $stat[0] + $stat[1] + $stat[2] + $stat[3] + $stat[4];


    $query = "UPDATE health SET result='$result' WHERE id='$id'";
    mysqli_query($connection, $query);
}
header('Location: ' . $_SERVER['HTTP_SERVER'] . '/pages/admin.php');