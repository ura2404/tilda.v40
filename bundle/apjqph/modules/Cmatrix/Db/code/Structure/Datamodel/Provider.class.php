<?php
namespace Cmatrix\Db\Structure\Datamodel;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Db as db;
use \Cmatrix\Kernel\Exception as ex;

/**
 * Class Cmatrix\Db\Structure\Datamodel\Provider
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Provider{
    static $INSTANCES = [];
    
    static $PROVIDERS = [
        'mysql' => '\Cmatrix\Db\Structure\Datamodel\Provider\Mysql',
        'pgsql' => '\Cmatrix\Db\Structure\Datamodel\Provider\Pgsql'
    ];
    
    // --- --- --- --- ---
    protected $Datamodel;
    protected $ConnectProvider;
    protected $Prefix;
    
    // --- --- --- --- ---
    function __construct(kernel\Ide\iDatamodel $datamodel, db\Connect\iProvider $connectProvider){
        $this->Datamodel = $datamodel;
        $this->ConnectProvider = $connectProvider;
        $this->Prefix = kernel\Config::instance()->getValue('db/prefix');
    }
    
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'ConnectProvider' : return $this->ConnectProvider;
            case 'SqlInitScript' : return $this->getSqlInitScript();
            default : throw new ex\Property($this,$name);
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance($providerName, kernel\Ide\iDatamodel $datamodel){
        if(!in_array($providerName,array_keys(self::$PROVIDERS))) throw new cm\Exception('Wrong structure provider "' .$providerName. '"');
        
        $Key = md5($providerName.$datamodel->Url);
        if(isset(self::$INSTANCES[$Key])) return self::$INSTANCES[$Key];
        
        $ConnectProvider = db\Connect\Provider::instance($providerName);
        
        $ClassName = self::$PROVIDERS[$providerName];
        return self::$INSTANCES[$Key] = new $ClassName($datamodel, $ConnectProvider);
    }
    
}
?>