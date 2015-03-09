 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $newHostel = "addNewHostel";
    
    $manageHostelParameters = $identificationCode.ZVSS_CONNECT.$newHostel;
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("main_school_admin", "manage_school_hostels", $manageHostelParameters); ?>" method="post" class="form-horizontal" >
    <div class="form-wizard">
        <div class="form-body">
           
            <div class="tab-content">
                <!-- START OF SCHOOL SETUP FORM-->
                <div class="tab-pane active" id="basicSchoolInfo">
                    <h3 class="form-section form-title">Add new hostel/dormitory</h3>    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Hostel Name:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolHostelName" placeholder="Mara, Amboseli, JF Kennedy, Amazon ...." value="<?php echo $zf_formHandler->zf_getFormValue("schoolHostelName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolHostelName") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Hostel Gender:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="schoolHostelGender" data-placeholder="Gents Hostel, Ladies Hostel, Mixed..."  value="<?php echo $zf_formHandler->zf_getFormValue("schoolHostelGender"); ?>">
                                        <option value=""></option>
                                        <option value="Gents Hostel">Gents Hostel</option>
                                        <option value="Ladies Hostel">Ladies Hostel</option>
                                        <option value="Mixed Hostel">Mixed Hostel</option>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("schoolHostelGender") ?>
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
                                <label class="control-label col-md-4">Hostel Capacity:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="schoolHostelCapacity" placeholder="400, 500, 600, ...." value="<?php echo $zf_formHandler->zf_getFormValue("schoolHostelCapacity"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("schoolHostelCapacity") ?>
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
