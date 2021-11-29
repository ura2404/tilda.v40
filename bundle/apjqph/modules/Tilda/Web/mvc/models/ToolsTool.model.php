<?php
namespace Tilda\Web\Models;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class ToolsTool extends Common implements web\Mvc\iModel {
    
    public function getData(){
        //dump(web\Ide\Datamodel::instance('/Tilda/Tool/Tool')->Data);die();
        
        return arrayMergeReplace(parent::getData(),[
            'app' => [
                'module' => 'Tilda • Режущий инструмент'
            ],
            'table' => web\Ide\Datamodel::instance('/Tilda/Tool/Vendor')->Data
        ]);
    }

    
}
?>