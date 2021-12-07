<?php
namespace Tilda\Tool\Models;
use \Cmatrix\Web as web;
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Kernel\Exception as ex;
use \Cmatrix\Db as db;
use \Tilda as tilda;

class Catalogue extends Tool implements web\Mvc\iModel {
    
    private $Entity = '/Tilda/Tool/Tool';
    private $Datamodel;
    private $TypeId;
    
    private $P_Props;
    private $P_Lines;
    
    // --- --- --- --- ---
    public function getData(){
        
        $this->Datamodel = web\Ide\Datamodel::i($this->Entity);
        if($this->ToolTypeId = web\Page::instance()->getParam('tp')){
            $this->Datamodel
                //->setRule('type_id',$this->ToolTypeId)
                ->setRule('type_id',\Tilda\Tool\Type::i($this->ToolTypeId)->Types)
                ->setProps(\Tilda\Tool\Type::i($this->ToolTypeId)->Props);
        }
        
        return arrayMergeReplace(parent::getData(),[
            'table' => [
                'props' => $this->getMyProps(),
                'lines' => $this->getMyLines(),
                'pager' => $this->Datamodel->Pager,
                'rfilter' => $this->Datamodel->Rfilter,
                //'pfilter' => $Datamodel->Pfilter,
                //'sort' => $Datamodel->Sort,
            ],
            'filterTabIndex' => $this->getFilterTabIndex(),
            
            //'table' => $this->getMyTable(),
            //'tree' => web\Ide\Datamodel::instance('/Tilda/Tool/Type')->Tree,
            //'filter' => $this->getMyfilters(),
        ]);
    }
    
    // --- --- --- --- ---
    private function getFilterTabIndex(){
        $Index = web\Page::instance()->getParam('rs');
        return $Index === 'pfilter' ? 2 : 1;
    }
    
    // --- --- --- --- ---
    private function getMyProps(){
        if($this->P_Props) return $this->P_Props;
        
        //$TypeCode = $this->getMyTypeCode();
        $Props = $this->Datamodel->getProps(function($code,$prop){
            if($code === 'id' || $code === 'systype') $prop['hidden'] = true;
            if($code === 'ratio') $prop['hidden'] = true;
            if($code === 'type_id') $prop['hidden'] = true;
            return $prop;
        });
        
        //dump(\Tilda\Tool\Type::i($this->ToolTypeId)->Props);
        
        return $this->P_Props = $Props;
    }

    // --- --- --- --- ---
    /*
    private function getMyTypeCode(){
        $Pfilter = web\Page::instance()->getParam('f',true);
        $ToolType = isset($Pfilter['type_id']) ? $Pfilter['type_id'][array_key_first($Pfilter['type_id'])] : null;
        if(!$ToolType) return;
        
        $Query = db\Cql::select('/Tilda/Tool/Type')->prop('code')->rule('id',$ToolType[0]);
        $Result = db\Connect::i()->query($Query,7);
        if(!$Result) return;
        
        $ToolTypeCode = $Result[0];
        return $ToolTypeCode;
    }
    */

    // --- --- --- --- ---
    private function getMyLines(){
        if($this->P_Lines) return $this->P_Lines;
        
        $Arr = $this->Datamodel->getLines(function($index,$line){
            if(isset($line['material']) && $line['material']) $line['material'] = $this->parseMaterial($line['material']);
            return $line;
        });
        
        return $this->P_Lines = $Arr;
    }
    
    // --- --- --- --- ---
    private function parseMaterial($value){
        if(!$value) return;
        
        $_title = function($material,$c){
                 if($material === 'p' && $c === 'c2') return 'Предпочтительно сталь';
            else if($material === 'p' && ($c === 'c1' || $c === 'c0')) return 'Сталь';
            
            else if($material === 'm' && $c === 'c2') return 'Предпочтительно нержавеющая сталь';
            else if($material === 'm' && ($c === 'c1' || $c === 'c0')) return 'Нержавеющая сталь';
            
            else if($material === 'k' && $c === 'c2') return 'Предпочтительно чугун';
            else if($material === 'k' && ($c === 'c1' || $c === 'c0')) return 'Чугун';
            
            else if($material === 'n' && $c === 'c2') return 'Предпочтительно цветные металлы и неметаллические материалы (пластик, графит, резина)';
            else if($material === 'n' && ($c === 'c1' || $c === 'c0')) return 'Цветные металлы и неметаллические материалы (пластик, графит, резина)';
            
            else if($material === 's' && $c === 'c2') return 'Предпочтительно жаропрочные и титановые сплавы';
            else if($material === 's' && ($c === 'c1' || $c === 'c0')) return 'Жаропрочные и титановые сплавы';
            
            else if($material === 'h' && $c === 'c2') return 'Предпочтительно материалы высокой твердости (закалённые)';
            else if($material === 'h' && ($c === 'c1' || $c === 'c0')) return 'Материалы высокой твердости (закалённые)';
        };
            
        //$Mask = '......';
        $P = $value[0];
        $M = $value[1];
        $K = $value[2];
        $N = $value[3];
        $S = $value[4];
        $H = $value[5];
        //dump($P);
        //dump($M);
        
        if($P==='P')      $P = '<div class="tilda-tool-material" color="c2" material="p" title="' . $_title('p','c2') . '"><span>P</span></div>';
        else if($P==='p') $P = '<div class="tilda-tool-material" color="c1" material="p" title="' . $_title('p','c1') . '"><span>P</span></div>';
        else              $P = '<div class="tilda-tool-material" color="c0" material="p" title="' . $_title('p','c0') . '">.</div>';
        
        if($M==='M')      $M = '<div class="tilda-tool-material" color="c2" material="m" title="' . $_title('m','c2') . '"><span>M</span></div>';
        else if($M==='m') $M = '<div class="tilda-tool-material" color="c1" material="m" title="' . $_title('m','c1') . '"><span>M</span></div>';
        else              $M = '<div class="tilda-tool-material" color="c0" material="m" title="' . $_title('m','c0') . '">.</div>';
        
        if($K==='K')      $K = '<div class="tilda-tool-material"color="c2" material="k" title="' . $_title('k','c2') . '"><span>K</span></div>';
        else if($K==='k') $K = '<div class="tilda-tool-material" color="c1" material="k" title="' . $_title('k','c1') . '"><span>K</span></div>';
        else              $K = '<div class="tilda-tool-material" color="c0" material="k" title="' . $_title('k','c0') . '">.</div>';
            
        if($N==='N')      $N = '<div class="tilda-tool-material" color="c2" material="n" title="' . $_title('n','c2') . '"><span>N</span></div>';
        else if($N==='n') $N = '<div class="tilda-tool-material" color="c1" material="n" title="' . $_title('n','c1') . '"><span>N</span></div>';
        else              $N = '<div class="tilda-tool-material" color="c0" material="n" title="' . $_title('n','c0') . '">.</div>';
            
        if($S==='S')      $S = '<div class="tilda-tool-material" color="c2" material="s" title="' . $_title('s','c2') . '"><span>S</span></div>';
        else if($S==='s') $S = '<div class="tilda-tool-material" color="c1" material="s" title="' . $_title('s','c1') . '"><span>S</span></div>';
        else              $S = '<div class="tilda-tool-material" color="c0" material="s" title="' . $_title('s','c0') . '">.</div>';
            
        if($H==='H')      $H = '<div class="tilda-tool-material" color="c2" material="h" title="' . $_title('h','c2') . '"><span>H</span></div>';
        else if($H==='h') $H = '<div class="tilda-tool-material" color="c1" material="h" title="' . $_title('h','c1') . '"><span>H</span></div>';
        else              $H = '<div class="tilda-tool-material" color="c0" material="h" title="' . $_title('h','c0') . '">.</div>';
            
        return '<span class="flex">' .$P.$M.$K.$N.$S.$H. '</span>';
    }


    /*

    // --- --- --- --- ---
    private function getMyTable(){
        $Table = web\Ide\Datamodel::instance('/Tilda/Tool/Tool')->Table;
        
        $Table = $this->parceProps($Table);
        $Table = $this->parceLines($Table);
        return $Table;
    }
    
    // --- --- --- --- ---
    private function parceProps($table){
        $Table = $table;
        
        $Props = $Table['props'];
        array_map(function($code,$prop) use(&$Props){
            if($code === 'systype') $prop['hidden'] = true;
            $Props[$code] = $prop;
        },array_keys($Props),array_values($Props));
        
        $Table['props'] = $Props;
        return $Table;
    }

    // --- --- --- --- ---
    private function parceLines($table){
        $Table = $table;
        //dump($Table['lines']);die();
        
        $Table['lines'] = array_map(function($line){
            $Line = $line;
            array_map(function($code,$value) use(&$Line){
                if($code === 'material') $value = $this->parceMaterial($value);
                $Line[$code] = $value;
            },array_keys($line),array_values($line));
            return $Line;
        },$Table['lines']);
        
        
        return $Table;
    }
    
    */
}
?>