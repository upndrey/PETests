<?
session_start();
if(!$_SESSION['login']){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if(!$_POST['test']){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

require_once "../php/funcTestPoints.php";
require_once "../php/connection.php";
$login = $_SESSION['login'];
$query = "(SELECT id FROM users WHERE login='$login')";
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

$chin_up = $_POST['chin-up'];
$long_jump = $_POST['long-jump'];
$flexibility = $_POST['flexibility'];
$abs = $_POST['abs'];
$skipping_rope = $_POST['skipping-rope'];
$running = $_POST['running'];


$date = getdate();
$dateResult = $date['mday'] . "." . $date['mon'] . "." . $date['year'];
//Записываем нормативы в результат
$query = "INSERT INTO func_test_points (user_id, block_id, chin_up, long_jump, flexibility, abs, skipping_rope, running, date, result) VALUES ('$loginId[0]', '$block_id', '$chin_up', '$long_jump', '$flexibility', '$abs', '$skipping_rope', '$running', '$dateResult')";
$query = "INSERT INTO func_test (user_id, block_id, chin_up, long_jump, flexibility, abs, skipping_rope, running, date) VALUES ('$loginId[0]', '$block_id', '$chin_up', '$long_jump', '$flexibility', '$abs', '$skipping_rope', '$running', '$dateResult')";
mysqli_query($connection, $query);

header('Location: ' . $_SERVER['HTTP_SERVER'] . '/pages/tests.php');
?>
