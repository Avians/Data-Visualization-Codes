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

class MainDashboardStatistics_Model extends Zf_Model {
    
   
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
    * |  The is method for getting the total number of zippo outlets registered so far     |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function getNumberOfOutlets($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_outlet_details";
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $totalOutlets = "SELECT * FROM " . $table; //die();
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $totalOutlets = "SELECT * FROM " . $table . " WHERE outletIdNumber = '$userid' "; //die();
          
        } 
        
        
        $executeTotalOutlets = $this->Zf_AdoDB->Execute($totalOutlets);
        
        if (!$executeTotalOutlets){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
                      $totalOutletsCount = $executeTotalOutlets->RecordCount();
            
        }
        
        echo $totalOutletsCount;
        
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for getting the total amount of money transacted on Zippo           |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function getTotalAmount($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today);
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $totalAmount  = "SELECT SUM(transactionAmount) AS totalAmount FROM ". $table . " WHERE transactionDate = '$dateToday' "; //die
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $totalAmount  = "SELECT SUM(transactionAmount) AS totalAmount FROM ". $table . " WHERE transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
          
        } 
        
        
        $executeTotalAmount = $this->Zf_AdoDB->Execute($totalAmount);
        
        if (!$executeTotalAmount){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $totalAmountSum = $executeTotalAmount->fields['totalAmount'];
            
            if($totalAmountSum > 1000000){
                
                $totalAmountSumFinal = $totalAmountSum / 1000000;
                
                $formatedTotalAmountSum = Zf_Core_Functions::Zf_FormatMoney($totalAmountSumFinal);
                
            }else{
            
                $formatedTotalAmountSum = Zf_Core_Functions::Zf_FormatMoney($totalAmountSum);
                
            }
            
        }
        
        
        if($totalAmountSum > 1000000){
            
            echo $formatedTotalAmountSum."M <small style='font-size: 18px !important;'>Kshs</small>";
                
        }else{
            
            echo $formatedTotalAmountSum." <small style='font-size: 18px !important;'>Kshs</small>";
            
        }
            
        
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for getting the total amount of money transacted on Zippo           |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function getTotalCommissions($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today);
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $totalCommission  = "SELECT SUM(transactionCommission) AS totalCommissions FROM ". $table . " WHERE transactionDate = '$dateToday' "; //die
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $totalCommission  = "SELECT SUM(transactionCommission) AS totalCommissions FROM ". $table . " WHERE transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
          
        } 
        
        
        $executeTotalCommission = $this->Zf_AdoDB->Execute($totalCommission);
        
        if (!$executeTotalCommission){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $totalCommissionSum = $executeTotalCommission->fields['totalCommissions'];
            
            if($totalCommissionSum > 1000000){
                
                $totalCommissionSumFinal = $totalCommissionSum / 1000000;
                
                $formatedTotalCommissionSum = Zf_Core_Functions::Zf_FormatMoney($totalCommissionSumFinal);
                
            }else{
            
                $formatedTotalCommissionSum = Zf_Core_Functions::Zf_FormatMoney($totalCommissionSum);
                
            }
            
        }
        
        
        if($totalCommissionSum > 1000000){
            
            echo $formatedTotalCommissionSum."M <small style='font-size: 18px !important;'>Kshs</small>";
                
        }else{
            
            echo $formatedTotalCommissionSum." <small style='font-size: 18px !important;'>Kshs</small>";
            
        }
            
        
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for getting the total amount of money transacted on Zippo           |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function getDepositsCommissions($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today);
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $totalCommission  = "SELECT SUM(transactionCommission) AS totalCommissions FROM ". $table . " WHERE transactionType = 'Deposit' AND transactionDate = '$dateToday' "; //die
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $totalCommission  = "SELECT SUM(transactionCommission) AS totalCommissions FROM ". $table . " WHERE transactionType = 'Deposit' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
          
        } 
        
        
        $executeTotalCommission = $this->Zf_AdoDB->Execute($totalCommission);
        
        if (!$executeTotalCommission){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $totalCommissionSum = $executeTotalCommission->fields['totalCommissions'];
            
            if($totalCommissionSum > 1000000){
                
                $totalCommissionSumFinal = $totalCommissionSum / 1000000;
                
                $formatedTotalCommissionSum = Zf_Core_Functions::Zf_FormatMoney($totalCommissionSumFinal);
                
            }else{
            
                $formatedTotalCommissionSum = Zf_Core_Functions::Zf_FormatMoney($totalCommissionSum);
                
            }
            
        }
        
        
        if($totalCommissionSum > 1000000){
            
            echo $formatedTotalCommissionSum."M";
                
        }else{
            
            echo $formatedTotalCommissionSum;
            
        }
            
        
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for getting the total amount of money transacted on Zippo           |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function getWithdrawalsCommissions($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today);
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $totalCommission  = "SELECT SUM(transactionCommission) AS totalCommissions FROM ". $table . " WHERE transactionType = 'Withdrawal' AND transactionDate = '$dateToday' "; //die
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $totalCommission  = "SELECT SUM(transactionCommission) AS totalCommissions FROM ". $table . " WHERE transactionType = 'Withdrawal' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
          
        } 
        
        
        $executeTotalCommission = $this->Zf_AdoDB->Execute($totalCommission);
        
        if (!$executeTotalCommission){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $totalCommissionSum = $executeTotalCommission->fields['totalCommissions'];
            
            if($totalCommissionSum > 1000000){
                
                $totalCommissionSumFinal = $totalCommissionSum / 1000000;
                
                $formatedTotalCommissionSum = Zf_Core_Functions::Zf_FormatMoney($totalCommissionSumFinal);
                
            }else{
            
                $formatedTotalCommissionSum = Zf_Core_Functions::Zf_FormatMoney($totalCommissionSum);
                
            }
            
        }
        
        
        if($totalCommissionSum > 1000000){
            
            echo $formatedTotalCommissionSum."M";
                
        }else{
            
            echo $formatedTotalCommissionSum;
            
        }
            
        
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for getting the total number of zippo outlets registered so far     |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function getNumberOfTransactions($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today);
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $totalTransactions = "SELECT * FROM " . $table . " WHERE transactionDate = '$dateToday' "; //die();
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $totalTransactions = "SELECT * FROM " . $table . " WHERE transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
          
        } 
        
        
        $executeTotalTransactions  = $this->Zf_AdoDB->Execute($totalTransactions);
        
        if (!$executeTotalTransactions){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
                      $totalTransactionsCount = $executeTotalTransactions->RecordCount();
            
        }
        
        echo $totalTransactionsCount;
        
        
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for getting the total amount of money deposited to Zippo            |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function getTotalDeposits($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today);
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $totalAmount  = "SELECT SUM(transactionAmount) AS totalAmount FROM ". $table . " WHERE transactionType = 'Deposit' AND transactionDate = '$dateToday' "; //die
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $totalAmount  = "SELECT SUM(transactionAmount) AS totalAmount FROM ". $table . " WHERE transactionType = 'Deposit' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
          
        } 
        
        
        $executeTotalAmount = $this->Zf_AdoDB->Execute($totalAmount);
        
        if (!$executeTotalAmount){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $totalAmountSum = $executeTotalAmount->fields['totalAmount'];
            
            $formatedTotalAmountSum = Zf_Core_Functions::Zf_FormatMoney($totalAmountSum);
            
        }
        
        echo $formatedTotalAmountSum;
        
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for getting the total amount of money withdrawn form Zippo          |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function getTotalWithdrawals($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today);
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $totalAmount  = "SELECT SUM(transactionAmount) AS totalAmount FROM ". $table . " WHERE transactionType = 'Withdrawal' AND transactionDate = '$dateToday' "; //die
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $totalAmount  = "SELECT SUM(transactionAmount) AS totalAmount FROM ". $table . " WHERE transactionType = 'Withdrawal' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
          
        } 
        
        
        $executeTotalAmount = $this->Zf_AdoDB->Execute($totalAmount);
        
        if (!$executeTotalAmount){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $totalAmountSum = $executeTotalAmount->fields['totalAmount'];
            
            $formatedTotalAmountSum = Zf_Core_Functions::Zf_FormatMoney($totalAmountSum);
            
        }
        
        echo $formatedTotalAmountSum;
        
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for getting the total amount of inbound money transferred on Zippo  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function getTotalInboundTransfer($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today);
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $totalAmount  = "SELECT SUM(transactionAmount) AS totalAmount FROM ". $table . " WHERE transactionType = 'Inbound Transfer' AND transactionDate = '$dateToday' "; //die
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $totalAmount  = "SELECT SUM(transactionAmount) AS totalAmount FROM ". $table . " WHERE transactionType = 'Inbound Transfer' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
          
        } 
        
        
        $executeTotalAmount = $this->Zf_AdoDB->Execute($totalAmount);
        
        if (!$executeTotalAmount){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $totalAmountSum = $executeTotalAmount->fields['totalAmount'];
            
            $formatedTotalAmountSum = Zf_Core_Functions::Zf_FormatMoney($totalAmountSum);
            
        }
        
        echo $formatedTotalAmountSum;
        
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for getting the total amount of inbound money transferred on Zippo  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function getTotalOutboundTransfer($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today);
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $totalAmount  = "SELECT SUM(transactionAmount) AS totalAmount FROM ". $table . " WHERE transactionType = 'Outbound Transfer' AND transactionDate = '$dateToday' "; //die
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $totalAmount  = "SELECT SUM(transactionAmount) AS totalAmount FROM ". $table . " WHERE transactionType = 'Outbound Transfer' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
          
        } 
        
        
        $executeTotalAmount = $this->Zf_AdoDB->Execute($totalAmount);
        
        if (!$executeTotalAmount){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $totalAmountSum = $executeTotalAmount->fields['totalAmount'];
            
            $formatedTotalAmountSum = Zf_Core_Functions::Zf_FormatMoney($totalAmountSum);
            
        }
        
        echo $formatedTotalAmountSum;
        
    }
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for getting the total amount of inbound money transferred on Zippo  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function getTotalPartnersTransactions($viewType = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today);
        
        
        //Returns the array values of agency types
        $agencyTypesResults = $this->fetchAgencyTypesInformation();
        
         $transactions_types = '';
        
        if($agencyTypesResults == 0){
            
             $transactions_types .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Transaction Types Error!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There is probable data inconsistency. Cannot load data.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
            foreach ($agencyTypesResults as $value) {
                
                $partnerTypeName =  $value['agencyTypeName']; $agencyTypeCode = $value['agencyTypeCode'];
               
                if($viewType == "tabs"){
                    
                    $transactions_types .='<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 margin-bottom-10 indictaors-wrapper">';
                    
                }else{
                    
                    $transactions_types .='<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-10 indictaors-wrapper">';
                    
                }
                
                
                                                
                        //Prepare the query parameters

                        if($application_user == ZIPPO_PLATFORM_ADMIN){

                            $totalAmount  = "SELECT SUM(transactionAmount) AS totalAmount FROM ". $table . " WHERE agencyTypeCode = '$agencyTypeCode' AND transactionDate = '$dateToday' "; //die
                               
                            $totalDepositCount  = "SELECT * FROM " . $table . " WHERE agencyTypeCode = '$agencyTypeCode' AND transactionType = 'Deposit' AND transactionDate = '$dateToday' "; //die
                            $totalWithdrawalCount  = "SELECT * FROM " . $table . " WHERE agencyTypeCode = '$agencyTypeCode' AND transactionType = 'Withdrawal' AND transactionDate = '$dateToday' ";//die

                            
                            $totalTransactions = "SELECT * FROM " . $table . " WHERE agencyTypeCode = '$agencyTypeCode' AND transactionDate = '$dateToday' "; //die();
                            
                        }else if($application_user == ZIPPO_OUTLET_STAFF){

                            $totalAmount  = "SELECT SUM(transactionAmount) AS totalAmount FROM ". $table . " WHERE agencyTypeCode = '$agencyTypeCode' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
                            
                                
                            $totalDepositCount  = "SELECT * FROM " . $table . " WHERE agencyTypeCode = '$agencyTypeCode' AND transactionType = 'Deposit' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die
                            $totalWithdrawalCount  = "SELECT * FROM " . $table . " WHERE agencyTypeCode = '$agencyTypeCode' AND transactionType = 'Withdrawal' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die

                            
                            $totalTransactions = "SELECT * FROM " . $table . " WHERE agencyTypeCode = '$agencyTypeCode' AND  transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die();
                            
                        } 
                        
                        $executeTotalAmount = $this->Zf_AdoDB->Execute($totalAmount);
                        $executeTotalTransactions  = $this->Zf_AdoDB->Execute($totalTransactions);
                        
                        
                        $executeTotalDepositCount = $this->Zf_AdoDB->Execute($totalDepositCount);
                        $executeTotalWithdrawalCount = $this->Zf_AdoDB->Execute($totalWithdrawalCount); 
        
                        if (!$executeTotalAmount || !$executeTotalDepositCount || !$executeTotalWithdrawalCount || !$executeTotalTransactions){

                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                        }else{

                            $totalAmountSum = $executeTotalAmount->fields['totalAmount'];
                            $totalTransactionsCount = $executeTotalTransactions->RecordCount();
                            $totalTransactionsDepositCount = $executeTotalDepositCount->RecordCount();
                            $totalTransactionsWithdrawalCount = $executeTotalWithdrawalCount->RecordCount();
                            
                            $depositPercentage = ($totalTransactionsDepositCount/$totalTransactionsCount)*100;
                            $withdrawalPercentage = ($totalTransactionsWithdrawalCount/$totalTransactionsCount)*100;

                            $formatedTotalAmountSum = Zf_Core_Functions::Zf_FormatMoney($totalAmountSum, 2, 1);

                        }
                        
                        $transactions_types .='
                                                <div class="top-content-wrapper">
                                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12" style="min-height: 85px !important;">
                                                        <div class="amountWrapper">'.$formatedTotalAmountSum.' <span>Kshs</span></div>
                                                        <div class="clearfix"></div>
                                                        <div class="descriptionWrapper">'.$partnerTypeName.' Totals</div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 depositWithdrawMainWrappers">
                                                        <div class="depositWithdrawInnerWrappers">D: '.round($depositPercentage,1).'%</div>
                                                        <div class="clearfix"></div>
                                                        <div class="depositWithdrawInnerWrappers">W: '.round($withdrawalPercentage,1).'%</div>
                                                    </div>
                                                </div>
                                                <div class="footer-datials">
                                                    No. of Transactions: <span>'.$totalTransactionsCount.'</span>
                                                </div>
                                            </div>';

                        //$transactions_types .= $formatedTotalAmountSum;
                                                    
                  $transactions_types .= '';
                
            }
        
        }
        
        echo $transactions_types;
        
    }

    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR GETTING THE GENERAL 
     * PARTNERSHIP SUMMARY.
     * -------------------------------------------------------------------------
     */
    public function getPartnershipSummary(){
        
       $application_user = $this->identifictionArray[3];
       
       $table = "zvss_new_transaction";
       
       //Return the values of agency types
       $agencyTypesResults = $this->fetchAgencyTypesInformation();
 
       $dateFormat = 'Y-m-d';
       $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
       $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today); 
       //print_r($agencyTypesResults);
        
        $agency_types = "";
        
        if($agencyTypesResults == 0){
            
             $agency_types .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Vendor Summary Overview Warning!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There are no vendor types and vendors yet! You need to add atleast one vendor type and a vendor to have an overview.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
             $agency_types .= '<div class="row">';
            
            foreach ($agencyTypesResults as  $value) {
                
                $agencyTypeName = $value['agencyTypeName']; $agencyTypeCode =  $value['agencyTypeCode'];
                
                $agencyTypeEntities = $this->fetchAgencyEntitesInformation($agencyTypeCode);
                
                
                 $agency_types .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-15">
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
                                                       
                                                         $agency_types .= '<span class="content-view-errors" >No agency entities have been created in <strong>'.$agencyTypeName.'</strong> yet.</span>';
                                                        
                                                    }else{
                                                        
                                                         $agency_types .= '<table class="table table-striped table-bordered table-hover"><thead>';
                                                         
                                                                                
                                                                            $agency_types .= '<tr  style="text-align: center !important;">
                                                                                      <th>Vendor Name</th><th>Transaction Date</th><th>Deposits</th><th>Withdrawals</th><th>Totals</th>
                                                                                 </tr>
                                                                                 </thead><tbody>';
                                                        
                                                                                foreach ($agencyTypeEntities as $value) {

                                                                                    $agencyEntityName = $value['agencyEntityName']; $dateOfCreation =  $value['dateOfCreation'];
                                                                                    $agencyEntityCode = $value['agencyEntityCode'];
                                                                                  
                                                                                     
                                                                                //Write queries for others non than MTS
                                                                                if($application_user == ZIPPO_PLATFORM_ADMIN){

                                                                                    $totalDepositAmount  = "SELECT SUM(transactionAmount) AS totalDepositAmount FROM ". $table . " WHERE agencyEntityCode = '$agencyEntityCode' AND transactionType = 'Deposit' AND transactionDate = '$dateToday' "; //die
                                                                                    $totalDepositTransactions = "SELECT * FROM " . $table . " WHERE agencyEntityCode = '$agencyEntityCode' AND transactionType = 'Deposit' AND transactionDate = '$dateToday' "; //die();

                                                                                    $totalWithdrawalAmount  = "SELECT SUM(transactionAmount) AS totalWithdrawalAmount FROM ". $table . " WHERE agencyEntityCode = '$agencyEntityCode' AND transactionType = 'Withdrawal' AND transactionDate = '$dateToday' "; //die
                                                                                    $totalWithdrawalTransactions = "SELECT * FROM " . $table . " WHERE agencyEntityCode = '$agencyEntityCode' AND transactionType = 'Withdrawal' AND transactionDate = '$dateToday' "; //die();


                                                                                }else if($application_user == ZIPPO_OUTLET_STAFF){

                                                                                    $totalDepositAmount  = "SELECT SUM(transactionAmount) AS totalDepositAmount FROM ". $table . " WHERE agencyEntityCode = '$agencyEntityCode' AND transactionType = 'Deposit' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
                                                                                    $totalDepositTransactions = "SELECT * FROM " . $table . " WHERE agencyEntityCode = '$agencyEntityCode' AND  transactionDate = '$dateToday' AND transactionType = 'Deposit' AND outletIdNumber = '$userid'  "; //die();

                                                                                    $totalWithdrawalAmount  = "SELECT SUM(transactionAmount) AS totalWithdrawalAmount FROM ". $table . " WHERE agencyEntityCode = '$agencyEntityCode' AND transactionType = 'Withdrawal' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();
                                                                                    $totalWithdrawalTransactions = "SELECT * FROM " . $table . " WHERE agencyEntityCode = '$agencyEntityCode' AND transactionType = 'Withdrawal' AND  transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die();

                                                                                } 

                                                                                $executeTotalDepositAmount = $this->Zf_AdoDB->Execute($totalDepositAmount);
                                                                                $executeTotalDepositTransactions  = $this->Zf_AdoDB->Execute($totalDepositTransactions);

                                                                                $executeTotalWithdrawalAmount = $this->Zf_AdoDB->Execute($totalWithdrawalAmount);
                                                                                $executeTotalWithdrawalTransactions  = $this->Zf_AdoDB->Execute($totalWithdrawalTransactions);

                                                                                if (!$executeTotalDepositAmount || !$executeTotalDepositTransactions || !$executeTotalWithdrawalAmount || !$executeTotalWithdrawalTransactions){

                                                                                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                                                                                }else{

                                                                                    $totalAmountDepositSum = $executeTotalDepositAmount->fields['totalDepositAmount'];
                                                                                    $totalDepositTransactionsCount = $executeTotalDepositTransactions->RecordCount();

                                                                                    $totalAmountWithdrawalSum = $executeTotalWithdrawalAmount->fields['totalWithdrawalAmount'];
                                                                                    $totalWithdrawalTransactionsCount = $executeTotalWithdrawalTransactions->RecordCount();

                                                                                    $formatedTotalDepositAmountSum = Zf_Core_Functions::Zf_FormatMoney($totalAmountDepositSum);
                                                                                    $formatedTotalWithdrawalAmountSum = Zf_Core_Functions::Zf_FormatMoney($totalAmountWithdrawalSum);

                                                                                    $formatedGrandTotalSum = Zf_Core_Functions::Zf_FormatMoney($totalAmountDepositSum + $totalAmountWithdrawalSum);
                                                                                    $totalTransactionCount = $totalDepositTransactionsCount + $totalWithdrawalTransactionsCount;

                                                                                }
                                                                                     
                                                                                    

                                                                                     $agency_types .= '<tr>
                                                                                                        <td style="vertical-align: middle !important;">'.$agencyEntityName.'</td>
                                                                                                        <td style="vertical-align: middle !important;">'.$dateToday.'</td> 
                                                                                                        <td>
                                                                                                            <div style="width: 111% !important; margin-left: -6% !important;">
                                                                                                                <table style="width: 105% !important; text-align: center !important;">
                                                                                                                    <tr style="border-bottom: 1px solid #ddd;"><td style="padding-bottom: 5px !important; font-size: 14px !important; color: #21b4e2 !important;">'.$formatedTotalDepositAmountSum.' Kshs</td></tr>
                                                                                                                    <tr><td style="padding-top: 5px !important; font-size: 13px !important; color: #a94442 !important;">'.$totalDepositTransactionsCount.':Transactions</td></tr>
                                                                                                                </table>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div style="width: 111% !important; margin-left: -6% !important;">
                                                                                                                <table style="width: 105% !important; text-align: center !important;">
                                                                                                                    <tr style="border-bottom: 1px solid #ddd;"><td style="padding-bottom: 5px !important; font-size: 14px !important; color: #21b4e2 !important;">'.$formatedTotalWithdrawalAmountSum.' Kshs</td></tr>
                                                                                                                    <tr><td style="padding-top: 5px !important; font-size: 13px !important; color: #a94442 !important;">'.$totalWithdrawalTransactionsCount.':Transactions</td></tr>
                                                                                                                </table>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                        <td>
                                                                                                            <div style="width: 111% !important; margin-left: -6% !important;">
                                                                                                                <table style="width: 105% !important; text-align: center !important;">
                                                                                                                    <tr style="border-bottom: 1px solid #ddd;"><td style="padding-bottom: 5px !important; font-size: 14px !important; color: #21b4e2 !important;">'.$formatedGrandTotalSum.' Kshs</td></tr>
                                                                                                                    <tr><td style="padding-top: 5px !important; font-size: 13px !important; color: #a94442 !important;">'.$totalTransactionCount.':Transactions</td></tr>
                                                                                                                </table>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr>';

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
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR GETTING THE GENERAL 
     * OUTLET SUMMARY by transactions.
     * -------------------------------------------------------------------------
     */
    public function getAllOutletSummaryTransactions(){
        
       $application_user = $this->identifictionArray[3]; 
       
       //Return the values of all outlets
       $outletsResults = $this->fetchOutletsInformation();
 
        
       $table = "zvss_new_transaction";
 
       $dateFormat = 'Y-m-d';
       $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
       $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today);
        
        $outlets_views = "";
        
        if($outletsResults == 0){
            
             $outlets_views .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Outlet Summary Warning!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There are no outlet types yet! You need to add atleast one outlet to have an overview.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
            $outlets_views .= '<div class="row">';
            
            foreach ($outletsResults as  $value) {
                
                $outletLocation = $value['outletLocation']; $outletArea =  $value['outletArea']; $outletName = $outletArea." (".$outletLocation.")";
                $outletCode = $value['outletCode'];
                
                $transactionInformation = $this->fetchTransactionsInformation($outletCode);
                
                $transactionTypeInformation = $this->fetchTransactionsTypeInformation();
                
                
                 $outlets_views .= '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-bottom-15">
                                        <div class="school-content-wrapper" style="max-height:200px !important;">
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <h3>'.$outletName.'</h3>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="school-class-inner-content scroller"  data-always-visible="1" data-rail-visible="0">
                                                <div class="table-responsive" style="margin-right: 5px !important;">
                                                    ';
                                                        
                                                    if($transactionInformation == 0){
                                                       
                                                         $outlets_views .= '<span class="content-view-errors" >No transactions yet in <strong>'.$outletName.'</strong> for today.</span>';
                                                        
                                                    }else{
                                                        
                                                         $outlets_views .= '<table class="table table-striped table-bordered table-hover">
                                                                                <thead>
                                                                                        <tr>
                                                                                                <th>Transaction Particulars</th><th>Amount (Kshs)</th><th>Transactions</th>
                                                                                        </tr>
                                                                                </thead>
                                                                                <tbody>';
                                                        
                                                                                foreach ($transactionTypeInformation as $value) {
                                                                                    
                                                                                    //Prepare the variable for the transaction Column name
                                                                                    $transactionTypeName = $value['transactionTypeName'];
                                                                                    
                                                                                    $amountColumn = lcfirst(Zf_Core_Functions::Zf_CleanName("total".$transactionTypeName."Amount"));
                                                                                    
                                                                                    //Generate the SQL queries and the execute each query
                                                                                    if($application_user == ZIPPO_PLATFORM_ADMIN){

                                                                                        $totalTransactionAmount  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND transactionType = '$transactionTypeName' AND transactionDate = '$dateToday' "; //die
                                                                                        $totalTransactionCount = "SELECT * FROM " . $table . " WHERE outletCode = '$outletCode' AND transactionType = '$transactionTypeName' AND transactionDate = '$dateToday' "; //die();

                                                                                    }else if($application_user == ZIPPO_OUTLET_STAFF){
                                                                                        
                                                                                        $totalTransactionAmount  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND transactionType = '$transactionTypeName' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die
                                                                                        $totalTransactionCount = "SELECT * FROM " . $table . " WHERE outletCode = '$outletCode' AND transactionType = '$transactionTypeName' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die();

                                                                                    }
                                                                                    
                                                                                            $executeTotalTransactionAmount = $this->Zf_AdoDB->Execute($totalTransactionAmount);
                                                                                            $executeTotalTransactionCount  = $this->Zf_AdoDB->Execute($totalTransactionCount);

                                                                                            if (!$executeTotalTransactionAmount || !$executeTotalTransactionCount){

                                                                                                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                                                                                            }else{

                                                                                                $totalTransactionsSum = $executeTotalTransactionAmount->fields[$amountColumn];
                                                                                                $totalTransactionsCount = $executeTotalTransactionCount->RecordCount();

                                                                                                $formatedTotalTransactionsSum = Zf_Core_Functions::Zf_FormatMoney($totalTransactionsSum);

                                                                                            }

                                                                                    $outlets_views .= '<tr><td>'.$transactionTypeName.'</td>'
                                                                                            . '<td style="text-align:right; padding-right: 10px !important; color: #21b4e2 !important;">'.$formatedTotalTransactionsSum.'</td>'
                                                                                            . '<td class="content-table-flags" style="text-align:center;">'.$totalTransactionsCount.'</td>'
                                                                                            . '</tr>';

                                                                                }
                                                                                
                                                                                
                                                                                //Generate the SQL queries and the execute each query
                                                                                    if($application_user == ZIPPO_PLATFORM_ADMIN){

                                                                                        $totalTransactionAmount  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND transactionDate = '$dateToday' "; //die
                                                                                        $totalTransactionCount = "SELECT * FROM " . $table . " WHERE outletCode = '$outletCode' AND transactionDate = '$dateToday' "; //die();

                                                                                    }else if($application_user == ZIPPO_OUTLET_STAFF){
                                                                                        
                                                                                        $totalTransactionAmount  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die
                                                                                        $totalTransactionCount = "SELECT * FROM " . $table . " WHERE outletCode = '$outletCode' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die();

                                                                                    }
                                                                                    
                                                                                    $executeTotalTransactionAmount = $this->Zf_AdoDB->Execute($totalTransactionAmount);
                                                                                    $executeTotalTransactionCount  = $this->Zf_AdoDB->Execute($totalTransactionCount);

                                                                                    if (!$executeTotalTransactionAmount || !$executeTotalTransactionCount){

                                                                                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                                                                                    }else{

                                                                                        $totalTransactionsSum = $executeTotalTransactionAmount->fields[$amountColumn];
                                                                                        $totalTransactionsCount = $executeTotalTransactionCount->RecordCount();

                                                                                        $formatedTotalTransactionsSum = Zf_Core_Functions::Zf_FormatMoney($totalTransactionsSum);

                                                                                    }
                                                                                
                                                                                
                                                        
                                                            $outlets_views .= '</tbody>
                                                                                <tfoot>
                                                                                        <tr>
                                                                                                <th>Totals</th>
                                                                                                <th style="text-align:right; padding-right: 10px !important; color: #21b4e2 !important;">'.$formatedTotalTransactionsSum.'</th>'
                                                                                             . '<th class="content-table-flags" style="text-align:center;">'.$totalTransactionsCount.'</th>
                                                                                        </tr>
                                                                                </tfoot>
                                                                            </table>';
                                                        
                                                    }
               
                $outlets_views .= '</div>
                                        
                                      </div>
                                      <div class="clearfix  margin-bottom-5"></div>
                                     </div>
                                  </div>';
                
            }
            
             $outlets_views .= '</div>';
            
        }
        
        echo  $outlets_views;
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR GETTING THE GENERAL 
     * OUTLET SUMMARY by partners.
     * -------------------------------------------------------------------------
     */
    public function getAllOutletSummaryPartners(){
        
       $application_user = $this->identifictionArray[3]; 
       
       //Return the values of all outlets
       $outletsResults = $this->fetchOutletsInformation();
 
        
       $table = "zvss_new_transaction";
 
        $dateFormat = 'Y-m-d';
        $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today); 
        
        $outlets_views = "";
        
        if($outletsResults == 0){
            
             $outlets_views .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Outlet Summary Warning!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There are no outlet types yet! You need to add atleast one outlet to have an overview.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
            $outlets_views .= '<div class="row">';
            
            foreach ($outletsResults as  $value) {
                
                $outletLocation = $value['outletLocation']; $outletArea =  $value['outletArea']; $outletName = $outletArea." (".$outletLocation.")";
                $outletCode = $value['outletCode'];
                
                $transactionInformation = $this->fetchTransactionsInformation($outletCode);
                
                $agencyTypeInformation = $this->fetchAgencyTypesInformation();
                
                
                 $outlets_views .= '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-bottom-15">
                                        <div class="school-content-wrapper">
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <h3>'.$outletName.'</h3>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="school-class-inner-content scroller"  data-always-visible="1" data-rail-visible="0">
                                                <div class="table-responsive" style="margin-right: 5px !important;">
                                                    ';
                                                        
                                                    if($transactionInformation == 0){
                                                       
                                                         $outlets_views .= '<span class="content-view-errors" >No transactions yet in <strong>'.$outletName.'</strong> for today.</span>';
                                                        
                                                    }else{
                                                        
                                                         $outlets_views .= '<table class="table table-striped table-bordered table-hover">
                                                                                <thead>
                                                                                        <tr>
                                                                                                <th>Partners</th><th>Deposits</th><th>Withdrawals</th><th>Trans. No.</th>
                                                                                        </tr>
                                                                                </thead>
                                                                                <tbody>';
                                                        
                                                                                foreach ($agencyTypeInformation as $value) {
                                                                                    
                                                                                    //Prepare the variable for the transaction Column name
                                                                                    $agencyTypeName = $value['agencyTypeName']; $agencyTypeCode = $value['agencyTypeCode'];
                                                                                    
                                                                                    $amountColumn = lcfirst(Zf_Core_Functions::Zf_CleanName("total".$agencyTypeName."Amount"));
                                                                                    
                                                                                    if($agencyTypeName != "MTS"){
                                                                                        
                                                                                        //Generate the SQL queries and the execute each query
                                                                                        if($application_user == ZIPPO_PLATFORM_ADMIN){

                                                                                            $totalTransactionAmountDeposit  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND agencyTypeCode = '$agencyTypeCode' AND transactionType = 'Deposit' AND transactionDate = '$dateToday' "; //die
                                                                                            $totalTransactionAmountWithdrawal  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND agencyTypeCode = '$agencyTypeCode' AND transactionType = 'Withdrawal' AND transactionDate = '$dateToday' "; //die
                                                                                            $totalTransactionCount = "SELECT * FROM " . $table . " WHERE outletCode = '$outletCode' AND agencyTypeCode = '$agencyTypeCode' AND transactionDate = '$dateToday' "; //die();

                                                                                        }else if($application_user == ZIPPO_OUTLET_STAFF){

                                                                                            $totalTransactionAmountDeposit  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND agencyTypeCode = '$agencyTypeCode' AND transactionType = 'Deposit' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die
                                                                                            $totalTransactionAmountWithdrawal  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND agencyTypeCode = '$agencyTypeCode' AND transactionType = 'Withdrawal' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die
                                                                                            $totalTransactionCount = "SELECT * FROM " . $table . " WHERE outletCode = '$outletCode' AND agencyTypeCode = '$agencyTypeCode' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();

                                                                                        }
                                                                                        
                                                                                    }else if($agencyTypeName == "MTS"){
                                                                                        
                                                                                        //Generate the SQL queries and the execute each query
                                                                                        if($application_user == ZIPPO_PLATFORM_ADMIN){

                                                                                            $totalTransactionAmountDeposit  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND agencyTypeCode = '$agencyTypeCode' AND transactionType = 'Inbound Transfer' AND transactionDate = '$dateToday' "; //die
                                                                                            $totalTransactionAmountWithdrawal  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND agencyTypeCode = '$agencyTypeCode' AND transactionType = 'Outbound Transfer' AND transactionDate = '$dateToday' "; //die
                                                                                            $totalTransactionCount = "SELECT * FROM " . $table . " WHERE outletCode = '$outletCode' AND agencyTypeCode = '$agencyTypeCode' AND transactionDate = '$dateToday' "; //die();

                                                                                        }else if($application_user == ZIPPO_OUTLET_STAFF){

                                                                                            $totalTransactionAmountDeposit  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND agencyTypeCode = '$agencyTypeCode' AND transactionType = 'Inbound Transfer' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die
                                                                                            $totalTransactionAmountWithdrawal  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND agencyTypeCode = '$agencyTypeCode' AND transactionType = 'Outbound Transfer' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die
                                                                                            $totalTransactionCount = "SELECT * FROM " . $table . " WHERE outletCode = '$outletCode' AND agencyTypeCode = '$agencyTypeCode' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();

                                                                                        }
                                                                                        
                                                                                    }
                                                                                    
                                                                                    $executeTotalTransactionAmountDeposit = $this->Zf_AdoDB->Execute($totalTransactionAmountDeposit);
                                                                                    $executeTotalTransactionAmountWithdrawal = $this->Zf_AdoDB->Execute($totalTransactionAmountWithdrawal);
                                                                                    $executeTotalTransactionCount  = $this->Zf_AdoDB->Execute($totalTransactionCount);

                                                                                    if (!$executeTotalTransactionAmountDeposit || !$executeTotalTransactionAmountWithdrawal || !$executeTotalTransactionCount){

                                                                                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                                                                                    }else{

                                                                                        $totalTransactionsSumDeposit = $executeTotalTransactionAmountDeposit->fields[$amountColumn];
                                                                                        $totalTransactionsSumWithdrawal = $executeTotalTransactionAmountWithdrawal->fields[$amountColumn];
                                                                                        $totalTransactionsCount = $executeTotalTransactionCount->RecordCount();
                                                                                        

                                                                                        $formatedTotalTransactionsSumDeposit = Zf_Core_Functions::Zf_FormatMoney($totalTransactionsSumDeposit);
                                                                                        $formatedTotalTransactionsSumWithdrawal = Zf_Core_Functions::Zf_FormatMoney($totalTransactionsSumWithdrawal);

                                                                                    }

                                                                                    $outlets_views .= '<tr><td>'.$agencyTypeName.'</td>'
                                                                                            . '<td style="text-align:right; padding-right: 10px !important; color: #21b4e2 !important;">'.$formatedTotalTransactionsSumDeposit.'</td>'
                                                                                            . '<td style="text-align:right; padding-right: 10px !important; color: #21b4e2 !important;">'.$formatedTotalTransactionsSumWithdrawal.'</td>'
                                                                                            . '<td class="content-table-flags" style="text-align:center;">'.$totalTransactionsCount.'</td>'
                                                                                            . '</tr>';

                                                                                }
                                                                                
                                                                                foreach ($agencyTypeInformation as $value) {
                                                                                    
                                                                                    $totalSum = array();
                                                                                    
                                                                                    //Prepare the variable for the transaction Column name
                                                                                    $agencyTypeName = $value['agencyTypeName']; $agencyTypeCode = $value['agencyTypeCode'];
                                                                                    
                                                                                    $amountColumn = lcfirst(Zf_Core_Functions::Zf_CleanName("total".$agencyTypeName."Amount"));
                                                                                    
                                                                                    //echo $agencyTypeName."<br>";
                                                                                    
                                                                                    if($agencyTypeName != "MTS"){

                                                                                        //Generate the SQL queries and the execute each query
                                                                                        if($application_user == ZIPPO_PLATFORM_ADMIN){

                                                                                            $totalTransactionAmountDeposit  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND transactionType = 'Deposit' AND transactionDate = '$dateToday' "; //die
                                                                                            $totalTransactionAmountWithdrawal  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND transactionType = 'Withdrawal' AND transactionDate = '$dateToday' "; //die
                                                                                            $totalTransactionCount = "SELECT * FROM " . $table . " WHERE outletCode = '$outletCode' AND transactionDate = '$dateToday' "; //die();

                                                                                        }else if($application_user == ZIPPO_OUTLET_STAFF){

                                                                                            $totalTransactionAmountDeposit  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND transactionType = 'Deposit' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die
                                                                                            $totalTransactionAmountWithdrawal  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND transactionType = 'Withdrawal' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die
                                                                                            $totalTransactionCount = "SELECT * FROM " . $table . " WHERE outletCode = '$outletCode' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();

                                                                                        }

                                                                                    }else{

                                                                                        //Generate the SQL queries and the execute each query
                                                                                        if($application_user == ZIPPO_PLATFORM_ADMIN){

                                                                                            $totalTransactionAmountDeposit  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND transactionType = 'Inbound Transfer' AND transactionDate = '$dateToday' "; //die
                                                                                            $totalTransactionAmountWithdrawal  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND transactionType = 'Outbound Transfer' AND transactionDate = '$dateToday' "; //die
                                                                                            $totalTransactionCount = "SELECT * FROM " . $table . " WHERE outletCode = '$outletCode' AND transactionDate = '$dateToday' "; //die();

                                                                                        }else if($application_user == ZIPPO_OUTLET_STAFF){

                                                                                            $totalTransactionAmountDeposit  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND transactionType = 'Inbound Transfer' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die
                                                                                            $totalTransactionAmountWithdrawal  = "SELECT SUM(transactionAmount) AS ".$amountColumn." FROM ". $table . " WHERE outletCode = '$outletCode' AND transactionType = 'Outbound Transfer' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid'  "; //die
                                                                                            $totalTransactionCount = "SELECT * FROM " . $table . " WHERE outletCode = '$outletCode' AND transactionDate = '$dateToday' AND outletIdNumber = '$userid' "; //die();

                                                                                        }

                                                                                    }
                                                                                    
                                                                                    //echo $totalTransactionAmountDeposit."<br>";

                                                                                    $executeTotalTransactionAmountDeposit = $this->Zf_AdoDB->Execute($totalTransactionAmountDeposit);
                                                                                    $executeTotalTransactionAmountWithdrawal = $this->Zf_AdoDB->Execute($totalTransactionAmountWithdrawal);
                                                                                    $executeTotalTransactionCount  = $this->Zf_AdoDB->Execute($totalTransactionCount);

                                                                                    if (!$executeTotalTransactionAmountDeposit || !$executeTotalTransactionAmountWithdrawal || !$executeTotalTransactionCount){

                                                                                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                                                                                    }else{

                                                                                        $totalTransactionsSumDeposit = $executeTotalTransactionAmountDeposit->fields[$amountColumn];
                                                                                        $totalTransactionsSumWithdrawal = $executeTotalTransactionAmountWithdrawal->fields[$amountColumn];
                                                                                        $totalTransactionsCount = $executeTotalTransactionCount->RecordCount();


                                                                                        $formatedTotalTransactionsSumDeposit = Zf_Core_Functions::Zf_FormatMoney($totalTransactionsSumDeposit);
                                                                                        $formatedTotalTransactionsSumWithdrawal = Zf_Core_Functions::Zf_FormatMoney($totalTransactionsSumWithdrawal);
                                                                                        
                                                                                    }
                                                                                    
                                                                                    $totalSum[] = $formatedTotalTransactionsSumDeposit;
                                                                                    
                                                                                    //echo $formatedTotalTransactionsSumDeposit."<br>"; 
                                                                                    
                                                                                   
                                                                                }
                                                                                
                                                                                //print_r($totalSum);
                                                                                
                                                        
                                                            $outlets_views .= '</tbody>
                                                                                <tfoot>
                                                                                        <tr>
                                                                                                <th>Totals</th>
                                                                                                <th style="text-align:right; padding-right: 10px !important; color: #21b4e2 !important;">'.$formatedTotalTransactionsSumDeposit.'</th>'
                                                                                             . '<th style="text-align:right; padding-right: 10px !important; color: #21b4e2 !important;">'.$formatedTotalTransactionsSumWithdrawal.'</th>'
                                                                                             . '<th class="content-table-flags" style="text-align:center;">'.$totalTransactionsCount.'</th>
                                                                                        </tr>
                                                                                </tfoot>
                                                                            </table>';
                                                                                
                                                        
                                                    }
               
                $outlets_views .= '</div>
                                        
                                      </div>
                                      <div class="clearfix  margin-bottom-5"></div>
                                     </div>
                                  </div>';
                
            }
            
             $outlets_views .= '</div>';
            
        }
        
        echo  $outlets_views;
        
    }
    

   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for getting the total number of zippo outlets registered so far     |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function getComputeGrowthRate($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $dateOneDayAgo = Zf_Core_Functions::Zf_FomartDate($dateFormat, Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(1)));
        $dateTwoDaysAgo = Zf_Core_Functions::Zf_FomartDate($dateFormat, Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(2)));
        
        //echo $dateOneDayAgo."=====".$dateTwoDaysAgo; exit();
        
        if($application_user == ZIPPO_PLATFORM_ADMIN){
            
            $totalTransactionsOneDayAgo = "SELECT * FROM " . $table . " WHERE transactionDate = '$dateOneDayAgo'"; //die();
            $totalTransactionsTwoDaysAgo = "SELECT * FROM " . $table . " WHERE transactionDate = '$dateTwoDaysAgo'"; //die();
          
            
        }else if($application_user == ZIPPO_OUTLET_STAFF){
            
            $totalTransactionsOneDayAgo = "SELECT * FROM " . $table . " WHERE AND transactionDate = '$dateOneDayAgo' AND outletIdNumber = '$userid' "; //die();
            $totalTransactionsTwoDaysAgo = "SELECT * FROM " . $table . " WHERE AND transactionDate = '$dateTwoDaysAgo' AND outletIdNumber = '$userid' "; //die();
          
        } 
        
        
        $executeTotalTransactionsOneDayAgo  = $this->Zf_AdoDB->Execute($totalTransactionsOneDayAgo);
        $executeTotalTransactionsTwoDaysAgo  = $this->Zf_AdoDB->Execute($totalTransactionsTwoDaysAgo);
        
        if (!$executeTotalTransactionsOneDayAgo || !$executeTotalTransactionsTwoDaysAgo){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $totalTransactionsOneDayAgoCount = $executeTotalTransactionsOneDayAgo->RecordCount();
            $totalTransactionsTwoDaysAgoCount = $executeTotalTransactionsTwoDaysAgo->RecordCount();
            
        }
        
        $transactionGrowthRate = (($totalTransactionsOneDayAgoCount - $totalTransactionsTwoDaysAgoCount)/$totalTransactionsOneDayAgoCount)*100;
        
        echo round($transactionGrowthRate,2)."%";
        
    }


   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The public method for generating line graphs for all bound transactions         |                                                             |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */ 
    public function AllBoundTransactionsLine($userid = NULL){
        
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
            
            $dateFormat = 'Y-m-d';
            $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0)));
        $dateOneDayAgo = Zf_Core_Functions::Zf_FomartDate($dateFormat, Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(1)));
       $dateTwoDaysAgo = Zf_Core_Functions::Zf_FomartDate($dateFormat, Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(2)));
     $dateThreeDaysAgo = Zf_Core_Functions::Zf_FomartDate($dateFormat, Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(3)));
      $dateFourDaysAgo = Zf_Core_Functions::Zf_FomartDate($dateFormat, Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(4)));
      $dateFiveDaysAgo = Zf_Core_Functions::Zf_FomartDate($dateFormat, Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(5)));
       $dateSixDaysAgo = Zf_Core_Functions::Zf_FomartDate($dateFormat, Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(6)));
       
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
                
                $transactionType = $value['transactionTypeName'];
                
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

   
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for making a new transaction                                     |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function AllPartnersTransactionsPie($userid = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        //$dateToday = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        
        //Returns the array values of agency types
        $agencyTypesResults = $this->fetchAgencyTypesInformation();
        
        if($agencyTypesResults == 0){
            
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
    * |  The is method for making a new transaction                                     |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function AllPartnersTransactionsLineToday($chartId = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0)));
        
        //This returns an array for all the transaction types
        $transactionsTypeResults = $this->fetchTransactionsTypeInformation();
        
        //Returns the array values for all the agency types
        $agencyTypesResults = $this->fetchAgencyTypesInformation();
        
        $transactions_types = '';
         
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
            
        $strXML  = "";
        $strXML .= "<chart caption='Vendors Money Variations' xAxisName='All Transacting Vendors' yAxisName='Amounts Transacted' numberPrefix='' bgColor='transparent' bgAlpha='50' showBorder='0' 
		canvasBgColor='FFFFFF' canvasBorderColor='efefef' canvasBorderThickness='1' canvasBorderAlpha='80'  useRoundEdges='1' rotateValues='1'  placeValuesInside='1'
                showlegend='1' enablesmartlabels='1' showlabels='1' labelDisplay='ROTATE' slantLabels='1' showpercentvalues='1' legendPosition='BOTTOM' canvasBorder='0'
                showAlternateVGridColor='1' numVDivLines='5' vDivLineIsDashed='0' vDivLineDashLen='5' vDivLineDashGap='5' alternateVGridColor='D9E5F1' alternateVGridAlpha='100'
                paletteColors='27A9E3, 28B779, E7191B, FFC65D, 4CC3D9, 93648D, 404040' paletteThemeColor='ffb848' showToolTip='1' showToolTipShadow='1'> ";
         
            $strXML .= "<categories>";
                foreach ($agencyTypesResults as $value){

                    $agencyTypeName = $value['agencyTypeName'];

                    $strXML .= "<category Label='".$agencyTypeName."'/>";

                }
            $strXML .= "</categories>";
        
            foreach ($transactionsTypeResults as $value) {
                
                $transactionType = $value['transactionTypeName'];
                
                $transactionName = str_replace(" ", "", $transactionType);
                
                //since we have all the transaction types, lets now get the partners types.
                
                $strXML .= "<dataset seriesName='".$transactionType."'>";
                
                foreach ($agencyTypesResults as $value) {
                    
                    $agencyTypeCode = $value['agencyTypeCode']; $agencyTypeName = str_replace(" ", "", ucwords($value['agencyTypeName']));
                    
                    //echo $transactionName."===".$agencyTypeCode."====".$agencyTypeName."<br>";
                    
                    //Prepare the SQL query variable
                    $getTransactionQuery = "get".$agencyTypeName.$transactionName;
                    $sumAsValue = lcfirst($agencyTypeName).$transactionName;
                    
                    if($application_user == ZIPPO_PLATFORM_ADMIN){
                
                        $getTransactionQuery = "SELECT SUM(transactionAmount) AS $sumAsValue FROM " . $table . " WHERE agencyTypeCode='$agencyTypeCode' AND transactionType='$transactionType' AND transactionDate='$dateToday' "; //die();;
                    
                    }else if($application_user == ZIPPO_OUTLET_STAFF){
                        
                        $getTransactionQuery = "SELECT SUM(transactionAmount) AS $sumAsValue FROM " . $table . " WHERE agencyTypeCode='$agencyTypeCode' AND transactionType='$transactionType' AND transactionDate='$dateToday' AND outletIdNumber = '$userid'  "; //die();;
                    
                    }
                    
                    //echo $getTransactionQuery."<br><br>";
                    
                    //Preapare the query execution variable
                    $executeTransactionQuery = "execute".$agencyTypeName.$transactionName;
                    
                    $executeTransactionQuery = $this->Zf_AdoDB->Execute($getTransactionQuery);
                    
                    //Check if the query executed successfully
                    
                    if (!$executeTransactionQuery){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{
                        
                        //Count all the results of query executions. Start by creating the Count Variable.
                        $countTransactionResult = "count".$agencyTypeName.$transactionName;
                        
                        $countTransactionResult = $executeTransactionQuery->fields[$sumAsValue];
                        
                        if($countTransactionResult == 0 ){ $countTransactionResult = 0; }
                        
                        $strXML .= "<set  value='".$countTransactionResult."' />";
                        
                    }
                    
                }   
                
                $strXML .= "</dataset>";
            }
            
        }
        
        $strXML .= "<styles>
                        <definition>
                           <style name='myLabelsFont' type='font' font='Verdana' size='8' color='575757' bold='1' underline='1'/>
                        </definition>
                        <application>
                           <apply toObject='DataLabels' styles='myLabelsFont' />
                        </application>
                     </styles>";
        
        $strXML .= "</chart>";

        $zf_chartData = array(

            "chartData"         => "$strXML",
            "chartType"         => "MSColumn3D",
            "chartId"           => "$chartId",
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
    public function AllPartnersTransactionsLine($chartId = NULL){
        
        $application_user = $this->identifictionArray[3];
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0)));
        
        //This returns an array for all the transaction types
        $transactionsTypeResults = $this->fetchTransactionsTypeInformation();
        
        //Returns the array values for all the agency types
        $agencyTypesResults = $this->fetchAgencyTypesInformation();
        
        $transactions_types = '';
         
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
            
        $strXML  = "";
        $strXML .= "<chart caption='Partners Money Variations' xAxisName='Last Seven Days Duration' yAxisName='Amounts Transacted' numberPrefix='' bgColor='transparent' bgAlpha='50' showBorder='0' 
		canvasBgColor='FFFFFF' canvasBorderColor='efefef' canvasBorderThickness='1' canvasBorderAlpha='80'  useRoundEdges='1' rotateValues='1'  placeValuesInside='1'
                showlegend='1' enablesmartlabels='1' showlabels='1' labelDisplay='ROTATE' slantLabels='1' showpercentvalues='1' legendPosition='BOTTOM' canvasBorder='0'
                showAlternateVGridColor='1' numVDivLines='5' vDivLineIsDashed='0' vDivLineDashLen='5' vDivLineDashGap='5' alternateVGridColor='D9E5F1' alternateVGridAlpha='100'
                paletteColors='27A9E3, 28B779, E7191B, FFC65D, 4CC3D9, 93648D, 404040' paletteThemeColor='ffb848' showToolTip='1' showToolTipShadow='1'> ";
         
            $strXML .= "<categories>";
                foreach ($agencyTypesResults as $value){

                    $agencyTypeName = $value['agencyTypeName'];

                    $strXML .= "<category Label='".$agencyTypeName."'/>";

                }
            $strXML .= "</categories>";
        
            foreach ($transactionsTypeResults as $value) {
                
                $transactionType = $value['transactionTypeName'];
                
                $transactionName = str_replace(" ", "", $transactionType);
                
                //since we have all the transaction types, lets now get the partners types.
                
                $strXML .= "<dataset seriesName='".$transactionType."'>";
                
                foreach ($agencyTypesResults as $value) {
                    
                    $agencyTypeCode = $value['agencyTypeCode']; $agencyTypeName = str_replace(" ", "", ucwords($value['agencyTypeName']));
                    
                    //echo $transactionName."===".$agencyTypeCode."====".$agencyTypeName."<br>";
                    
                    //Prepare the SQL query variable
                    $getTransactionQuery = "get".$agencyTypeName.$transactionName;
                    $sumAsValue = lcfirst($agencyTypeName).$transactionName;
                    
                    if($application_user == ZIPPO_PLATFORM_ADMIN){
                
                        $getTransactionQuery = "SELECT SUM(transactionAmount) AS $sumAsValue FROM " . $table . " WHERE agencyTypeCode='$agencyTypeCode' AND transactionType='$transactionType' "; //die();;
                    
                    }else if($application_user == ZIPPO_OUTLET_STAFF){
                        
                        $getTransactionQuery = "SELECT SUM(transactionAmount) AS $sumAsValue FROM " . $table . " WHERE agencyTypeCode='$agencyTypeCode' AND transactionType='$transactionType' AND outletIdNumber = '$userid'  "; //die();;
                    
                    }
                    
                    //echo $getTransactionQuery."<br><br>";
                    
                    //Preapare the query execution variable
                    $executeTransactionQuery = "execute".$agencyTypeName.$transactionName;
                    
                    $executeTransactionQuery = $this->Zf_AdoDB->Execute($getTransactionQuery);
                    
                    //Check if the query executed successfully
                    
                    if (!$executeTransactionQuery){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{
                        
                        //Count all the results of query executions. Start by creating the Count Variable.
                        $countTransactionResult = "count".$agencyTypeName.$transactionName;
                        
                        $countTransactionResult = $executeTransactionQuery->fields[$sumAsValue];
                        
                        if($countTransactionResult == 0 ){ $countTransactionResult = 0; }
                        
                        $strXML .= "<set  value='".$countTransactionResult."' />";
                        
                    }
                    
                }   
                
                $strXML .= "</dataset>";
            }
            
        }
        
        $strXML .= "<styles>
                        <definition>
                           <style name='myLabelsFont' type='font' font='Verdana' size='8' color='575757' bold='1' underline='1'/>
                        </definition>
                        <application>
                           <apply toObject='DataLabels' styles='myLabelsFont' />
                        </application>
                     </styles>";
        
        $strXML .= "</chart>";

        $zf_chartData = array(

            "chartData"         => "$strXML",
            "chartType"         => "MSColumn3D",
            "chartId"           => "$chartId",
            "chartWidth"        => "100%",
            "chartHeight"       => 400,
            "chartDebug"        => "false",
            "registerJavacript" => "true",
            "chartTransparency" => ""

        );

       Zf_GenerateCharts::zf_generate_chart($zf_chartData, $chartPosition = "inline");
        
    }
    
    
    
   /*
    *++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
    * ALL THE FOLLOWING METHODS ARE SUPPORTING METHODS FOR THE FETCHING OF ALL
    * THE NECESSARY DATA BASED ON THE CHAT TYPE.
    *++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*
    */
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is method for getting the total amount of money deposited to Zippo            |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function getOutletTransactions($userid = NULL){
        
        $table = "zvss_new_transaction";
        
        $dateFormat = 'Y-m-d';
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0)));
        
        //Returns the array values of agency types
        $outletsResults = $this->fetchOutletsInformation();
        
        $outlet_data = "";
        
        if($outletsResults == 0){
            
             $outlet_data .='<div class="tab-pane active form">
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There is probable data inconsistency. Cannot load outlet data.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
            $outlet_data .= "<table class='table table-striped table-bordered table-hover'>
                                        <thead>
                                            <tr>
                                                <th>Outlet Name</th><th>Outlet Area</th><th>No. of Transactions</th><th>Amt. Transacted (Kshs)</th><th>Commissions</th><th>Outlet Admin</th><th>Mobile No.</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
            
            foreach ($outletsResults as  $value) {
                
                $outletCode =  $value['outletCode']; $outletArea = $value['outletArea']; $outletLocation = $value['outletLocation'];
                
                $outletAdminInformation = $this->fetchOutletAdminInformation($outletCode);
                
                foreach ($outletAdminInformation as $value){
                    
                    $adminName = $value['adminFirstName']." ".$value['adminLastName']; $adminMobile = $value['adminMobileNumber'];
                    
                }
                
                $totalAmountTransacted = "SELECT SUM(transactionAmount) AS totalAmount FROM ". $table ." WHERE outletCode = '$outletCode' AND transactionDate= '$dateToday' "; //die
                $totalCommissionTransacted = "SELECT SUM(transactionCommission) AS totalCommission FROM ". $table ." WHERE outletCode = '$outletCode' AND transactionDate= '$dateToday' "; //die
                $totalTransactionCounts = "SELECT * FROM ". $table ." WHERE outletCode = '$outletCode' AND transactionDate= '$dateToday' "; //die
                
                $executeTotalAmountTransacted  = $this->Zf_AdoDB->Execute($totalAmountTransacted);
                $executeTotalCommissionTransacted  = $this->Zf_AdoDB->Execute($totalCommissionTransacted);
                $executeTransactionCounts  = $this->Zf_AdoDB->Execute($totalTransactionCounts);
        
                if (!$executeTotalAmountTransacted || !$executeTotalCommissionTransacted || !$executeTransactionCounts){

                    echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                }else{

                    $totalTransactionsSumAmount = $executeTotalAmountTransacted->fields['totalAmount'];
                    $totalTransactionsSumCommission = $executeTotalCommissionTransacted->fields['totalCommission'];
                    $totalTransactionsCount = $executeTransactionCounts->RecordCount();

                    $formatedTotalAmountSum = Zf_Core_Functions::Zf_FormatMoney($totalTransactionsSumAmount);
                    $formatedTotalCommissionSum = Zf_Core_Functions::Zf_FormatMoney($totalTransactionsSumCommission);

                }
                
                $outlet_data .= "<tr><td>".$outletArea." (".$outletLocation.")</td><td>".$outletArea."</td><td>".$totalTransactionsCount."</td><td style='text-align: right; padding-right: 10px;'>".$formatedTotalAmountSum."</td><td style='text-align: right; padding-right: 10px;'>".$formatedTotalCommissionSum."</td><td>".$adminName."</td><td>".$adminMobile."</td></tr>";
                
            }
            
            $outlet_data .= "</tbody>
                                   </table>";
            
            
        }
        
        echo $outlet_data;
        
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
    private function fetchTransactionsInformation($outletCode){
        
        $dateFormat = 'Y-m-d';
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0)));
        
        $zvss_sqlValue['transactionDate'] = Zf_QueryGenerator::SQLValue($dateToday);
        $zvss_sqlValue['outletCode'] = Zf_QueryGenerator::SQLValue($outletCode);
        
        $fetchTransactions = Zf_QueryGenerator::BuildSQLSelect('zvss_new_transaction', $zvss_sqlValue);
        
        
        $zf_executeFetchTransactions = $this->Zf_AdoDB->Execute($fetchTransactions);

        if(!$zf_executeFetchTransactions){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchTransactions->RecordCount() > 0){

                while(!$zf_executeFetchTransactions->EOF){
                    
                    $results = $zf_executeFetchTransactions->GetRows();
                    
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
     * OUTLET INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchOutletsInformation(){
        
        $fetchOutlets = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_details');
        
        $zf_executeFetchOutlets= $this->Zf_AdoDB->Execute($fetchOutlets);

        if(!$zf_executeFetchOutlets){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchOutlets->RecordCount() > 0){

                while(!$zf_executeFetchOutlets->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolClasses->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchOutlets->GetRows();
                    
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
     * OUTLET TRANSACTION INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchOutletAdminInformation($outletCode){
        
        $table = "zvss_outlet_main_admins";
       
        $fetchOutletMainAdmins = "SELECT * FROM " . $table . " WHERE outletCode = '$outletCode'"; //die();
        
        $zf_executeFetchOutletMainAdmins = $this->Zf_AdoDB->Execute($fetchOutletMainAdmins);

        if(!$zf_executeFetchOutletMainAdmins){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchOutletMainAdmins->RecordCount() > 0){

                while(!$zf_executeFetchOutletMainAdmins->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolClasses->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchOutletMainAdmins->GetRows();
                    
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
    
 

}

?>
