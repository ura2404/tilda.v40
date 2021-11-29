<?php
namespace Cmatrix\Kernel;

/**
 * Class \Cmatrix\Kernel\Exception
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Exception extends \Exception{

    // --- --- --- --- --- --- ---
    public function __construct($message, $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
	}
	
	// --- --- --- --- --- --- ---
    /*public function __toString() {
        return __CLASS__ . ": [$this->code]: $this->message\n";
    }*/	
}
?>