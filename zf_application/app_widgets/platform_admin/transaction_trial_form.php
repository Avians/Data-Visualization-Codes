 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
    
    //echo $identificationCode."<br><br>";
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "transactionTrial", $identifictionCode); ?>" method="post" class="form-horizontal" >
    <div class="form-wizard">
        <div class="form-body">
           
            <div class="tab-content">
                <!-- START OF SCHOOL SETUP FORM-->
                <div class="tab-pane active" id="basicAgencyTypeInfo">
                    <h3 class="form-section form-title">Customer Info</h3>
                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">ID/PP Number:</label>
                                <div class="col-md-8">
                                    <input type="text" id="customerId" name="idNumber" class="form-control"  placeholder="25138058" value="<?php echo $zf_formHandler->zf_getFormValue("idNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("idNumber") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div id="selectedCustomerForm"></div>
                    
                    <!-- This two customer forms can automatically be hidden and shown on call-->
                    <div id="oldCustomerForm">
                        
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">First Name:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="firstName" class="form-control" placeholder="Athias" value="<?php echo $zf_formHandler->zf_getFormValue("firstName"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("firstName") ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Middle Name:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="middleName" class="form-control" placeholder="Avians" value="<?php echo $zf_formHandler->zf_getFormValue("middleName"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("middleName") ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Last Name:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="lastName" class="form-control" placeholder="Athlan" value="<?php echo $zf_formHandler->zf_getFormValue("lastName"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("lastName") ?>
                                        </span>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Mobile Number:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="mobileNumber" class="form-control" placeholder="+123 123 456 789" value="<?php echo $zf_formHandler->zf_getFormValue("mobileNumber"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("mobileNumber") ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                    <!-- This two customer forms can automatically be hidden and shown on call--> 
                    

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

