<?php

use Phinx\Migration\AbstractMigration;

class CreateClientInvite extends AbstractMigration
{

    public function change()
    {

        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('client_invite', array(
            'id' => false
        ));

        $table->addColumn('invited_id', 'integer', array(
            'limit' => 11,
            'null' => false,
            'signed' => false
        ));

        $table->addColumn('inviter_id', 'integer', array(
            'limit' => 11,
            'null' => false,
            'signed' => false
        ));

        $table->addColumn('created_at', 'timestamp', array(
            'default' => 'CURRENT_TIMESTAMP'
        ));

        $table->addIndex('invited_id');
        $table->addIndex('inviter_id');

        $table->addForeignKey('invited_id', 'client', 'id', array(
            'delete' => 'CASCADE',
            'update' => 'RESTRICT'
        ));

        $table->addForeignKey('inviter_id', 'client', 'id', array(
            'delete' => 'CASCADE',
            'update' => 'RESTRICT'
        ));

        $table->create();
    }
}
