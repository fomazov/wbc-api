<?php

use Phinx\Migration\AbstractMigration;

class CreateAclRoleInherit extends AbstractMigration
{

    public function change()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('acl_role_inherit', [
            'id' => false,
            'primary_key' => ['roles_name', 'roles_inherit']
        ]);

        $table->addColumn('roles_name', 'string', array(
            'limit' => 32,
            'null' => false
        ));

        $table->addColumn('roles_inherit', 'string', array(
            'limit' => 32,
            'null' => false
        ));

        $table->create();
    }
}