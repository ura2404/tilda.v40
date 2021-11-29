<?php
namespace Cmatrix\Web\Models;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class Home /*extends CommonLogin*/ implements web\Mvc\iModel {
    
    public function getData(){
        return [];
        /*
        return arrayMergeReplace(parent::getData(),[
            'app' => [
                'module' => '404'
            ],
            'page' => [
                'url' => web\Page::instance()->Url
            ]
        ]);
        */
    }
}
?>