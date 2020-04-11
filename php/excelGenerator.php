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
$group = $_POST['excelGroup'];


$styleArray = array(
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);
/////////////////////////////// Оценка знаний ФК /////////////////////////////////////////
$xls->createSheet();
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(0);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Оценка знаний ФК');

for($col = 'A'; $col <= 'R'; $col++) {
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

$sheet->setCellValue("G1", 'R2');
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

// Второй семестр
// Вставляем текст в ячейку C1
$sheet->setCellValue("K1", 'R ввод');
$sheet->getStyle('K1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('K1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('K1:L1');
// Выравнивание текста
$sheet->getStyle('K1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Вставляем текст в ячейку C2
$sheet->setCellValue("K2", 'Баллы');
$sheet->setCellValue("L2", 'Дата');

$sheet->setCellValue("M1", 'R1');
$sheet->getStyle('M1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('M1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('M1:N1');
// Выравнивание текста
$sheet->getStyle('M1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("M2", 'Баллы');
$sheet->setCellValue("N2", 'Дата');

$sheet->setCellValue("O1", 'R2');
$sheet->getStyle('O1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('O1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('O1:P1');
// Выравнивание текста
$sheet->getStyle('O1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("O2", 'Баллы');
$sheet->setCellValue("P2", 'Дата');

$sheet->setCellValue("Q1", 'R итог');
$sheet->getStyle('Q1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('Q1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('Q1:R1');
// Выравнивание текста
$sheet->getStyle('Q1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("Q2", 'Баллы');
$sheet->setCellValue("R2", 'Дата');
$i = 3;

$query = "(SELECT firstName, lastName, id FROM users WHERE group_name='$group')";
$resultUsers = mysqli_query($connection, $query);

while($usersInfo = mysqli_fetch_array($resultUsers)) {

    // Выводим группу
    $sheet->setCellValueByColumnAndRow(0, $i, $group);
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
    for($j = 1; $j <= 8; $j++){
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

/////////////////////////////// Уровень потребности /////////////////////////////////////////
$xls->createSheet();
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(1);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Уровень потребности');

for($col = 'A'; $col <= 'Z'; $col++) {
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

$sheet->setCellValue("I1", 'R2');
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

// Второй семестр

// Вставляем текст в ячейку C1
$sheet->setCellValue("O1", 'R ввод');
$sheet->getStyle('O1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('O1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('O1:Q1');
// Выравнивание текста
$sheet->getStyle('O1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Вставляем текст в ячейку C2
$sheet->setCellValue("O2", 'Баллы');
$sheet->setCellValue("P2", 'Уровень');
$sheet->setCellValue("Q2", 'Дата');

$sheet->setCellValue("R1", 'R1');
$sheet->getStyle('R1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('R1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('R1:T1');
// Выравнивание текста
$sheet->getStyle('R1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("R2", 'Баллы');
$sheet->setCellValue("S2", 'Уровень');
$sheet->setCellValue("T2", 'Дата');

$sheet->setCellValue("U1", 'R2');
$sheet->getStyle('U1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('U1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('U1:W1');
// Выравнивание текста
$sheet->getStyle('U1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("U2", 'Баллы');
$sheet->setCellValue("V2", 'Уровень');
$sheet->setCellValue("W2", 'Дата');

$sheet->setCellValue("X1", 'R итог');
$sheet->getStyle('X1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('X1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('X1:Z1');
// Выравнивание текста
$sheet->getStyle('X1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("X2", 'Баллы');
$sheet->setCellValue("Y2", 'Уровень');
$sheet->setCellValue("Z2", 'Дата');

$i = 3;

$query = "(SELECT firstName, lastName, id FROM users WHERE group_name='$group')";
$resultUsers = mysqli_query($connection, $query);

while($usersInfo = mysqli_fetch_array($resultUsers)) {

    // Выводим группу
    $sheet->setCellValueByColumnAndRow(0, $i, $group);
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
    for($j = 1; $j <= 8; $j++){
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

/////////////////////////////// Отношение к состоянию здоровья /////////////////////////////////////////
$xls->createSheet();
// Устанавливаем индекс активного листа
$xls->setActiveSheetIndex(2);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Отношение к состоянию здоровья');

for($col = 'A'; $col <= 'R'; $col++) {
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
$sheet->setCellValue("C2", 'Пройден');
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

$sheet->setCellValue("G1", 'R2');
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

// Второй семестр
// Вставляем текст в ячейку C1
$sheet->setCellValue("K1", 'R ввод');
$sheet->getStyle('K1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('K1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('K1:L1');
// Выравнивание текста
$sheet->getStyle('K1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// Вставляем текст в ячейку C2
$sheet->setCellValue("K2", 'Пройден');
$sheet->setCellValue("L2", 'Дата');

$sheet->setCellValue("M1", 'R1');
$sheet->getStyle('M1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('M1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('M1:N1');
// Выравнивание текста
$sheet->getStyle('M1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("M2", 'Пройден');
$sheet->setCellValue("N2", 'Дата');

$sheet->setCellValue("O1", 'R2');
$sheet->getStyle('O1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('O1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('O1:P1');
// Выравнивание текста
$sheet->getStyle('O1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("O2", 'Пройден');
$sheet->setCellValue("P2", 'Дата');

$sheet->setCellValue("Q1", 'R итог');
$sheet->getStyle('Q1')->getFill()->setFillType(
    PHPExcel_Style_Fill::FILL_SOLID);
$sheet->getStyle('Q1')->getFill()->getStartColor()->setRGB('EEEEEE');
$sheet->mergeCells('Q1:R1');
// Выравнивание текста
$sheet->getStyle('Q1')->getAlignment()->setHorizontal(
    PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$sheet->setCellValue("Q2", 'Пройден');
$sheet->setCellValue("R2", 'Дата');

$i = 3;

$query = "(SELECT firstName, lastName, id FROM users WHERE group_name='$group')";
$resultUsers = mysqli_query($connection, $query);

while($usersInfo = mysqli_fetch_array($resultUsers)) {

    // Выводим группу
    $sheet->setCellValueByColumnAndRow(0, $i, $group);
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
    for($j = 1; $j <= 8; $j++){
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


/////////////////////////////// Теория ответы /////////////////////////////////////////
// Устанавливаем индекс активного листа
$xls->createSheet();
$xls->setActiveSheetIndex(3);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Теория ответы');

for($col = 'A'; $col <= 'Z'; $col++) {
    $sheet->getColumnDimension($col)->setWidth(20);
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
$i = 3;

$query = "(SELECT firstName, lastName, id FROM users WHERE group_name='$group')";
$resultUsers = mysqli_query($connection, $query);

while($usersInfo = mysqli_fetch_array($resultUsers)) {

    // Выводим группу
    $sheet->setCellValueByColumnAndRow(0, $i, $group);
    // Применяем выравнивание
    $sheet->getStyleByColumnAndRow(0, $i)->getAlignment()->
    setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    // Выводим имя и фамилию
    $userName = $usersInfo[1] . " " . $usersInfo[0];
    $sheet->setCellValueByColumnAndRow(1, $i, $userName);
    $temp = 2;
    for($j = 1; $j <= 8; $j++){

        $sheet->setCellValueByColumnAndRow($temp, 1, "Блок" . $j);
        $sheet->mergeCellsByColumnAndRow($temp, 1, $temp + 9, 1);
        $sheet->getStyleByColumnAndRow($temp, 1, $temp + 9, 1)->applyFromArray($styleArray);

        $query = "(SELECT question_type, text FROM questions WHERE test_id='3')";
        $resultQuestions = mysqli_query($connection, $query);
        $questionId = 1;
        while($questions = mysqli_fetch_array($resultQuestions)) {
            $sheet->setCellValueByColumnAndRow($temp, 2, $questions[1]);
            $answerStr = "";
            if($questions[0] == 'text'){
                $query = "(SELECT id FROM answer_variants WHERE question_id='$questionId' AND test_id='3')";
                $resultAnswerVariants = mysqli_query($connection, $query);
                $answerVariants = mysqli_fetch_array($resultAnswerVariants);
                $query = "(SELECT text FROM answers WHERE answer_variant_id='$answerVariants[0]' AND block_id='$j' AND user_id='$usersInfo[2]')";
                $resultAnswer = mysqli_query($connection, $query);
                if($answer = mysqli_fetch_array($resultAnswer))
                    $answerStr = $answer[0];
            }
            else if($questions[0] == 'radio'){
                $query = "(SELECT id, text FROM answer_variants WHERE question_id='$questionId' AND test_id='3')";
                $resultAnswerVariants = mysqli_query($connection, $query);
                while($answerVariants = mysqli_fetch_array($resultAnswerVariants)){
                    $query = "(SELECT id FROM answers WHERE answer_variant_id='$answerVariants[0]' AND block_id='$j' AND user_id='$usersInfo[2]')";
                    $resultAnswer = mysqli_query($connection, $query);
                    if($answer = mysqli_fetch_array($resultAnswer)){
                        $answerStr = $answerVariants[1];
                        break;
                    }
                }
            }
            else if($questions[0] == 'checkbox'){
                $query = "(SELECT id, text FROM answer_variants WHERE question_id='$questionId' AND test_id='3')";
                $resultAnswerVariants = mysqli_query($connection, $query);
                while($answerVariants = mysqli_fetch_array($resultAnswerVariants)){
                    $query = "(SELECT id FROM answers WHERE answer_variant_id='$answerVariants[0]' AND block_id='$j' AND user_id='$usersInfo[2]')";
                    $resultAnswer = mysqli_query($connection, $query);
                    if($answer = mysqli_fetch_array($resultAnswer)){
                        if($answerStr != "")
                            $answerStr .= ", " . $answerVariants[1];
                        else
                            $answerStr = $answerVariants[1];
                    }
                }
            }
            $sheet->setCellValueByColumnAndRow($temp, $i, $answerStr);
            $temp++;
            $questionId++;
        }
    }
    $i++;
}


/////////////////////////////// Функциональные пробы /////////////////////////////////////////
// Устанавливаем индекс активного листа
$xls->createSheet();
$xls->setActiveSheetIndex(4);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Функциональные пробы');
$sheet->getColumnDimensionByColumn(1)->setAutoSize(true);


for($col = 'A'; $col <= 'AX'; $col++) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
    $sheet->getStyle($col . '1')->getFill()->setFillType(
        PHPExcel_Style_Fill::FILL_SOLID);
    $sheet->getStyle($col . '1')->getFill()->getStartColor()->setRGB('EEEEEE');
    $sheet->getStyle($col . '1')->getAlignment()->setHorizontal(
        PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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

for($i = 0; $i < 8; $i++){//Блоки
    $sheet->mergeCellsByColumnAndRow(2 + $i * 7, 1, 2 + $i * 7 + 6, 1);
    $sheet->setCellValueByColumnAndRow(2 + $i * 7, 1, 'Блок ' . ($i + 1));
    $sheet->getColumnDimensionByColumn(2 + $i * 7)->setAutoSize(true);

    $sheet->setCellValueByColumnAndRow(2 + $i * 7, 2, 'подтягивания');
    $sheet->setCellValueByColumnAndRow(2 + $i * 7 + 1, 2, 'прыжок в длину');
    $sheet->setCellValueByColumnAndRow(2 + $i * 7 + 2, 2, 'гибкость');
    $sheet->setCellValueByColumnAndRow(2 + $i * 7 + 3, 2, 'пресс');
    $sheet->setCellValueByColumnAndRow(2 + $i * 7 + 4, 2, 'скакалка 1 мин.');
    $sheet->setCellValueByColumnAndRow(2 + $i * 7 + 5, 2, '12 мин. бег');
    $sheet->setCellValueByColumnAndRow(2 + $i * 7 + 6, 2, 'дата');


    $sheet->getColumnDimensionByColumn(2 + $i * 7)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 7 + 1)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 7 + 2)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 7 + 3)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 7 + 4)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 7 + 5)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 7 + 6)->setAutoSize(true);
}

$i = 3;

$query = "(SELECT firstName, lastName, id FROM users WHERE group_name='$group')";
$resultUsers = mysqli_query($connection, $query);

while($usersInfo = mysqli_fetch_array($resultUsers)) {

    // Выводим группу
    $sheet->setCellValueByColumnAndRow(0, $i, $group);
    // Применяем выравнивание
    $sheet->getStyleByColumnAndRow(0, $i)->getAlignment()->
    setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    // Выводим имя и фамилию
    $userName = $usersInfo[1] . " " . $usersInfo[0];
    $sheet->setCellValueByColumnAndRow(1, $i, $userName);
    $sheet->getStyleByColumnAndRow(1, $i)->getAlignment()->
    setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    // Выводим нормативы

    $temp = 2;
    for($j = 1; $j <= 8; $j++){
        $query = "(SELECT * FROM func_test WHERE user_id='$usersInfo[2]' AND block_id='$j')";

        $sheet->getStyleByColumnAndRow($temp, $i)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $resultPoints = mysqli_query($connection, $query);
        $points = mysqli_fetch_array($resultPoints);
        if($points[0] != NULL){
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[3]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[4]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[5]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[6]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[7]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[8]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[9]);
            $temp += 1;
        }
        else{
            $sheet->setCellValueByColumnAndRow($temp, $i, '-');
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, '-');
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, '-');
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, '-');
            $temp += 1;
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
/////////////////////////////// Функциональные пробы (баллы)/////////////////////////////////////////
// Устанавливаем индекс активного листа
$xls->createSheet();
$xls->setActiveSheetIndex(5);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('(баллы)Функциональные пробы');
$sheet->getColumnDimensionByColumn(1)->setAutoSize(true);


for($col = 'A'; $col <= 'AX'; $col++) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
    $sheet->getStyle($col . '1')->getFill()->setFillType(
        PHPExcel_Style_Fill::FILL_SOLID);
    $sheet->getStyle($col . '1')->getFill()->getStartColor()->setRGB('EEEEEE');
    $sheet->getStyle($col . '1')->getAlignment()->setHorizontal(
        PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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

for($i = 0; $i < 8; $i++){//Блоки
    $sheet->mergeCellsByColumnAndRow(2 + $i * 8, 1, 2 + $i * 8 + 7, 1);
    $sheet->setCellValueByColumnAndRow(2 + $i * 8, 1, 'Блок ' . ($i + 1));
    $sheet->getColumnDimensionByColumn(2 + $i * 8)->setAutoSize(true);

    $sheet->setCellValueByColumnAndRow(2 + $i * 8, 2, 'подтягивания');
    $sheet->setCellValueByColumnAndRow(2 + $i * 8 + 1, 2, 'прыжок в длину');
    $sheet->setCellValueByColumnAndRow(2 + $i * 8 + 2, 2, 'гибкость');
    $sheet->setCellValueByColumnAndRow(2 + $i * 8 + 3, 2, 'пресс');
    $sheet->setCellValueByColumnAndRow(2 + $i * 8 + 4, 2, 'скакалка 1 мин.');
    $sheet->setCellValueByColumnAndRow(2 + $i * 8 + 5, 2, '12 мин. бег');
    $sheet->setCellValueByColumnAndRow(2 + $i * 8 + 6, 2, 'дата');
    $sheet->setCellValueByColumnAndRow(2 + $i * 8 + 7, 2, 'результат');


    $sheet->getColumnDimensionByColumn(2 + $i * 8)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 8 + 1)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 8 + 2)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 8 + 3)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 8 + 4)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 8 + 5)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 8 + 6)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 8 + 7)->setAutoSize(true);
}

$i = 3;

$query = "(SELECT firstName, lastName, id FROM users WHERE group_name='$group')";
$resultUsers = mysqli_query($connection, $query);

while($usersInfo = mysqli_fetch_array($resultUsers)) {

    // Выводим группу
    $sheet->setCellValueByColumnAndRow(0, $i, $group);
    // Применяем выравнивание
    $sheet->getStyleByColumnAndRow(0, $i)->getAlignment()->
    setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    // Выводим имя и фамилию
    $userName = $usersInfo[1] . " " . $usersInfo[0];
    $sheet->setCellValueByColumnAndRow(1, $i, $userName);
    $sheet->getStyleByColumnAndRow(1, $i)->getAlignment()->
    setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    // Выводим нормативы

    $temp = 2;
    for($j = 1; $j <= 8; $j++){
        $query = "(SELECT * FROM func_test_points WHERE user_id='$usersInfo[2]' AND block_id='$j')";

        $sheet->getStyleByColumnAndRow($temp, $i)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $resultPoints = mysqli_query($connection, $query);
        $points = mysqli_fetch_array($resultPoints);
        if($points[0] != NULL){
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[3]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[4]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[5]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[6]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[7]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[8]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[9]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[10]);
            $temp += 1;
        }
        else{
            $sheet->setCellValueByColumnAndRow($temp, $i, '-');
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, '-');
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, '-');
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, '-');
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, '-');
            $temp += 1;
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
/////////////////////////////// Здоровье по Апанасенко /////////////////////////////////////////
// Устанавливаем индекс активного листа
$xls->createSheet();
$xls->setActiveSheetIndex(6);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Здоровье по Апанасенко');
$sheet->getColumnDimensionByColumn(1)->setAutoSize(true);


for($col = 'A'; $col <= 'AX'; $col++) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
    $sheet->getStyle($col . '1')->getFill()->setFillType(
        PHPExcel_Style_Fill::FILL_SOLID);
    $sheet->getStyle($col . '1')->getFill()->getStartColor()->setRGB('EEEEEE');
    $sheet->getStyle($col . '1')->getAlignment()->setHorizontal(
        PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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

for($i = 0; $i < 8; $i++){//Блоки
    $sheet->mergeCellsByColumnAndRow(2 + $i * 4, 1, 2 + $i * 4 + 3, 1);
    $sheet->setCellValueByColumnAndRow(2 + $i * 4, 1, 'Блок ' . ($i + 1));
    $sheet->getColumnDimensionByColumn(2 + $i * 4)->setAutoSize(true);

    $sheet->setCellValueByColumnAndRow(2 + $i * 4, 2, 'Баллы');
    $sheet->setCellValueByColumnAndRow(2 + $i * 4 + 1, 2, 'Баллы (100)');
    $sheet->setCellValueByColumnAndRow(2 + $i * 4 + 2, 2, 'Словесная оценка');
    $sheet->setCellValueByColumnAndRow(2 + $i * 4 + 3, 2, 'Дата');


    $sheet->getColumnDimensionByColumn(2 + $i * 4)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 4 + 1)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 4 + 2)->setAutoSize(true);
    $sheet->getColumnDimensionByColumn(2 + $i * 4 + 3)->setAutoSize(true);
}

$i = 3;

$query = "(SELECT firstName, lastName, id FROM users WHERE group_name='$group')";
$resultUsers = mysqli_query($connection, $query);

while($usersInfo = mysqli_fetch_array($resultUsers)) {

    // Выводим группу
    $sheet->setCellValueByColumnAndRow(0, $i, $group);
    // Применяем выравнивание
    $sheet->getStyleByColumnAndRow(0, $i)->getAlignment()->
    setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    // Выводим имя и фамилию
    $userName = $usersInfo[1] . " " . $usersInfo[0];
    $sheet->setCellValueByColumnAndRow(1, $i, $userName);
    $sheet->getStyleByColumnAndRow(1, $i)->getAlignment()->
    setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    // Выводим нормативы

    $temp = 2;
    for($j = 1; $j <= 8; $j++){
        $query = "(SELECT * FROM health WHERE user_id='$usersInfo[2]' AND block_id='$j')";

        $sheet->getStyleByColumnAndRow($temp, $i)->getAlignment()->
        setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $resultPoints = mysqli_query($connection, $query);
        $points = mysqli_fetch_array($resultPoints);
        if($points[0] != NULL){
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[10]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[12]);
            $temp += 1;
            if($points[10] >= 16)
                $points[10] = "Высокий";
            elseif($points[10] >= 12)
                $points[10] = "Выше среднего";
            elseif($points[10] >= 7)
                $points[10] = "Средний";
            elseif($points[10] > 3)
                $points[10] = "Ниже среднего";
            elseif($points[10] <= 3)
                $points[10] = "Низкий";
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[10]);
            $temp += 1;
            $sheet->setCellValueByColumnAndRow($temp, $i, $points[11]);
            $temp += 1;
        }
        else{
            $sheet->setCellValueByColumnAndRow($temp, $i, '-');
            $temp += 1;
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



/////////////////////////////// Входные данные для здоровья /////////////////////////////////////////
// Устанавливаем индекс активного листа
$xls->createSheet();
$xls->setActiveSheetIndex(7);
// Получаем активный лист
$sheet = $xls->getActiveSheet();
// Подписываем лист
$sheet->setTitle('Входные данные для здоровья');

for($col = 'A'; $col <= 'Z'; $col++) {
    $sheet->getColumnDimension($col)->setWidth(20);
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
$i = 3;

$query = "(SELECT firstName, lastName, id FROM users WHERE group_name='$group')";
$resultUsers = mysqli_query($connection, $query);

while($usersInfo = mysqli_fetch_array($resultUsers)) {

    // Выводим группу
    $sheet->setCellValueByColumnAndRow(0, $i, $group);
    // Применяем выравнивание
    $sheet->getStyleByColumnAndRow(0, $i)->getAlignment()->
    setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    // Выводим имя и фамилию
    $userName = $usersInfo[1] . " " . $usersInfo[0];
    $sheet->setCellValueByColumnAndRow(1, $i, $userName);
    $temp = 2;
    for($j = 1; $j <= 8; $j++){
        $sheet->setCellValueByColumnAndRow($temp, 1, "Блок" . $j);
        $sheet->mergeCellsByColumnAndRow($temp, 1, $temp + 7, 1);
        $sheet->getStyleByColumnAndRow($temp, 1, $temp + 7, 1)->applyFromArray($styleArray);

        $query = "(SELECT * FROM health WHERE block_id='$j' AND user_id='$usersInfo[2]')";
        $resultHealth = mysqli_query($connection, $query);
        if($health = mysqli_fetch_array($resultHealth)) {
            for($it = 3; $it <= 10; $it++){
                $healthTitle = "";
                switch ($it){
                    case 3:
                        $healthTitle = "Вес";
                        break;
                    case 4:
                        $healthTitle = "Рост";
                        break;
                    case 5:
                        $healthTitle = "Объем легких";
                        break;
                    case 6:
                        $healthTitle = "Сила кисти";
                        break;
                    case 7:
                        $healthTitle = "Пульс";
                        break;
                    case 8:
                        $healthTitle = "Давление";
                        break;
                    case 9:
                        $healthTitle = "Восстановление";
                        break;
                    case 10:
                        $healthTitle = "Результат";
                        break;
                }
                $sheet->setCellValueByColumnAndRow($temp, 2, $healthTitle);
                $sheet->setCellValueByColumnAndRow($temp, $i, $health[$it]);
                $temp++;
            }
        }
        else {
            for($it = 3; $it <= 10; $it++) {
                $healthTitle = "";
                switch ($it) {
                    case 3:
                        $healthTitle = "Вес";
                        break;
                    case 4:
                        $healthTitle = "Рост";
                        break;
                    case 5:
                        $healthTitle = "Объем легких";
                        break;
                    case 6:
                        $healthTitle = "Сила кисти";
                        break;
                    case 7:
                        $healthTitle = "Пульс";
                        break;
                    case 8:
                        $healthTitle = "Давление";
                        break;
                    case 9:
                        $healthTitle = "Восстановление";
                        break;
                    case 10:
                        $healthTitle = "Результат";
                        break;
                }
                $sheet->setCellValueByColumnAndRow($temp, 2, $healthTitle);
                $sheet->setCellValueByColumnAndRow($temp, $i, '-');
                $temp++;
            }
        }
    }
    $i++;
}



header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT" );
header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
header ( "Cache-Control: no-cache, must-revalidate" );
header ( "Pragma: no-cache" );
header ( "Content-type: application/vnd.ms-excel" );
header ( "Content-Disposition: attachment; filename=monitoringfk.xls" );
// Выводим содержимое файла
$objWriter = new PHPExcel_Writer_Excel5($xls);
$objWriter->save('php://output');
?>