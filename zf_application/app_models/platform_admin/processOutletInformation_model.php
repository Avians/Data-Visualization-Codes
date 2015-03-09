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

class ProcessOutletInformation_Model extends Zf_Model {
    
   
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
    
    
    public function zvss_getOutletLocality(){
        
        $countryCode = $_POST['countryCode'];
        
        $zf_valueCountryCode['countryCode'] = Zf_QueryGenerator::SQLValue($countryCode); 
        $zf_selectLocality = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_locality', $zf_valueCountryCode);

        if(!$this->Zf_QueryGenerator->Query($zf_selectLocality)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectLocality}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                echo "<option value=''></option>";
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    echo "<option value='".$fetchRow->localityCode."' >".$fetchRow->localityName." ".$fetchRow->localityType."</option>";

                }

            }else{
                
                echo "<option value=''></option>";
                
            }
        }
        
        
    }
    
    
    //This is the code for getting the outlet code.
    public function zvss_getOutletCode(){
        
        $outletCode = $_POST['outletOptions'];
        
        $zf_outletDetails = array('outletArea', 'outletLocation');
        
        $zf_valueOutletCode['outletCode'] = Zf_QueryGenerator::SQLValue($outletCode); 
        $zf_selectName = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_details', $zf_valueOutletCode, $zf_outletDetails);
        

        if(!$this->Zf_QueryGenerator->Query($zf_selectName)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectName}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    $outletLocation = $fetchRow->outletLocation; $outletArea = $fetchRow->outletArea;
                    $outletName = $outletArea." (".$outletLocation.")";
                    
                    echo '<input type="hidden" name="outletName" class="form-control" value="'.$outletName.'">';

                }

            }
            
        }
        
        
    }
    
    
    //This is the code for getting the agency entities.
    public function zvss_getAgencyEntities(){
        
        $agencyTypeCode = $_POST['agencyTypeCode'];
        
        $zf_valueAgencyTypeCode['agencyTypeCode'] = Zf_QueryGenerator::SQLValue($agencyTypeCode); 
        $zf_selectAgencyEntities = Zf_QueryGenerator::BuildSQLSelect('zvss_agency_entities_details', $zf_valueAgencyTypeCode);

        if(!$this->Zf_QueryGenerator->Query($zf_selectAgencyEntities)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectAgencyEntities}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                echo "<option value=''></option>";
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    echo "<option value='".$fetchRow->agencyEntityCode."' >".$fetchRow->agencyEntityName."</option>";

                }

            }else{
                
                echo "<option value=''></option>";
                
            }
        }
        
        
    }
    
    
    
    //This is the code for getting the outlet code.
    public function zvss_editTransactionForm(){
        
        $referenceCode = $_POST['referenceCode'].ZVSS_CONNECT.$_POST['outletCode'];
        
        $prefilled_form = "";
        
        $transactionInformation = $this->fetchTransactionInformation($referenceCode);
        
        if(empty($_POST['referenceCode']) || $_POST['referenceCode'] ==NULL ){
            
            $prefilled_form .= '<h3 class="form-section form-title">Edit Transaction Error!!</h3> 
                    <div class="school-class-inner-content">
                        <span class="content-view-errors" >
                            You did not enter transacton reference code !! You must enter a reference code to continue.
                        </span>
                   </div>';
            
        }else{
            
            if($transactionInformation === 0){

                $prefilled_form .= '<h3 class="form-section form-title">Edit Transaction Error!!</h3> 
                        <div class="school-class-inner-content">
                            <span class="content-view-errors" >
                                Transacton reference code error! There is no transaction with the entered reference code for this outlet.
                            </span>
                       </div>';

            }else{

                foreach ($transactionInformation as  $value) {

                    $firstName = $value['transactionFirstName']; $lastName =  $value['transactionLastName']; 
                    $idNumber =  $value['transactionIdNumber']; $mobileNumber = $value['transactionMobileNumber'];
                    
                    $transactionAmount = $value['transactionAmount'];  $transactionType = $value['transactionType']; $referenceNumber = $value['transactionReference'];

                }

                $prefilled_form .= ' <div class="form-body">

            <!-- START OF TRANSACTION UPDATE FORM-->

                <h3 class="form-section form-title">Customer Info <small style="color: indianred; font-size: 11px !important;">&nbsp;&nbsp;*Do not leave any field empty</small></h3>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">First Name:</label>
                            <div class="col-md-8">
                                <input type="text" name="transactionFirstName" class="form-control" placeholder="Athias" value="'.$firstName.'">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">Last Name:</label>
                            <div class="col-md-8">
                                <input type="text" name="transactionLastName" class="form-control" placeholder="Avians" value="'.$lastName.'">
                            </div>
                        </div>
                    </div>
                </div>
                <!--/row-->

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">ID/PP Number:</label>
                            <div class="col-md-8">
                                <input type="text" name="transactionIdNumber" class="form-control"  placeholder="25138058" value="'.$idNumber.'">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">Mobile Number:</label>
                            <div class="col-md-8">
                                <input type="text" readonly name="transactionMobileNumber" class="form-control" placeholder="+123 123 456 789" value="'.$mobileNumber.'">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <!--/row-->


                <h3 class="form-section form-title">Transaction Details <small style="color: indianred; font-size: 11px !important;">&nbsp;&nbsp;*Do not leave any field empty</small></h3> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">Amount:</label>
                            <div class="col-md-8">
                                <input type="text" name="transactionAmount" class="form-control" placeholder="Amount(KES)" value="'.$transactionAmount.'">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">Transaction Type:</label>
                            <div class="col-md-8">
                                <input type="text" readonly name="transactionType" class="form-control" placeholder="TransactionType" value="'.$transactionType.'">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <!--/row-->

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">Transaction Ref:</label>
                            <div class="col-md-8">
                                <input type="text" name="transactionReference" class="form-control" placeholder="FK27QW968, FK27MM540, .." value="'.$referenceNumber.'">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <!--/row-->

            <!-- END OF TRANSACTION UPDATE FORM-->

    </div>
    <div class="form-actions fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-offset-5 col-md-7">
                    <button type="submit" class="btn green button-submit">
                        Submit <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                </div>
            </div>
        </div>
    </div> ';

            }
            
        }
        
        
        //Here we echo prefilled form or an error message.
        echo $prefilled_form;
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * TRANSACTIONS INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchTransactionInformation($referenceCode){
        
        $referenceCode = explode(ZVSS_CONNECT, $referenceCode);
        
        $zvss_sqlValue["transactionReference"] = Zf_QueryGenerator::SQLValue($referenceCode[0]);
        $zvss_sqlValue["outletCode"] = Zf_QueryGenerator::SQLValue($referenceCode[1]);
        
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
    
    
    
    
    
    
    //This is the code for getting the outlet code.
    public function zvss_editTrialTransactions(){
        
        $idNumber = $_POST['transactionId'];
        
        $prefilled_form = "";
        
        if($idNumber == ""){
            
            $prefilled_form .= 'show_old_form';
            
        }else{
            
            
            $transactionInformation = $this->fetchTrialTransactionInformation($idNumber);
          
            if($transactionInformation === 0){

                $prefilled_form .= 'show_old_form';

            }else{

                foreach ($transactionInformation as  $value) {

                    $firstName = $value['firstName']; $middleName =  $value['middleName']; $lastName =  $value['lastName']; 
                    $idNumber =  $value['idNumber']; $mobileNumber = $value['mobileNumber'];
                }

                $prefilled_form .= ' <div class="form-body">

                        <!-- START OF TRANSACTION UPDATE FORM-->

                            <h3 class="form-section form-title">Customer Info <small style="color: indianred; font-size: 11px !important;">&nbsp;&nbsp;*Do not leave any field empty</small></h3>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">First Name:</label>
                                        <div class="col-md-8">
                                            <input type="text" name="firstName" class="form-control" placeholder="Athias" readonly value="'.$firstName.'">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Middle Name:</label>
                                        <div class="col-md-8">
                                            <input type="text" name="middleName" class="form-control" placeholder="Avians"  readonly value="'.$middleName.'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/row-->

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Last Name:</label>
                                        <div class="col-md-8">
                                            <input type="text" name="lastName" class="form-control"  placeholder="athlan"  readonly value="'.$lastName.'">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Mobile Number:</label>
                                        <div class="col-md-8">
                                            <input type="text" readonly name="mobileNumber" class="form-control" placeholder="+123 123 456 789" readonly value="'.$mobileNumber.'">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->

                        <!-- END OF TRANSACTION UPDATE FORM-->

                </div>
                ';

            }
            
        }
        
        
        //Here we echo prefilled form or an error message.
        echo $prefilled_form;
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * TRANSACTIONS INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchTrialTransactionInformation($idNumber){
        
        $referenceCode = $idNumber;
        
        $zvss_sqlValue["idNumber"] = Zf_QueryGenerator::SQLValue($referenceCode);
        
        $fetchTransactions = Zf_QueryGenerator::BuildSQLSelect('transactions', $zvss_sqlValue);
        
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
    
    

}

?>
