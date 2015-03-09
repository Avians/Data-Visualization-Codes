 <?php

class select_options_Model extends Zf_Model {

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
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR FETCHING THE USERS
     * AND THEN BUILDING AN OPTION LIST.
     * -------------------------------------------------------------------------
     */
    public function zvss_buildUserOptions() {
        
        $users_results = $this->fetchUserInformation();
        $users_options = "";
        $users_options .='<option value=""></option>';
        
        foreach ($users_results as $value) {
            
            $identificationCode = $value['identificationCode']; $adminFirstName = $value['adminFirstName']; $adminLastName = $value['adminLastName'];
            
            $users_options .= '<option value="'.$identificationCode.'">'.$adminFirstName.' '.$adminLastName.'</option>';
            
        }
        
        echo $users_options;

    }

    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * USERS INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchUserInformation(){
        
        $fetchZeepoUsers = Zf_QueryGenerator::BuildSQLSelect('zvss_platform_main_admins');
        
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
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR FETCHING THE USERS
     * AND THEN BUILDING AN OPTION LIST.
     * -------------------------------------------------------------------------
     */
    public function zvss_buildAgentTypeOptions() {
        
        $agent_types_results = $this->fetchAgentTypesInformation();
        $agent_type_options = "";
        $agent_type_options .='<option value=""></option>';
        
        foreach ($agent_types_results as $value) {
            
            $agentTypeName = $value['agentTypeName']; $agentTypeAlias = $value['agentTypeAlias'];
            
            $agent_type_options .= '<option value="'.$agentTypeName.'">'.$agentTypeName.'</option>';
            
        }
        
        echo $agent_type_options;

    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * AGENT TYPES INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchAgentTypesInformation(){
        
        $fetchZeepoAgentTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_agent_type_details');
        
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
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR FETCHING THE USERS
     * AND THEN BUILDING AN OPTION LIST.
     * -------------------------------------------------------------------------
     */
    public function zvss_buildOutletTypeOptions() {
        
        $outlet_types_results = $this->fetchOutletTypesInformation();
        $outlet_type_options = "";
        $outlet_type_options .='<option value=""></option>';
        
        foreach ($outlet_types_results as $value) {
            
            $outletTypeName = $value['outletTypeName']; $outletTypeAlias = $value['outletTypeAlias'];
            
            $outlet_type_options .= '<option value="'.$outletTypeName.'">'.$outletTypeName.'</option>';
            
        }
        
        echo $outlet_type_options;

    }
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR FETCHING THE USERS
     * AND THEN BUILDING AN OPTION LIST.
     * -------------------------------------------------------------------------
     */
    public function zvss_buildTransactionIdOptions() {
        
        $outlet_types_results = $this->fetchTrialTransactionInformation();
        $outlet_type_options = "";
        $outlet_type_options .='<option value=""></option>';
        
        foreach ($outlet_types_results as $value) {
            
            $idNumber = $value['idNumber'];
            
            $outlet_type_options .= '<option value="'.$idNumber.'">'.$idNumber.'</option>';
            
        }
        
        echo $outlet_type_options;

    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * AGENT TYPES INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchOutletTypesInformation(){
        
        $fetchZeepoOutletTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_type_details');
        
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
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * AGENT TYPES INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchTrialTransactionInformation(){
        
        $fetchZeepoOutletTypes = Zf_QueryGenerator::BuildSQLSelect('transactions');
        
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
