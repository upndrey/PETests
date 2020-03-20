<?
    session_start();
    if(!$_SESSION['login']){
        header('Location: ../');
    }
    require_once "../php/connection.php";
    $login = $_SESSION['login'];
    $query = "(SELECT id, firstName, lastName FROM users WHERE login='$login')";
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
            <div class="username"><? echo $loginId[1] . " " . $loginId[2]; ?></div>
            <a href="../" class="logout">Выход</a>
        </div>
    </div>
</header>
<div class="container tests">
    <h2>Пройти теоретические тесты:</h2>
    <?
    $testId = 1;
    while ($testId != 4) {
        $i = 1;
        for(; $i <= 8; $i++){
            $query = "(SELECT dateStart, dateEnd FROM blocks WHERE id='$i')";
            $resultDate = mysqli_query($connection, $query);
            $rowDate = mysqli_fetch_array($resultDate);

            $currDate = date_create()->format('U');
            $dateStart = date_create_from_format ("d.m.Y", $rowDate[0])->format('U');
            $dateEnd = date_create_from_format ("d.m.Y", $rowDate[1])->format('U');

            if($currDate >= $dateStart && $currDate <= $dateEnd)
                break;
        }

        $query = "(SELECT name FROM tests WHERE id='$testId')";
        $resultTests = mysqli_query($connection, $query);
        $tests = mysqli_fetch_array($resultTests);

        $query = "(SELECT * FROM results WHERE user_id='$loginId[0]' AND test_id='$testId' AND block_id='$i')";
        $resultBlock = mysqli_query($connection, $query);
        $rowBlock = mysqli_fetch_array($resultBlock);
        if($rowBlock)
            $isTestDone = 1;
        else
            $isTestDone = 0;
        if($isTestDone){
            $_SESSION['test' . $testId] = 1;
            echo "<a href='test" . $testId . ".php' class='test-link test-done'>" . $tests[0] . "</a>";
        }
        else{
            $_SESSION['test' . $testId] = NULL;
            echo "<a href='test" . $testId . ".php' class='test-link'>" . $tests[0] . "</a>";
        }
        $blockId = 1;
        echo "<div class='test-block'>";
        while ($blockId != 9) {
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
            if($isDone && $rowBlock[3]){
                echo "<div class='block-elem done-block-elem'>Блок " . $blockId . ": " . $rowBlock[3];
                if($testId == 2) echo " " . $rowBlock[6];
                echo "</div>";
            }
            else if($isDone && $testId == 3 && $rowBlock[3] != NULL)
                echo "<div class='block-elem done-block-elem'>Блок " . $blockId . ": +</div>";
            else if($isDone && !$rowBlock[3] && $rowBlock[3] == NULL)
                echo "<div class='block-elem done-block-elem'>Блок " . $blockId . ": -</div>";
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

<div class="container tests practice">
    <h2>Пройти практические тесты:</h2>
    <?
    $currBlock = 1;
    for(; $currBlock <= 8; $currBlock++){
        $query = "(SELECT dateStart, dateEnd FROM blocks WHERE id='$currBlock')";
        $resultDate = mysqli_query($connection, $query);
        $rowDate = mysqli_fetch_array($resultDate);

        $currDate = date_create()->format('U');
        $dateStart = date_create_from_format ("d.m.Y", $rowDate[0])->format('U');
        $dateEnd = date_create_from_format ("d.m.Y", $rowDate[1])->format('U');

        if($currDate >= $dateStart && $currDate <= $dateEnd)
            break;
    }

    $query = "(SELECT * FROM func_test WHERE user_id='$loginId[0]' AND block_id='$currBlock')";
    $resultBlock = mysqli_query($connection, $query);
    $rowBlock = mysqli_fetch_array($resultBlock);
    if($rowBlock)
        $isTestDone = 1;
    else
        $isTestDone = 0;

    if($isTestDone){
        $_SESSION['funcTest'] = 1;
        echo "<a href='./funcTest.php' class='test-link test-done'>Физическая подготовленность</a>";
    }
    else{
        $_SESSION['funcTest'] = NULL;
        echo "<a href='./funcTest.php' class='test-link'>Физическая подготовленность</a>";
    }


    $blockId = 1;
    echo "<div class='test-block'>";
    echo "<table class='funcTest-table'>";
    echo "  <th></th>
            <th>Подтягивания</th>
            <th>Прыжок в длину</th>
            <th>Гибкость</th>
            <th>Пресс</th>
            <th>Скакалка 1&nbsp;мин.</th>
            <th>Бег 12&nbsp;мин.</th>
            <th>Итог</th>";
    while ($blockId != 9) {
        $query = "(SELECT dateStart, dateEnd FROM blocks WHERE id='$blockId')";
        $resultBlock = mysqli_query($connection, $query);
        $rowBlock = mysqli_fetch_array($resultBlock);
        //Отмечаем пройденные тесты
        $currDate = date_create()->format('U');


        //Отмечаем, что блок ещё не готов к прохождению
        $dateStart = date_create_from_format ("d.m.Y", $rowBlock[0])->format('U');
        $dateEnd = date_create_from_format ("d.m.Y", $rowBlock[1])->format('U');
        if($currDate < $dateStart)
            $isClosed = 1;
        else
            $isClosed = 0;
        //Отмечаем нынешний тест, если он пройден
        $query = "(SELECT * FROM func_test WHERE user_id='$loginId[0]' AND block_id='$blockId')";
        $resultBlock = mysqli_query($connection, $query);
        $query = "(SELECT * FROM func_test_points WHERE user_id='$loginId[0]' AND block_id='$blockId')";
        $resultPoints = mysqli_query($connection, $query);
        $funcPointsBlock = mysqli_fetch_array($resultPoints);
        $funcTestBlock = mysqli_fetch_array($resultBlock);
        if($funcTestBlock){
            echo "<tr class='done-block-elem'>";
            echo "<td>Блок&nbsp;" . $blockId . "</td>";
            for($i = 0; $i < 6; $i++){
                echo "<td>" . $funcTestBlock[$i + 3] . "&nbsp;|&nbsp;" . $funcPointsBlock[$i + 3] . "%</td>";
            }
            echo "<td>" . $funcPointsBlock[10] . "б.</td>";
            echo "</tr>";
        }
        elseif($isClosed){
            echo "<tr class='closed-block-elem'>";
            echo "<td>Блок&nbsp;" . $blockId . "</td>";
            for($i = 0; $i < 6; $i++){
                echo "<td></td>";
            }
            echo "<td></td>";
            echo "</tr>";
        }
        elseif(!$isTestDone && $currBlock == $blockId){
            echo "<tr>";
            echo "<td>Блок&nbsp;" . $blockId . "</td>";
            for($i = 0; $i < 6; $i++){
                echo "<td></td>";
            }
            echo "<td></td>";
            echo "</tr>";
        }
        else{
            echo "<tr class='done-block-elem'>";
            echo "<td>Блок&nbsp;" . $blockId . "</td>";
            for($i = 0; $i < 6; $i++){
                echo "<td>-</td>";
            }
            echo "<td>-</td>";
            echo "</tr>";
        }
        $blockId++;
    }
    echo "</table>";
    echo "</div>";


    $query = "(SELECT * FROM health WHERE user_id='$loginId[0]' AND block_id='$currBlock')";
    $resultBlock = mysqli_query($connection, $query);
    $rowBlock = mysqli_fetch_array($resultBlock);
    if($rowBlock)
        $isTestDone = 1;
    else
        $isTestDone = 0;

    if($isTestDone){
        $_SESSION['health'] = 1;
        echo "<a href='./health.php' class='test-link test-done health-link'>Функциональные пробы + Уровень здоровья по Апонасенко</a>";
    }
    else{
        $_SESSION['health'] = NULL;
        echo "<a href='./health.php' class='test-link health-link'>Функциональные пробы + Уровень здоровья по Апонасенко</a>";
    }
    $blockId = 1;
    echo "<div class='test-block health-block-elem'>";
    while ($blockId != 9) {
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
        $query = "(SELECT * FROM health WHERE user_id='$loginId[0]' AND block_id='$blockId')";
        $resultBlock = mysqli_query($connection, $query);
        $rowBlock = mysqli_fetch_array($resultBlock);
        if($rowBlock)
            $isDone = 1;
        if($rowBlock[10] >= 16)
            $rowBlock[10] = "Высокий";
        elseif($rowBlock[10] >= 12)
            $rowBlock[10] = "Выше среднего";
        elseif($rowBlock[10] >= 7)
            $rowBlock[10] = "Средний";
        elseif($rowBlock[10] > 3)
            $rowBlock[10] = "Ниже среднего";
        elseif($rowBlock[10] <= 3)
            $rowBlock[10] = "Низкий";
        if($isDone && $rowBlock[3])
            echo "<div class='block-elem done-block-elem'>Блок " . $blockId . ": $rowBlock[10]</div>";
        else if($isDone && $testId == 3 && $rowBlock[3] != NULL)
            echo "<div class='block-elem done-block-elem'>Блок " . $blockId . ": +</div>";
        else if($isDone && !$rowBlock[3] && $rowBlock[3] == NULL)
            echo "<div class='block-elem done-block-elem'>Блок " . $blockId . ": -</div>";
        else if($isClosed)
            echo "<div class='block-elem closed-block-elem'>Блок " . $blockId . "</div>";
        else
            echo "<div class='block-elem'>Блок " . $blockId . "</div>";
        $blockId++;
    }
    echo "</div>";
    $testId++;
    ?>
    <div class="test-help">
        Проходить практические тесты разрешено только во время занятий по физической культуре.
    </div>
</div>

</body>
</html>