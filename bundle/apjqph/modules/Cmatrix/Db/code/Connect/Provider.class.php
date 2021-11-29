<?php
namespace Cmatrix\Db\Connect;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class Provider{
    static $INSTANCES = [];
    
    static $PROVIDERS = [
        'mysql' => '\Cmatrix\Db\Connect\Provider\Mysql',
        'pgsql' => '\Cmatrix\Db\Connect\Provider\Pgsql'
    ];

    // --- --- --- --- ---
    static function instance($providerName){
        if(!in_array($providerName,array_keys(self::$PROVIDERS))) throw new ex('Wrong connect provider "' .$providerName. '"');
        
        $Key = md5($providerName);
        
        if(isset(self::$INSTANCES[$Key])) return self::$INSTANCES[$Key];
        
        $ClassName = self::$PROVIDERS[$providerName];
        return self::$INSTANCES[$Key] = new $ClassName;
    }
    
}
?>