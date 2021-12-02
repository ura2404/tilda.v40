<?php
namespace Tilda\Tool\Models;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;
use \Tilda as tilda;

class Catalogue extends Tool implements web\Mvc\iModel {
    
    public function getData(){
        return arrayMergeReplace(parent::getData(),[
            'table' => web\Ide\Datamodel::instance('/Tilda/Tool/Tool')->Table,
            //'tree' => web\Ide\Datamodel::instance('/Tilda/Tool/Type')->Tree,
            'filter' => $this->getMyFilters(),
        ]);
    }
    
    // --- --- --- --- ---
    private function getMyFilters(){
        $Props = web\Ide\Datamodel::i('/Tilda/Tool/Tool')->Props;
        $Props =  array_map(function($prop){
            if($prop['type'] === '::link::') $prop['_combobox'] = web\Ide\Datamodel::instance($prop['association']['entity'])->Tree;
            return $prop;
        },$Props);
        return $Props;
    }
    
}
?>