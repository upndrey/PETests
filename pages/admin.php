<?
session_start();
if(!$_SESSION['login'] || $_SESSION['login'] != 'admin'){
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
            <a href="" class="username"><? echo $login; ?></a>
            <a href="../" class="logout">Выход</a>
        </div>
    </div>
</header>
<div class="container tests admin-panel">
    <h2>Админ панель:</h2>
    <div class="groupsController">
        <form action="../php/admin.php" method="post">
            <div class="addGroupBlock">
                <label for="groupName">Добавить группу:</label>
                <input type="text" required name="groupName" id="groupName" placeholder="Введите название группы"/>
            </div>
            <input type="submit" name="sendGroup" value="Добавить">
        </form>
        <form action="../php/admin.php" class="delGroup" method="post">
            <div class="groupList">
                <label>Выберите группы для удаления:</label>
                <?
                $groupsResult = mysqli_query($connection, "(SELECT name, id FROM groups)");
                $i = 0;
                while ($groups = mysqli_fetch_array($groupsResult)) {
                    echo "
                        <input id='group" . $groups[1] . "' type='checkbox' name='group" . $i . "' value = '" . $groups[1] . "'/>
                        <label class='group' for='group" . $groups[1] . "'>" . $groups[0] . "</label>         
                            ";
                    $i++;
                }
                ?>
            </div>
            <input type="hidden" name="removeGroups" value="<? echo $i; ?>">
            <input type="submit" value="Удалить группы">
        </form>

        <form action="../php/admin.php" method="post">
            <div class="saveTimeBlock">
                <?
                $resultTime = mysqli_query($connection, "(SELECT dateStart, dateEnd FROM blocks)");
                $i = 0;
                $blockId = 1;
                while ($time = mysqli_fetch_array($resultTime)) {
                    echo "
                        <div>
                            <p>Блок " . $blockId++ . "</p>
                            <input type='text' name='time" . $i++ . "' value = '" . $time[0] . "'/>
                            <input type='text' name='time" . $i++ . "' value = '" . $time[1] . "'/>
                        </div>
                    ";
                }
                ?>
            </div>
            <input type="hidden" name="saveTimeResult" value="1">
            <input type="submit" name="sendTimeResult" value="Сохранить">
        </form>
    </div>

    <form action="../php/admin.php" class="saveExcelBlock" method="post">
        <select required name="excelGroup" class="excelGroup">
            <?
            $groups = mysqli_query($connection, "(SELECT name FROM groups)");
            while ($rowGroup = mysqli_fetch_array($groups)) {
                echo "<option>" . $rowGroup[0] . "</option>";
            }
            ?>
        </select>
        <input type="hidden" name="saveResult" value="1">
        <input type="submit" name="sendResult" value="Скачать excel">
    </form>


    <form action="" class="delGroup" method="post">
        <label>Выберите группу для выбора пользователей:</label>
        <select required name="userGroup" class="userGroup">
            <?
            $groups = mysqli_query($connection, "(SELECT name FROM groups)");
            while ($rowGroup = mysqli_fetch_array($groups)) {
                echo "<option>" . $rowGroup[0] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Выбрать">
    </form>
    <form action="../php/delUsers.php" class="delGroup" method="post">
        <div class="groupList">
            <label>Выберите пользователей для удаления:</label>
            <?
            $group = $_POST['userGroup'];
            $usersResult = mysqli_query($connection, "(SELECT login, id FROM users WHERE group_name='$group')");
            $i = 0;
            while ($users = mysqli_fetch_array($usersResult)) {
                if($users[0] == "admin") continue;
                echo "
                        <input id='user" . $users[1] . "' type='checkbox' name='user" . $i . "' value = '" . $users[1] . "'/>
                        <label class='group' for='user" . $users[1] . "'>" . $users[0] . "</label>         
                            ";
                $i++;
            }
            ?>
        </div>
        <input type="hidden" name="removeUsers" value="<? echo $i; ?>">
        <input type="submit" value="Удалить пользователей">
    </form>
</div>

</body>
</html>