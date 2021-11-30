<?php
use \Cmatrix\Kernel as kernel;
use \Cmatrix\Db as db;

include '../../../../../../defs.php';
include '../../../../../../common.php';

$Connect2 = db\Connect::get('dbv2');
$Connect4 = db\Connect::get();

$Arr2 = [
    // Фреза концевая
    'FrMonKonc' => [
        'tables' => [
            'mz_tl_FrMonKonc AS tool' => [ 'mz_tl_Kind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'CAST(NULL AS REAL) AS d',
            'tool.d1',
            'tool.d2',
            'tool.d3',
            'tool.r',
            'tool.cf',
            'tool.l1',
            'tool.l2',
            'CAST(NULL AS REAL) AS l3',
            'CAST(NULL AS REAL) AS l4',
            'tool.ap',
            'CAST(NULL AS REAL) AS ar',
            'tool.z',
            'tool.purpose',
            'kind.label AS kind',
            'CAST(NULL AS REAL) AS angle',
            'NULL AS thread',
            'CAST(NULL AS REAL) AS pitch',
            'CAST(NULL AS REAL) AS pmin',
            'CAST(NULL AS REAL) AS pmax',
            'NULL AS adin',
            'CAST(NULL AS REAL) AS adimin',
            'CAST(NULL AS REAL) AS adimax',
            'NULL AS adout',
            'CAST(NULL AS VARCHAR) AS tpl',
            'CAST(NULL AS VARCHAR) AS spl',
            'CAST(NULL AS VARCHAR) AS fpl',
            'CAST(NULL AS BOOL) AS coolin',
            'CAST(NULL AS VARCHAR) AS t',
            'CAST(NULL AS REAL) AS kr',
            'CAST(NULL AS REAL) AS f1',
            'CAST(NULL AS REAL) AS dmin',
            'CAST(NULL AS BOOL) AS purpout',
            'CAST(NULL AS BOOL) AS purpin',
            'CAST(NULL AS VARCHAR) AS purptok',
            'CAST(NULL AS TEXT) AS inserts',
            'CAST(NULL AS INTEGER) AS icount',
            'CAST(NULL AS REAL) AS regmin',
            'CAST(NULL AS REAL) AS regmax',
            'CAST(NULL AS VARCHAR) AS tooltype',
            'CAST(NULL AS VARCHAR) AS cooltype',
            'CAST(NULL AS VARCHAR) AS m',
            'CAST(NULL AS VARCHAR) AS orient',
        ],
    ],
    
    // Фреза сферическая
    'FrMonSfer' => [
        'tables' => [
            'mz_tl_FrMonSfer AS tool' => [ 'mz_tl_Kind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'tool.d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'tool.l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'tool.z',
            'tool.purpose',
            'kind.label AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Фреза грибковая монолитная
    'FrMonGrib' => [
        'tables' => [
            'mz_tl_FrMonGrib AS tool' => [ 'mz_tl_Kind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'tool.l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'tool.z',
            'purpose',
            'kind.label AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Резьбофреза монолитная
    'FrMonRez' => [
        'tables' => [
            'mz_tl_FrMonRez AS tool' => [ 'mz_tl_Kind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'tool.z',
            'purpose',
            'kind.label AS kind',
            'NULL AS angle',
            'tool.thread',
            'tool.pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Фреза дисковая монолитная
    'FrMonDisk' => [
        'tables' => [
            'mz_tl_FrMonDisk AS tool' => [ 'mz_tl_Kind AS kind ON kind.id=tool.kind', 'mz_tl_MillDiskPurpose AS purpose ON purpose.id=tool.purpose'],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'NULL AS d3',
            'tool.r',
            'tool.cf',
            'NULL AS l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'tool.ar',
            'tool.z',
            'lower(purpose.name)',
            'kind.label AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Фасочник монолитный
    'FrMonFas' => [
        'tables' => [
            'mz_tl_FrMonFas AS tool' => [ 'mz_tl_Kind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'tool.d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'tool.l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'tool.z',
            'tool.purpose',
            'kind.label AS kind',
            'tool.ang AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Головка фрезерная с пластинами
    'FrGolPl' => [
        'tables' => [
            'mz_tl_FrGolPl AS tool' => [ 'mz_tl_Kind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'tool.z',
            'NULL AS purpose',
            'kind.label AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'tool.adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'tool.adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Головка фрезерная твёрдосплавная
    'FrGolTs' => [
        'tables' => [
            'mz_tl_FrGolTs AS tool' => [ 'mz_tl_Kind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'NULL AS d3',
            'tool.r',
            'tool.cf',
            'tool.l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'tool.z',
            'tool.purpose',
            'kind.label AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'tool.adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Оправка под головку
    'OprGol' => [
        'tables' => [
            'mz_tl_OprGol AS tool' => null,
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'NULL AS d1',
            'tool.d2',
            'tool.d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'tool.l2',
            'NULL AS l3',
            'NULL AS l4',
            'NULL AS ap',
            'NULL AS ar',
            'NULL AS z',
            'NULL AS purpose',
            'NULL AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'tool.adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'tool.adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Фреза корпусная
    'FrKorp' => [
        'tables' => [
            'mz_tl_FrKorp AS tool' => [ 'mz_tl_Kind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'tool.z',
            'NULL AS purpose',
            'kind.label AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'tool.adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'tool.adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Фреза грибковая сборная
    'FrSborGrib' => [
        'tables' => [
            'mz_tl_FrSborGrib AS tool' => [ 'mz_tl_Kind AS kind ON kind.id=tool.kind', 'mz_tl_MillFungoidPurpose AS purpose ON purpose.id=tool.purpose' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'tool.d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'tool.l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'CAST(tool.ar AS REAL) AS ar',
            'tool.z',
            'lower(purpose.name) AS purpose',
            'kind.label AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'tool.adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'tool.adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Пластина фрезерная
    'FrPl' => [
        'tables' => [
            'mz_tl_FrPl AS tool' => null,
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'NULL AS d1',
            'NULL AS d2',
            'NULL AS d3',
            'tool.r',
            'NULL AS cf',
            'NULL AS l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'NULL AS ap',
            'NULL AS ar',
            'NULL AS z',
            'tool.purpose',
            'NULL AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'tool.tpl',
            'tool.spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Фреза дисковая сборная
    'FrSborDisk' => [
        'tables' => [
            'mz_tl_FrSborDisk AS tool' => [ 'mz_tl_Kind AS kind ON kind.id=tool.kind', 'mz_tl_MillDiskPurpose AS purpose ON purpose.id=tool.purpose' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'NULL AS l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'tool.ar',
            'tool.z',
            'lower(purpose.name) AS purpose',
            'kind.label AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'tool.adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'tool.adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Фасочник сборный
    'FrSborFas' => [
        'tables' => [
            'mz_tl_FrSborFas AS tool' => [ 'mz_tl_Kind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'tool.d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'tool.l2',
            'tool.l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'tool.z',
            'tool.purpose',
            'kind.label AS kind',
            'tool.ang AS angel',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'tool.adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'tool.adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Корпус фрезы канавочной
    'FrSborKanKorp' => [
        'tables' => [
            'mz_tl_FrSborKanKorp AS tool' => null,
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'NULL AS d1',
            'tool.d2',
            'tool.d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'tool.l2',
            'NULL AS l3',
            'NULL AS l4',
            'NULL AS ap',
            'NULL AS ar',
            'NULL AS z',
            'NULL AS purpose',
            'NULL AS kind',
            'NULL AS angel',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'tool.adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'tool.adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Пластина канавочная
    'FrSborKanPl' => [
        'tables' => [
            'mz_tl_FrSborKanPl AS tool' => [ 'mz_tl_TcutterInsertPurpose AS purpose ON purpose.id=tool.purpose' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'NULL AS d2',
            'NULL AS d3',
            'tool.r',
            'NULL AS cf',
            'NULL AS l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'tool.ar',
            'tool.z',
            'lower(purpose.name) AS purpose',
            'NULL AS kind',
            'NULL AS angle',
            'tool.thread',
            'NULL AS pitch',
            'tool.pmin',
            'tool.pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'tool.tpl',
            'tool.spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Специнструмент фрезерный // !!! нет параметров
    //'FrSpec' => [
    //],
    
    // Переточенный
    'FrPeret' => [
        'tables' => [
            'mz_tl_FrPeret AS tool' => null,
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'tool.d3',
            'tool.r',
            'tool.cf',
            'tool.l1',
            'tool.l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'tool.z',
            'NULL AS purpose',
            'NULL AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Сверло
    'OsevSverMon' => [
        'tables' => [
            'mz_tl_OsevSverMon AS tool' => null,
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'NULL AS l2',
            'tool.l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'NULL AS z',
            'tool.purpose',
            'NULL AS kind',
            'NULL AS angel',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'tool.coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Развёртка
    'OsevRazv' => [
        'tables' => [
            'mz_tl_OsevRazv AS tool' => null,
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'NULL AS l2',
            'tool.l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'NULL AS z',
            'tool.purpose',
            'NULL AS kind',
            'NULL AS angel',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'tool.t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Сверло сборное
    'OsevSverSbor' => [
        'tables' => [
            'mz_tl_OsevSverSbor AS tool' => null,
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'NULL AS l2',
            'tool.l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'NULL AS z',
            'tool.purpose',
            'NULL AS kind',
            'NULL AS angel',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'tool.tpl',
            'tool.spl',
            'NULL AS fpl',
            'tool.coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    'OsevMet' => [
        'tables' => [
            'mz_tl_OsevMet AS tool' => [ 'mz_tl_Kind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'tool.d1',
            'tool.d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'tool.l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'NULL AS z',
            'NULL AS purpose',
            'kind.label AS kind',
            'NULL AS angel',
            'tool.thread',
            'tool.pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient'
        ]
    ],
    'OsevPl' => [
        'tables' => [
            'mz_tl_OsevPl AS tool' => null,
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'NULL AS d1',
            'NULL AS d2',
            'NULL AS d3',
            'tool.r',
            'NULL AS cf',
            'NULL AS l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'NULL AS ap',
            'NULL AS ar',
            'NULL AS z',
            'tool.purpose',
            'NULL AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'tool.tpl',
            'tool.spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Система расточная // !!! нет параметров
    //'RastSyst' => [
    //],
    // Оснастка расточная  // !!! нет параметров
    //'RastOsn' => [
    //],

    // Метчик
    
    // Пластина осевая
    'RastPl' => [
        'tables' => [
            'mz_tl_RastPl AS tool' => [ 'mz_tl_TurnToolKind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'NULL AS d1',
            'NULL AS d2',
            'NULL AS d3',
            'tool.r',
            'NULL AS cf',
            'NULL AS l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'NULL AS ap',
            'NULL AS ar',
            'NULL AS z',
            'NULL AS purpose',
            'kind.label AS kind',
            'tool.ang AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'tool.tpl',
            'tool.spl',
            'tool.fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Специнструмент осевой // !!! нет параметров
    //'OsevSpec' => [
    //],
    
    // Державка токарная
    'TokDer' => [
        'tables' => [
            'mz_tl_TokDer AS tool' => [ 'mz_tl_TurnToolKind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'NULL AS d1',
            'NULL AS d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'NULL AS l2',
            'NULL AS l3',
            'tool.l4',
            'NULL AS ap',
            'tool.ar',
            'NULL AS z',
            'NULL AS purpose',
            'kind.label AS kind',
            'tool.ang AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'tool.adout',
            'NULL AS tpl',
            'NULL AS spl',
            'tool.fpl',
            'NULL AS coolin',
            'NULL AS t',
            'tool.kr',
            'tool.f1',
            'tool.dmin',
            'tool.purpose1 AS purpout',
            'tool.purpose2 AS purpin',
            "CONCAT(CASE WHEN tool.type1 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type2 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type3 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type4 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type5 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type6 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type7 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type8 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type9 IS NOT NULL THEN '1' ELSE '.' END) as purptok",
            'tool.adin AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Резец монолитный
    'TokRezMon' => [
        'tables' => [
            'mz_tl_TokRezMon AS tool' => [ 'mz_tl_TurnToolKind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'NULL AS d1',
            'NULL AS d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'NULL AS l2',
            'NULL AS l3',
            'tool.l4',
            'tool.ap',
            'tool.ar',
            'NULL AS z',
            'NULL AS purpose',
            'kind.label AS kind',
            'NULL AS angle',
            'tool.thread',
            'NULL AS pitch',
            'tool.pmin',
            'tool.pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'tool.adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'tool.kr',
            'tool.f1',
            'tool.dmin',
            'tool.purpose1 AS purpout',
            'tool.purpose2 AS purpin',
            "CONCAT(CASE WHEN tool.type1 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type2 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type3 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type4 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type5 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type6 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type7 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type8 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type9 IS NOT NULL THEN '1' ELSE '.' END) as purptok",
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Пластина токарная
    'TokPl' => [
        'tables' => [
            'mz_tl_TokPl AS tool' => [ 'mz_tl_TurnToolKind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'NULL AS d1',
            'NULL AS d2',
            'NULL AS d3',
            'tool.r',
            'NULL AS cf',
            'NULL AS l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'tool.ap',
            'NULL AS ar',
            'NULL AS z',
            'tool.purpose',
            'kind.label AS kind',
            'tool.ang AS angle',
            'tool.thread',
            'NULL AS pitch',
            'tool.pmin',
            'tool.pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'tool.tpl',
            'tool.spl',
            'tool.fpl',
            'NULL AS coolin',
            'NULL AS t',
            'tool.kr',
            'tool.f1',
            'tool.dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            "CONCAT(CASE WHEN tool.type1 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type2 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type3 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type4 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type5 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type6 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type7 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type8 IS NOT NULL THEN '1' ELSE '.' END,CASE WHEN tool.type9 IS NOT NULL THEN '1' ELSE '.' END) as purptok",
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Специнструмент токарный // !!! нет параметров
    //'TokSpec' => [
    //],

    // Многоцелевой токарный
    'TokMnogo' => [
        'tables' => [
            'mz_tl_TokMnogo AS tool' => [ 'mz_tl_TurnToolKind AS kind ON kind.id=tool.kind' ],
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'NULL AS d1',
            'tool.d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'NULL AS ap',
            'NULL AS ar',
            'NULL AS z',
            'NULL AS purpose',
            'kind.label AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'tool.adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'tool.adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'tool.kr',
            'tool.f1',
            'tool.dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Державка накатки
    'NakDer' => [
        'tables' => [
            'mz_tl_NakDer AS tool' => null,
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'NULL AS d1',
            'NULL AS d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1 AS l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'NULL AS ap',
            'NULL AS ar',
            'NULL AS z',
            'NULL AS purpose',
            'NULL AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'tool.adout AS adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'CAST(tool.roll AS TEXT) AS inserts',
            'CAST(tool.roll_count AS INTEGER) AS icount',
            'CAST(tool.regmin AS REAL) AS regmin',
            'CAST(tool.regmax AS REAL) AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    // Ролик накатки
    'NakRoll' => [
        'tables' => [
            'mz_tl_NakRoll AS tool' => null,
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'tool.d AS d',
            'NULL AS d1',
            'NULL AS d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'NULL AS l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'NULL AS ap',
            'NULL AS ar',
            'NULL AS z',
            'NULL AS purpose',
            'NULL AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'tool.pitch AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'NULL AS adout',
            'NULL AS tpl',
            'tool.roll AS spl',
            'tool.type AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],

    // Цанга
    'OsnFrTsan' => [
        'tables' => [
            'mz_tl_OsnFrTsan AS tool' => null,
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'NULL AS d1',
            'tool.d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'NULL AS ap',
            'NULL AS ar',
            'NULL AS z',
            'NULL AS purpose',
            'NULL AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'NULL AS adin',
            'tool.adinmin AS adimin',
            'tool.adinmax AS adimax',
            'tool.adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'tool.coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],
    
    'OsnFrUdl' => [
        'tables' => [
            'mz_tl_OsnFrUdl AS tool' => null,
            'mz_entity AS e' => null
        ],
        'rules'  => [ 'e.id=tool.id', 'e.active IS TRUE' ],
        'props'  => [
            'tool.id',
            'NULL AS d',
            'NULL AS d1',
            'tool.d2',
            'NULL AS d3',
            'NULL AS r',
            'NULL AS cf',
            'tool.l1',
            'NULL AS l2',
            'NULL AS l3',
            'NULL AS l4',
            'NULL AS ap',
            'NULL AS ar',
            'NULL AS z',
            'NULL AS purpose',
            'NULL AS kind',
            'NULL AS angle',
            'NULL AS thread',
            'NULL AS pitch',
            'NULL AS pmin',
            'NULL AS pmax',
            'tool.adin',
            'NULL AS adimin',
            'NULL AS adimax',
            'tool.adout',
            'NULL AS tpl',
            'NULL AS spl',
            'NULL AS fpl',
            'NULL AS coolin',
            'NULL AS t',
            'NULL AS kr',
            'NULL AS f1',
            'NULL AS dmin',
            'NULL AS purpout',
            'NULL AS purpin',
            'NULL AS purptok',
            'NULL AS inserts',
            'NULL AS icount',
            'NULL AS regmin',
            'NULL AS regmax',
            'NULL AS tooltype',
            'NULL AS cooltype',
            'NULL AS m',
            'NULL AS orient',
        ]
    ],



];

$Query2 = array_map(function($value){
    $Query = [];
    $Query[] = 'SELECT '. implode(',',$value['props']);
    $Query[] = 'FROM ' . implode(',',array_map(function($table,$joins){
        if($joins) $Joins =  implode(' ',array_map(function($join){
            return 'LEFT JOIN '. $join;
        },$joins));
        else $Joins = null;
        
        return $table .' '. $Joins;
    },array_keys($value['tables']),array_values($value['tables'])));
    $Query[] = 'WHERE ' . implode(' AND ',$value['rules']);
    return implode(' ',$Query);
},$Arr2);

$Query2 = implode(' UNION ALL ',$Query2);
dump($Query2);die();
/*
$Query2[] = 'SELECT ' . implode(',',$Props2);
$Query2[] = 'FROM ' . $Table2 . ' as type';
$Query2[] = 'LEFT JOIN ' . $Table2 . ' as parent ON parent.id=type.entity_parent_id';
$Query2[] = 'LEFT JOIN ' . $TableType . ' as systype ON systype.id=type.datatype_id';
$Query2[] = 'WHERE type.active is TRUE';
$Query2[] = 'ORDER BY type.ordd';
$Query2 = implode(' ',$Query2);
*/






        $_funs = [
            // Удлинитель
            // Патрон
            'OsnFrPatr' => function(){
                return (qu\Query::sql()->from('mz_tl_OsnFrPatr','tool')
                    ->select('tool.id')
                    ->select('CAST(NULL AS REAL)','d')
                    ->select('NULL','d1')
                    ->select('tool.d2')
                    ->select('tool.d3')
                    ->select('NULL','r')
                    ->select('NULL','cf')
                    ->select('tool.l1')
                    ->select('tool.l2')
                    ->select('NULL','l3')
                    ->select('NULL','l4')
                    ->select('NULL','ap')
                    ->select('NULL','ar')
                    ->select('NULL','z')
                    ->select('NULL','purpose')
                    ->select('NULL','kind')
                    ->select('NULL','angle')
                    ->select('NULL','thread')
                    ->select('NULL','pitch')
                    ->select('NULL','pmin')
                    ->select('NULL','pmax')
                    ->select('tool.adin')
                    ->select('NULL','adimin')
                    ->select('NULL','adimax')
                    ->select('tool.adout')
                    ->select('NULL','tpl')
                    ->select('NULL','spl')
                    ->select('NULL','fpl')
                    ->select('NULL','coolin')
                    ->select('NULL','t')
                    ->select('NULL','kr')
                    ->select('NULL','f1')
                    ->select('NULL','dmin')
                    ->select('NULL','purpout')
                    ->select('NULL','purpin')
                    ->select('NULL','purptok')
                    ->select('NULL','inserts')
                    ->select('NULL','icount')
                    ->select('NULL','regmin')
                    ->select('NULL','regmax')
                    ->select('NULL','tooltype')
                    ->select('NULL','cooltype')
                    ->select('NULL','m')
                    ->select('NULL','orient')
                );
            },
            // Патрон с регулировкой радиального биения
            'OsnFrPatrReg' => function(){
                return (qu\Query::sql()->from('mz_tl_OsnFrPatrReg','tool')
                    ->select('tool.id')
                    ->select('CAST(NULL AS REAL)','d')
                    ->select('NULL','d1')
                    ->select('tool.d2')
                    ->select('tool.d3')
                    ->select('NULL','r')
                    ->select('NULL','cf')
                    ->select('tool.l1')
                    ->select('tool.l2')
                    ->select('NULL','l3')
                    ->select('NULL','l4')
                    ->select('NULL','ap')
                    ->select('NULL','ar')
                    ->select('NULL','z')
                    ->select('NULL','purpose')
                    ->select('NULL','kind')
                    ->select('NULL','angle')
                    ->select('NULL','thread')
                    ->select('NULL','pitch')
                    ->select('NULL','pmin')
                    ->select('NULL','pmax')
                    ->select('tool.adin')
                    ->select('NULL','adimin')
                    ->select('NULL','adimax')
                    ->select('tool.adout')
                    ->select('NULL','tpl')
                    ->select('NULL','spl')
                    ->select('NULL','fpl')
                    ->select('NULL','coolin')
                    ->select('NULL','t')
                    ->select('NULL','kr')
                    ->select('NULL','f1')
                    ->select('NULL','dmin')
                    ->select('NULL','purpout')
                    ->select('NULL','purpin')
                    ->select('NULL','purptok')
                    ->select('NULL','inserts')
                    ->select('NULL','icount')
                    ->select('NULL','regmin')
                    ->select('NULL','regmax')
                    ->select('NULL','tooltype')
                    ->select('NULL','cooltype')
                    ->select('NULL','m')
                    ->select('NULL','orient')
                );
            },
            // Базовый держатель
            'OsnFrBazDer' => function(){
                return (qu\Query::sql()->from('mz_tl_OsnFrBazDer','tool')
                    ->select('tool.id')
                    ->select('CAST(NULL AS REAL)','d')
                    ->select('NULL','d1')
                    ->select('tool.d2')
                    ->select('tool.d3')
                    ->select('NULL','r')
                    ->select('NULL','cf')
                    ->select('tool.l1')
                    ->select('tool.l2')
                    ->select('NULL','l3')
                    ->select('NULL','l4')
                    ->select('NULL','ap')
                    ->select('NULL','ar')
                    ->select('NULL','z')
                    ->select('NULL','purpose')
                    ->select('NULL','kind')
                    ->select('NULL','angle')
                    ->select('NULL','thread')
                    ->select('NULL','pitch')
                    ->select('NULL','pmin')
                    ->select('NULL','pmax')
                    ->select('tool.adin')
                    ->select('NULL','adimin')
                    ->select('NULL','adimax')
                    ->select('tool.adout')
                    ->select('NULL','tpl')
                    ->select('NULL','spl')
                    ->select('NULL','fpl')
                    ->select('NULL','coolin')
                    ->select('NULL','t')
                    ->select('NULL','kr')
                    ->select('NULL','f1')
                    ->select('NULL','dmin')
                    ->select('NULL','purpout')
                    ->select('NULL','purpin')
                    ->select('NULL','purptok')
                    ->select('NULL','inserts')
                    ->select('NULL','icount')
                    ->select('NULL','regmin')
                    ->select('NULL','regmax')
                    ->select('NULL','tooltype')
                    ->select('NULL','cooltype')
                    ->select('NULL','m')
                    ->select('NULL','orient')
                );
            },
            // Переходник
            'OsnFrPer' => function(){
                return (qu\Query::sql()->from('mz_tl_OsnFrPer','tool')
                    ->select('tool.id')
                    ->select('CAST(NULL AS REAL)','d')
                    ->select('NULL','d1')
                    ->select('tool.d2')
                    ->select('tool.d3')
                    ->select('NULL','r')
                    ->select('NULL','cf')
                    ->select('tool.l1')
                    ->select('tool.l2')
                    ->select('NULL','l3')
                    ->select('NULL','l4')
                    ->select('NULL','ap')
                    ->select('NULL','ar')
                    ->select('NULL','z')
                    ->select('NULL','purpose')
                    ->select('NULL','kind')
                    ->select('NULL','angle')
                    ->select('NULL','thread')
                    ->select('NULL','pitch')
                    ->select('NULL','pmin')
                    ->select('NULL','pmax')
                    ->select('tool.adin')
                    ->select('NULL','adimin')
                    ->select('NULL','adimax')
                    ->select('tool.adout')
                    ->select('NULL','tpl')
                    ->select('NULL','spl')
                    ->select('NULL','fpl')
                    ->select('NULL','coolin')
                    ->select('NULL','t')
                    ->select('NULL','kr')
                    ->select('NULL','f1')
                    ->select('NULL','dmin')
                    ->select('NULL','purpout')
                    ->select('NULL','purpin')
                    ->select('NULL','purptok')
                    ->select('NULL','inserts')
                    ->select('NULL','icount')
                    ->select('NULL','regmin')
                    ->select('NULL','regmax')
                    ->select('NULL','tooltype')
                    ->select('NULL','cooltype')
                    ->select('NULL','m')
                    ->select('NULL','orient')
                );
            },
            // Оправка
            'OsnFrOpr' => function(){
                return (qu\Query::sql()->from('mz_tl_OsnFrOpr','tool')
                    ->select('tool.id')
                    ->select('CAST(NULL AS REAL)','d')
                    ->select('NULL','d1')
                    ->select('tool.d2')
                    ->select('tool.d3')
                    ->select('NULL','r')
                    ->select('NULL','cf')
                    ->select('tool.l1')
                    ->select('tool.l2')
                    ->select('NULL','l3')
                    ->select('NULL','l4')
                    ->select('NULL','ap')
                    ->select('NULL','ar')
                    ->select('NULL','z')
                    ->select('NULL','purpose')
                    ->select('NULL','kind')
                    ->select('NULL','angle')
                    ->select('NULL','thread')
                    ->select('NULL','pitch')
                    ->select('NULL','pmin')
                    ->select('NULL','pmax')
                    ->select('tool.adin')
                    ->select('NULL','adimin')
                    ->select('NULL','adimax')
                    ->select('tool.adout')
                    ->select('NULL','tpl')
                    ->select('NULL','spl')
                    ->select('NULL','fpl')
                    ->select('NULL','coolin')
                    ->select('NULL','t')
                    ->select('NULL','kr')
                    ->select('NULL','f1')
                    ->select('NULL','dmin')
                    ->select('NULL','purpout')
                    ->select('NULL','purpin')
                    ->select('NULL','purptok')
                    ->select('NULL','inserts')
                    ->select('NULL','icount')
                    ->select('NULL','regmin')
                    ->select('NULL','regmax')
                    ->select('NULL','tooltype')
                    ->select('NULL','cooltype')
                    ->select('NULL','m')
                    ->select('NULL','orient')
                );
            },
            // Адаптеры
            'OsnTokAdap' => function(){
                return (qu\Query::sql()->from('mz_tl_OsnTokAdap','tool')
                    ->select('tool.id')
                    ->select('NULL','d')
                    ->select('NULL','d1')
                    ->select('tool.d2')
                    ->select('NULL','d3')
                    ->select('NULL','r')
                    ->select('NULL','cf')
                    ->select('tool.l1')
                    ->select('NULL','l2')
                    ->select('NULL','l3')
                    ->select('NULL','l4')
                    ->select('NULL','ap')
                    ->select('NULL','ar')
                    ->select('NULL','z')
                    ->select('NULL','purpose')
                    ->select('kind.label','kind')
                    ->select('tool.ang','angle')
                    ->select('NULL','thread')
                    ->select('NULL','pitch')
                    ->select('NULL','pmin')
                    ->select('NULL','pmax')
                    ->select('tool.adin')
                    ->select('NULL','adimin')
                    ->select('NULL','adimax')
                    ->select('tool.adout')
                    ->select('NULL','tpl')
                    ->select('NULL','spl')
                    ->select('NULL','fpl')
                    ->select('NULL','coolin')
                    ->select('NULL','t')
                    ->select('NULL','kr')
                    ->select('NULL','f1')
                    ->select('NULL','dmin')
                    ->select('NULL','purpout')
                    ->select('NULL','purpin')
                    ->select('NULL','purptok')
                    ->select('NULL','inserts')
                    ->select('NULL','icount')
                    ->select('NULL','regmin')
                    ->select('NULL','regmax')
                    ->select('NULL','tooltype')
                    ->select('NULL','cooltype')
                    ->select('NULL','m')
                    ->select('NULL','orient')
                    
                    ->leftJoin('mz_tl_TurnToolKind','kind')->on('kind.id=tool.kind')
                );
            },
            // Блок QTN
            'OsnTokQTN' => function(){
                return (qu\Query::sql()->from('mz_tl_OsnTokQTN','tool')
                    ->select('tool.id')
                    ->select('NULL','d')
                    ->select('NULL','d1')
                    ->select('NULL','d2')
                    ->select('NULL','d3')
                    ->select('NULL','r')
                    ->select('NULL','cf')
                    ->select('NULL','l1')
                    ->select('NULL','l2')
                    ->select('NULL','l3')
                    ->select('NULL','l4')
                    ->select('NULL','ap')
                    ->select('NULL','ar')
                    ->select('NULL','z')
                    ->select('NULL','purpose')
                    ->select('kind.name','kind')
                    ->select('NULL','angle')
                    ->select('NULL','thread')
                    ->select('NULL','pitch')
                    ->select('NULL','pmin')
                    ->select('NULL','pmax')
                    ->select('tool.adin')
                    ->select('NULL','adimin')
                    ->select('NULL','adimax')
                    ->select('tool.adout')
                    ->select('NULL','tpl')
                    ->select('NULL','spl')
                    ->select('NULL','fpl')
                    ->select('NULL','coolin')
                    ->select('NULL','t')
                    ->select('NULL','kr')
                    ->select('NULL','f1')
                    ->select('NULL','dmin')
                    ->select('NULL','purpout')
                    ->select('NULL','purpin')
                    ->select('NULL','purptok')
                    ->select('NULL','inserts')
                    ->select('NULL','icount')
                    ->select('NULL','regmin')
                    ->select('NULL','regmax')
                    ->select('type.name','tooltype')
                    ->select('cool.name','cooltype')
                    ->select('tool.m','m')
                    ->select('orient.name','orient')
                    
                    ->leftJoin('mz_tl_TurnUnitKind','kind')->on('kind.id=tool.kind')
                    ->leftJoin('mz_tl_CoolantType','cool')->on('cool.id=tool.cool')
                    
                    ->leftJoin('mz_tl_TurnUnitType','type')->on('type.id=tool.type')
                    ->leftJoin('mz_tl_TurnUnitOrient','orient')->on('orient.id=tool.orient')
                );
            },
            // Блок Integrex i-150 // !!! нет параметров
            'OsnTok150' => function(){
            }, 
            // Блок Integrex 300 // !!! нет параметров
            'OsnTok300' => function(){
            },
            // Оснастка станочная // !!! нет параметров
            'OsnStan' => function(){
            },
            // Запчасти // !!! нет параметров
            'Zap' => function(){
            },
            //  Борфреза
            'SlesBor' => function(){
                return (qu\Query::sql()->from('mz_tl_SlesBor','tool')
                    ->select('tool.id')
                    ->select('NULL','d')
                    ->select('tool.d1','d1')
                    ->select('NULL','d2')
                    ->select('NULL','d3')
                    ->select('NULL','r')
                    ->select('NULL','cf')
                    ->select('NULL','l1')
                    ->select('NULL','l2')
                    ->select('NULL','l3')
                    ->select('NULL','l4')
                    ->select('NULL','ap')
                    ->select('NULL','ar')
                    ->select('NULL','z')
                    ->select('NULL','purpose')
                    ->select('NULL','kind')
                    ->select('NULL','angle')
                    ->select('NULL','thread')
                    ->select('NULL','pitch')
                    ->select('NULL','pmin')
                    ->select('NULL','pmax')
                    ->select('NULL','adin')
                    ->select('NULL','adimin')
                    ->select('NULL','adimax')
                    ->select('NULL','adout')
                    ->select('NULL','tpl')
                    ->select('NULL','spl')
                    ->select("form.label || ' • ' || form.name",'fpl')
                    ->select('NULL','coolin')
                    ->select('NULL','t')
                    ->select('NULL','kr')
                    ->select('NULL','f1')
                    ->select('NULL','dmin')
                    ->select('NULL','purpout')
                    ->select('NULL','purpin')
                    ->select('NULL','purptok')
                    ->select('NULL','inserts')
                    ->select('NULL','icount')
                    ->select('NULL','regmin')
                    ->select('NULL','regmax')
                    ->select('NULL','tooltype')
                    ->select('NULL','cooltype')
                    ->select('NULL','m')
                    ->select('NULL','orient')
                    
                    ->leftJoin('mz_tl_MillBorForm','form')->on('form.id=tool.form')
                );
            },

        ];

?>