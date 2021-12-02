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

\Cmatrix\Web\Router::add('/^tool\/catalogue/',[
    'template' => '/Tilda/Tool/catalogue.twig',
    'model' => '/Tilda/Tool/Catalogue',
    'controller' => '/Cmatrix/Web/Twig'
]);
?>