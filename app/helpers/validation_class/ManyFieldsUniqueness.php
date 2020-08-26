<?php

namespace WBC\Helpers\ValidationClass;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;
use Phalcon\Validation\Validator\Uniqueness;

class ManyFieldsUniqueness extends Uniqueness
{
    const TYPE_ERROR = 'Uniqueness';

    public function validate(Validation $validation, $field)
    {
        $model   = $this->getOption('model');
        $fields  = $this->getOption('field');
        $message = $this->getOption('message');

        if (!is_array($fields)) {
            return false;
        }

        $conditions = [
            'conditions' => '',
            'bind' => []
        ];

        if ($model->getId()) {
            $conditions = [
                'conditions' => 'id != :id: ',
                'bind' => [
                    'id' => $model->getId()
                ]
            ];
        }

        foreach ($fields as $fieldName) {
            if (mb_strlen($conditions['conditions']) > 0 ) {
                $conditions['conditions'] .= ' AND '.$fieldName.' = :'.$fieldName.': ';
            } else {
                $conditions['conditions'] .= ' '.$fieldName.' = :'.$fieldName.': ';
            }
            $conditions['bind'] = array_merge($conditions['bind'], array(
                $fieldName => $model->{$fieldName}
            ));
        }

        $count = $model::count($conditions);

        if ($count) {
            $validation->appendMessage(new Message($message, $field, self::TYPE_ERROR));
            return false;
        }

        return true;
    }
}