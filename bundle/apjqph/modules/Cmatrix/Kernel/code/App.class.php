<?php
namespace Cmatrix\Kernel;

/**
 * Class \Cmatrix\Kernel\App
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class App {
    static $SAPI;
    static $ISDB;
    static $ISSESSION;
    
    // --- --- --- --- ---
    function __construct(){
        if(!self::$SAPI){
            self::$SAPI = $this->sapi();
            self::$ISDB = $this->isDb();
        }
    }
    
    // --- --- --- --- ---
    private function sapi(){
        $sapi = php_sapi_name();
        if($sapi=='cli') return 'CLI';
        elseif(substr($sapi,0,3)=='cgi') return 'CGI';
        elseif(substr($sapi,0,6)=='apache') return 'APACHE';
        else return $sapi;
    }
    
    // --- --- --- --- ---
    private function isDb(){
        return Config::instance()->getValue('db',false) && Config::instance()->getValue('session/enable');
    }
    
    // --- --- --- --- ---
    static function instance(){
        return new self();
    }
}
?>