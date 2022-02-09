<?php
namespace Cmatrix\Web\Models;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel\Exception as ex;

class AdminModule extends CommonLogin {
    public function getData(){
        $Action = $this->checkAction();
        $Url = $this->checkUrl($Action);
        $Module = $Url ? kernel\Ide\Module::i($Url) : null;
        
        //dump($Module->Json);
        
        return arrayMergeReplace(parent::getData(),[
            'url' => [
                'edit' => CM_WHOME .'/admin/module/add',
                'copy' => CM_WHOME .'/admin/module/add',
                'remove' => CM_WHOME .'/admin/module/add'
            ],
            'mode' => $Action,
            'module' => [
                'url' => $Url,
                'info' => $Url ? $Module->Json->Data : null,
                'datamodels' => $this->getMyDatamodels($Module)
            ],
            'path' => [
                'Home' => CM_WHOME,
                'Admin`ка' => CM_WHOME .'/admin',
                'Модули' => CM_WHOME .'/admin/modules',
                $Url ? 'Модуль '.$Url : 'Новый модуль' => null,
            ]

        ]);
    }

    // --- --- --- --- ---
    private function checkAction(){
        return web\Page::i()->Params['action'];
    }
    
    // --- --- --- --- ---
    private function checkUrl($action){
        if($action === 'add') return null;
        $Arr = explode('/',web\Page::i()->Page);
        return '/'.str_replace('_','/',array_pop($Arr));
    }

    // --- --- --- --- ---
    /*
    private function getMyTitle(){
        dump(web\Page::i()->Page);
        dump(web\Page::i()->Params);
        //return web\Page::i()->Params;
    }
    */
    
    // --- --- --- --- ---
    private function getMyDatamodels($module){
        if(!$module) return [];
        return array_map(function($datamodel){
            return kernel\Ide\Datamodel::i($datamodel)->Json->Data;
        },$module->Datamodels);
    }
    
}
?>