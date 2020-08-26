<?php

namespace WBC\Models;

class ClientFollower extends ApiModel
{

    /**
     *
     * @var integer
     */
    protected $client_id;

    /**
     *
     * @var integer
     */
    protected $follower_id;

    /**
     *
     * @var string
     */
    protected $created_at;

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
     * Method to set the value of field follower_id
     *
     * @param integer $follower_id
     * @return $this
     */
    public function setFollowerId($follower_id)
    {
        $this->follower_id = $follower_id;

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
     * Returns the value of field client_id
     *
     * @return integer
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * Returns the value of field follower_id
     *
     * @return integer
     */
    public function getFollowerId()
    {
        return $this->follower_id;
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
        $this->belongsTo('client_id', 'WBC\Models\Client', 'id', array('alias' => 'Client'));
        $this->belongsTo('follower_id', 'WBC\Models\Client', 'id', array('alias' => 'Client'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ClientFollower[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ClientFollower
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
