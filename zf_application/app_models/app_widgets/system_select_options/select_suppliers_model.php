 <?php

class select_suppliers_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    public function zf_buildSuppliersOptions(){
        
        $supplierList = $this->zf_getSuppliers();
        
        $supplierOptions = "";
        $supplierOptions .= "<option value=''></option>";
        
        if($supplierList == 0){
            
            $supplierOptions .= "<option value=''>No Suppliers Yet</option>";
                    
        }else{
            
            foreach ($supplierList as $value) {
                
                $supplierName = $value['supplierName']; $systemSupplierCode =  $value['systemSupplierCode'];
                
                $supplierOptions .= "<option value='".$systemSupplierCode."' >".$supplierName."</option>";
                
            }
            
        }
        
        echo $supplierOptions;
        
    }
    

    public function zf_getSuppliers() {
        
        $zf_supplierStatusValue['supplierStatus'] = Zf_QueryGenerator::SQLValue(1);
        
        $zf_selectSuppliers = Zf_QueryGenerator::BuildSQLSelect('zvss_supplier_details', $zf_supplierStatusValue);
        
        $zf_executeSelectSuppliers = $this->Zf_AdoDB->Execute($zf_selectSuppliers);

        if(!$zf_executeSelectSuppliers){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeSelectSuppliers->RecordCount() > 0){
                
                while(!$zf_executeSelectSuppliers->EOF){
                     
                    $results = $zf_executeSelectSuppliers->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
            
        }

    }
}
?>
