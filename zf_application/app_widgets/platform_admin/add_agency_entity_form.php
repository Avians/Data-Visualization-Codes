 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $agencyEntity = "addAgencyTypeEntity";
    
    $agencyEntityParameters = $identificationCode.ZVSS_CONNECT.$agencyEntity;
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "ProcessAgencyInformation", $agencyEntityParameters); ?>" method="post" class="form-horizontal">
    <div class="form-wizard">
        <div class="form-body">
           
            <div class="tab-content">
                <!-- START OF SCHOOL SETUP FORM-->
                <div class="tab-pane active" id="basicSchoolInfo">
                    <h3 class="form-section form-title">Add new vendor</h3>  
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Select Vendor Type:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="agencyTypeCode" data-placeholder="Bank, MTS, Mobile Money, ...."  value="<?php echo $zf_formHandler->zf_getFormValue("agencyTypeCode"); ?>">
                                        <?php
                                            $zf_widgetFolder = "system_select_options"; $zf_widgetFile = "agency_options.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $schoolSystemCode);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("agencyTypeCode") ?>
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
                                <label class="control-label col-md-4">Vendor Name:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="agencyEntityName" placeholder="Safaricom, Chase Bank, Family Bank, ..." value="<?php echo $zf_formHandler->zf_getFormValue("agencyEntityName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("agencyEntityName") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Vendor Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="agencyEntityAlias" placeholder="Safcom, Equity, Chase, Family, ...." value="<?php echo $zf_formHandler->zf_getFormValue("agencyEntityAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("agencyEntityAlias") ?>
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