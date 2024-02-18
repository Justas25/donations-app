<?php

class Donation
{

    private $id;
    private static $nextId=1;
    private $donorName;
    private $amount;
    private $charityId;
    private $dateTime;

    /**
     * @param $donorName
     * @param $amount
     * @param $charityId
     * @param $dateTime
     */
    public function __construct($donorName, $amount, $charityId, $dateTime)
    {
        $this->id = self::$nextId++;
        $this->donorName = $donorName;
        $this->amount = $amount;
        $this->charityId = $charityId;
        $this->dateTime = $dateTime;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getDonorName()
    {
        return $this->donorName;
    }

    /**
     * @param mixed $donorName
     */
    public function setDonorName($donorName)
    {
        $this->donorName = $donorName;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getCharityId()
    {
        return $this->charityId;
    }

    /**
     * @param mixed $charityId
     */
    public function setCharityId($charityId)
    {
        $this->charityId = $charityId;
    }

    /**
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param mixed $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }
}
