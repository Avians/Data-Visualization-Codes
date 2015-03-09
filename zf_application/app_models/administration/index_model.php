<?php

//THIS CODE IS WRITTEN BY:
          //1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.
          //2. ALLAN KIBET, DEVELOPMENT AND IMPLEMENTATION HEAD AT ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Index Model which is responsible responsible for        |
 * |  handling all logics that are related to the template Controller  |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class Index_Model extends Zf_Model {

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
    
    
    public function buildQueries(){
        
        
        // $arrayVariable["column name"] = formatted SQL value
	$values["product_name"] = Zf_QueryGenerator::SQLValue("Bread");
        
        $sql = Zf_QueryGenerator::BuildSQLSelect("products", $values);

    
        //$rs_insert = $adodb->Execute($result); 
        $recordSet = $this->Zf_AdoDB->Execute($sql);
        /**
         *print "<pre>";
         * print_r($rs->GetRows());
         *print "</pre>";
         */
        if (!$recordSet){
            
            print $this->Zf_AdoDB->ErrorMsg();
        
        } else{
           
            echo "<table border='1px' width='200px'>";
            while (!$recordSet->EOF) {

                echo '<tr><td>'.$recordSet->fields[0] . '</td><td>' . $recordSet->fields[1] .  '</td><td> ' . $recordSet->fields[2] .'</td></tr>';

                $recordSet->MoveNext();
            }
            echo "</table>";
        }
    }
    
    

}

?>
