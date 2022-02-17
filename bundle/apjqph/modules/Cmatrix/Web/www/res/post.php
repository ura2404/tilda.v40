<?php
header("Content-type: application/json");
//header("Content-type: application/octet-stream");

require_once('../defs.php');
require_once('../common.php');

$Data = \Cmatrix\Web\Request::get()->Array;
$Mode = array_key_exists('m',$Data) ? $Data['m'] : null;

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
                
        case 'ms' : // --- добавить модуль
            \Cmatrix\Kernel\Ide\Module::update($Data['code'],$Data);
            break;
            
        case 'mr' : // --- удалить модуль
            \Cmatrix\Kernel\Ide\Module::delete($Data['code']);
            break;
            
        case 'dma' : // --- добавить datamodel
            \Cmatrix\Kernel\Ide\Datamodel::update($Data['code'],$Data);
            break;
            
        case 'dmd' : // --- удалить datamodel
            \Cmatrix\Kernel\Ide\Datamodel::delete($Data['code']);
            break;
            
            
                    
        default : throw new \Exception('Bad mode "' .$Mode. '"');
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