<?php

include 'Validation.php';
include 'File.php';
include 'Excel.php';

$validation = new Validation();
$file = new File($_FILES['file']);

if ($validation->check(EXTENSION, $file->extension)){

    if($file->upload()){
        $excel = new Excel($file->file);

        if ($validation->check(SHEET_COUNT, $excel->sheetCount) && $validation->check(SHEET_NAMES, $excel->sheetNames)){
            
            $sheetNumber = 0;
            $excel->setActiveSheet($sheetNumber);
            if($validation->check(ROW_COUNT, $excel->activeRowCount, $sheetNumber) && 
                    ($validation->check(COLUMN_COUNT, $excel->activeColumnCount, $sheetNumber))) {
                if(!$excel->readFirstSheet()){
                    $validation->error(DATA);
                }

                $sheetNumber = 1;
                $excel->setActiveSheet($sheetNumber);
                if($validation->check(ROW_COUNT, $excel->activeRowCount, $sheetNumber) && 
                    ($validation->check(COLUMN_COUNT, $excel->activeColumnCount, $sheetNumber))) {
                    if(!($_SESSION['billData'] = $excel->readSecondSheet())){
                        $validation->error(DATA);
                    }
                }
            }
        }
    } else {
        $validation->error(UPLOAD_FAILED);
    }
}

include 'index.php';
