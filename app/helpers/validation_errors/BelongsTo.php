<?php

namespace WBC\Helpers\ValidationErrors;


class BelongsTo extends ApiValidationError
{
    public function default_locale()
    {
        $this->setMsg(_('validator_field_not_correct'));
    }
}