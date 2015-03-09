 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
    
    //echo "<pre>";print_r($identifictionArray);echo "</pre>";
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "makeNewTransaction", $identificationCode); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="submit_form">
    <div class="form-wizard" id="new_transaction_form">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#basicTransactionInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Make New Transaction
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Transaction Details
                        </span>
                    </a>
                </li>
            </ul>
            <div id="bar" class="progress progress-striped active progress-bar-radius" role="progressbar">
                <div class="progress-bar progress-bar-info progress-bar-radius" style="width: 20%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar"></div>
            </div>
            <div class="tab-content">
                <div class="alert alert-danger display-none">
                    <button class="close" data-dismiss="alert"></button>
                    You have some form errors. Please check below.
                </div>
                <div class="alert alert-success display-none">
                    <button class="close" data-dismiss="alert"></button>
                    Your form validation is successful!
                </div>
                <?php
                    $zf_widgetFolder = "indicators"; $zf_widgetFile = "new_transaction_indicator.php";
                    Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                ?>
                <!-- START OF SCHOOL SETUP FORM-->
                <div class="tab-pane active" id="basicTransactionInfo">
                    
                    <h3 class="form-section form-title">Zippo Branches</h3> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php
                                if($identifictionArray[3] == ZIPPO_OUTLET_STAFF || $identifictionArray[3] == ZIPPO_OUTLET_JUNIOR_STAFF){
                                  ?>  
                                    <label class="control-label col-md-4">Your Outlet:</label>
                                    <div class="col-md-8">
                                        <?php
                                            $zf_widgetFolder = "system_select_options"; $zf_widgetFile = "get_outletName.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $identifictionArray[2]);
                                        ?>
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("orderNumber") ?>
                                        </span>
                                    </div>
                                <?php   
                                }else if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
                                ?> 
                                    <label class="control-label col-md-4">Select Outlet:</label>
                                    <div class="col-md-8">
                                        <select class="form-control select2me outletOptions" id="outletOptions" name="outletCode" data-placeholder="Enter Current Zippo Outlet"  value="<?php echo $zf_formHandler->zf_getFormValue("outletName"); ?>">
                                            <?php
                                                $zf_widgetFolder = "system_select_options"; $zf_widgetFile = "select_outlets.php";
                                                Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                            ?>
                                        </select>
                                        <span class="help-block server-side-error">
                                            <?php echo $zf_formHandler->zf_getFormError("outletCode") ?>
                                        </span>
                                        <div id="outletName"></div>
                                    </div>
                                <?php    
                                }
                                ?>
                                
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    
                    <h3 class="form-section form-title">Customer Info</h3>
                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">ID/PP Number:</label>
                                <div class="col-md-8">
                                    <input type="text" id="customerId" name="transactionIdNumber" class="form-control customerId"  placeholder="25138058" value="<?php echo $zf_formHandler->zf_getFormValue("transactionIdNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("transactionIdNumber") ?>
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
                                        <input type="text" name="transactionFirstName" class="form-control" placeholder="Athias" value="<?php echo $zf_formHandler->zf_getFormValue("transactionFirstName"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("transactionFirstName") ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Middle Name:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="transactionMiddleName" class="form-control" placeholder="Avians" value="<?php echo $zf_formHandler->zf_getFormValue("transactionMiddleName"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("transactionMiddleName") ?>
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
                                        <input type="text" name="transactionLastName" class="form-control" placeholder="Athlan" value="<?php echo $zf_formHandler->zf_getFormValue("transactionLastName"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("transactionLastName") ?>
                                        </span>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Mobile Number:</label>
                                    <div class="col-md-8">
                                        <input type="text" name="transactionMobileNumber" class="form-control" placeholder="+123 123 456 789" value="<?php echo $zf_formHandler->zf_getFormValue("transactionMobileNumber"); ?>">
                                        <span class="help-block server-side-error" >
                                            <?php echo $zf_formHandler->zf_getFormError("transactionMobileNumber") ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                    <!-- This two customer forms can automatically be hidden and shown on call--> 
                    
                    <h3 class="form-section form-title">Transaction Details</h3> 
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Vendor Type:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me agencyTypeCode" id="agencyTypeCode" name="agencyTypeCode" data-placeholder="Bank, MTS, Mobile Money, ...."  value="<?php echo $zf_formHandler->zf_getFormValue("agencyTypeCode"); ?>">
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Vendor Name:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me agencyEntity" id="agencyEntity" name="agencyEntityCode" data-placeholder="Transacting entity name " value="<?php echo $zf_formHandler->zf_getFormValue("agencyEntityCode"); ?>">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("agencyEntityCode") ?>
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
                                <label class="control-label col-md-4">Transaction Type:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="transactionType" data-placeholder="Deposit, Withdrawal"  value="<?php echo $zf_formHandler->zf_getFormValue("transactionType"); ?>">
                                        <option value=""  id="transactionType"></option>
                                        <option value="Deposit">Deposit</option>
                                        <option value="Withdrawal">Withdrawal</option>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("transactionType") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Amount:</label>
                                <div class="col-md-8">
                                    <input type="text" id="confirmAmount" name="transactionAmount" class="form-control" placeholder="Amount(KES)" value="<?php echo $zf_formHandler->zf_getFormValue("transactionAmount"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("transactionAmount") ?>
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
                                <label class="control-label col-md-4">Transaction Ref:</label>
                                <div class="col-md-8">
                                    <input type="text" name="transactionReference" class="form-control" placeholder="FK27QW968, FK27MM540, .." value="<?php echo $zf_formHandler->zf_getFormValue("transactionReference"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("transactionReference") ?>
                                    </span>
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
                    
                </div>
                <!-- END OF SCHOOL SETUP FORM-->
                
                <!-- START OF CONFIRM SETUP SECTION-->
                <div class="tab-pane" id="confirmInfo">
                    <h3 class="block  form-title"><i class='fa fa-cubes' style='font-size: 25px !important; padding-right: 5px !important;'></i>Transaction Information</h3>
                    
                 <?php
                    if($identifictionArray[3] == ZIPPO_OUTLET_STAFF){
                 ?> 
                    <h4 class="form-section confirm-inner-title">Transaction Branch</h4> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Outlet Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="outletName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                  <?php }else if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){ } ?>  
                    <h4 class="form-section confirm-inner-title">Customer Information</h4> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">First Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="transactionFirstName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Last Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="transactionLastName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">ID/PP Number:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="transactionIdNumber"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Mobile Number:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="transactionMobileNumber"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <h4 class="form-section confirm-inner-title">Transaction Information</h4> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Amount:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="transactionAmount"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Transaction Type:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="transactionType"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Reference Code:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="transactionReference"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->  
                    
                </div>
                <!-- END OF CONFIRM SETUP SECTION-->
                
            </div>
        </div>
        <div class="form-actions fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-offset-5 col-md-7">
                        <a href="javascript:;" class="btn default button-previous">
                            <i class="m-icon-swapleft"></i> Back
                        </a>
                        <a href="javascript:;" class="btn blue button-next">
                            Continue <i class="m-icon-swapright m-icon-white"></i>
                        </a>
<!--                        <a href="javascript:;" class="btn green button-submit">
                            Submit <i class="m-icon-swapright m-icon-white"></i>
                        </a>-->
                        <button type="submit" class="btn green button-submit">
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
<script type="text/javascript">
    $(document).ready(function() {

        /* Confirm */
        $('#confirmAmount').focusout(function() {
            
            var amount = $('#confirmAmount').val();
            
            var amount = amount.replace(/\,/g,'');
            
            if(amount > 10000){
                
                $.fn.SimpleModal({
                    btn_ok: 'Confirm',
                    model: 'confirm',
                    callback: function(){

                        $('#transactionType').hide();
                        //alert('Action confirm!');

                    },
                    title: 'Confirm Amount Entered',
                    contents: 'Are you sure you want to record ' + delimitNumbers(amount) + ' Kshs'
                }).showModal();
                
            }

        });
        
        function delimitNumbers(str) {
            return (str + "").replace(/\b(\d+)((\.\d+)*)\b/g, function(a, b, c) {
              return (b.charAt(0) > 0 && !(c || ".").lastIndexOf(".") ? b.replace(/(\d)(?=(\d{3})+$)/g, "$1,") : b) + c;
            });
        }
        
        $('#confirmAmount').on('keyup', function() {
            var x = $(this).val();
            $(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });
        
    });
</script>
