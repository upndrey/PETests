<?
session_start();
if(!$_SESSION['login']){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

require_once "../php/connection.php";
$resultQuestions = mysqli_query($connection, "(SELECT text FROM questions)");
$resultAnswers = mysqli_query($connection, "(SELECT text FROM answer_variants)");
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

<div class="container tests">
    <h2>Выберите тест:</h2>
    <?
    while ($rowQuestion = mysqli_fetch_array($resultQuestions)) {
        echo "<div class='question'>" . $rowQuestion[0] . "</div>";
        $i = 0;
        while ($rowAnswer = mysqli_fetch_array($resultAnswers)) {
            echo "<div class='answer'>" . $rowAnswer[0] . "</div>";
            $i++;
            if($i == 4) break;
        }
    }
    ?>
</div>
</body>
</html>