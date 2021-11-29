<?php
namespace Cmatrix\Kernel;

/**
 * Class \Cmatrix\Kernel\Config
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Config {

    // --- --- --- --- ---
    function __construct(){
    }

    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance($path=null){
        $Path = $path ? $path : CM_TOP .'/config.json';
        return Hash::getFile($Path);
    }

}
?>