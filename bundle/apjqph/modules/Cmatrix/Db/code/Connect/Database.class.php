<?php
namespace Cmatrix\Db\Connect;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class Database{
    static $INSTANCES = [];
    
    static $DATABASES = [
        'pgsql' => '\Cmatrix\Db\Connect\Database\Pgsql',
        'mysql' => '\Cmatrix\Db\Connect\Database\Mysql',
        'sqlite3' => '\Cmatrix\Db\Connect\Database\Sqlite3',
    ];

    // --- --- --- --- ---
    static function instance(array $config){
        $ProviderName = $config['type'];
        if(!in_array($ProviderName,array_keys(self::$DATABASES))) throw new ex('Wrong connect database "' .$ProviderName. '"');
        
        $Key = md5(serialize($config));
        if(isset(self::$INSTANCES[$Key])) return self::$INSTANCES[$Key];
        
        $ClassName = self::$DATABASES[$ProviderName];
        return self::$INSTANCES[$Key] = new $ClassName($config);
    }
    
}
?>