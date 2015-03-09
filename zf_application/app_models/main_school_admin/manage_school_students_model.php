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

class Manage_school_students_Model extends Zf_Model {
    
    
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
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR THE ADDITION OF CREATION
     * AND MODIFICATION OF STUDENTS ADMISSION FORMS
     * -------------------------------------------------------------------------
     */
    public function processStudentsAdmissionForms($identificationCode) {
        
        //Decode the identification code
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        $schoolSystemCode = $identificationArray[2];

        //Here we collect all the class data  
        @$this->zf_formController->zf_postFormData('generalInformation')
                                 ->zf_postFormData('parentInformation')
                                 ->zf_postFormData('contactInformation')
                                 ->zf_postFormData('medicalInformation')
                                 ->zf_postFormData('sponsorsInformation')
                                 ->zf_postFormData('subjectInformation')
                                 ->zf_postFormData('feesInformation')
                                 ->zf_postFormData('sportsInformation');


        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();


        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //print_r($this->_validResult); print_r($this->_errorResult); exit();//This is strictly for debugging purpose

        if(empty($this->_errorResult) && !empty($this->_validResult)) {
            
            //print_r($this->_validResult); exit();//This is strictly for debugging purpose
            
            //1. select from where schoolSytemCode is equal to the above on.
            $zvss_schoolSystemCodeValue["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
            
            //Generate the SQL Query for selecting Student Admission Parameters
            $zvss_selectStudentAdmissionParameters = Zf_QueryGenerator::BuildSQLSelect('zvss_student_admission_parameters', $zvss_schoolSystemCodeValue);
            
            //Execute the SQL Query for selecting Student Admission Parameters
            $zvss_executeSelectStudentAdmissionParameters = $this->Zf_AdoDB->Execute($zvss_selectStudentAdmissionParameters);
            
            //Get the execution results
            if(!$zvss_executeSelectStudentAdmissionParameters){

                 echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            }else{
                
                foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {
                
                    $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue); 

                }
                
                $tableColumns = array("generalInformation", "parentInformation", "contactInformation", "medicalInformation", "sponsorsInformation", "subjectInformation", "feesInformation", "sportsInformation");
                
                foreach ($tableColumns as $value) {
                    
                    if(!array_key_exists($value, $this->_validResult)){
                        
                       $zvss_value[$value] = Zf_QueryGenerator::SQLValue(0); 
                    }
                    
                }
                
                if($zvss_executeSelectStudentAdmissionParameters->RecordCount() > 0){
                    
                    //Update the resulting value from the database
                    
                    //This are the where column against which we compare.
                    $zvss_columns['schoolSystemCode'] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
                    
                    //Generate the SQL Query for updating the class stream
                    $zvss_updateStudentAdmissionParameters = Zf_QueryGenerator::BuildSQLUpdate('zvss_student_admission_parameters', $zvss_value, $zvss_columns);
                    
                    //echo $zvss_updateStudentAdmissionParameters; exit();
                    
                    //Execute the SQL Query for selecting Student Admission Parameters
                    $zvss_executeUpdateStudentAdmissionParameters  = $this->Zf_AdoDB->Execute($zvss_updateStudentAdmissionParameters);
                    
                    //Confirm query execution
                    if(!$zvss_executeUpdateStudentAdmissionParameters){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{
                        
                        Zf_SessionHandler::zf_setSessionVariable("student_forms_setup", "student_forms_updated");
                        Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_students', $identificationCode);
                        exit();

                    }
                    
                    
                }else{
                    
                    //Insert a new value into the database.
                    
                    $zvss_value["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
                    
                    //$zvss_value['schoolSystemCode'] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
                    $zvss_insertStudentAdmissionParameters = Zf_QueryGenerator::BuildSQLInsert('zvss_student_admission_parameters', $zvss_value);
                    
                    //echo $zvss_updateStudentAdmissionParameters; exit();
                    
                    //Execute the SQL Query for selecting Student Admission Parameters
                    $zvss_executeInsertStudentAdmissionParameters  = $this->Zf_AdoDB->Execute($zvss_insertStudentAdmissionParameters);
                    
                    //Confirm query execution
                    if(!$zvss_executeInsertStudentAdmissionParameters){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{

                        Zf_SessionHandler::zf_setSessionVariable("student_forms_setup", "student_forms_inserted");
                        Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_students', $identificationCode);
                        exit();

                    }
                    
                }
                
            }
           

        } else {
            
          Zf_SessionHandler::zf_setSessionVariable("student_forms_setup", "student_forms_error");
          Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
          Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_students', $identificationCode);
          

        }
        
    }
    

    
    /**
     * =========================================================================
     * THE PUBLIC AND PRIVATE METHODS BELOW ARE RESPONSIBLE FOR BUILDING THE 
     * LOGIC THAT FETCHES AND RENDERS ALL ACTIVE STUDENTS ADMISSION FORMS
     * =========================================================================
     */
   
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR GETTING ACTIVE STUDENT
     * ADMISSION FORMS
     * -------------------------------------------------------------------------
     */
    public function getStudentsAdmissionForms($schoolSystemCode){
        
        $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
                
        $studentAdmissionForms = $this->fetchStudentAdmissionFormsInformation($schoolSystemCode);
        
        //echo "<pre>"; print_r($studentAdmissionForms); echo "</pre>";
        
        $school_Student_Admission_Forms = "";
        
        if($studentAdmissionForms == 0){
            
            $school_Student_Admission_Forms .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Student Admission Forms Overview Warning!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There are no students admission forms yet! You need to add atleast one admission form to have an overview.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
            $school_Student_Admission_Forms .= '<div class="row">';
            
            $school_Student_Admission_Forms .= '<div class="col-lg-12col-md-12 col-sm-12 col-xs-12 margin-bottom-15">
                                        <div class="school-content-wrapper">
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <h3>Active (<i style="color:#3c763d !important;" class="fa fa-check"></i>) and Inactive (<i style="color:#a94442 !important;" class="fa fa-times"></i>) Students\' Admission Forms</h3>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 action_buttons">';

                             //These are the action parameters
                             $editStudentAdmissionForms = Zf_SecureData::zf_data_encode($identificationCode . ZVSS_CONNECT . 'editHostel' . ZVSS_CONNECT . $schoolSystemCode);
                             $viewStudentAdmissionForms = Zf_SecureData::zf_data_encode($identificationCode . ZVSS_CONNECT . 'viewHostel' . ZVSS_CONNECT . $schoolSystemCode);

                             $school_Student_Admission_Forms .= '<a href="' . ZF_ROOT_PATH . 'main_school_admin' . DS . 'manage_school_class_details' . DS . $editStudentAdmissionForms . '" title="Edit ' . $schoolClassName . '"><i class="fa fa-edit"></i></a>&nbsp;
                                                    <a href="' . ZF_ROOT_PATH . 'main_school_admin' . DS . 'manage_school_class_details' . DS . $viewStudentAdmissionForms . '" title="View ' . $schoolClassName . '"><i class="fa fa-bars"></i></a>&nbsp; ';
                        

                            $school_Student_Admission_Forms .= '</div>
                                                </div>
                                                <hr>
                                                <div class="school-class-inner-content scroller"  data-always-visible="1" data-rail-visible="0">
                                                    <div class="table-responsive" style="margin-right: 5px !important;">
                                                        ';
                                                        
                                                        $school_Student_Admission_Forms .= '<table class="table table-striped table-bordered table-hover">
                                                                                <thead>
                                                                                        <tr>
                                                                                            <th>General Form</th><th>Parent Form</th><th>Contact Form</th><th>Medical Form</th><th>Sponsors Form</th><th>Subjects Form</th><th>Fees Form</th><th>Sports Form</th>
                                                                                        </tr>
                                                                                </thead>
                                                                                <tbody>';
            
                                                        foreach ($studentAdmissionForms as  $value) {

                                                            $generalInformation = $value['generalInformation']; if($generalInformation == "1"){ $generalInformation = '<i style="color:#3c763d !important;" class="fa fa-check"></i>'; }else{ $generalInformation = '<i style="color:#A94442 !important;" class="fa fa-times"></i>';}
                                                            $parentInformation =  $value['parentInformation']; if($parentInformation == "1"){ $parentInformation = '<i style="color:#3c763d !important;" class="fa fa-check"></i>'; }else{ $parentInformation = '<i style="color:#A94442 !important;" class="fa fa-times"></i>';}
                                                            $contactInformation =  $value['contactInformation']; if($contactInformation == "1"){ $contactInformation = '<i style="color:#3c763d !important;" class="fa fa-check"></i>'; }else{ $contactInformation = '<i style="color:#A94442 !important;" class="fa fa-times"></i>';}
                                                            $medicalInformation = $value['medicalInformation']; if($medicalInformation == "1"){ $medicalInformation = '<i style="color:#3c763d !important;" class="fa fa-check"></i>'; }else{ $medicalInformation = '<i style="color:#A94442 !important;" class="fa fa-times"></i>';}
                                                            $sponsorsInformation =  $value['sponsorsInformation']; if($sponsorsInformation == "1"){ $sponsorsInformation = '<i style="color:#3c763d !important;" class="fa fa-check"></i>'; }else{ $sponsorsInformation = '<i style="color:#A94442 !important;" class="fa fa-times"></i>';}
                                                            $subjectInformation =  $value['subjectInformation']; if($subjectInformation == "1"){ $subjectInformation = '<i style="color:#3c763d !important;" class="fa fa-check"></i>'; }else{ $subjectInformation = '<i style="color:#A94442 !important;" class="fa fa-times"></i>';}
                                                            $feesInformation = $value['feesInformation']; if($feesInformation == "1"){ $feesInformation = '<i style="color:#3c763d !important;" class="fa fa-check"></i>'; }else{ $feesInformation = '<i style="color:#A94442 !important;" class="fa fa-times"></i>';}
                                                            $sportsInformation = $value['sportsInformation']; if($sportsInformation == "1"){ $sportsInformation = '<i style="color:#3c763d !important;" class="fa fa-check"></i>'; }else{ $sportsInformation = '<i style="color:#A94442 !important;" class="fa fa-times"></i>';}

                                                            $school_Student_Admission_Forms .= '<tr style="text-align: center !important;">'
                                                                    . '<td>'.$generalInformation.'</td>'
                                                                    . '<td>'.$parentInformation.'</td>'
                                                                    . '<td>'.$contactInformation.'</td>'
                                                                    . '<td>'.$medicalInformation.'</td>'
                                                                    . '<td>'.$sponsorsInformation.'</td>'
                                                                    . '<td>'.$subjectInformation.'</td>'
                                                                    . '<td>'.$feesInformation.'</td>'
                                                                    . '<td>'.$sportsInformation.'</td>'
                                                                    . '</tr>';                                        

                                                        }
            
                           $school_Student_Admission_Forms .= '</tbody>
                                           </table>
                                       </div>  
                                    </div>
                                  <div class="clearfix  margin-bottom-5"></div>
                                </div>
                              </div>     
                           </div>';

                    }

                    echo $school_Student_Admission_Forms;
        
    }
    
   
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * CLASS INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchStudentAdmissionFormsInformation($schoolSystemCode){
        
        $zvss_sqlValue["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
        
        $fetchStudentAdmissionForms = Zf_QueryGenerator::BuildSQLSelect('zvss_student_admission_parameters', $zvss_sqlValue);
        
        $zf_executeFetchStudentAdmissionForms = $this->Zf_AdoDB->Execute($fetchStudentAdmissionForms);

        if(!$zf_executeFetchStudentAdmissionForms){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchStudentAdmissionForms->RecordCount() > 0){

                while(!$zf_executeFetchStudentAdmissionForms->EOF){
                    
                    //print "<pre>";print_r(zf_executeFetchStudentAdmissionForms->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchStudentAdmissionForms->fields;
                    $results = $zf_executeFetchStudentAdmissionForms->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    

}

?>
