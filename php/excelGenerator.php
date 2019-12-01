<?php

if(!$_SESSION['login'] || $_SESSION['login'] != 'admin'){
    header('Location: ../');
}
// Подключаем класс для работы с excel
require_once('../Classes/PHPExcel.php');
// Подключаем класс для вывода данных в формате excel
require_once('../Classes/PHPExcel/Writer/Excel5.php');

// Создаем объект класса PHPExcel
$xls = new PHPExcel();

//  Уровень потребности
/////////////////////////////// Оценка знаний ФК /////////////////////////////////////////
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Оценка знаний ФК');

for($col = 'A'; $col <= 'J'; $col++) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}
// Вставляем текст в ячейку A1
$sheet->setCellValue("A1", 'Группа');
$sheet->getStyle('A1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->getStyle('A1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Вставляем текст в ячейку B1
$sheet->setCellValue("B1", 'Ф.И.О.');
$sheet->getStyle('B1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('B1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->getStyle('B1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Вставляем текст в ячейку C1
$sheet->setCellValue("C1", 'R ввод');
$sheet->getStyle('C1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('C1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('C1:D1');
// Выравнивание текста
$sheet->getStyle('C1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Вставляем текст в ячейку C2
$sheet->setCellValue("C2", 'Баллы');
$sheet->setCellValue("D2", 'Дата');

$sheet->setCellValue("E1", 'R1');
$sheet->getStyle('E1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('E1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('E1:F1');
// Выравнивание текста
$sheet->getStyle('E1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("E2", 'Баллы');
$sheet->setCellValue("F2", 'Дата');

$sheet->setCellValue("G1", 'R3');
$sheet->getStyle('G1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('G1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('G1:H1');
// Выравнивание текста
$sheet->getStyle('G1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("G2", 'Баллы');
$sheet->setCellValue("H2", 'Дата');

$sheet->setCellValue("I1", 'R итог');
$sheet->getStyle('I1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('I1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('I1:J1');
// Выравнивание текста
$sheet->getStyle('I1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("I2", 'Баллы');
$sheet->setCellValue("J2", 'Дата');

$query = "(SELECT name FROM groups)";
$resultGroups = mysqli_query($connection, $query);
$i = 3;

while($group = mysqli_fetch_array($resultGroups)){
    $query = "(SELECT firstName, lastName, id FROM users WHERE group_name='$group[0]')";
    $resultUsers = mysqli_query($connection, $query);

    while($usersInfo = mysqli_fetch_array($resultUsers)) {

        // Выводим группу
        $sheet->setCellValueByColumnAndRow(0, $i, $group[0]);
        // Применяем выравнивание
        $sheet->getStyleByColumnAndRow(0, $i)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Выводим имя и фамилию
        $userName = $usersInfo[1] . " " . $usersInfo[0];
        $sheet->setCellValueByColumnAndRow(1, $i, $userName);
        $sheet->getStyleByColumnAndRow(1, $i)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // Выводим Баллы 2 3 4  5 6 7  8 9 10
        $temp = 2;
        for($j = 1; $j <= 4; $j++){
            $query = "(SELECT points, date FROM results WHERE user_id='$usersInfo[2]' AND test_id='1' AND block_id='$j')";

            $sheet->getStyleByColumnAndRow($temp, $i)->getAlignment()->
            setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $resultPoints = mysqli_query($connection, $query);
            $points = mysqli_fetch_array($resultPoints);
            if($points[0] != NULL){
                $sheet->setCellValueByColumnAndRow($temp, $i, $points[0]);
                $temp += 1;
                $sheet->setCellValueByColumnAndRow($temp, $i, $points[1]);
                $temp += 1;
            }
            else{
                $sheet->setCellValueByColumnAndRow($temp, $i, '-');
                $temp += 1;
                $sheet->setCellValueByColumnAndRow($temp, $i, '-');
                $temp += 1;
            }
        }

        $i++;
    }
}
/////////////////////////////// Уровень потребности /////////////////////////////////////////
// Устанавливаем индекс активного листа
$xls->createSheet();
$xls->setActiveSheetIndex(1);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Уровень потребности');

for($col = 'A'; $col <= 'N'; $col++) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}
// Вставляем текст в ячейку A1
$sheet->setCellValue("A1", 'Группа');
$sheet->getStyle('A1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->getStyle('A1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Вставляем текст в ячейку B1
$sheet->setCellValue("B1", 'Ф.И.О.');
$sheet->getStyle('B1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('B1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->getStyle('B1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Вставляем текст в ячейку C1
$sheet->setCellValue("C1", 'R ввод');
$sheet->getStyle('C1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('C1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('C1:E1');
// Выравнивание текста
$sheet->getStyle('C1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Вставляем текст в ячейку C2
$sheet->setCellValue("C2", 'Баллы');
$sheet->setCellValue("D2", 'Уровень');
$sheet->setCellValue("E2", 'Дата');

$sheet->setCellValue("F1", 'R1');
$sheet->getStyle('F1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('F1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('F1:H1');
// Выравнивание текста
$sheet->getStyle('F1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("F2", 'Баллы');
$sheet->setCellValue("G2", 'Уровень');
$sheet->setCellValue("H2", 'Дата');

$sheet->setCellValue("I1", 'R3');
$sheet->getStyle('I1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('I1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('I1:K1');
// Выравнивание текста
$sheet->getStyle('I1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("I2", 'Баллы');
$sheet->setCellValue("J2", 'Уровень');
$sheet->setCellValue("K2", 'Дата');

$sheet->setCellValue("L1", 'R итог');
$sheet->getStyle('L1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('L1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('L1:N1');
// Выравнивание текста
$sheet->getStyle('L1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("L2", 'Баллы');
$sheet->setCellValue("M2", 'Уровень');
$sheet->setCellValue("N2", 'Дата');

$query = "(SELECT name FROM groups)";
$resultGroups = mysqli_query($connection, $query);
$i = 3;

while($group = mysqli_fetch_array($resultGroups)){
    $query = "(SELECT firstName, lastName, id FROM users WHERE group_name='$group[0]')";
    $resultUsers = mysqli_query($connection, $query);

    while($usersInfo = mysqli_fetch_array($resultUsers)) {

        // Выводим группу
        $sheet->setCellValueByColumnAndRow(0, $i, $group[0]);
        // Применяем выравнивание
        $sheet->getStyleByColumnAndRow(0, $i)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Выводим имя и фамилию
        $userName = $usersInfo[1] . " " . $usersInfo[0];
        $sheet->setCellValueByColumnAndRow(1, $i, $userName);
        $sheet->getStyleByColumnAndRow(1, $i)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // Выводим Баллы 2 3 4  5 6 7  8 9 10
        $temp = 2;
        for($j = 1; $j <= 4; $j++){
            $query = "(SELECT points, level, date FROM results WHERE user_id='$usersInfo[2]' AND test_id='2' AND block_id='$j')";

            $sheet->getStyleByColumnAndRow($temp, $i)->getAlignment()->
            setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $resultPoints = mysqli_query($connection, $query);
            $points = mysqli_fetch_array($resultPoints);
            if($points[0] != NULL){
                $sheet->setCellValueByColumnAndRow($temp, $i, $points[0]);
                $temp += 1;
                $sheet->setCellValueByColumnAndRow($temp, $i, $points[1]);
                $temp += 1;
                $sheet->setCellValueByColumnAndRow($temp, $i, $points[2]);
                $temp += 1;
            }
            else{
                $sheet->setCellValueByColumnAndRow($temp, $i, '-');
                $temp += 1;
                $sheet->setCellValueByColumnAndRow($temp, $i, '-');
                $temp += 1;
                $sheet->setCellValueByColumnAndRow($temp, $i, '-');
                $temp += 1;
            }
        }

        $i++;
    }
}

/////////////////////////////// Отношение к состоянию здоровья /////////////////////////////////////////
// Устанавливаем индекс активного листа
$xls->createSheet();
$xls->setActiveSheetIndex(2);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Отношение к состоянию здоровья');

for($col = 'A'; $col <= 'J'; $col++) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}
// Вставляем текст в ячейку A1
$sheet->setCellValue("A1", 'Группа');
$sheet->getStyle('A1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->getStyle('A1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Вставляем текст в ячейку B1
$sheet->setCellValue("B1", 'Ф.И.О.');
$sheet->getStyle('B1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('B1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->getStyle('B1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Вставляем текст в ячейку C1
$sheet->setCellValue("C1", 'R ввод');
$sheet->getStyle('C1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('C1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('C1:D1');
// Выравнивание текста
$sheet->getStyle('C1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Вставляем текст в ячейку C2
$sheet->setCellValue("C2", 'Баллы');
$sheet->setCellValue("D2", 'Дата');

$sheet->setCellValue("E1", 'R1');
$sheet->getStyle('E1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('E1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('E1:F1');
// Выравнивание текста
$sheet->getStyle('E1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("E2", 'Пройден');
$sheet->setCellValue("F2", 'Дата');

$sheet->setCellValue("G1", 'R3');
$sheet->getStyle('G1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('G1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('G1:H1');
// Выравнивание текста
$sheet->getStyle('G1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("G2", 'Пройден');
$sheet->setCellValue("H2", 'Дата');

$sheet->setCellValue("I1", 'R итог');
$sheet->getStyle('I1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('I1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('I1:J1');
// Выравнивание текста
$sheet->getStyle('I1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("I2", 'Пройден');
$sheet->setCellValue("J2", 'Дата');

$query = "(SELECT name FROM groups)";
$resultGroups = mysqli_query($connection, $query);
$i = 3;

while($group = mysqli_fetch_array($resultGroups)){
    $query = "(SELECT firstName, lastName, id FROM users WHERE group_name='$group[0]')";
    $resultUsers = mysqli_query($connection, $query);

    while($usersInfo = mysqli_fetch_array($resultUsers)) {

        // Выводим группу
        $sheet->setCellValueByColumnAndRow(0, $i, $group[0]);
        // Применяем выравнивание
        $sheet->getStyleByColumnAndRow(0, $i)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Выводим имя и фамилию
        $userName = $usersInfo[1] . " " . $usersInfo[0];
        $sheet->setCellValueByColumnAndRow(1, $i, $userName);
        $sheet->getStyleByColumnAndRow(1, $i)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // Выводим Баллы 2 3 4  5 6 7  8 9 10
        $temp = 2;
        for($j = 1; $j <= 4; $j++){
            $query = "(SELECT points, date FROM results WHERE user_id='$usersInfo[2]' AND test_id='3' AND block_id='$j')";

            $sheet->getStyleByColumnAndRow($temp, $i)->getAlignment()->
            setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $resultPoints = mysqli_query($connection, $query);
            $points = mysqli_fetch_array($resultPoints);
            if($points[0] != NULL){
                $sheet->setCellValueByColumnAndRow($temp, $i, '+');
                $temp += 1;
                $sheet->setCellValueByColumnAndRow($temp, $i, $points[1]);
                $temp += 1;
            }
            else{
                $sheet->setCellValueByColumnAndRow($temp, $i, '-');
                $temp += 1;
                $sheet->setCellValueByColumnAndRow($temp, $i, '-');
                $temp += 1;
            }
        }

        $i++;
    }
}

/////////////////////////////// Теория /////////////////////////////////////////
// Устанавливаем индекс активного листа
$xls->createSheet();
$xls->setActiveSheetIndex(2);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Теория');

for($col = 'A'; $col <= 'J'; $col++) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}
// Вставляем текст в ячейку A1
$sheet->setCellValue("A1", 'Группа');
$sheet->getStyle('A1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->getStyle('A1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Вставляем текст в ячейку B1
$sheet->setCellValue("B1", 'Ф.И.О.');
$sheet->getStyle('B1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('B1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->getStyle('B1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$query = "(SELECT name FROM groups)";
$resultGroups = mysqli_query($connection, $query);
$i = 3;

while($group = mysqli_fetch_array($resultGroups)){
    $query = "(SELECT firstName, lastName, id FROM users WHERE group_name='$group[0]')";
    $resultUsers = mysqli_query($connection, $query);

    while($usersInfo = mysqli_fetch_array($resultUsers)) {

        // Выводим группу
        $sheet->setCellValueByColumnAndRow(0, $i, $group[0]);
        // Применяем выравнивание
        $sheet->getStyleByColumnAndRow(0, $i)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // Выводим имя и фамилию
        $userName = $usersInfo[1] . " " . $usersInfo[0];
        $sheet->setCellValueByColumnAndRow(1, $i, $userName);
        $sheet->getStyleByColumnAndRow(1, $i)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        // Выводим Баллы 2 3 4  5 6 7  8 9 10
        $temp = 2;
        for($j = 1; $j <= 4; $j++){
            $query = "(SELECT points, date FROM results WHERE user_id='$usersInfo[2]' AND test_id='3' AND block_id='$j')";

            $sheet->getStyleByColumnAndRow($temp, $i)->getAlignment()->
            setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $resultPoints = mysqli_query($connection, $query);
            $points = mysqli_fetch_array($resultPoints);
            if($points[0] != NULL){
                $sheet->setCellValueByColumnAndRow($temp, $i, '+');
                $temp += 1;
                $sheet->setCellValueByColumnAndRow($temp, $i, $points[1]);
                $temp += 1;
            }
            else{
                $sheet->setCellValueByColumnAndRow($temp, $i, '-');
                $temp += 1;
                $sheet->setCellValueByColumnAndRow($temp, $i, '-');
                $temp += 1;
            }
        }

        $i++;
    }
}

header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
header ( "Cache-Control: no-cache, must-revalidate" );
header ( "Pragma: no-cache" );
header ( "Content-type: application/vnd.ms-excel" );
header ( "Content-Disposition: attachment; filename=matrix.xls" );
// Выводим содержимое файла
$objWriter = new PHPExcel_Writer_Excel5($xls);
$objWriter->save('php://output');
?>