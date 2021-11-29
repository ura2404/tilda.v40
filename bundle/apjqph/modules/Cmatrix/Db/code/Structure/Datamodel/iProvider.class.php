<?php
namespace Cmatrix\Db\Structure\Datamodel;

interface iProvider{
    public function sqlTableName();
    public function sqlPropName($propCode);
    public function sqlSeqName($propCode);
    public function sqlPkName(array $propCodes);
    public function sqlIndexName(array $propCodes,$isUnique);
    public function sqlFkName($propCode);
}
?>