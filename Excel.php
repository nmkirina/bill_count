<?php
require_once dirname(__FILE__) . '/PHPExcel-1.8/Classes/PHPExcel.php';
require_once dirname(__FILE__) . '/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

class Excel{
    
    public $excel;
    public $sheetCount;
    public $activeSheet;
    public $activeColumnCount;
    public $activeRowCount;
    public $billData;
    public $sheetNames;

    public function __construct($inputFile) {
        
        $this->excel = PHPExcel_IOFactory::load($inputFile);
        $this->sheetCount = $this->excel->getSheetCount();
        $this->sheetNames = $this->excel->getSheetNames();

    }
    
    public function setActiveSheet($sheetIndex){
        
        $this->excel->setActiveSheetIndex($sheetIndex);
        $this->activeSheet = $this->excel->getActiveSheet();
        $this->activeColumnCount = PHPExcel_Cell::columnIndexFromString($this->activeSheet->getHighestDataColumn());
        $this->activeRowCount = $this->activeSheet->getHighestRow();
    }
    
    public function readFirstSheet(){
        
        for ($r = 1; $r <= $this->activeRowCount; $r++){
            
            if(is_numeric($id = $this->activeSheet->getCell('A' . $r)->getValue()) &&
                is_string($name = $this->activeSheet->getCell('B' . $r)->getValue()) &&
                is_numeric($rest = $this->activeSheet->getCell('C' . $r)->getValue())){
                    
                $this->billData[(int)$id] = [
                    'name' => $name,
                    'rest' => $rest,
                ];
            } else {
                return false;
            }
        }
        return true;
    }
    
    public function readSecondSheet() {
        
        for ($r = 1; $r <= $this->activeRowCount; $r++){
            
            if (is_numeric($id = $this->activeSheet->getCell('A' . $r)->getValue()) &&
                    is_numeric($bill = $this->activeSheet->getCell('B' . $r)->getValue()) &&
                    (isset($this->billData[(int)$id]))){
                
                        $this->billData[$id]['rest'] += $bill;
                
            } else {
                return false;
            }
        }
        return $this->billData;
    }
}

