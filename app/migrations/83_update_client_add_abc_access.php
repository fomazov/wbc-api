<?php

use Phinx\Migration\AbstractMigration;

class UpdateClientAddAbcAccess extends AbstractMigration
{
    const TABLE_NAME = 'client';

    public function up()
    {
        $this->getTable()
            ->addColumn('abc_access', 'integer', array(
                'limit'   => 1,
                'default' => 0,
                'null'    => false,
                'signed'  => false,
            ))
            ->update();
    }

    public function down()
    {
        $this->getTable()
            ->removeColumn('abc_access')
            ->update();
    }

    protected function getTable()
    {
        return $this->table(self::TABLE_NAME);
    }
}
