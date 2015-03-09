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

class MakeNewTransaction_Model extends Zf_Model {
    
   
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
    public function makeNewTransaction(){
        
        $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
        $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        //echo Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate())); exit();
        
        
        //He we collect  and validate all the school setup information
        $this->zf_formController->zf_postFormData('outletCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Outlet Code')
                                
                                ->zf_postFormData('transactionIdNumber')
                                ->zf_validateFormData('zf_maximumLength', 60, 'ID/PP number')
                                ->zf_validateFormData('zf_minimumLength', 2, 'ID/PP number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'ID/PP number')
                
                                ->zf_postFormData('transactionFirstName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'First name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'First name')
                
                                ->zf_postFormData('transactionMiddleName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Middle name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Middle name')
                
                                ->zf_postFormData('transactionLastName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Last name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Last name')
                
                                ->zf_postFormData('transactionMobileNumber')
                                ->zf_validateFormData('zf_maximumLength', 20, 'Mobile number')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Mobile number');
         
        //These are the other data that are not changing
        $this->zf_formController->zf_postFormData('transactionAmount')
                                ->zf_validateFormData('zf_maximumLength', 7, 'Amount')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Amount')
                                //->zf_validateFormData('zf_integerData', 'Amount')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Amount')
                
                                ->zf_postFormData('agencyTypeCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Transaction Category')
                
                                ->zf_postFormData('agencyEntityCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Transacting entity')
                
                                ->zf_postFormData('transactionType')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Transaction type')
                
                                ->zf_postFormData('transactionReference')
                                ->zf_validateFormData('zf_maximumLength', 20, 'Transaction reference')
                                ->zf_validateFormData('zf_minimumLength', 3, 'Transaction reference')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Transaction reference')
                
                                ->zf_postFormData('outletIdNumber');
                
        
        

        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        $this->_validResult = $this->zf_formController->zf_fetchValidData(); 
        
        //echo'<pre>'; print_r($this->_validResult); echo'<pre><br>'; //exit(); //This is strictly for debugging purpose.
        //echo'<pre>'; print_r($this->_errorResult); echo'<pre><br>'; exit(); //This is strictly for debugging purpose.
        
        //If the error result is empty.
        if (empty($this->_errorResult)) {
            
            //echo'<pre>'; print_r($this->_validResult); echo'<pre>'; exit(); //This is strictly for debugging purpose.
            //IF THERE IS NO ANY FORM ERRORS, THEN CHECK IF THERE IS NO TRANSACTION WITH A SIMILAR REFERENCE CODE IN THE DATABASE
            $transactionReferenceValue['transactionReference'] = Zf_QueryGenerator::SQLValue($this->_validResult['transactionReference']);
            
            $transactionReferenceColumns = array('transactionReference');
            
            $zvss_transactionReferenceSql = Zf_QueryGenerator::BuildSQLSelect('zvss_new_transaction', $transactionReferenceValue, $transactionReferenceColumns);
            $zvss_executeTransactionReferenceSql = $this->Zf_AdoDB->Execute($zvss_transactionReferenceSql);
            
            if (!$zvss_executeTransactionReferenceSql) {

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                exit();

            } else {
                
                if($zvss_executeTransactionReferenceSql->RecordCount() > 0){
                    
                    //A similar transaction has already been made.
                    Zf_SessionHandler::zf_setSessionVariable("new_transaction", "reference_code_error");
                    
                    $zf_errorData = array("zf_fieldName" => "transactionReference", "zf_errorMessage" => "* Transaction with a similar reference code is already made.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    
                    if($identifictionArray[3] == ZIPPO_OUTLET_STAFF || $identifictionArray[3] == ZIPPO_OUTLET_JUNIOR_STAFF){
                        
                        Zf_GenerateLinks::zf_header_location('outlet_staff', 'manage_transactions', 'new_transactions');
                        
                    }else if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
                        
                        Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_transactions', 'new_transactions');
                        
                    }
                    
                    exit();
                    
                }else{
                    
                    $agencyEntityCode = explode(ZVSS_CONNECT, $this->_validResult['agencyEntityCode']); 
                    $transactingEntity = $agencyEntityCode[2];
                    
                    //There is not a similar transaction, so prepare the data and insert into the database.
                    foreach ($this->_validResult as $zf_fieldName => $zf_fieldValue) {
                        
                       if($zf_fieldName == "transactionAmount"){ 
                           
                         $transactionAmount = str_replace(",", "", $zf_fieldValue);   
                           
                         $zvss_transactionDetails[$zf_fieldName] = Zf_QueryGenerator::SQLValue($transactionAmount);
                         
                       }else{ 
                           
                         $zvss_transactionDetails[$zf_fieldName] = Zf_QueryGenerator::SQLValue($zf_fieldValue);
                         
                       }
                            
                    }
                    
                    $outletTypes = $this->fetchOutletsInformation($this->_validResult['outletCode']);
                    
                    foreach ($outletTypes as $value){
                        
                        $agentType = $value['agentType']; $outletType =  $value['outletType']; $outletAlias = $value['outletAlias']; $outletTown = $value['outletTown'];
                        $outletArea = $value['outletArea']; $outletLocation = $value['outletLocation'];
                        $outletName = $outletLocation." (".$outletArea.")";
                    }
                    
                    //Build the other database values.
                    $commission = $this->calculateCommissions($this->_validResult['transactionAmount'], $this->_validResult['agencyEntityCode'], $this->_validResult['transactionType']);
                    
                    //print_r($commission); exit();
                    
                    if(!is_numeric($commission) && !is_float($commission)){
                        
                        if($commission == "Error!! Cannot compute transaction commissions" || $commission == "Error!! Commission brackets not available yet"){
                            
                            //Assign Commission to 0, then issue a warning for the commission not being able to be implemented.
                            $commission = 0;
                            
                        }
                    
                    }
                    
                    //echo '<pre>'; print_r($commission); exit(); echo '</pre>';
                    
                    $zvss_transactionDetails['transactionCommission'] = Zf_QueryGenerator::SQLValue($commission);
                    $zvss_transactionDetails['outletName'] = Zf_QueryGenerator::SQLValue($outletName);
                    $zvss_transactionDetails['agentType'] = Zf_QueryGenerator::SQLValue($agentType);
                    $zvss_transactionDetails['outletType'] = Zf_QueryGenerator::SQLValue($outletType);
                    $zvss_transactionDetails['outletAlias'] = Zf_QueryGenerator::SQLValue($outletAlias);
                    $zvss_transactionDetails['outletTown'] = Zf_QueryGenerator::SQLValue($outletTown);
                    $zvss_transactionDetails['transactingEntity'] = Zf_QueryGenerator::SQLValue($transactingEntity);
                    $zvss_transactionDetails['transactionDate'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_FomartDate("Y-m-d", Zf_Core_Functions::Zf_CurrentDate())); //This is the date when the transaction was made.
                    $zvss_transactionDetails['transactionTime'] = Zf_QueryGenerator::SQLValue(Zf_Core_Functions::Zf_CurrentTime()); //This is the time when the transaction was made.
                    
                    //Build the insert SQL queries
                    $insertNewTransactionDetails = Zf_QueryGenerator::BuildSQLInsert('zvss_new_transaction', $zvss_transactionDetails);
                    
                    //echo $insertNewTransactionDetails; exit();
                    
                    $executeInsertNewTransactionDetails = $this->Zf_AdoDB->Execute($insertNewTransactionDetails);
                            
                    if(!$executeInsertNewTransactionDetails){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{

                        //We will send an email to the pharmacy admin for account activation
                        
                        if($commission == 0){
                            
                            Zf_SessionHandler::zf_setSessionVariable("new_transaction", "commission_error");
                            
                        }else{
                            
                            Zf_SessionHandler::zf_setSessionVariable("new_transaction", "new_transaction_success");
                            
                        }

                        
                        
                        if($identifictionArray[3] == ZIPPO_OUTLET_STAFF || $identifictionArray[3] == ZIPPO_OUTLET_JUNIOR_STAFF){
                            
                            Zf_GenerateLinks::zf_header_location('outlet_staff', 'manage_transactions', 'new_transactions');
                            
                        }else if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
                            
                            Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_transactions', 'new_transactions');
                            
                        }
                        exit(); 

                    }
                    
                }
            }
            
            
        } else {

            //echo "The form has some errors which MUST be rectified"; exit(); //This is strictly for debugging purpose.
            Zf_SessionHandler::zf_setSessionVariable("new_transaction", "transaction_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            
            if($identifictionArray[3] == ZIPPO_OUTLET_STAFF || $identifictionArray[3] == ZIPPO_OUTLET_JUNIOR_STAFF){
                
                Zf_GenerateLinks::zf_header_location('outlet_staff', 'manage_transactions', 'new_transactions');
                
            }else if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
                
                Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_transactions', 'new_transactions');
                
            }
            exit();
        }
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method that calculates the commission for each transaction                 |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    private function calculateCommissions($amount, $agencyEntityCode, $transactionType){
        
        //This is the method that fetches the actual commissions
        $commissionResults = $this->getCommissionsDetails($agencyEntityCode, $transactionType);
        
        if($commissionResults == 0){
            
             $commission = "Error!! Cannot compute transaction commissions";
            
        }else{
            
            if(empty($commissionResults)){
                
              $commission = "Error!! Commission brackets not available yet"; 
                
            }else{
                
                //$commission = $commissionResults;
                
                foreach ($commissionResults as $value) {
                
                    $lowerLimit = $this->intFlrVal($value['lowerLimit']); $upperLimit =  $this->intFlrVal($value['upperLimit']);
                    $commissionType =  $this->intFlrVal($value['commissionType']); $commissionValue = $this->intFlrVal($value['commissionValue']);
                    $agencyDetails = explode(ZVSS_CONNECT, $agencyEntityCode); $vendor = $agencyDetails[1]; $vendorType = $agencyDetails[2];

                    $amount = $this->intFlrVal(str_replace(",", "", $amount));

                    
                    if($amount <= $upperLimit && $amount >= $lowerLimit){

                        if($commissionType == "Commission Proportion"){

                            if($vendor == "MTS" ){

                                $commission = (($amount * $commissionValue)/100)*0.14;

                            }else if($vendor == "MobileMoney" && $vendorType == "SafaricomMpesa"){

                                    $commission = (($amount * $commissionValue)/100)*0.7;

                            }else{

                               $commission = ($amount * $commissionValue)/100;

                            } 

                        }else{

                            if($vendor == "MTS" ){

                                $commission = ($commissionValue * 14)/100;

                            }else if($vendor == "MobileMoney" && $vendorType == "SafaricomMpesa"){

                                    $commission = (($amount * $commissionValue)/100)*0.7;

                            }else{

                                $commission = $commissionValue;

                            } 

                        }

                    }else{
                        
                        $commission = "Error!! Commission brackets not available yet";
                        
                    }
                    
                    

                }
                
                //$commission = $upperLimit."===".$lowerLimit."====".$amount;
                
            }
            
        }
        
        return $commission;
        
    }
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * COMMISSION RESULTS
     * -------------------------------------------------------------------------
     */
    private function getCommissionsDetails($agencyEntityCode, $transactionType){
        
        $zvss_commissionValues['agencyEntityCode'] = Zf_QueryGenerator::SQLValue($agencyEntityCode);
        $zvss_commissionValues['transactionType'] = Zf_QueryGenerator::SQLValue($transactionType);
        $zvss_commissionsLimitColumns = array('lowerLimit', 'upperLimit', 'commissionType', 'commissionValue');
        $zvss_selectCommissionsDetails = Zf_QueryGenerator::BuildSQLSelect('zvss_transaction_commissions', $zvss_commissionValues, $zvss_commissionsLimitColumns);

        
        $zf_executeFetchCommissionsDetails = $this->Zf_AdoDB->Execute($zvss_selectCommissionsDetails);

        if(!$zf_executeFetchCommissionsDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchCommissionsDetails->RecordCount() > 0){

                while(!$zf_executeFetchCommissionsDetails->EOF){
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchCommissionsDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR CHECKING IF A VALUE IS 
     * AN INT OR FLOAT VALUE
     * -------------------------------------------------------------------------
     */
    private function intFlrVal($value) {
        
        if(is_numeric($value)){
            
            $value = intval($value);
            
        }else if(is_float($value)){
            
            $value = floatval($value);
            
        }
        
        return $value;
        
    }




    /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The public method for generating the charts for all transactions          |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */ 
    public function AllTransactions($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
               $dateToday = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
           $dateOneDayAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(1));
          $dateTwoDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(2));
        $dateThreeDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(3));
         $dateFourDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(4));
         $dateFiveDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(5));
          $dateSixDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(6));
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $getToday = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateToday' "; //die();
           $getOneDayAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateOneDayAgo' "; //die();
          $getTwoDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateTwoDaysAgo' "; //die();
        $getThreeDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateThreeDaysAgo' "; //die();
         $getFourDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateFourDaysAgo' "; //die();
         $getFiveDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateFiveDaysAgo' "; //die();
          $getSixDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateSixDaysAgo' "; //die();
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $getToday = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
           $getOneDayAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateOneDayAgo' AND outletIdNumber = '$userid' "; //die();
          $getTwoDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateTwoDaysAgo' AND outletIdNumber = '$userid' "; //die();
        $getThreeDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateThreeDaysAgo' AND outletIdNumber = '$userid' "; //die();
         $getFourDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateFourDaysAgo' AND outletIdNumber = '$userid' "; //die();
         $getFiveDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateFiveDaysAgo' AND outletIdNumber = '$userid' "; //die();
          $getSixDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateSixDaysAgo' AND outletIdNumber = '$userid' "; //die();
          
        }   
          
          //echo $getToday."<br>";echo $getOneDayAway."<br>";echo $getTwoDaysAway."<br>";echo $getThreeDaysAway."<br>";echo $getFourDaysAway."<br>";echo $getFiveDaysAway."<br>";echo $getSixDaysAway."<br>"; exit();
        
               $executeGetToday  = $this->Zf_AdoDB->Execute($getToday);
           $executeGetOneDayAway = $this->Zf_AdoDB->Execute($getOneDayAway);
          $executeGetTwoDaysAway = $this->Zf_AdoDB->Execute($getTwoDaysAway);
        $executeGetThreeDaysAway = $this->Zf_AdoDB->Execute($getThreeDaysAway);
         $executeGetFourDaysAway = $this->Zf_AdoDB->Execute($getFourDaysAway);
         $executeGetFiveDaysAway = $this->Zf_AdoDB->Execute($getFiveDaysAway);
         $executeGetSixDaysAway  = $this->Zf_AdoDB->Execute($getSixDaysAway);
        
        if (!$executeGetToday || !$executeGetOneDayAway || !$executeGetTwoDaysAway || !$executeGetThreeDaysAway|| !$executeGetFiveDaysAway || !$executeGetFiveDaysAway || !$executeGetSixDaysAway){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
                      $inboundTodayCount = $executeGetToday->RecordCount();
                 $inboundOneDayAwayCount = $executeGetOneDayAway->RecordCount();
            $inboundTwoDaysAwayAwayCount = $executeGetTwoDaysAway->RecordCount();
              $inboundThreeDaysAwayCount = $executeGetThreeDaysAway->RecordCount();
               $inboundFourDaysAwayCount = $executeGetFourDaysAway->RecordCount();
               $inboundFiveDaysAwayCount = $executeGetFiveDaysAway->RecordCount();
                $inboundSixDaysAwayCount = $executeGetSixDaysAway->RecordCount();
            
        }
        
        
        
        $strXML  = "";
        $strXML .= "<chart bgColor='transparent' bgAlpha='50' showBorder='0' canvasBgColor='transparent'
            canvasBorderColor='efefef' canvasBorderThickness='1' canvasBorderAlpha='80' canvasBorder='0'
            xAxisName='Days of Week' yAxisName='Total transactions' showValues='1' formatNumberScale='0' palette='1'
            showlegend='1' enablesmartlabels='1' showlabels='1' legendPosition='BOTTOM'
            paletteColors='44bbcc, 88dddd, bbeeff, 0055bb' paletteThemeColor='ffb848' showToolTip='1' showToolTipShadow='1'>";
        $strXML .= "<set label='Day 1' value=' ".$inboundSixDaysAwayCount." ' tooltext='Inbound transactions: ".$inboundSixDaysAwayCount.",{br}six days ago '  link=' ' />";
        $strXML .= "<set label='Day 2' value=' ".$inboundFiveDaysAwayCount." ' tooltext='Inbound transactions: ".$inboundFiveDaysAwayCount.",{br}five days ago '  link=' ' />";
        $strXML .= "<set label='Day 3' value=' ".$inboundFourDaysAwayCount." ' tooltext='Inbound transactions: ".$inboundFourDaysAwayCount.",{br}four days ago  '  link=' ' />";
        $strXML .= "<set label='Day 4' value=' ".$inboundThreeDaysAwayCount." ' tooltext='Inbound transactions: ".$inboundThreeDaysAwayCount.",{br}three days ago  '  link=' ' />";
        $strXML .= "<set label='Day 5' value=' ".$inboundTwoDaysAwayAwayCount." ' tooltext='Inbound transactions: ".$inboundTwoDaysAwayAwayCount.",{br}two days ago '  link=' ' />";
        $strXML .= "<set label='Day 6' value=' ".$inboundOneDayAwayCount." ' tooltext='Inbound transactions: ".$inboundOneDayAwayCount.",{br}one day ago  '  link=' ' />";
        $strXML .= "<set label='Today' value=' ".$inboundTodayCount." ' tooltext='Inbound transactions: ".$inboundTodayCount.", today '  link=' ' />";
        $strXML .= "
                    <styles>
                        <definition>
                              <style name='myToolTipFont' type='font' font='ProximaNova-Light' size='11' color='87b6d9'/>
                        </definition>
                        <application>
                              <apply toObject='ToolTip' styles='myToolTipFont' />
                        </application>
                    </styles> 

                   ";
        $strXML .= "</chart>";

        $zf_chartData = array(

            "chartData"         => "$strXML",
            "chartType"         => "Line",
            "chartId"           => "inboundTransactions",
            "chartWidth"        => "100%",
            "chartHeight"       => 230,
            "chartDebug"        => "false",
            "registerJavacript" => "true",
            "chartTransparency" => ""

        );

        Zf_GenerateCharts::zf_generate_chart($zf_chartData, $chartPosition = "inline");
        
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for making a new transaction                                     |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function InboundOutboundTransactionsPie($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $getInboundTransactions = "SELECT * FROM " . $table . " WHERE transactionBound ='inbound' "; //die();
            $getOutboundTransactions = "SELECT * FROM " . $table . " WHERE transactionBound ='outbound' "; //die();
              
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $getInboundTransactions = "SELECT * FROM " . $table . " WHERE transactionBound ='inbound' AND outletIdNumber = '$userid'  "; //die();
            $getOutboundTransactions = "SELECT * FROM " . $table . " WHERE transactionBound ='outbound' AND outletIdNumber = '$userid'  "; //die();
              
        }
       
        $executeInboundTransactions  = $this->Zf_AdoDB->Execute($getInboundTransactions);
        $executeOutboundTransactions = $this->Zf_AdoDB->Execute($getOutboundTransactions);
        
        
        if (!$executeInboundTransactions || !$executeOutboundTransactions){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
           
                
            $inboundTransactionsCount = $executeInboundTransactions->RecordCount();
            $outboundTransactionsCount = $executeOutboundTransactions->RecordCount();
            
        }
        
        $strXML  = "";
        $strXML .= "<chart bgColor='transparent' bgAlpha='50' showBorder='0' canvasBgColor='transparent'
            canvasBorderColor='efefef' canvasBorderThickness='1' canvasBorderAlpha='80' canvasBorder='0'
            xAxisName='Gender' yAxisName='Total Count' showValues='1' formatNumberScale='0' palette='1'
            showlegend='1' enablesmartlabels='0' showlabels='0' showpercentvalues='1' pieRadius='150' legendPosition='BOTTOM'
            paletteColors='44bbcc, 225533, 88dddd, bbeeff' paletteThemeColor='ffb848' showToolTip='1' showToolTipShadow='1'>";
        $strXML .= "<set label='Inbound Transactions' value=' ".$inboundTransactionsCount." ' tooltext='Total inbound transactions : ".$inboundTransactionsCount.",{br}Click for a detailed{br}information '  link=' ' />";
        $strXML .= "<set label='Outbound Transactions' value=' ".$outboundTransactionsCount." ' tooltext='Total outbound transactions: ".$outboundTransactionsCount.",{br}Click for a detailed{br}information '  link=' ' />";
        $strXML .= "
                    <styles>
                        <definition>
                              <style name='myToolTipFont' type='font' font='ProximaNova-Light' size='11' color='87b6d9'/>
                        </definition>
                        <application>
                              <apply toObject='ToolTip' styles='myToolTipFont' />
                        </application>
                    </styles> 

                   ";
        $strXML .= "</chart>";

        $zf_chartData = array(

            "chartData"         => "$strXML",
            "chartType"         => "Pie3D",
            "chartId"           => "allTransactions",
            "chartWidth"        => "100%",
            "chartHeight"       => 400,
            "chartDebug"        => "false",
            "registerJavacript" => "true",
            "chartTransparency" => ""

        );

        Zf_GenerateCharts::zf_generate_chart($zf_chartData, $chartPosition = "inline");
        
        
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for making a new transaction                                     |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function AllInboundTransactionsPie($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $getMpesaInboundTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Mpesa Deposit' AND  transactionBound ='inbound' "; //die();
            $getBankInboundTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Bank Deposit' AND  transactionBound ='inbound' "; //die();
            $getIMTInboundTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='International Money Transfer' AND  transactionBound ='inbound' "; //die();
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $getMpesaInboundTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Mpesa Deposit' AND  transactionBound ='inbound' AND outletIdNumber = '$userid'  "; //die();
            $getBankInboundTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Bank Deposit' AND  transactionBound ='inbound' AND outletIdNumber = '$userid' "; //die();
            $getIMTInboundTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='International Money Transfer' AND  transactionBound ='inbound' AND outletIdNumber = '$userid' "; //die();
            
        }
       
        $executeMpesaInboundTransactions  = $this->Zf_AdoDB->Execute($getMpesaInboundTransactions);
        $executeBankInboundTransactions  = $this->Zf_AdoDB->Execute($getBankInboundTransactions);
        $executeIMTInboundTransactions  = $this->Zf_AdoDB->Execute($getIMTInboundTransactions);
        
        
        if (!$executeMpesaInboundTransactions || !$executeBankInboundTransactions || !$executeIMTInboundTransactions){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $mpesaInboundTransactionsCount = $executeMpesaInboundTransactions->RecordCount();
            $bankInboundTransactionsCount = $executeBankInboundTransactions->RecordCount();
            $imtInboundTransactionsCount = $executeIMTInboundTransactions->RecordCount();
            
        }
        
        $strXML  = "";
        $strXML .= "<chart bgColor='transparent' bgAlpha='50' showBorder='0' canvasBgColor='transparent'
            canvasBorderColor='efefef' canvasBorderThickness='1' canvasBorderAlpha='80' canvasBorder='0'
            xAxisName='Gender' yAxisName='Total Count' showValues='1' formatNumberScale='0' palette='1'
            showlegend='1' enablesmartlabels='0' showlabels='0' showpercentvalues='1' pieRadius='150' legendPosition='BOTTOM'
            paletteColors='F16745, FFC65D, 7BC8A4, 4CC3D9, 93648D, 404040' paletteThemeColor='ffb848' showToolTip='1' showToolTipShadow='1'>";
        $strXML .= "<set label='Mpesa Deposits' value=' ".$mpesaInboundTransactionsCount." ' tooltext='Total mpesa deposits: ".$mpesaInboundTransactionsCount.",{br}Click for a detailed{br}information '  link=' ' />";
        $strXML .= "<set label='Bank Deposits' value=' ".$bankInboundTransactionsCount." ' tooltext='Total bank deposits: ".$bankInboundTransactionsCount.",{br}Click for a detailed{br}information '  link=' ' />";
        $strXML .= "<set label='International Money Transfers' value=' ".$imtInboundTransactionsCount." ' tooltext='Total international money transfers: ".$imtInboundTransactionsCount.",{br}Click for a detailed{br}information '  link=' ' />";
        $strXML .= "
                    <styles>
                        <definition>
                              <style name='myToolTipFont' type='font' font='ProximaNova-Light' size='11' color='87b6d9'/>
                        </definition>
                        <application>
                              <apply toObject='ToolTip' styles='myToolTipFont' />
                        </application>
                    </styles> 

                   ";
        $strXML .= "</chart>";

        $zf_chartData = array(

            "chartData"         => "$strXML",
            "chartType"         => "Pie3D",
            "chartId"           => "allTransactions",
            "chartWidth"        => "100%",
            "chartHeight"       => 400,
            "chartDebug"        => "false",
            "registerJavacript" => "true",
            "chartTransparency" => ""

        );

        Zf_GenerateCharts::zf_generate_chart($zf_chartData, $chartPosition = "inline");
        
        
    }
   
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for making a new transaction                                     |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function AllOutboundTransactionsPie($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $getMpesaOutboundTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Mpesa Withdrawal' AND  transactionType = 'Deposit' OR transactionType = 'Outbound Transfer' "; //die();
            $getBankOutboundTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Bank Withdrawal' AND  transactionType = 'Deposit' OR transactionType = 'Outbound Transfer' "; //die();
            $getFundsTransferTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Funds Transfer' AND  transactionType = 'Deposit' OR transactionType = 'Outbound Transfer' "; //die();
            $getReverseTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Transaction Reversal' AND  transactionType = 'Deposit' OR transactionType = 'Outbound Transfer' "; //die();
            $getSuperAgencyTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Super Agency' AND  transactionType = 'Deposit' OR transactionType = 'Outbound Transfer' "; //die();
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $getMpesaOutboundTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Mpesa Withdrawal' AND  transactionType = 'Deposit' OR transactionType = 'Outbound Transfer' AND outletIdNumber = '$userid'  "; //die();
            $getBankOutboundTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Bank Withdrawal' AND  transactionType = 'Deposit' OR transactionType = 'Outbound Transfer' AND outletIdNumber = '$userid'  "; //die();
            $getFundsTransferTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Funds Transfer' AND  transactionType = 'Deposit' OR transactionType = 'Outbound Transfer' AND outletIdNumber = '$userid'  "; //die();
            $getReverseTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Transaction Reversal' AND  transactionType = 'Deposit' OR transactionType = 'Outbound Transfer' AND outletIdNumber = '$userid'  "; //die();
            $getSuperAgencyTransactions = "SELECT * FROM " . $table . " WHERE transactionType ='Super Agency' AND  transactionType = 'Deposit' OR transactionType = 'Outbound Transfer' AND outletIdNumber = '$userid'  "; //die();
            
        }
       
        $executeMpesaOutboundTransactions  = $this->Zf_AdoDB->Execute($getMpesaOutboundTransactions);
        $executeBankOutboundTransactions  = $this->Zf_AdoDB->Execute($getBankOutboundTransactions);
        $executeFundsTransferTransactions  = $this->Zf_AdoDB->Execute($getFundsTransferTransactions);
        $executeReverseTransactions  = $this->Zf_AdoDB->Execute($getReverseTransactions);
        $executeSuperAgencyTransactions  = $this->Zf_AdoDB->Execute($getSuperAgencyTransactions);
        
        
        if (!$executeMpesaOutboundTransactions || !$executeBankOutboundTransactions || !$executeFundsTransferTransactions || !$executeReverseTransactions|| !$executeSuperAgencyTransactions ){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
           
                
            $mpesaOutboundTransactionsCount = $executeMpesaOutboundTransactions->RecordCount();
            $bankOutboundTransactionsCount = $executeBankOutboundTransactions->RecordCount();
            $fundsTransferCount = $executeFundsTransferTransactions->RecordCount();
            $reverseTransactionsCount = $executeReverseTransactions->RecordCount();
            $superAgencyTransactionsCount = $executeSuperAgencyTransactions->RecordCount();
            
        }
        
        $strXML  = "";
        $strXML .= "<chart bgColor='transparent' bgAlpha='50' showBorder='0' canvasBgColor='transparent'
            canvasBorderColor='efefef' canvasBorderThickness='1' canvasBorderAlpha='80' canvasBorder='0'
            xAxisName='Gender' yAxisName='Total Count' showValues='1' formatNumberScale='0' palette='1'
            showlegend='1' enablesmartlabels='0' showlabels='0' showpercentvalues='1' pieRadius='150' legendPosition='BOTTOM'
            paletteColors='F16745, FFC65D, 7BC8A4, 4CC3D9, 93648D, 404040' paletteThemeColor='ffb848' showToolTip='1' showToolTipShadow='1'>";
        $strXML .= "<set label='Mpesa Withdrawal' value=' ".$mpesaOutboundTransactionsCount." ' tooltext='Total mpesa withdrawals: ".$mpesaOutboundTransactionsCount.",{br}Click for a detailed{br}information '  link=' ' />";
        $strXML .= "<set label='Bank Withdrawal' value=' ".$bankOutboundTransactionsCount." ' tooltext='Total bank withdrawals: ".$bankOutboundTransactionsCount.",{br}Click for a detailed{br}information '  link=' ' />";
        $strXML .= "<set label='Funds Transfers' value=' ".$fundsTransferCount." ' tooltext='Total international money transfers: ".$fundsTransferCount.",{br}Click for a detailed{br}information '  link=' ' />";
        $strXML .= "<set label='Reverse Transactions' value=' ".$reverseTransactionsCount." ' tooltext='Total international money transfers: ".$reverseTransactionsCount.",{br}Click for a detailed{br}information '  link=' ' />";
        $strXML .= "<set label='Super Agency' value=' ".$superAgencyTransactionsCount." ' tooltext='Total international money transfers: ".$superAgencyTransactionsCount.",{br}Click for a detailed{br}information '  link=' ' />";
        $strXML .= "
                    <styles>
                        <definition>
                              <style name='myToolTipFont' type='font' font='ProximaNova-Light' size='11' color='87b6d9'/>
                        </definition>
                        <application>
                              <apply toObject='ToolTip' styles='myToolTipFont' />
                        </application>
                    </styles> 

                   ";
        $strXML .= "</chart>";

        $zf_chartData = array(

            "chartData"         => "$strXML",
            "chartType"         => "Pie3D",
            "chartId"           => "allTransactions",
            "chartWidth"        => "100%",
            "chartHeight"       => 400,
            "chartDebug"        => "false",
            "registerJavacript" => "true",
            "chartTransparency" => ""

        );

        Zf_GenerateCharts::zf_generate_chart($zf_chartData, $chartPosition = "inline");
         
        
    }
   
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The public method for generating line graphs for all Inbound and outbound         |
    * |  transactions                                                                      |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */ 
    public function InboundOutboundTransactionsLine($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
               $dateToday = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
           $dateOneDayAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(1));
          $dateTwoDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(2));
        $dateThreeDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(3));
         $dateFourDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(4));
         $dateFiveDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(5));
          $dateSixDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(6));
   
   if($application_user == ZIPPO_PLATFORM_ADMIN){
            
        //Get inbound transactions by platform admin
                $getInboundToday = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateToday' "; //die();
           $getInboundOneDayAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateOneDayAgo' "; //die();
          $getInboundTwoDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateTwoDaysAgo' "; //die();
        $getInboundThreeDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateThreeDaysAgo' "; //die();
         $getInboundFourDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateFourDaysAgo' "; //die();
         $getInboundFiveDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateFiveDaysAgo' "; //die();
          $getInboundSixDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateSixDaysAgo' "; //die();
         
        //Get outbound transactions by platform admin  
                $getOutboundToday = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateToday' "; //die();
           $getOutboundOneDayAway = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateOneDayAgo' "; //die();
          $getOutboundTwoDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateTwoDaysAgo' "; //die();
        $getOutboundThreeDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateThreeDaysAgo' "; //die();
         $getOutboundFourDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateFourDaysAgo' "; //die();
         $getOutboundFiveDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateFiveDaysAgo' "; //die();
          $getOutboundSixDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateSixDaysAgo' "; //die();
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
         //Get inbound transactions by outlet staff
                $getInboundToday = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
           $getInboundOneDayAway = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateOneDayAgo' AND outletIdNumber = '$userid' "; //die();
          $getInboundTwoDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateTwoDaysAgo' AND outletIdNumber = '$userid' "; //die();
        $getInboundThreeDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateThreeDaysAgo' AND outletIdNumber = '$userid' "; //die();
         $getInboundFourDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateFourDaysAgo' AND outletIdNumber = '$userid' "; //die();
         $getInboundFiveDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateFiveDaysAgo' AND outletIdNumber = '$userid' "; //die();
          $getInboundSixDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='outbound' AND transactionDate = '$dateSixDaysAgo' AND outletIdNumber = '$userid' "; //die();
          
        //Get outbound transactions by outlet staff
                $getOutboundToday = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
           $getOutboundOneDayAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateOneDayAgo' AND outletIdNumber = '$userid' "; //die();
          $getOutboundTwoDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateTwoDaysAgo' AND outletIdNumber = '$userid' "; //die();
        $getOutboundThreeDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateThreeDaysAgo' AND outletIdNumber = '$userid' "; //die();
         $getOutboundFourDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateFourDaysAgo' AND outletIdNumber = '$userid' "; //die();
         $getOutboundFiveDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateFiveDaysAgo' AND outletIdNumber = '$userid' "; //die();
          $getOutboundSixDaysAway = "SELECT * FROM " . $table . " WHERE transactionBound='inbound' AND transactionDate = '$dateSixDaysAgo' AND outletIdNumber = '$userid' "; //die();
          
        }   
          
          //echo $getToday."<br>";echo $getOneDayAway."<br>";echo $getTwoDaysAway."<br>";echo $getThreeDaysAway."<br>";echo $getFourDaysAway."<br>";echo $getFiveDaysAway."<br>";echo $getSixDaysAway."<br>"; exit();
        
        //Execute all the inbound queries
               $executeGetInboundToday  = $this->Zf_AdoDB->Execute($getInboundToday);
           $executeGetInboundOneDayAway = $this->Zf_AdoDB->Execute($getInboundOneDayAway);
          $executeGetInboundTwoDaysAway = $this->Zf_AdoDB->Execute($getInboundTwoDaysAway);
        $executeGetInboundThreeDaysAway = $this->Zf_AdoDB->Execute($getInboundThreeDaysAway);
         $executeGetInboundFourDaysAway = $this->Zf_AdoDB->Execute($getInboundFourDaysAway);
         $executeGetInboundFiveDaysAway = $this->Zf_AdoDB->Execute($getInboundFiveDaysAway);
         $executeGetInboundSixDaysAway  = $this->Zf_AdoDB->Execute($getInboundSixDaysAway);
        
        //Execute all the outbound queries
               $executeGetOutboundToday  = $this->Zf_AdoDB->Execute($getOutboundToday);
           $executeGetOutboundOneDayAway = $this->Zf_AdoDB->Execute($getOutboundOneDayAway);
          $executeGetOutboundTwoDaysAway = $this->Zf_AdoDB->Execute($getOutboundTwoDaysAway);
        $executeGetOutboundThreeDaysAway = $this->Zf_AdoDB->Execute($getOutboundThreeDaysAway);
         $executeGetOutboundFourDaysAway = $this->Zf_AdoDB->Execute($getOutboundFourDaysAway);
         $executeGetOutboundFiveDaysAway = $this->Zf_AdoDB->Execute($getOutboundFiveDaysAway);
         $executeGetOutboundSixDaysAway  = $this->Zf_AdoDB->Execute($getOutboundSixDaysAway);
        
        if (!$executeGetInboundToday || !$executeGetInboundOneDayAway || !$executeGetInboundTwoDaysAway || !$executeGetInboundThreeDaysAway|| !$executeGetInboundFiveDaysAway || !$executeGetInboundFiveDaysAway || !$executeGetInboundSixDaysAway
        || !$executeGetOutboundToday || !$executeGetOutboundOneDayAway || !$executeGetOutboundTwoDaysAway || !$executeGetOutboundThreeDaysAway|| !$executeGetOutboundFiveDaysAway || !$executeGetOutboundFiveDaysAway || !$executeGetOutboundSixDaysAway){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
            
            //Count all inbound records
                      $inboundTodayCount = $executeGetInboundToday->RecordCount();
                 $inboundOneDayAwayCount = $executeGetInboundOneDayAway->RecordCount();
                $inboundTwoDaysAwayCount = $executeGetInboundTwoDaysAway->RecordCount();
              $inboundThreeDaysAwayCount = $executeGetInboundThreeDaysAway->RecordCount();
               $inboundFourDaysAwayCount = $executeGetInboundFourDaysAway->RecordCount();
               $inboundFiveDaysAwayCount = $executeGetInboundFiveDaysAway->RecordCount();
                $inboundSixDaysAwayCount = $executeGetInboundSixDaysAway->RecordCount();
            
            //Count all outbound records
                      $outboundTodayCount = $executeGetOutboundToday->RecordCount();
                 $outboundOneDayAwayCount = $executeGetOutboundOneDayAway->RecordCount();
                $outboundTwoDaysAwayCount = $executeGetOutboundTwoDaysAway->RecordCount();
              $outboundThreeDaysAwayCount = $executeGetOutboundThreeDaysAway->RecordCount();
               $outboundFourDaysAwayCount = $executeGetOutboundFourDaysAway->RecordCount();
               $outboundFiveDaysAwayCount = $executeGetOutboundFiveDaysAway->RecordCount();
                $outboundSixDaysAwayCount = $executeGetOutboundSixDaysAway->RecordCount();
            
        }
        
          
        $strXML  = "";
        $strXML .= "<chart caption='Inbound &amp; Outbound Transactions' xAxisName='Last Seven Days Duration' yAxisName='Total Transactions' numberPrefix='' bgColor='transparent'
		bgAlpha='50' showBorder='0' canvasBgColor='transparent' canvasBorderColor='efefef' canvasBorderThickness='1' canvasBorderAlpha='80'
                showlegend='1' enablesmartlabels='1' showlabels='1' labelDisplay='ROTATE' slantLabels='1' showpercentvalues='1' legendPosition='BOTTOM' canvasBorder='0'
                showAlternateVGridColor='1' numVDivLines='5' vDivLineIsDashed='0' vDivLineDashLen='5' vDivLineDashGap='5' alternateVGridColor='D9E5F1' alternateVGridAlpha='100'
                paletteColors='44bbcc, 225533, 88dddd, bbeeff' paletteThemeColor='ffb848' showToolTip='1' showToolTipShadow='1'> ";
        
        $strXML .= "
                    <trendLines>
                         <line startValue='430000' color='009933' displayvalue='Target' />
                    </trendLines>

                    <categories>
                        <category Label='".$dateSixDaysAgo."'/>
                        <category Label='".$dateFiveDaysAgo."'/>
                        <category Label='".$dateFourDaysAgo."'/>
                        <category Label='".$dateThreeDaysAgo."'/>
                        <category Label='".$dateTwoDaysAgo."'/>
                        <category Label='".$dateOneDayAgo."'/>
                        <category Label='".$dateToday."'/>
                     </categories>
                     <dataset seriesName='Inbound Transactions'>
                        <set  value='".$inboundSixDaysAwayCount."' />
                        <set  value='".$inboundFiveDaysAwayCount."' />
                        <set  value='".$inboundFourDaysAwayCount."' />
                        <set  value='".$inboundThreeDaysAwayCount."' />
                        <set  value='".$inboundTwoDaysAwayCount."' /> 
                        <set  value='".$inboundOneDayAwayCount."' /> 
                        <set  value='".$inboundTodayCount."' />
                     </dataset>
                     <dataset seriesName='Outbound Transactions'> 
                        <set  value='".$outboundSixDaysAwayCount."' />
                        <set  value='".$outboundFiveDaysAwayCount."' /> 
                        <set  value='".$outboundFourDaysAwayCount."' />
                        <set  value='".$outboundThreeDaysAwayCount."' />
                        <set  value='".$outboundTwoDaysAwayCount."' /> 
                        <set  value='".$outboundOneDayAwayCount."' />
                        <set  value='".$outboundTodayCount."' /> 
                     </dataset>
                     <styles>
                        <definition>
                           <style name='myLabelsFont' type='font' font='Verdana' size='8' color='575757' bold='1' underline='1'/>
                        </definition>
                        <application>
                           <apply toObject='DataLabels' styles='myLabelsFont' />
                        </application>
                     </styles>

                     ";
            
        $strXML .= "</chart>";

        $zf_chartData = array(

            "chartData"         => "$strXML",
            "chartType"         => "MSLine",
            "chartId"           => "outboundTransactions",
            "chartWidth"        => "100%",
            "chartHeight"       => 400,
            "chartDebug"        => "false",
            "registerJavacript" => "true",
            "chartTransparency" => ""

        );

        Zf_GenerateCharts::zf_generate_chart($zf_chartData, $chartPosition = "inline");
        
    }
    
   
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  This method is for drawing bounded partners transactions                          |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function boundedPartnersTransactionsPie($transactionDirection){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        //$dateToday = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        
        //Returns the array values of agency types
        $transactionsTypeResults = $this->fetchTransactionsTypeInformation();
        
        //Returns the array values of agency types
        $agencyTypesResults = $this->fetchAgencyTypesInformation();
        
        if($agencyTypesResults == 0 || $transactionsTypeResults == 0){
            
             $agency_types .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Partners Proportions Error!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There is probable data inconsistency. Cannot load data.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
            $strXML  = "";
            $strXML .= "<chart bgColor='transparent' bgAlpha='50' showBorder='0' canvasBgColor='transparent'
            canvasBorderColor='efefef' canvasBorderThickness='1' canvasBorderAlpha='80' canvasBorder='0'
            xAxisName='Gender' yAxisName='Total Count' showValues='1' formatNumberScale='0' palette='1'
            showlegend='1' enablesmartlabels='0' showlabels='0' showpercentvalues='1' pieRadius='130' legendPosition='BOTTOM'
            paletteColors='F16745, FFC65D, 7BC8A4, 4CC3D9, 93648D, 404040' paletteThemeColor='ffb848' showToolTip='1' showToolTipShadow='1'>";
            
            foreach ($agencyTypesResults as  $value) {
                
                $agencyTypeName = $value['agencyTypeName']; $agencyTypeCode =  $value['agencyTypeCode'];
                
                //echo $agencyTypeName."====".$agencyTypeCode."<br>";
                
                $transactionName = "get".$agencyTypeName."Transaction";
                $executeTransaction = "execute".$agencyTypeName."Transaction";
                $countTransactions = "count".$agencyTypeName."Transaction";
                
                //Select all the transactions from the database.
                
                if($application_user == ZIPPO_PLATFORM_ADMIN){
            
                    $transactionName = "SELECT * FROM " . $table . " WHERE agencyTypeCode ='".$agencyTypeCode."'  "; //die();
                    

                }else if($application_user == ZIPPO_OUTLET_STAFF){

                    $transactionName = "SELECT * FROM " . $table . " WHERE agencyTypeCode ='".$agencyTypeCode."' AND outletIdNumber = '$userid' "; //die();
                    
                }
                
                $executeTransaction  = $this->Zf_AdoDB->Execute($transactionName);
                
                if (!$executeTransaction){
            
                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    $countTransactions = $executeTransaction->RecordCount();

                }
                
                $strXML .= "<set label='".$agencyTypeName."' value=' ".$countTransactions." ' tooltext='Total ".$agencyTypeName." Transactions ".$countTransactions.",{br}Click for a detailed{br}information '  link=' ' />";
                
            }
            
            $strXML .= "
                    <styles>
                        <definition>
                              <style name='myToolTipFont' type='font' font='ProximaNova-Light' size='11' color='87b6d9'/>
                        </definition>
                        <application>
                              <apply toObject='ToolTip' styles='myToolTipFont' />
                        </application>
                    </styles> 

                   ";
            $strXML .= "</chart>";

            $zf_chartData = array(

                "chartData"         => "$strXML",
                "chartType"         => "Pie2D",
                "chartId"           => "partnersTransactionsPie",
                "chartWidth"        => "100%",
                "chartHeight"       => 400,
                "chartDebug"        => "false",
                "registerJavacript" => "true",
                "chartTransparency" => ""

            );

            Zf_GenerateCharts::zf_generate_chart($zf_chartData, $chartPosition = "inline");
            
            
            
            
        }
        
        echo $agency_types;
        
        
    }
    
    
    
    
    /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The public method for generating line graphs for all bound transactions         |                                                             |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */ 
    public function boundedTransactionsLine($transactionDirection){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        
        //Returns the array values of agency types
        $transactionsTypeResults = $this->fetchTransactionsTypeInformation();
        
        if($transactionsTypeResults == 0){
            
             $transactions_types .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Transaction Types Error!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There is probable data inconsistency. Cannot load data.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
            //These are the available weekly based time limits.
            
            $dateToday = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateOneDayAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(1));
       $dateTwoDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(2));
     $dateThreeDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(3));
      $dateFourDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(4));
      $dateFiveDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(5));
       $dateSixDaysAgo = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(6));
       
       $strXML  = "";
       $strXML .= "<chart caption='Transactions Count (Last 7 days)' xAxisName='Last Seven Days Duration' yAxisName='Total Transactions Count' numberPrefix='' bgColor='transparent'
		bgAlpha='50' showBorder='0' canvasBgColor='transparent' canvasBorderColor='efefef' canvasBorderThickness='1' canvasBorderAlpha='80'
                showlegend='1' enablesmartlabels='1' showlabels='1' labelDisplay='ROTATE' slantLabels='1' showpercentvalues='1' legendPosition='BOTTOM' canvasBorder='0'
                showAlternateVGridColor='1' numVDivLines='5' vDivLineIsDashed='0' vDivLineDashLen='5' vDivLineDashGap='5' alternateVGridColor='D9E5F1' alternateVGridAlpha='100'
                paletteColors='27A9E3, 28B779, E7191B, FFC65D, 4CC3D9, 93648D, 404040' paletteThemeColor='ffb848' showToolTip='1' showToolTipShadow='1'> ";
        
       $strXML .= "<categories>
                        <category Label='".$dateSixDaysAgo."'/>
                        <category Label='".$dateFiveDaysAgo."'/>
                        <category Label='".$dateFourDaysAgo."'/>
                        <category Label='".$dateThreeDaysAgo."'/>
                        <category Label='".$dateTwoDaysAgo."'/>
                        <category Label='".$dateOneDayAgo."'/>
                        <category Label='".$dateToday."'/>
                   </categories>";
       
            foreach ($transactionsTypeResults as $value) {
                
                $transactionType = $value['transactionTypeName']; $transactionBound = $value['transactionBound'];
                
               if($transactionBound == $transactionDirection){
                   
                   $transactionName = str_replace(" ", "", $transactionType);
                
                //$transactions_types .= $transactionName."<br>";
                
                //Prepare the SQL query variable
                $transactionToday = "getToday".$transactionName; $transactionOneDayAway = "getOneDayAway".$transactionName;
                $transactionTwoDaysAway = "getTwoDaysAway".$transactionName; $transactionThreeDaysAway = "getThreeDaysAway".$transactionName;
                $transactionFourDaysAway = "getFourDaysAway".$transactionName; $transactionFiveDaysAway = "getFiveDaysAway".$transactionName;
                $transactionSixDaysAway = "getSixDaysAway".$transactionName;
                
                
                //Write the SQL queries here.
                if($application_user == ZIPPO_PLATFORM_ADMIN){
            
                    //Here we write all the queries based on the transaction type
                            $transactionToday = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateToday' "; //die();
                       $transactionOneDayAway = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateOneDayAgo' "; //die();
                      $transactionTwoDaysAway = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateTwoDaysAgo' "; //die();
                    $transactionThreeDaysAway = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateThreeDaysAgo' "; //die();
                     $transactionFourDaysAway = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateFourDaysAgo' "; //die();
                     $transactionFiveDaysAway = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateFiveDaysAgo' "; //die();
                      $transactionSixDaysAway = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateSixDaysAgo' "; //die();

                }else if($application_user == ZIPPO_OUTLET_STAFF){

                    //Here we write all the queries based on the transaction type
                            $transactionToday = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
                       $transactionOneDayAway = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateOneDayAgo' AND outletIdNumber = '$userid' "; //die();
                      $transactionTwoDaysAway = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateTwoDaysAgo' AND outletIdNumber = '$userid' "; //die();
                    $transactionThreeDaysAway = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateThreeDaysAgo' AND outletIdNumber = '$userid' "; //die();
                     $transactionFourDaysAway = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateFourDaysAgo' AND outletIdNumber = '$userid' "; //die();
                     $transactionFiveDaysAway = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateFiveDaysAgo' AND outletIdNumber = '$userid' "; //die();
                      $transactionSixDaysAway = "SELECT * FROM " . $table . " WHERE transactionType='$transactionType' AND transactionDate = '$dateSixDaysAgo' AND outletIdNumber = '$userid' "; //die();

                }
                
                //Prepare the execution variable
                $executeToday = "executeToday".$transactionName; $executeOneDayAway = "executeOneDayAway".$transactionName; 
                $executeTwoDaysAway = "executeTwoDaysAway".$transactionName; $executeThreeDaysAway = "executeThreeDaysAway".$transactionName; 
                $executeFourDaysAway = "executeFourDaysAway".$transactionName; $executeFiveDaysAway = "executeFiveDaysAway".$transactionName; 
                $executeSixDaysAway = "executeSixDaysAway".$transactionName;
                
                
                //Now we execute all the transaction queries
                $executeToday = $this->Zf_AdoDB->Execute($transactionToday);
           $executeOneDayAway = $this->Zf_AdoDB->Execute($transactionOneDayAway);
          $executeTwoDaysAway = $this->Zf_AdoDB->Execute($transactionTwoDaysAway);
        $executeThreeDaysAway = $this->Zf_AdoDB->Execute($transactionThreeDaysAway);
         $executeFourDaysAway = $this->Zf_AdoDB->Execute($transactionFourDaysAway);
         $executeFiveDaysAway = $this->Zf_AdoDB->Execute($transactionFiveDaysAway);
          $executeSixDaysAway = $this->Zf_AdoDB->Execute($transactionSixDaysAway);
                
           
          //Check if all the queries executed sucessfully
                if (!$executeToday || !$executeOneDayAway || !$executeTwoDaysAway || !$executeThreeDaysAway || !$executeFourDaysAway || !$executeFiveDaysAway || !$executeSixDaysAway){

                  echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    //Prepare the count variables
                    $countToday = "countToday".$transactionName; $countOneDayAway = "countOneDayAway".$transactionName;
                    $countTwoDaysAway = "countTwoDaysAway".$transactionName; $countThreeDaysAway = "countThreeDaysAway".$transactionName;
                    $countFourDaysAway = "countFourDaysAway".$transactionName; $countFiveDaysAway = "countFiveDaysAway".$transactionName;
                    $countSixDaysAway = "countSixDaysAway".$transactionName;

                    //Count all the query outcomes
                            $countToday = $executeToday->RecordCount();
                       $countOneDayAway = $executeOneDayAway->RecordCount();
                      $countTwoDaysAway = $executeTwoDaysAway->RecordCount();
                    $countThreeDaysAway = $executeThreeDaysAway->RecordCount();
                     $countFourDaysAway = $executeFourDaysAway->RecordCount();
                     $countFiveDaysAway = $executeFiveDaysAway->RecordCount();
                      $countSixDaysAway = $executeSixDaysAway->RecordCount();

                }
        
                $strXML .="<dataset seriesName='".$transactionType."'>
                            <set  value='".$countSixDaysAway."' />
                            <set  value='".$countFiveDaysAway."' />
                            <set  value='".$countFourDaysAway."' />
                            <set  value='".$countThreeDaysAway."' />
                            <set  value='".$countTwoDaysAway."' /> 
                            <set  value='".$countOneDayAway."' /> 
                            <set  value='".$countToday."' />
                         </dataset>";
                   
               }
          
            }
             
            
        }
        
        $strXML .= "<styles>
                        <definition>
                           <style name='myLabelsFont' type='font' font='Verdana' size='8' color='575757' bold='1' underline='1'/>
                        </definition>
                        <application>
                           <apply toObject='DataLabels' styles='myLabelsFont' />
                        </application>
                     </styles>
                </chart>";

        $zf_chartData = array(

            "chartData"         => "$strXML",
            "chartType"         => "MSLine",
            "chartId"           => "allboundTransactions",
            "chartWidth"        => "100%",
            "chartHeight"       => 400,
            "chartDebug"        => "false",
            "registerJavacript" => "true",
            "chartTransparency" => ""

        );

        Zf_GenerateCharts::zf_generate_chart($zf_chartData, $chartPosition = "inline");
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * AGENCY TYPES INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchTransactionsTypeInformation(){
        
        $fetchAgencyTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_transactions_type_details', $zvss_sqlValue);
        
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
     * AGENCY TYPES INFORMATION
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
     * OUTLETS INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchOutletsInformation($outletCode){
        
        $zvss_sqlValue = Zf_QueryGenerator::SQLValue($outletCode);
        
        $fetchAgencyTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_details', $zvss_sqlValue);
        
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
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  This function works out and return the actual transaction dates                   |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    private function zf_getDates($awayDays = NULL){
        
        $zf_date_parameters = array(

            "original_date" => Zf_Core_Functions::Zf_CurrentDate(), //today
            //"date_mask" => "Y-m-d", //date mask should take the exact same format as the original date.
            "date_mask" => "d-m-Y", //date mask should take the exact same format as the original date.
            "date_action" => array(

                "what" => "d", //Accepted paramters are: years=>years, mos=>months, m=>months, weeks=>weeks, days=>days, d=>days, hrs.=>hours, h=>hours, min=>minutes, sec=>seconds
                "howMuch" => $awayDays //This is the number of days

            )

        );
        
        return $zf_date_parameters;
        
        
    }
    
    
    /**
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  This function works out and return the actual transaction times                   |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    private function zf_getTime($awayDays = NULL){
        
        $zf_date_parameters = array(

            "original_date" => Zf_Core_Functions::Zf_CurrentTime(), //today
            //"date_mask" => "Y-m-d", //date mask should take the exact same format as the original date.
            "date_mask" => "H:i:s", //date mask should take the exact same format as the original date.
            "date_action" => array(

                "what" => "mins", //Accepted paramters are: years=>years, mos=>months, m=>months, weeks=>weeks, days=>days, d=>days, hrs.=>hours, h=>hours, min=>minutes, sec=>seconds
                "howMuch" => $awayDays //This is the number of days

            )

        );
        
        return $zf_date_parameters;
        
        
    }
    
    
 

}

?>