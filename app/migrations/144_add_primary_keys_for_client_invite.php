<?php

use Phinx\Migration\AbstractMigration;

class AddPrimaryKeysForClientInvite extends AbstractMigration
{
    const TABLE_NAME = 'client_invite';

    public function up()
    {
        $tableName = $this->getTableName();
        $this->execute(sprintf("ALTER TABLE %s ADD PRIMARY KEY (`invited_id`, `inviter_id`);", $tableName));
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
