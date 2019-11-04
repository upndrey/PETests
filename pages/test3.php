<?
if(!$_SESSION['login']){
    header('Location: ' . $_SERVER['HTTP_REFERER']);
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

<div class="container tests">
    <h2>Выберите тест:</h2>
    <a href="test1.php" class="test-link">Тест 1</a>
    <a href="test2.php" class="test-link">Тест 2</a>
    <a href="test3.php" class="test-link">Тест 3</a>
    <div class="test-help">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    </div>
</div>
</body>
</html>