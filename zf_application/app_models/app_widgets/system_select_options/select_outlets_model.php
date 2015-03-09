 <?php

class select_outlets_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    public function zf_buildOutletOptions(){
        
        $outletList = $this->zf_getOutlets();
        
        $outletOptions = "";
        $outletOptions .= "<option value=''></option>";
        
        if($outletList == 0){
            
            $outletOptions .= "<option value=''>No Outlet Yet</option>";
                    
        }else{
            
            foreach ($outletList as $value) {
                
                $outletArea = $value['outletArea']; $outletLocation =  $value['outletLocation']; $outletCode = $value['outletCode'];
                
                $outletOptions .= "<option value='".$outletCode."' >".$outletArea." (".$outletLocation.")</option>";
                
            }
            
        }
        
        echo $outletOptions;
        
    }
    

    public function zf_getOutlets() {
        
        $zf_outletStatusValue['outletStatus'] = Zf_QueryGenerator::SQLValue(1);
        
        $zf_selectOutlets= Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_details', $zf_outletStatusValue);
        
        $zf_executeSelectOutlets= $this->Zf_AdoDB->Execute($zf_selectOutlets);

        if(!$zf_executeSelectOutlets){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeSelectOutlets->RecordCount() > 0){
                
                while(!$zf_executeSelectOutlets->EOF){
                    
                    $results = $zf_executeSelectOutlets->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
            
        }

    }
    
}
?>
