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
$Table2 = 'mz_view_sysuser';
$Props2 = [ 'hid','login as code','name','password AS pass','info','lk' ];
 
$Query2 = [];
$Query2[] = 'SELECT ' . implode(',',$Props2);
$Query2[] = 'FROM ' . $Table2;
$Query2[] = 'WHERE active is TRUE';
$Query2[] = "AND login !='init'";
$Query2[] = "AND login !='guest'";
$Query2[] = "AND login !='admin'";
$Query2[] = "AND login !='worker'";
$Query2[] = "AND login !='user'";

$Query2[] = 'ORDER BY id';
$Query2 = implode(' ',$Query2);

$Data2 = $Connect2->query($Query2);
$Data2 = array_combine(array_column($Data2,'hid'),$Data2);
//dump($Data2);die();

// --- --- --- --- ---
$Props4 = [ 'hid','code','name','pass','info','lk' ];
$Query4 = db\Cql::select('/Cmatrix/Core/Sysuser')->props($Props4)->limit(-1)->order('id')
    ->rules([
        ['code','init','!='],
        ['code','guest','!='],
        ['code','admin','!='],
        ['code','worker','!='],
        ['code','user','!='],
    ]);

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
    $QueryNew = db\Cql::insert('/Cmatrix/Core/Sysuser')->valuesArr($New);
    //dump($QueryNew->Query);die();
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