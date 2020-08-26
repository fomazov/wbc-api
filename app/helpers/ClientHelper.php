<?php

namespace WBC\Helpers;

use Phalcon\Validation;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Uniqueness;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Validation\Validator\Between;

use WBC\Helpers\ValidationClass\ManyTableUniqueness;
use WBC\Helpers\ValidationClass\ChangePassword;
use WBC\Helpers\ValidationClass\BelongsTo;
use WBC\Helpers\ValidationClass\NameValidator;
use WBC\Helpers\ValidationClass\Regex;


trait ClientHelper
{

    private $_validator = false;

    public function getValidator()
    {
        if(!$this->_validator) {
            $this->_validator = new Validation();
        }
        return $this->_validator;
    }

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function presetValidation()
    {
        $this->getValidator()->rules('password', array(
            new PresenceOf(),
            new StringLength(array(
                'max' => 100,
                'min' => 3
            ))
        ));

        $this->getValidator()->rules('first_name', array(
            new PresenceOf(),
            new StringLength(array(
                'max' => 50,
                'min' => 2
            )),
            new NameValidator(array(
                'model' => $this
            ))
        ));
        
        $this->getValidator()->rules('last_name', array(
            new PresenceOf(),
            new StringLength(array(
                'max' => 50,
                'min' => 2
            )),
            new NameValidator(array(
                'model' => $this
            ))
        ));

        return $this;
    }

    public function clientLibraryValidation()
    {

    }

    public function clientLibraryNotificationEmailValidation()
    {
        $this->getValidator()->add('lib_value', new InclusionIn(array(
            'domain' => array(0, 1, 2, 3)
        )));

        return $this;
    }

    public function clientLibraryNotificationValidation()
    {
        $this->getValidator()->add('lib_value', new InclusionIn(array(
            'domain' => array(0, 1)
        )));

        return $this;
    }

    public function clientLibraryForeignValidation()
    {
        $this->getValidator()->add('lib_value', new InclusionIn(array(
            'domain' => array(0, 1)
        )));

        return $this;
    }

    public function editProfileValidation()
    {
        $this->getValidator()->rules('second_name', array(
            new StringLength(array(
                'max' => 50
            )),
            new NameValidator(array(
                'model' => $this
            ))
        ));

        $this->getValidator()->add('default_locale', new BelongsTo(array(
            'model'         => $this,
            'update_field'  => 'defaultLocale',
            'listModel'     => 'WBC\Models\Language',
            'field_find'    => 'iso'
        )));

        $this->getValidator()->add('theme_id', new InclusionIn(array(
            'domain' => $this->getThemeValidatorId()
        )));

        return $this;
    }

    public function editTimezoneValidation()
    {
        $this->getValidator()->add('timezone', new Between(array(
            'minimum' => -11,
            'maximum' => 14,
        )));

        return $this;
    }

    public function changePasswordValidation($oldEntity)
    {
        $this->getValidator()->rules('old_password', array(
            new StringLength(array(
                'max' => 100,
                'min' => 3
            )),
            new ChangePassword(array(
                'model'          => $this,
                'update_field'   => 'password',
                "field_old_hash" => $oldEntity->getPassword()
            ))
        ));

        $this->getValidator()->add('password', new StringLength(array(
            'max' => 100,
            'min' => 3
        )));

        return $this;
    }

    public function emailValidation($isRegistration = false)
    {
        $modelsEmails = array(
            'WBC\Models\ClientEmail'        => 'email',
            'WBC\Models\ChangeEmailRequest' => 'email',
        );
        if ($isRegistration) {
            $modelsEmails['WBC\Models\RegisterRequest'] = 'email';
        }

        $this->getValidator()->rules('email', array(
            new PresenceOf(),
            new ManyTableUniqueness(array(
                'model' => $this,
                'models' => $modelsEmails
            )),
            new Email(array(
                'field' => 'email',
                'required' => true
            ))
        ));

        return $this;
    }

    public function editPhoneValidation()
    {
        $this->getValidator()->rules('phone_number', array(
            new PresenceOf(),
            new Uniqueness(array(
                'model' => $this
            )),
            new Regex(array(
                'model' => $this,
                'pattern' => '/^\+{0,1}[0-9-\s\(\)]+$/',
                'message' => _('validator_phone_number_not_correct')
            ))
        ));

        return $this;
    }

}