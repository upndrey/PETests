<?
session_start();
if(!$_SESSION['login']){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$i = 0;
do{
    $result[$i] = $_POST['answer' . $i];
    $i++;
}while($result[$i - 1]);

for($i = 0; $i < count($result); $i++){
    $result[$i] = explode("_", $result[$i]);
}
require_once "../php/connection.php";

$login = $_SESSION['login'];
$query = "(SELECT id FROM users WHERE login='$login')";
$resultLoginId = mysqli_query($connection, $query);

$loginId = mysqli_fetch_array($resultLoginId);
$testId = $_POST['test'];
$weights = [];
for($i = 0; $i < count($result); $i++){
    $result[$i][0] = (int)$result[$i][0] + 1;
    $temp = $result[$i];
    // Считываем id варианта ответа из вариантов ответов.
    $query = "(SELECT id FROM answer_variants WHERE question_id='$temp[0]' AND test_id='$testId' AND variant='$temp[1]')";
    $resultAnswerid = mysqli_query($connection, $query);
    $answerIds[$i] = mysqli_fetch_array($resultAnswerid);


    // Считываем weights из вариантов ответов.
    $query = "(SELECT weight FROM answer_variants WHERE question_id='$temp[0]' AND test_id='$testId' AND variant='$temp[1]')";
    $resultWeights = mysqli_query($connection, $query);
    $weights[$i] = mysqli_fetch_array($resultWeights);
}
$weightsSum = 0;
for($i = 0; $i < count($weights); $i++){
    $tempWeights = $weights[$i];
    if($tempWeights[0])
        $weightsSum += $tempWeights[0];
}

//Записываем сумму баллов в результат
$query = "INSERT INTO results (user_id, test_id, points) VALUES ('$loginId[0]', $testId, '$weightsSum')";
mysqli_query($connection, $query);

for($i = 0; $i < count($answerIds); $i++){
    $tempAnswerId = $answerIds[$i];
    //Записываем варианты ответов пользователя
    $query = "INSERT INTO answers (user_id, answer_variant_id) VALUES ('$loginId[0]', '$tempAnswerId[0]')";
    mysqli_query($connection, $query);
}



header('Location: ' . $_SERVER['HTTP_SERVER'] . '/pages/tests.php');
?>
