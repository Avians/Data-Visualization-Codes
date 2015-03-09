 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "makeNewCommission", $identificationCode); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="submit_form">
    <div class="form-wizard" id="new_transaction_form">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#basicTransactionInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Make New Commission
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Commission Details
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
                <!-- START OF COMMISSION SETUP FORM-->
                <div class="tab-pane active" id="basicTransactionInfo">
                    
                    <h3 class="form-section form-title">Commission Details</h3> 
                    
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
                                <label class="control-label col-md-4">Commission Type:</label>
                                <div class="col-md-7 col-md-offset-1">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                        <input id="commissionValueRadio" type="radio" name="commissionType" value="Commission Value" data-title="Commission Value"> Actual Value </label>
                                        <label class="radio-inline">
                                        <input id="commissionProportionRadio" type="radio" name="commissionType" value="Commission Proportion" data-title="Commission Proportion"> Proportion </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-12"><hr></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-md-6">Lower limit:</label>
                                <div class="col-md-6">
                                    <input type="text" name="lowerLimit" class="form-control" placeholder="Lower Limit" value="<?php echo $zf_formHandler->zf_getFormValue("lowerLimit"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("lowerLimit") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-md-6">Upper Limit:</label>
                                <div class="col-md-6">
                                    <input type="text" name="upperLimit" class="form-control" placeholder="Upper Limit" value="<?php echo $zf_formHandler->zf_getFormValue("uppperLimit"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("upperLimit") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4" id="commissionValue">
                            <div class="form-group">
                                <label class="control-label col-md-6">Comm. Value:</label>
                                <div class="col-md-6">
                                    <input type="text" name="commissionValue" class="form-control" placeholder="Comm. Value" value="<?php echo $zf_formHandler->zf_getFormValue("commissionValue"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("commissionValue") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        
                        <div class="col-md-4"  id="commissionProportion">
                            <div class="form-group">
                                <label class="control-label col-md-6">Comm. Proportion:</label>
                                <div class="col-md-6">
                                    <input type="text" name="commissionProportion" class="form-control" placeholder="Comm. Proportion" value="<?php echo $zf_formHandler->zf_getFormValue("commissionProportion"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("commissionProportion") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        
                    </div>
                    <!--/row-->
                    
                </div>
                <!-- END OF COMMISSION SETUP FORM-->
                
                <!-- START OF CONFIRM SETUP SECTION-->
                <div class="tab-pane" id="confirmInfo">
                    <h3 class="block  form-title"><i class='fa fa-toggle-off' style='font-size: 25px !important; padding-right: 5px !important;'></i>Commission Information</h3>
                 
                    <h4 class="form-section confirm-inner-title">Commission Information</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Vendor Type:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="agencyTypeCode"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Vendor Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="agencyEntityCode"></p>
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
                                    <p class="form-control-static confirm-form-result" data-display="transactionType"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Commission Type:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="commissionType"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-md-6">Lower Limit:</label>
                                <div class="col-md-6">
                                    <p class="form-control-static confirm-form-result" data-display="lowerLimit"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label col-md-6">Upper Limit:</label>
                                <div class="col-md-6">
                                    <p class="form-control-static confirm-form-result" data-display="upperLimit"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4" id="commissionValueConfirm">
                            <div class="form-group">
                                <label class="control-label col-md-6">Comm. Value:</label>
                                <div class="col-md-6">
                                    <p class="form-control-static confirm-form-result" data-display="commissionValue"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-4" id="commissionProportionConfirm">
                            <div class="form-group">
                                <label class="control-label col-md-6">Comm Proportion:</label>
                                <div class="col-md-6">
                                    <p class="form-control-static confirm-form-result" data-display="commissionProportion"></p>
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
