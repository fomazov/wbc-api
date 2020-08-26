<?php

use Phinx\Migration\AbstractMigration;

class AddDefaultData extends AbstractMigration
{
    public function up()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());

        // add languages
        $languageTableName = $tableAdapter->getAdapterTableName('language');
        $this->execute(sprintf("INSERT INTO %s (iso, locale, `name`, short_name, url, `order`, `primary`) VALUES ('en', 'en_EN', 'English', 'Eng', 'en', '0', '0');", $languageTableName));
        $this->execute(sprintf("INSERT INTO %s (iso, locale, name, short_name, url, `order`, `primary`) VALUES ('ru', 'ru_RU', 'Русский', 'Рус', 'ru', '1', '1');", $languageTableName));

        // add my personal account
        $clientTableName = $tableAdapter->getAdapterTableName('client');
        $this->execute(sprintf('INSERT INTO %s (password, first_name, last_name, token) VALUES ("$2y$08$cTAvOU9HWE5uVUt6alp0Z.QktxSTo7YQWvgYDfCnVM.TDRMe9AduG","Oleksii","Fomazov", "");', $clientTableName));
        $this->execute(sprintf('INSERT INTO %s (password, first_name, last_name, token) VALUES ("$2y$08$cTAvOU9HWE5uVUt6alp0Z.QktxSTo7YQWvgYDfCnVM.TDRMe9AduG","System","Account", "");', $clientTableName));

        // add developers emails
        $clientEmailTableName = $tableAdapter->getAdapterTableName('client_email');
        $this->execute(sprintf('INSERT INTO %s (client_id, email, `order`) VALUES ("1", "alexey@fomazov.name", "0");', $clientEmailTableName));
        $this->execute(sprintf('INSERT INTO %s (client_id, email, `order`) VALUES ("2", "robot@fomazov.name", "0");', $clientEmailTableName));

    }

    public function down()
    {
        $this->execute("SET FOREIGN_KEY_CHECKS=0;");

        $tableAdapter = new Phinx\Db\Adapter\TablePrefixAdapter($this->getAdapter());

        $languageTableName = $tableAdapter->getAdapterTableName('language');
        $clientTableName = $tableAdapter->getAdapterTableName('client');
        $clientEmailTableName = $tableAdapter->getAdapterTableName('client_email');

        $this->execute(sprintf('DELETE FROM %s WHERE iso IN (\'en\', \'ru\')', $languageTableName));
        $this->execute(sprintf('DELETE FROM %s WHERE last_name IN (\'Fomazov\', \'Account\')', $clientTableName));
        $this->execute(sprintf('DELETE FROM %s WHERE email IN (\'alexey@fomazov.name\', \'robot@fomazov.name\')', $clientEmailTableName));
    }

}
