<?php

namespace WBC\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Uniqueness;

use WBC\Helpers\ClientHelper;

class ClientEmail extends ApiModel
{

    use ClientHelper;

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $client_id;

    /**
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @var string
     */
    protected $description;

    /**
     *
     * @var integer
     */
    protected $is_main;

    /**
     *
     * @var integer
     */
    protected $is_verified;

    /**
     *
     * @var string
     */
    protected $created_at;

    /**
     *
     * @var string
     */
    protected $updated_at = '0000-00-00 00:00:00';

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
     * Method to set the value of field client_id
     *
     * @param integer $client_id
     * @return $this
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;

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
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Method to set the value of field is_main
     *
     * @param integer $isMain
     * @return $this
     */
    public function setIsMain($isMain = 0)
    {
        $this->is_main = $isMain;

        return $this;
    }

    /**
     * Method to set the value of field is_verified
     *
     * @param integer $isVerified
     * @return $this
     */
    public function setIsVerified($isVerified = 0)
    {
        $this->is_verified = $isVerified;

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
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field client_id
     *
     * @return integer
     */
    public function getClientId()
    {
        return $this->client_id;
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
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the value of field is_main
     *
     * @return integer
     */
    public function getIsMain()
    {
        return $this->is_main;
    }

    /**
     * Returns the value of field is_verified
     *
     * @return integer
     */
    public function getIsVerified()
    {
        return $this->is_verified;
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
     * Returns the activate code by email
     *
     * @return string
     */
    public function getCode()
    {
        return md5($this->getEmail().$this->getClientId().$this->getCreatedAt().$this->getUpdatedAt());
    }

    /**
     * Send a confirmation e-mail to the user after save the email
     */
    public function afterSave()
    {
        if($this->getIsVerified()) {
            return false;
        }

        $activateUrl = $this->getDi()->getEnvUrl('clientUrl', sprintf('/activate-email/%s/%s', $this->getCode(), $this->getEmail()));
        $mailer = $this->getDi()->getMailer();

        $clientModel = $this->getClient();

        $vars = [
            'firstName'   => $clientModel->getFirstName(),
            'lastName'    => $clientModel->getLastName(),
            'activateUrl' => $activateUrl
        ];

        $message = $mailer->createMessageFromView('activate_email', $vars)
            ->to($this->getEmail(), $clientModel->getFirstName() . ' ' . $clientModel->getLastName())
            ->subject(_('subj_confirm_email')); // Please confirm your email

        $message->send();
    }

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $this->emailValidation();

        return $this->validate($this->getValidator());
    }

    public function afterCreate()
    {
        $registerRequest = RegisterRequest::findFirst(array(
            'conditions' => 'email = :email:',
            'bind' => array(
                'email' => $this->getEmail()
            )
        ));

        if($registerRequest && !$registerRequest->delete()){
            throw new \Exception('Can not delete register request row with id: ' . $registerRequest->getId());
        } else {
            return true;
        }

    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
        $this->belongsTo('client_id', 'WBC\Models\Client', 'id', array('alias' => 'Client'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ClientEmail[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ClientEmail
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
