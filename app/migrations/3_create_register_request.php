<?php

use Phinx\Migration\AbstractMigration;

class CreateRegisterRequest extends AbstractMigration
{

    public function change()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('register_request');

        $table->addColumn('code', 'string', array(
            'length' => 32,
            'null' => false
        ));

        $table->addColumn('email', 'string', array(
            'limit' => 100,
            'null' => false
        ));

        $table->addColumn('password', 'string', array(
            'limit' => 60,
            'null' => false
        ));

        $table->addColumn('first_name', 'string', array(
            'limit' => 50,
            'null' => false
        ));

        $table->addColumn('last_name', 'string', array(
            'limit' => 50,
            'null' => false
        ));

        $table->addColumn('created_at', 'timestamp', array(
            'default' => 'CURRENT_TIMESTAMP'
        ));

        $table->addColumn('updated_at', 'timestamp', array(
            'default' => null,
            'null' => true
        ));

        $table->addIndex(array('code', 'email'), array(
            'unique' => true
        ));

        $table->create();

    }
}
