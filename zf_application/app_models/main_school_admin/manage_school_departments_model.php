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

class Manage_school_departments_Model extends Zf_Model {
    
    
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
     * DEPARTMENT INTO THE SCHOOL.
     * -------------------------------------------------------------------------
     */
    public function processAddNewDepartment($identificationCode) {
        
        //Decode the identification code
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        $schoolSystemCode = $identificationArray[2];
        
        //Here we collect all the class data  
        $this->zf_formController->zf_postFormData('schoolDepartmentName')
                ->zf_validateFormData('zf_maximumLength', 30, 'Department name')
                ->zf_validateFormData('zf_minimumLength', 5, 'Department name')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Department name')
                ->zf_postFormData('schoolDepartmentAlias')
                ->zf_validateFormData('zf_maximumLength', 20, 'Department alias')
                ->zf_validateFormData('zf_minimumLength', 2, 'Department alias')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Department alias');


        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();


        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        if (empty($this->_errorResult)) {
            
            //print_r($this->_validResult); exit();//This is strictly for debugging purpose
            
            foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

              if($zvss_fieldName == 'schoolDepartmentName'){

                  $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue); 

              }

            }
             
            $schoolDepartmentCode = $schoolSystemCode . ZVSS_CONNECT . Zf_Core_Functions::Zf_CleanName($this->_validResult['schoolDepartmentName']);
            
            $zvss_value["schoolDepartmentCode"] = Zf_QueryGenerator::SQLValue($schoolDepartmentCode);
            
            //This is the status column against which we compare.
            $zvss_columns = array('schoolDepartmentName', 'schoolDepartmentCode');


            //Generate the SQL Query
            $zvss_selectSchoolDepartments = Zf_QueryGenerator::BuildSQLSelect('zvss_school_departments', $zvss_value, $zvss_columns);
            

            //Execute the SQL Query
            $zvss_executeSelectSchoolDepartments = $this->Zf_AdoDB->Execute($zvss_selectSchoolDepartments);

            //Get the execution results
            if(!$zvss_executeSelectSchoolDepartments){

                 echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

             }else{

                 //The the result count
                 if($zvss_executeSelectSchoolDepartments->RecordCount() > 0){

                    //There is a class with a similar name so throw an exception and re-direct to new class page
                    Zf_SessionHandler::zf_setSessionVariable("department_setup", "department_existence_error");

                    $zf_errorData = array("zf_fieldName" => "schoolDepartmentName", "zf_errorMessage" => "* This department already exists!!.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_departments', $identificationCode);
                    exit();
                     
                 }else{
                     
                     //There is a no class with a similar name so insert into the database
                     foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

                        $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue);

                     }
                     
                     //Other database values
                     $zvss_value["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
                     $zvss_value["schoolDepartmentCode"] = Zf_QueryGenerator::SQLValue($schoolDepartmentCode);
                     $zvss_value["departmentStatus"] = Zf_QueryGenerator::SQLValue(0);
                     
                     //Build the insert SQL queries
                    $insertSchoolDepartments = Zf_QueryGenerator::BuildSQLInsert('zvss_school_departments', $zvss_value);
                    
                    $executeInsertSchoolDepartments = $this->Zf_AdoDB->Execute($insertSchoolDepartments);
                            
                    if(!$executeInsertSchoolDepartments){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{
                        
                        //Redirect to the manage classes section.
                        Zf_SessionHandler::zf_setSessionVariable("department_setup", "department_setup_success");
                        Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_departments', $identificationCode);
                        exit();

                    }
                     
                 }

             }

            } else {

              //print_r($this->_errorResult); exit();//This is strictly for debugging purpose
              Zf_SessionHandler::zf_setSessionVariable("department_setup", "department_setup_error");
              Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
              Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_departments', $identificationCode);
              exit();

            }
    }
    

    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR THE ADDITION OF A NEW
     * SUB DEPARTMENT INTO THE SCHOOL.
     * -------------------------------------------------------------------------
     */
    public function processAddNewSubDepartment($identificationCode) {
        
        //Decode the identification code
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        $schoolSystemCode = $identificationArray[2];
        
        //Recieve the stream data.
        $this->zf_formController->zf_postFormData('schoolDepartmentCode')
                ->zf_validateFormData('zf_maximumLength', 200, 'Department name')
                ->zf_validateFormData('zf_minimumLength', 5, 'Department name')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Department name')
                
                ->zf_postFormData('schoolSubDepartmentName')
                ->zf_validateFormData('zf_maximumLength', 30, 'Sub-department name')
                ->zf_validateFormData('zf_minimumLength', 2, 'Sub-department name')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Sub-department name');


        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();


        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        if (empty($this->_errorResult)) {
            
            //print_r($this->_validResult); exit();//This is strictly for debugging purpose
            
            foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

              if($zvss_fieldName == 'schoolDepartmentCode'){

                  $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue); 

              }

            }
             
            $schoolSubDepartmentCode = $this->_validResult['schoolDepartmentCode'].ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['schoolSubDepartmentName']);
            
            $zvss_value["schoolSubDepartmentCode"] = Zf_QueryGenerator::SQLValue($schoolSubDepartmentCode);
            
            //This is the status column against which we compare.
            $zvss_columns = array('schoolSubDepartmentName', 'schoolSubDepartmentCode');


            //Generate the SQL Query
            $zvss_selectSchoolSubDepartments = Zf_QueryGenerator::BuildSQLSelect('zvss_school_sub_departments', $zvss_value, $zvss_columns);
            

            //Execute the SQL Query
            $zvss_executeSelectSchoolSubDepartments = $this->Zf_AdoDB->Execute($zvss_selectSchoolSubDepartments);
            
            //Get the execution results
            if(!$zvss_executeSelectSchoolSubDepartments){

                 echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

             }else{

                 //The the result count
                 if($zvss_executeSelectSchoolSubDepartments->RecordCount() > 0){

                    //There is a class with a similar name so throw an exception and re-direct to new class page
                    Zf_SessionHandler::zf_setSessionVariable("department_setup", "sub_department_existence_error");

                    $zf_errorData = array("zf_fieldName" => "schoolSubDepartmentName", "zf_errorMessage" => "* This sub-department already exists!!.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_departments', $identificationCode);
                    exit();
                     
                 }else{
                     
                     //There is a no class with a similar name so insert into the database
                     foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

                        $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue);

                     }
                     
                     //Other database values
                     $zvss_value["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
                     $zvss_value["schoolSubDepartmentCode"] = Zf_QueryGenerator::SQLValue($schoolSubDepartmentCode);
                     
                     //Build the insert SQL queries
                    $insertSubDepartment= Zf_QueryGenerator::BuildSQLInsert('zvss_school_sub_departments', $zvss_value);
                    
                    $executeInsertSubDepartment = $this->Zf_AdoDB->Execute($insertSubDepartment);
                            
                    if(!$executeInsertSubDepartment){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{
                        
                        //Redirect to the manage classes section.
                        Zf_SessionHandler::zf_setSessionVariable("department_setup", "sub_department_setup_success");
                        Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_departments', $identificationCode);
                        exit();

                    }
                     
                     
                 }
             }

            
        }else{
            
            //print_r($this->_errorResult); exit();//This is strictly for debugging purpose
            
            Zf_SessionHandler::zf_setSessionVariable("department_setup", "sub_department_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_departments', $identificationCode);
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
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR CONFIRMING IF A 
     * DEPARTMENT IS ALREADY EXISTING
     * -------------------------------------------------------------------------
     */
    public function confirmDepartmentsPresence($schoolSystemCode){
        
        //This is for confirming departments
        $confirmDepartment = $this->fetchDepartmentsInformation($schoolSystemCode);
        
        if($confirmDepartment == 0){
                                                        
            echo '<h3 class="form-section form-title">Add Department Warning!!</h3> 
                    <div class="school-class-inner-content">
                        <span class="content-view-errors" >
                            There are no departments yet! You need to add atleast one department to be able to add sub departments.
                        </span>
                   </div>';

        }else{

            //LOAD STREAM SETUP FORM
            Zf_ApplicationWidgets::zf_load_widget("main_school_admin", "add_sub_department_form.php", $schoolSystemCode);

        }
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR GETTING THE GENERAL 
     * DEPARTMENTS AND SUB DEPARTMENTS BASED INFORMATION
     * -------------------------------------------------------------------------
     */
    public function getSchoolDepartments($schoolSystemCode){
        
        $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
                
        $schoolDepartments = $this->fetchDepartmentsInformation($schoolSystemCode);
        
        $school_departments = "";
        
        if($schoolDepartments == 0){
            
            $school_departments .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Departments Overview Warning!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There are no departments yet! You need to add atleast one department to have a department overview.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
            //echo "<pre>"; print_r($schoolDepartments); echo "</pre>";
            
            $school_departments .= '<div class="row">';
            
            foreach ($schoolDepartments as  $value) {
                
                $schoolDepartmentName = $value['schoolDepartmentName']; $schoolDepartmentCode =  $value['schoolDepartmentCode'];
                
                $subDepartments = $this->fetchSubDepartmentsInformation($schoolDepartmentCode); 
                
                //print_r($subDepartments);
                
                //These are the action parameters
                $editDepartment = Zf_SecureData::zf_data_encode($identificationCode.ZVSS_CONNECT.'editClass'.ZVSS_CONNECT.$schoolDepartmentCode);
                $viewDepartment = Zf_SecureData::zf_data_encode($identificationCode.ZVSS_CONNECT.'viewClass'.ZVSS_CONNECT.$schoolDepartmentCode);
                
                
                $school_departments .= '<div class="col-lg-6 col-md-9 col-sm-8 col-xs-12 margin-bottom-15">
                                        <div class="school-content-wrapper">
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <h3>'.$schoolDepartmentName.' Department</h3>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 action_buttons">
                                                    <a href="#" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
                                                    <a href="#" title="View"><i class="fa fa-bars"></i></a>&nbsp;
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="school-class-inner-content scroller"  data-always-visible="1" data-rail-visible="0">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 margin-bottom-10">
                                                        <div class="department-head-image-wrapper">
                                                            <div>
                                                                Image goes here
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 margin-bottom-10">
                                                        <div class="department-content-wrapper">
                                                            <h3>Head of Department Information</h3>
                                                            <hr>
                                                            <div class="school-profile-inner-content">
                                                                <div><span class="inner-content-legends">Full Name:</span> Athias Avians </div>
                                                                <div class="clearfix"></div>
                                                                <div><span class="inner-content-legends">Phone No:</span> +254727 074 108 </div>
                                                                <div class="clearfix"></div>
                                                                <div><span class="inner-content-legends">Email:</span> athias@zilasschool.com</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                ';
                                                if($subDepartments == 0){
                                                       
                                                    $school_departments .= '<hr><span class="content-view-errors" >No sub-departments have been created in '.$schoolDepartmentName.' department</span>';
                                                        
                                                }else{
                                                    
                                                    $school_departments .= '
                                                                        <div class="table-responsive" style="margin-right: 5px !important;">
                                                                            <table class="table table-striped table-bordered table-hover">
                                                                                <thead>
                                                                                    <tr>
                                                                                       <th>Sub Dept. Name</th><th>Head of Sub Dept.</th><th>Email Address</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>';
                                                    
                                                        foreach ($subDepartments as $value) {
                                                            
                                                            $schoolSubDepartmentName = $value['schoolSubDepartmentName'];
                                                            
                                                            $school_departments .= '<tr><td>'.$schoolSubDepartmentName.'</td><td>Mathew Juma</td><td>athias85@gmail.com</td></tr>';
                                                            
                                                        }
                                                                                    
                                                    $school_departments .='     </tbody>
                                                                          </table>
                                                                      </div>';

                                                }
                
                        $school_departments .= '</div>
                                            <div class="clearfix  margin-bottom-5"></div>
                                        </div>
                                  </div>';
                
                
            }
            
            $school_departments .= '</div>';
            
            
        }
        
        echo $school_departments;
        
    }
    
   
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * DEPARTMENTS INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchDepartmentsInformation($schoolSystemCode){
        
        $zvss_sqlValue["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
        
        $fetchSchoolClasses = Zf_QueryGenerator::BuildSQLSelect('zvss_school_departments', $zvss_sqlValue);
        
        $zf_executeFetchSchoolClasses= $this->Zf_AdoDB->Execute($fetchSchoolClasses);

        if(!$zf_executeFetchSchoolClasses){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolClasses->RecordCount() > 0){

                while(!$zf_executeFetchSchoolClasses->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolClasses->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchSchoolClasses->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
   
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * SUB DEPARTMENTS INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchSubDepartmentsInformation($schoolDepartmentCode){
        
        $deparmentFilter = explode(ZVSS_CONNECT, $schoolDepartmentCode); $schoolSystemCode = $deparmentFilter[0];
        
        $zvss_sqlValue["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
        $zvss_sqlValue["schoolDepartmentCode"] = Zf_QueryGenerator::SQLValue($schoolDepartmentCode);
        
        $fetchSchoolSubDepartments = Zf_QueryGenerator::BuildSQLSelect('zvss_school_sub_departments', $zvss_sqlValue);
        
        $zf_executeFetchSchoolSubDepartments = $this->Zf_AdoDB->Execute($fetchSchoolSubDepartments);

        if(!$zf_executeFetchSchoolSubDepartments){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolSubDepartments->RecordCount() > 0){

                while(!$zf_executeFetchSchoolSubDepartments->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolClasses->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchSchoolSubDepartments->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    

}

?>
