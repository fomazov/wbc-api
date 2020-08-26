<?php

namespace WBC\Helpers\ValidationErrors;

class TooShort extends ApiValidationError
{
    public function first_name()
    {
        $this->setMsg(_('validator_first_name_too_short'));
    }

    public function second_name()
    {
        $this->setMsg(_('validator_second_name_too_short'));
    }

    public function last_name()
    {
        $this->setMsg(_('validator_last_name_too_short'));
    }

    public function password()
    {
        $this->setMsg(_('validator_password_too_short'));
    }

    public function old_password()
    {
        $this->setMsg(_('validator_old_password_too_short'));
    }

    public function name()
    {
        $this->setMsg(_('validator_name_too_short'));
    }

    public function inn()
    {
        $this->setMsg(_('validator_inn_too_short'));
    }

    public function address()
    {
        $this->setMsg(_('validator_address_too_short'));
    }
}