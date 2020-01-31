<?
session_start();
if(!$_SESSION['login']){
    header('Location: ../');
}

if($_SESSION['test3'] == "1"){
    header('Location: tests.php');
}

require_once "../php/connection.php";
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
        <h2>Тест 3:</h2>
        <?
        $questionId = 1;
        $resultQuestions = mysqli_query($connection, "(SELECT text, question_type FROM questions WHERE test_id=3)");
        while ($rowQuestion = mysqli_fetch_array($resultQuestions)) {
            echo "<div class='question'>" . $rowQuestion[0] . "</div>";
            $resultAnswers = mysqli_query($connection, "(SELECT text FROM answer_variants WHERE test_id=3 AND question_id='$questionId')");
            $answerId = 1;
            echo "<div class='answers'>";
            while ($rowAnswer = mysqli_fetch_array($resultAnswers)) {
                if($rowQuestion[1] == 'radio')
                    echo "  <div>
                                <input 
                                    type='" . $rowQuestion[1] . "'  
                                    value='" . $questionId . "_" . $answerId . "'
                                    required 
                                    id='answer" . $questionId . $answerId . "'  
                                    name='answer" . $questionId . "' 
                                />
                                <label 
                                    class='answer' 
                                    for='answer" . $questionId . $answerId . "'>"
                                        . $rowAnswer[0] . "
                                </label>
                            </div>";
                else if($rowQuestion[1] == 'checkbox')
                    echo "  <div>
                                <input 
                                    type='" . $rowQuestion[1] . "'  
                                    value='" . $questionId . "_" . $answerId . "' 
                                    id='answer" . $questionId . $answerId . "'  
                                    name='someAnswers" . $questionId . $answerId . "' 
                                />
                                <label 
                                    class='answer' 
                                    for='answer" . $questionId . $answerId . "'>"
                                        . $rowAnswer[0] . "
                                </label>
                            </div>";
                else if($rowQuestion[1] == 'text'){
                    echo "  <div>
                                <textarea 
                                    placeholder='' 
                                    required 
                                    id='answer" . $questionId . $answerId . "'  
                                    name='textAnswer" . $questionId . "'></textarea>                           
                            </div>";
                }
                $answerId++;
            }
            echo "</div>";
            $questionId++;
        }
        ?>
        <input type="hidden" name="test" value="3">
        <input type="submit" value="Отправить" class="send-result" onclick="return isCheckbox();">
    </form>
</div>

<script>
    function isCheckbox() {
        let textareas = document.querySelectorAll("textarea");
        for(let i = 0; i < textareas.length; i++){
            if(textareas[i].value.trim().length === 0){
                alert("Не заполнен обязательный текстовый блок!");
                return false;
            }
        }
        let divs = document.querySelectorAll("form div.answers");
        for(let i = 0; i < divs.length; i++){
            let inputs = divs[i].querySelectorAll("input");
            if(!inputs.length) continue;
            let isAnySelected = 0;
            for(let j = 0; j < inputs.length; j++){
                if(inputs[j].checked){
                    isAnySelected = 1;
                    break;
                }
            }
            if(!isAnySelected) {
                alert("Не выбран обязательный пункт!");
                return false;
            }
        }
        return true;
    }
</script>
</body>
</html>