<?php

use Phinx\Migration\AbstractMigration;

class RenameClientLibraryColumns extends AbstractMigration
{
    const TABLE_NAME = 'client_library';

    public function up()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");
        $table = $this->table(self::TABLE_NAME);
        $table->renameColumn('lib_key', 'key')
            ->removeIndex(array('lib_key'))
            ->addIndex(array('key'), array('unique' => true))
            ->renameColumn('lib_value', 'value');
    }

    public function down()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");
        $table = $this->table(self::TABLE_NAME);
        $table->renameColumn('key', 'lib_key')
            ->removeIndex(array('key'))
            ->addIndex(array('lib_key'), array('unique' => true))
            ->renameColumn('value', 'lib_value');
    }
}
