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
    
    private $PropsNeed = [];
    private $Rules = [];
    
    private $P_Props;
    private $P_Lines;
    private $P_Pager;
    private $P_Limit;
    private $P_Sort;
    private $P_Rfilter;
    private $P_Pfilter;
    
    
    private $P_Table;
    private $P_Tree;

    // --- --- --- --- --- --- ---
    public function __construct($url){
        $this->Url = $url;
	}
	
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Props' : return $this->getProps();
            case 'Lines' : return $this->getLines();
            case 'Total' : return $this->getMyTotal();
            case 'Pager' : return $this->getMyPager();
            case 'Limit' : return $this->getMyLimit();
            case 'Sort'  : return $this->getMySort();
            
            case 'Rfilter' : return $this->getMyRfilter();
            case 'Pfilter' : return $this->getMyPfilter();
            
            //case 'Table' : return $this->getMyTable();
            case 'Tree'  : return $this->getMyTree();
            default : throw new ex\Property($this,$name);
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function propType($code,$prop){
        if($prop['type'] === "::id::" && $prop['association']) return '::link::';
        else return $prop['type'];
    }

    // --- --- --- --- ---
    private function propAlign($code,$prop){
        
    }
    
    // --- --- --- --- ---
    private function propSortable($code,$prop){
        return true;
    }
    
    // --- --- --- --- ---
    private function propFiltrable($code,$prop){
        return $code!=='id';
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    public function getProps(\Closure $_callback=null){
        if($this->P_Props) return $this->P_Props;
        
        $_callback = $_callback ? $_callback : function($code,$prop){};
        
        $Datamodel = kernel\Ide\Datamodel::i($this->Url);
        
        $Props = $Datamodel->OwnProps;
        if($this->PropsNeed){
            $Arr = [];
            array_map(function($code) use(&$Arr,$Props){
                if(isset($Props[$code])) $Arr[$code] = $Props[$code];
            },$this->PropsNeed);
            $Props = $Arr;
        }
        
        $Arr = [];
        array_map(function($code,$prop) use(&$Arr,$_callback){
            $prop['type'] = $this->propType($code,$prop);
            $prop['name'] = $prop['name'] ? kernel\Lang::str($prop['name']) : $prop['code'];
            $prop['label'] = $prop['label'] ? kernel\Lang::str($prop['label']) : ($prop['name'] ? kernel\Lang::str($prop['name']) : $prop['code']);
            $prop['baloon'] = $prop['baloon'] ? kernel\Lang::str($prop['baloon']) : null;
            $prop['align'] = $this->propAlign($code,$prop);
            $prop['sortable'] = $this->propSortable($code,$prop);
            $prop['filtrable'] = $this->propFiltrable($code,$prop);
            
            if(isset($this->Pfilter[$code])) $prop['_filter'] = $this->Pfilter[$code];
            if(isset($this->Sort[$code])) $prop['_sort'] = strBefore($this->Sort[$code],'::');
            if($prop['type'] === '::link::') $prop['_combobox'] = web\Ide\Datamodel::instance($prop['association']['entity'])->Tree;
            
            $prop = $_callback($code,$prop);
            
            $Arr[$code] = $prop;
        },array_keys($Props),array_values($Props));
        
        return $this->P_Props = $Arr;
        
        /*
        return $this->P_Props = array_merge([
            'row_index'=>[
                'code' => 'row_index',
                'type' => '::index::',
                'baloon' => 'Выбрать все записи',
                'sortable' => false,
                'align' => 'center',
                'filtrable' => false
            ]
        ],$Arr);
        */
    }
    
    // --- --- --- --- ---
    public function getLines(\Closure $_callback=null){
        if($this->P_Lines) return $this->P_Lines;
        
        $_callback = $_callback ? $_callback : function($code,$prop){};
        
        $Datamodel = kernel\Ide\Datamodel::i($this->Url);
        
        $Props = array_flip(array_keys($this->Props));
        //array_shift($Props); // --- удалить ::index::
        
        $Query = db\Cql::select($Datamodel)->props(array_keys($Props))->rules($this->Rules)->rule('active',true)->limit($this->Limit)->orders($this->Sort);
        
        array_map(function($prop) use(&$Query){
            //if($prop['type'] === '::link::') $Query->join($prop['association']['entity'],[$prop['code'],$prop['association']['prop']]);
            //dump($prop);
        },$this->Props);
        
        //dump($Query->Query);
        
        $Res = db\Connect::instance()->query($Query);
        
        $Arr = [];
        array_map(function($index,$line) use(&$Arr,$Props,$_callback){
            $Arr[$index] = $_callback($index,$line);
        },array_keys($Res),array_values($Res));
        
        return $Arr;
    }    
    
    // --- --- --- --- ---
    public function setRule($code,$value){
        $this->Rules[$code] = $value;
        return $this;
    }

    // --- --- --- --- ---
    /**
     * @param array $props - массив необходимых свойств
     */
    public function setProps(array $props){
        $this->PropsNeed = $props;
        return $this;
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function getMyPager(){
        if($this->P_Pager) return $this->P_Pager;
        
        $Pager = web\Page::instance()->getParam('p');
        $Pager = $Pager ? explode(',',$Pager) : [20,0]; // 10 - строк, 0 - страница
        
        $Page = $Pager[1];
        $Count = $Pager[0];
        
        $Total = $this->Total;
        $Pages = ceil($Total / $Count);
        
        if($Page > $Pages) $Page = 0;
        
        if($Page == 0) $Hfirst = $Hprev = null;
        else{
            $Hfirst = web\Page::instance()->calculateUrl('p',$Count.',0');
            $Hprev = web\Page::instance()->calculateUrl('p',$Count.','.($Page-1));
        }
        
        if($Page == $Pages - 1) $Hlast = $Hnext = null;
        else{
            $Hlast = web\Page::instance()->calculateUrl('p',$Count.','.($Pages-1));
            $Hnext = web\Page::instance()->calculateUrl('p',$Count.','.($Page+1));
        }
        
        $Arr = [
            'count' => $Count,
            'page' => $Page,
            'total' => $Total,
            'pages' => $Pages,
            'hfirst' => $Hfirst,
            'hprev' => $Hprev,
            'hnext' => $Hnext,
            'hlast' => $Hlast
        ];
        //dump($Arr);die();
        
        return $this->P_Pager = $Arr;
    }
    
    // --- --- --- --- ---
    private function getMyTotal(){
        $Datamodel = kernel\Ide\Datamodel::instance($this->Url);
        $Query = db\Cql::select($Datamodel)->prop('count::id')->rules($this->Rules)->rule('active',true);
        //dump($Query->Query);die();
        
        $Res = db\Connect::instance()->query($Query,7)[0];
        return $Res;
    }
    
    // --- --- --- --- ---
    private function getMyLimit(){
        if($this->P_Limit) return $this->P_Limit;
        
        $Count = $this->Pager['count'];
        $Offset = $this->Pager['page']*$this->Pager['count'];
        //if($Offset > $this->Total) $Offset = 0;
        
        return $this->P_Limit = [$Count,$Offset];
    }
    
    // --- --- --- --- ---
    private function getMySort(){
        if($this->P_Sort) return $this->P_Sort;
        
        $Sort = web\Page::instance()->getParam('s',true);
        if($Sort){
            $Arr = [];
            array_map(function($key,$value) use(&$Arr){
                $Arr[$key] = $value .'::'. $key;
            },array_keys($Sort),array_values($Sort));
            $Sort = $Arr;
            
            //$Sort = array_map(function($key,$value){ return $value .'::'. $key; },array_keys($Sort),array_values($Sort));
        }
        else $Sort = ['id' => 'id'];
        
        return $this->P_Sort = $Sort;
    }
    
    // --- --- --- --- ---
    private function getMyRfilter(){
        if($this->P_Rfilter) return $this->P_Rfilter;
        return $this->P_Rfilter = web\Page::instance()->getParam('r');
    }
    
    // --- --- --- --- ---
    private function getMyPfilter(){
        if($this->P_Pfilter) return $this->P_Pfilter;
        return $this->P_Pfilter = web\Page::instance()->getParam('f',true);
    }


    
    /*
    // --- --- --- --- ---
    private function getLines2(){
        $Datamodel = kernel\Ide\Datamodel::instance($this->Url);
        $Props = array_flip(array_keys($this->Props));
        array_shift($Props);
        
        $Sort = web\Page::instance()->getParam('s',true);
        if($Sort) $Sort = array_map(function($key,$value){ return $value .'::'. $key; },array_keys($Sort),array_values($Sort));
        else $Sort = ['id'];
        
        $Limit = [$this->Pager['count'],$this->Pager['page']*$this->Pager['count']];
        
        $Query = db\Cql::select($Datamodel)->props(array_keys($Props))->rule('active',true)->limit($Limit)->orders($Sort);
        //dump($Query->Query);
        $Res = db\Connect::instance()->query($Query);
        
        $Iterator = $this->Pager['count']*$this->Pager['page'];
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
        //dump($Res);
        
        return $Res;
    }
    */





    
    
    
    
    
    
    /*
    private function getMyTable(){
        if($this->P_Table) return $this->P_Table;
        
        return $this->P_Table = [
            'rfilter' => web\Page::instance()->getParam('r'),
            'props' => $this->getMyProps(),
            'lines' => $this->getLines(),
            'pager' => $this->getMyPager()
        ];
    }
    */
    
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
    
    /*
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
    */
        
    /*
    // --- --- --- --- ---
    private function getMyPager2(){
        if($this->P_Pager) return $this->P_Pager;
        
        $Pager = web\Page::instance()->getParam('p');
        $Pager = $Pager ? explode(',',$Pager) : [10,0]; // 10 - строк, 0 - страница
        
        $Page = $Pager[1];
        $Count = $Pager[0];
        
        $Total = $this->getTotal();
        $Pages = ceil($Total / $Count);
        
        if($Page == 0) $Hfirst = $Hprev = null;
        else{
            $Hfirst = web\Page::instance()->calculateUrl('p',$Count.',0');
            $Hprev = web\Page::instance()->calculateUrl('p',$Count.','.($Page-1));
        }
        
        if($Page == $Pages - 1) $Hlast = $Hnext = null;
        else{
            $Hlast = web\Page::instance()->calculateUrl('p',$Count.','.($Pages-1));
            $Hnext = web\Page::instance()->calculateUrl('p',$Count.','.($Page+1));
        }
        
        $Arr = [
            'count' => $Count,
            'page' => $Page,
            'total' => $Total,
            'pages' => $Pages,
            'hfirst' => $Hfirst,
            'hprev' => $Hprev,
            'hnext' => $Hnext,
            'hlast' => $Hlast
        ];
        //dump($Arr);die();
        
        return $this->P_Pager = $Arr;
    }
    */
    
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