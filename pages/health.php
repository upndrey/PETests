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
            <label for="weight">Вес (кг)</label>
            <input id="weight" name="weight" type="number" placeholder="0" required />
        </div>
        <div>
            <label for="height">Рост (м)</label>
            <input id="height" name="height" type="number" placeholder="1.75" required /><span> (см)</span>
        </div>
        <div>
            <label for="lung_capacity">Жизненная емкость легких (ЖЕЛ) (в мл):	</label>
            <input id="lung_capacity" name="lung_capacity" type="number" placeholder="0" required /><span> (см)</span>
        </div>
        <div>
            <label for="dynamo">Сила кисти (ДМК) (кг)</label>
            <input id="dynamo" name="dynamo" type="number" placeholder="0" required />
        </div>
        <div>
            <label for="heart-rate">Частота сердечных сокращений (ЧСС)(пульс за 1 мин)</label>
            <input id="heart-rate" name="heart-rate" type="number" placeholder="0" required />
        </div>
        <div>
            <label for="arterial-press">Артериальное давление систолическое (АД)</label>
            <input id="arterial-press" name="arterial-press" type="number" placeholder="0" required />
        </div>
        <div>
            <label for="recovery">Время восстановления пульса(в секундах)</label>
            <input id="recovery" name="recovery" type="number" placeholder="0" required />
        </div>
        <input type="submit" value="Отправить" class="send-result">
    </form>
</div>

</body>
</html>