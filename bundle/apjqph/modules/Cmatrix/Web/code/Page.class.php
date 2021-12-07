<?php
namespace Cmatrix\Web;
use Cmatrix\Kernel as kernel;

/**
 * Class \Cmatrix\Web\Page
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Page {
    static $INSTANCES = [];
    private $Url;
    private $Params;

    // --- --- --- --- --- --- ---
    public function __construct($url=null){
        $this->Url = $this->calculatePage($url);
        $this->Params = $this->parseParams($url);
	}
	
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            //case 'Name' : return $this->Pagename;
            case 'Html' : return $this->getMyHtml();
            //case 'Url' : return $this->Url;
            case 'Page' : return $this->getMyPage();
            case 'Params' : return $this->Params;
            default : throw new ex\Property($this,$name);
        }
    }
    
    // --- --- --- --- ---
    private function getMyPage(){
        $Url = $this->Url;
        $Url = strBefore($Url,'?');
        $Url = strBefore($Url,'&');
        return $Url;
    }
    
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function calculatePage($url=null){
        
        $_url = function(){
            if(isset($_SERVER['REDIRECT_STATUS']) && $_SERVER['REDIRECT_STATUS'] == 200){
                $Url = strAfter(trim(rtrim($_SERVER['REDIRECT_QUERY_STRING'],'/')),'cmp=');
            }
            else{
                $Whome = kernel\Config::instance()->getValue('www/root');
                $Url = strAfter(rtrim($_SERVER['REQUEST_URI'],'/'),$Whome);
            }
            
            return $Url == '' ? '/' : $Url;
        };
        
        return $url ? $url : $_url();
    }
    
    // --- --- --- --- ---
    private function parseParams($url){
        $Params = array_diff_key($_REQUEST,array_flip(['cmp']));
        return $Params;
    }
    
    // --- --- --- --- ---
    /**
     * @return string - html содержимое страницы
     */
    private function getMyHtml(){
        $_render = function($router){
            $Template = $router['template'];
            $Model = $router['model'];
            $Controller = $router['controller'];
            return $Controller->render($Template,$Model);
        };
        
        $Router = Router::get($this->Url);
        if($Router) return $_render($Router);
        else{
            $Router = Router::get('404');
            if($Router) return $_render($Router);
            else die('Router for page '.$this->Url.' is not exists');
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    /**
     * @param string $name
     * @param bool isDecode - декодировать из base64
     */
    public function getParam($name=null,$isDecode=false){
        $Params = $this->Params;
        $Param = ($name && array_key_exists($name,$this->Params)) ? $this->Params[$name] : null;
        
        if(!$Param) return;
        if(!$isDecode) return $Param;
        
            $Param = strtr($Param, ' ', '+');
            $Param = json_decode(base64_decode($Param),true);
            
            //$Param = strtr($Param, ' ', '+');
            //$Param = urlencode($Param);
            //$Param = json_decode(base64_decode($Param),true);
        
        //dump($Param,11111);
        return $Param;
    }
    
    // --- --- --- --- ---
    public function calculateUrl($code,$value){
        $Params = $this->Params;
        $Params[$code] = $value;
        
        return CM_WHOME. '/' .$this->Page. (count($Params) ? '?'.implode('&',array_map(function($key,$value){
            return $key .'='. $value;
        },array_keys($Params),array_values($Params))) : null);
    }        
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance($url=null){
        $Key = $url;
        if(array_key_exists($Key,self::$INSTANCES)) return self::$INSTANCES[$Key];
        return new self($url);
    }
}
?>