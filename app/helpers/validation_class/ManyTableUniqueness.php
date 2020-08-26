<?php

namespace WBC\Helpers\ValidationClass;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\Validator\Uniqueness;

class ManyTableUniqueness extends Uniqueness
{
    const TYPE_ERROR = 'Uniqueness';

    public function validate(Validation $validation, $field)
    {
        $model          = $this->getOption('model');
        $currentModel   = get_class($model);
        $models         = $this->getOption('models');

        $currentField = $models[$currentModel];
        $dataField    = $model->{$currentField};

        $this->setOption('findData', $dataField);
        foreach($models as $testModel => $field) {
            $this->setOption('field', $field);

            if($testModel == $currentModel) {
                if(!parent::validate($validation, $field)) {
                    return false;
                }

                continue;
            } elseif ($this->isFindRecord($testModel)) {
                $validation->appendMessage(new Message(_('This record not unique'), $field, self::TYPE_ERROR));

                return false;
            }
        }

        return true;
    }

    protected function isFindRecord($modelName)
    {
        $field = $this->getOption('field');
        $dataField = $this->getOption('findData');

        $count = call_user_func_array(array($modelName, 'count'), array(array(
            'conditions' => $field.' = :field:',
            'bind' => array(
                'field' => $dataField
            )
        )));

        return $count > 0;
    }
}