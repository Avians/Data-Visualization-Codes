 <?php

class agent_options_Model extends Zf_Model {

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
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR FETCHING THE AGENCY
     * TYPES AND THEN BUILDING AN OPTION LIST.
     * -------------------------------------------------------------------------
     */
    public function zvss_buildAgentTypeOptions() {
        
        $agent_types_results = $this->fetchAgentTypesInformation();
        
        $agent_types_options = "";
        $agent_types_options .='<option value=""></option>';
        
        foreach ($agent_types_results as $value) {
            
            $agentTypeCode = $value['agentTypeName']; $agentTypeName = $value['agentTypeName'];
            
            $agent_types_options .= '<option value="'.$agentTypeCode.'">'.$agentTypeName.'</option>';
            
        }
        
        echo $agent_types_options;

    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * AGENCY TYPES INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchAgentTypesInformation(){
        
        $fetchAgentTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_agent_type_details');
        
        $zf_executeFetchAgentTypes = $this->Zf_AdoDB->Execute($fetchAgentTypes);

        if(!$zf_executeFetchAgentTypes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchAgentTypes->RecordCount() > 0){

                while(!$zf_executeFetchAgentTypes->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchAgentTypes->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchAgentTypes->fields;
                    $results = $zf_executeFetchAgentTypes->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
}
?>
