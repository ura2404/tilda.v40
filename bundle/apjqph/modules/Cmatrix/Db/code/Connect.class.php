<?php
namespace Cmatrix\Db;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class Connect{
    static $INSTANCES = [];
    
    private $Driver;
    
    // --- --- --- --- ---
    function __construct(array $config){
        $this->Driver = Connect\Driver::instance($config,Connect\Database::instance($config));
    }

    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    public function query($query,$mode=null){
        return $this->Driver->query($query,$mode);
    }

    // --- --- --- --- ---
    public function exec($query,$mode=null){
        return $this->Driver->exec($query,$mode);
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance(array $config=null){
        $Config = $config ? $config : kernel\Config::instance()->getValue('db');
        if(!$Config) throw new ex('Connect config is not defined.');
        
        $Key = md5(serialize($Config));
        if(isset(self::$INSTANCES[$Key])) return self::$INSTANCES[$Key];
        return self::$INSTANCES[$Key] = new self($Config);
    }

    // --- --- --- --- ---
    static function i(array $config=null){
        return self::instance($config);
    }
    // --- --- --- --- ---
    static function get($name='db'){
        $Config = kernel\Config::instance()->getValue($name);
        if(!$Config) throw new ex('Connect config is not defined.');
        
        return self::instance($Config);
    }    
}
?>