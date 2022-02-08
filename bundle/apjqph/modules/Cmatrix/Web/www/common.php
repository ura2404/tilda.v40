<?php
require_once CM_ROOT.'/modules/Cmatrix/Kernel/code/utils.php';

switch(CM_MODE){
    case 'development' :
        ini_set('display_errors',1);
        error_reporting(-1);
        break;
    case 'production' :
        ini_set('display_errors',1);
        //error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        error_reporting(~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        //error_reporting(0);
        //E_CORE_WARNING
        break;
    default :
        header('HTTP/1.1 503 Service Unavailable.',true,503);
        echo 'Cmatrix fatal error: wrong environment or environment isn\'t defined.';
        exit(1);
}

spl_autoload_register(function($className){
    if(class_exists($className)) return;

    $Arr = explode("\\",$className);
    $Module = array_shift($Arr);
    $Section = array_shift($Arr);
    
    //dump('======================================================================');
    //dump('======================================================================');
    //dump('======================================================================');
    //dump($className,'className');
    //dump($Arr);
    //dump($Module,'Module');
    //dump($Section,'Section');
    
    if(!count($Arr)) return;
    
    $Folder = CM_ROOT .'/modules/'. $Module .'/'. $Section;
    
    //dump($Folder,'Folder');
    
    if($Arr[0] === 'Models'){
        array_shift($Arr);
        $Path = $Folder .'/mvc/models/'. implode('/',$Arr) .'.model.php';
    }
    elseif($Arr[0] === 'Controllers'){
        array_shift($Arr);
        $Path = $Folder .'/mvc/controllers/'. implode('/',$Arr) .'.controller.php';
    }
    elseif($Arr[0] === 'Dm'){
        array_shift($Arr);
        $Path = realpath($Folder .'/dm/'. implode('/',$Arr) .'.dm.php');
    }
    elseif($Arr[0] === 'Ds'){
        array_shift($Arr);
        $Path = $Folder .'/ds/'. implode('/',$Arr) .'.ds.php';
    }
    else{
        $Path = $Folder .'/code/'. implode('/',$Arr) .'.class.php';
    }
    
    //dump($Path,'Path');
    
    if(file_exists($Path)) require_once($Path);
    // закоментил для twig
    //else throw new \Exception('Class "'. $className .'" file not found.');

},true,true);
?>