<?php

use Phinx\Migration\AbstractMigration;

class UpdateClientLinkedinProfileUrl extends AbstractMigration
{
    public function change()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('client');

        $table->addColumn('linkedin_profile_url', 'string', array(
            'limit' => 255,
            'null' => true
        ));

        $table->save();

    }
}