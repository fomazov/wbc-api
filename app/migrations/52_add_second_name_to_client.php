<?php

use Phinx\Migration\AbstractMigration;

class AddSecondNameToClient extends AbstractMigration
{
    public function up()
    {

        $this->getTable()
            ->addColumn('second_name', 'string', array(
                'limit' => 50,
                'after' => 'first_name'
            ))
            ->update();
    }

    public function down()
    {
        $this->getTable()
            ->removeColumn('second_name')
            ->update();
    }

    protected function getTable()
    {
        return $this->table('client');
    }
}
