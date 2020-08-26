<?php

namespace WBC\Lib\Logger;

use Phalcon\Logger;
use Phalcon\Logger\Adapter\File as FileAdapter;

class DB extends \Phalcon\Logger\Adapter
{
    private $_logger = false;
    private $data = array();

    public function __construct()
    {
        $this->_logger = new FileAdapter(__DIR__.'/db.log');
    }

    /**
     * Add a statement to the log
     * @param string $statement
     * @param null $type
     * @param array $params
     * @return $this|\Phalcon\Logger\Adapter
     */
    public function log($statement, $type=null, array $params=null)
    {
        $this->_logger->log($type, serialize(array(
            'sql' => $statement,
            'params' => $params,
        )));

        return $this;
    }

    /**
     * return the log
     * @return array
     */
    public function getLog(){
        return $this->data;
    }

    /**
     * Required function for the interface, unused
     * @param $message
     * @param $type
     * @param $time
     * @param $context
     */
    public function logInternal($message, $type, $time, $context){

    }

    /**
     * Required function for the interface, unused
     */
    public function getFormatter(){

    }

    /**
     * Required function for the interface, unused
     */
    public function close(){

    }
}