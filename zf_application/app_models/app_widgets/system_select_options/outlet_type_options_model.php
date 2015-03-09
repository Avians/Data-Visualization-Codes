 <?php

class outlet_type_options_Model extends Zf_Model {

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
    public function zvss_buildOutletTypeOptions() {
        
        $outlet_types_results = $this->fetchOutletTypesInformation();
        
        $outlet_types_options = "";
        $outlet_types_options .='<option value=""></option>';
        
        foreach ($outlet_types_results as $value) {
            
            $outletTypeName = $value['outletTypeName'];
            
            $outlet_types_options .= '<option value="'.$outletTypeName.'">'.$outletTypeName.'</option>';
            
        }
        
        echo $outlet_types_options;

    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * AGENCY TYPES INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchOutletTypesInformation(){
        
        $fetchOutletTypes = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_type_details');
        
        $zf_executeFetchOutletTypes = $this->Zf_AdoDB->Execute($fetchOutletTypes);

        if(!$zf_executeFetchOutletTypes){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchOutletTypes->RecordCount() > 0){

                while(!$zf_executeFetchOutletTypes->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchAgencyTypes->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchAgencyTypes->fields;
                    $results = $zf_executeFetchOutletTypes->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
}
?>
