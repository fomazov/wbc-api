<?php

namespace WBC\Models;

use Phalcon\Di;

abstract class ApiModel extends \Phalcon\Mvc\Model
{
    private static $staticDI = false;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        $prefix = $this->getDi()->get('config')->database->prefix;
        $table = self::_createTableNameFromClassName($this->getModelForDetectTable());
        return $prefix . $table;
    }

    public static function getStaticDi()
    {
        if(self::$staticDI) {
           return self::$staticDI;
        }

        return self::$staticDI = Di::getDefault();
    }

    /**
     * Sets the timestamp before update the confirmation
     */
    public function beforeValidationOnUpdate()
    {
        //Timestamp the confirmation
        $this->setUpdatedAt(date('Y-m-d H:i:s',time()));
    }

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        //Timestamp the confirmation
        $this->setCreatedAt(date('Y-m-d H:i:s',time()));
    }

    public function getMessages()
    {
        $messages = array();
        $parentMessages = parent::getMessages();
        if(!is_array($parentMessages) && !($parentMessages instanceof \Traversable)) {
            return $messages;
        }

        foreach($parentMessages as $msg){
            $typeClass = $msg->getType();
            $class = sprintf('WBC\Helpers\ValidationErrors\%s', $typeClass);
            if(!class_exists($class))
                throw new \Exception(sprintf('Class \'%s\' not found', $typeClass));

            $method = $msg->getField();
            $msgInstance = new $class($messages, $msg);

            if(!method_exists($msgInstance, $method) && !is_callable(array($msgInstance, $method)))
                throw new \Exception(sprintf('Call to undefined method \'%s::%s()\'', $class, $method));

            $msgInstance->$method();
        }

        return $messages;
    }

    protected static function createHash($pass)
    {
        $security = new \Phalcon\Security();
        return $security->hash($pass);
    }

    protected function getModelForDetectTable()
    {
        return $this;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->useDynamicUpdate(true);
    }

    /**
     * Strip the namespace from the class to get the actual class name
     *
     * @param string $obj Class name with full namespace
     *
     * @return string
     * @access private
     */
    private static function _createTableNameFromClassName($model)
    {
        $classname = get_class($model);

        if (preg_match('@\\\\([\w]+)$@', $classname, $matches)) {
            $classname = $matches[1];
        }

        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $classname));
    }

    /**
     * @param $updated_at
     * @return void
     */
    abstract public function setUpdatedAt($updated_at);

    /**
     * @param $created_at
     * @return void
     */
    abstract public function setCreatedAt($created_at);

    abstract public function getCreatedAt();

    abstract public function getUpdatedAt();

}