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
    
    private $P_Table;
    private $P_Tree;
    private $P_Props;

    // --- --- --- --- --- --- ---
    public function __construct($url){
        $this->Url = $url;
	}
	
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Props' : return $this->getMyProps();
            case 'Table' : return $this->getMyTable();
            case 'Tree'  : return $this->getMyTree();
            default : throw new ex\Property($this,$name);
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function getMyTable(){
        if($this->P_Table) return $this->P_Table;
        
        return $this->P_Table = [
            'rfilter' => web\Page::instance()->getParam('r'),
            'props' => $this->getMyProps(),
            'lines' => $this->getLines(),
        ];
    }
    
    // --- --- --- --- ---
    /**
     * Дерево для twig-шаблона
     */
    private function getMyTree(){
        if($this->P_Tree) return $this->P_Tree;
        
        $Props = kernel\Ide\Datamodel::i($this->Url)->Props;
        if(isset($Props['parent_id'])) $Query = db\Cql::select($this->Url)->props(['id','hid','name','parent_id'])->orders(['parent_id','ordd'])->limit(-1);
        else $Query = db\Cql::select($this->Url)->props(['id','hid','name',['NULL','parent_id']])->orders(['name'])->limit(-1);
        
        //dump($Query->Query);die();
        $Res = db\Connect::instance()->query($Query);
        
        $Res = array_combine(array_column($Res,'id'),$Res);
        
        $_rec = function($root=null) use($Res,&$_rec){
            $Arr = array_filter($Res,function($value) use($root){
                return $value['parent_id'] == $root;
            });
            $Arr = array_map(function($value) use(&$_rec){
                $value['label'] = $value['name'];
                $value['children'] = $_rec($value['id']);
                return $value;
            },$Arr);
            return $Arr;
        };
        $Res = $_rec();
        return $Res;
    }
    
    // --- --- --- --- ---
    private function getMyProps(){
        if($this->P_Props) return $this->P_Props;
        
        $Datamodel = kernel\Ide\Datamodel::instance($this->Url);
        
        $_type = function($code,$prop){
            if($prop['type'] === "::id::" && $prop['association']) return '::link::';
            else return $prop['type'];
        };
        
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
        
        $_filtrable = function($code,$prop){
            return $code!=='id';
        };
        
        $Props = [];
        array_map(function($code,$prop) use($_type,$_align,$_filtrable,&$Props){
            $prop['type'] = $_type($code,$prop);
            $prop['name'] = $prop['name'] ? kernel\Lang::str($prop['name']) : $prop['code'];
            $prop['label'] = $prop['label'] ? kernel\Lang::str($prop['label']) : ($prop['name'] ? kernel\Lang::str($prop['name']) : $prop['code']);
            $prop['baloon'] = $prop['baloon'] ? kernel\Lang::str($prop['baloon']) : null;
            $prop['sortable'] = true;
            $prop['filtrable'] = $_filtrable($code,$prop);
            $prop['align'] = $_align($code,$prop);
            
            $Props[$code] = $prop;
        },array_keys($Datamodel->OwnProps),array_values($Datamodel->OwnProps));
        
        // pfilter
        $Pfilter = web\Page::instance()->getParam('f',true);
        $Props =  array_map(function($prop) use($Pfilter){
            //dump($prop);
            if($prop['type'] === '::link::') $prop['_combobox'] = web\Ide\Datamodel::instance($prop['association']['entity'])->Tree;
            if(isset($Pfilter[$prop['code']])) $prop['_filter'] = $Pfilter[$prop['code']];
            return $prop;
        },$Props);
        
        //sort
        $Sort = web\Page::instance()->getParam('s',true);
        //dump($Sort);
        
        $Props =  array_map(function($prop) use($Sort){
            if(isset($Sort[$prop['code']])) $prop['_sort'] = $Sort[$prop['code']];
            return $prop;
        },$Props);
        
        return $this->P_Props = array_merge([
            'row_index'=>[
                'code' => 'row_index',
                'type' => '::index::',
                'baloon' => 'Выбрать все записи',
                'sortable' => false,
                'align' => 'center',
                'filtrable' => false
            ]
        ],$Props);
    }
        
    // --- --- --- --- ---
    private function getLines(){
        $Datamodel = kernel\Ide\Datamodel::instance($this->Url);
        $Props = array_flip(array_keys($this->Props));
        array_shift($Props);
        
        $Sort = web\Page::instance()->getParam('s',true);
        if($Sort) $Sort = array_map(function($key,$value){ return $value .'::'. $key; },array_keys($Sort),array_values($Sort));
        else $Sort = ['id'];
        
        $Query = db\Cql::select($Datamodel)->props(array_keys($Props))->rule('active',true)->limit(10)->orders($Sort);
        //dump($Query->Query);
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
    
    // --- --- --- --- ---
    static function i($url){
        return self::instance($url);
    }
}
?>