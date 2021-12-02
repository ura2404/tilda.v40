<?php
namespace Cmatrix\Core;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Db as db;
use \Cmatrix\Kernel\Exception as ex;

/**
 * Class \Cmatrix\Core\Sysuser
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Sysuser {
    static $INSTANCES = [];
    private $Instance;
    
    // --- --- --- --- ---
    function __construct(){
        $this->Instance = db\Obbject::instance('/Cmatrix/Core/Sysuser')->get(Session::i()->Instance->sysuser_id);
    }
    
   // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Instance' : return $this->Instance;
            default : throw new ex\Property($this,$name);
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    public function isMyGroups(...$groups){
        return true;
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance(){
        $Key = md5('current');
        if(isset(self::$INSTANCES[$Key])) return self::$INSTANCES[$Key];
        
        return self::$INSTANCES[$Key] = new self;
    }
    
    // --- --- --- --- ---
    static function i(){
        return self::instance();
    }
}
?>