<?php

use Phinx\Migration\AbstractMigration;

class AddPrimaryKeysForClientFollower extends AbstractMigration
{
    const TABLE_NAME = 'client_follower';

    public function up()
    {
        $tableName = $this->getTableName();
        $this->execute(sprintf("ALTER TABLE %s ADD PRIMARY KEY (`client_id`, `follower_id`);", $tableName));
    }

    public function down()
    {
        $tableName = $this->getTableName();
        $this->execute(sprintf("ALTER TABLE %s DROP PRIMARY KEY;", $tableName));
    }

    protected function getTableName()
    {
        $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());
        return $tableAdapter->getAdapterTableName(self::TABLE_NAME);
    }
}
