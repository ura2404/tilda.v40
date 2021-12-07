<?php
namespace Cmatrix\Db;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

class Cql{
    private $Datamodel;
    private $StructureProvider;
    
    private $Cond;
    private $Queries = [];
    private $Tables  = [];
    private $Props   = [];
    private $Agg     = [];
    private $Rules   = [];
    private $Values  = [0=>[]];    // массив массиво значений
    private $Orders  = [];
    private $Limit   = [];
    
    // --- --- --- --- ---
    /**
     * @param $cond - тип запроса select|insert|update|delete
     */
    function __construct(kernel\Ide\iDatamodel $datamodel,$cond){
        $this->Datamodel = $datamodel;
        $this->Cond = $cond;
        $this->StructureProvider = $this->setProvider();
    }
    
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Query' : return $this->getMyQuery();
            default : throw new ex\Property($this,$name);
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function setProvider(){
        $ProviderName = kernel\Config::instance()->getValue('db/type');
        return Structure\Datamodel\Provider::instance($ProviderName,$this->Datamodel);
    }
    
    // --- --- --- --- ---
    private function getMyQuery(){
        switch($this->Cond){
            case 'select' : return $this->getMySelectQuery();
            case 'insert' : return $this->getMyInsertQuery();
            case 'update' : return $this->getMyUpdateQuery();
            case 'delete' : return $this->getMyDeleteQuery();
        }
        
    }
    
    // --- --- --- --- ---
    private function getMySelectQuery(){
        $_props = function(){
            $_agg = function($code){
                return $this->StructureProvider->ConnectProvider->getSqlAgg($code);
            };
            
            return array_map(function($prop) use($_agg){
                return is_array($prop) ? $_agg($prop[0]) .' AS '. $prop[1] : $_agg($prop);
            },$this->Props);
        };
        
        $_rules = function(){
            $Props = $this->Datamodel->Props;
            $Arr = array_map(function($rule) use($Props){
                $Code = $rule[0];
                $Value = $rule[1];
                $Cond = $rule[2];
                return $this->StructureProvider->ConnectProvider->sqlPhrase($Props[$Code],$Value,$Cond);
            },$this->Rules);
            return 'WHERE '. implode(' AND ',$Arr);
        };
        
        $_orders = function(){
            $Orders = array_map(function($code){
                return $this->StructureProvider->ConnectProvider->getSqlOrd($code);
            },$this->Orders);
            return 'ORDER BY ' . implode(',',$Orders);
        };
        
        $_limit = function(){
            $Limit = $this->Limit;
            return 'LIMIT '. $Limit[0] .' OFFSET '. $Limit[1];
        };
        
        $Queries = [];
        $Queries[] = 'SELECT ' . ($this->Props ? implode(',',$_props()) : '*');
        $Queries[] = 'FROM '. $this->StructureProvider->sqlTableName() .' AS t1';
        
        $Query = $this->Rules ? $_rules() : null;
        $Queries[] = $Query;        
        
        $Query = $this->Orders ? $_orders() : null;
        $Queries[] = $Query;
        
        // кое-какая защита от выборки большим объёмов строк
        // если задан лимит - хорошо, если нет, то смотрим наличие условый, если они есть - хорошо, иначе устанавливаем принудительный лимит
        if($this->Limit != -1){
            $this->Limit = $this->Limit ? $this->Limit : ($this->Rules ? null : [100,0]);
            $Query = $this->Limit ? $_limit() : null;
            $Queries[] = $Query;
        }
        
        $Queries = array_filter($Queries,function($value){ return !!$value; });
        //dump($Queries);die();
        
        return implode(' ',$Queries);
    }
    
    // --- --- --- --- ---
    private function getMyInsertQuery(){
        $_props = function(){
            $Key0 = array_keys($this->Values)[0];
            $Values0 = $this->Values[$Key0];
            
            $Arr = array_map(function($value){
                return $value;
            },array_keys($Values0));
            
            return '(' . implode(',',$Arr) . ')';
        };
        
        $_values = function(){
            $Arr = array_map(function($block){
                $Arr = array_map(function($code,$value){
                    return $this->StructureProvider->ConnectProvider->sqlValue($this->Datamodel->Props[$code],$value);
                },array_keys($block),array_values($block));
                return '(' . implode(',',$Arr) . ')';
            },$this->Values);
            
            return implode(',',$Arr);
            
            /*return array_map(function($code,$value){
                return $this->StructureProvider->ConnectProvider->sqlValue($this->Datamodel->Props[$code],$value);
            },array_keys($this->Values),array_values($this->Values));*/
        };
        
        $Queries = [];
        $Queries[] = 'INSERT INTO ' . $this->StructureProvider->sqlTableName();
        $Queries[] = $_props();
        $Queries[] = 'VALUES ' . $_values();
        
        return implode(' ',$Queries);
    }

    // --- --- --- --- ---
    private function getMyUpdateQuery(){
        if(!$this->Rules) return;
        
        $_values = function(){
            return array_map(function($code,$value){
                return $this->StructureProvider->ConnectProvider->sqlPhrase($this->Datamodel->Props[$code],$value,'=',false);
            },array_keys($this->Values[0]),array_values($this->Values[0]));
        };
        
        $_rules = function(){
            $Props = $this->Datamodel->Props;
            $Arr = array_map(function($rule) use($Props){
                $Code = $rule[0];
                $Value = $rule[1];
                $Cond = $rule[2];
                return $this->StructureProvider->ConnectProvider->sqlPhrase($Props[$Code],$Value,$Cond);
            },$this->Rules);
            return 'WHERE '. implode(' AND ',$Arr);
        };
        
        /*$_rules = function(){
            return array_map(function($code,$value){
                return $this->StructureProvider->ConnectProvider->sqlPhrase($this->Datamodel->Props[$code],$value);
            },array_keys($this->Rules),array_values($this->Rules));
        };*/
        
        $Queries = [];
        $Queries[] = 'UPDATE ' . $this->StructureProvider->sqlTableName();
        
        if($this->Values) $Queries[] = 'SET ' . implode(',',$_values());
        if($this->Rules) $Queries[] = $_rules();
        
        return implode(' ',$Queries);
    }
    
    // --- --- --- --- ---
    private function getMyDeleteQuery(){
        if(!$this->Rules) return;
        
        $_rules = function(){
            $Props = $this->Datamodel->Props;
            return array_map(function($code,$value) use($Props){
                return $this->StructureProvider->ConnectProvider->sqlPhrase($Props[$code],$value);
            },array_keys($this->Rules),array_values($this->Rules));
        };
        
        $Queries = [];
        $Queries[] = 'DELETE FROM ' . $this->StructureProvider->sqlTableName();
        $Queries[] = 'WHERE ' . implode(' AND ',$_rules());
        
        return implode(' ',$Queries) .';';
    }
    
    // --- --- --- --- ---
    private function checkProp($code){
        if(is_array($code)) $this->Datamodel->getProp($code[0]);
        elseif(strpos($code,'::')!==false) $this->Datamodel->getProp(strAfter($code,'::'));
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    public function fun(\Closure $fun){
        $fun($this);
        return $this;
    }
    
    // --- --- --- --- ---
    /**
     * @param string|array $code
     *     -'id'
     *     -'max::id' - с агрегатной функцией
     *     -['max::id','max_value'] - с алиасом
     */
    public function prop($code){
        $this->checkProp($code);
        $this->Props[] = $code;
        return $this;
    }
    
    // --- --- --- --- ---
    public function props(array $props){
        if(!$props) return $this;
        
        array_map(function($code){
            $this->prop($code);
        },$props);
        
        return $this;
    }
    
    // --- --- --- --- ---
    public function value($code,$value){
        $this->checkProp($code);
        $this->Values[0][$code] = $value;
        return $this;
    }
    
    // --- --- --- --- ---
    public function values(array $values=null){
        if(!$values) return $this;
        
        array_map(function($code,$value){
            $this->value($code,$value);
        },array_keys($values),array_values($values));
        
        return $this;
    }

    // --- --- --- --- ---
    public function valuesArr(array $values=null){
        if(!$values) return $this;
        $this->Values = $values;
        return $this;
    }
    
    // --- --- --- --- ---
    public function rule($code,$value,$cond='='){
        $this->checkProp($code);
        $this->Rules[] = [$code,$value,$cond];
        return $this;
    }
    
    // --- --- --- --- ---
    /**
     * @param array $rules
     *     [
     *         [code,value,cond]
     *     ]
     *     или
     *     [
     *         code1 => $value1,
     *         code2 => $value2,
     *         code3 => $value3,
     *     ]
     */
    public function rules(array $rules=null){
        if(!$rules) return $this;

        if(array_key_first($rules) !== 0) $rules = array_map(function($code,$value){
            return [$code,$value];
        },array_keys($rules),array_values($rules));

        array_map(function($rule){
            if(!array_key_exists(0,$rule) || !array_key_exists(1,$rule)) throw new ex('Wrong rules format');
            $Code = $rule[0];
            $Value = $rule[1];
            $Cond = isset($rule[2]) ? $rule[2] : '=';
            $this->rule($Code,$Value,$Cond);
        },$rules);
        
        return $this;
    }
    
    // --- --- --- --- ---
    /**
     * @param string $code
     *     -name - name ASC
     *     -a::name name ACS
     *     -d::name name DESC
     */
    public function order($code){
        $this->checkProp($code);
        $this->Orders[] = $code;
        return $this;
    }

    // --- --- --- --- ---
    public function orders(array $orders=null){
        if(!$orders) return $this;
        
        array_map(function($code){
            $this->order($code);
        },$orders);
        
        return $this;
    }

    // --- --- --- --- ---
    /**
     * @param string|array $limit
     *     -1000 - тысяча стоок, смещение 0
     *     -[100,0] - сто строк, смещение 0
     */
    public function limit($limit=null){
        if(!$limit) return $this;
        
        if($limit == -1) $this->Limit = -1;
        else $this->Limit = is_array($limit) ?  $limit : [$limit,0];
        
        /*
        if(!is_array($limit)) $limit = ['count' => $limit, 'page' =>0 ];
        
        $this->Limit = [
            $limit['count'],
            $limit['page']*$limit['count']
        ];
        */
        return $this;
    }

    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    /**
     * @param \Cmatrix\Ide\iDatamodel
     */
    static function select($datamodel){
        if($datamodel instanceof kernel\Ide\iDatamodel) $Datamodel = $datamodel;
        else $Datamodel = kernel\Ide\Datamodel::instance($datamodel);
        return new self($Datamodel,'select');
    }
    
    // --- --- --- --- ---
    /**
     * @param \Cmatrix\Ide\iDatamodel
     */
    static function insert($datamodel){
        if($datamodel instanceof kernel\Ide\iDatamodel) $Datamodel = $datamodel;
        else $Datamodel = kernel\Ide\Datamodel::instance($datamodel);
        return new self($Datamodel,'insert');
    }
    
    // --- --- --- --- ---
    /**
     * @param \Cmatrix\Ide\iDatamodel
     */
    static function update($datamodel){
        if($datamodel instanceof kernel\Ide\iDatamodel) $Datamodel = $datamodel;
        else $Datamodel = kernel\Ide\Datamodel::instance($datamodel);
        return new self($Datamodel,'update');
    }
    
    // --- --- --- --- ---
    /**
     * @param \Cmatrix\Ide\iDatamodel
     */
    static function delete($datamodel){
        if($datamodel instanceof kernel\Ide\iDatamodel) $Datamodel = $datamodel;
        else $Datamodel = kernel\Ide\Datamodel::instance($datamodel);
        return new self($Datamodel,'delete');
    }
}
?>