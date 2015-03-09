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

class UserSetup_Model extends Zf_Model {
    
   
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
    public function registerNewUser(){
        
        //He we collect and validate all the platfrom user information
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
                
                                ->zf_postFormData('adminPassword')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Password')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Password')
                                ->zf_validateFormData('zf_notStrongPassword', 'adminPassword')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Password');

        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        $this->_validResult = $this->zf_formController->zf_fetchValidData(); 
        
        //echo'<pre>'; print_r($this->_validResult); echo'<pre>'; //exit(); //This is strictly for debugging purpose.
        //echo'<pre>'; print_r($this->_errorResult); echo'<pre>'; exit(); //This is strictly for debugging purpose.
        
        //If the error result is empty.
        if (empty($this->_errorResult)) {

            //echo'<pre>'; print_r($this->_validResult); echo'<pre>'; exit(); //This is strictly for debugging purpose.

            /**
             * =======================================================================================================
             * PROCESS THE VALID RESULTS AND THEN STORE EACH INFORMATION PEACE TO A RELEVANT PLACE.
             * ======================================================================================================
             */
            //0.Prepare all the user identification code information, then generate the encrypted user user identification code.
            /*
             * This is the user Identification array
            Array
            (
                [0] => 254
                [1] => 30
                [2] => zippo_platform_admin
                [3] => 9
                [4] => KE25138058
            )*/
            
            $outletCountry = "254";//country code
            $outletLocality = "30";//county code
            $outletCode = "zippo_platform_admin"; //outlet code
            $userRole = ZIPPO_PLATFORM_ADMIN;//user role
            $userId = $this->_validResult['adminId']; //user id
            
            //User identificationCode, includes, the Outlet system Code, Outlet User Role, and Outlet User Id.
            $identificationCode = Zf_SecureData::zf_encode_data($outletCountry.ZVSS_CONNECT.$outletLocality.ZVSS_CONNECT.$outletCode.ZVSS_CONNECT.$userRole.ZVSS_CONNECT.$userId);
           
             
            //No outlet has already been regiestered. Therefore proceed to confirm user email and password
            $userValues['email'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminEmailAddress']);
            $userColumns = array('email');

            $zvss_userSql = Zf_QueryGenerator::BuildSQLSelect('zvss_application_users', $userValues, $userColumns);
            $zvss_executeUserSql = $this->Zf_AdoDB->Execute($zvss_userSql);

            if(!$zvss_executeUserSql){

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            }else{

                if($zvss_executeUserSql->RecordCount() > 0){

                    //This user has already been registered as an admin, throw error
                    Zf_SessionHandler::zf_setSessionVariable("users_setup", "users_setup_error");

                    $zf_errorData = array("zf_fieldName" => "adminEmailAddress", "zf_errorMessage" => "* This email is already registered.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_users', 'new_users');
                    exit();

                }else{

                    //Application user has not yet been registered. So register user as Outlet Admin.
                    //Store all the data in batches for database purposes.

                    foreach ($this->_validResult as $zf_fieldName => $zf_fieldValue) {

                        //1. first batch is for zvss_application_users
                        if($zf_fieldName == "adminPassword" || $zf_fieldName == "adminEmailAddress"){

                            $zvss_userDetails['email'] = Zf_QueryGenerator::SQLValue($this->_validResult['adminEmailAddress']);
                            $zvss_userDetails['password'] = Zf_QueryGenerator::SQLValue(Zf_SecureData::zf_encode_data($this->_validResult['adminPassword']));

                        }

                        //2. second batch is for zvss_outlet_main_admin
                        else if($zf_fieldName == "adminDesignation" || $zf_fieldName == "adminId" || $zf_fieldName == "adminFirstName" || $zf_fieldName == "adminLastName" || $zf_fieldName == "adminMobileNumber" || $zf_fieldName == "adminAddress" || $zf_fieldName == "adminGender"){

                            $zvss_adminDetails[$zf_fieldName] = Zf_QueryGenerator::SQLValue($zf_fieldValue);

                        }

                    }

                    //Other database values.
                    $zvss_userDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);
                    $zvss_userDetails['userStatus'] = Zf_QueryGenerator::SQLValue(1);

                    $zvss_adminDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);

                    //Build the insert SQL queries
                    $insertApplicationUser = Zf_QueryGenerator::BuildSQLInsert('zvss_application_users', $zvss_userDetails);
                    $executeInsertApplicationUser = $this->Zf_AdoDB->Execute($insertApplicationUser);

                    $insertAdminDetails = Zf_QueryGenerator::BuildSQLInsert('zvss_platform_main_admins', $zvss_adminDetails);
                    $executeInsertAdminDetails = $this->Zf_AdoDB->Execute($insertAdminDetails);

                    if(!$executeInsertApplicationUser || !$executeInsertAdminDetails){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{

                        //We will send an email to the outlet admin for account activation
                        Zf_SessionHandler::zf_setSessionVariable("users_setup", "users_setup_success");
                        Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_users', 'new_users');
                        exit(); 

                    }

                }

            }
            
             
        } else {

            //echo "The form has some errors which MUST be rectified"; exit(); //This is strictly for debugging purpose.
            Zf_SessionHandler::zf_setSessionVariable("users_setup", "users_setup_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_users', 'new_users');
            
        }
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main method for pulling out all users information starts by dropdown   |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function confirmUserPresence($action){
        
        $confirmUsers = $this->fetchUserInformation();
        
        if($confirmUsers == 0){
                                                        
            echo '<h3 class="form-section form-title">Zeepo Users Warning!!</h3> 
                    <div class="school-class-inner-content">
                        <span class="content-view-errors" >
                            There are no users yet!!. Add atleast one user to be able to edit user information.
                        </span>
                   </div>';

        }else{
            
            if($action == "edit"){
                
                //LOAD EDIT SUBJECT SETUP FORM
                Zf_ApplicationWidgets::zf_load_widget("platform_admin", "edit_platform_users_form.php");
                
            }else if($action == "delete"){
                
                //LOAD EDIT SUBJECT SETUP FORM
                Zf_ApplicationWidgets::zf_load_widget("platform_admin", "delete_platform_users_form.php");
                
            }

        }
        
    }
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * USERS INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchUserInformation(){
        
        $fetchZeepoUsers = Zf_QueryGenerator::BuildSQLSelect('zvss_platform_main_admins');
        
        $zf_executeFetchZeepoUsers = $this->Zf_AdoDB->Execute($fetchZeepoUsers);

        if(!$zf_executeFetchZeepoUsers){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchZeepoUsers->RecordCount() > 0){

                while(!$zf_executeFetchZeepoUsers->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolSubjects->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolSubjects->fields;
                    $results = $zf_executeFetchZeepoUsers->GetRows();
                    
                }
                
                return $results;
           
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
   
}

?>
