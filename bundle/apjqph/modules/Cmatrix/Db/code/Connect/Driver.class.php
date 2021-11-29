<?php
namespace Cmatrix\Db\Connect;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class Driver{
    static $INSTANCES = [];
    
    static $DRIVERS = [
        'pdo' => '\Cmatrix\Db\Connect\Driver\Pdo',
        'pgsql' => '\Cmatrix\Db\Connect\Driver\Pgsql',
        'mysql' => '\Cmatrix\Db\Connect\Driver\Mysql',
        'sqlite3l' => '\Cmatrix\Db\Connect\Driver\Sqlite3',
    ];

    // --- --- --- --- ---
    static function instance(array $config, iDatabase $database){
        $DriverName = $config['driver'];
        if(!in_array($DriverName,array_keys(self::$DRIVERS))) throw new ex('Wrong connect driver "' .$DriverName. '"');
        
        $Key = md5(serialize($config));
        if(isset(self::$INSTANCES[$Key])) return self::$INSTANCES[$Key];
        
        $ClassName = self::$DRIVERS[$DriverName];
        return self::$INSTANCES[$Key] = new $ClassName($config,$database);
    }
    
}
?>