<?php

namespace WBC\Helpers\ValidationErrors;

class Between extends ApiValidationError
{
    public function timezone()
    {
        $this->setMsg(_('validator_timezone_range_not_correct'));
    }
}