<?php

require_once 'Donation.php';

//class for managing donations
class DonationService
{
    private $donationsArray = [];

    public function addDonation($donorName, $amount, $charityId, $dateTime, $charities)
    {
        // Validate donation amount
        if (!is_numeric($amount) || $amount <= 0) {
            throw new Exception("Invalid donation amount.\n");
        }

        // Check if the charity exists
        $charityExists = false;
        foreach ($charities as $charity) {
            if ($charity->getId() == $charityId) {
                $charityExists = true;
                break;
            }
        }
        if (!$charityExists) {
            throw new Exception("Charity with ID $charityId not found.");
        }

        $donation = new Donation($donorName, $amount, $charityId, $dateTime);
        $this->donationsArray[] = $donation;
        return true;
    }

    public function viewDonations()
    {
        foreach ($this->donationsArray as $donation) {
           echo "Donation Id: ".$donation->getID().", Donor Name: " .$donation->getDonorName(). ", Donation Amount: ".$donation->getAmount().
               ", Charity ID: ".$donation->getCharityID().", Donation Time: ".$donation->getDateTime()."\n";

        }

    }

}

