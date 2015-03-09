 <?php

class agency_options_Model extends Zf_Model {

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
    public function zvss_buildAgencyTypeOptions() {
        
        $agency_types_results = $this->fetchAgencyTypesInformation();
        
        $agency_types_options = "";
        $agency_types_options .='<option value=""></option>';
        
        foreach ($agency_types_results as $value) {
            
            $agencyTypeCode = $value['agencyTypeCode']; $agencyTypeName = $value['agencyTypeName'];
            
            $agency_types_options .= '<option value="'.$agencyTypeCode.'">'.$agencyTypeName.'</option>';
            
        }
        
        echo $agency_types_options;

    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * AGENCY TYPES INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchAgencyTypesInformation(){
        
        $fetchAgencyTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_agency_type_details');
        
        $zf_executeFetchAgencyTypes = $this->Zf_AdoDB->Execute($fetchAgencyTypes);

        if(!$zf_executeFetchAgencyTypes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchAgencyTypes->RecordCount() > 0){

                while(!$zf_executeFetchAgencyTypes->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchAgencyTypes->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchAgencyTypes->fields;
                    $results = $zf_executeFetchAgencyTypes->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
}
?>
