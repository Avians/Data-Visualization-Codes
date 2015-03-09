 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $newSubDepartment = "addNewSubDepartment";
    
    $manageDepartmentParameters = $identificationCode.ZVSS_CONNECT.$newSubDepartment;
    
    $schoolSystemCode = $zf_externalWidgetData;
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("main_school_admin", "manage_school_departments", $manageDepartmentParameters); ?>" method="post" class="form-horizontal">
    <div class="form-wizard">
        <div class="form-body">
           
            <div class="tab-content">
                <!-- START OF SCHOOL SETUP FORM-->
                <div class="tab-pane active" id="basicSchoolInfo">
                    <h3 class="form-section form-title">Add new sub-department</h3>  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Department:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="schoolDepartmentCode" data-placeholder="Mathematics, Languages, Finance, ...."  value="<?php echo $zf_formHandler->zf_getFormValue("schoolDepartmentCode"); ?>">
                                        <?php
                                            $zf_widgetFolder = "main_school_admin"; $zf_widgetFile = "department_options.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $schoolSystemCode);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("schoolDepartmentCode") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Sub-Department:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolSubDepartmentName" placeholder="English, Physics, Biology, Geography, ..." value="<?php echo $zf_formHandler->zf_getFormValue("schoolSubDepartmentName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolSubDepartmentName") ?>
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
<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>