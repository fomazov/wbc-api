<?php

use Phinx\Migration\AbstractMigration;

class CreateClientEmail extends AbstractMigration
{

    public function change()
    {

        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('client_email', array(
            'id' => false
        ));

        $table->addColumn('client_id', 'integer', array(
            'limit' => 11,
            'null' => false,
            'signed' => false
        ));

        $table->addColumn('email', 'string', array(
            'limit' => 100,
            'null' => false
        ));

        $table->addColumn('description', 'string', array(
            'limit' => 100,
            'null' => true,
            'default' => null
        ));

        $table->addColumn('order', 'integer', array(
            'limit' => 3,
            'null' => false,
            'default' => 0,
            'signed' => false
        ));

        $table->addColumn('created_at', 'timestamp', array(
            'default' => 'CURRENT_TIMESTAMP'
        ));

        $table->addColumn('updated_at', 'timestamp', array(
            'default' => 0
        ));

        $table->addIndex('client_id');

        $table->addForeignKey('client_id', 'client', 'id', array(
            'delete' => 'CASCADE',
            'update' => 'RESTRICT'
        ));

        $table->create();

    }
}
