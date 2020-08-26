<?php

use Phinx\Migration\AbstractMigration;

class CreateAclResourceAccess extends AbstractMigration
{

    public function change()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('acl_resource_access', [
            'id' => false,
            'primary_key' => ['resources_name', 'access_name']
        ]);

        $table->addColumn('resources_name', 'string', array(
            'limit' => 32,
            'null' => false
        ));

        $table->addColumn('access_name', 'string', array(
            'limit' => 32,
            'null' => false
        ));

        $table->create();
    }
}
