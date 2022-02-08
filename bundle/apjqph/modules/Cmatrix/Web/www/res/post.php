<?php
header("Content-type: application/json");
//header("Content-type: application/octet-stream");

require_once('../defs.php');
require_once('../common.php');

$Data = \Cmatrix\Web\Request::get()->Array;

// --- --- --- --- ---
$Message = null;
try{
    switch($Data['m']){
        case 'li' :
            \Cmatrix\Core\Session::instance()->login($Data['u'],$Data['p']);
            $Message = 'Вы успешно зарегистрированы.';
            break;
                    
        case 'lo' :
            \Cmatrix\Core\Session::instance()->logout();
            $Message = 'Ваш сеанс успешно завершён.';
            break;
                    
        case 'module' :
            \Cmatrix\Kernel\Ide\Module::update($Data['code'],$Data);
            break;
            
            
                    
        default : throw new \Exception('Bad mode "' .$Data['m']. '"');
    }
    
    echo \Cmatrix\Web\Request::create([
        'status' => 1,
        'message' => $Message
    ])->Json;
}

catch(\Throwable $e){
    echo \Cmatrix\Web\Request::create([
        'status' => -1,
        'message' => $e->getMessage()
    ])->Json;
}
?>