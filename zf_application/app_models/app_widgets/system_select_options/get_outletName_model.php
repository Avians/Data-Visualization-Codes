 <?php

class get_outletName_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }

    public function zf_getOutletName($outletCode) {
        
        $zvss_sqlColumn = array("outletArea", "outletLocation");
        
        $zvss_value["outletCode"] = Zf_QueryGenerator::SQLValue($outletCode); 
        
        $fetchOutletName = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_details', $zvss_value, $zvss_sqlColumn);
        
        //echo $fetchOutletName; exit();
        
        $zf_executeFetchOutletName = $this->Zf_AdoDB->Execute($fetchOutletName);

        if(!$zf_executeFetchOutletName){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchOutletName->RecordCount() > 0){
                    
                     
                $outletArea = $zf_executeFetchOutletName->fields['outletArea'];
                $outletLocation = $zf_executeFetchOutletName->fields['outletLocation'];

                //echo $outletName; exit();

                return '<input type="text" readonly class="form-control" name="outletName"  value="'.$outletArea .' ('.$outletLocation.')'.'">'
                        . '<input type="hidden" id="outletCode" name="outletCode" class="form-control" value="'.$outletCode.'">'
                        . '<input type="hidden" readonly id="outletId" name="outletId" class="form-control" value="'.$outletArea .'-'.$outletLocation.'">';

                
            }
            
        }

    }
    
}
?>
