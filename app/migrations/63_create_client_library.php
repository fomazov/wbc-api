<?php

use Phinx\Migration\AbstractMigration;

class CreateClientLibrary extends AbstractMigration
{
    const TABLE_NAME = 'client_library';

    public function up()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");
        $table = $this->table(self::TABLE_NAME, array('id' => false, 'primary_key' => 'id'));
        $table->addColumn('id', 'integer',
                    array(
                        'limit' => 11,
                        'null' => false,
                        'signed' => false,
                        'identity' => true
                    )
                )
            ->addColumn('client_id', 'integer',
                    array(
                        'limit' => 11,
                        'null' => false,
                        'default' => 0,
                        'signed' => false
                    )
                )
            ->addColumn('lib_key', 'string', array('limit' => 40, 'null' => false))
            ->addColumn('lib_value', 'string', array('limit' => 40, 'null' => false))

            ->addColumn('created_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'timestamp', array('default' => 0))

            ->addIndex(array('client_id', 'lib_key'), array('unique' => true))
            ->addForeignKey('client_id', 'client', 'id',
                array('delete'=> 'CASCADE', 'update'=> 'NO_ACTION'))
            ->save();
    }

    public function down()
    {
        if (!$this->hasTable(self::TABLE_NAME)) {
            return false;
        }

        $this->execute("SET FOREIGN_KEY_CHECKS=0;");
        $this->dropTable(self::TABLE_NAME);
    }
}
