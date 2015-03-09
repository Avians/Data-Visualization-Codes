 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $newClass = "addNewClass";
    
    $manageClassParameters = $identificationCode.ZVSS_CONNECT.$newClass;
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("main_school_admin", "manage_school_classes", $manageClassParameters); ?>" method="post" class="form-horizontal" >
    <div class="form-wizard">
        <div class="form-body">
           
            <div class="tab-content">
                <!-- START OF SCHOOL SETUP FORM-->
                <div class="tab-pane active" id="basicSchoolInfo">
                    <h3 class="form-section form-title">Add new class</h3>    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Class Name:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolClassName" placeholder="Form 1 or Class 1, Form 2 or Class 2, ...." value="<?php echo $zf_formHandler->zf_getFormValue("schoolClassName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolClassName") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Class Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolClassAlias" placeholder="Any alias name" value="<?php echo $zf_formHandler->zf_getFormValue("schoolClassAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolClassAlias") ?>
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
