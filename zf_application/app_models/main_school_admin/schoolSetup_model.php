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

class SchoolSetup_Model extends Zf_Model {
    
   
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
    public function registerNewSchool(){
        
        //He we collect  and validate all the school setup information
        $this->zf_formController->zf_postFormData('schoolCode')
                                ->zf_validateFormData('zf_maximumLength', 60, 'School code')
                                ->zf_validateFormData('zf_minimumLength', 5, 'School code')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School code')
                
                                ->zf_postFormData('registrationNumber')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Registration No.')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Registration No.')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Registration No.')
                
                                ->zf_postFormData('schoolName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'School name')
                                ->zf_validateFormData('zf_minimumLength', 5, 'School name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School name')
                
                                ->zf_postFormData('dateOfEstablishment')
                                ->zf_validateFormData('zf_maximumLength', 10, 'Date of est.')
                                ->zf_validateFormData('zf_minimumLength', 4, 'Date of est.')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Date of est.')
                
                                ->zf_postFormData('schoolEmail')
                                ->zf_validateFormData('zf_maximumLength', 60, 'School email')
                                ->zf_validateFormData('zf_minimumLength', 5, 'School email')
                                ->zf_validateFormData('zf_checkEmail', 'schoolEmail')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School email')
                
                                ->zf_postFormData('schoolWebsite')
                                ->zf_validateFormData('zf_maximumLength', 60, 'School website')
                                ->zf_validateFormData('zf_minimumLength', 5, 'School website')
                                ->zf_validateFormData('zf_checkUrl', 'schoolWebsite')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School Website')
                
                                ->zf_postFormData('schoolPhoneNumber')
                                ->zf_validateFormData('zf_maximumLength', 20, 'Phone number')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Phone number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Phone number')
                
                                ->zf_postFormData('schoolMobileNumber')
                                ->zf_validateFormData('zf_maximumLength', 20, 'Mobile number')
                                ->zf_validateFormData('zf_minimumLength', 10, 'Mobile number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Mobile number')
                
                                ->zf_postFormData('schoolAddress')
                                ->zf_validateFormData('zf_maximumLength', 30, 'School address')
                                ->zf_validateFormData('zf_minimumLength', 2, 'School address')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School address')
                
                                ->zf_postFormData('schoolMotto')
                                ->zf_validateFormData('zf_maximumLength', 60, 'School motto')
                                ->zf_validateFormData('zf_minimumLength', 3, 'School motto')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School motto')
                
                                ->zf_postFormData('schoolLevel')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School level')
                
                                ->zf_postFormData('schoolCategory')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School category')
                
                                ->zf_postFormData('schoolGender')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School gender')
        
                                ->zf_postFormData('schoolType')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School type')
                                
                                ->zf_postFormData('schoolCountry')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School country')
        
                                ->zf_postFormData('schoolLocality')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School locality')
                
                                ->zf_postFormData('schoolLogo')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'School logo');
        
        
        //He we collect and validate all the school principal information
        $this->zf_formController->zf_postFormData('principalDesignation')
                                ->zf_validateFormData('zf_maximumLength', 5, 'Designation')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Designation')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Designation')
                                
                                ->zf_postFormData('principalId')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Principal ID')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Principal ID')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Principal ID')
                
                                ->zf_postFormData('principalFirstName')
                                ->zf_validateFormData('zf_maximumLength', 30, 'First name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'First name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'First name')
                
                                ->zf_postFormData('principalLastName')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Last name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Last name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Last name')
                
                                ->zf_postFormData('principalEmailAddress')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Email address')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Email address')
                                ->zf_validateFormData('zf_checkEmail', 'principalEmailAddress')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Email Address')
                
                                ->zf_postFormData('principalMobileNumber')
                                ->zf_validateFormData('zf_maximumLength', 20, 'Mobile number')
                                ->zf_validateFormData('zf_minimumLength', 10, 'Mobile number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Mobile number')
                
                                ->zf_postFormData('principalAddress')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Post address')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Post address')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Post address')
                
                                ->zf_postFormData('principalGender')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Principal gender')
                
                                ->zf_postFormData('principalPassword')
                                ->zf_validateFormData('zf_maximumLength', 30, 'Password')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Password')
                                ->zf_validateFormData('zf_notStrongPassword', 'principalPassword')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Password');

        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //If the error result is empty.
        if (empty($this->_errorResult)) {

            //echo'<pre>'; print_r($this->_validResult); echo'<pre>'; exit(); //This is strictly for debugging purpose.

            /**
             * =======================================================================================================
             * PROCESS THE VALID RESULTS AND THEN STORE EACH INFORMATION PEACE TO A RELEVANT PLACE.
             * ======================================================================================================
             */
            //0.Prepare all the user identification code information, then generate the encrypted user user identification code.
            $countryCode = ltrim($this->_validResult['countryCode'], "+");
            $localityCode = $this->_validResult['localityCode'];
            $schoolSystemCode = $this->zvss_generateSystemSchoolCode();
            $userRole = SCHOOL_MAIN_ADMIN;
            $userId = $this->_validResult['principalId'];
            
            $identificationCode = Zf_SecureData::zf_encode_data($countryCode."-".$localityCode."-".$schoolSystemCode."-".$userRole."-".$userId);
            //1. Store the first batch to the zvss_application_users table
            //2. Store the second batch to zvss_schools table
            //3.Store the third batch to the zvss_principals table
        } else {

            //echo "The form has some errors which MUST be rectified"; exit(); //This is strictly for debugging purpose.
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('main_school_admin', 'index');
        }
    }
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main method for the generation of a school system generated code       |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function zvss_generateSystemSchoolCode(){
        
            //Generate a random string.
            $schoolSystemCode = Zf_Core_Functions::Zf_GenerateRandomString(30);

            //Prepare the field values for SQL querying
            $zf_value["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);

            //Generate the SQL Query
            $zf_selectSchoolSystemCode = Zf_QueryGenerator::BuildSQLSelect('zvss_schools', $zf_value);

            //Execute the SQL Query
            $zf_executeSelectSchoolSystemCode = $this->Zf_AdoDB->Execute($zf_selectSchoolSystemCode);

            //Get the execution results
            if (!$zf_executeSelectSchoolSystemCode) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                
            } else {

                //The the result count
                if ($zf_executeSelectSchoolSystemCode->RecordCount() > 0) {

                    $this->zvss_generateSystemSchoolCode();

                }else{

                    return $schoolSystemCode;

                }
            }
        
    }
    
    

}

?>
