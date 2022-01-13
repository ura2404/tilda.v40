<?php
namespace Cmatrix\Web\Models;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel\Exception as ex;

class Common implements web\Mvc\iModel {
    public function getData(){
        return [
            'app' => $this->getMyApp(),
            'url' => [
                'home' => CM_WHOME,
                'search' => CM_WHOME .'/search',
                'post' => CM_WHOME .'/res/cmatrix/post.php'
            ]
        ];
    }
    
    // --- --- --- --- ---
    private function getMyApp(){
        return $Config = kernel\Config::instance()->getValue('project');
    }
}
?>