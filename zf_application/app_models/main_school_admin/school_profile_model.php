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

class School_profile_Model extends Zf_Model {
    
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
    
    
   //Get school logo
    public function getSchoolLogo($systemSchoolCode){
        
        $schoolDetails = $this->fetchSchoolInformation($systemSchoolCode);
                    
        $schoolLogo = $schoolDetails['schoolLogo'];
         
        $actual_logo = ZF_ROOT_PATH.ZF_DATASTORE."zvss_school_logos".DS.$schoolLogo;
                   
        $school_logo = "";
        $school_logo .= '<img src=" '.$actual_logo.'" title="zilas virtual school logo" height="100px" width="100px">';

        echo  $school_logo;
      
    }
    
    //Get school history
    public function getSchoolHistory($systemSchoolCode){
        
        $schoolDetails = $this->fetchSchoolInformation($systemSchoolCode);
                
        $schoolName = $schoolDetails['schoolName'];
        $dateOfEstablishment = $schoolDetails['dateOfEstablishment'];
        $schoolType = lcfirst($schoolDetails['schoolType']);
        $countryCode = "+".$schoolDetails['schoolCountry'];
        $localityCode = $schoolDetails['schoolLocality'];
        
        $localityCode = $countryCode.ZVSS_CONNECT.$localityCode;
        
        $countryDetails = $this->fetchCountryInformation($countryCode);
        
        $localityDetails = $this->fetchLocalityInformation($localityCode);
        
        
        $countryName = $countryDetails['countryName'];
        $localityName = $localityDetails['localityName']." ".lcfirst($localityDetails['localityType']);
        
        $school_history = "";
        
        $school_history.= '<p>
                            '.$schoolName.' was established in the year '.$dateOfEstablishment.' in '.$localityName.' in '.$countryName.'.
                            The '.$schoolType.' is mainly sponsored by SDA church and offers high quality 
                            secondary education to both local and international students.
                        </p>';
        
        echo $school_history;
        
    }
    
    //Get school sponsors
    public function getSchoolSponsors($systemSchoolCode){
        
        $school_sponsors = "";
        
        $school_sponsors .= '<span class="inner-content-legends">Main Sponsor:</span> SDA Church
                            <div class="clearfix"><br><hr class="sponsors-hr"></div>
                            <div class="sponsors-bullet">
                                <ol>
                                    <li>CDF</li>
                                    <li>Plan International</li>
                                    <li>OGRA Foundation</li>
                                </ol>
                            </div>';
        
        echo $school_sponsors;
        
    }
    
    //Get school main admin
    public function getSchoolMainAdmin($systemSchoolCode){
        
        $school_mainAdmin = "";
        
        $school_mainAdmin .= '<div><span class="inner-content-legends">School Principal:</span> Mathew Juma</div>
                             <div class="clearfix"></div>
                             <div><span class="inner-content-legends">Deputy Principal:</span> Lorna Aberi</div>
                             <div class="clearfix"></div>
                             <div><span class="inner-content-legends">System Admin:</span> Athias Avians</div> ';
        
        echo $school_mainAdmin;
        
    }
    
    //Get school details
    public function getSchoolDetails($systemSchoolCode){
        
        $schoolDetails = $this->fetchSchoolInformation($systemSchoolCode);
                
        $schoolType = $schoolDetails['schoolType'];
        $schoolLevel = $schoolDetails['schoolLevel'];
        $schoolCategory = $schoolDetails['schoolCategory'];
        $schoolGender = $schoolDetails['schoolGender'];
        
        $school_details = "";
        
        $school_details .= '<div><span class="inner-content-legends">School Type:</span> '.$schoolType.'</div>
                            <div class="clearfix"></div>
                            <div><span class="inner-content-legends">School Level:</span> '.$schoolLevel.'</div>
                            <div class="clearfix"></div>
                            <div><span class="inner-content-legends">School Category:</span> '.$schoolCategory.'</div>
                            <div class="clearfix"></div>
                            <div><span class="inner-content-legends">School Gender:</span> '.$schoolGender.'</div>';
        
        echo $school_details;
        
    }
    
    //Get school structure
    public function getSchoolStructure($systemSchoolCode){
        
        $school_structure = "";
        
        $school_structure .= '<div><span class="inner-content-legends">Classes:</span> Form 1 - Form 4</div>
                            <div class="clearfix"></div>
                            <div><span class="inner-content-legends">Departments:</span> 5</div>
                            <div class="clearfix"></div>
                            <div><span class="inner-content-legends">Hostels:</span> 6</div>
                            <div class="clearfix"></div>
                            <div><span class="inner-content-legends">Libraries:</span> 2</div>
                            <div class="clearfix"></div>
                            <div><span class="inner-content-legends">Transport:</span> 2 Vehicles</div>';
        
        echo $school_structure;
        
    }
    
    //Get school members
    public function getSchoolMembers($systemSchoolCode){
        
        $school_members = "";
        
        $school_members .= '<div><span class="inner-content-legends">Teachers:</span> 35</div>
                            <div class="clearfix"></div>
                            <div><span class="inner-content-legends">B.O.G Members:</span> 15</div>
                            <div class="clearfix"></div>
                            <div><span class="inner-content-legends">P.T.A Members:</span> 16</div>
                            <div class="clearfix"></div>
                            <div><span class="inner-content-legends">Students:</span> 800</div>
                            <div class="clearfix"></div>
                            <div><span class="inner-content-legends">Sub Staff:</span> 25</div>';
        
        echo $school_members;
        
    }
    
    //Get school affiliates
    public function getSchoolAffiliates($systemSchoolCode){
        
        $school_affiliates = "";
        
        $school_affiliates .= "None yet";
        
        echo $school_affiliates;
        
    }
    
    //Get school performance
    public function getSchoolPerformance($systemSchoolCode){
        
        $school_performance = "";
        
        $school_performance .= "Graph";
        
        //echo  $school_performance;
        
        echo "<pre>";print_r($this->fetchSchoolInformation($systemSchoolCode));echo "</pre>";
        
    }
    
    //Get class performance
    public function getClassPerformance($systemSchoolCode){
        
        $class_performance = "";
        
        $systemSchoolCode = $this->fetchSchoolInformation($systemSchoolCode);
        
        $class_performance .= "Graph";
        
        echo $systemSchoolCode;
        
    }
    
    /**
     * This private method fetches all the relvant information from the schoolDetails table
     */
    private function fetchSchoolInformation($systemSchoolCode){
        
        $zvss_sqlValue["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($systemSchoolCode);
        
        //$zvss_selectColumns = array("schoolLogo");
        
        $fetchSchoolDetails = Zf_QueryGenerator::BuildSQLSelect('zvss_school_details', $zvss_sqlValue);
        
        $zf_executeFetchSchoolDetails= $this->Zf_AdoDB->Execute($fetchSchoolDetails);

        if(!$zf_executeFetchSchoolDetails){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolDetails->RecordCount() > 0){

                while(!$zf_executeFetchSchoolDetails->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolDetails->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolDetails->GetRows();
                    $results = $zf_executeFetchSchoolDetails->fields;
                    return $results;
                    
                }
            }
        }
        
    }
    
    
    /**
     * This private method fetches all the relvant information from the schoolDetails table
     */
    private function fetchCountryInformation($conutryCode){
        
        $zvss_sqlValue["countryCode"] = Zf_QueryGenerator::SQLValue($conutryCode);
        
        $zvss_selectColumns = array("countryName");
        
        $fetchSchoolCountry = Zf_QueryGenerator::BuildSQLSelect('zvss_school_country', $zvss_sqlValue);
        
        $zf_executeFetchSchoolCountry = $this->Zf_AdoDB->Execute($fetchSchoolCountry);

        if(!$zf_executeFetchSchoolCountry){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolCountry->RecordCount() > 0){

                while(!$zf_executeFetchSchoolCountry->EOF){
                    
                    //$results = $zf_executeFetchSchoolCountry->GetRows();
                    $results = $zf_executeFetchSchoolCountry->fields;
                    return $results;
                    
                }
            }
        }
        
    }
    
    /**
     * This private method fetches all the relvant information from the schoolDetails table
     */
    private function fetchLocalityInformation($localityCode){
        
        $localityCode = explode(ZVSS_CONNECT, $localityCode);
        $zvss_sqlValue["countryCode"] = Zf_QueryGenerator::SQLValue($localityCode[0]);
        $zvss_sqlValue["localityCode"] = Zf_QueryGenerator::SQLValue($localityCode[1]);
        
        $zvss_selectColumns = array("localityName", "localityType");
        
        $fetchSchoolLocality = Zf_QueryGenerator::BuildSQLSelect('zvss_school_locality', $zvss_sqlValue, $zvss_selectColumns);
        
        $zf_executeFetchSchoolLocality = $this->Zf_AdoDB->Execute($fetchSchoolLocality);

        if(!$zf_executeFetchSchoolLocality){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolLocality->RecordCount() > 0){

                while(!$zf_executeFetchSchoolLocality->EOF){
                    
                    //$results = $zf_executeFetchSchoolLocality->GetRows();
                    $results = $zf_executeFetchSchoolLocality->fields;
                    return $results;
                    
                }
            }
        }
        
    }

}

?>
