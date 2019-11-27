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

    $query = "(SELECT id FROM users WHERE login='$login')";
    $resultTest = mysqli_query($connection, $query);

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
    <?
    $testId = 1;
    while ($testId != 4) {
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

        $query = "(SELECT * FROM results WHERE user_id='$loginId[0]' AND test_id='$testId' AND block_id='$i')";
        $resultBlock = mysqli_query($connection, $query);
        $rowBlock = mysqli_fetch_array($resultBlock);
        if($rowBlock)
            $isTestDone = 1;
        else
            $isTestDone = 0;
        if($isTestDone)
            echo "<a href='test" . $testId . ".php' class='test-link test-done'>Тест " . $testId . "</a>";
        else
            echo "<a href='test" . $testId . ".php' class='test-link'>Тест " . $testId . "</a>";
        $blockId = 1;
        echo "<div class='test-block'>";
        while ($blockId != 5) {
            $query = "(SELECT dateStart, dateEnd FROM blocks WHERE id='$blockId')";
            $resultBlock = mysqli_query($connection, $query);
            $rowBlock = mysqli_fetch_array($resultBlock);
            //Отмечаем пройденные тесты
            $currDate = date_create()->format('U');
            $dateEnd = date_create_from_format ("d.m.Y", $rowBlock[1])->format('U');
            if($currDate > $dateEnd)
                $isDone = 1;
            else
                $isDone = 0;


            //Отмечаем, что блок ещё не готов к прохождению
            $dateStart = date_create_from_format ("d.m.Y", $rowBlock[0])->format('U');
            if($currDate < $dateStart)
                $isClosed = 1;
            else
                $isClosed = 0;


            //Отмечаем нынешний тест, если он пройден
            $query = "(SELECT * FROM results WHERE user_id='$loginId[0]' AND test_id='$testId' AND block_id='$blockId')";
            $resultBlock = mysqli_query($connection, $query);
            $rowBlock = mysqli_fetch_array($resultBlock);

            if($rowBlock)
                $isDone = 1;
            if($isDone)
                echo "<div class='block-elem done-block-elem'>Блок " . $blockId . "</div>";
            else if($isClosed)
                echo "<div class='block-elem closed-block-elem'>Блок " . $blockId . "</div>";
            else
                echo "<div class='block-elem'>Блок " . $blockId . "</div>";
            $blockId++;
        }
        echo "</div>";
        $testId++;
    }

    ?>
    <div class="test-help">
        Пройденные блоки будут отмечены <span class="special-color">специальным цветом</span>, дважды один блок пройти нельзя.
    </div>
</div>

</body>
</html>