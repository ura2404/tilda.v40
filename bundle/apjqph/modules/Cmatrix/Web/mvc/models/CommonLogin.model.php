<?php
namespace Cmatrix\Web\Models;
use \Cmatrix\Kernel\Exception as ex;

class CommonLogin extends Common {
    public function getData(){
        
        //return arrayMergeReplace(parent::getData(),[]);
        return parent::getData();
    }
}
?>