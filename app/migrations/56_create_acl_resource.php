<?php

use Phinx\Migration\AbstractMigration;

class CreateAclResource extends AbstractMigration
{

    public function change()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $table = $this->table('acl_resource', [
            'id' => false,
            'primary_key' => 'name'
        ]);

        $table->addColumn('name', 'string', array(
            'limit' => 32,
            'null' => false
        ));

        $table->addColumn('description', 'text', array(
            'null' => true,
            'default' => null
        ));

        $table->create();
    }
}
