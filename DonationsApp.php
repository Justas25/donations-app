<?php
require_once 'Charity.php';
require_once 'CharityService.php';
require_once 'DonationService.php';

class DonationsApp
{

    private $charityService;
    private $donationService;

    public function __construct() {
        $this->charityService = new CharityService();
        $this->donationService = new DonationService();
    }


    public function run() {
        echo "Welcome to the Charity Application!\n";

        while (true) {
            echo "\nPlease select an option:\n";
            echo "1. View Charities\n";
            echo "2. Add Charity\n";
            echo "3. Edit Charity\n";
            echo "4. Delete Charity\n";
            echo "5. Add Donation\n";
            echo "6. View Donations\n";
            echo "7. Import Charities\n";
            echo "0. Exit application\n";

            $choice = readline("Enter your choice: ");

            switch ($choice) {
                case '1': //1. View Charities
                    $this->charityService->viewCharities();
                    break;
                case '2': //2. Add Charity
                    $charityName = readline("Enter charity name : ");
                    $representativeEmail = readline("Enter representative Email : ");
                    //Email validation
                    while ($this->charityService->validateEmail($representativeEmail)===false){
                        $representativeEmail = readline("Invalid representative Email, enter email again : ");
                    }
                    $charity = new Charity($charityName,$representativeEmail);
                    //passing an object here
                    $this->charityService->addCharity($charity);
                    echo "Charity created.\n";
                    echo "Charity name: " . $charity->getName() . " Representative email: \n" . $charity->getRepresentativeEmail() ."\n";
                    break;
                case '3': //Edit Charity
                    $charityId = readline("Enter charity ID you want to Edit : ");
                    $charityName = readline("Enter new charity name : ");
                    $representativeEmail = readline("Enter new representative Email : ");
                    //Email validation
                    while ($this->charityService->validateEmail($representativeEmail)===false){
                        $representativeEmail = readline("Invalid representative Email, enter email again : ");
                    }
                    $result = $this->charityService->editCharity($charityId,$charityName,$representativeEmail);
                    if ($result) {
                    echo "Charity wit Id: " .$charityId . " has been edited: \n New charity name: " . $charityName . "\n New representative email "
                        . $representativeEmail . "\n";
                    } else echo "Charity has not been edited! Please,try again. \n";
                    break;
                case '4': //4. Delete Charity
                    $charityId = readline("Enter charity ID you want to Delete : ");
                    $confirmation = readline("Are you sure you want to delete charity with ID:".$charityId. "?\n Confirm with YES or NO \n" );
                        while ($confirmation!=="YES"&&$confirmation!=="NO") {
                            $confirmation = readline("Invalid Choice\n Please, Confirm with YES or NO \n" );
                        }
                        if ($confirmation==="YES") {
                            try {
                                $this->charityService->deleteCharity($charityId);
                            } catch (Exception $e) {
                                echo "Error: ". $e->getMessage();
                            }
                        } else {
                            echo "Charity with ID: $charityId will not be deleted\n";
                        }
                    break;
                case '5': //5. Add Donation
                    $donorName = readline("Enter Donor name : ");
                    $amount = readline("Enter amount you want to donate : ");
                    $charityId = readline("Enter charity ID you want to Donate to : ");
                    $result = false;
                    try {
                        $result = $this->donationService->addDonation($donorName, $amount, $charityId, date("Y-m-d H:i:s"), $this->charityService->getCharitiesArray());
                    } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    if ($result) {
                        echo "Donation of " .$amount." Eur has been made. From " .$donorName. " to charity with ID: ".$charityId ."\n";
                    } else {
                        echo "Donation NOT made!\n";
                    }
                    break;
                case '6': //View donations
                    echo "All Donations made:\n";
                    $this->donationService->viewDonations();
                    break;
                case '7': //Import Charities
                    echo "NOTICE! Charities should be imported when database is empty, \n otherwise Charities ID might duplicate.\n";
                    $file = "charities.csv";
                    try {
                        $this->charityService->importCharitiesFromCSV($file);
                    } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    echo "Charities imported successfully, current charity list:\n";
                    $this->charityService->viewCharities();
                    break;
                case '0':
                    echo "Thank you for using our Charity Application. Goodbye!\n";
                    exit;
                default:
                    echo "Invalid choice. Please try again.\n";
            }
        }
    }

}

$donationsApp = new DonationsApp();
$donationsApp->run();
