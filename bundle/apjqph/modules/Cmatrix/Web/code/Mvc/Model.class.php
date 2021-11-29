<?php
namespace Cmatrix\Web\Mvc;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

/**
 * Class \Cmatrix\Web\Mvc\Model
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Model {
    static $INSTANCES = [];
    private $Mix;
    
    // --- --- --- --- ---
    function __construct($mix){
        $this->Mix = gettype($mix) === 'string' ? $this->getMyModelCl($mix) : $mix;
    }
    
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Data' : return $this->getMyData();
            default : throw new ex\Property($this,$name);
        }
    }

    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function getMyModelCl($url){
        $Cl = str_replace('/','\\',kernel\Ide\Module::instance($url)->Url) .'\Models\\'. strRafter($url,'/');
        return new $Cl();
    }
    
    // --- --- --- --- ---
    private function getMyData(){
        if($this->Mix instanceof \Closure) return $this->Mix();
        elseif(is_array($this->Mix)) return $this->Mix;
        elseif($this->Mix instanceof web\Mvc\iModel) return $this->Mix->getData();
        else throw new ex('Model type "' .gettype($this->Mix). '"is invalid');
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    /**
     * @param \Closure|array|string $mix
     */
    static function instance($mix){
        $Key = gettype($mix) === 'string' ? $mix : serialize($mix);
        if(array_key_exists($Key,self::$INSTANCES)) return self::$INSTANCES[$Key];
        return new self($mix);
    }
}
?>