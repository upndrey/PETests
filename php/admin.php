<?php

session_start();
if(!$_SESSION['login']){
    header('Location: ../');
}

require_once "../php/connection.php";

if(isset($_POST["groupName"])){
    $group = $_POST['groupName'];
    $query = "(SELECT id FROM groups WHERE name='$group')";
    $result = mysqli_query($connection, $query);
    $ids = mysqli_fetch_array($result);
    if(!$ids){
        $query = "INSERT INTO groups (name) VALUES ('$group')";
        mysqli_query($connection, $query);
    }
}

if(isset($_POST["saveResult"])){
    // Подключаем класс для работы с excel
    require_once('../Classes/PHPExcel.php');
// Подключаем класс для вывода данных в формате excel
    require_once('../Classes/PHPExcel/Writer/Excel5.php');

// Создаем объект класса PHPExcel
    $xls = new PHPExcel();
// Устанавливаем индекс активного листа
    $xls->setActiveSheetIndex(0);
// Получаем активный лист
    $sheet = $xls->getActiveSheet();
// Подписываем лист
    $sheet->setTitle('Таблица умножения');

// Вставляем текст в ячейку A1
    $sheet->setCellValue("A1", 'Группа');
    $sheet->getStyle('A1')->getFill()->setFillType(
        PHPExcel_Style_Fill::FILL_SOLID);
    $sheet->getStyle('A1')->getFill()->getStartColor()->setRGB('EEEEEE');

// Вставляем текст в ячейку B1
    $sheet->setCellValue("B1", 'Ф.И.О.');
    $sheet->getStyle('B1')->getFill()->setFillType(
        PHPExcel_Style_Fill::FILL_SOLID);
    $sheet->getStyle('B1')->getFill()->getStartColor()->setRGB('EEEEEE');

// Вставляем текст в ячейку C1
    $sheet->setCellValue("C1", 'R ввод');
    $sheet->getStyle('C1')->getFill()->setFillType(
        PHPExcel_Style_Fill::FILL_SOLID);
    $sheet->getStyle('C1')->getFill()->getStartColor()->setRGB('EEEEEE');


// Выравнивание текста
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(
        PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $query = "(SELECT id FROM groups WHERE name='$group')";
    $result = mysqli_query($connection, $query);
    for ($i = 2; $i < 10; $i++) {
        for ($j = 2; $j < 10; $j++) {
            // Выводим таблицу умножения
            $sheet->setCellValueByColumnAndRow(
                $i - 2,
                $j,
                $i . "x" .$j . "=" . ($i*$j));
            // Применяем выравнивание
            $sheet->getStyleByColumnAndRow($i - 2, $j)->getAlignment()->
            setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
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
}

//header('Location: ' . $_SERVER['HTTP_SERVER'] . '/pages/admin.php');