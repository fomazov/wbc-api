<?php

namespace WBC\Helpers\ValidationErrors;

class TooLong extends ApiValidationError
{
    public function first_name()
    {
        $this->setMsg(_('validator_first_name_too_long'));
    }

    public function second_name()
    {
        $this->setMsg(_('validator_second_name_too_long'));
    }

    public function last_name()
    {
        $this->setMsg(_('validator_last_name_too_long'));
    }

    public function password()
    {
        $this->setMsg(_('validator_password_too_long'));
    }

    public function old_password()
    {
        $this->setMsg(_('validator_old_password_too_long'));
    }

    public function name()
    {
        $this->setMsg(_('validator_name_too_long'));
    }

    public function inn()
    {
        $this->setMsg(_('validator_inn_too_long'));
    }

    public function address()
    {
        $this->setMsg(_('validator_address_too_long'));
    }
}