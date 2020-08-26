<?php

use Phinx\Migration\AbstractMigration;

class UpdateClientColleague extends AbstractMigration
{
    const TABLE_NAME = 'client_colleague';

    public function up()
    {
        $this->table(self::TABLE_NAME)
            ->addColumn('updated_at', 'timestamp', array(
                'default' => 0
            ))
            ->update();

        $tableName = $this->getTable();
        $this->execute(sprintf("ALTER TABLE %s ADD COLUMN `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`)", $tableName));
    }
    public function down()
    {
        $this->table(self::TABLE_NAME)
            ->removeColumn('updated_at')
            ->update();

        $tableName = $this->getTable();
        $this->execute(sprintf("ALTER TABLE %s DROP COLUMN `id`, DROP PRIMARY KEY", $tableName));
    }
    protected function getTable()
    {
        $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());
        return $tableAdapter->getAdapterTableName(self::TABLE_NAME);
    }
}
