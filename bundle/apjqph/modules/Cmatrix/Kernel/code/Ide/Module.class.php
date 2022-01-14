<?php
namespace Cmatrix\Kernel\Ide;
use \Cmatrix\Kernel\Exception as ex;
use \Cmatrix\Kernel as kernel;

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
    private $P_Json;

    // --- --- --- --- --- --- ---
    public function __construct($url){
        $this->Url = $this->calculateUrl($url);
	}
	
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Url' : return $this->Url;
            case 'Path' : return $this->getMyPath();
            case 'Json' : return $this->getMyJson();
            case 'Code' : return $this->Json['module']['code'];
            case 'Name' : return $this->Json['module']['name'];
            case 'Baloon' : return kernel\Lang::i()->str($this->Json['module']['baloon']);
            case 'Datamodels' : return $this->getMyDatamodels();
            //case 'Data' : return $this->getMyData();
            default : throw new ex\Property($this,$name);
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function calculateUrl($url){
        $Arr = explode('/',ltrim($url,'/'));
        if(count($Arr) < 2) throw new ex('Wrong module "'. $url .'" url.');
        return '/'. $Arr[0] .'/'. $Arr[1];
    }
    
    // --- --- --- --- ---
    private function getMyPath(){
        if($this->P_Path) return $this->P_Path;
        
        $Path = CM_ROOT. '/modules' .$this->Url;
        if(!file_exists($Path)) throw new ex('Module "'. $this->Url .'" is not found.');
        return $this->P_Path = $Path;
    }
    
    // --- --- --- --- ---
    protected function getMyJson(){
        if($this->P_Json !== null) return $this->P_Json;
        $Path = $this->Path.'/module.conf.json';
        if(!file_exists($Path)) throw new ex('Module "'. $this->Url .'" config file is not found.');
        
        return $this->P_Json = kernel\Json::getFile($Path)->Data;
    }
    
    // --- --- --- --- ---
    private function getMyDatamodels(){
        $Root = $this->Path .'/dm';
        if(!file_exists($Root)) return [];
        
        return array_map(function($value){
            return $Url = $this->Url. '/' .strBefore($value,'.dm.php');
        },array_filter(scandir($Root),function($value){
            return $value !== '.' && $value !== '..' && strpos($value,'.dm.php') && $value[0]!=='_';
        }));
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance($url){
        $Key = $url;
        if(array_key_exists($Key,self::$INSTANCES)) return self::$INSTANCES[$Key];
        return new self($url);
    }
    
    // --- --- --- --- ---
    static function i($url){
        return self::instance($url);
    }
    
}
?>