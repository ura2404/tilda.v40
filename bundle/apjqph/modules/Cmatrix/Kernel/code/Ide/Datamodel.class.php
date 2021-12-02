<?php
namespace Cmatrix\Kernel\Ide;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;

/**
 * Class \Cmatrix\Web\Ide\Datamodel
 * Получени любой инофрмации о datamodel
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
class Datamodel implements iDatamodel{
    private $P_Url = null;
    private $P_Name = null;
    private $P_Path = null;
    private $P_Json = null;
    private $P_Props = null;
    private $P_OwnProps = null;
    
    // --- --- --- --- ---
    function __construct(){
        $this->prepare();
    }
    
    // --- --- --- --- ---
    function __get($name){
        switch($name){
            case 'Url' : return $this->getMyUrl();
            case 'Code' : return $this->Json['code'];
            case 'Name' : return cm\Lang::str($this->Json['name']);
            case 'Baloon' : return cm\Lang::str($this->Json['baloon']);
            case 'Parent' : return $this->getMyParent();
            case 'Path' : return $this->getMyPath();
            case 'Json' : return $this->getMyJson();
            case 'OwnProps' : return $this->getMyOwnProps();
            case 'Props' : return $this->getMyProps();
            case 'OwnUniques' : return $this->getMyOwnUniques();
            case 'Uniques' : return $this->getMyUniques();
            case 'OwnIndexes' : return $this->getMyOwnIndexes();
            case 'Indexes'    : return $this->getMyIndexes();
            case 'OwnAssociation' : return $this->getMyOwnAssociation();
            case 'Association' : return $this->getMyAssociation();
            default : throw new ex\Property($this,$name);
        }
    }
    
    // --- --- --- --- ---
    protected function prepare(){
        //dump($this->Props);
    }
    
    // --- --- --- --- ---
    /*protected function getMyIsNew(){
        
    }*/

    // --- --- --- --- ---
    protected function getMyUrl(){
        if($this->P_Url !== null) return $this->P_Url;
        return $this->P_Url = '/'. str_replace('\\','/',implode('\\',explode('\Dm\\',get_class($this))));
    }
    
    // --- --- --- --- ---
    protected function getMyParent(){
        $ParentUrl = $this->Json['parent'];
        return $ParentUrl ? self::instance($ParentUrl) : null;
    }

    // --- --- --- --- ---
    /**
     * @return string - parh to json datamodel file
     */
    protected function getMyPath(){
        if($this->P_Path !== null) return $this->P_Path;
        
        $Path = kernel\Ide\Module::instance($this->Url)->Path;
        $Url = kernel\Ide\Module::instance($this->Url)->Url;
        $Path = $Path .'/dm'. strAfter($this->Url,$Url) .'.dm.json';
        if(!file_exists($Path)) throw new \Exception('Datamodel "'. $this->Url .'" is not found.');
        
        return $this->P_Path = $Path;
    }
    
    // --- --- --- --- ---
    protected function getMyJson(){
        if($this->P_Json !== null) return $this->P_Json;
        return $this->P_Json = kernel\Json::getFile($this->Path)->Data;
    }
    
    // --- --- --- --- ---
    protected function getMyProps(){
        if($this->P_Props !== null) return $this->P_Props;
        
        $ParentProps = $this->Parent ? $this->Parent->Props : [];
        $ParentProps = array_map(function($prop){
            unset($prop['own']);
            return $prop;
        } ,$ParentProps);
        
        return $this->P_Props = arrayMergeReplace($ParentProps,$this->OwnProps);
    }

    // --- --- --- --- ---
    protected function getMyOwnProps(){
        if($this->P_OwnProps !== null) return $this->P_OwnProps;
        
        return $this->P_OwnProps = array_map(function($prop){
            $prop['own'] = true;
            return $prop;
        } ,$this->Json['props']);
    }
    
    // --- --- --- --- ---
    protected function getMyUniques(){
        $Uniques = $this->OwnUniques;
        $ParentUniques = $this->Parent ? $this->Parent->OwnUniques : [];
        return array_merge($ParentUniques,$Uniques);
    }

    // --- --- --- --- ---
    protected function getMyOwnUniques(){
        $Uniques = $this->Json['uniques'];
        
        return array_map(function($group){
            return array_map(function($prop){
                return $this->getProp($prop);
            },$group);
        },is_array($Uniques) ? $Uniques : []);
    }

    // --- --- --- --- ---
    protected function getMyIndexes(){
        $Indexes = $this->OwnIndexes;
        $ParentIndexes = $this->Parent ? $this->Parent->OwnIndexes : [];
        return array_merge($ParentIndexes,$Indexes);
    }
    
    // --- --- --- --- ---
    protected function getMyOwnIndexes(){
        $Indexes = $this->Json['indexes'];
        
        return array_map(function($group){
            return array_map(function($prop){
                return $this->getProp($prop);
            },$group);
        },is_array($Indexes) ? $Indexes : []);
    }
    
    // --- --- --- --- ---
    protected function getMyAssociation(){
        $Association = $this->OwnAssociation;
        $ParentAssociation = $this->Parent ? $this->Parent->OwnAssociation : [];
        return array_merge($ParentAssociation,$Association);
    }
    
    protected function getMyOwnAssociation(){
        $Association = array_values(array_filter($this->Json['props'],function($prop){ return !!$prop['association']; }));
        //dump($Association);die();
        
        return $Association;
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    public function getProp($propName){
        if($propName === 'NULL') return;
        if(!isset($this->Props[$propName])) throw new \Exception('Wrong entity "' .$this->Url. '" prop "' .$propName. '"');
        return $this->Props[$propName];
    }
    
    // --- --- --- --- ---
    // --- --- --- --- ---
    // --- --- --- --- ---
    static function instance($url){
        $Cl = self::cl($url);
        return new $Cl();
    }
    
    // --- --- --- --- ---
    static function i($url){
        return  self::instance($url);
    }
    
    // --- --- --- --- ---
    static function cl($url){
        $Url = kernel\Ide\Module::instance($url)->Url;
        $Cl = str_replace('/','\\',$Url .'/Dm'. strAfter($url,$Url));
        return $Cl;
    }
}
?>