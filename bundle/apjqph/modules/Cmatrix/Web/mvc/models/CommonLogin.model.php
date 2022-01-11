<?php
namespace Cmatrix\Web\Models;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Core as co;
use \Cmatrix\Kernel\Exception as ex;

class CommonLogin extends Common {
    public function getData(){
        kernel\App::i();        
        
        return arrayMergeReplace(parent::getData(),[
            'session' => true,
            'sysuser' => $this->getMySysuser(),
            'url' => [
                'login'   => CM_WHOME. '/login',
                'message' => CM_WHOME. '/message',
            ]
        ]);
    }
    
    // --- --- --- --- ---
    private function getMySysuser(){
        if(!kernel\App::$ISDB) return [];
        
        return array_intersect_key(co\Sysuser::i()->Instance->Data,array_flip(['code','name','lk']));
    }
}
?>