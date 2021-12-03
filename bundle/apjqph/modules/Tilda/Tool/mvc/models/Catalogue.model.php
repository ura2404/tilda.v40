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
            'filter' => $this->getMyfilters(),
        ]);
    }
    
    // --- --- --- --- ---
    private function getMyfilters(){
        $Pfilter = web\Page::instance()->getParam('f',true);
        //dump($Pfilter);
        
        $Props = web\Ide\Datamodel::i('/Tilda/Tool/Tool')->Props;
        $Props = array_filter($Props,function($prop){ return $prop['filtrable']; });
        $Props =  array_map(function($code,$prop) use($Pfilter){
            if($prop['type'] === '::link::') $prop['_combobox'] = web\Ide\Datamodel::instance($prop['association']['entity'])->Tree;
            if(isset($Pfilter[$code])) $prop['_filter'] = $Pfilter[$code];
            return $prop;
        },array_keys($Props),array_values($Props));
        return $Props;
    }
    
}
?>