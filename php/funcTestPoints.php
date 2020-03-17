<?php
session_start();
if(!$_SESSION['login']){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if(!$_POST['test']){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

// chin_up
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


// long_jump
$long_jump_points = 0;
if($long_jump >= 255)
    $long_jump_points = 100;
else if($long_jump >= 254)
    $long_jump_points = 97;
else if($long_jump >= 253)
    $long_jump_points = 94;
else if($long_jump >= 252)
    $long_jump_points = 91;
else if($long_jump >= 251)
    $long_jump_points = 89;
else if($long_jump >= 250)
    $long_jump_points = 87;
else if($long_jump >= 249)
    $long_jump_points = 79;
else if($long_jump >= 248)
    $long_jump_points = 78;
else if($long_jump >= 247)
    $long_jump_points = 77;
else if($long_jump >= 246)
    $long_jump_points = 76;
else if($long_jump >= 245)
    $long_jump_points = 75;
else if($long_jump >= 243)
    $long_jump_points = 71;
else if($long_jump >= 242)
    $long_jump_points = 67;
else if($long_jump >= 241)
    $long_jump_points = 64;
else if($long_jump >= 240)
    $long_jump_points = 62;
else if($long_jump >= 239)
    $long_jump_points = 60;
else if($long_jump >= 238)
    $long_jump_points = 57;
else if($long_jump >= 237)
    $long_jump_points = 54;
else if($long_jump >= 236)
    $long_jump_points = 51;
else if($long_jump >= 235)
    $long_jump_points = 49;
else if($long_jump >= 234)
    $long_jump_points = 46;
else if($long_jump >= 233)
    $long_jump_points = 43;
else if($long_jump >= 232)
    $long_jump_points = 41;
else if($long_jump >= 231)
    $long_jump_points = 39;
else if($long_jump >= 230)
    $long_jump_points = 37;
else if($long_jump >= 229)
    $long_jump_points = 35;
else if($long_jump >= 228)
    $long_jump_points = 33;
else if($long_jump >= 227)
    $long_jump_points = 31;
else if($long_jump >= 226)
    $long_jump_points = 28;
else if($long_jump >= 225)
    $long_jump_points = 25;
else if($long_jump >= 224)
    $long_jump_points = 22;
else if($long_jump >= 223)
    $long_jump_points = 18;
else if($long_jump >= 222)
    $long_jump_points = 17;
else if($long_jump >= 221)
    $long_jump_points = 16;
else if($long_jump >= 220)
    $long_jump_points = 15;
else if($long_jump >= 219)
    $long_jump_points = 14;
else if($long_jump >= 218)
    $long_jump_points = 12;
else if($long_jump >= 217)
    $long_jump_points = 10;
else if($long_jump >= 216)
    $long_jump_points = 8;
else if($long_jump >= 215)
    $long_jump_points = 6;
else if($long_jump >= 214)
    $long_jump_points = 5;
else if($long_jump >= 213)
    $long_jump_points = 4;
else if($long_jump >= 212)
    $long_jump_points = 3;
else if($long_jump >= 211)
    $long_jump_points = 2;
else if($long_jump >= 210)
    $long_jump_points = 1;

// flexibility
$flexibility_points = 0;
if($flexibility >= 28.0)
    $flexibility_points = 100;
else if($flexibility >= 27.5)
    $flexibility_points = 99;
$flex_points_counter = 98;
$endFlag = 0;
while($endFlag == 0){
    for($i = 27.0; $i > 9.0; $i -= 0.5) {
        if($flexibility >= $i){
            $flexibility_points = $flex_points_counter;
            $endFlag = 1;
            break;
        }
        $flex_points_counter -= 2;
    }
    if($endFlag)
        break;
    for($i = 9.0; $i >= -7.0; $i -= 0.5) {
        if($flexibility >= $i) {
            $flexibility_points = $flex_points_counter;
            $endFlag = 1;
            break;
        }
        $flex_points_counter -= 1;
    }
    $endFlag = 1;
}

// abs
$abs_points = 0;
if($abs >= 65)
    $abs_points = 100;
else if($abs >= 64)
    $abs_points = 98;
$abs_points_counter = 96;
$endFlag = 0;
while($endFlag == 0){
    for($i = 63; $i > 57; $i--) {
        if($abs >= $i){
            $abs_points = $abs_points_counter;
            $endFlag = 1;
            break;
        }
        $abs_points_counter -= 3;
    }
    if($endFlag)
        break;
    for($i = 57; $i > 50; $i--) {
        if($abs >= $i){
            $abs_points = $abs_points_counter;
            $endFlag = 1;
            break;
        }
        $abs_points_counter -= 2;
    }
    if($endFlag)
        break;
    for($i = 50; $i > 43; $i--) {
        if($abs >= $i){
            $abs_points = $abs_points_counter;
            $endFlag = 1;
            break;
        }
        $abs_points_counter -= 3;
    }
    if($endFlag)
        break;
    for($i = 43; $i > 31; $i--) {
        if($abs >= $i){
            $abs_points = $abs_points_counter;
            $endFlag = 1;
            break;
        }
        $abs_points_counter -= 2;
    }
    if($endFlag)
        break;
    for($i = 31; $i > 0; $i--) {
        if($abs >= $i){
            $abs_points = $abs_points_counter;
            $endFlag = 1;
            break;
        }
        $abs_points_counter -= 1;
    }
    $endFlag = 1;
}

// skipping_rope
$skipping_rope_points = 0;
$skipping_rope_points_counter = 100;
$endFlag = 0;
while($endFlag == 0){
    for($i = 190; $i > 120; $i--) {
        if($skipping_rope >= $i){
            $skipping_rope_points = $skipping_rope_points_counter;
            $endFlag = 1;
            break;
        }
        $skipping_rope_points_counter -= 1;
    }
    if($endFlag)
        break;
    for($i = 120; $i > 100; $i -= 2) {
        if($skipping_rope >= $i){
            $skipping_rope_points = $skipping_rope_points_counter;
            $endFlag = 1;
            break;
        }
        $skipping_rope_points_counter -= 1;
    }
    if($endFlag)
        break;
    for($i = 100; $i > 0; $i -= 4) {
        if($skipping_rope >= $i){
            $skipping_rope_points = $skipping_rope_points_counter;
            $endFlag = 1;
            break;
        }
        $skipping_rope_points_counter -= 1;
    }
    $endFlag = 1;
}


// running
$running_points = 0;
$running_points_counter = 100;
$endFlag = 0;
while($endFlag == 0){
    for($i = 3130; $i > 3000; $i -= 10) {
        if($running >= $i){
            $running_points = $running_points_counter;
            $endFlag = 1;
            break;
        }
        $running_points_counter -= 1;
    }
    if($endFlag)
        break;
    for($i = 3000; $i > 2700; $i -= 15) {
        if($running >= $i){
            $running_points = $running_points_counter;
            $endFlag = 1;
            break;
        }
        $running_points_counter -= 1;
    }
    if($endFlag)
        break;
    for($i = 2700; $i > 2600; $i -= 20) {
        if($running >= $i){
            $running_points = $running_points_counter;
            $endFlag = 1;
            break;
        }
        $running_points_counter -= 1;
    }
    if($endFlag)
        break;
    for($i = 2600; $i > 2300; $i -= 15) {
        if($running >= $i){
            $running_points = $running_points_counter;
            $endFlag = 1;
            break;
        }
        $running_points_counter -= 1;
    }
    if($endFlag)
        break;
    for($i = 2300; $i > 2200; $i -= 20) {
        if($running >= $i){
            $running_points = $running_points_counter;
            $endFlag = 1;
            break;
        }
        $running_points_counter -= 1;
    }
    if($endFlag)
        break;
    for($i = 2200; $i > 2020; $i -= 15) {
        if($running >= $i){
            $running_points = $running_points_counter;
            $endFlag = 1;
            break;
        }
        $running_points_counter -= 1;
    }
    if($endFlag)
        break;
    for($i = 2020; $i > 1780; $i -= 10) {
        if($running >= $i){
            $running_points = $running_points_counter;
            $endFlag = 1;
            break;
        }
        $running_points_counter -= 1;
    }
    $endFlag = 1;
}

// result
$result_points = $chin_up_points +
    $long_jump_points +
    $flexibility_points +
    $abs_points +
    $skipping_rope_points +
    $running_points;
$result_points /= 6;