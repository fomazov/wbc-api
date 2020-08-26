<?php

use Phinx\Migration\AbstractMigration;

class UpdateClientDeletedAt extends AbstractMigration
{
    const TABLE_NAME = 'client';

    public function up()
    {
        $this->getTable()
            ->addColumn('deleted_at', 'timestamp', array(
                'null'    => false
            ))
            ->update();
    }

    public function down()
    {
        $this->getTable()
            ->removeColumn('deleted_at')
            ->update();
    }

    protected function getTable()
    {
        return $this->table(self::TABLE_NAME);
    }
}
