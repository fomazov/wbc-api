<?php

namespace WBC\Helpers\ValidationClass;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;

class Regex extends Validator
{
    const TYPE_ERROR = 'Regex';

    public function validate(Validation $validation, $field)
    {
        $pattern = $this->getOption('pattern');
        $model   = $this->getOption('model');
        $message = $this->getOption('message');

        try {
            $findData = $model->{$field};
        } catch (\Exception $e) {
            return false;
        }

        if (!preg_match($pattern, $findData) && mb_strlen($findData) > 0) {
            $validation->appendMessage(new Message($message, $field, self::TYPE_ERROR));
            return false;
        }

        return true;

    }
}