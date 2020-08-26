<?php

namespace WBC\Models;

class ClientInvite extends ApiModel
{

    const STATUS_PENDING  = 0;
    const STATUS_APPROVED = 1;
    const STATUS_DENIED   = 2;

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $invited_id;

    /**
     *
     * @var integer
     */
    protected $inviter_id;

    /**
     *
     * @var integer
     */
    protected $status;

    /**
     *
     * @var string
     */
    protected $created_at;

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
     * Method to set the value of field invited_id
     *
     * @param integer $invited_id
     * @return $this
     */
    public function setInvitedId($invited_id)
    {
        $this->invited_id = $invited_id;

        return $this;
    }

    /**
     * Method to set the value of field inviter_id
     *
     * @param integer $inviter_id
     * @return $this
     */
    public function setInviterId($inviter_id)
    {
        $this->inviter_id = $inviter_id;

        return $this;
    }

    /**
     * Method to set the value of field status
     *
     * @param int $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

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

    public function setUpdatedAt($updated_at) {}

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
     * Returns the value of field invited_id
     *
     * @return integer
     */
    public function getInvitedId()
    {
        return $this->invited_id;
    }

    /**
     * Returns the value of field inviter_id
     *
     * @return integer
     */
    public function getInviterId()
    {
        return $this->inviter_id;
    }

    /**
     * Returns the value of field status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
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

    public function getUpdatedAt() {}

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
        $this->belongsTo('invited_id', 'WBC\Models\Client', 'id', array('alias' => 'ClientInvited'));
        $this->belongsTo('inviter_id', 'WBC\Models\Client', 'id', array('alias' => 'ClientInviter'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ClientInvite[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ClientInvite
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
