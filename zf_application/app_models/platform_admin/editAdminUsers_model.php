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

class EditAdminUsers_Model extends Zf_Model {
    
   
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
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main method for the schoo set up.                                      |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function editAdministrationUser($action){
        
        //He we collect and validate all the platfrom user information
        
        if($action == "editAdminUsers"){
                
            $this->zf_formController->zf_postFormData('adminDesignation')
                                ->zf_validateFormData('zf_maximumLength', 5, 'Designation')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Designation')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Designation')
                                
                                ->zf_postFormData('adminId')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Admin ID')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Admin ID')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Admin ID')
                
                                ->zf_postFormData('adminFirstName')
                                ->zf_validateFormData('zf_maximumLength', 30, 'First name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'First name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'First name')
                
                                ->zf_postFormData('adminLastName')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Last name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Last name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Last name')
                
                                ->zf_postFormData('adminEmailAddress')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Email address')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Email address')
                                ->zf_validateFormData('zf_checkEmail', 'adminEmailAddress')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Email Address')
                
                                ->zf_postFormData('adminMobileNumber')
                                ->zf_validateFormData('zf_maximumLength', 20, 'Mobile number')
                                ->zf_validateFormData('zf_minimumLength', 10, 'Mobile number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Mobile number')
                
                                ->zf_postFormData('adminAddress')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Post address')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Post address')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Post address')
                
                                ->zf_postFormData('adminGender')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Admin gender')
                
                                ->zf_postFormData('hiddenEmail')
                                ->zf_postFormData('hiddenAdminId');

        }

        $this->zf_formController->zf_postFormData('identificationCode');

        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        $this->_validResult = $this->zf_formController->zf_fetchValidData(); 
        
        //echo'<pre>'; print_r($this->_validResult); echo'<pre>'; //exit(); //This is strictly for debugging purpose.
        //echo'<pre>'; print_r($this->_errorResult); echo'<pre>'; exit(); //This is strictly for debugging purpose.
        
        //If the error result is empty.
        if (empty($this->_errorResult)) {
            
            
            if($action == "editAdminUsers"){
                
                //Before we do anything lets confirm that the email address is new or of the same user.
                if($this->_validResult['hiddenEmail'] != $this->_validResult['adminEmailAddress']){

                    //1. If not equal and already existing throw error and terminate.
                    $userValues['email'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminEmailAddress']);
                    $userColumns = array('email');

                    $zvss_userSql = Zf_QueryGenerator::BuildSQLSelect('zvss_application_users', $userValues, $userColumns);
                    $zvss_executeUserSql = $this->Zf_AdoDB->Execute($zvss_userSql);

                    if(!$zvss_executeUserSql){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{

                        if($zvss_executeUserSql->RecordCount() > 0){

                            //This email is in use by another zeepo user.
                            Zf_SessionHandler::zf_setSessionVariable("users_setup", "users_email_error");
                            Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_users', 'platform_users');
                            exit();

                        }else{

                            //2. If not equal and not existing, qualify and confirm the admin id.
                            if($this->_validResult['hiddenAdminId'] != $this->_validResult['adminId']){

                                $this->confirmUserID($this->_validResult);

                            }else{

                                //Just update the user information as its not affecting other users.
                                $this->updateUserInformation($this->_validResult);

                            }

                        }

                    } 


                }else{

                    //confirm that the user id is also uniques
                    if($this->_validResult['hiddenAdminId'] != $this->_validResult['adminId']){

                        $this->confirmUserID($this->_validResult);

                    }else{

                        //Just update the user information as its not affecting other users.  
                        $this->updateUserInformation($this->_validResult);

                    }

                }
            
            }else if($action == "deleteAdminUsers"){
                
                //Just update the user information as its not affecting other users.  
                $this->deleteUserInformation($this->_validResult);

            }
             
        } else {

            //echo "The form has some errors which MUST be rectified"; exit(); //This is strictly for debugging purpose.
            Zf_SessionHandler::zf_setSessionVariable("users_setup", "users_setup_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_users', 'platform_users');
            
        }
        
        
    }
    
    
    
    //This is the private function for confirming user id
    private function confirmUserID($validResults){
        
        $userValues['adminId'] = Zf_QueryGenerator::SQLValue($validResults['adminId']);
        $userColumns = array('adminId');

        $zvss_userSql = Zf_QueryGenerator::BuildSQLSelect('zvss_platform_main_admins', $userValues, $userColumns);
        $zvss_executeUserSql = $this->Zf_AdoDB->Execute($zvss_userSql);

        if(!$zvss_executeUserSql){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zvss_executeUserSql->RecordCount() > 0){

                //This user is in use by another zeepo user.
                Zf_SessionHandler::zf_setSessionVariable("users_setup", "users_id_error");
                Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_users', 'platform_users');
                exit();

            }else{
                
                //We update the user information.
                $this->updateUserInformation($this->_validResult);
                
            }

        }
        
    }
    
    
    //This is the private function that actually updates the user information
    private function updateUserInformation($validResult){
        
        //We create a new identification code
        $outletCountry = "254";//country code
        $outletLocality = "30";//county code
        $outletCode = "zippo_platform_admin"; //outlet code
        $userRole = ZIPPO_PLATFORM_ADMIN;//user role
        $userId = $validResult['adminId']; //user id
        
        //User identificationCode, includes, the Outlet system Code, Outlet User Role, and Outlet User Id.
        $identificationCode = Zf_SecureData::zf_encode_data($outletCountry.ZVSS_CONNECT.$outletLocality.ZVSS_CONNECT.$outletCode.ZVSS_CONNECT.$userRole.ZVSS_CONNECT.$userId);
         
        
        
        foreach ($validResult as $zf_fieldName => $zf_fieldValue) {

            //1. first batch is for zvss_application_users
            if($zf_fieldName == "adminEmailAddress"){

                $zvss_userDetails['email'] = Zf_QueryGenerator::SQLValue($zf_fieldValue);
                
            }

            //2. second batch is for zvss_platform_main_admin
            else if($zf_fieldName == "adminDesignation" || $zf_fieldName == "adminId" || $zf_fieldName == "adminFirstName" || $zf_fieldName == "adminLastName" || $zf_fieldName == "adminMobileNumber" || $zf_fieldName == "adminAddress" || $zf_fieldName == "adminGender"){

                $zvss_adminDetails[$zf_fieldName] = Zf_QueryGenerator::SQLValue($zf_fieldValue);

            }

        }
        
        //Also update the new identification code.
        $zvss_userDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);
        $zvss_adminDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);
        
        //This is the initial identification code.
        $initialIdentificationCode = $validResult['identificationCode'];
        
        //This is the status column against which we compare.
        $zvss_columnsUpdate['identificationCode'] = Zf_QueryGenerator::SQLValue($initialIdentificationCode);

        //Generate the SQL Query
        $zvss_updateApplicationUser = Zf_QueryGenerator::BuildSQLUpdate('zvss_application_users', $zvss_userDetails, $zvss_columnsUpdate);
        $zvss_updateAdminDetails = Zf_QueryGenerator::BuildSQLUpdate('zvss_platform_main_admins', $zvss_adminDetails, $zvss_columnsUpdate);

        //echo $zvss_updateApplicationUser."<br><br>".$zvss_updateAdminDetails; exit();
        //Execute the queries
        $zvss_executeUpdateApplicationUser = $this->Zf_AdoDB->Execute($zvss_updateApplicationUser);
        $zvss_executeUpdateAdminDetails = $this->Zf_AdoDB->Execute($zvss_updateAdminDetails);
        
        if(!$zvss_executeUpdateApplicationUser || !$zvss_executeUpdateAdminDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            //Updated successfully
            if($validResult['identificationCode'] === Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
                
                Zf_GenerateLinks::zf_header_location("initialize", "logout"); exit();
                
            }else{
                Zf_SessionHandler::zf_setSessionVariable("users_setup", "users_edit_success");
                Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_users', 'platform_users');
                exit();
            }
           
        }
        
        
    }
    
    
    //This is the private function that actually deletes the user information
    private function deleteUserInformation($validResult){
        
        
        //This is the initial identification code.
        $initialIdentificationCode = $validResult['identificationCode'];
        
        //This is the status column against which we compare.
        $zvss_columnsDelete['identificationCode'] = Zf_QueryGenerator::SQLValue($initialIdentificationCode);

        //Generate the SQL Query
        $zvss_deleteApplicationUser = Zf_QueryGenerator::BuildSQLDelete('zvss_application_users', $zvss_columnsDelete);
        $zvss_deleteAdminDetails = Zf_QueryGenerator::BuildSQLDelete('zvss_platform_main_admins', $zvss_columnsDelete);

        //echo $zvss_deleteApplicationUser."<br><br>".$zvss_deleteAdminDetails; exit();
        //Execute the queries
        $zvss_executeDeleteApplicationUser = $this->Zf_AdoDB->Execute($zvss_deleteApplicationUser);
        $zvss_executeDeleteAdminDetails = $this->Zf_AdoDB->Execute($zvss_deleteAdminDetails);
        
        if(!$zvss_executeDeleteApplicationUser || !$zvss_executeDeleteAdminDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            //Updated successfully
            if($initialIdentificationCode === Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
                
                Zf_GenerateLinks::zf_header_location("initialize", "logout"); exit();
                
            }else{
                Zf_SessionHandler::zf_setSessionVariable("users_setup", "users_delete_success");
                Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_users', 'platform_users');
                exit();
            }
           
        }
        
        
    }

   
}

?>
