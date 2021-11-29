<?php
namespace Cmatrix\Db\Connect;
use \Cmatrix\Db as db;

interface iDriver{
    public function query($query);
    public function exec($query);
}
?>