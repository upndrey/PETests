<?
session_start();
if(!$_SESSION['login']){
    header('Location: ../');
}

if($_SESSION['test2'] == "1"){
    header('Location: tests.php');
}

require_once "../php/connection.php";
$resultQuestions = mysqli_query($connection, "(SELECT text FROM questions WHERE test_id=2)");
$resultAnswers = mysqli_query($connection, "(SELECT text FROM answer_variants WHERE test_id=2)");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Мониторинг физического воспитания</title>
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
    <form action="../php/sendResult.php" method="post" class="test">
        <h2>Тест 2:</h2>
        <?
        $questionId = 1;
        while ($rowQuestion = mysqli_fetch_array($resultQuestions)) {
            echo "<div class='question'>" . $rowQuestion[0] . " Вопрос</div>";
            $answerId = 1;
            echo "<div class='answers'>";
            while ($rowAnswer = mysqli_fetch_array($resultAnswers)) {
                echo "  <div>
                        <input type='radio' required value='" . $questionId . "_" . $answerId . "' id='answer" . $questionId . $answerId . "'  name='answer" . $questionId . "'>
                        <label class='answer' for='answer" . $questionId . $answerId . "'>" . $rowAnswer[0] . "</label>
                    </div>";
                $answerId++;
                if($answerId == 5) break;
            }
            echo "</div>";
            $questionId++;
        }
        ?>
        <input type="hidden" name="test" value="2">
        <input type="submit" value="Отправить" class="send-result" onclick="return isCheckbox();">
    </form>
</div>

<script>
    function isCheckbox() {
        let divs = document.querySelectorAll("form div.answers");
        for(let i = 0; i < divs.length; i++){
            let inputs = divs[i].querySelectorAll("input");
            let isAnySelected = 0;
            for(let j = 0; j < inputs.length; j++){
                if(inputs[j].checked){
                    isAnySelected = 1;
                    break;
                }
            }
            if(!isAnySelected) {
                alert("Не выбран обязательный пункт №" + (i + 1));
                return false;
            }
        }
        return true;
    }
</script>
</body>
</html>