<?php

//THIS CODE IS WRITTEN BY:
          //1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Index Model which is responsible responsible for        |
 * |  handling all logics that are related to the template Controller  |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class ActivateUserAccount_Model extends Zf_Model {
    
   
    private $_errorResult = array();
    private $_validResult = array();

   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
         parent::__construct();
         
         
    }
    
    //THIS METHOD DOES THE PROCESSING ACTIVATION OF USER ACCOUNTS
    public function processActivateUserAccount($zvss_userEmail){
      
        $zvss_valueUserEmail['email'] = Zf_QueryGenerator::SQLValue($zvss_userEmail);
        $zvss_columnIdentificationCode = array('identificationCode');
        $zvss_sqlSelectIdentificationCode = Zf_QueryGenerator::BuildSQLSelect('zvss_application_users', $zvss_valueUserEmail, $zvss_columnIdentificationCode);

        $zvss_executeSelectIdentificationCode = $this->Zf_AdoDB->Execute($zvss_sqlSelectIdentificationCode);

        if (!$zvss_executeSelectIdentificationCode) {

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        } else {

            //Encrypted user identification code.
            $identificationCode = $zvss_executeSelectIdentificationCode->fields['identificationCode'];

            //Start a session with the identification code
            Zf_SessionHandler::zf_setSessionVariable("zvss_identificationCode", $identificationCode);


            /**
             * -------------------------------------------------------------
             * This is the actual content of the decoded identification
             * code. Its an array i.e '$identificationArray' with vitally 
             * coded user information
             * ------------------------------------------------------------
              Array
              (
              [0] => 254                              //Is the country code
              [1] => 027                              //Is the locality code
              [2] => p2eiNfFAvcd3CsUXLV579%BW8oj1SO   //Is the school's system generated code
              [3] => 7                                //Is the user role in the school
              [4] => 0001                             //Is the user code in the school
              )
             * 
             */
            $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
            
            //print_r($identificationArray); exit(); //This is strictly for debugging.
            
            //EACH OF THE REDIRECTIONS IN THIS SECTION ARE ROLE BASED AS SPECIFIED.
                                            
            //If the user role is a Zilas Platform Super Admin == 10
            if($identificationArray[3] == PLATFORM_SUPER_ADMIN){

                Zf_GenerateLinks::zf_header_location("super_admin", "index", $identificationCode);
                exit();

            }   
            //If the user role is a Zilas Virtual Schools Admin == 9
            else if($identificationArray[3] == ZILAS_VS_ADMIN){

                Zf_GenerateLinks::zf_header_location("platform_admin", "index", $identificationCode);
                exit();

            }
            //If the user role is a School Principal == 8
            else if($identificationArray[3] == SCHOOL_PRINCIPAL){

                Zf_GenerateLinks::zf_header_location("school_principal", "index", $identificationCode);
                exit();

            }
            //If the user role is a School's Main Administrator == 7
            else if($identificationArray[3] == SCHOOL_MAIN_ADMIN){

                $this->activateMainSchoolAdmin($identificationArray, $zvss_userEmail);
                exit();

            }
            //If the user role is in School Administration Group == 6
            else if($identificationArray[3] == SCHOOL_ADMIN){

                Zf_GenerateLinks::zf_header_location("general_school_admin", "index", $identificationCode);
                exit();

            }
            //If the user role is in School BOG Group == 5
            else if($identificationArray[3] == SCHOOL_BOG){

                Zf_GenerateLinks::zf_header_location("school_bog", "index", $identificationCode);
                exit();

            }
            //If the user role is in School Students Group == 4
            else if($identificationArray[3] == SCHOOL_STUDENT){

                Zf_GenerateLinks::zf_header_location("school_student", "index", $identificationCode);
                exit();

            }
            //If the user role is in School Parents Group == 3
            else if($identificationArray[3] == SCHOOL_PARENT){

                Zf_GenerateLinks::zf_header_location("school_parent", "index", $identificationCode);
                exit();

            }
            //If the user role is in School Alumni Group == 2
            else if($identificationArray[3] == SCHOOL_ALUMNI){

                Zf_GenerateLinks::zf_header_location("school_alumni", "index", $identificationCode);
                exit();

            }
            //If the user role is in Banned Users Group == 1
            else if($identificationArray[3] == BANNED_USER){

                Zf_GenerateLinks::zf_header_location("banned_user", "index", $identificationCode);
                exit();

            }
            //If the user role is in Guest Users Group == 0
            else if($identificationArray[3] == GUEST_USER){

                Zf_GenerateLinks::zf_header_location("guest_user", "index", $identificationCode);
                exit();

            }
            
        }
        
    }
    
    
    /**
     * This is the public method for activating Main School Administrators and the associated schools 
     */
    public function activateMainSchoolAdmin($identificationArray, $emailAddress){
        
        //1. Activate User Account
        $zvss_valueUserStatus['userStatus'] = Zf_QueryGenerator::SQLValue(1); 
        $zvss_columnEmail['email'] = Zf_QueryGenerator::SQLValue($emailAddress);
        $zvss_sqlConfirmUser = Zf_QueryGenerator::BuildSQLUpdate('zvss_application_users', $zvss_valueUserStatus, $zvss_columnEmail);
        
        //echo $zvss_sqlConfirmUser; exit(); //This is strictly for debugging purposes
        $zvss_executeConfirmUser = $this->Zf_AdoDB->Execute($zvss_sqlConfirmUser);
        
        
        //2. Activate School Account
        $zvss_valueSchoolStatus['schoolStatus'] = Zf_QueryGenerator::SQLValue(1); 
        $zvss_columnSchoolSystemCode['schoolSystemCode'] = Zf_QueryGenerator::SQLValue($identificationArray[2]);
        $zvss_sqlConfirmSchool = Zf_QueryGenerator::BuildSQLUpdate('zvss_school_details', $zvss_valueSchoolStatus, $zvss_columnSchoolSystemCode);
        
        //echo $zvss_sqlConfirmSchool; exit(); //This is strictly for debugging purposes
        $zvss_executeConfirmSchool = $this->Zf_AdoDB->Execute($zvss_sqlConfirmSchool);
        
        if(!$zvss_executeConfirmUser || !$zvss_executeConfirmSchool){

            echo "<strong>Query Execution Failed:</strong> <code>".$this->Zf_AdoDB->ErrorMsg()."</code>";

        }else{

            Zf_SessionHandler::zf_setSessionVariable("account_sign_up", "confirmed_account");
            Zf_GenerateLinks::zf_header_location("initialize", "login");
            exit();

        }
        
    }
    
    
}

?>
