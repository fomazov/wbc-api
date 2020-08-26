<?php

use Phinx\Migration\AbstractMigration;

class AddCompanyFieldToRegisterRequest extends AbstractMigration
{
    const TABLE_NAME = 'register_request';

    public function up()
    {
        $this->getTable()
            ->addColumn('company_field', 'string', array(
                'limit'   => 50,
                'null'    => true,
            ))
            ->update();
    }

    public function down()
    {
        $this->getTable()
            ->removeColumn('company_field')
            ->update();
    }

    protected function getTable()
    {
        return $this->table(self::TABLE_NAME);
    }
}
