<?php
namespace Tilda\Tool;
use \Cmatrix\Db as db;

class Type {
    static $INSTANCES = [];
    protected $Code;
    
    protected $Common0 = [ 'id' ];
    protected $Common1 = [ 'type_id','name','code','code1','ratio','analog' ];
    protected $Common2 = [ 'vendor_id','info' ];    
    
    protected $Tree = [
        'Fr'        => [ 'FrMon','FrSbor','FrSpec','FrPeret', ],
        'FrMon'     => [ 'FrMonKonc','FrMonSfer','FrMonGrib','FrMonRez','FrMonDisk','FrMonFas', ],
        'FrSbor'    => [ 'FrGolPl','FrGolTs','OprGol','FrKorp','FrSborGrib','FrPl','FrSborKan','FrSborDisk','FrSborFas', ],
        'FrSborKan' => [ 'FrSborKanKorp','FrSborKanPl', ],
        
        'Osev'      => [ 'OsevSverMon','OsevRazv','OsevSverSbor','OsevMet','OsevPl','Rast','OsevSpec', ],
        'Rast'      => [ 'RastSyst','RastPl','RastOsn', ],
        
        'Tok'       => [ 'TokDer','TokRezMon','TokPl','Nak','TokSpec','TokMnogo', ],
        'Nak'       => [ 'NakDer','NakRoll', ],
        
        'Osn'       => [ 'OsnFr','OsnTok','OsnStan', ],
        'OsnFr'     => [ 'OsnFrTsan','OsnFrUdl','OsnFrPatr','OsnFrPatrReg','OsnFrBazDer','OsnFrPer','OsnFrOpr', ],
        'OsnTok'    => [ 'OsnTokAdap','OsnTokQTN','OsnTok150','OsnTok300', ],
        
        'Sles'      => [ 'SlesBor', ],
    ];
    
    protected $Props = [
// --- Fr
'Fr'            => [ 'material','d1','d2','d3','r','cf','l1','l2','l3',     'ap','ar','z','purpose','kind','angle','thread','pitch','pmin','pmax','adin','adout','tpl','spl', ],
'FrSpec'        => [ 'material' ],
'FrPeret'       => [ 'material','d1','d2','d3','r','cf','l1','l2',          'ap',     'z' ],

// --- Fr / FrMon
'FrMon'        =>  [ 'material','d1','d2','d3','r','cf','l1','l2',          'ap','ar','z','purpose','kind','angle','thread','pitch', ],
'FrMonKonc'    =>  [ 'material','d1','d2','d3','r','cf','l1','l2',          'ap',     'z','purpose','kind',                          ],
'FrMonSfer'    =>  [ 'material','d1','d2','d3',         'l1','l2',          'ap',     'z','purpose','kind',                          ],
'FrMonGrib'    =>  [ 'material','d1','d2','d3',         'l1','l2',          'ap',     'z','purpose','kind',                          ],
'FrMonRez'     =>  [ 'material','d1','d2',              'l1',               'ap',     'z','purpose','kind',        'thread','pitch', ],
'FrMonDisk'    =>  [ 'material','d1','d2',     'r','cf',                    'ap','ar','z','purpose','kind',                          ],
'FrMonFas'     =>  [ 'material','d1','d2','d3',         'l1','l2',          'ap',     'z','purpose','kind','angle',                  ],

// --- Fr / FrSbor
'FrSbor'        => [ 'material','d1','d2','d3','r','cf','l1','l2','l3',     'ap','ar','z','purpose','kind','angle','thread',         'pmin','pmax','adin',                 'adout','tpl','spl', ],
'FrGolPl'       => [ 'material','d1','d2',              'l1',               'ap',     'z',          'kind',                                        'adin',                 'adout',             ],
'FrGolTs'       => [ 'material','d1','d2',     'r','cf','l1',               'ap',     'z','purpose','kind',                                                                'adout',             ],
'OprGol'        => [ 'material',     'd2','d3',         'l1','l2',                                                                                 'adin',                 'adout',             ],
'FrKorp'        => [ 'material','d1','d2',              'l1',               'ap',     'z',          'kind',                                        'adin',                 'adout',             ],
'FrSborGrib'    => [ 'material','d1','d2','d3',         'l1','l2',          'ap','ar','z','purpose','kind',                                        'adin',                 'adout',             ],
'FrPl'          => [ 'material',               'r',                                       'purpose',                                                                               'tpl','spl', ],
'FrSborDisk'    => [ 'material','d1','d2',                                  'ap','ar','z','purpose','kind',                                        'adin',                 'adout',             ],
'FrSborFas'     => [ 'material','d1','d2','d3',         'l1','l2','l3',     'ap',     'z','purpose','kind','angle',                                'adin',                 'adout',             ],

// --- Fr / FrSbor / FrSborKan
'FrSborKan'     => [ 'material','d1','d2','d3','r',     'l1','l2',          'ap','ar','z','purpose',               'thread',         'pmin','pmax','adin',                 'adout','tpl','spl', ],
'FrSborKanKorp' => [                 'd2','d3',         'l1','l2',                                                                                 'adin',                 'adout',             ],
'FrSborKanPl'   => [ 'material','d1',          'r',                         'ap','ar','z','purpose',               'thread',         'pmin','pmax',                                'tpl','spl', ],
 
// --- Osev
'Osev'          => [ 'material','d1','d2',     'r',     'l1','l2','l3',     'ap',         'purpose','kind',        'thread','pitch',                                               'tpl','spl',      'coolin','t', ],
'OsevSverMon'   => [ 'material','d1','d2',              'l1',     'l3',     'ap',         'purpose',                                                                                                 'coolin',     ],
'OsevRazv'      => [ 'material','d1','d2',              'l1',     'l3',     'ap',         'purpose',                                                                                                          't', ],
'OsevSverSbor'  => [ 'material','d1','d2',              'l1',     'l3',     'ap',         'purpose',                                                                               'tpl','spl',      'coolin',     ],
'OsevMet'       => [ 'material','d1','d2',              'l1','l2',          'ap',                   'kind',        'thread','pitch',                                                                               ],
'OsevPl'        => [ 'material',               'r',                                       'purpose',                                                                               'tpl','spl',                    ],
'OsevSpec'      => [             ],

// --- Osev / Rast
'Rast'          => [ 'material',    'r',                                                            'kind','angle',                                                                'tpl','spl','fpl', ],
'RastSyst'      => [             ],
'RastPl'        => [ 'material',    'r',                                                            'kind','angle',                                                                'tpl','spl','fpl', ],
'RastOsn'       => [             ],

// --- Tok
'Tok'           => [ 'material',     'd2',     'r',     'l1',          'l4','ap','ar',              'kind','angle','thread',        'pmin','pmax','adin',                  'adout','tpl','spl','fpl',               'kr','f1','dmin','purpout','purpin','purptok'           ],
'TokDer'        => [                                    'l1',          'l4',     'ar',              'kind','angle',                                                        'adout',            'fpl',               'kr','f1','dmin','purpout','purpin','purptok','inserts' ],
'TokRezMon'     => [ 'material',                        'l1',          'l4','ap','ar',              'kind',        'thread',        'pmin','pmax',                         'adout',                                 'kr','f1','dmin','purpout','purpin','purptok',          ],
'TokPl'         => [ 'material',               'r',                         'ap',         'purpose','kind','angle','thread',        'pmin','pmax',                                 'tpl','spl','fpl',               'kr','f1','dmin',                   'purptok'           ],
'TokSpec'       => [             ],
'TokMnogo'      => [                 'd2',              'l1',                                       'kind',                                       'adin',                  'adout',                                 'kr','f1','dmin', ],

// --- Tok / Nak
'Nak'           => [                                    'l1',                                                               'pitch',                                        'adout',     'spl','fpl',                                                             'inserts','icount','regmin','regmax','d', ],
'NakDer'        => [                                    'l1',                                                                                                               'adout',                                                                              'inserts','icount','regmin','regmax',     ],
'NakRoll'       => [                                                                                                        'pitch',                                                     'spl','fpl',                                                                                                  'd', ],

// --- Osn
'Osn'           => [],
'OsnStan'       => [],
// --- Osn / OsnFr
'OsnFr'         => [                 'd2','d3',         'l1','l2',                                                                                'adin','adimin','adimax','adout',                  'coolin', ],
'OsnFrTsan'     => [                 'd2',              'l1',                                                                                            'adimin','adimax','adout',                  'coolin', ],
'OsnFrUdl'      => [                 'd2',              'l1',                                                                                     'adin',                  'adout',                            ],
'OsnFrPatr'     => [                 'd2','d3',         'l1','l2',                                                                                'adin',                  'adout',                            ],
'OsnFrPatrReg'  => [                 'd2','d3',         'l1','l2',                                                                                'adin',                  'adout',                            ],
'OsnFrBazDer'   => [                 'd2','d3',         'l1','l2',                                                                                'adin',                  'adout',                            ],
'OsnFrPer'      => [                 'd2','d3',         'l1','l2',                                                                                'adin',                  'adout',                            ],
'OsnFrOpr'      => [                 'd2','d3',         'l1','l2',                                                                                'adin',                  'adout',                            ],
// --- Osn / Osntok
'OsnTok'        => [],
'OsnTokAdap'    => [                 'd2',              'l1',                                       'kind','angle',                               'adin',                  'adout', ],
'OsnTokQTN'     => [                                                                                                                              'adin',                  'adout', 'tooltype', 'cooltype', 'm', 'orient' ],
'OsnTok150'     => [],
'OsnTok300'     => [],

// --- 
'Zap'           => [],

// --- Sles
'Sles'          => [],
'SlesBor'       => [             'd1',                                                                                                                                                         'fpl', ],

'Nabor'         => []
    ];
    
	// --- --- --- --- ---
	function __construct($typeId){
        $this->Code = db\Obbject::i('/Tilda/Tool/Type')->get($typeId)->code;
	}
    
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Props' : return $this->getMyProps();
            case 'Types' : return $this->getMyTypes();
            default : throw new ex\Property($this,$name);
        }
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    private function getMyProps(){
        $Props = isset($this->Props[$this->Code]) ? $this->Props[$this->Code] : [];
        $Props = array_merge($this->Common0,$this->Common1,$Props,$this->Common2);
        return $Props;
    }
    
    // --- --- --- --- ---
    private function getMyTypes(){
        //if(!array_key_exists($this->Code,$this->Tree)) return $this->Code;
        
        $Types = [];
        $_rec = function($code,&$Types) use(&$_rec){
            $Types[] = $code;
            
            if(array_key_exists($code,$this->Tree)) foreach($this->Tree[$code] as $code){
                $_rec($code,$Types);
            }
        };
        
        $_rec($this->Code,$Types);
        
        $Query = db\Cql::select('/Tilda/Tool/Type')->prop('id')->rule('code',$Types);
        $Res = db\Connect::i()->query($Query,7);
        return $Res;
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance($typeId){
        $Key = $typeId;
        if(array_key_exists($Key,self::$INSTANCES)) return self::$INSTANCES[$Key];
    
        return new self($typeId);
    }
    
    // --- --- --- --- ---
    static function i($typeId){
        return  self::instance($typeId);
    }
    
}


class Type222 {
    
    protected $Tree = [
        'Fr'        => [ 'FrMon','FrSbor','FrSpec','FrPeret', ],
        'FrMon'     => [ 'FrMonKonc','FrMonSfer','FrMonGrib','FrMonRez','FrMonDisk','FrMonFas', ],
        'FrSbor'    => [ 'FrGolPl','FrGolTs','OprGol','FrKorp','FrSborGrib','FrPl','FrSborKan','FrSborDisk','FrSborFas', ],
        'FrSborKan' => [ 'FrSborKanKorp','FrSborKanPl', ],
        
        'Osev'      => [ 'OsevSverMon','OsevRazv','OsevSverSbor','OsevMet','OsevPl','Rast','OsevSpec', ],
        'Rast'      => [ 'RastSyst','RastPl','RastOsn', ],
        
        'Tok'       => [ 'TokDer','TokRezMon','TokPl','Nak','TokSpec','TokMnogo', ],
        'Nak'       => [ 'NakDer','NakRoll', ],
        
        'Osn'       => [ 'OsnFr','OsnTok','OsnStan', ],
        'OsnFr'     => [ 'OsnFrTsan','OsnFrUdl','OsnFrPatr','OsnFrPatrReg','OsnFrBazDer','OsnFrPer','OsnFrOpr', ],
        'OsnTok'    => [ 'OsnTokAdap','OsnTokQTN','OsnTok150','OsnTok300', ],
        
        'Sles'      => [ 'SlesBor', ],
    ];
    
    protected $Props = [
// --- Fr
'Fr'            => [ 'material','d1','d2','d3','r','cf','l1','l2','l3',     'ap','ar','z','purpose','kind','angle','thread','pitch','pmin','pmax','adin','adout','tpl','spl', ],
'FrSpec'        => [ 'material' ],
'FrPeret'       => [ 'material','d1','d2','d3','r','cf','l1','l2',          'ap',     'z' ],

// --- Fr / FrMon
'FrMon'        =>  [ 'material','d1','d2','d3','r','cf','l1','l2',          'ap','ar','z','purpose','kind','angle','thread','pitch', ],
'FrMonKonc'    =>  [ 'material','d1','d2','d3','r','cf','l1','l2',          'ap',     'z','purpose','kind',                          ],
'FrMonSfer'    =>  [ 'material','d1','d2','d3',         'l1','l2',          'ap',     'z','purpose','kind',                          ],
'FrMonGrib'    =>  [ 'material','d1','d2','d3',         'l1','l2',          'ap',     'z','purpose','kind',                          ],
'FrMonRez'     =>  [ 'material','d1','d2',              'l1',               'ap',     'z','purpose','kind',        'thread','pitch', ],
'FrMonDisk'    =>  [ 'material','d1','d2',     'r','cf',                    'ap','ar','z','purpose','kind',                          ],
'FrMonFas'     =>  [ 'material','d1','d2','d3',         'l1','l2',          'ap',     'z','purpose','kind','angle',                  ],

// --- Fr / FrSbor
'FrSbor'        => [ 'material','d1','d2','d3','r','cf','l1','l2','l3',     'ap','ar','z','purpose','kind','angle','thread',         'pmin','pmax','adin',                 'adout','tpl','spl', ],
'FrGolPl'       => [ 'material','d1','d2',              'l1',               'ap',     'z',          'kind',                                        'adin',                 'adout',             ],
'FrGolTs'       => [ 'material','d1','d2',     'r','cf','l1',               'ap',     'z','purpose','kind',                                                                'adout',             ],
'OprGol'        => [ 'material',     'd2','d3',         'l1','l2',                                                                                 'adin',                 'adout',             ],
'FrKorp'        => [ 'material','d1','d2',              'l1',               'ap',     'z',          'kind',                                        'adin',                 'adout',             ],
'FrSborGrib'    => [ 'material','d1','d2','d3',         'l1','l2',          'ap','ar','z','purpose','kind',                                        'adin',                 'adout',             ],
'FrPl'          => [ 'material',               'r',                                       'purpose',                                                                               'tpl','spl', ],
'FrSborDisk'    => [ 'material','d1','d2',                                  'ap','ar','z','purpose','kind',                                        'adin',                 'adout',             ],
'FrSborFas'     => [ 'material','d1','d2','d3',         'l1','l2','l3',     'ap',     'z','purpose','kind','angle',                                'adin',                 'adout',             ],

// --- Fr / FrSbor / FrSborKan
'FrSborKan'     => [ 'material','d1','d2','d3','r',     'l1','l2',          'ap','ar','z','purpose',               'thread',         'pmin','pmax','adin',                 'adout','tpl','spl', ],
'FrSborKanKorp' => [                 'd2','d3',         'l1','l2',                                                                                 'adin',                 'adout',             ],
'FrSborKanPl'   => [ 'material','d1',          'r',                         'ap','ar','z','purpose',               'thread',         'pmin','pmax',                                'tpl','spl', ],
 
// --- Osev
'Osev'          => [ 'material','d1','d2',     'r',     'l1','l2','l3',     'ap',         'purpose','kind',        'thread','pitch',                                               'tpl','spl',      'coolin','t', ],
'OsevSverMon'   => [ 'material','d1','d2',              'l1',     'l3',     'ap',         'purpose',                                                                                                 'coolin',     ],
'OsevRazv'      => [ 'material','d1','d2',              'l1',     'l3',     'ap',         'purpose',                                                                                                          't', ],
'OsevSverSbor'  => [ 'material','d1','d2',              'l1',     'l3',     'ap',         'purpose',                                                                               'tpl','spl',      'coolin',     ],
'OsevMet'       => [ 'material','d1','d2',              'l1','l2',          'ap',                   'kind',        'thread','pitch',                                                                               ],
'OsevPl'        => [ 'material',               'r',                                       'purpose',                                                                               'tpl','spl',                    ],
'OsevSpec'      => [             ],

// --- Osev / Rast
'Rast'          => [ 'material',    'r',                                                            'kind','angle',                                                                'tpl','spl','fpl', ],
'RastSyst'      => [             ],
'RastPl'        => [ 'material',    'r',                                                            'kind','angle',                                                                'tpl','spl','fpl', ],
'RastOsn'       => [             ],

// --- Tok
'Tok'           => [ 'material',     'd2',     'r',     'l1',          'l4','ap','ar',              'kind','angle','thread',        'pmin','pmax','adin',                  'adout','tpl','spl','fpl',               'kr','f1','dmin','purpout','purpin','purptok'           ],
'TokDer'        => [                                    'l1',          'l4',     'ar',              'kind','angle',                                                        'adout',            'fpl',               'kr','f1','dmin','purpout','purpin','purptok','inserts' ],
'TokRezMon'     => [ 'material',                        'l1',          'l4','ap','ar',              'kind',        'thread',        'pmin','pmax',                         'adout',                                 'kr','f1','dmin','purpout','purpin','purptok',          ],
'TokPl'         => [ 'material',               'r',                         'ap',         'purpose','kind','angle','thread',        'pmin','pmax',                                 'tpl','spl','fpl',               'kr','f1','dmin',                   'purptok'           ],
'TokSpec'       => [             ],
'TokMnogo'      => [                 'd2',              'l1',                                       'kind',                                       'adin',                  'adout',                                 'kr','f1','dmin', ],

// --- Tok / Nak
'Nak'           => [                                    'l1',                                                               'pitch',                                        'adout',     'spl','fpl',                                                             'inserts','icount','regmin','regmax','d', ],
'NakDer'        => [                                    'l1',                                                                                                               'adout',                                                                              'inserts','icount','regmin','regmax',     ],
'NakRoll'       => [                                                                                                        'pitch',                                                     'spl','fpl',                                                                                                  'd', ],

// --- Osn
'Osn'           => [],
'OsnStan'       => [],
// --- Osn / OsnFr
'OsnFr'         => [                 'd2','d3',         'l1','l2',                                                                                'adin','adimin','adimax','adout',                  'coolin', ],
'OsnFrTsan'     => [                 'd2',              'l1',                                                                                            'adimin','adimax','adout',                  'coolin', ],
'OsnFrUdl'      => [                 'd2',              'l1',                                                                                     'adin',                  'adout',                            ],
'OsnFrPatr'     => [                 'd2','d3',         'l1','l2',                                                                                'adin',                  'adout',                            ],
'OsnFrPatrReg'  => [                 'd2','d3',         'l1','l2',                                                                                'adin',                  'adout',                            ],
'OsnFrBazDer'   => [                 'd2','d3',         'l1','l2',                                                                                'adin',                  'adout',                            ],
'OsnFrPer'      => [                 'd2','d3',         'l1','l2',                                                                                'adin',                  'adout',                            ],
'OsnFrOpr'      => [                 'd2','d3',         'l1','l2',                                                                                'adin',                  'adout',                            ],
// --- Osn / Osntok
'Osntok'        => [],
'OsnTokAdap'    => [                 'd2',              'l1',                                       'kind','angle',                               'adin',                  'adout', ],
'OsnTokQTN'     => [                                                                                                                              'adin',                  'adout', 'tooltype', 'cooltype', 'm', 'orient' ],
'OsnTok150'     => [],
'OsnTok300'     => [],

// --- Sles
'Sles'          => [],
'SlesBor'       => [             'd1',                                                                                                                                                         'fpl', ],

    ];

    protected $Code;
    
	// --- --- --- --- ---
	function __construct($type_id=null){
	    if($type_id) $this->Code = cm\Db\Object::get('tildaTool/Type',$type_id)->code;
	}
	
	// --- --- --- --- ---
	function __get($name){
	    switch($name){
	        case 'Props' : return $this->getMyProps();
	    }
	}

	// --- --- --- --- ---
    private function getMyProps(){
        // если не указан тип, то вернуть пустой мкассив !!! 
        return isset($this->Props[$this->Code]) ? $this->Props[$this->Code] : [];
        
        /*
        $props = Props::get();
        
        // определение набора свойств для type
        $_props = function() use($props){
            return array_merge($props->Common0,$props->Common1,(isset($this->Props[$this->Code]) ? $this->Props[$this->Code] : []),$props->Common2);
        };
        
        $model = cm\Datamodel::get('tildaTool/Tool');
        $allprops = $model->Props;
        
        // добавить def для полей
        $arr = [];
        array_map(function($prop) use($allprops,$props,&$arr){
            if(!isset($allprops[$prop])) $allprops[$prop] = [];
            $arr[$prop] = array_merge($allprops[$prop],isset($props->Defs[$prop]) ? $props->Defs[$prop] : []);
            
        },$_props());
        
        return $arr;
        */
	}

	// --- --- --- --- ---
	static function get($type_id=null){
        return new Type($type_id);
	}
    
}

?>