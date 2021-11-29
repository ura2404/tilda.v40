<?php
namespace Cmatrix\Web\Mvc;
use \Cmatrix\Web as web;

/**
 * Interface \Cmatrix\Web\Mvc\iController
 * 
 * @author ura@itx.ru
 * 
 * @version 1.0 2021-11-29
 */
interface iController{
    public function render(web\Mvc\Template $template,web\Mvc\Model $model);
}
?>