<?php
namespace Tilda\Web\Models;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class Common implements web\Mvc\iModel {
    
    public function getData(){
        return [
            'app' => $this->getMyApp(),
            'url' => CM_WHOME,
        ];
    }
    
    // --- --- --- --- ---
    private function getMyApp(){
        $Config = kernel\Hash::getFile(CM_TOP.'/config.json');
        return $Config->getValue('project');
    }
    
}
?>