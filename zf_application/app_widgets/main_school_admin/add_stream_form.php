 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $newStream = "addNewStream";
    
    $manageClassParameters = $identificationCode.ZVSS_CONNECT.$newStream;
    
    $schoolSystemCode = $zf_externalWidgetData;
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("main_school_admin", "manage_school_classes", $manageClassParameters); ?>" method="post" class="form-horizontal">
    <div class="form-wizard">
        <div class="form-body">
           
            <div class="tab-content">
                <!-- START OF SCHOOL SETUP FORM-->
                <div class="tab-pane active" id="basicSchoolInfo">
                    <h3 class="form-section form-title">Add new stream</h3>  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Class:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="schoolClassCode" data-placeholder="Form 1, Form One, Form 2, ...."  value="<?php echo $zf_formHandler->zf_getFormValue("schoolClassCode"); ?>">
                                        <?php
                                            $zf_widgetFolder = "main_school_admin"; $zf_widgetFile = "class_options.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $schoolSystemCode);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("schoolClassCode") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Stream Name:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolStreamName" placeholder="East, West, North, South, ..." value="<?php echo $zf_formHandler->zf_getFormValue("schoolStreamName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolStreamName") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Stream Capacity:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolStreamCapacity" placeholder="50, 65, 100, ...." value="<?php echo $zf_formHandler->zf_getFormValue("schoolStreamCapacity"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolStreamCapacity") ?>
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