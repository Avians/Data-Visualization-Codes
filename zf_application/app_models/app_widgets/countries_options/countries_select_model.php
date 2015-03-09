 <?php

class countries_select_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }

    public function zf_buildCountryCode() {
        
        $zf_selectCountries = Zf_QueryGenerator::BuildSQLSelect('zvss_outlet_country');

        if(!$this->Zf_QueryGenerator->Query($zf_selectCountries)){
                
            $message = "Query execution failed.<br><br>";
            $message.= "The failed Query is : <b><i>{$zf_selectCountries}.</i></b>";
            echo $message; exit();

        }else{
            
            $resultCount = $this->Zf_QueryGenerator->RowCount();
            if($resultCount > 0){

                $this->Zf_QueryGenerator->MoveFirst();
                
                echo "<option value=''></option>";
                while(!$this->Zf_QueryGenerator->EndOfSeek()){

                    $fetchRow = $this->Zf_QueryGenerator->Row();
                    echo "<option value='".$fetchRow->countryCode."' >".$fetchRow->countryName."</option>";

                }

            }
        }

    }
    
}
?>
