 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $newOutletType = "addNewAgentType";
    
    $newOutletParameters = $identificationCode.ZVSS_CONNECT.$newOutletType;
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "ProcessAgencyInformation", $newOutletParameters); ?>" method="post" class="form-horizontal" >
    <div class="form-wizard">
        <div class="form-body">
           
            <div class="tab-content">
                <!-- START OF SCHOOL SETUP FORM-->
                <div class="tab-pane active" id="basicAgencyTypeInfo">
                    <h3 class="form-section form-title">Add new agent type</h3>    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Agent Type Name:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="agentTypeName" placeholder="Direct, Managed, Franchise, ...." value="<?php echo $zf_formHandler->zf_getFormValue("agentTypeName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("agentTypeName") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Agent Type Alias:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="agentTypeAlias" placeholder="Any alias name" value="<?php echo $zf_formHandler->zf_getFormValue("agentTypeAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("agentTypeAlias") ?>
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
