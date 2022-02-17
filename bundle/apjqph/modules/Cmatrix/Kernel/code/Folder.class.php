<?php
namespace Cmatrix\Kernel;
use \Cmatrix\Kernel\Exception as ex;


/**
 * Class \Cmatrix\Kernel\Folder
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2022-02-17
 */
class Folder {
    private $Path;
    
    // --- --- --- --- ---
    function __construct($path){
        $this->Path = $path;
    }
    
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Path' : return $this->Path;
            case 'Parent' : return $this->getMyParent();
            case 'isEmpty' : return $this->getMyIsEmpty();
            default : throw new ex\Property($this,$name);
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function getMyParent(){
        return self::i(strRBefore($this->Path,'/'));
    }
    
    // --- --- --- --- ---
    private function getMyIsEmpty(){
        return count(scandir($this->Path)) == 2 ? true : false;
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    public function delete(){
        $Dir = opendir($this->Path);
        while(($Entry = readdir($Dir)) !== false){
            if($Entry === '.' || $Entry === '..') continue;
            $Path = $path .'/'. $Entry;
            if(is_dir($Path)) self::i($Path)->delete();
            else unlink($Path);
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance($path){
        return new self($path);
    }
    
    // --- --- --- --- ---
    static function i($path){
        return self::instance($path);
    }
}