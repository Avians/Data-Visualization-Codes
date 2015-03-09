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

class MakeNewCommission_Model extends Zf_Model {
    
   
    private $_errorResult = array();
    private $_validResult = array();
    
    //This protected property holds the value of the user identification array
    protected $idenficationArray;

    /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
        parent::__construct();
         
        $this->identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode(Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode"));
        
         
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for making a new transaction                                     |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function makeNewCommission(){
        
        $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
        $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        
        //He we collect  and validate all the school setup information
        $this->zf_formController->zf_postFormData('agencyTypeCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Transaction Category')
                
                                ->zf_postFormData('agencyEntityCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Transacting entity')
                
                                ->zf_postFormData('transactionType')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Transaction type')
                
                                ->zf_postFormData('commissionType')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Transaction type')
                
                                ->zf_postFormData('lowerLimit')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Lower limit')
                
                                ->zf_postFormData('upperLimit')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Upper limit')
                
                                ->zf_postFormData('commissionValue')
                                //->zf_validateFormData('zf_fieldNotEmpty', 'Commission value')
                
                                ->zf_postFormData('commissionProportion');
                               // ->zf_validateFormData('zf_fieldNotEmpty', 'Commission proportion');
                
                
                                //->zf_postFormData('outletIdNumber');
                
        
        

        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        $this->_validResult = $this->zf_formController->zf_fetchValidData(); 
        
        //echo'<pre>'; print_r($this->_validResult); echo'<pre><br>'; //exit(); //This is strictly for debugging purpose.
        //echo'<pre>'; print_r($this->_errorResult); echo'<pre><br>'; exit(); //This is strictly for debugging purpose.
        
        //If the error result is empty.
        if (empty($this->_errorResult)) {
            
            //echo'<pre>'; print_r($this->_validResult); echo'<pre>'; exit(); //This is strictly for debugging purpose.
            
            $limitsCombination = $this->_validResult['lowerLimit']."-".$this->_validResult['upperLimit'];
            
            //VALIDATE THE DATA TO ENSURE THAT ALL IS OKAY BEFORE INSERTION INTO THE DATABSAE.
            
            //1. check that the LOWER LIMIT value is not greater than the UPPER LIMIT value.
            if($this->_validResult['lowerLimit'] >= $this->_validResult['upperLimit']){
                
                $zf_errorData = array("zf_fieldName" => "lowerLimit", "zf_errorMessage" => "* Lower limit can't be greater than upper limit!!.");
                Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "commission_setup");
                exit();
                
            }
            
            //2. check that the LOWER LIMIT does not exist in the database for the same Vendor.
            $zvss_lowerLimitValue['lowerLimit'] = Zf_QueryGenerator::SQLValue($this->_validResult['lowerLimit']);
            $zvss_lowerLimitValue['agencyEntityCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['agencyEntityCode']);
            $zvss_lowerLimitValue['transactionType'] = Zf_QueryGenerator::SQLValue($this->_validResult['transactionType']);
            $zvss_lowerLimitColumns = array('lowerLimit');
            $zvss_selectLowerLimit = Zf_QueryGenerator::BuildSQLSelect('zvss_transaction_commissions', $zvss_lowerLimitValue, $zvss_lowerLimitColumns);
            $zvss_executeSelectLowerLimit = $this->Zf_AdoDB->Execute($zvss_selectLowerLimit);
            
            if(!$zvss_executeSelectLowerLimit){

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            }else{

                //The the result count
                if($zvss_executeSelectLowerLimit->RecordCount() > 0){

                   Zf_SessionHandler::zf_setSessionVariable("commission_setup", "lower_limit_existence_error");

                   $zf_errorData = array("zf_fieldName" => "lowerLimit", "zf_errorMessage" => "* This lower limit exists for this vendor!!.");
                   Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                   Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "commission_setup");
                   exit();

                }else{

                   //3. check that the UPPER LIMIT deos not exist in the database for the same Vendor. 
                   $zvss_upperLimitValue['upperLimit'] = Zf_QueryGenerator::SQLValue($this->_validResult['upperLimit']);
                   $zvss_upperLimitValue['agencyEntityCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['agencyEntityCode']);
                   $zvss_upperLimitValue['transactionType'] = Zf_QueryGenerator::SQLValue($this->_validResult['transactionType']);
                   $zvss_upperLimitColumn = array('upperLimit');
                   $zvss_selectUpperLimit = Zf_QueryGenerator::BuildSQLSelect('zvss_transaction_commissions', $zvss_upperLimitValue, $zvss_upperLimitColumn);
                   $zvss_executeSelectUpperLimit = $this->Zf_AdoDB->Execute($zvss_selectUpperLimit);

                    if(!$zvss_executeSelectUpperLimit){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{

                        //The the result count
                        if($zvss_executeSelectUpperLimit->RecordCount() > 0){

                           Zf_SessionHandler::zf_setSessionVariable("commission_setup", "upper_limit_existence_error");

                           $zf_errorData = array("zf_fieldName" => "upperLimit", "zf_errorMessage" => "* This upper limit exists for this vendor!!.");
                           Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                           Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "commission_setup");
                           exit();

                        }else{
                            
                            //4. check that the entered lower limit is not an existing upper limit in the database for the same vendor
                            $zvss_upperLimitValueConfirm['upperLimit'] = Zf_QueryGenerator::SQLValue($this->_validResult['lowerLimit']);
                            $zvss_upperLimitValueConfirm['agencyEntityCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['agencyEntityCode']);
                            $zvss_upperLimitValueConfirm['transactionType'] = Zf_QueryGenerator::SQLValue($this->_validResult['transactionType']);
                            $zvss_upperLimitColumnConfirm = array('upperLimit');
                            $zvss_selectUpperLimitConfirm = Zf_QueryGenerator::BuildSQLSelect('zvss_transaction_commissions', $zvss_upperLimitValueConfirm, $zvss_upperLimitColumnConfirm);
                            $zvss_executeSelectUpperLimitConfirm = $this->Zf_AdoDB->Execute($zvss_selectUpperLimitConfirm);

                            if(!$zvss_executeSelectUpperLimitConfirm){

                                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                            }else{

                                //The the result count
                                if($zvss_executeSelectUpperLimitConfirm->RecordCount() > 0){

                                   Zf_SessionHandler::zf_setSessionVariable("commission_setup", "lower_upper_limit_conflict_error");

                                   $zf_errorData = array("zf_fieldName" => "lowerLimit", "zf_errorMessage" => "* Lower limit can't equal upper limit of an existing bracket!!.");
                                   Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                                   Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "commission_setup");
                                   exit();

                                }else{
                                    
                                    //5. check that the combination of the LOWER and UPPER LIMIT does not exist in database for the same Vendor.
                                    $zvss_limitsCombination['limitsCombination'] = Zf_QueryGenerator::SQLValue($limitsCombination);
                                    $zvss_limitsCombination['agencyEntityCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['agencyEntityCode']);
                                    $zvss_limitsCombination['transactionType'] = Zf_QueryGenerator::SQLValue($this->_validResult['transactionType']);
                                    $zvss_limitsCombinationColumn = array('limitsCombination');
                                    $zvss_selectLimitsCombination = Zf_QueryGenerator::BuildSQLSelect('zvss_transaction_commissions', $zvss_limitsCombination, $zvss_limitsCombinationColumn);
                                    $zvss_executeSelectLimitsCombination = $this->Zf_AdoDB->Execute($zvss_selectLimitsCombination);

                                    if(!$zvss_executeSelectLimitsCombination){

                                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                                    }else{

                                        //The the result count
                                        if($zvss_executeSelectLimitsCombination->RecordCount() > 0){

                                           Zf_SessionHandler::zf_setSessionVariable("commission_setup", "limits_combination_error");

                                           $zf_errorData = array("zf_fieldName" => "lowerLimit", "zf_errorMessage" => "* Lower and upper limits already existing!!.");
                                           Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                                           Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "commission_setup");
                                           exit();

                                        }else{

                                            //There are no errors, so insert the commissions into the database.
                                            foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {
                                                
                                                if($zvss_fieldName != 'commissionValue' && $zvss_fieldName != 'commissionProportion'){
                                                    
                                                    $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue);
                                                    
                                                }
                                               
                                            }

                                            //Other database values
                                            $zvss_value['limitsCombination'] = Zf_QueryGenerator::SQLValue($limitsCombination);
                                            
                                            if($this->_validResult['commissionValue'] == ""){
                                                
                                                $zvss_value['commissionValue'] = Zf_QueryGenerator::SQLValue($this->_validResult['commissionProportion']);
                                                
                                            }else if($this->_validResult['commissionProportion'] == ""){
                                                
                                                $zvss_value['commissionValue'] = Zf_QueryGenerator::SQLValue($this->_validResult['commissionValue']);
                                                
                                            }
                                            
                                            $zvss_value["dateCreated"] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate()));

                                            //Build the insert SQL query for a new commission
                                            $insertCommission = Zf_QueryGenerator::BuildSQLInsert('zvss_transaction_commissions', $zvss_value);
                                            
                                            //Execute the insert new commission query.
                                            $executeInsertCommission  = $this->Zf_AdoDB->Execute($insertCommission);

                                            
                                            if(!$executeInsertCommission){

                                                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                                            }else{

                                                //Redirect to the manage commissions "commission overview" section.
                                                Zf_SessionHandler::zf_setSessionVariable("commission_setup", "commission_setup_success");
                                                Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "commission_setup");
                                                exit();

                                            }

                                        }

                                    }
                            
                                }

                            }   

                        }

                    }

                }

            } 
            
        } else {
            
            //print_r($this->_errorResult); exit();//This is strictly for debugging purpose
            Zf_SessionHandler::zf_setSessionVariable("agency_setup", "agency_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('platform_admin', 'zippo_setup', "commission_setup");
            exit();

        }  
        
    }
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR GETTING THE GENERAL 
     * INFORMATION ABOUT ALL COMMISSIONS
     * -------------------------------------------------------------------------
     */
    public function getCommissionInformation(){
        
       $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
       
       //Return the values of agency types
       $agencyTypesResults = $this->fetchAgencyTypesInformation();
 
        
       //echo"<pre>";print_r($agencyTypesResults);echo"</pre>"; exit();
        
        $agency_types = "";
        
        if($agencyTypesResults == 0){
            
             $agency_types .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Vendor Types Overview Warning!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There are no vendor types yet! You need to add atleast one vendor type to have a commission overview.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
            $agency_types .= '<div class="row">';  
            
            foreach ($agencyTypesResults as  $value) {
                
                $agencyTypeCode =  $value['agencyTypeCode']; 
                
                //Return all the Zippo vendors
                $agencyTypeEntities = $this->fetchAgencyEntitesInformation($agencyTypeCode);
                    
                foreach ($agencyTypeEntities as  $value) {
                        
                        $agencyEntityName = $value['agencyEntityName']; $agencyEntityCode = $value['agencyEntityCode'];
                        //For each of the vendors return all the possible transaction types
                        $transactionTypes = $this->fetchTransactionsTypeInformation();
                        
                        foreach ($transactionTypes as  $value) {

                            $transactionTypeName = $value['transactionTypeName'];
                            
                            if($transactionTypeName == "Deposit" || $transactionTypeName == "Withdrawal"){
                                
                                
                                $agency_types .= '<div class="col-lg-6 col-md-9 col-sm-8 col-xs-12 margin-bottom-15">
                                                    <div class="school-content-wrapper">
                                                        <div class="row">
                                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                                <h3>'.$agencyEntityName.' ('.$transactionTypeName.')</h3>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="school-class-inner-content scroller"  data-always-visible="1" data-rail-visible="0">
                                                            <div class="table-responsive" style="margin-right: 5px !important;">
                                                                ';
                                                                
                                                    $commissionValues = $this->fetchcommissionsInformation($agencyEntityCode, $transactionTypeName);
                                
                                                    if($commissionValues == 0){
                                                       
                                                         $agency_types .= '<span class="content-view-errors" style="font-size: 12px !important;" >No commission(s) have been created in <u>'.$agencyEntityName.' ('.$transactionTypeName.')</u> yet.</span>';
                                                        
                                                    }else{
                                                        
                                                         $agency_types .= '<table class="table table-striped table-bordered table-hover">
                                                                                <thead>
                                                                                    <tr style="font-family: Oswald-Regular !important; letter-spacing: 0.04em !important;">
                                                                                        <th style="font-size: 12px !important;">Transaction Range</th>
                                                                                        <th style="font-size: 12px !important;">Agent Commission</th>
                                                                                        <th style="font-size: 12px !important;">Date of Creation</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>';
                                                         
                                                                                //Fetch all the commissions for this vendor which are under deposit
                                                                                //@params: $agencyEntityCode, $transactionType,
                                                                                $commissionValues = $this->fetchcommissionsInformation($agencyEntityCode, $transactionTypeName);


                                                                                foreach ($commissionValues as $value) {

                                                                                   $limitsCombination = $value['limitsCombination']; $commissionValue = $value['commissionValue'];
                                                                                   $commissionType = $value['commissionType']; $dateCreated = $value['dateCreated'];
                                                                                   
                                                                                   if($commissionType == "Commission Proportion"){
                                                                                       $commissionType = "%";
                                                                                   }else{
                                                                                       $commissionType = "";
                                                                                   }
                                                                                   
                                                                                   $agency_types .= '<tr><td>'.$limitsCombination.'</td><td>'.$commissionValue.$commissionType.'</td><td class="content-table-flags">'.$dateCreated.'</td></tr>';

                                                                                }
                                                        
                                                            $agency_types .= '</tbody>
                                                                            </table>';
                                                        
                                                    }
                                
                                $agency_types .= '</div>
                                               </div>
                                             </div>
                                          </div>';
                                
                                
                            }
                            

                        }
                        
                    }
                
            }
            
             $agency_types .= '</div>';
            
        }
        
        echo  $agency_types;
        
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
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * TRANSACTION TYPES INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchTransactionsTypeInformation(){
        
        $fetchTransactionTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_transactions_type_details', $zvss_sqlValue);
        
        $zf_executeFetchTransactionTypes = $this->Zf_AdoDB->Execute($fetchTransactionTypes);

        if(!$zf_executeFetchTransactionTypes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchTransactionTypes->RecordCount() > 0){

                while(!$zf_executeFetchTransactionTypes->EOF){
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchTransactionTypes->GetRows();
                    
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
     * TRANSACTION TYPES INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchcommissionsInformation($agencyEntityCode, $transactionTypeName){
        
        $zvss_sqlValue['agencyEntityCode'] = Zf_QueryGenerator::SQLValue($agencyEntityCode);
        $zvss_sqlValue['transactionType'] = Zf_QueryGenerator::SQLValue($transactionTypeName);
        
        $fetchCommissionTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_transaction_commissions', $zvss_sqlValue);
        
        $zf_executeFetchCommissionTypes = $this->Zf_AdoDB->Execute($fetchCommissionTypes);

        if(!$zf_executeFetchCommissionTypes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchCommissionTypes->RecordCount() > 0){

                while(!$zf_executeFetchCommissionTypes->EOF){
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchCommissionTypes->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }

}

?>