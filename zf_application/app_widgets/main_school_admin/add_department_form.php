 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $newDepartment = "addNewDepartment";
    
    $manageDepartmentParameters = $identificationCode.ZVSS_CONNECT.$newDepartment;
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("main_school_admin", "manage_school_departments", $manageDepartmentParameters); ?>" method="post" class="form-horizontal" >
    <div class="form-wizard">
        <div class="form-body">
           
            <div class="tab-content">
                <!-- START OF SCHOOL SETUP FORM-->
                <div class="tab-pane active" id="basicSchoolInfo">
                    <h3 class="form-section form-title">Add new department</h3>    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Department Name:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolDepartmentName" placeholder="Mathematics, Languages, Finance ...." value="<?php echo $zf_formHandler->zf_getFormValue("schoolDepartmentName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolDepartmentName") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Department Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolDepartmentAlias" placeholder="Any alias name" value="<?php echo $zf_formHandler->zf_getFormValue("schoolDepartmentAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolDepartmentAlias") ?>
                                    </span>
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
    </div>
</form>
