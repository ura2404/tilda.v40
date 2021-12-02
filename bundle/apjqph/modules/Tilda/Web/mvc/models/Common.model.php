<?php
namespace Tilda\Web\Models;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class Common implements web\Mvc\iModel {
    
    public function getData(){
        return [
            'app' => $this->getMyApp(),
            'url' => [
                'home' => CM_WHOME,
            ]
        ];
    }
    
    // --- --- --- --- ---
    private function getMyApp(){
        return $Config = kernel\Config::instance()->getValue('project');
    }
    
}
?>