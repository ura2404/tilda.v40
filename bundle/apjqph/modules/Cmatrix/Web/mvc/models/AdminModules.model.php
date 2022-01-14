<?php
namespace Cmatrix\Web\Models;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class AdminModules extends CommonLogin {
    public function getData(){
        
        return arrayMergeReplace(parent::getData(),[
            'blocks' => $this->getMyBlocks(),
        ]);
    }
    
    // --- --- --- --- ---
    private function getMyBlocks(){
        return array_map(function($url){
            $Model = kernel\Ide\Module::i($url);
            return [
                'code' => $Model->Code,
                'name' => $Model->Name,
                'info'=> $Model->Baloon,
                'datamodels' => $Model->Datamodels
            ];
        },kernel\App::i()->Modules);
    }
}
?>