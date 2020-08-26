<?php

use Phinx\Migration\AbstractMigration;

class CreateClientTerminal extends AbstractMigration
{

    public function change()
    {

        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('client_terminal', array(
            'id' => false
        ));

        $table->addColumn('client_id', 'integer', array(
            'limit' => 11,
            'null' => false,
            'signed' => false
        ));

        $table->addColumn('terminal_id', 'integer', array(
            'limit' => 11,
            'null' => false,
            'signed' => false
        ));

        $table->addColumn('expired_at', 'timestamp', array(
            'default' => 0
        ));

        $table->addColumn('created_at', 'timestamp', array(
            'default' => 'CURRENT_TIMESTAMP'
        ));

        $table->addColumn('updated_at', 'timestamp', array(
            'default' => 0
        ));

        $table->addIndex('client_id');
        $table->addIndex('terminal_id');

        $table->addForeignKey('client_id', 'client', 'id', array(
            'delete' => 'CASCADE',
            'update' => 'RESTRICT'
        ));

        $table->create();

    }
}
