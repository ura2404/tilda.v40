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
$Table2 = 'mz_view_tl_vendor';
//id	hid	active	deleted	create_ts	upd_ts	entity_parent_id	type_id	session_id	session_upd_id	sysgroup_id	sysuser_id	info	tag	status_id	ordd	name
$Props2 = [ 'hid','name','name as fullname','info' ];
 
$Query2 = [];
$Query2[] = 'SELECT ' . implode(',',$Props2);
$Query2[] = 'FROM ' . $Table2;
$Query2[] = 'WHERE active is TRUE';
$Query2[] = 'ORDER BY ordd';
$Query2 = implode(' ',$Query2);

$Data2 = $Connect2->query($Query2);
$Data2 = array_combine(array_column($Data2,'hid'),$Data2);
//dump($Data2);die();

// --- --- --- --- ---
$Props4 = [ 'hid','name','fullname','info' ];
$Query4 = db\Cql::select('/Tilda/Tool/Vendor')->props($Props4)->limit(10000);

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
    $QueryNew = db\Cql::insert('/Tilda/Tool/Vendor')->valuesArr($New);
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
//dump($Old);

if(count($Old)){
    $QueriesOld = array_map(function($value){
        return db\Cql::update('/Tilda/Tool/Vendor')->values($value)->rule('hid',$value['hid']);
        
    },$Old);
    $Connect4->exec($QueriesOld);
}
?>