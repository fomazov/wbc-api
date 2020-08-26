<?php

namespace WBC\Helpers\ValidationErrors;

class Email extends ApiValidationError
{
    public function email()
    {
        $this->setMsg(_('validator_email_not_correct'));
    }

    public function value()
    {
        $this->setMsg(_('validator_email_not_correct'));
    }
}