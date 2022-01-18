<?php

\Cmatrix\Web\Router::add('/^admin$/',[
    'template' => '/Cmatrix/Web/admin.twig',
    'model' => '/Cmatrix/Web/Admin',
    'controller' => '/Cmatrix/Web/Twig'
]);

\Cmatrix\Web\Router::add('/^admin\/modules/',[
    'template' => '/Cmatrix/Web/adminModules.twig',
    'model' => '/Cmatrix/Web/AdminModules',
    'controller' => '/Cmatrix/Web/Twig'
]);

\Cmatrix\Web\Router::add('/^admin\/module/',[
    'template' => '/Cmatrix/Web/adminModule.twig',
    'model' => '/Cmatrix/Web/AdminModule',
    'controller' => '/Cmatrix/Web/Twig'
]);

\Cmatrix\Web\Router::add(['/','home'],[
    'template' => '/Tilda/Web/home.twig',
    'model' => '/Tilda/Web/Home',
    'controller' => '/Cmatrix/Web/Twig'
]);

\Cmatrix\Web\Router::add('session',[
    'template' => '/Cmatrix/Web/session.twig',
    'model' => '/Cmatrix/Web/Session',
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