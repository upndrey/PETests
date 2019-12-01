<?php

session_start();

if(!$_SESSION['login'] || $_SESSION['login'] != 'admin'){
    header('Location: ../');
}

require_once "../php/connection.php";

if(isset($_POST["groupName"])){
    $group = $_POST['groupName'];
    $query = "(SELECT id FROM groups WHERE name='$group')";
    $result = mysqli_query($connection, $query);
    $ids = mysqli_fetch_array($result);
    if(!$ids){
        $query = "INSERT INTO groups (name) VALUES ('$group')";
        mysqli_query($connection, $query);
    }
}

if(isset($_POST["saveResult"])){
    require_once "excelGenerator.php";
}

//header('Location: ' . $_SERVER['HTTP_SERVER'] . '/pages/admin.php');