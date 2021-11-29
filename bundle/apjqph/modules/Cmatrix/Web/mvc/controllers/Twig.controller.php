<?php
namespace Cmatrix\Web\Controllers;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;


require_once 'Twig/autoload.php';

/**
 * Class \Cmatrix\Web\Mvc\Template
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Twig implements web\Mvc\iController {
    
    private $Twig;
    private $TemplateRoot;
    
     // --- --- --- --- ---
    function __construct(){
        $this->TemplateRoot = CM_ROOT .'/modules';
        $this->Twig = new \Twig\Environment($this->getMyLoader(),[
            'cache' => '/var/tmp',
            'debug' => true,
            'auto_reload' => true
        ]);
    }
   
   // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Controller' : return $this->Twig;
            default : throw new ex\Property($this,$name);
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    public function render(web\Mvc\Template $template,web\Mvc\Model $model){
        $Data = $model->Data;
        return $this->Twig->render(strAfter($template->Path,$this->TemplateRoot), $Data ? $Data : []);
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function getMyLoader(){
        return new \Twig_Loader_Filesystem(CM_ROOT .'/modules');
        
        /*
        $Loader = new \Twig_Loader_Filesystem();
        array_map(function($modules) use($Loader){
            $Path = CM_ROOT .'/modules/'. $modules .'/templates';
            if(file_exists($Path)) $Loader->addPath($Path);
        },scandir(CM_ROOT.'/modules'));
        
        return $Loader;
        */
    }

}
?>