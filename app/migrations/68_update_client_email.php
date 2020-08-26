<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

class UpdateClientEmail extends AbstractMigration
{
    const TABLE_NAME = 'client_email';

    public function up()
    {
        $this->getTable()
            ->addColumn('is_main', 'integer', array(
                'limit'   => MysqlAdapter::INT_TINY,
                'default' => 0,
                'null'    => false,
                'signed'  => false,
                'after'   => 'description'
            ))
            ->addColumn('is_verified', 'integer', array(
                'limit'   => MysqlAdapter::INT_TINY,
                'default' => 0,
                'null'    => false,
                'signed'  => false,
                'after'   => 'is_main'
            ))
            ->removeColumn('order')
            ->addIndex(array('client_id', 'is_main'), array('unique' => true))
            ->addIndex(array('client_id', 'is_verified'))
            ->update();

        $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());
        $tableName = $tableAdapter->getAdapterTableName(self::TABLE_NAME);

        $this->execute(sprintf('UPDATE %s SET is_main = 1, is_verified = 1;', $tableName));
    }

    public function down()
    {
        $this->getTable()
            ->addColumn('order', 'integer', array(
                'limit'   => 3,
                'null'    => false,
                'default' => 0,
                'signed'  => false,
                'after'   => 'description'
            ))
            ->removeColumn('is_main')
            ->removeColumn('is_verified')
            ->update();
    }

    protected function getTable()
    {
        return $this->table(self::TABLE_NAME);
    }
}
