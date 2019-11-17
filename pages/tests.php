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
$isFirstDone = $isSecondDone = $isThirdDone = 0;
while($testId = mysqli_fetch_array($resultTestId)){
    if($testId[0] == 1){
        $isFirstDone = 1;
        $_SESSION['test1'] = 1;
        $query = "(SELECT id FROM users WHERE login='$login')";
        $resultUserId = mysqli_query($connection, $query);
        $userId = mysqli_fetch_array($resultUserId);

        $query = "(SELECT points FROM results WHERE user_id='$userId[0]' AND test_id=1)";
        $resultPoints = mysqli_query($connection, $query);
        $points1 = mysqli_fetch_array($resultPoints);
    }
    else if($testId[0] == 2){
        $isSecondDone = 1;
        $_SESSION['test2'] = 1;
        $query = "(SELECT id FROM users WHERE login='$login')";
        $resultUserId = mysqli_query($connection, $query);
        $userId = mysqli_fetch_array($resultUserId);

        $query = "(SELECT points FROM results WHERE user_id='$userId[0]' AND test_id=2)";
        $resultPoints = mysqli_query($connection, $query);
        $points2 = mysqli_fetch_array($resultPoints);
    }
    else if($testId[0] == 3){
        $isThirdDone = 1;
        $_SESSION['test3'] = 1;
        $query = "(SELECT id FROM users WHERE login='$login')";
        $resultUserId = mysqli_query($connection, $query);
        $userId = mysqli_fetch_array($resultUserId);

        $query = "(SELECT points FROM results WHERE user_id='$userId[0]' AND test_id=3)";
        $resultPoints = mysqli_query($connection, $query);
        $points3 = mysqli_fetch_array($resultPoints);
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
    <? if($isFirstDone) echo "<div class='test-done-after'>Тест пройден, ваши баллы: " . $points1[0] . "</div>" ?>
    <a href="test2.php" class="test-link <? if($isSecondDone) echo " test-done" ?>">Тест 2</a>
    <? if($isSecondDone) echo "<div class='test-done-after'>Тест пройден, ваши баллы: " . $points2[0] . "</div>" ?>
    <a href="test3.php" class="test-link <? if($isThirdDone) echo " test-done" ?>">Тест 3</a>
    <? if($isThirdDone) echo "<div class='test-done-after'>Тест пройден.</div>" ?>
    <div class="test-help">
        Пройденные тесты будут отмечены <span class="special-color">специальным цветом</span>, дважды один тест пройти нельзя.
    </div>
</div>

<script src="../scripts/index.js"></script>
</body>
</html>