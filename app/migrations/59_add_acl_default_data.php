<?php

use Phinx\Migration\AbstractMigration;

class AddAclDefaultData extends AbstractMigration
{
    public function up()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());

        $aclAccessListTableName = $tableAdapter->getAdapterTableName('acl_access_list');
        $aclResourceTableName = $tableAdapter->getAdapterTableName('acl_resource');
        $aclResourceAccessTableName = $tableAdapter->getAdapterTableName('acl_resource_access');
        $aclRoleTableName = $tableAdapter->getAdapterTableName('acl_role');

        $this->execute("TRUNCATE {$aclAccessListTableName}");
        $this->execute("TRUNCATE {$aclResourceTableName}");
        $this->execute("TRUNCATE {$aclResourceAccessTableName}");
        $this->execute("TRUNCATE {$aclRoleTableName}");
/*
INSERT INTO `*_acl_access_list` (`roles_name`, `resources_name`, `access_name`, `allowed`) VALUES
    ('utRobot', '*', '*', 0),
	('utRobot', 'WebhookController', '*', 0),
	('utRobot', 'WebhookController', 'aclRewrite', 1);
INSERT INTO `*_acl_resource` (`name`, `description`) VALUES
    ('WebhookController', NULL);
INSERT INTO `*_acl_resource_access` (`resources_name`, `access_name`) VALUES
    ('WebhookController', 'aclRewrite');
INSERT INTO `*_acl_role` (`name`, `description`) VALUES
    ('utRobot', NULL);
*/


        // add acl_access_list
        $this->execute(sprintf("INSERT INTO %s (`roles_name`, `resources_name`, `access_name`, `allowed`) VALUES ('utRobot', '*', '*', 0);", $aclAccessListTableName));
        $this->execute(sprintf("INSERT INTO %s (`roles_name`, `resources_name`, `access_name`, `allowed`) VALUES ('utRobot', 'WebhookController', '*', 0);", $aclAccessListTableName));
        $this->execute(sprintf("INSERT INTO %s (`roles_name`, `resources_name`, `access_name`, `allowed`) VALUES ('utRobot', 'WebhookController', 'aclRewrite', 1);", $aclAccessListTableName));

        // add acl_resource
        $this->execute(sprintf("INSERT INTO %s (`name`, `description`) VALUES ('WebhookController', NULL);", $aclResourceTableName));

        // add acl_resource_access
        $this->execute(sprintf("INSERT INTO %s (`resources_name`, `access_name`) VALUES ('WebhookController', 'aclRewrite');", $aclResourceAccessTableName));

        // add acl_role
        $this->execute(sprintf("INSERT INTO %s (`name`, `description`) VALUES ('utRobot', NULL);", $aclRoleTableName));
    }

    public function down()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());

        $aclAccessListTableName = $tableAdapter->getAdapterTableName('acl_access_list');
        $aclResourceTableName = $tableAdapter->getAdapterTableName('acl_resource');
        $aclResourceAccessTableName = $tableAdapter->getAdapterTableName('acl_resource_access');
        $aclRoleTableName = $tableAdapter->getAdapterTableName('acl_role');

        $this->execute("TRUNCATE {$aclAccessListTableName}");
        $this->execute("TRUNCATE {$aclResourceTableName}");
        $this->execute("TRUNCATE {$aclResourceAccessTableName}");
        $this->execute("TRUNCATE {$aclRoleTableName}");
    }

}