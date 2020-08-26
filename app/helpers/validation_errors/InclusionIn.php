<?php

namespace WBC\Helpers\ValidationErrors;


class InclusionIn extends ApiValidationError
{
    public function lib_value()
    {
        $this->setMsg(_('validator_lib_value_not_inclusion_in'));
    }

    public function is_active()
    {
        $this->setMsg(_('domain_employees_invalid_active_value'));
    }

    public function type_content()
    {
        $this->setMsg(_('domain_menu_type_content_inclusion_in'));
    }

    public function section_id()
    {
        $this->setMsg(_('rubric_news_section_id_inclusion_in'));
    }
}