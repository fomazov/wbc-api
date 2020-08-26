<?php

use Phinx\Migration\AbstractMigration;

class UpdateClientUserType extends AbstractMigration
{

    public function up()
    {
        $this->getTable()
            ->changeColumn('user_type', 'string', array(
                'limit' => 50,
                'null' => true,
                'default' => 'utUser'
            ))
            ->update();
    }

    public function down()
    {
        $this->getTable()
            ->changeColumn('user_type', 'integer', array(
                'default' => 0
            ))
            ->update();
    }

    protected function getTable()
    {
        return $this->table('client');
    }
}
