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
                'post' => CM_WHOME .'/res/cmatrix/post.php',
                'search' => CM_WHOME .'/search',
                'message' => CM_WHOME .'/message',
                'browser' => CM_WHOME .'/browser',
                'session' => CM_WHOME .'/session',
                'admin' => CM_WHOME .'/admin',
                'profile' => CM_WHOME .'/profile',
                'api' => CM_WHOME .'/api',
            ],
            'now' => date('Y-m-d')
        ];
    }
    
    // --- --- --- --- ---
    private function getMyApp(){
        return $Config = kernel\Config::instance()->getValue('project');
    }
}
?>