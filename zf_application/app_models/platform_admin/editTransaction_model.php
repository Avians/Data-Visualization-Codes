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

class EditTransaction_Model extends Zf_Model {
    
   
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
    public function editTransaction(){
        
        $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
        $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        
        //He we collect  and validate all the school setup information
        $this->zf_formController->zf_postFormData('outletName')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Transaction Outlet')
                
                                ->zf_postFormData('outletCode')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Outlet Code')
                
                                ->zf_postFormData('transactionFirstName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'First name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'First name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'First name')
                
                                ->zf_postFormData('transactionLastName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Last name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Last name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Last name')
                
                                ->zf_postFormData('transactionIdNumber')
                                ->zf_validateFormData('zf_maximumLength', 60, 'ID/PP number')
                                ->zf_validateFormData('zf_minimumLength', 2, 'ID/PP number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'ID/PP number')
                
                                ->zf_postFormData('transactionMobileNumber')
                                ->zf_validateFormData('zf_maximumLength', 20, 'Mobile number')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Mobile number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Mobile number')
                
                                ->zf_postFormData('transactionAmount')
                                ->zf_validateFormData('zf_maximumLength', 7, 'Amount')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Amount')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Amount')
                
                                ->zf_postFormData('transactionType')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Transaction type')
                
                                ->zf_postFormData('transactionReference')
                                ->zf_validateFormData('zf_maximumLength', 20, 'Transaction reference')
                                ->zf_validateFormData('zf_minimumLength', 3, 'Transaction reference')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Transaction reference')
                
                                ->zf_postFormData('initialTransactionReference')
                
                                ->zf_postFormData('outletIdNumber');
                
        
        

        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        $this->_validResult = $this->zf_formController->zf_fetchValidData(); 
        
        //echo'<pre>'; print_r($this->_validResult); echo'<pre><br>'; //exit(); //This is strictly for debugging purpose.
        //echo'<pre>'; print_r($this->_errorResult); echo'<pre><br>'; exit(); //This is strictly for debugging purpose.
        
        //If the error result is empty.
        if (empty($this->_errorResult)) {
            
            //Lets check if the transaction reference code has been edited or not
            
            if($this->_validResult['initialTransactionReference'] == $this->_validResult['transactionReference']){
                //The transaction reference code didn't change
                
                //Update Transactions
                $this->zvss_updateTransactions($this->_validResult, $this->_validResult['transactionReference']);
            
            }else{
                //The transaction reference code did change. So update it as well. 
                //There reference transaction code to be updated in this case will be the initial one
                
                //Update Transactions
                $this->zvss_updateTransactions($this->_validResult, $this->_validResult['initialTransactionReference']);
                
                
            }
            
            
        } else {

            //echo "The form has some errors which MUST be rectified"; exit(); //This is strictly for debugging purpose.
            Zf_SessionHandler::zf_setSessionVariable("new_transaction", "transaction_error");
            
            echo Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            
            if($identifictionArray[3] == ZIPPO_OUTLET_STAFF){
                Zf_GenerateLinks::zf_header_location('outlet_staff', 'manage_transactions', 'new_transactions');
            }else if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
                Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_transactions', 'new_transactions');
            }
            exit();
        }
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY UPDATING THE
     * SUBJECTS INFORMATION
     * -------------------------------------------------------------------------
     */
    private function zvss_updateTransactions($validResults, $transactionReferenceCode){
        
        $zvss_value["transactionReference"] = Zf_QueryGenerator::SQLValue($transactionReferenceCode);
                        
        foreach ($validResults as $zvss_fieldName => $zvss_fieldValue) {

            if($zvss_fieldName != "initialTransactionReference"){

              $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue); 

            }

        }

        //This is the status column against which we compare.
        $zvss_columnsUpdate['outletCode'] = Zf_QueryGenerator::SQLValue($validResults['outletCode']);
        $zvss_columnsUpdate['outletIdNumber'] = Zf_QueryGenerator::SQLValue($validResults['outletIdNumber']);
        $zvss_columnsUpdate['transactionReference'] = Zf_QueryGenerator::SQLValue($transactionReferenceCode);

        //Generate the SQL Query
        $zvss_updateTransaction = Zf_QueryGenerator::BuildSQLUpdate('zvss_new_transaction', $zvss_value, $zvss_columnsUpdate);


        $zvss_executeUpdateTransaction = $this->Zf_AdoDB->Execute($zvss_updateTransaction);
        
        if(!$zvss_executeUpdateTransaction){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            //Updated successfully
            Zf_SessionHandler::zf_setSessionVariable("new_transaction", "transaction_update_success");
            
            if($this->identifictionArray[3] == ZIPPO_OUTLET_STAFF){
                Zf_GenerateLinks::zf_header_location('outlet_staff', 'manage_transactions', 'new_transactions');
            }else if($this->identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
                Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_transactions', 'new_transactions');
            }
            exit(); 
           
        }

    }
    
 

}

?>
