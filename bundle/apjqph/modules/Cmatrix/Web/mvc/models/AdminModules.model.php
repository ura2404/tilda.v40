<?php
namespace Cmatrix\Web\Models;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class AdminModules extends CommonLogin {
    public function getData(){
        
        return arrayMergeReplace(parent::getData(),[
            'url' => [
                'addmodule' => CM_WHOME .'/admin/module/add'
            ],
            'blocks' => $this->getMyBlocks(),
            'path' => [
                'Home' => CM_WHOME,
                'Admin`ка' => CM_WHOME .'/admin',
                'Модули' => CM_WHOME .'/admin/modules',
            ]

        ]);
    }
    
    // --- --- --- --- ---
    private function getMyBlocks(){
        return array_map(function($url){
            $Module = kernel\Ide\Module::i($url);
            return [
                'url' => CM_WHOME .'/admin/module/'. str_replace('/','_',ltrim($Module->Code,'/')). '/view',
                'code' => $Module->Code,
                'name' => $Module->Name,
                'baloon'=> $Module->Baloon,
                'version' => $Module->Version,
                'datamodels' => count($Module->Datamodels),
                'codes' => $this->getMyCodes($Module)
            ];
        },kernel\App::i()->Modules);
    }
    
    // --- --- --- --- ---
    private function getMyCodes($module){
        $Root = $module->Path . '/code';
        
        $_rec = function($path,&$count=0) use(&$_rec){
            if(!file_exists($path)) return;
            $Dir = scandir($path);
            $Dir = array_filter($Dir,function($file){ return $file!=='.' && $file!=='..' && $file[0] !== '.'; });
            
            $CountFiles = count(array_filter($Dir,function($file) use($path) { return !is_dir($path.'/'.$file) && strpos($file,'.class.php') !== false; }));
            $CountFolder = count(array_map(function($file) use($path,&$_rec){
                $_rec($path.'/'.$file);
            },array_filter($Dir,function($file) use($path) { return is_dir($path.'/'.$file); })));
            
            $Arr = array_reduce(
                array_map(
                    function($file) use($path,&$_rec){
                        return $_rec($path.'/'.$file);
                    },
                    array_filter($Dir,function($file) use($path){
                        return is_dir($path.'/'.$file);
                    })
                ),
                function($sum,$count){
                    return $sum + $count;
                }
            );
            return $CountFiles + $CountFolder;
        };
        return $Count = $_rec($Root);
    }
    
}
?>