 <?php

class students_admission_forms_Model extends Zf_Model {

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
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR FETCHING THE CLASSES
     * AND THEN BUILDING AN OPTION LIST.
     * -------------------------------------------------------------------------
     */
    public function zvss_confirmStudentAdmissionForms($schoolSystemCode) {
        
        $form_results = $this->fetchStudentAdmissionFormsInformation($schoolSystemCode);
        
        if($form_results != 0){
            
            $new_form = "";
            
            foreach ($form_results as $value) {
                
                $generalInformation = $value['generalInformation']; $parentInformation =  $value['parentInformation']; $contactInformation =  $value['contactInformation'];
                $medicalInformation = $value['medicalInformation']; $sponsorsInformation =  $value['sponsorsInformation']; $subjectInformation =  $value['subjectInformation'];
                $feesInformation = $value['feesInformation']; $sportsInformation = $value['sportsInformation']; 
  
            }
            
            $new_form .= '
            <div class="tab-content">
                <!-- START OF SCHOOL SETUP FORM-->
                <div class="tab-pane active" id="basicSchoolInfo">
                    <h3 class="form-section form-title">Modify students\' admission forms</h3> 
                    <div class="alert alert-info">
                        <button class="close" data-dismiss="alert"></button>
                        Select form types that you want to be visible during student admission
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="checkbox-list">
                                        <label class="checkbox-inline">
                                        <input type="checkbox" name="generalInformation" ';
                                        if($generalInformation == 1){ $new_form .=' checked="checked" value="1" '; }else{ $new_form .='  value="1" ';}
                                        $new_form .='>General Student Information Form</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox-list">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="parentInformation" ';
                                            if($parentInformation == 1){ $new_form .=' checked="checked" value="1" '; }else{ $new_form .='  value="1" ';}
                                            $new_form .='>Parent/Guardian Information Form</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="checkbox-list">
                                        <label class="checkbox-inline">
                                        <input type="checkbox" name="contactInformation" ';
                                        if($contactInformation == 1){ $new_form .=' checked="checked" value="1" '; }else{ $new_form .='  value ="1" ';}    
                                        $new_form .='>Student Contact Information Form</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox-list">
                                        <label class="checkbox-inline">
                                        <input type="checkbox" name="medicalInformation" ';
                                        if($medicalInformation == 1){ $new_form .=' checked="checked" value="1" '; }else{ $new_form .='  value ="1" ';}
                                        $new_form .='>Student Medical Information Form</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="checkbox-list">
                                        <label class="checkbox-inline">
                                        <input type="checkbox" name="sponsorsInformation" ';
                                        if($sponsorsInformation == 1){ $new_form .=' checked="checked" value="1" '; }else{ $new_form .='  value ="1" ';}
                                        $new_form .='>Student Sponsors Information Form</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox-list">
                                        <label class="checkbox-inline">
                                        <input type="checkbox" name="subjectInformation" ';
                                        if($subjectInformation == 1){ $new_form .=' checked="checked" value="1" '; }else{ $new_form .='  value ="1" ';}
                                        $new_form .='>Student Subject Information Form</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <div class="checkbox-list">
                                        <label class="checkbox-inline">
                                        <input type="checkbox" name="feesInformation" ';
                                        if($feesInformation == 1){ $new_form .=' checked="checked" value="1" '; }else{ $new_form .='  value ="1" ';}
                                        $new_form .='>Student Fees Information Form</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkbox-list">
                                        <label class="checkbox-inline">
                                        <input type="checkbox" name="sportsInformation" ';
                                        if($sportsInformation == 1){ $new_form .=' checked="checked" value="1" '; }else{ $new_form .='  value ="1" ';}
                                        $new_form .='>Student Sports Information Form</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->

                </div>
                <!-- END OF SCHOOL SETUP FORM-->
                
            </div>
        </div>
        <div class="form-actions fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-offset-5 col-md-7">
                        <button type="submit" class="btn blue button-submit">
                            Submit <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                    </div>
                </div>
            </div>
        ';
         
            return $new_form;
            
        }else{
            
            return 0;
            
        }

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
        
        $zf_executeFetchStudentAdmissionForms= $this->Zf_AdoDB->Execute($fetchStudentAdmissionForms);

        if(!$zf_executeFetchStudentAdmissionForms){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchStudentAdmissionForms->RecordCount() > 0){

                while(!$zf_executeFetchStudentAdmissionForms->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolClasses->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
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
