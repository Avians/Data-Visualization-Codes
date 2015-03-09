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

class ProcessAgencyInformation_Model extends Zf_Model {
    
    
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
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR THE ADDITION OF A NEW
     * AGENCY TYPE.
     * -------------------------------------------------------------------------
     */
    public function processAddNewAgencyType($identificationCode) {
        
        //Here we decode the identification code into an identification Array.
        $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        //print_r($identifictionArray); exit();

        //Here we collect all the class data  
        $this->zf_formController->zf_postFormData('agencyTypeName')
                ->zf_validateFormData('zf_maximumLength', 30, 'Vendor type name')
                ->zf_validateFormData('zf_minimumLength', 2, 'Vendor type name')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Vendor type name')
                ->zf_postFormData('agencyTypeAlias')
                ->zf_validateFormData('zf_maximumLength', 30, 'Vendor type alias')
                ->zf_validateFormData('zf_minimumLength', 2, 'Vendor type alias')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Vendor type alias');


        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        //print_r($this->_validResult); print_r($this->_errorResult); exit();//This is strictly for debugging purpose

        if (empty($this->_errorResult)) {
            
            foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

              if($zvss_fieldName == 'agencyTypeName'){

                  $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue); 

              }

            }
            
            //Here we generate a random and unique system code for the agency type through which its tracked within the system
            $agencyTypeSystemCode = $this->zvss_generateAgencyTypeSystemCode();
             
            $agencyTypeCode = $agencyTypeSystemCode . ZVSS_CONNECT . Zf_Core_Functions::Zf_CleanName($this->_validResult['agencyTypeName']);
            
            
            //This is the status column against which we compare.
            $zvss_columns = array('agencyTypeName');


            //Generate the SQL Query
            $zvss_selectAgencyTypeDetails = Zf_QueryGenerator::BuildSQLSelect('zvss_agency_type_details', $zvss_value, $zvss_columns);
            
            
            //Execute the SQL Query
            $zvss_executeSelectAgencyTypeDetails = $this->Zf_AdoDB->Execute($zvss_selectAgencyTypeDetails);

            //Get the execution results
            if(!$zvss_executeSelectAgencyTypeDetails){

                 echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

             }else{

                 //The the result count
                 if($zvss_executeSelectAgencyTypeDetails->RecordCount() > 0){

                    //There is an agency type with a similar name so throw an exception and re-direct to new class page
                    Zf_SessionHandler::zf_setSessionVariable("agency_setup", "agency_type_existence_error");

                    $zf_errorData = array("zf_fieldName" => "agencyTypeName", "zf_errorMessage" => "* This agency type already exists!!.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "vendor_setup");
                    exit();
                     
                 }else{
                     
                     //There is a no class with a similar name so insert into the database
                    foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

                       $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue);

                    }

                    //Other database values
                    $zvss_value["agencyTypeSystemCode"] = Zf_QueryGenerator::SQLValue($agencyTypeSystemCode);
                    $zvss_value["agencyTypeCode"] = Zf_QueryGenerator::SQLValue($agencyTypeCode);
                    $zvss_value["dateOfCreation"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                    $zvss_value["agencyTypeStatus"] = Zf_QueryGenerator::SQLValue(1);

                    //echo Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate())); exit();
                    //Build the insert SQL query for a new agency type
                    $insertAgencyType = Zf_QueryGenerator::BuildSQLInsert('zvss_agency_type_details', $zvss_value);

                    //Execute the insert agency type query.
                    $executeInsertAgencyType  = $this->Zf_AdoDB->Execute($insertAgencyType);
                     
                    
                            
                    if(!$executeInsertAgencyType){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{
                        
                        //Redirect to the manage outlets "agency type" section.
                        Zf_SessionHandler::zf_setSessionVariable("agency_setup", "agency_setup_success");
                        Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "vendor_setup");
                        exit();

                    }
                     
                 }

             }

            } else {

            //print_r($this->_errorResult); exit();//This is strictly for debugging purpose
            Zf_SessionHandler::zf_setSessionVariable("agency_setup", "agency_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "vendor_setup");
            exit();

        }
        
    }
    

    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR THE ADDITION OF A NEW
     * ENTITY INTO THE AGENCY TYPE.
     * -------------------------------------------------------------------------
     */
    public function processAddNewAgencyEntity($identificationCode) {
        
        //Decode the identification code
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        $schoolSystemCode = $identificationArray[2];
        
        //Recieve the stream data.
        $this->zf_formController->zf_postFormData('agencyTypeCode')
                ->zf_validateFormData('zf_maximumLength', 200, 'Vendor type')
                ->zf_validateFormData('zf_minimumLength', 5, 'Vendor type')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Vendor type')
                
                ->zf_postFormData('agencyEntityName')
                ->zf_validateFormData('zf_maximumLength', 30, 'Vendor name')
                ->zf_validateFormData('zf_minimumLength', 2, 'Vendor name')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Vendor name')
                
                ->zf_postFormData('agencyEntityAlias')
                ->zf_validateFormData('zf_maximumLength', 30, 'Vendor alias')
                ->zf_validateFormData('zf_minimumLength', 2, 'Vendor alias')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Vendor alias');


        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        //print_r($this->_validResult); print_r($this->_errorResult); exit();//This is strictly for debugging purpose

        if (empty($this->_errorResult)) {
            
            
            $agencyEntityCode = $this->_validResult['agencyTypeCode'] . ZVSS_CONNECT . Zf_Core_Functions::Zf_CleanName($this->_validResult['agencyEntityName']);
            $zvss_value["agencyEntityCode"] = Zf_QueryGenerator::SQLValue($agencyEntityCode);
            
            //This is the status column against which we compare.
            $zvss_columns = array('agencyEntityCode');


            //Generate the SQL Query
            $zvss_selectAgencyEntityDetails = Zf_QueryGenerator::BuildSQLSelect('zvss_agency_entities_details', $zvss_value, $zvss_columns);

            //Execute the SQL Query
            $zvss_executeSelectAgencyEntityDetails = $this->Zf_AdoDB->Execute($zvss_selectAgencyEntityDetails);

            //Get the execution results
            if(!$zvss_executeSelectAgencyEntityDetails){

                 echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

             }else{

                 //The the result count
                 if($zvss_executeSelectAgencyEntityDetails->RecordCount() > 0){

                    //There is an agency type with a similar name so throw an exception and re-direct to new class page
                    Zf_SessionHandler::zf_setSessionVariable("agency_setup", "agency_entity_existence_error");

                    $zf_errorData = array("zf_fieldName" => "agencyEntityName", "zf_errorMessage" => "* This agency entity already exists!!.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "vendor_setup");
                    exit();
                     
                 }else{
                     
                     //There is a no agency entity with a similar name so insert into the database
                     foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

                        $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue);

                     }
                     
                     //Other database values
                     //$zvss_value["agencyECode"] = Zf_QueryGenerator::SQLValue($agencyTypeSystemCode);
                     $zvss_value["dateOfCreation"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                     $zvss_value["agencyEntityStatus"] = Zf_QueryGenerator::SQLValue(1);
                     
                     //Build the insert SQL query for a new agency type
                     $insertAgencyEntity = Zf_QueryGenerator::BuildSQLInsert('zvss_agency_entities_details', $zvss_value);
                     
                     //echo $insertAgencyEntity; exit();
                     //Execute the insert agency type query.
                     $executeInsertAgencyEntity = $this->Zf_AdoDB->Execute($insertAgencyEntity);
                     
                     
                    if(!$executeInsertAgencyEntity){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{
                        
                        //Redirect to the manage outlets "agency type" section.
                        Zf_SessionHandler::zf_setSessionVariable("agency_setup", "agency_entity_setup_success");
                        Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "vendor_setup");
                        exit();

                    }
                     
                 }

             }

            } else {

            //print_r($this->_errorResult); exit();//This is strictly for debugging purpose
            Zf_SessionHandler::zf_setSessionVariable("agency_setup", "agency_entity_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "vendor_setup");
            exit();

        }
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR THE ADDITION OF A NEW
     * OUTLET TYPE.
     * -------------------------------------------------------------------------
     */
    public function processAddNewOutletType($identificationCode) {
        
        //Here we decode the identification code into an identification Array.
        $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        //print_r($identifictionArray); exit();

        //Here we collect all the class data  
        $this->zf_formController->zf_postFormData('outletTypeName')
                ->zf_validateFormData('zf_maximumLength', 30, 'Outlet type name')
                ->zf_validateFormData('zf_minimumLength', 2, 'Outlet type name')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Outlet type name')
                ->zf_postFormData('outletTypeAlias')
                ->zf_validateFormData('zf_maximumLength', 30, 'Outlet type alias')
                ->zf_validateFormData('zf_minimumLength', 2, 'Outlet type alias')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Outlet type alias');


        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        //print_r($this->_validResult); print_r($this->_errorResult); exit();//This is strictly for debugging purpose
       
        if (empty($this->_errorResult)) {
            
            foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

              if($zvss_fieldName == 'outletTypeName'){

                  $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue); 

              }

            }
            
            
            //This is the status column against which we compare.
            $zvss_columns = array('outletTypeName');


            //Generate the SQL Query
            $zvss_selectOutletTypeDetails = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_type_details', $zvss_value, $zvss_columns);
            
            
            //Execute the SQL Query
            $zvss_executeSelectOutletTypeDetails = $this->Zf_AdoDB->Execute($zvss_selectOutletTypeDetails);

            //Get the execution results
            if(!$zvss_executeSelectOutletTypeDetails){

                 echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

             }else{

                 //The the result count
                 if($zvss_executeSelectOutletTypeDetails->RecordCount() > 0){

                    //There is an outlet type with a similar name so throw an exception and re-direct to new outlet page
                    Zf_SessionHandler::zf_setSessionVariable("outlet_setup", "outlet_type_existence_error");

                    $zf_errorData = array("zf_fieldName" => "outletTypeName", "zf_errorMessage" => "* This outlet type already exists!!.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "outlet_setup");
                    exit();
                     
                 }else{
                     
                     //There is a no outlet with a similar name so insert into the database
                     foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

                        $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue);

                     }
                     
                     //Other database values
                     $zvss_value["dateOfCreation"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                     $zvss_value["outletTypeStatus"] = Zf_QueryGenerator::SQLValue(1);
                     
                     //Build the insert SQL query for a new outlet type
                     $insertOutletType = Zf_QueryGenerator::BuildSQLInsert('zvss_outlet_type_details', $zvss_value);
                     
                     //Execute the insert outlet type query.
                     $executeInsertOutletType  = $this->Zf_AdoDB->Execute($insertOutletType);
                     
                    
                            
                    if(!$executeInsertOutletType){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{
                        
                        //Redirect to the manage outlets "outlet type" section.
                        Zf_SessionHandler::zf_setSessionVariable("outlet_setup", "outlet_setup_success");
                        Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "outlet_setup");
                        exit();

                    }
                     
                 }

             }

            } else {

            //print_r($this->_errorResult); exit();//This is strictly for debugging purpose
            Zf_SessionHandler::zf_setSessionVariable("outlet_setup", "outlet_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "outlet_setup");
            exit();

        }
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR THE ADDITION OF A NEW
     * AGENT TYPE.
     * -------------------------------------------------------------------------
     */
    public function processAddNewAgentType($identificationCode) {
        
        //Here we decode the identification code into an identification Array.
        $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        //print_r($identifictionArray); exit();

        //Here we collect all the class data  
        $this->zf_formController->zf_postFormData('agentTypeName')
                ->zf_validateFormData('zf_maximumLength', 30, 'Agent type name')
                ->zf_validateFormData('zf_minimumLength', 2, 'Agent type name')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Agent type name')
                ->zf_postFormData('agentTypeAlias')
                ->zf_validateFormData('zf_maximumLength', 30, 'Agent type alias')
                ->zf_validateFormData('zf_minimumLength', 2, 'Agent type alias')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Agent type alias');


        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        //print_r($this->_validResult); print_r($this->_errorResult); exit();//This is strictly for debugging purpose
       
        if (empty($this->_errorResult)) {
            
            foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

              if($zvss_fieldName == 'agentTypeName'){

                  $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue); 

              }

            }
            
            
            //This is the status column against which we compare.
            $zvss_columns = array('agentTypeName');


            //Generate the SQL Query
            $zvss_selectOutletTypeDetails = Zf_QueryGenerator::BuildSQLSelect('zvss_agent_type_details', $zvss_value, $zvss_columns);
            
            
            //Execute the SQL Query
            $zvss_executeSelectOutletTypeDetails = $this->Zf_AdoDB->Execute($zvss_selectOutletTypeDetails);

            //Get the execution results
            if(!$zvss_executeSelectOutletTypeDetails){

                 echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

             }else{

                 //The the result count
                 if($zvss_executeSelectOutletTypeDetails->RecordCount() > 0){

                    //There is an outlet type with a similar name so throw an exception and re-direct to new outlet page
                    Zf_SessionHandler::zf_setSessionVariable("outlet_setup", "agent_type_existence_error");

                    $zf_errorData = array("zf_fieldName" => "agentTypeName", "zf_errorMessage" => "* This agent type already exists!!.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "agent_setup");
                    exit();
                     
                 }else{
                     
                     //There is a no outlet with a similar name so insert into the database
                     foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

                        $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue);

                     }
                     
                     //Other database values
                     $zvss_value["dateOfCreation"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));
                     $zvss_value["agentTypeStatus"] = Zf_QueryGenerator::SQLValue(1);
                     
                     //Build the insert SQL query for a new outlet type
                     $insertOutletType = Zf_QueryGenerator::BuildSQLInsert('zvss_agent_type_details', $zvss_value);
                     
                     //Execute the insert outlet type query.
                     $executeInsertOutletType  = $this->Zf_AdoDB->Execute($insertOutletType);
                     
                    
                            
                    if(!$executeInsertOutletType){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{
                        
                        //Redirect to the manage outlets "outlet type" section.
                        Zf_SessionHandler::zf_setSessionVariable("outlet_setup", "agent_setup_success");
                        Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "agent_setup");
                        exit();

                    }
                     
                 }

             }

            } else {

            //print_r($this->_errorResult); exit();//This is strictly for debugging purpose
            Zf_SessionHandler::zf_setSessionVariable("outlet_setup", "agent_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "agent_setup");
            exit();

        }
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR THE EDITING OF A GIVEN
     * OUTLET TYPE.
     * -------------------------------------------------------------------------
     */
    public function processEditOutletType($identificationCode) {
        
        //Here we decode the identification code into an identification Array.
        $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        //print_r($identifictionArray); exit();

        //Here we collect all the class data  
        $this->zf_formController->zf_postFormData('outletTypeName')
                ->zf_validateFormData('zf_maximumLength', 30, 'Outlet type name')
                ->zf_validateFormData('zf_minimumLength', 2, 'Outlet type name')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Outlet type name')
                ->zf_postFormData('outletTypeAlias')
                ->zf_validateFormData('zf_maximumLength', 30, 'Outlet type alias')
                ->zf_validateFormData('zf_minimumLength', 2, 'Outlet type alias')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Outlet type alias')
                
                ->zf_postFormData('outletTypeStatus')
                ->zf_postFormData('hiddenOutletTypeName');


        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        //print_r($this->_validResult); print_r($this->_errorResult); exit();//This is strictly for debugging purpose
       
        if (empty($this->_errorResult)) {
            
            
            foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

              if($zvss_fieldName == 'outletTypeName'){

                  $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue); 

              }

            }
            
            //This is the status column against which we compare.
            $zvss_columns = array('outletTypeName');

            
            //We need to check that we updating the outlet name to a unique.
            if($this->_validResult['hiddenOutletTypeName'] != $this->_validResult['outletTypeName']){
                
                //Generate the SQL Query
                $zvss_selectOutletTypeDetails = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_type_details', $zvss_value, $zvss_columns);


                //Execute the SQL Query
                $zvss_executeSelectOutletTypeDetails = $this->Zf_AdoDB->Execute($zvss_selectOutletTypeDetails);
                
                
                //Get the execution results
                if(!$zvss_executeSelectOutletTypeDetails){

                     echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    //The the result count
                    if($zvss_executeSelectOutletTypeDetails->RecordCount() > 0){

                       //There is an outlet type with a similar name so throw an exception and re-direct to new outlet page
                       Zf_SessionHandler::zf_setSessionVariable("outlet_setup", "outlet_type_existence_error");

                       $zf_errorData = array("zf_fieldName" => "outletTypeName", "zf_errorMessage" => "* This outlet type already exists!!.");
                       Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                       Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "outlet_setup");
                       exit();

                    }else{

                        //We update the outlet information.
                        $this->updateOutletInformation($this->_validResult);

                    }
                }
                
            }else{
                
                //We update the outlet information.
                $this->updateOutletInformation($this->_validResult);
                
            }
            

        } else {

            //print_r($this->_errorResult); exit();//This is strictly for debugging purpose
            Zf_SessionHandler::zf_setSessionVariable("outlet_setup", "outlet_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "outlet_setup");
            exit();

        }
        
    }
    
    
   //This is the private function that actually updates the outlet information
    private function updateOutletInformation($validResult){
        
        foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {
            
            if($zvss_fieldName != 'hiddenOutletTypeName'){
                
                if($zvss_fieldName == 'outletTypeStatus'){

                    if($zvss_fieldValue == "Active"){

                        $zvss_value['outletTypeStatus'] = Zf_QueryGenerator::SQLValue(1); 

                    }else if($zvss_fieldValue == "Inactive"){

                        $zvss_value['outletTypeStatus'] = Zf_QueryGenerator::SQLValue(0); 

                    }

                }else{

                    $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue);

                }
            }
              
        }
            
        //This is the status column against which we compare.
        $zvss_columnsUpdate['outletTypeName'] = Zf_QueryGenerator::SQLValue($validResult['hiddenOutletTypeName']);
        

        //Generate the SQL Query
        $zvss_updateOutletType = Zf_QueryGenerator::BuildSQLUpdate('zvss_outlet_type_details', $zvss_value, $zvss_columnsUpdate);

        //echo $zvss_updateOutletType; exit();
        //Execute the queries
        $zvss_executeUpdateOutletType = $this->Zf_AdoDB->Execute($zvss_updateOutletType);
        
        if(!$zvss_executeUpdateOutletType){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            //Updated successfully
            Zf_SessionHandler::zf_setSessionVariable("outlet_setup", "outlet_update_success");
            Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "outlet_setup");
            exit();
           
        }
        
        
    }
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR THE EDITING OF A GIVEN
     * AGENT TYPE.
     * -------------------------------------------------------------------------
     */
    public function processEditAgencyType($identificationCode) {
        
        //Here we decode the identification code into an identification Array.
        $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        //print_r($identifictionArray); exit();

        //Here we collect all the class data  
        $this->zf_formController->zf_postFormData('agentTypeName')
                ->zf_validateFormData('zf_maximumLength', 30, 'Agent type name')
                ->zf_validateFormData('zf_minimumLength', 2, 'Agent type name')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Agent type name')
                
                ->zf_postFormData('agentTypeAlias')
                ->zf_validateFormData('zf_maximumLength', 30, 'Agent type alias')
                ->zf_validateFormData('zf_minimumLength', 2, 'Agent type alias')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Agent type alias')
                
                ->zf_postFormData('agentTypeStatus')
                ->zf_postFormData('hiddenAgentTypeName');


        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();
        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        //echo '<pre>';print_r($this->_validResult); print_r($this->_errorResult);echo '</pre>'; exit();//This is strictly for debugging purpose
       
        if (empty($this->_errorResult)) {
            
            foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

              if($zvss_fieldName == 'agentTypeName'){

                  $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue); 

              }

            }
            
            //This is the status column against which we compare.
            $zvss_columns = array('agentTypeName');

            //We need to check that we updating the outlet name to a unique.
            if($this->_validResult['hiddenAgentTypeName'] != $this->_validResult['agentTypeName']){
                
                
                //Generate the SQL Query
                $zvss_selectAgentTypeDetails = Zf_QueryGenerator::BuildSQLSelect('zvss_agent_type_details', $zvss_value, $zvss_columns);


                //Execute the SQL Query
                $zvss_executeSelectAgentTypeDetails = $this->Zf_AdoDB->Execute($zvss_selectAgentTypeDetails);
                
                
                //Get the execution results
                if(!$zvss_executeSelectAgentTypeDetails){

                     echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    //The the result count
                    if($zvss_executeSelectAgentTypeDetails->RecordCount() > 0){

                       //There is an outlet type with a similar name so throw an exception and re-direct to new outlet page
                       Zf_SessionHandler::zf_setSessionVariable("agent_setup", "agent_type_existence_error");

                       $zf_errorData = array("zf_fieldName" => "agentTypeName", "zf_errorMessage" => "* This agent type already exists!!.");
                       Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                       Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "agent_setup");
                       exit();

                    }else{

                        //We update the outlet information.
                        $this->updateAgencyTypeInformation($this->_validResult);

                    }
                }
                
            }else{
                
                //We update the outlet information.
                $this->updateAgencyTypeInformation($this->_validResult);
                
            }
            

        } else {

        //print_r($this->_errorResult); exit();//This is strictly for debugging purpose
        Zf_SessionHandler::zf_setSessionVariable("agent_setup", "agent_setup_error");
        Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
        Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "agent_setup");
        exit();

        }
        
    }
    
    
    //This is the private function that actually updates the agent type information
    private function updateAgencyTypeInformation($validResult){
        
        //print_r($validResult); exit();
        
        foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {
            
            if($zvss_fieldName != 'hiddenAgentTypeName'){
                
                if($zvss_fieldName == 'agentTypeStatus'){

                    if($zvss_fieldValue == "Active"){

                        $zvss_value['agentTypeStatus'] = Zf_QueryGenerator::SQLValue(1); 

                    }else if($zvss_fieldValue == "Inactive"){

                        $zvss_value['agentTypeStatus'] = Zf_QueryGenerator::SQLValue(0); 

                    }

                }else{

                    $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue);

                }
            }
              
        }
            
        //This is the status column against which we compare.
        $zvss_columnsUpdate['agentTypeName'] = Zf_QueryGenerator::SQLValue($validResult['hiddenAgentTypeName']);
        

        //Generate the SQL Query
        $zvss_updateAgentType = Zf_QueryGenerator::BuildSQLUpdate('zvss_agent_type_details', $zvss_value, $zvss_columnsUpdate);

        //echo $zvss_updateAgentType; exit();
        //Execute the queries
        $zvss_executeUpdateAgentType = $this->Zf_AdoDB->Execute($zvss_updateAgentType);
        
        if(!$zvss_executeUpdateAgentType){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            //Updated successfully
            Zf_SessionHandler::zf_setSessionVariable("agent_setup", "agent_update_success");
            Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "agent_setup");
            exit();
           
        }
        
        
    }
    
    
    /**
     * =========================================================================
     * THE PUBLIC AND PRIVATE METHODS BELOW ARE RESPONSIBLE FOR BUILDING THE 
     * LOGIC THAT FETCHES AND RENDERS ALL THE AGENCY TYPES AND ENTITIES 
     * INFORMATION. 
     * =========================================================================
     */
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR CONFIRMING IF A CLASS
     * IS ALREADY EXISTING
     * -------------------------------------------------------------------------
     */
    public function confirmAgencyTypePresence(){
        
        $confirmAgencyTypes = $this->fetchAgencyTypesInformation();
        
        if($confirmAgencyTypes == 0){
                                                        
            echo '<h3 class="form-section form-title">Add Vendor Type Entity Warning!!</h3> 
                    <div class="school-class-inner-content">
                        <span class="content-view-errors" >
                            There are no vendor types registered yet! You need to add atleast one vendor to be able to add a vendor entity to it.
                        </span>
                   </div>';

        }else{

            //LOAD STREAM SETUP FORM
            Zf_ApplicationWidgets::zf_load_widget("platform_admin", "add_agency_entity_form.php", $schoolSystemCode);

        }
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR GETTING THE GENERAL 
     * INFORMATION ABOUT AGENCY(Partners) TYPES
     * -------------------------------------------------------------------------
     */
    public function getAgencyTypes(){
        
       $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
       
       //Return the values of agency types
       $agencyTypesResults = $this->fetchAgencyTypesInformation();
 
        
       //print_r($agencyTypesResults);
        
        $agency_types = "";
        
        if($agencyTypesResults == 0){
            
             $agency_types .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Vendor Types Overview Warning!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There are no vendor types yet! You need to add atleast one vendor type to have an overview.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
             $agency_types .= '<div class="row">';
            
            foreach ($agencyTypesResults as  $value) {
                
                $agencyTypeName = $value['agencyTypeName']; $agencyTypeCode =  $value['agencyTypeCode'];
                
                $agencyTypeEntities = $this->fetchAgencyEntitesInformation($agencyTypeCode);
                
                
                 $agency_types .= '<div class="col-lg-6 col-md-9 col-sm-8 col-xs-12 margin-bottom-15">
                                        <div class="school-content-wrapper">
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <h3>'.$agencyTypeName.'</h3>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="school-class-inner-content scroller"  data-always-visible="1" data-rail-visible="0">
                                                <div class="table-responsive" style="margin-right: 5px !important;">
                                                    ';
                                                        
                                                    if($agencyTypeEntities == 0){
                                                       
                                                         $agency_types .= '<span class="content-view-errors" >No vendors have been created in <strong>'.$agencyTypeName.'</strong> yet.</span>';
                                                        
                                                    }else{
                                                        
                                                         $agency_types .= '<table class="table table-striped table-bordered table-hover">
                                                                                <thead>
                                                                                        <tr>
                                                                                                <th>Vendor Name</th><th>Date of Creation</th><th>Vendor Status</th>
                                                                                        </tr>
                                                                                </thead>
                                                                                <tbody>';
                                                        
                                                                                foreach ($agencyTypeEntities as $value) {

                                                                                    $agencyEntityName = $value['agencyEntityName']; $dateOfCreation =  $value['dateOfCreation']; 
                                                                                    if($value['agencyEntityStatus'] == 1){$agencyEntityStatus = "Active";}else if($value['agencyEntityStatus'] == 0){$agencyEntityStatus = "Inactive";}

                                                                                     $agency_types .= '<tr><td>'.$agencyEntityName.'</td><td>'.$dateOfCreation.'</td><td class="content-table-flags">'.$agencyEntityStatus.'</td></tr>';

                                                                                }
                                                        
                                                            $agency_types .= '</tbody>
                                                                            </table>';
                                                        
                                                    }
               
                $agency_types .= '</div>
                                        
                                      </div>
                                      <div class="clearfix  margin-bottom-5"></div>
                                     </div>
                                  </div>';
                
            }
            
             $agency_types .= '</div>';
            
        }
        
        echo  $agency_types;
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR CONFIRMING IF A CLASS
     * IS ALREADY EXISTING
     * -------------------------------------------------------------------------
     */
    public function confirmAgentTypePresence(){
        
        $confirmAgencyTypes = $this->fetchAgencyTypesInformation();
        
        if($confirmAgencyTypes == 0){
                                                        
            echo '<h3 class="form-section form-title">Edit Agent Type Warning!!</h3> 
                    <div class="school-class-inner-content">
                        <span class="content-view-errors" >
                            There are no agent types registered yet! You need to add atleast one agent type to be able to edit.
                        </span>
                   </div>';

        }else{

            //LOAD AGENT TYPE SETUP FORM
            Zf_ApplicationWidgets::zf_load_widget("platform_admin", "prefilled_agent_setup_form.php");

        }
        
    }
    
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR CONFIRMING IF A CLASS
     * IS ALREADY EXISTING
     * -------------------------------------------------------------------------
     */
    public function confirmOutletTypePresence(){
        
        $confirmAgencyTypes = $this->fetchOutletTypesInformation();
        
        if($confirmAgencyTypes == 0){
                                                        
            echo '<h3 class="form-section form-title">Edit Agent Type Warning!!</h3> 
                    <div class="school-class-inner-content">
                        <span class="content-view-errors" >
                            There are no outlet types registered yet! You need to add atleast one outlet type to be able to edit.
                        </span>
                   </div>';

        }else{

            //LOAD OUTLET TYPE SETUP FORM
            Zf_ApplicationWidgets::zf_load_widget("platform_admin", "prefilled_outlet_setup_form.php");

        }
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR GETTING THE GENERAL 
     * AGENT TYPE INFORMATION
     * -------------------------------------------------------------------------
     */
    public function getAgentTypes(){
        
                
        $agentTypes = $this->fetchAgentTypesInformation();
        
        
        $agent_types = "";
        
        if($agentTypes == 0){
            
            $agent_types .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Agent Overview Warning!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There are no agents yet! You need to add atleast an agent to have an overview.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
            $agent_types .= '<div class="row">';
            
            $agent_types .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-15">
                                        <div class="school-content-wrapper">
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <h3>Agent Types Information</h3>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 action_buttons"></div>
                                            </div>
                                            <hr>
                                            <div class="school-class-inner-content scroller"  data-always-visible="1" data-rail-visible="0">
                                                <div class="table-responsive" style="margin-right: 5px !important;">
                                                        ';
                                                        
                                                        $agent_types .= '<table class="table table-striped table-bordered table-hover">
                                                                                <thead>
                                                                                        <tr>
                                                                                            <th>Agent Type Name</th><th>Agent Type Date of Creation</th><th>Agent Type Status</th>
                                                                                        </tr>
                                                                                </thead>
                                                                                <tbody>';
            
                                                        foreach ($agentTypes as  $value) {

                                                            $agentTypeName = $value['agentTypeName']; $dateOfCreation =  $value['dateOfCreation']; 
                                                            if($value['agentTypeStatus'] == 1){$agentTypeStatus = "Active";}else if($value['agentTypeStatus'] == 0){$agentTypeStatus = "Inactive";}

                                                            $agent_types .= '<tr><td>'.$agentTypeName.'</td><td>'.$dateOfCreation.'</td><td>'.$agentTypeStatus.'</td><tr>';                                        

                                                        }
            
                           $agent_types .= '</tbody>
                                           </table>
                                       </div>  
                                    </div>
                                  <div class="clearfix  margin-bottom-5"></div>
                                </div>
                              </div>     
                           </div>';

                    }

                    echo $agent_types;
        
    }
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR GETTING THE GENERAL 
     * OUTLET TYPE INFORMATION
     * -------------------------------------------------------------------------
     */
    public function getOutletTypes(){
        
                
        $outletTypes = $this->fetchOutletTypesInformation();
        
        
        $outlet_types = "";
        
        if($outletTypes == 0){
            
            $outlet_types .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Outlet Overview Warning!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There are no outlets yet! You need to add atleast one outlet to have an overview.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
            $outlet_types .= '<div class="row">';
            
            $outlet_types .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-15">
                                        <div class="school-content-wrapper">
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <h3>Outlet Types Information</h3>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 action_buttons"></div>
                                            </div>
                                            <hr>
                                            <div class="school-class-inner-content scroller"  data-always-visible="1" data-rail-visible="0">
                                                <div class="table-responsive" style="margin-right: 5px !important;">
                                                        ';
                                                        
                                                        $outlet_types .= '<table class="table table-striped table-bordered table-hover">
                                                                                <thead>
                                                                                        <tr>
                                                                                            <th>Outlet Type Name</th><th>Outlet Type Date of Creation</th><th>Outlet Type Status</th>
                                                                                        </tr>
                                                                                </thead>
                                                                                <tbody>';
            
                                                        foreach ($outletTypes as  $value) {

                                                            $outletTypeName = $value['outletTypeName']; $dateOfCreation =  $value['dateOfCreation']; 
                                                            if($value['outletTypeStatus'] == 1){$outletTypeStatus = "Active";}else if($value['outletTypeStatus'] == 0){$outletTypeStatus = "Inactive";}

                                                            $outlet_types .= '<tr><td>'.$outletTypeName.'</td><td>'.$dateOfCreation.'</td><td>'.$outletTypeStatus.'</td><tr>';                                        

                                                        }
            
                           $outlet_types .= '</tbody>
                                           </table>
                                       </div>  
                                    </div>
                                  <div class="clearfix  margin-bottom-5"></div>
                                </div>
                              </div>     
                           </div>';

                    }

                    echo $outlet_types;
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * AGENCY(Partners) TYPES INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchAgencyTypesInformation(){
        
        $fetchAgencyTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_agency_type_details', $zvss_sqlValue);
        
        $zf_executeFetchAgencyTypes= $this->Zf_AdoDB->Execute($fetchAgencyTypes);

        if(!$zf_executeFetchAgencyTypes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchAgencyTypes->RecordCount() > 0){

                while(!$zf_executeFetchAgencyTypes->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolClasses->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchAgencyTypes->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * AGENT TYPES INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchAgentTypesInformation(){
        
        $fetchAgencyTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_agent_type_details', $zvss_sqlValue);
        
        $zf_executeFetchAgencyTypes= $this->Zf_AdoDB->Execute($fetchAgencyTypes);

        if(!$zf_executeFetchAgencyTypes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchAgencyTypes->RecordCount() > 0){

                while(!$zf_executeFetchAgencyTypes->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolClasses->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchAgencyTypes->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * OUTLETS TYPES INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchOutletTypesInformation(){
        
        $fetchAgencyTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_type_details', $zvss_sqlValue);
        
        $zf_executeFetchAgencyTypes= $this->Zf_AdoDB->Execute($fetchAgencyTypes);

        if(!$zf_executeFetchAgencyTypes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchAgencyTypes->RecordCount() > 0){

                while(!$zf_executeFetchAgencyTypes->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolClasses->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchAgencyTypes->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
   
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * AGENCY ENTITY INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchAgencyEntitesInformation($agencyTypeCode){
        
        $zvss_sqlValue["agencyTypeCode"] = Zf_QueryGenerator::SQLValue($agencyTypeCode);
        
        $fetchAgencyEntities = Zf_QueryGenerator::BuildSQLSelect('zvss_agency_entities_details', $zvss_sqlValue);
        $zf_executeFetchAgencyEntities = $this->Zf_AdoDB->Execute($fetchAgencyEntities);
        
        

        if(!$zf_executeFetchAgencyEntities){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchAgencyEntities->RecordCount() > 0){

                while(!$zf_executeFetchAgencyEntities->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolClasses->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchAgencyEntities->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
            
        }
        
    }
   
    
    /**
     * --------------------------------------------------------------------------------------
     * |                                                                                    |
     * |  The is the main method for the generation of a agency type system generated code  |
     * |                                                                                    |
     * --------------------------------------------------------------------------------------
    */
    public function zvss_generateAgencyTypeSystemCode(){
        
            //Generate a random string.
            $agencyTypeSystemCode = Zf_Core_Functions::Zf_GenerateRandomString(30);

            //Prepare the field values for SQL querying
            $zf_value["agencyTypeSystemCode"] = Zf_QueryGenerator::SQLValue($agencyTypeSystemCode);

            //Generate the SQL Query
            $zf_selectAgencyTypeSystemCode = Zf_QueryGenerator::BuildSQLSelect('zvss_agency_type_details', $zf_value);

            //Execute the SQL Query
            $zf_executeSelectAgencyTypeSystemCode = $this->Zf_AdoDB->Execute($zf_selectAgencyTypeSystemCode);

            //Get the execution results
            if (!$zf_executeSelectAgencyTypeSystemCode) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                
            } else {

                //The the result count
                if ($zf_executeSelectAgencyTypeSystemCode->RecordCount() > 0) {
                    
                    //Re-generate the system code.
                    $this->zvss_generateAgencyTypeSystemCode();

                }else{

                    return $agencyTypeSystemCode;

                }
            }
        
    } 
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR CLEANING IMAGE NAMES
     * -------------------------------------------------------------------------
     * @param string imageName The image name
     * @return string cleaned image name
     */
    private function CleanName($imageName){
        
        $imageName = str_replace(" ", "", ucwords($imageName));
        
        $search = array("{","[","@","^","!","|","$","`","~",";","*","]","}");
        $cleanImageName = str_replace($search, "", $imageName);
        
        return $cleanImageName;
        
    }

    
}

?>
