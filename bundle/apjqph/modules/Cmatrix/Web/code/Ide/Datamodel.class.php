<?php
namespace Cmatrix\Web\Ide;
use \Cmatrix\Web as web;
use \Cmatrix\Db as db;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

/**
 * Class \Cmatrix\Web\Ide\Datamodel
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Datamodel {
    static $INSTANCES = [];
    private $Url;
    
    private $P_Data;
    private $P_Props;

    // --- --- --- --- --- --- ---
    public function __construct($url){
        $this->Url = $url;
	}
	
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Props' : return $this->getMyProps();
            case 'Data' : return $this->getMyData();
            default : throw new ex\Property($this,$name);
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function getMyData(){
        if($this->P_Data) return $this->P_Data;
        
        return [
            'rfilter' => $this->getRfilter(),
            'pfilter' => $this->getPfilter(),
            'props' => $this->getMyProps(),
            'lines' => $this->getLines(),
        ];
    }
    
    // --- --- --- --- ---
    private function getMyProps(){
        if($this->P_Props) return $this->P_Props;
        
        $Datamodel = kernel\Ide\Datamodel::instance($this->Url);
        
        $_align = function($code,$prop){
            if($code === 'status') return 'center';
            
            switch($prop['type']){
                case '::id::' :
                case 'integer' :
                case 'real' :
                    return 'right';
                        
                case '::hid::' :
                case 'bool' :
                case 'timestamp' :
                    return 'center';
                
                default : return 'left';
            }
        };        
        
        $Props = [];
        array_map(function($code,$prop) use($_align,&$Props){
            $prop['name'] = $prop['name'] ? kernel\Lang::str($prop['name']) : $prop['code'];
            $prop['label'] = $prop['label'] ? kernel\Lang::str($prop['label']) : ($prop['name'] ? kernel\Lang::str($prop['name']) : $prop['code']);
            $prop['baloon'] = $prop['baloon'] ? kernel\Lang::str($prop['baloon']) : null;
            $prop['sortable'] = true;
            $prop['align'] = $_align($code,$prop);
            
            $Props[$code] = $prop;
        },array_keys($Datamodel->Props),array_values($Datamodel->Props));
        
        return $this->Props = array_merge([
            'row_index'=>[
                'code' => 'row_index',
                'type' => '::index::',
                'baloon' => 'Выбрать все записи',
                'sortable' => false,
                'align' => 'center'
            ]
        ],$Props);
    }
    
    // --- --- --- --- ---
    /**
     * Получить параметрический фильтр
     */
    private function getPfilter(){
        $Filter = web\Page::instance()->getParam('f');
        $Clean = strtr($Filter, ' ', '+');
        $Res = json_decode(base64_decode( $Clean ),true);
        return $Res;
    }
    
    // --- --- --- --- ---
    /**
     * Получить свободный фильтр
     */
    private function getRfilter(){
        $Filtr = web\Page::instance()->getParam('r');
        return $Filtr;
    }
    
    // --- --- --- --- ---
    private function getLines(){
        $Datamodel = kernel\Ide\Datamodel::instance($this->Url);
        $Props = array_flip(array_keys($this->Props));
        array_shift($Props);
        
        $Query = db\Cql::select($Datamodel)->props(array_keys($Props))/*->orders($Sorts)->rules()->limit($Limit)*/;
        $Res = db\Connect::instance()->query($Query);
        
        $Iterator = 0;
        $Res = array_map(function($tr) use($Datamodel,&$Iterator){
            array_map(function($code,$td) use($Datamodel,&$tr){
                $Type = $Datamodel->Props[$code]['type'];
                if($Type === 'timestamp') $td = strBefore($td,'.');
                elseif($Type === 'bool'){
                    //return $td === true ? ''
                    //return $td;
                }
                return $tr[$code] = $td;
            },array_keys($tr),array_values($tr));
            
            return array_merge(['row_index' => ++$Iterator ],$tr);
        },$Res);
        
        return $Res;
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