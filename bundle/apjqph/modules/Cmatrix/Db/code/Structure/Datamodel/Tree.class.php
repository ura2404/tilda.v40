<?php
namespace Cmatrix\Db\Structure\Datamodel;
use \Cmatrix\Kernel as kernel;

class Tree{
    /*
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Tree' : return $this->getMyTree();
        }
    }
    */
    // --- --- --- --- ---
    /**
     * @return \Cmatrix\Tree - 
     */
    /*private function getMyTree(){
        
    }
    */
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    /**
     * @param string $module - 
     */
    static function instance($module){
        $Tree = array_map(function($url){
            $Datamodel = kernel\Ide\Datamodel::instance($url);
            return [
                'name' => $Datamodel->Url,
                'parent' => $Datamodel->Parent ? $Datamodel->Parent->Url : null
            ];
        },kernel\Ide\Module::instance($module)->Datamodels);
        
        return kernel\Tree::instance($Tree);
    }}
