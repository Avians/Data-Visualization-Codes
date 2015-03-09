 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
?>


<form action="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "editTransaction", $identificationCode); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="submit_form">
    
    <h3 class="form-section form-title">Enter Transaction Reference Code</h3> 

    <div class="row">
        <div class="col-md-6">
            <div class="zippo-outlet">
                <?php
                    $zf_widgetFolder = "system_select_options"; $zf_widgetFile = "get_outletName.php";
                    Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $identifictionArray[2]);
                ?>
                <span class="help-block server-side-error" >
                    <?php echo $zf_formHandler->zf_getFormError("orderNumber") ?>
                </span>
            </div>
            <div class="form-group">
                <label class="control-label col-md-4">Transaction Ref:</label>
                <div class="col-md-8">
                    <div class="input-group">
                        <input id="referenceCode" type="text" name="initialTransactionReference" class="form-control" placeholder="FK27QW968, FK27MM540, .." value="<?php echo $zf_formHandler->zf_getFormValue("initialTransactionReference"); ?>">
                        <span class="input-group-btn ref-button">
                            <button class="btn default" type="button">Search</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group">
                <div class="col-md-8">
                    <!--This is a hidden form field gets its value from the database-->
                    <input type="hidden" name="outletIdNumber" class="form-control" value="<?php echo $identifictionArray[4]; ?>">
                </div>
            </div>
        </div>
        <!--/span-->

    </div>
    <!--/row-->
    
    
    <div id="editTransactionForm"></div>
</form>

<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>
