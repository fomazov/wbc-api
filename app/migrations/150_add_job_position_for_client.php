<?php

use Phinx\Migration\AbstractMigration;

class AddJobPositionForClient extends AbstractMigration
{
    const TABLE_NAME = 'client';

    public function up()
    {
        $this->getTable()
            ->addColumn('job_position', 'string',
                array(
                    'limit'   => 100,
                    'null'    => true,
                )
            )
            ->update();
    }

    public function down()
    {
        $this->getTable()
            ->removeColumn('job_position')
            ->update();
    }

    protected function getTable()
    {
        return $this->table(self::TABLE_NAME);
    }
}
