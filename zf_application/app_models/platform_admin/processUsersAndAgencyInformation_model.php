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

class ProcessUsersAndAgencyInformation_Model extends Zf_Model {
    
   
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
    
    
    //This is the method for getting the prefilled admin user form for editing.
    public function zvss_getAdminUserInformation($action){
        
        if($action == "edit_admin_users"){
            
            $disabled = ""; $button = "Edit User";
            
        }else if($action == "delete_admin_users") {
            
            $disabled = "disabled"; $button = "Delete User";
            
        }
        
        $identificationCode = $_POST['userIdentification'];
        
        //Get user login information
        $loginDetails = $this->fetchLoginInformation($identificationCode);
        
        //Get user admin information
        $adminDetails = $this->fetchAdminInformation($identificationCode);
        
        $prefilled_form = "";
        
        if($adminDetails === 0 || $loginDetails === 0){
            
            $prefilled_form .= '<h3 class="form-section form-title">Edit Zeepo User Warning!!</h3> 
                    <div class="school-class-inner-content">
                        <span class="content-view-errors" >
                            There seems to be no details of the selected Zeepo User. Please try again.
                        </span>
                   </div>';
            
        }else{
            
            
            foreach ($loginDetails as  $value) {
                $email = $value['email']; $password =  $value['password']; $identificationCode =  $value['identificationCode'];  
            }
            
            foreach ($adminDetails as  $value) {
                $adminDesignation = $value['adminDesignation']; $adminId =  $value['adminId']; $adminFirstName =  $value['adminFirstName']; 
                $adminLastName =  $value['adminLastName']; $adminMobileNumber = $value['adminMobileNumber']; $adminAddress = $value['adminAddress']; $adminGender = $value['adminGender'];
                
                if($adminGender == "Male"){
                    
                    $genderMale = "Checked";
                            
                }else if($adminGender == "Female"){
                    
                    $genderFemale = "Checked";
                    
                }
            }
            
            
            $prefilled_form .='<div class="tab-pane" id="adminInfo">
                    <h3 class="form-section form-title">User Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Designation:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" '.$disabled.' name="adminDesignation" data-placeholder="Mr., Mrs., Miss, Ms., ..."  value="'.$adminDesignation.'">
                                        <option value="'.$adminDesignation.'">'.$adminDesignation.'</option>
                                        <option value="Mr">Mr.</option>
                                        <option value="Mrs">Mrs.</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Ms">Ms</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">National Id:</label>
                                <div class="col-md-8">
                                    <input type="text" name="adminId" '.$disabled.' class="form-control" placeholder="12345" value="'.$adminId.'">
                                    <input type="hidden" name="hiddenAdminId" value="'.$adminId.'" /> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">First Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="adminFirstName" '.$disabled.' class="form-control" placeholder="Athias" value="'.$adminFirstName.'">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Last Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="adminLastName" '.$disabled.' class="form-control" placeholder="Avians" value="'.$adminLastName.'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Email Address:</label>
                                <div class="col-md-8">
                                    <input type="text" name="adminEmailAddress" '.$disabled.' class="form-control"  placeholder="athias@outlet.com" value="'.$email.'">
                                    <input type="hidden" name="hiddenEmail" value="'.$email.'" />    
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Mobile Number:</label>
                                <div class="col-md-8">
                                    <input type="text" name="adminMobileNumber" '.$disabled.' class="form-control" placeholder="+123 123 456 789" value="'.$adminMobileNumber.'">
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">P.o Box Address:</label>
                                <div class="col-md-8">
                                    <input type="text" name="adminAddress" '.$disabled.' class="form-control"  placeholder="12345" value="'.$adminAddress.'">
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label col-md-4">Gender:</label>
                                <div class="col-md-8">
                                    <div class="radio-list" style="margin-left: 20px !important;">
                                        <label class="radio-inline">
                                        <input type="radio" name="adminGender" '.$disabled.' value="Male" '.$genderMale.' data-title="Male"> Male </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="adminGender" '.$disabled.' value="Female" '.$genderFemale.' data-title="Female"> Female </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-offset-5 col-md-7">
                                <button type="submit" class="btn blue button-submit">
                                    '.$button.' <i class="m-icon-swapright m-icon-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
             ';
            
            
            
        }
        
        echo $prefilled_form;
        
    }
    
    
    //This is the method for getting the prefilled agency user form for editing.
    public function zvss_getAgentTypeInformation(){
        
      
        $agentTypeName = $_POST['agentTypeName'];
        
        //Get user login information
        $agentType = $this->fetchAgentTypeInformation($agentTypeName);
        
        $prefilled_form = "";
        
        if($agentType === 0 ){
            
            $prefilled_form .= '<h3 class="form-section form-title">Edit Zeepo Agent Types!!</h3> 
                    <div class="school-class-inner-content">
                        <span class="content-view-errors" >
                            There seems to be no details of the selected Zeepo Agent Type. Please try again.
                        </span>
                   </div>';
            
        }else{
            
            
            foreach ($agentType as  $value) {
                $agentTypeName = $value['agentTypeName']; $agentTypeAlias =  $value['agentTypeAlias']; $agentTypeStatus =  $value['agentTypeStatus'];  
               
                if($agentTypeStatus == 1){
                    
                    $statusActive = "Checked";  $statusInactive = "";
                            
                }else if($agentTypeStatus == 0){
                    
                   $statusActive = "";  $statusInactive = "Checked";
                    
                }
            }
           
            
            $prefilled_form .='<div class="tab-pane" id="adminInfo">
                    <h3 class="form-section form-title">Agent Type Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Agent Type Name:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="agentTypeName" placeholder="Direct, Managed, Franchise, ...." value="'.$agentTypeName.'">
                                    <input type="hidden" class="form-control" name="hiddenAgentTypeName" placeholder="Direct, Managed, Franchise, ...." value="'.$agentTypeName.'">    
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Agent Type Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="agentTypeAlias" placeholder="Any alias name" value="'.$agentTypeAlias.'">
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label col-md-4">Agent Status:</label>
                                <div class="col-md-8">
                                    <div class="radio-list" style="margin-left: 20px !important;">
                                        <label class="radio-inline">
                                        <input type="radio" name="agentTypeStatus"  value="Active" '.$statusActive.' data-title="Active"> Active </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="agentTypeStatus"  value="Inactive" '.$statusInactive.' data-title="Inactive"> Inactive </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-offset-5 col-md-7">
                                <button type="submit" class="btn blue button-submit">
                                    Edit <i class="m-icon-swapright m-icon-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
             ';
            
            
            
        }
        
        echo $prefilled_form;
        
    }
    
    
    //This is the method for getting the prefilled outlet form for editing.
    public function zvss_getOutletTypeInformation(){
        
      
        $outletTypeName = $_POST['outletTypeName'];
        
        //Get user login information
        $outletType = $this->fetchOutletTypeInformation($outletTypeName);
        
        $prefilled_form = "";
        
        if($outletType === 0 ){
            
            $prefilled_form .= '<h3 class="form-section form-title">Edit Zeepo Outlet Types!!</h3> 
                    <div class="school-class-inner-content">
                        <span class="content-view-errors" >
                            There seems to be no details of the selected Zeepo Outlet Type. Please try again.
                        </span>
                   </div>';
            
        }else{
            
            
            foreach ($outletType as  $value) {
                
                $outletTypeName = $value['outletTypeName']; $outletTypeAlias =  $value['outletTypeAlias']; $outletTypeStatus =  $value['outletTypeStatus'];  
               
                if($outletTypeStatus == 1){
                    
                    $statusActive = "Checked";  $statusInactive = "";
                            
                }else if($outletTypeStatus == 0){
                    
                   $statusActive = "";  $statusInactive = "Checked";
                    
                }
            }
            
            
            $prefilled_form .='<div class="tab-pane" id="adminInfo">
                    <h3 class="form-section form-title">Outlet Type Information</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Outlet Type Name:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="outletTypeName" placeholder="Stand alone, Shop-in-Shop, Sub-Franchise, ..." value="'.$outletTypeName.'">
                                    <input type="hidden" class="form-control" name="hiddenOutletTypeName" placeholder="Stand alone, Shop-in-Shop, Sub-Franchise, ..." value="'.$outletTypeName.'">
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Outlet Type Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="outletTypeAlias" placeholder="Any alias name" value="'.$outletTypeAlias.'">
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label col-md-4">Outlet Status:</label>
                                <div class="col-md-8">
                                    <div class="radio-list" style="margin-left: 20px !important;">
                                        <label class="radio-inline">
                                        <input type="radio" name="outletTypeStatus"  value="Active" '.$statusActive.' data-title="Active"> Active </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="outletTypeStatus"  value="Inactive" '.$statusInactive.' data-title="Inactive"> Inactive </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-offset-5 col-md-7">
                                <button type="submit" class="btn blue button-submit">
                                    Edit <i class="m-icon-swapright m-icon-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
             ';
            
            
            
        }
        
        echo $prefilled_form;
        
    }
    
  
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * USERS LOGIN INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchLoginInformation($identificationCode){
        
        $zvss_sqlValue["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
        
        $fetchZeepoUsers = Zf_QueryGenerator::BuildSQLSelect('zvss_application_users', $zvss_sqlValue);
        
        $zf_executeFetchZeepoUsers = $this->Zf_AdoDB->Execute($fetchZeepoUsers);

        if(!$zf_executeFetchZeepoUsers){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchZeepoUsers->RecordCount() > 0){

                while(!$zf_executeFetchZeepoUsers->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolSubjects->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolSubjects->fields;
                    $results = $zf_executeFetchZeepoUsers->GetRows();
                    
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
     * USERS ADMIN INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchAdminInformation($identificationCode){
        
        $zvss_sqlValue["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
        
        $fetchZeepoUsers = Zf_QueryGenerator::BuildSQLSelect('zvss_platform_main_admins', $zvss_sqlValue);
        
        $zf_executeFetchZeepoUsers = $this->Zf_AdoDB->Execute($fetchZeepoUsers);

        if(!$zf_executeFetchZeepoUsers){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchZeepoUsers->RecordCount() > 0){

                while(!$zf_executeFetchZeepoUsers->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolSubjects->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolSubjects->fields;
                    $results = $zf_executeFetchZeepoUsers->GetRows();
                    
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
     * AGENT TYPE INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchAgentTypeInformation($agentTypeName){
        
        $zvss_sqlValue["agentTypeName"] = Zf_QueryGenerator::SQLValue($agentTypeName);
        
        $fetchZeepoAgentTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_agent_type_details', $zvss_sqlValue);
        
        $zf_executeFetchZeepoAgentTypes = $this->Zf_AdoDB->Execute($fetchZeepoAgentTypes);

        if(!$zf_executeFetchZeepoAgentTypes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchZeepoAgentTypes->RecordCount() > 0){

                while(!$zf_executeFetchZeepoAgentTypes->EOF){
                    
                    $results = $zf_executeFetchZeepoAgentTypes->GetRows();
                    
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
     * AGENT TYPE INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchOutletTypeInformation($outletTypeName){
        
        $zvss_sqlValue["outletTypeName"] = Zf_QueryGenerator::SQLValue($outletTypeName);
        
        $fetchZeepoOutletTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_type_details', $zvss_sqlValue);
        
        $zf_executeFetchZeepoOutletTypes = $this->Zf_AdoDB->Execute($fetchZeepoOutletTypes);

        if(!$zf_executeFetchZeepoOutletTypes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchZeepoOutletTypes->RecordCount() > 0){

                while(!$zf_executeFetchZeepoOutletTypes->EOF){
                    
                    $results = $zf_executeFetchZeepoOutletTypes->GetRows();
                    
                }
                
                return $results;
           
            }else{
                
                return 0;
                
            }
        }
        
    }
    
    
    
    

}

?>
