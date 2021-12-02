<?php
namespace Tilda\Web\Models;
use \Cmatrix\Web as web;
use \Cmatrix\Core as co;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class CommonLogin extends Common implements web\Mvc\iModel {
    
    public function getData(){
        kernel\App::instance();
        
        return arrayMergeReplace(parent::getData(),[
            'session' => true,
            'sysuser' => $this->getMySysuser()
        ]);
    }
    
    // --- --- --- --- ---
    private function getMySysuser(){
        if(!kernel\App::$ISDB) return [];
        
        return array_intersect_key(co\Sysuser::i()->Instance->Data,array_flip(['code','name','lk']));
    }
    
}
?>