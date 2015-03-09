 <?php

class department_options_Model extends Zf_Model {

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
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR FETCHING THE CLASSES
     * AND THEN BUILDING AN OPTION LIST.
     * -------------------------------------------------------------------------
     */
    public function zvss_buildDepartmentOptions($schoolSystemCode) {
        
        $department_results = $this->fetchDepartmentInformation($schoolSystemCode);
        $department_options = "";
        $department_options .='<option value=""></option>';
        
        foreach ($department_results as $value) {
            
            $schoolDepartmentCode = $value['schoolDepartmentCode']; $schoolDepartmentName = $value['schoolDepartmentName'];
            
            $department_options .= '<option value="'.$schoolDepartmentCode.'">'.$schoolDepartmentName.'</option>';
            
        }
        
        echo $department_options;

    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * CLASS INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchDepartmentInformation($schoolSystemCode){
        
        $zvss_sqlValue["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
        
        $fetchSchoolClasses = Zf_QueryGenerator::BuildSQLSelect('zvss_school_departments', $zvss_sqlValue);
        
        $zf_executeFetchSchoolClasses= $this->Zf_AdoDB->Execute($fetchSchoolClasses);

        if(!$zf_executeFetchSchoolClasses){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolClasses->RecordCount() > 0){

                while(!$zf_executeFetchSchoolClasses->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolClasses->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchSchoolClasses->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
}
?>
