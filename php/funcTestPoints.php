<?php
session_start();
if(!$_SESSION['login']){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if(!$_POST['test']){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$flexibility_points;
$abs_points;
$skipping_rope_points;
$running_points;
$result_points;

$chin_up_points = 0;
if($chin_up >= 17)
    $chin_up_points = 100;
else if($chin_up >= 16)
    $chin_up_points = 93;
else if($chin_up >= 15)
    $chin_up_points = 87;
else if($chin_up >= 14)
    $chin_up_points = 79;
else if($chin_up >= 13)
    $chin_up_points = 72;
else if($chin_up >= 12)
    $chin_up_points = 64;
else if($chin_up >= 11)
    $chin_up_points = 56;
else if($chin_up >= 10)
    $chin_up_points = 46;
else if($chin_up >= 9)
    $chin_up_points = 37;
else if($chin_up >= 8)
    $chin_up_points = 28;
else if($chin_up >= 7)
    $chin_up_points = 18;
else if($chin_up >= 6)
    $chin_up_points = 12;
else if($chin_up >= 5)
    $chin_up_points = 6;
else if($chin_up >= 4)
    $chin_up_points = 5;
else if($chin_up >= 3)
    $chin_up_points = 4;
else if($chin_up >= 2)
    $chin_up_points = 3;
else if($chin_up >= 1)
    $chin_up_points = 2;

$long_jump_points = 0;
if($chin_up >= 255)
    $chin_up_points = 100;
else if($chin_up >= 254)
    $chin_up_points = 97;
else if($chin_up >= 253)
    $chin_up_points = 94;
else if($chin_up >= 252)
    $chin_up_points = 91;
else if($chin_up >= 251)
    $chin_up_points = 89;
else if($chin_up >= 250)
    $chin_up_points = 87;
else if($chin_up >= 249)
    $chin_up_points = 79;
else if($chin_up >= 248)
    $chin_up_points = 78;
else if($chin_up >= 247)
    $chin_up_points = 77;
else if($chin_up >= 246)
    $chin_up_points = 76;
else if($chin_up >= 245)
    $chin_up_points = 75;
else if($chin_up >= 243)
    $chin_up_points = 71;
else if($chin_up >= 242)
    $chin_up_points = 67;
else if($chin_up >= 241)
    $chin_up_points = 64;
else if($chin_up >= 240)
    $chin_up_points = 62;
else if($chin_up >= 239)
    $chin_up_points = 60;
else if($chin_up >= 238)
    $chin_up_points = 57;
else if($chin_up >= 237)
    $chin_up_points = 54;
else if($chin_up >= 236)
    $chin_up_points = 51;
else if($chin_up >= 235)
    $chin_up_points = 49;
else if($chin_up >= 234)
    $chin_up_points = 46;
else if($chin_up >= 233)
    $chin_up_points = 43;
else if($chin_up >= 232)
    $chin_up_points = 41;
else if($chin_up >= 231)
    $chin_up_points = 39;
else if($chin_up >= 230)
    $chin_up_points = 37;
else if($chin_up >= 229)
    $chin_up_points = 35;
else if($chin_up >= 228)
    $chin_up_points = 33;
else if($chin_up >= 227)
    $chin_up_points = 31;
else if($chin_up >= 226)
    $chin_up_points = 28;
else if($chin_up >= 225)
    $chin_up_points = 25;
else if($chin_up >= 224)
    $chin_up_points = 22;
else if($chin_up >= 223)
    $chin_up_points = 18;
else if($chin_up >= 222)
    $chin_up_points = 17;
else if($chin_up >= 221)
    $chin_up_points = 16;
else if($chin_up >= 220)
    $chin_up_points = 15;
else if($chin_up >= 219)
    $chin_up_points = 14;
else if($chin_up >= 218)
    $chin_up_points = 12;
else if($chin_up >= 217)
    $chin_up_points = 10;
else if($chin_up >= 216)
    $chin_up_points = 8;
else if($chin_up >= 215)
    $chin_up_points = 6;
else if($chin_up >= 214)
    $chin_up_points = 5;
else if($chin_up >= 213)
    $chin_up_points = 4;
else if($chin_up >= 212)
    $chin_up_points = 3;
else if($chin_up >= 211)
    $chin_up_points = 2;
else if($chin_up >= 210)
    $chin_up_points = 1;