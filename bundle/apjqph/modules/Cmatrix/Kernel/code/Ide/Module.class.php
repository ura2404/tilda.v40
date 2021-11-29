<?php
namespace Cmatrix\Kernel\Ide;

/**
 * Class \Cmatrix\Kernel\Ide\Module
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Module {
    static $INSTANCES = [];
    private $Url;
    
    private $P_Path;

    // --- --- --- --- --- --- ---
    public function __construct($url){
        $this->Url = $this->calculateUrl($url);
	}
	
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Url' : return $this->Url;
            case 'Path' : return $this->getMyPath();
            case 'Data' : return $this->getMyData();
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function calculateUrl($url){
        $Arr = explode('/',ltrim($url,'/'));
        if(count($Arr) < 2) throw new \Exception('Wrong module "'. $url .'" url.');
        return '/'. $Arr[0] .'/'. $Arr[1];
    }
    
    // --- --- --- --- ---
    private function getMyPath(){
        if($this->P_Path) return $this->P_Path;
        
        $Path = CM_ROOT. '/modules' .$this->Url;
        if(!file_exists($Path)) throw new \Exception('Module "'. $this->Url .'" is not found.');
        return $this->P_Path = $Path;
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance($url){
        $Key = $url;
        if(array_key_exists($Key,self::$INSTANCES)) return self::$INSTANCES[$Key];
        return new self($url);
    }
}
?>