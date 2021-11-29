<?php
namespace Tilda\Web\Models;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class Home extends Common implements web\Mvc\iModel {
    
    public function getData(){
        return arrayMergeReplace(parent::getData(),[
        ]);
    }
    
}
?>