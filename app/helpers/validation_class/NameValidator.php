<?php

namespace WBC\Helpers\ValidationClass;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;

class NameValidator extends Validator
{
    const TYPE_ERROR = 'NameValidator';

    public function validate(Validation $validation, $field)
    {
        $model = $this->getOption('model');
        $fieldName = $model->{$field};

        $pattern = '/^$|^\s*(((?=[^_])\w)+([\s\-`\'])?){2}\s*$/isu';

        if (!preg_match($pattern, $fieldName)) {
            $validation->appendMessage(new Message(_('validator_field_name_not_correct'), $field, self::TYPE_ERROR));
            return false;
        }

        return true;
    }
}