<?php

use Phinx\Migration\AbstractMigration;

class AddIndexsesToClientLibrary extends AbstractMigration
{
    const TABLE_NAME = 'client_library';

    public function up()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $this->getTable()
            ->addIndex(array('key', 'client_id', 'value'))
            ->save();
    }

    public function down()
    {
        $this->getTable()
            ->removeIndex(array('key', 'client_id', 'value'))
            ->update();
    }

    protected function getTable()
    {
        return $this->table(self::TABLE_NAME);
    }
}
