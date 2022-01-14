<?php
namespace Cmatrix\Web\Models;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class Src extends Common implements web\Mvc\iModel {
    public function getData(){
        
        //return arrayMergeReplace(parent::getData(),[]);
        return parent::getData();
    }
}
?>