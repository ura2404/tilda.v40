<?php

\Cmatrix\Web\Router::add(['/','home'],[
    'template' => '/Tilda/Web/home.twig',
    'model' => '/Tilda/Web/Home',
    'controller' => '/Cmatrix/Web/Twig'
]);
/*
\Cmatrix\Web\Router::add('404',[
    'template' => '/Cmatrix/Web/404.twig',
    'model' => '/Cmatrix/Web/M404',
    'controller' => '/Cmatrix/Web/Twig'
]);
*/

\Cmatrix\Web\Router::add('/^tool/',[
    'template' => '/Tilda/Web/toolsTool.twig',
    'model' => '/Tilda/Web/ToolsTool',
    'controller' => '/Cmatrix/Web/Twig'
]);
?>