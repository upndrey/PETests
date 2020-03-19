<?php

session_start();

if(!$_SESSION['login'] || $_SESSION['login'] != 'admin'){
    header('Location: ../');
}

require_once "connection.php";

$query = "(SELECT * FROM func_test)";
$resultFuncTest = mysqli_query($connection, $query);
while($funcTestInfo = mysqli_fetch_array($resultFuncTest)) {
    $loginId = $funcTestInfo[1];
    $block_id = $funcTestInfo[2];
    $chin_up = $funcTestInfo[3];
    $long_jump = $funcTestInfo[4];
    $flexibility = $funcTestInfo[5];
    $abs = $funcTestInfo[6];
    $skipping_rope = $funcTestInfo[7];
    $running = $funcTestInfo[8];
    $dateResult = $funcTestInfo[9];
    require "funcTestPoints.php";
    $query = "INSERT INTO func_test_points (user_id, block_id, chin_up, long_jump, flexibility, abs, skipping_rope, running, date, result) VALUES ('$loginId', '$block_id', '$chin_up_points', '$long_jump_points', '$flexibility_points', '$abs_points', '$skipping_rope_points', '$running_points', '$dateResult', '$result_points')";
    mysqli_query($connection, $query);
}
header('Location: ' . $_SERVER['HTTP_SERVER'] . '/pages/admin.php');