 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $newAgencyType = "addNewAgencyType";
    
    $newAgencyParameters = $identificationCode.ZVSS_CONNECT.$newAgencyType;
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "ProcessAgencyInformation", $newAgencyParameters); ?>" method="post" class="form-horizontal" >
    <div class="form-wizard">
        <div class="form-body">
           
            <div class="tab-content">
                <!-- START OF SCHOOL SETUP FORM-->
                <div class="tab-pane active" id="basicAgencyTypeInfo">
                    <h3 class="form-section form-title">Add new vendor type</h3>    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Vendor Name:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="agencyTypeName" placeholder="Bank, MTS, Mobile Money, Collections, ...." value="<?php echo $zf_formHandler->zf_getFormValue("agencyTypeName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("agencyTypeName") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Vendor Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="agencyTypeAlias" placeholder="Any alias name" value="<?php echo $zf_formHandler->zf_getFormValue("agencyTypeAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("agencyTypeAlias") ?>
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
