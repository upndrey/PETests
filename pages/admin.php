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
    <h2>Админ панель:</h2>
    <?
    $query = "(SELECT id, login FROM users)";
    $resultUsers = mysqli_query($connection, $query);
    while ($users = mysqli_fetch_array($resultUsers)) {
        echo $users[1] . "<br>";
        $query = "(SELECT points FROM results WHERE user_id='$users[0]')";
        $resultPoints = mysqli_query($connection, $query);
        while ($points = mysqli_fetch_array($resultPoints)) {
            echo $points[0] . "<br>";
        }
    }
    ?>
</div>

<script src="../scripts/index.js"></script>
</body>
</html>