<?php

namespace WBC\Helpers\ValidationErrors;

abstract class ApiValidationError
{
    private $_msg = null;
    protected $_msgClass = null;

    final public function __construct(array & $messages, $msgClass = false)
    {
        $this->_msg = &$messages;
        $this->_msgClass = $msgClass;
    }

    public function __call($method, $args) {
        return $this->setMsg($this->_msgClass->getMessage(), $this->_msgClass->getField());
    }

    protected function setMsg($msg, $field = null)
    {
        if ($field === null) {

            $trace = debug_backtrace();
            $class = get_class($this);

            foreach ($trace as $key => $value) {
                if ($value['class'] === $class) {
                    $field = $trace[$key]['function'];
                    break;
                }
            }

        }

        if (!$field) {
            throw new \Exception(sprintf(_('validator_field_not_defined').' %s', $msg));
        } else {
            $this->_msg['message'][$field] = $msg;
        }

    }

}