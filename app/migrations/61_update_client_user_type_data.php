<?php

use Phinx\Migration\AbstractMigration;

class UpdateClientUserTypeData extends AbstractMigration
{

    public function up()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());

        $clientTableName = $tableAdapter->getAdapterTableName('client');

        // replace int value (0) to string value (utUser)
        $this->execute(sprintf('UPDATE %s SET `user_type` = \'utUser\' WHERE `user_type` = 0;', $clientTableName));
        // replace int value (0) to string value (utAdmin)
        $this->execute(sprintf('UPDATE %s SET `user_type` = \'utAdmin\' WHERE `user_type` = 6;', $clientTableName));

    }

    public function down()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());

        $clientTableName = $tableAdapter->getAdapterTableName('client');

        // replace string value (utUser) to int value (0)
        $this->execute(sprintf('UPDATE %s SET `user_type` = 0 WHERE `user_type` = \'utUser\';', $clientTableName));
        // replace string value (utAdmin) to int value (0)
        $this->execute(sprintf('UPDATE %s SET `user_type` = 6 WHERE `user_type` = \'utAdmin\';', $clientTableName));
    }
}
