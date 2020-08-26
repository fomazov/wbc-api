<?php

namespace WBC\Lib\Pdo;

class Mysql extends \Phalcon\Db\Adapter\Pdo\Mysql
{
    public function __toString()
    {
        return '';
    }
}