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

class Manage_school_hostels_Model extends Zf_Model {
    
    
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
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR THE ADDITION OF A NEW
     * CLASS INTO THE SCHOOL.
     * -------------------------------------------------------------------------
     */
    public function processAddNewHostel($identificationCode) {
        
        //Decode the identification code
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        $schoolSystemCode = $identificationArray[2];

        //Here we collect all the class data  
        $this->zf_formController->zf_postFormData('schoolHostelName')
                ->zf_validateFormData('zf_maximumLength', 30, 'Hostel name')
                ->zf_validateFormData('zf_minimumLength', 5, 'Hostel name')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Hostel name')
                
                ->zf_postFormData('schoolHostelGender')
                ->zf_validateFormData('zf_maximumLength', 20, 'Hostel gender')
                ->zf_validateFormData('zf_minimumLength', 2, 'Hostel gender')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Hostel gender')
        
                ->zf_postFormData('schoolHostelCapacity')
                ->zf_validateFormData('zf_maximumLength', 20, 'Hostel capacity')
                ->zf_validateFormData('zf_minimumLength', 2, 'Hostel capacity')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Hostel capacity');


        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();


        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //print_r($this->_validResult); print_r($this->_errorResult); exit();//This is strictly for debugging purpose

        if (empty($this->_errorResult)) {
            
            //print_r($this->_validResult); exit();//This is strictly for debugging purpose
            
            foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

              if($zvss_fieldName == 'schoolHostelName'){

                  $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue); 

              }

            }
             
            $schoolHostelCode = $schoolSystemCode . ZVSS_CONNECT . Zf_Core_Functions::Zf_CleanName($this->_validResult['schoolHostelName']);
            
            $zvss_value["schoolHostelCode"] = Zf_QueryGenerator::SQLValue($schoolHostelCode);
            
            //This is the status column against which we compare.
            $zvss_columns = array('schoolHostelName', 'schoolHostelCode');


            //Generate the SQL Query
            $zvss_selectSchoolHostels = Zf_QueryGenerator::BuildSQLSelect('zvss_school_hostels', $zvss_value, $zvss_columns);
            

            //Execute the SQL Query
            $zvss_executeSelectSchoolHostels = $this->Zf_AdoDB->Execute($zvss_selectSchoolHostels);

            //Get the execution results
            if(!$zvss_executeSelectSchoolHostels){

                 echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            }else{

                 //The the result count
                 if($zvss_executeSelectSchoolHostels->RecordCount() > 0){

                    //There is a class with a similar name so throw an exception and re-direct to new class page
                    Zf_SessionHandler::zf_setSessionVariable("hostel_setup", "hostel_existence_error");

                    $zf_errorData = array("zf_fieldName" => "schoolHostelName", "zf_errorMessage" => "* This hostel already exists!!.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_hostels', $identificationCode);
                    exit();
                     
                 }else{
                     
                     //There is a no class with a similar name so insert into the database
                     foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

                        $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue);

                     }
                     
                     //Other database values
                     $zvss_value["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
                     $zvss_value["schoolHostelCode"] = Zf_QueryGenerator::SQLValue($schoolHostelCode);
                     $zvss_value["schoolHostelOccupancy"] = Zf_QueryGenerator::SQLValue(0);
                     $zvss_value["hostelStatus"] = Zf_QueryGenerator::SQLValue(0);
                     
                     //Build the insert SQL queries
                    $insertSchoolHostels = Zf_QueryGenerator::BuildSQLInsert('zvss_school_hostels', $zvss_value);
                    
                    $executeInsertSchoolHostels = $this->Zf_AdoDB->Execute($insertSchoolHostels);
                            
                    if(!$executeInsertSchoolHostels){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{
                        
                        //Redirect to the manage classes section.
                        Zf_SessionHandler::zf_setSessionVariable("hostel_setup", "hostel_setup_success");
                        Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_hostels', $identificationCode);
                        exit();

                    }
                     
                 }

             }

            } else {

              //print_r($this->_errorResult); exit();//This is strictly for debugging purpose
              Zf_SessionHandler::zf_setSessionVariable("hostel_setup", "hostel_setup_error");
              Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
              Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_hostels', $identificationCode);
              exit();

            }
        
    }
    

    
    /**
     * =========================================================================
     * THE PUBLIC AND PRIVATE METHODS BELOW ARE RESPONSIBLE FOR BUILDING THE 
     * LOGIC THAT FETCHES AND RENDERS ALL THE CLASS AND STREAM INFORMATION. 
     * =========================================================================
     */
   
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR GETTING THE GENERAL 
     * CLASS AND STREAM BASED INFORMATION
     * -------------------------------------------------------------------------
     */
    public function getSchoolHostels($schoolSystemCode){
        
        $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
                
        $schoolHostels = $this->fetchHostelInformation($schoolSystemCode);
        
        //echo "<pre>"; print_r($schoolHostels); echo "</pre>";
        
        $school_hostels = "";
        
        if($schoolHostels == 0){
            
            $school_hostels .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Hostel Overview Warning!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There are no hostels/domitories yet! You need to add atleast one hostel/dormitory to have a class overview.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
            $school_hostels .= '<div class="row">';
            
            $school_hostels .= '<div class="col-lg-12col-md-12 col-sm-12 col-xs-12 margin-bottom-15">
                                        <div class="school-content-wrapper">
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <h3>Hostel/ Dormitory Information</h3>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 action_buttons">';

                             //These are the action parameters
                             $editHostel = Zf_SecureData::zf_data_encode($identificationCode . ZVSS_CONNECT . 'editHostel' . ZVSS_CONNECT . $schoolSystemCode);
                             $viewHostel = Zf_SecureData::zf_data_encode($identificationCode . ZVSS_CONNECT . 'viewHostel' . ZVSS_CONNECT . $schoolSystemCode);

                             $school_hostels .= '<a href="' . ZF_ROOT_PATH . 'main_school_admin' . DS . 'manage_school_class_details' . DS . $editHostel . '" title="Edit ' . $schoolClassName . '"><i class="fa fa-edit"></i></a>&nbsp;
                                                    <a href="' . ZF_ROOT_PATH . 'main_school_admin' . DS . 'manage_school_class_details' . DS . $viewHostel . '" title="View ' . $schoolClassName . '"><i class="fa fa-bars"></i></a>&nbsp; ';
                        

                            $school_hostels .= '</div>
                                                </div>
                                                <hr>
                                                <div class="school-class-inner-content scroller"  data-always-visible="1" data-rail-visible="0">
                                                    <div class="table-responsive" style="margin-right: 5px !important;">
                                                        ';
                                                        
                                                        $school_hostels .= '<table class="table table-striped table-bordered table-hover">
                                                                                <thead>
                                                                                        <tr>
                                                                                            <th>Hostel/Dorm Name</th><th>Hostel/Dorm Gender</th><th>Bed Capacity</th><th>Bed Occupancy</th><th>Bed Availability</th><th>Dorm Master/Matron</th>
                                                                                        </tr>
                                                                                </thead>
                                                                                <tbody>';
            
                                                        foreach ($schoolHostels as  $value) {

                                                            $schoolHostelName = $value['schoolHostelName']; $schoolHostelGender =  $value['schoolHostelGender']; $schoolHostelCode =  $value['schoolHostelCode'];
                                                            $schoolHostelCapacity = $value['schoolHostelCapacity']; $schoolHostelOccupancy =  $value['schoolHostelOccupancy'];
                                                            $schoolHostelAvailability = $schoolHostelCapacity - $schoolHostelOccupancy;

                                                            $school_hostels .= '<tr><td>'.$schoolHostelName.'</td><td>'.$schoolHostelGender.'</td><td>'.$schoolHostelCapacity.'</td><td>'.$schoolHostelOccupancy.'</td><td class="content-table-flags">'.$schoolHostelAvailability.'</td><td>Mathew Juma</td></tr>';                                        

                                                        }
            
                           $school_hostels .= '</tbody>
                                           </table>
                                       </div>  
                                    </div>
                                  <div class="clearfix  margin-bottom-5"></div>
                                </div>
                              </div>     
                           </div>';

                    }

                    echo $school_hostels;
        
    }
    
   
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * HOSTELS INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchHostelInformation($schoolSystemCode){
        
        $zvss_sqlValue["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
        
        $fetchSchoolHostels = Zf_QueryGenerator::BuildSQLSelect('zvss_school_hostels', $zvss_sqlValue);
        
        $zf_executeFetchSchoolHostels= $this->Zf_AdoDB->Execute($fetchSchoolHostels);

        if(!$zf_executeFetchSchoolHostels){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolHostels->RecordCount() > 0){

                while(!$zf_executeFetchSchoolHostels->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolHostels->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolHostels->fields;
                    $results = $zf_executeFetchSchoolHostels->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    

}

?>
