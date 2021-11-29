<?php
namespace Cmatrix\Web\Mvc;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

/**
 * Class \Cmatrix\Web\Mvc\Template
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Template {
    static $INSTANCES = [];
    private $Url;
    
    private $P_Path;
    
    // --- --- --- --- ---
    function __construct($url){
        $this->Url = $url;
    }

    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Path' : return $this->getMyPath();
            case 'Data' : return $this->getMyData();
            default : throw new ex\Property($this,$name);
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function getMyPath(){
        if($this->P_Path) return $this->P_Path;
        
        $Path = kernel\Ide\Module::instance($this->Url)->Path;
        $Template = strRafter($this->Url,'/');
        
        $Path .= '/mvc/templates/' . $Template;
        if(!file_exists($Path)) throw new ex('Template "' .$this->Url. '" is not defined.');        
        
        return $this->P_Path = $Path;
    }
    
    // --- --- --- --- ---
    private function getMyData(){
        return file_get_contents($this->Path);
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance($url){
        $Key = $url;
        if(array_key_exists($Key,self::$INSTANCES)) return self::$INSTANCES[$Key];
        return new self($url);
    }
    /*    
    // --- --- --- --- ---
    static function add($name,$url){
        if(array_key_exists($name,self::$TEMPLATES)) throw new ex('Template "'.$name.'" allready exists.');
        return self::$TEMPLATES[$name] = self::instance($url);
    }
    
    // --- --- --- --- ---
    static function get($name){
        if(!array_key_exists($name,self::$TEMPLATES)) throw new ex('Template "'.$name.'" is not exists.');
        return self::$TEMPLATES[$name];
    }
    */
}
?>