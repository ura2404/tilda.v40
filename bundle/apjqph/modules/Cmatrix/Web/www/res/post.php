<?php
header("Content-type: application/json");
//header("Content-type: application/octet-stream");

require_once('../defs.php');
require_once('../common.php');

$Data = \Cmatrix\Web\Request::get()->Array;
$Mode = $Data['m'];

// --- --- --- --- ---
$Message = null;
try{
    switch($Mode){
        case 'li' : // --- login
            \Cmatrix\Core\Session::instance()->login($Data['u'],$Data['p']);
            $Message = 'Вы успешно зарегистрированы.';
            break;
                    
        case 'lo' : // --- logout
            \Cmatrix\Core\Session::instance()->logout();
            $Message = 'Ваш сеанс успешно завершён.';
            break;
                
        case 'ma' : // --- добавить модуль
            \Cmatrix\Kernel\Ide\Module::update($Data['code'],$Data);
            break;
            
        case 'md' : // --- удалить модуль
            \Cmatrix\Kernel\Ide\Module::delete($Data['code']);
            break;
            
        case 'dma' : // --- добавить модуль
            \Cmatrix\Kernel\Ide\Datamodel::update($Data['code'],$Data);
            break;
            
        case 'dmd' : // --- удалить модуль
            \Cmatrix\Kernel\Ide\Datamodel::delete($Data['code']);
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