<?php

use Phinx\Migration\AbstractMigration;

class CreateAclAccessList extends AbstractMigration
{

    public function change()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('acl_access_list', [
            'id' => false,
            'primary_key' => ['roles_name', 'resources_name', 'access_name']
        ]);

        $table->addColumn('roles_name', 'string', array(
            'limit' => 32,
            'null' => false
        ));

        $table->addColumn('resources_name', 'string', array(
            'limit' => 32,
            'null' => false
        ));

        $table->addColumn('access_name', 'string', array(
            'limit' => 32,
            'null' => false
        ));

        $table->addColumn('allowed', 'integer', array(
            'limit' => 3,
            'null' => false,
            'default' => null
        ));

        $table->create();
    }
}
