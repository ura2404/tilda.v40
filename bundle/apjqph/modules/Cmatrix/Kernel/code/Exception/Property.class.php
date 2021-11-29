<?php
namespace Cmatrix\Kernel\Exception;
use \Cmatrix\Kernel as kernel;

class Property extends kernel\Exception{

    // --- --- --- --- --- --- ---
    public function __construct($ob,$propName) {
        $Message = 'CmatrixError: class [' .get_class($ob). '] property [' .$propName. '] is not defined';
        parent::__construct($Message);
	}
}
?>