<?php

namespace WBC\Helpers\ValidationErrors;


class ChangePassword extends ApiValidationError
{
    public function old_password()
    {
        $this->setMsg(_('validator_old_pass_not_correct'));
    }
}