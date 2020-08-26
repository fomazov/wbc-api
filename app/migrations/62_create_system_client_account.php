<?php

use Phinx\Migration\AbstractMigration;

class CreateSystemClientAccount extends AbstractMigration
{

    public function up()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());

        $clientTableName = $tableAdapter->getAdapterTableName('client');

        // create robot
        $this->execute(sprintf('UPDATE %s SET `user_type` = \'utRobot\', `password` = \'robot\', `token` = \'$2a$08$txAip6bksvCBAh94LsNjuutuFcAUBSvBlqyqN1lEVcZl6rm2P69M6\', `first_name` = \'John\', `last_name` = \'Doe\' WHERE `first_name` = \'System\' AND `last_name` = \'Account\';', $clientTableName));

    }

    public function down()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());

        $clientTableName = $tableAdapter->getAdapterTableName('client');

        // restore
        $this->execute(sprintf('UPDATE %s SET `user_type` = \'utUser\', `password` = \'$2y$10$iGgXUoDKGWpkHf7T/5KC6OWDPP7PL1o224kMErZY9fcUPIHoUlpfK\', `token` = \' \', `first_name` = \'System\', `last_name` = \'Account\' WHERE `first_name` = \'John\' AND `last_name` = \'Doe\';', $clientTableName));
    }
}
