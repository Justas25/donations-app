<?php

class Charity
{

    private $id;
    private static $nextId = 1;
    private $name;
    private $representativeEmail;

    /**
     * @param $id
     * @param $name
     * @param $representativeEmail
     */
    public function __construct($name, $representativeEmail, $id=null)
    {
        if ($id !== null) {
            $this->id = $id;
            // Update nextId if necessary to ensure it's greater than the provided ID
            self::$nextId = max(self::$nextId, $id + 1);
        } else {
            $this->id = self::$nextId++;
        }
        $this->name = $name;
        $this->representativeEmail = $representativeEmail;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getRepresentativeEmail()
    {
        return $this->representativeEmail;
    }

    /**
     * @param mixed $representativeEmail
     */
    public function setRepresentativeEmail($representativeEmail)
    {
        $this->representativeEmail = $representativeEmail;
    }





}