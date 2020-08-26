<?php

use Phinx\Migration\AbstractMigration;

class AddDaIdToClient extends AbstractMigration
{

    public function change()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('client');

        $table->addColumn('da_id', 'integer', array(
            'null' => true,
            'default' => null,
            'signed' => false
        ));

        $table->save();

    }
}
