<?php
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Db as db;

include '../../../../../../defs.php';
include '../../../../../../common.php';

$Connect2 = db\Connect::get('dbv2');
$Connect4 = db\Connect::get();

// --- --- --- --- ---
// --- --- --- --- ---
// --- --- --- --- ---
$Table2 = 'mz_view_tl_cataloguetree';
$TableType = 'mz_Type';
$Props2 = [ 'type.hid','type.name','type.info','substr(systype.tablename,4) AS code','parent.hid as parent_id' ];
 
$Query2 = [];
$Query2[] = 'SELECT ' . implode(',',$Props2);
$Query2[] = 'FROM ' . $Table2 . ' as type';
$Query2[] = 'LEFT JOIN ' . $Table2 . ' as parent ON parent.id=type.entity_parent_id';
$Query2[] = 'LEFT JOIN ' . $TableType . ' as systype ON systype.id=type.datatype_id';
$Query2[] = 'WHERE type.active is TRUE';
$Query2[] = 'ORDER BY type.ordd';
$Query2 = implode(' ',$Query2);

$Data2 = $Connect2->query($Query2);
$Data2 = array_combine(array_column($Data2,'hid'),$Data2);
//dump($Data2);die();

$Root = array_filter($Data2,function($value){ return !$value['parent_id']; });
$Root = array_shift($Root);
$Root = $Root['hid'];
//dump($Root);die();

$Data2 = array_filter($Data2,function($value){ return $value['parent_id']; });
//dump($Data2);die();

$Data2 = array_map(function($value) use($Root){
    if($value['parent_id'] === $Root) $value['parent_id'] = null;
    return $value;
},$Data2);
//dump($Data2);die();


// --- --- --- --- ---
$Props4 = [ 'hid','parent_id','code','name','info' ];
$Query4 = db\Cql::select('/Tilda/Tool/Type')->props($Props4)->limit(-1);
//dump($Query4->Query);die();

$Data4 = $Connect4->query($Query4);
$Data4 = array_combine(array_column($Data4,'hid'),$Data4);
//dump($Data4);die();

// --- --- --- --- ---
// --- --- --- --- ---
// --- --- --- --- ---
// --- NEW ---
$New = array_diff_key($Data2,$Data4);
//dump($New);die();

if(count($New)){
    $New = array_map(function($value){
        $value['parent_id'] = $value['parent_id'] ? db\Cql::select('/Tilda/Tool/Type')->prop('id')->rule('hid',$value['parent_id']) : null;
        return $value;
    },$New);
    //dump($New);die();
    
    $QueryNew = db\Cql::insert('/Tilda/Tool/Type')->valuesArr($New);
    //dump($QueryNew->Query);
    $Connect4->query($QueryNew);
}


// --- --- --- --- ---
// --- --- --- --- ---
// --- --- --- --- ---
// --- OLD ---
$Old = array_intersect_key($Data2,$Data4);
$Old = array_filter($Old,function($value) use($Data4){
    $Key = $value['hid'];
    return array_diff($value,$Data4[$Key]) || array_diff($Data4[$Key],$value);
});
//dump($Old);die();

if(count($Old)){
    $Old = array_map(function($value){
        $value['parent_id'] = $value['parent_id'] ? '('.db\Cql::select('/Tilda/Tool/Type')->prop('id')->rule('hid',$value['parent_id'])->Query.')' : null;
        return $value;
    },$Old);
    //dump($Old);die();
    
    $QueriesOld = array_map(function($value){
        return db\Cql::update('/Tilda/Tool/Type')->values($value)->rule('hid',$value['hid']);
        
    },$Old);
    $Connect4->exec($QueriesOld);
}



?>