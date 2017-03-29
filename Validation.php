<?php

const EXTENSION = 'extension';
const SHEET_COUNT = 'sheetCount';
const COLUMN_COUNT = 'columnCount';
const ROW_COUNT = 'rowCount';
const DATA = 'data';
const UPLOAD_FAILED = 'uploadFailed';
const SHEET_NAMES = 'sheetNames';

class Validation {
    
    const VALID_EXTENSION = 'xlsx';
    const VALID_SHEET_NUMBER = 2;
    const VALID_COLUMN_NUMBER_1 = 3;
    const VALID_COLUMN_NUMBER_2 = 2;
    const FIRST_SHEET_NAME = 'first';
    const SECOND_SHEET_NAME = 'second';

    private $errors = [
        
        EXTENSION => 'Расширение файла может быть только .xlsx',
        SHEET_COUNT => 'В файле должно быть 2 страницы',
        COLUMN_COUNT => 'На первой странице должно быть 3 столбца, на второй 2',
        ROW_COUNT => 'Файл не может быть пустым',
        DATA => 'Несоответствие данных',
        UPLOAD_FAILED => 'Ошибка загрузки файла',
        SHEET_NAMES => 'Страницы должны имеь имена: \'first\' и \'second\'',
        
    ];
    
    public function __construct() {
        
        session_start();
        session_unset();
        $_SESSION['success'] = true;
    }
    
    public function error ($code){
        $_SESSION['success'] = false;
        $_SESSION['error'] = $this->errors[$code];
    }

    public function check ($code, $value, $sheetNumber = null) {
        switch ($code) {
            case EXTENSION:
                if ($value == self::VALID_EXTENSION){
                    return true;
                } else {
                    $this->error(EXTENSION);
                    return false;
                }
                break;
                
            case SHEET_COUNT:
                if ($value == self::VALID_SHEET_NUMBER){
                    return true;
                } else {
                    $this->error(SHEET_COUNT);
                    return false;
                }
                break;
                
            case SHEET_NAMES:
                if (($value[0] == self::FIRST_SHEET_NAME) && ($value[1] == self::SECOND_SHEET_NAME)){
                    return true;
                } else {
                    $this->error(SHEET_NAMES);
                    return false;
                }
                break;
                
            case COLUMN_COUNT:
                if ((($sheetNumber == 0)&&($value == self::VALID_COLUMN_NUMBER_1)) | (($sheetNumber == 1)&&($value == self::VALID_COLUMN_NUMBER_2))){
                    return true;;
                } else {
                    $this->error(COLUMN_COUNT);
                    return false;
                }
                break;
                
            case ROW_COUNT:
                if ($value > 1){
                    return true;
                } else {
                    $this->error(ROW_COUNT);
                    return false;
                }
        }
    }
    
}

