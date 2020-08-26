<?php

namespace WBC\Helpers\ValidationErrors;

class PresenceOf extends ApiValidationError
{
    public function email()
    {
        $this->setMsg(_('validator_email_presence_of'));
    }

    public function first_name()
    {
        $this->setMsg(_('validator_first_name_presence_of'));
    }

    public function last_name()
    {
        $this->setMsg(_('validator_last_name_presence_of'));
    }

    public function password()
    {
        $this->setMsg(_('validator_password_presence_of'));
    }

    public function phone_number()
    {
        $this->setMsg(_('validator_phone_number_presence_of'));
    }

    public function name()
    {
        $this->setMsg(_('validator_name_presence_of'));
    }

    public function phone()
    {
        $this->setMsg(_('validator_phone_number_presence_of'));
    }

    public function site()
    {
        $this->setMsg(_('validator_site_presence_of'));
    }

    public function title()
    {
        $this->setMsg(_('validator_title_presence_of'));
    }

    public function alias()
    {
        $this->setMsg(_('validator_alias_presence_of'));
    }

    public function type_content()
    {
        $this->setMsg(_('validator_type_content_presence_of'));
    }

    public function section_id()
    {
        $this->setMsg(_('validator_section_id_presence_of'));
    }

    public function start_offset()
    {
        $this->setMsg(_('validator_start_offset_presence_of'));
    }

    public function end_offset()
    {
        $this->setMsg(_('validator_end_offset_presence_of'));
    }

    public function color()
    {
        $this->setMsg(_('validator_color_presence_of'));
    }

    public function annotation()
    {
        $this->setMsg(_('validator_annotation_presence_of'));
    }
}