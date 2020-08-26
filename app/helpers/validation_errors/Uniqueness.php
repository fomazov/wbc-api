<?php

namespace WBC\Helpers\ValidationErrors;

class Uniqueness extends ApiValidationError
{
    public function email()
    {
        $this->setMsg(_('validator_email_unique'));
    }

    public function phone_number()
    {
        $this->setMsg(_('validator_phone_number_unique'));
    }

    public function phone()
    {
        $this->setMsg(_('validator_phone_number_unique'));
    }

    public function name()
    {
        $this->setMsg(_('validator_name_unique'));
    }
}