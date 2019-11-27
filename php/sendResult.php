<?
    session_start();
    if(!$_SESSION['login']){
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    $i = 1;
    $i1 = 0;
    $i2 = 0;
    $i3 = 0;
    $isEndFlag = 1;
    while(1){
        if(isset($_POST['answer' . $i])){
            $result[$i1] = $_POST['answer' . $i];
            $i1++;
        }
        else if(isset($_POST['textAnswer' . $i])){
            $textResult[$i2][0] = $_POST['textAnswer' . $i];
            $textResult[$i2][1] = $i;
            $i2++;
        }
        else{
            $j = 1;
            while(1){
                if(isset($_POST['someAnswers' . $i . $j])){
                    $someResults[$i3] = $_POST['someAnswers' . $i . $j];
                    $i3++;
                    $isEndFlag = 0;
                }
                $j++;
                if($j == 10)
                    break;
            }
            if($isEndFlag)
                break;
            $isEndFlag = 1;
        }
        $i++;
    }

    for($i = 0; $i < count($result); $i++){
        $result[$i] = explode("_", $result[$i]);
    }
    if($someResults){
        for($i = 0; $i < count($someResults); $i++){
            $someResults[$i] = explode("_", $someResults[$i]);
        }
    }
    require_once "../php/connection.php";

    $login = $_SESSION['login'];
    $query = "(SELECT id FROM users WHERE login='$login')";
    $resultLoginId = mysqli_query($connection, $query);

    $loginId = mysqli_fetch_array($resultLoginId);
    $testId = $_POST['test'];




    if($someResults){
        // обработка Checkbox ответов
        for($i = 0; $i < count($someResults); $i++){
            $someResults[$i][0] = (int)$someResults[$i][0];
            $temp = $someResults[$i];
            // Считываем id варианта ответа из вариантов ответов.
            $query = "(SELECT id FROM answer_variants WHERE question_id='$temp[0]' AND test_id='$testId' AND variant='$temp[1]')";
            $resultAnswerid = mysqli_query($connection, $query);
            $answerIds[$i] = mysqli_fetch_array($resultAnswerid);
        }

        for($i = 0; $i < count($answerIds); $i++){
            $tempAnswerId = $answerIds[$i];
            //Записываем варианты ответов пользователя
            $query = "INSERT INTO answers (user_id, answer_variant_id) VALUES ('$loginId[0]', '$tempAnswerId[0]')";
            mysqli_query($connection, $query);
        }

        // обработка текстовых ответов
        for($i = 0; $i < count($someResults); $i++){
            $temp = $textResult[$i];
            // Считываем id варианта ответа из вариантов ответов.
            $query = "(SELECT id FROM answer_variants WHERE question_id='$temp[1]' AND test_id='$testId' AND variant=1)";
            $resultAnswerid = mysqli_query($connection, $query);
            $answerIds[$i] = mysqli_fetch_array($resultAnswerid);
        }

        for($i = 0; $i < count($answerIds); $i++){
            $tempAnswerId = $answerIds[$i];
            $tempTextResult = $textResult[$i];
            //Записываем варианты ответов пользователя
            $query = "INSERT INTO answers (user_id, answer_variant_id, text) VALUES ('$loginId[0]', '$tempAnswerId[0]', '$tempTextResult[0]')";
            mysqli_query($connection, $query);
        }


    }

    $weights = [];
    for($i = 0; $i < count($result); $i++){
        $result[$i][0] = (int)$result[$i][0];
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
    $date = getdate();
    $i = 1;
    for(; $i <= 4; $i++){
        $query = "(SELECT dateStart, dateEnd FROM blocks WHERE id='$i')";
        $resultDate = mysqli_query($connection, $query);
        $rowDate = mysqli_fetch_array($resultDate);

        $currDate = date_create()->format('U');
        $dateStart = date_create_from_format ("d.m.Y", $rowDate[0])->format('U');
        $dateEnd = date_create_from_format ("d.m.Y", $rowDate[1])->format('U');

        if($currDate >= $dateStart && $currDate <= $dateEnd)
            break;
    }


    $dateResult = $date['mday'] . "." . $date['mon'] . "." . $date['year'];
    //Записываем сумму баллов в результат
    $query = "INSERT INTO results (user_id, test_id, points, block_id, date) VALUES ('$loginId[0]', $testId, '$weightsSum', '$i', '$dateResult')";
    mysqli_query($connection, $query);

    for($i = 0; $i < count($answerIds); $i++){
        $tempAnswerId = $answerIds[$i];
        //Записываем варианты ответов пользователя
        $query = "INSERT INTO answers (user_id, answer_variant_id) VALUES ('$loginId[0]', '$tempAnswerId[0]')";
        mysqli_query($connection, $query);
    }



    header('Location: ' . $_SERVER['HTTP_SERVER'] . '/pages/tests.php');
?>
