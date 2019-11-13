<?
session_start();
if(!$_SESSION['login']){
    header('Location: ../');
}
require_once "../php/connection.php";
$login = $_SESSION['login'];
$query = "(SELECT id FROM users WHERE login='$login')";
$resultLoginId = mysqli_query($connection, $query);
$loginId = mysqli_fetch_array($resultLoginId);

$query = "(SELECT test_id FROM results WHERE user_id='$loginId[0]')";
$resultTestId = mysqli_query($connection, $query);
$testId = mysqli_fetch_array($resultTestId);
$isFirstDone = $isSecondDone = $isThirdDone = 0;
for($i = 0; $i < count($testId); $i++){
    if($testId[$i][0] == 1){
        $isFirstDone = 1;
        $_SESSION['test1'] = 1;
    }
    else if($testId[$i][0] == 2){
        $isSecondDone = 1;
        $_SESSION['test2'] = 1;
    }
    else if($testId[$i][0] == 3){
        $isThirdDone = 1;
        $_SESSION['test3'] = 1;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Physical Education Tests</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap&subset=cyrillic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed&display=swap&subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>
<header class="tests-header">
    <div class="container">
        <h1>ТЕСТЫ ПО ФИЗКУЛЬТУРЕ</h1>
        <div class="tests-header-links">
            <a href="" class="username"><? echo $login; ?></a>
            <a href="../" class="logout">Выход</a>
        </div>
    </div>
</header>
<div class="container tests">
    <h2>Выберите тест:</h2>
    <a href="test1.php" class="test-link <? if($isFirstDone) echo " test-done" ?>">Тест 1</a>
    <a href="test2.php" class="test-link <? if($isSecondDone) echo " test-done" ?>">Тест 2</a>
    <a href="test3.php" class="test-link <? if($isThirdDone) echo " test-done" ?>">Тест 3</a>
    <div class="test-help">
        Пройденные тесты будут отмечены <span class="special-color">специальным цветом</span>, дважды один тест пройти нельзя.
    </div>
</div>

<script src="../scripts/index.js"></script>
</body>
</html>