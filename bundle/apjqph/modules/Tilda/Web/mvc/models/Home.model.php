<?php
namespace Tilda\Web\Models;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class Home extends Common implements web\Mvc\iModel {
    
    public function getData(){
        kernel\App::instance();
        
        return arrayMergeReplace(parent::getData(),[
            'session' => $this->getMySession()
        ]);
    }
    
    // --- --- --- --- ---
    private function getMySession(){
        if(!kernel\App::$ISDB) return false;
        
        //$Sysuser
        
        return true;
    }
    
}
?>