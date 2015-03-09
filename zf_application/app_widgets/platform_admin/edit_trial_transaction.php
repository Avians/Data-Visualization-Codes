 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
    
    //echo $identificationCode."<br><br>";
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "UpdateTrialTransaction", $identifictionCode); ?>" method="post" class="form-horizontal" >
    <h3 class="form-section form-title">Edit Agent Types</h3>    
    <div class="row">
        <div class="col-md-6" style="border-right: 1px solid #efefef; min-height: 100px !important; ">
            <div class="form-group">
                <label class="control-label col-md-4">Transaction ID:</label>
                <div class="col-md-8">
<!--                    <select class="form-control select2me transactionID" id="transactionID" name="idNumber" data-placeholder="123456"  value="<?php echo $zf_formHandler->zf_getFormValue("userIdentificationCode"); ?>">
                        <?php
                            $zf_widgetFolder = "platform_admin"; $zf_widgetFile = "select_options.php"; $zf_externalWidgetData = "editTrialTransaction";
                            //Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $zf_externalWidgetData);
                        ?>
                    </select>-->
                   <input type="text" id="transactionID" name="idNumber" class="form-control transactionID"  placeholder="25138058" value="">
                                    
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->
    
    <!--Here we show the dynamically generated form-->
    <div id="prefilledTrialTransactionForm"></div>
    <div id="oldTrialForm">
        <div class="form-body">

            <!-- START OF TRANSACTION UPDATE FORM-->

                <h3 class="form-section form-title">Customer Info <small style="color: indianred; font-size: 11px !important;">&nbsp;&nbsp;*Do not leave any field empty</small></h3>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">First Name:</label>
                            <div class="col-md-8">
                                <input type="text" name="firstName" class="form-control" placeholder="Athias" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">Middle Name:</label>
                            <div class="col-md-8">
                                <input type="text" name="middleName" class="form-control" placeholder="Avians" value="">
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
                                <input type="text" name="lastName" class="form-control"  placeholder="athlan"  value="">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label col-md-4">Mobile Number:</label>
                            <div class="col-md-8">
                                <input type="text" name="mobileNumber" class="form-control" placeholder="+123 123 456 789" value="">
                            </div>
                        </div>
                    </div>
                    <!--/span-->
                </div>
                <!--/row-->

            <!-- END OF TRANSACTION UPDATE FORM-->

        </div>
    </div>
    <div class="form-actions fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-offset-5 col-md-7">
                    <button type="submit" class="btn green button-submit">
                        Submit <i class="m-icon-swapright m-icon-white"></i>
                    </button>
                </div>
            </div>
        </div>
    </div> 
</form>
<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>

