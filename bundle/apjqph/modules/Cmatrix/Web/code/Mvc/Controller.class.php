<?php
namespace Cmatrix\Web\Mvc;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

/**
 * Class \Cmatrix\Web\Mvc\Controller
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Controller {
    static $INSTANCES = [];
    private $Url;
    
    // --- --- --- --- ---
    function __construct($url){
        $this->Url = $url;
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    public function getInstance(){
        $Cl = str_replace('/','\\',kernel\Ide\Module::instance($this->Url)->Url) .'\Controllers\\'. strRafter($this->Url,'/');
        return new $Cl();
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance($url){
        $Key = $url;
        if(array_key_exists($Key,self::$INSTANCES)) return self::$INSTANCES[$Key];
        return (new self($url))->getInstance();
    }
}
?>