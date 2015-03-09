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

class ProcessCustomerInformation_Model extends Zf_Model {
    
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
    
    
    //This is the code for getting the outlet code.
    public function zvss_processCustomerDetails(){
        
        $customerId = $_POST['customerId'];
        
        $prefilled_form = "";
        
        if($customerId == ""){
            
            //echo "show_old_form";
            $prefilled_form .= 'show_old_form';
            
        }else{
            
            $customerDetails= $this->fetchCustomerInformation($customerId);
            
            $prefilled_form = "";
        
            if($customerDetails === 0){

                $prefilled_form .= 'show_old_form';

            }else{
                
                foreach ($customerDetails as  $value) {

                    $transactionFirstName = $value['transactionFirstName']; $transactionMiddleName = $value['transactionMiddleName']; 
                    $transactionLastName = $value['transactionLastName']; $transactionMobileNumber = $value['transactionMobileNumber']; 



                }

                $prefilled_form .= '
                        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">First Name:</label>
                                        <div class="col-md-8">
                                            <input type="text" name="transactionFirstName" class="form-control" readonly value="'.$transactionFirstName.'">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Middle Name:</label>
                                        <div class="col-md-8">
                                            <input type="text" name="transactionMiddleName" class="form-control" readonly value="'.$transactionMiddleName.'">
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
                                            <input type="text" name="transactionLastName" class="form-control" readonly value="'.$transactionLastName.'">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-4">Mobile Number:</label>
                                        <div class="col-md-8">
                                            <input type="text" name="transactionMobileNumber" class="form-control" readonly value="'.$transactionMobileNumber.'">
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->';

            }
            
        }
        
        echo $prefilled_form;
         
    }
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * EXAMS MODES INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchCustomerInformation($customerId){
        
        $zvss_sqlValue["transactionIdNumber"] = Zf_QueryGenerator::SQLValue($customerId);
        $zvss_sqlColumns = array('transactionFirstName','transactionMiddleName', 'transactionLastName', 'transactionMobileNumber');
        $zvss_order = array("transactionFirstName");
        
        $fetchCustomerDetails = Zf_QueryGenerator::BuildSQLSelect('zvss_new_transaction',$zvss_sqlValue, $zvss_sqlColumns, $zvss_order, "1", "1");
        
        $zf_executeFetchCustomerDetails  = $this->Zf_AdoDB->Execute($fetchCustomerDetails);

        if(!$zf_executeFetchCustomerDetails ){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchCustomerDetails ->RecordCount() > 0){

                while(!$zf_executeFetchCustomerDetails ->EOF){
                    
                    $results = $zf_executeFetchCustomerDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }

}

?>
