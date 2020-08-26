<?php

use Phinx\Migration\AbstractMigration;

class AddClientTranslitFields extends AbstractMigration
{
    public function change()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('client');

        $table->addColumn('first_name_en', 'string', array(
            'limit' => 50,
            'null' => false,
            'after' => 'last_name'
        ));

        $table->addColumn('second_name_en', 'string', array(
            'limit' => 50,
            'null' => true,
            'after' => 'first_name_en'
        ));

        $table->addColumn('last_name_en', 'string', array(
            'limit' => 50,
            'null' => false,
            'after' => 'second_name_en'
        ));

        $table->save();

    }
}
