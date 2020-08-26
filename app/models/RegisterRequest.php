<?php

namespace WBC\Models;

use WBC\Helpers\ClientHelper;

class RegisterRequest extends ApiModel
{

    use ClientHelper;

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $code;

    /**
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @var string
     */
    protected $password;

    /**
     *
     * @var string
     */
    protected $first_name;

    /**
     *
     * @var string
     */
    protected $last_name;

    /**
     *
     * @var string
     */
    protected $created_at;

    /**
     *
     * @var string
     */
    protected $updated_at;

    /**
     *
     * @var string
     */
    protected $company_field;

    protected $linkedin_profile_url;

    public $request_url;

    public $sendEmail = true;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field code
     *
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Method to set the value of field email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Method to set the value of field password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Method to set the value of field first_name
     *
     * @param string $first_name
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    /**
     * Method to set the value of field last_name
     *
     * @param string $last_name
     * @return $this
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Method to set the value of field created_at
     *
     * @param string $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Method to set the value of field updated_at
     *
     * @param string $updated_at
     * @return $this
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Method to set the value of field company_field
     *
     * @param string $company_field
     * @return $this
     */
    public function setCompanyField($company_field)
    {
        $this->company_field = $company_field;

        return $this;
    }

    /**
     * Method to set the value of field linkedin_profile_url
     *
     * @param string $linkedin_profile_url
     * @return $this
     */
    public function setLinkedinProfileUrl($linkedin_profile_url)
    {
        $this->linkedin_profile_url = $linkedin_profile_url;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the value of field first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Returns the value of field last_name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Returns the value of field created_at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Returns the value of field updated_at
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Returns the value of field company_field
     *
     * @return string
     */
    public function getCompanyField()
    {
        return $this->company_field;
    }

    /**
     * Returns the value of field linkedin_profile_url
     *
     * @return string
     */
    public function getLinkedinProfileUrl()
    {
        return $this->linkedin_profile_url;
    }

    public function afterValidationOnCreate()
    {
        $this->setPassword(self::createHash($this->getPassword()));
    }

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate()
    {
        parent::beforeValidationOnCreate();

        //Generate a random confirmation code
        $this->setCode(preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(24))));

    }

    /**
     * Send a confirmation e-mail to the user after create the account
     */
    public function afterCreate()
    {
        if (!$this->sendEmail){
            return;
        }

        $activateUrl = $this->getDi()->getEnvUrl('clientUrl', sprintf('/activate/%s', $this->getCode()));
        $mailer = $this->getDi()->getMailer();

        if ($this->request_url) {
            $activateUrl .= '?request_url=' . $this->request_url;
        }
        
        $vars = [
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'activateUrl' => $activateUrl
        ];
        $message = $mailer->createMessageFromView('activate', $vars)
            ->to($this->getEmail(), $this->getFirstName() . ' ' . $this->getLastName())
            ->subject(_('subj_confirm_email')); // Please confirm your email

        $message->send();
    }

    public function validation()
    {
        $this->presetValidation()->emailValidation(true);

        return $this->validate($this->getValidator());
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return RegisterRequest[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return RegisterRequest
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
