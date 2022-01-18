<?php
namespace Cmatrix\Web\Models;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class AdminModule extends CommonLogin {
    public function getData(){
        
        return arrayMergeReplace(parent::getData(),[
            'url' => [
                'addmodule' => CM_WHOME .'/admin/module/add'
            ],
            'blocks' => $this->getMyBlocks(),
        ]);
    }
    
    // --- --- --- --- ---
    private function getMyBlocks(){
        return array_map(function($url){
            $Model = kernel\Ide\Module::i($url);
            return [
                'url' => CM_WHOME .'/admin/module/'. str_replace('/','',$Model->Code). '/view',
                'code' => $Model->Code,
                'name' => $Model->Name,
                'info'=> $Model->Baloon,
                'datamodels' => count($Model->Datamodels)
            ];
        },kernel\App::i()->Modules);
    }
}
?>