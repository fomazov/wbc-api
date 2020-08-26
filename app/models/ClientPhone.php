<?php

namespace WBC\Models;

use WBC\Helpers\ClientHelper;

class ClientPhone extends ApiModel
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
    protected $part_one;

    /**
     *
     * @var string
     */
    protected $part_two;

    /**
     *
     * @var string
     */
    protected $part_three;

    /**
     *
     * @var string
     */
    protected $phone_number;

    /**
     *
     * @var string
     */
    protected $description;

    /**
     *
     * @var integer
     */
    protected $order;

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
     * Method to set the value of field part_one
     *
     * @param string $part_one
     * @return $this
     */
    public function setPartOne($part_one)
    {
        $this->part_one = $part_one;

        return $this;
    }

    /**
     * Method to set the value of field part_two
     *
     * @param string $part_two
     * @return $this
     */
    public function setPartTwo($part_two)
    {
        $this->part_two = $part_two;

        return $this;
    }

    /**
     * Method to set the value of field part_three
     *
     * @param string $part_three
     * @return $this
     */
    public function setPartThree($part_three)
    {
        $this->part_three = $part_three;

        return $this;
    }

    /**
     * Method to set the value of field phone_number
     *
     * @param string $phone_number
     * @return $this
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;

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
     * Method to set the value of field order
     *
     * @param integer $order
     * @return $this
     */
    public function setOrder($order)
    {
        $this->order = $order;

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
     * Returns the value of field part_one
     *
     * @return string
     */
    public function getPartOne()
    {
        return $this->part_one;
    }

    /**
     * Returns the value of field part_two
     *
     * @return string
     */
    public function getPartTwo()
    {
        return $this->part_two;
    }

    /**
     * Returns the value of field part_three
     *
     * @return string
     */
    public function getPartThree()
    {
        return $this->part_three;
    }

    /**
     * Returns the value of field phone_number
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
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
     * Returns the value of field order
     *
     * @return integer
     */
    public function getOrder()
    {
        return $this->order;
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
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();
        $this->belongsTo('client_id', 'WBC\Models\Client', 'id', array('alias' => 'Client'));
    }

    public function validation()
    {
        $this->editPhoneValidation();

        return $this->validate($this->getValidator());
    }

    public function beforeValidation()
    {
        $this->setPartOne('0');
        $this->setPartTwo('0');
        $this->setPartThree('0');
    }

    public function beforeSave()
    {
        $this->setUpdatedAt(date('Y-m-d H:i:s'));
    }
    
    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return LocalClientPhone[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return LocalClientPhone
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
