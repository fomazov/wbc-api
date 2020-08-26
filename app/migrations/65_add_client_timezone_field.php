<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class AddClientTimezoneField extends AbstractMigration
{
    public function up()
    {
        $this->getTable()
            ->addColumn('timezone', 'integer', array(
                'limit' => 15,
                'limit' => MysqlAdapter::INT_TINY,
                'default' => 0,
                'after' => 'region'
            ))
            ->update();
    }

    public function down()
    {
        $this->getTable()
            ->removeColumn('timezone')
            ->update();
    }

    protected function getTable()
    {
        return $this->table('client');
    }
}
