<?php

namespace WBC\Helpers\ValidationErrors;

class Regex extends ApiValidationError
{
    public function phone_number()
    {
        $this->setMsg(_('validator_phone_number_regex'));
    }
    
    public function value()
    {
        $this->setMsg(_('validator_phone_number_regex'));
    }
}