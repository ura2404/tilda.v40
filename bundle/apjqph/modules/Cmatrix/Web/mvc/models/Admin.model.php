<?php
namespace Cmatrix\Web\Models;
use \Cmatrix\Kernel\Exception as ex;

class Admin extends CommonLogin {
    public function getData(){
        
        //return arrayMergeReplace(parent::getData(),[]);
        return parent::getData();
    }
}
?>