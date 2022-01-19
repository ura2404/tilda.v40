<?php
namespace Cmatrix\Web\Models;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel\Exception as ex;

class AdminModule extends CommonLogin {
    public function getData(){
        $Action = $this->checkAction();
        $Url = $this->checkUrl($Action);
        
        return arrayMergeReplace(parent::getData(),[
            'url' => [
                'edit' => CM_WHOME .'/admin/module/add',
                'copy' => CM_WHOME .'/admin/module/add',
                'remove' => CM_WHOME .'/admin/module/add'
            ],
            'module' => [
                'url' => $Action === 'add' ? null : kernel\Ide\Module::i($Url)->Url
            ],
            'name' => $Action === 'add' ? 'Новый модуль' : 'Модуль '. kernel\Ide\Module::i($Url)->Url,
            'blocks' => $this->getMyBlocks(),
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
    private function getMyTitle(){
        
        dump(web\Page::i()->Page);
        dump(web\Page::i()->Params);
        //return web\Page::i()->Params;
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