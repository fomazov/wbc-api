<?php

namespace WBC\Helpers\ValidationClass;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;

class ChangePassword extends Validator
{
    const TYPE_ERROR = 'ChangePassword';

    public function validate(Validation $validation, $field)
    {
        $fieldHash   = $this->getOption('field_old_hash');
        $model       = $this->getOption('model');
        $oldPassword = $model->{$field};

        $security = $model->getDI()->getSecurity();
        if (!$security->checkHash($oldPassword, $fieldHash)) {
            $validation->appendMessage(new Message(_('validator_old_pass_not_correct'), $field, self::TYPE_ERROR));
            return false;
        }

        $updateField = $this->getOption('update_field');
        $newPassword = $model->{$updateField};

        $model->{'set'.ucfirst($updateField)}($security->hash($newPassword));
        return true;
    }
}