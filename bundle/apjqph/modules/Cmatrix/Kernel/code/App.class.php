<?php
namespace Cmatrix\Kernel;
use \Cmatrix\Kernel\Exception as ex;

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
            self::$ISSESSION = $this->isSession();
        }
    }
    
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Modules' : return $this->getMyModules();
            default : throw new ex\Property($this,$name);
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
    private function isSession(){
        return self::isDb();
    }
    
    // --- --- --- --- ---
    /**
     * @return array - массив url модулей, например ['/Cmatrix/Core','/Cmatrix/Kernel',...].
     */
    private function getMyModules(){
        $Root = CM_ROOT .'/modules';
        if(!file_exists($Root)) return [];
        
        $Arr = array_map(function($value){
            return '/'.$value;
        },array_filter(scandir($Root),function($value) use($Root){
            return $value !== '.' && $value !== '..' && is_dir($Root.'/'.$value);
        }));
        
        $Arr = array_map(function($root) use($Root){
            return array_map(function($value) use($root){
                return $root .'/'. $value;
            },array_filter(scandir($Root .'/'. $root),function($value) use($Root,$root){
                return $value !== '.' && $value !== '..' && is_dir($Root.'/'.$root.'/'.$value);
            }));
        },$Arr);
        
        return array2line($Arr);
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance(){
        return new self();
    }
    
    // --- --- --- --- ---
    static function i(){
        return new self();
    }
}
?>