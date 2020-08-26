<?php

use Phinx\Migration\AbstractMigration;

class CreateLanguage extends AbstractMigration
{

    public function up()
    {

        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('language');

        $table->addColumn('iso', 'string', array(
            'limit' => 10,
            'null' => true,
            'default' => null
        ));

        $table->addColumn('locale', 'string', array(
            'limit' => 10,
            'null' => true,
            'default' => null
        ));

        $table->addColumn('name', 'string', array(
            'limit' => 20,
            'null' => true,
            'default' => null
        ));

        $table->addColumn('short_name', 'string', array(
            'limit' => 10,
            'null' => true,
            'default' => null
        ));

        $table->addColumn('url', 'string', array(
            'limit' => 20,
            'null' => true,
            'default' => null
        ));

        $table->addColumn('order', 'integer', array(
            'limit' => 11,
            'null' => false,
            'default' => 0,
            'signed' => false
        ));

        $table->addColumn('primary', 'integer', array(
            'limit' => 11,
            'null' => false,
            'default' => 0,
            'signed' => false
        ));

        $table->addColumn('created_at', 'timestamp', array(
            'default' => 'CURRENT_TIMESTAMP'
        ));

        $table->addColumn('updated_at', 'timestamp', array(
            'default' => 0
        ));

        $table->addIndex(array('id'), array('unique' => true));

        $table->create();

        // change signed option for id column

        $col_id = new Phinx\Db\Table\Column();
        $col_id->setIdentity(true);
        $col_id->setType("integer");
        $col_id->setOptions(["limit" => 3, "signed" => false]);
        $table->changeColumn("id", $col_id)->save();

    }

    public function down()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");
        $this->dropTable('language');
    }
}
