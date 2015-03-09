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

class TransactionTrial_Model extends Zf_Model {
    
   
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
    public function transactionTrial(){
        
        $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
        $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        
        //He we collect  and validate all the school setup information
        $this->zf_formController->zf_postFormData('idNumber')
                                ->zf_validateFormData('zf_maximumLength', 60, 'ID/PP number')
                                ->zf_validateFormData('zf_minimumLength', 2, 'ID/PP number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'ID/PP number')
                
                                ->zf_postFormData('firstName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'First name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'First name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'First name')
                
                                ->zf_postFormData('middleName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Middle name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Middle name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Middle name')
                
                                ->zf_postFormData('lastName')
                                ->zf_validateFormData('zf_maximumLength', 60, 'Last name')
                                ->zf_validateFormData('zf_minimumLength', 2, 'Last name')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Last name')
                
                                ->zf_postFormData('mobileNumber')
                                ->zf_validateFormData('zf_maximumLength', 20, 'Mobile number')
                                ->zf_validateFormData('zf_minimumLength', 5, 'Mobile number')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'Mobile number');
                
        
        

        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        $this->_validResult = $this->zf_formController->zf_fetchValidData(); 
        
        //echo'<pre>'; print_r($this->_validResult); echo'<pre><br>'; //exit(); //This is strictly for debugging purpose.
        //echo'<pre>'; print_r($this->_errorResult); echo'<pre><br>'; exit(); //This is strictly for debugging purpose.
        
        //If the error result is empty.
        if (empty($this->_errorResult)) {
            
            //echo'<pre>'; print_r($this->_validResult); echo'<pre>'; exit(); //This is strictly for debugging purpose.
            //IF THERE IS NO ANY FORM ERRORS, THEN CHECK IF THERE IS NO TRANSACTION WITH A SIMILAR REFERENCE CODE IN THE DATABASE
            
            foreach ($this->_validResult as $zf_fieldName => $zf_fieldValue) {

                $zvss_transactionDetails[$zf_fieldName] = Zf_QueryGenerator::SQLValue($zf_fieldValue);

            }

            //Build the insert SQL queries
            $insertNewTransactionDetails = Zf_QueryGenerator::BuildSQLInsert('transactions', $zvss_transactionDetails);

            //echo $insertNewTransactionDetails; exit();

            $executeInsertNewTransactionDetails = $this->Zf_AdoDB->Execute($insertNewTransactionDetails);

            if(!$executeInsertNewTransactionDetails){

                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            }else{

                Zf_GenerateLinks::zf_header_location('platform_admin', 'manage_transactions', 'transactions_trial');
                exit(); 

            }
            
            
        } 
        
    }
    

}

?>