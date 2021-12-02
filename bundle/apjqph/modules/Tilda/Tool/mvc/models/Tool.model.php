<?php
namespace Tilda\Tool\Models;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;
use \Tilda as tilda;

class Tool extends tilda\Web\Models\CommonLogin implements web\Mvc\iModel {
    
    public function getData(){
        //dump(web\Ide\Datamodel::instance('/Tilda/Tool/Tool')->Data);die();
        
        return arrayMergeReplace(parent::getData(),[
            'app' => [
                'module' => 'Tilda • Режущий инструмент',
                'url' => [
                    'catalogue' => CM_WHOME .'/tool/catalogue',
                    'document' => CM_WHOME .'/tool/document',
                    'report' => CM_WHOME .'/tool/report',
                    'library' => CM_WHOME .'/tool/library',
                ]
            ]
        ]);
    }

    
}
?>