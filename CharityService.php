<?php

require_once 'Charity.php';

//Class for managing Charities
class CharityService {
    private $charitiesArray = [];

    /**
     * @return array
     */
    public function getCharitiesArray()
    {
        return $this->charitiesArray;
    }

    //Achieving method overloading similar behavior using optional parameters and conditional logic
    public function addCharity($arg1,$arg2 = null, $arg3 = null) {
        if ($arg1 instanceof Charity) {
            $charity = $arg1;
            $this->charitiesArray[] = $charity;
        } else {
            $id = $arg1;
            $name = $arg2;
            $representativeEmail = $arg3;
            $this->charitiesArray[] = new Charity($name, $representativeEmail, $id);
        }
    }

    public function viewCharities() {
        foreach ($this->charitiesArray as $key => $charity) {
            //echo "Index value:".$key."\n";
            echo "ID: " . $charity->getId() . ", Name: " . $charity->getName() . " Representative: " . $charity->getRepresentativeEmail() . "\n";
        }
    }
    //backlog: could call method here which counts total donations for charity

    public function editCharity($charityId, $charityName, $representativeEmail) {
        $charity = $this->getCharityById($charityId);
        if ($charity) {
            $charity->setName($charityName);
            $charity->setRepresentativeEmail($representativeEmail);
            return true;
        } else {
            echo "No charity with ID: " .$charityId . "\n";
            return false;
        }
    }

    public function deleteCharity($charityId) {
        $charityExists = false;
        foreach ($this->charitiesArray as $key => $charity) {
            if ($charity->getId() == $charityId) {
                $charityExists = true;
                unset($this->charitiesArray[$key]); // Remove the charity from the array
                echo "Charity with ID: ".$charityId." has been deleted\n";
                break;
            }
        }
        if (!$charityExists) {
            throw new Exception("Charity with ID: ". $charityId. " not found!");
        }
    }

    public function getCharityById($charityId) {
        foreach ($this->charitiesArray as $charity) {
            if ((int)$charity->getId() === (int)$charityId) {
                return $charity; //Return Charity
            }
        }
        return null; // Charity not found
    }

    function validateEmail($email) {
        // Validate email using FILTER_VALIDATE_EMAIL
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true; // Email is valid
        } else {
            return false; // Email is invalid
        }
    }

    public function importCharitiesFromCSV($csvFile) {
        $handle = fopen($csvFile, "r");
        if ($handle !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $this->addCharity($data[0], $data[1], $data[2]);
            }
            fclose($handle);
        } else {
            throw new Exception("Unable to open CSV file.");
        }
    }


}
