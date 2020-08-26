<?php

use Phinx\Migration\AbstractMigration;

class UpdateClientAddLastVisit extends AbstractMigration
{
    const TABLE_NAME = 'client';

    public function up()
    {
        $this->getTable()
            ->addColumn('last_visit', 'timestamp', array(
                'null'    => true,
                'default' => 0
            ))
            ->update();
    }

    public function down()
    {
        $this->getTable()
            ->removeColumn('last_visit')
            ->update();
    }

    protected function getTable()
    {
        return $this->table(self::TABLE_NAME);
    }
}
