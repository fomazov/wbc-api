<?php

use Phinx\Migration\AbstractMigration;

class CreatePasswordReset extends AbstractMigration
{
    const TABLE_NAME = 'password_reset';

    public function change()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");
        $table = $this->table(self::TABLE_NAME, array('id' => false, 'primary_key' => 'id'));
        $table->addColumn('id', 'integer',
            array(
                'limit'    => 11,
                'null'     => false,
                'signed'   => false,
                'identity' => true
            )
        )
            ->addColumn('client_id', 'integer',
                array(
                    'limit'   => 11,
                    'null'    => false,
                    'default' => 0,
                    'signed'  => false
                )
            )
            ->addColumn('code' , 'string', array('limit' => 40 , 'null' => false))
            ->addColumn('email', 'string', array('limit' => 100, 'null' => false))

            ->addColumn('created_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'timestamp', array('default' => 0))

            ->addIndex(array('client_id', 'email'), array('unique' => true))
            ->addForeignKey('client_id', 'client', 'id', array(
                    'delete' => 'CASCADE',
                    'update' => 'NO_ACTION'
                )
            )
            ->save();
    }
}
