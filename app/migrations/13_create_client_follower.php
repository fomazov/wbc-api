<?php

use Phinx\Migration\AbstractMigration;

class CreateClientFollower extends AbstractMigration
{

    public function change()
    {

        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('client_follower', array(
            'id' => false
        ));

        $table->addColumn('client_id', 'integer', array(
            'limit' => 11,
            'null' => false,
            'signed' => false
        ));

        $table->addColumn('follower_id', 'integer', array(
            'limit' => 11,
            'null' => false,
            'signed' => false
        ));

        $table->addColumn('created_at', 'timestamp', array(
            'default' => 'CURRENT_TIMESTAMP'
        ));

        $table->addIndex('client_id');
        $table->addIndex('follower_id');

        $table->addForeignKey('client_id', 'client', 'id', array(
            'delete' => 'CASCADE',
            'update' => 'RESTRICT'
        ));

        $table->addForeignKey('follower_id', 'client', 'id', array(
            'delete' => 'CASCADE',
            'update' => 'RESTRICT'
        ));

        $table->create();
    }
}
