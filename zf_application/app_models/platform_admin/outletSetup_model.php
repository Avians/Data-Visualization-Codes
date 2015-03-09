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

class OutletSetup_Model extends Zf_Model {
    
   
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
    public function registerNewOutlet(){
        
         //He we collect  and validate all the school setup information
        $this->zf_formController->zf_postFormData('agentType')
                                ->zf_validateFormData('zf_maximumLength', 200, 'Agent type name')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Agent type name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Agent type name')
                
                                ->zf_postFormData('outletType')
                                ->zf_validateFormData('zf_maximumLength', 20, 'Outlet type')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Outlet type')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Outlet type')
                
                                ->zf_postFormData('outletAlias')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Outlet alias')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Outlet alias')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Outlet alias')
                
                                ->zf_postFormData('outletLocation')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Outlet location')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Outlet location')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Outlet location')
                
                                ->zf_postFormData('outletArea')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Outlet area')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Outlet area')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Outlet area')
                
                                ->zf_postFormData('outletTown')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Outlet town')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Outlet town')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Outlet town')
                
                                ->zf_postFormData('outletEmail')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Email address')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Email address')
                                ->zf_validateFormData('zf_checkEmail', 'outletEmail')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Email Address')
                
                                ->zf_postFormData('outletMobileNumber')
                                ->zf_validateFormData('zf_maximumLength', 20, 'Mobile number')
                                ->zf_validateFormData('zf_minimumLength', 10, 'Mobile number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Mobile number')
                
                                ->zf_postFormData('outletCountry')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Outlet country')
                
                                ->zf_postFormData('outletLocality')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Outlet locality');
        
        
        //He we collect and validate all the school main admin information
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
            
            $outletCountry = $this->_validResult['outletCountry'];
            $outletLocality = $this->_validResult['outletLocality'];
            $outletCode = Zf_Core_Functions::Zf_CleanName($this->_validResult['outletArea']."-".$this->_validResult['outletLocation']);
            $userRole = ZIPPO_OUTLET_STAFF;
            $userId = $this->_validResult['adminId'];
            
            //User identificationCode, includes, the Outlet system Code, Outlet User Role, and Outlet User Id.
            $identificationCode = Zf_SecureData::zf_encode_data($outletCountry.ZVSS_CONNECT.$outletLocality.ZVSS_CONNECT.$outletCode.ZVSS_CONNECT.$userRole.ZVSS_CONNECT.$userId);
           
            
            //Check if a outlet with a similar outletCode already exists.
            $outletValues['outletCode'] = Zf_QueryGenerator::SQLValue($outletCode);
            
            $outletColumns = array('outletCode');
            
            $zvss_outletSql = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_details', $outletValues, $outletColumns);
            $zvss_executeOutletSql = $this->Zf_AdoDB->Execute($zvss_outletSql);
            
            if (!$zvss_executeOutletSql) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                exit();

            } else {
                
                if($zvss_executeOutletSql->RecordCount() > 0){
                    
                    //A similar outlet is already registered.
                    Zf_SessionHandler::zf_setSessionVariable("outlet_setup", "outlet_setup_error");
                    
                    $zf_errorData = array("zf_fieldName" => "outletCode", "zf_errorMessage" => "* A similar outlet code is already registered.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_outlets', 'new_outlet ');
                    exit();
                    
                }else{
                    
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
                            Zf_SessionHandler::zf_setSessionVariable("outlet_setup", "outlet_setup_error");
                            
                            $zf_errorData = array("zf_fieldName" => "adminEmailAddress", "zf_errorMessage" => "* This email is already registered.");
                            Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                            Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_outlets', 'new_outlet');
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
                                
                                //3. third batch is for zvss_outlet_details
                                else if($zf_fieldName == "agentType" || $zf_fieldName == "outletType" || $zf_fieldName == "outletAlias"  || $zf_fieldName == "outletLocation" || $zf_fieldName == "outletArea"  || $zf_fieldName == "outletTown"  || $zf_fieldName == "outletEmail" ||  $zf_fieldName == "outletMobileNumber" ||  $zf_fieldName == "outletCountry" ||  $zf_fieldName == "outletLocality"){
                                    
                                    $zvss_outletDetails[$zf_fieldName] = Zf_QueryGenerator::SQLValue($zf_fieldValue);
                                     
                                }
                                 
                            }
                            
                            //Other database values.
                            $zvss_userDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);
                            $zvss_userDetails['userStatus'] = Zf_QueryGenerator::SQLValue(1);
                            
                            $zvss_adminDetails['identificationCode'] = Zf_QueryGenerator::SQLValue($identificationCode);
                            $zvss_adminDetails['outletCode'] = Zf_QueryGenerator::SQLValue($outletCode);
                            
                            $zvss_outletDetails['outletCode'] = Zf_QueryGenerator::SQLValue($outletCode);
                            $zvss_outletDetails['dateOfRegistration'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                            $zvss_outletDetails['outletStatus'] = Zf_QueryGenerator::SQLValue(1);
                            
                            //Build the insert SQL queries
                            $insertApplicationUser = Zf_QueryGenerator::BuildSQLInsert('zvss_application_users', $zvss_userDetails);
                            $executeInsertApplicationUser = $this->Zf_AdoDB->Execute($insertApplicationUser);
                            
                            $insertAdminDetails = Zf_QueryGenerator::BuildSQLInsert('zvss_outlet_main_admins', $zvss_adminDetails);
                            $executeInsertAdminDetails = $this->Zf_AdoDB->Execute($insertAdminDetails);
                            
                            $insertOutletDetails = Zf_QueryGenerator::BuildSQLInsert('zvss_outlet_details', $zvss_outletDetails);
                            $executeInsertOutletDetails = $this->Zf_AdoDB->Execute($insertOutletDetails);
                            
                            if(!$executeInsertApplicationUser || !$executeInsertAdminDetails || !$executeInsertOutletDetails){
                           
                                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                            }else{
                                
                                //We will send an email to the outlet admin for account activation
                                
                                Zf_SessionHandler::zf_setSessionVariable("outlet_setup", "outlet_setup_success");
                                Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_outlets', 'new_outlet');
                                exit(); 
                                
                            }
                            
                        }
                        
                    }
                    
                }
                
            }
            
            
            
        } else {

            //echo "The form has some errors which MUST be rectified"; exit(); //This is strictly for debugging purpose.
            Zf_SessionHandler::zf_setSessionVariable("outlet_setup", "outlet_setup_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_outlets', 'new_outlet');
        }
    }
    
    
    
    /**
     * =========================================================================
     * THIS METHOD HOLDS ALL THE INFORMATION RELATED TO AREAS OF ACTIVE PROJECTS.
     * =========================================================================
     */
    public function OutletMaps($outletType = NULL){
        
        //An instance of the ZF_MAPBUILDER CLASS.
        $zf_map = new Zf_MapBuilder();
        
        // Set map's center position by latitude and longitude coordinates. 
        $zf_map->setCenter(-1.2833333,36.8166667);

        // Set the default map type.
        $zf_map->setMapTypeId(Zf_MapBuilder::MAP_TYPE_ID_ROADMAP);

        // Set width and height of the map.
        $zf_map->setSize(995, 430);

        // Set default zoom level.
        $zf_map->setZoom(11);

        // Make zoom control compact.
        $zf_map->setZoomControlStyle(Zf_MapBuilder::ZOOM_CONTROL_STYLE_DEFAULT);
        
        if($outletType == "active"){
            
            $outletTypeValue['outletStatus'] = Zf_QueryGenerator::SQLValue(1);
            
        }else if($outletType == "suspended"){
            
            $outletTypeValue['outletStatus'] = Zf_QueryGenerator::SQLValue(0);
            
        }
        

        // Define locations and add markers with custom icons and attached info windows.
        $column = array('outletArea','outletLocation','latitude','longitude');
            
        $getOutletMaps = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_details',$outletTypeValue, $column);
        //echo $getOutletMaps; exit(); //This is strictly for debugging purpose.
        
        //Fetch all the results related to the query above.
        $result = mysql_query("$getOutletMaps") or die(mysql_error());
        while ($row = mysql_fetch_assoc($result)) {

            $zf_map->addMarker($row['latitude'], $row['longitude'], array(
                'title' => $row['outletArea']."(".$row['outletLocation'].")",
                'html' => '<div style="width: 120px; height: 160px;">Outlet Name: '. $row['outletLocation'] .'</div><b></b>', 
                'infoCloseOthers' => true
            ));
        }

        // Display the map.
        $zf_map->show();
        
    }
    
   
}

?>
