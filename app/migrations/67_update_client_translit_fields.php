<?php

use Phinx\Migration\AbstractMigration;

class UpdateClientTranslitFields extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('client');
        $table->renameColumn('first_name_en', 'first_name_ru');
        $table->renameColumn('second_name_en', 'second_name_ru');
        $table->renameColumn('last_name_en', 'last_name_ru');
    }
}
