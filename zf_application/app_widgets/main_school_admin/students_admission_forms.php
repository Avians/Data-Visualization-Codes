 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
    
    $studentsAdmissionForm = "studentsAdmissionForm";
    
    $manageStudentsParameters = $identificationCode.ZVSS_CONNECT.$studentsAdmissionForm;
    
    $confrimStudentAdmissionForms = $zf_model_data->zvss_confirmStudentAdmissionForms($identifictionArray[2]);
    
    //echo $confrimStudentAdmissionForms;
    
    
    if($confrimStudentAdmissionForms === 0){ 
           
        
    ?>
        <!--Start of the Original Form-->
        <form action="<?php Zf_GenerateLinks::basic_internal_link("main_school_admin", "manage_school_students", $manageStudentsParameters); ?>" method="post" class="form-horizontal" >
                <div class="form-body">
                    <div class="tab-content">
                        <!-- START OF SCHOOL SETUP FORM-->
                        <div class="tab-pane active" id="basicSchoolInfo">
                            <h3 class="form-section form-title">Modify students' admission forms</h3> 
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
                                                <input type="checkbox" name="generalInformation" value="1">General Student Information Form</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkbox-list">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="parentInformation" value="1">Parent/Guardian Information Form</label>
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
                                                <input type="checkbox" name="contactInformation" value="1">Student Contact Information Form</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkbox-list">
                                                <label class="checkbox-inline">
                                                <input type="checkbox" name="medicalInformation" value="1">Student Medical Information Form</label>
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
                                                <input type="checkbox" name="sponsorsInformation" value="1">Student Sponsors Information Form</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkbox-list">
                                                <label class="checkbox-inline">
                                                <input type="checkbox" name="subjectInformation" value="1">Student Subject Information Form</label>
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
                                                <input type="checkbox" name="feesInformation" value="1">Student Fees Information Form</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkbox-list">
                                                <label class="checkbox-inline">
                                                <input type="checkbox" name="sportsInformation" value="1">Student Sports Information Form</label>
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
                </div>
        </form>
        <!--End of the Original Form-->
    <?php 
    
    }else{
      ?>
        <form action="<?php Zf_GenerateLinks::basic_internal_link("main_school_admin", "manage_school_students", $manageStudentsParameters); ?>" method="post" class="form-horizontal" >
            <div class="form-body">  
      <?php
        echo $confrimStudentAdmissionForms;
      ?>
            </div>
       </form>   
      <?php 
    }
    
?>

