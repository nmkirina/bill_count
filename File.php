<?php

class File{
    
    public $name;
    public $extension;
    public $file;
    private $tmp;


    public function __construct($file) {
        
        $this->tmp = $file['tmp_name'];
        $this->name = $file['name'];
        $this->extension = $this->getExtention($this->name);
    }
    
    public function upload(){
        
        $this->file = dirname(__FILE__) . '/upload/' . $this->name;
        return move_uploaded_file($this->tmp, $this->file);
    }
    
    private function getExtention($name){
        
        $parts = explode('.', $name);
        return end($parts);
    }
}

