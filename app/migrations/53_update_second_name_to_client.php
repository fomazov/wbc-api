<?php

use Phinx\Migration\AbstractMigration;

class UpdateSecondNameToClient extends AbstractMigration
{
    public function up()
    {

        $this->getTable()
            ->changeColumn('second_name', 'string', array(
                'limit' => 50,
                'null' => true,
            ))
            ->update();
    }

    public function down()
    {
        $this->getTable()
            ->changeColumn('second_name', 'string', array(
                'null' => false,
            ))
            ->update();

    }

    protected function getTable()
    {
        return $this->table('client');
    }
}
