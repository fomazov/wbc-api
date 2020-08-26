<?php

use Phinx\Migration\AbstractMigration;

class CreateMailChecking extends AbstractMigration
{

    public function up()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('mail_checking', array(
            'id' => 'client_id'
        ));

        $table->addColumn('code', 'string', array(
            'length' => 32,
            'null' => false
        ));

        $table->addColumn('created_at', 'timestamp', array(
            'default' => 'CURRENT_TIMESTAMP'
        ));

        $table->addIndex(array('client_id', 'code'), array(
            'unique' => true
        ));

        $table->create();

        // change signed option for client_id column

        $col_id = new Phinx\Db\Table\Column();
        $col_id->setIdentity(true);
        $col_id->setType("integer");
        $col_id->setOptions(["signed" => false]);
        $table->changeColumn("client_id", $col_id)->save();

        $table->addForeignKey('client_id', 'client', 'id', array(
            'delete' => 'RESTRICT',
            'update' => 'RESTRICT'
        ));
    }

    public function down()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");
        $this->dropTable('mail_checking');
    }


}
