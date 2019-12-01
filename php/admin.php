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
    header('Location: ' . $_SERVER['HTTP_SERVER'] . '/pages/admin.php');
}

if(isset($_POST["removeGroups"])){
    $count = $_POST["removeGroups"];
    $i = 0;
    while($i < $count){
        if(isset($_POST['group' . $i]) && $_POST['group' . $i]){
            $groupId = $_POST['group' . $i];
            $query = "DELETE FROM groups WHERE id='$groupId'";
            mysqli_query($connection, $query);
        }
        $i++;
    }
    header('Location: ' . $_SERVER['HTTP_SERVER'] . '/pages/admin.php');
}

if(isset($_POST["saveResult"])){
    require_once "excelGenerator.php";
}
