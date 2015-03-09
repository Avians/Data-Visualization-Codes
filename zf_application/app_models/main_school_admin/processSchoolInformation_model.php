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

class ProcessSchoolInformation_Model extends Zf_Model {
    
   
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
    
    
    public function zvss_getSchoolLocality(){
        
        $countryCode = $_POST['countryCode'];
        
        $zf_valueCountryCode['countryCode'] = Zf_QueryGenerator::SQLValue($countryCode); 
        $zf_selectLocality = Zf_QueryGenerator::BuildSQLSelect('zvss_locality', $zf_valueCountryCode);

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
    
    

}

?>
