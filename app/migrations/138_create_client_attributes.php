<?php

use Phinx\Migration\AbstractMigration;

class CreateClientAttributes extends AbstractMigration
{
    const TABLE_NAME = 'client_attributes';

    public function up()
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
            ->addColumn('parent_id', 'integer',
                array(
                    'limit'    => 11,
                    'null'     => false,
                    'signed'   => false,
                )
            )
            ->addColumn('client_id', 'integer',
                array(
                    'limit'    => 11,
                    'null'     => false,
                    'signed'   => false,
                )
            )
            ->addColumn('value', 'string',
                array(
                    'limit'   => 255,
                    'null'    => false,
                )
            )

            ->addColumn('created_at', 'timestamp', array('default' => 'CURRENT_TIMESTAMP'))
            ->addColumn('updated_at', 'timestamp', array('default' => 0))

            ->addIndex(array('parent_id', 'client_id'))

            ->addForeignKey('client_id', 'client', 'id', array(
                'delete' => 'CASCADE',
                'update' => 'RESTRICT'
            ))

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
