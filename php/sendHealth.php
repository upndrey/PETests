<?
session_start();
if(!$_SESSION['login']){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if(!$_POST['test']){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

require_once "../php/connection.php";
$login = $_SESSION['login'];
$query = "(SELECT id, sex FROM users WHERE login='$login')";
$resultLoginId = mysqli_query($connection, $query);

$loginId = mysqli_fetch_array($resultLoginId);

$date = getdate();
$block_id = 1;
for(; $block_id <= 8; $block_id++){
    $query = "(SELECT dateStart, dateEnd FROM blocks WHERE id='$block_id')";
    $resultDate = mysqli_query($connection, $query);
    $rowDate = mysqli_fetch_array($resultDate);

    $currDate = date_create()->format('U');
    $dateStart = date_create_from_format ("d.m.Y", $rowDate[0])->format('U');
    $dateEnd = date_create_from_format ("d.m.Y", $rowDate[1])->format('U');

    if($currDate <= $dateEnd)
        break;
}

$weight = $_POST['weight'];
$height = $_POST['height'];
$lung_capacity = $_POST['lung-capacity'];
$dynamo = $_POST['dynamo'];
$heart_rate = $_POST['heart-rate'];
$arterial_press = $_POST['arterial-press'];
$recovery = $_POST['recovery'];
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

$result_100 = 0;
$result_counter = 18.6;
for($i = 100; $i >= 1; $i--) {
    if($result >= $result_counter) {
        $result_100 = $i;
        break;
    }

    $result_counter -= 0.2;
    $i--;
    if($result >= $result_counter) {
        $result_100 = $i;
        break;
    }

    $result_counter -= 0.3;
    $i--;
    if($result >= $result_counter) {
        $result_100 = $i;
        break;
    }

    $result_counter -= 0.2;
}

$date = getdate();
$dateResult = $date['mday'] . "." . $date['mon'] . "." . $date['year'];
//Записываем нормативы в результат
$query = "INSERT INTO health (user_id, block_id, weight, height, lung_capacity, dynamo, heart_rate, arterial_press, recovery, result, date, result_100) VALUES ('$loginId[0]', '$block_id', '$weight', '$height', '$lung_capacity', '$dynamo', '$heart_rate', '$arterial_press', '$recovery', '$result', '$dateResult', '$result_100')";
mysqli_query($connection, $query);

header('Location: ' . $_SERVER['HTTP_SERVER'] . '/pages/tests.php');
?>
