 <?php

class user_section_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }

    public function zf_getUserDetails($identificationCode) {
        
        $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        if($identifictionArray[3] == ZIPPO_OUTLET_STAFF || $identifictionArray[3] == ZIPPO_OUTLET_JUNIOR_STAFF){
            
            $table = "zvss_outlet_main_admins";
            
        }else if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
            
            $table = "zvss_platform_main_admins";
            
        }
        
        $zvss_sqlValueUserCode["identificationCode"] = Zf_QueryGenerator::SQLValue($identificationCode);
        
        $fetchUserDetails = Zf_QueryGenerator::BuildSQLSelect($table, $zvss_sqlValueUserCode);
        $zf_executeFetchUserDetails = $this->Zf_AdoDB->Execute($fetchUserDetails);

        if(!$zf_executeFetchUserDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchUserDetails->RecordCount() > 0){

                while(!$zf_executeFetchUserDetails->EOF){
                    
                    $results = $zf_executeFetchUserDetails->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
            
        }

        

    }
    
}
?>
