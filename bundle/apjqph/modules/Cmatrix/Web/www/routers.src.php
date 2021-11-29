<?php

\Cmatrix\Web\Router::add(['/','home'],[
    'template' => '/Cmatrix/Web/home.twig',
    'model' => '/Cmatrix/Web/Home',
    'controller' => '/Cmatrix/Web/Twig'
]);

\Cmatrix\Web\Router::add('404',[
    'template' => '/Cmatrix/Web/404.twig',
    'model' => '/Cmatrix/Web/M404',
    'controller' => '/Cmatrix/Web/Twig'
]);

?>