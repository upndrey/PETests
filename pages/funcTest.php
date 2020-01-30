<?
session_start();
if(!$_SESSION['login']){
    header('Location: ../');
}
if($_SESSION['funcTest'] == "1"){
    header('Location: tests.php');
}

require_once "../php/connection.php";
$resultQuestions = mysqli_query($connection, "(SELECT text FROM questions WHERE test_id=1)");
$resultAnswers = mysqli_query($connection, "(SELECT text FROM answer_variants WHERE test_id=1)");
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
    <link rel="stylesheet" href="../css/media.css">
</head>
<body>

<header class="tests-header">
    <div class="container">
        <h1>ТЕСТЫ ПО ФИЗКУЛЬТУРЕ</h1>
        <div class="tests-header-links">
            <a href="" class="username"><? echo $_SESSION['login']; ?></a>
            <a href="./tests.php" class="logout">Назад</a>
        </div>
    </div>
</header>
<div class="container tests">
    <form action="../php/sendFuncTest.php" method="post" class="funcTestForm">
        <div>
            <label for="chin-up">Подтягивания</label>
            <input id="chin-up" name="chin-up" type="number" placeholder="0" required />
        </div>
        <div>
            <label for="long-jump">Прыжок в длину</label>
            <input id="long-jump" name="long-jump" type="number" placeholder="0" required /><span> (см)</span>
        </div>
        <div>
            <label for="flexibility">Гибкость</label>
            <input id="flexibility" name="flexibility" type="number" placeholder="0" required /><span> (см)</span>
        </div>
        <div>
            <label for="abs">Пресс</label>
            <input id="abs" name="abs" type="number" placeholder="0" required />
        </div>
        <div>
            <label for="skipping-rope">Скакалка 1 мин.</label>
            <input id="skipping-rope" name="skipping-rope" type="number" placeholder="0" required />
        </div>
        <div>
            <label for="running">Бег 12 мин.</label>
            <input id="running" name="running" type="number" placeholder="0" required />
        </div>
        <input type="submit" value="Отправить" class="send-result">
    </form>
</div>

</body>
</html>