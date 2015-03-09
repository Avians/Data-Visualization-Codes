<?php

class Mainmenu_Model extends Zf_Model {

    public function __construct() {
        parent::__construct();
    }

    public function buildQueries($zf_externalWidgetData) {


        // $arrayVariable["column name"] = formatted SQL value
        $values["product_name"] = Zf_QueryGenerator::SQLValue("Bread");

        $sql = Zf_QueryGenerator::BuildSQLSelect($zf_externalWidgetData);


        //$rs_insert = $adodb->Execute($result); 
        $recordSet = $this->Zf_AdoDB->Execute($sql);
        /**
         * print "<pre>";
         * print_r($rs->GetRows());
         * print "</pre>";
         */
        if (!$recordSet) {

            print $this->Zf_AdoDB->ErrorMsg();
        } else {

            echo "<table border='1px' width='200px'>";
            while (!$recordSet->EOF) {

                echo '<tr><td>' . $recordSet->fields[0] . '</td><td>' . $recordSet->fields[1] . '</td><td> ' . $recordSet->fields[2] . '</td></tr>';

                $recordSet->MoveNext();
            }
            echo "</table>";
        }
    }

}

?>
