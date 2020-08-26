<?php

namespace WBC\Helpers\ValidationErrors;


class NameValidator extends ApiValidationError
{
    public function first_name()
    {
        $this->setMsg(_('validator_first_name_not_correct'));
    }

    public function last_name()
    {
        $this->setMsg(_('validator_last_name_not_correct'));
    }

    public function second_name()
    {
        $this->setMsg(_('validator_second_name_not_correct'));
    }
}