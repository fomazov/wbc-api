<?php

use Phinx\Migration\AbstractMigration;

class UpdateClientDeletedAtAsNull extends AbstractMigration
{
    const TABLE_NAME = 'client';

    public function up()
    {
        $tableName = $this->getTable();

        $this->execute(sprintf("ALTER TABLE %s CHANGE `deleted_at` `deleted_at` TIMESTAMP DEFAULT '0000-00-00 00:00:00'   NULL;", $tableName));
    }

    public function down()
    {
        $tableName = $this->getTable();

        $this->execute(sprintf("ALTER TABLE %s CHANGE `deleted_at` `deleted_at` TIMESTAMP DEFAULT '0000-00-00 00:00:00'   NOT NULL;", $tableName));
    }

    protected function getTable()
    {
        $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());
        return $tableAdapter->getAdapterTableName(self::TABLE_NAME);
    }
}
