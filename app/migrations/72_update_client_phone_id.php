<?php

use Phinx\Migration\AbstractMigration;

class UpdateClientPhoneId extends AbstractMigration
{
    const TABLE_NAME = 'client_phone';
 
    public function up()
    {
        $tableName = $this->getTable();

        $this->execute(sprintf("ALTER TABLE %s ADD COLUMN `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`)", $tableName));
    }

    public function down()
    {
        $tableName = $this->getTable();

        $this->execute(sprintf("ALTER TABLE %s DROP COLUMN `id`, DROP PRIMARY KEY", $tableName));
    }

    protected function getTable()
    {
        $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());
        return $tableAdapter->getAdapterTableName(self::TABLE_NAME);
    }
}
