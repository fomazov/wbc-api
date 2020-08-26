<?php

namespace WBC\Helpers\ValidationClass;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;

class BelongsTo extends Validator
{
    const TYPE_ERROR = 'BelongsTo';

    public function validate(Validation $validation, $attribute)
    {
        $field     = $attribute;
        $fieldFind = $this->getOption('field_find');
        $listModelName = $this->getOption('listModel');
        $model = $this->getOption('model');

        $findData = $model->{$field};

        $listModel = new $listModelName;
        $findModel = $listModel->findFirst(array(
            'conditions' => $fieldFind.' = :bind_param:',
            'bind' => array(
                'bind_param' => $findData
            )
        ));

        if (!$findModel) {
            $validation->appendMessage(new Message(_('validator_field_not_correct'), $field, self::TYPE_ERROR));
            return false;
        }

        $updateField = $this->getOption('update_field');
        $model->{'set'.ucfirst($updateField)}($findModel->id);
        return true;
    }
}