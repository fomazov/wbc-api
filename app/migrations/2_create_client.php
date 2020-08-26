<?php

use Phinx\Migration\AbstractMigration;

class CreateClient extends AbstractMigration
{

    public function up()
    {

        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('client');

        $table->addColumn('crm_id', 'integer', array(
            'limit' => 11,
            'null' => false,
            'default' => 0,
            'signed' => false
        ));

        $table->addColumn('area', 'integer', array(
            'limit' => 11,
            'null' => false,
            'default' => 0,
            'signed' => false
        ));

        $table->addColumn('auth_hash', 'string', array(
            'limit' => 64,
            'null' => true,
            'default' => null
        ));

        $table->addColumn('author_id', 'integer', array(
            'limit' => 11,
            'null' => false,
            'default' => 0,
            'signed' => false
        ));

        //csClient, csSuspended, csTemp
        $table->addColumn('client_status', 'integer', array(
            'limit' => 11,
            'null' => false,
            'default' => 0,
            'signed' => false
        ));

        $table->addColumn('company_id', 'integer', array(
            'limit' => 11,
            'null' => false,
            'default' => 0,
            'signed' => false
        ));

        $table->addColumn('default_locale', 'integer', array(
            'limit' => 3,
            'null' => false,
            'default' => 1,
            'signed' => false
        ));

        $table->addColumn('first_name', 'string', array(
            'limit' => 50,
            'null' => false
        ));

        $table->addColumn('last_name', 'string', array(
            'limit' => 50,
            'null' => false
        ));

        $table->addColumn('password', 'string', array(
            'limit' => 60,
            'null' => false
        ));

        $table->addColumn('token', 'string', array(
            'limit' => 60,
            'null' => false,
            'default' => ''
        ));

        $table->addColumn('detalisation', 'integer', array(
            'limit' => 11,
            'null' => false,
            'default' => 0,
            'signed' => false
        ));

        $table->addColumn('is_company_admin', 'integer', array(
            'limit' => 1,
            'null' => false,
            'default' => 0
        ));

        $table->addColumn('is_hidden', 'integer', array(
            'limit' => 1,
            'null' => false,
            'default' => 0
        ));

        $table->addColumn('is_players_valid', 'integer', array(
            'limit' => 1,
            'null' => false,
            'default' => 0
        ));

        $table->addColumn('private_key', 'string', array(
            'limit' => 60,
            'null' => true
        ));

        $table->addColumn('private_like_count', 'integer', array(
            'limit' => 11,
            'null' => false,
            'default' => 0,
            'signed' => false
        ));

        $table->addColumn('public_key', 'string', array(
            'limit' => 60,
            'null' => true
        ));

        $table->addColumn('public_like_count', 'integer', array(
            'limit' => 11,
            'null' => false,
            'default' => 0,
            'signed' => false
        ));

        $table->addColumn('region', 'integer', array(
            'limit' => 11,
            'null' => false,
            'default' => 0,
            'signed' => false
        ));

        //utUser, utAdmin
        $table->addColumn('user_type', 'integer', array(
            'limit' => 11,
            'null' => false,
            'default' => 0,
            'signed' => false
        ));

        $table->addColumn('expired_date', 'timestamp', array(
            'default' => 0
        ));

        $table->addColumn('created_at', 'timestamp', array(
            'default' => 'CURRENT_TIMESTAMP'
        ));

        $table->addColumn('updated_at', 'timestamp', array(
            'default' => 0
        ));

        $table->addIndex(array('id'), array('unique' => true));
        $table->addIndex('auth_hash');
        $table->addIndex('company_id');
        $table->addIndex('crm_id');

        $table->addForeignKey('default_locale', 'language', 'id', array(
            'delete' => 'RESTRICT',
            'update' => 'RESTRICT'
        ));

        $table->create();

        // change signed option for id column

        $col_id = new Phinx\Db\Table\Column();
        $col_id->setIdentity(true);
        $col_id->setType("integer");
        $col_id->setOptions(["signed" => false]);
        $table->changeColumn("id", $col_id)->save();

    }

    public function down()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");
        $this->dropTable('client');
    }

}
