<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "outletSetup", $identificationCode); ?>" method="post" enctype="multipart/form-data" class="form-horizontal" id="submit_form">
    <div class="form-wizard" id="new_outlet_form">
        <div class="form-body">
            <ul class="nav nav-pills nav-justified steps">
                <li>
                    <a href="#basicOutletInfo" data-toggle="tab" class="step active">
                        <span class="number">
                            1
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Outlet Setup
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#adminInfo" data-toggle="tab" class="step">
                        <span class="number">
                            2
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Outlet Admin Setup
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#confirmInfo" data-toggle="tab" class="step">
                        <span class="number">
                            3
                        </span>
                        <span class="desc progress-form-title">
                            <i class="fa fa-check"></i> Confirm Details
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
                    $zf_widgetFolder = "indicators"; $zf_widgetFile = "outlet_setup_indicator.php";
                    Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                ?>
                <!-- START OF OUTLET SETUP FORM-->
                <div class="tab-pane active" id="basicOutletInfo">
                    <h3 class="form-section form-title">Basic Outlet Info</h3>    
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Agent Type:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="agentType" data-placeholder="Direct, Managed, Franchise, ...."  value="<?php echo $zf_formHandler->zf_getFormValue("agentType"); ?>">
                                        <?php
                                            $zf_widgetFolder = "system_select_options"; $zf_widgetFile = "agent_options.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $schoolSystemCode);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("agentType") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Outlet Type:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="outletType" data-placeholder="Stand alone, Shop in shop, Sub Fran...."  value="<?php echo $zf_formHandler->zf_getFormValue("outletType"); ?>">
                                        <?php
                                            $zf_widgetFolder = "system_select_options"; $zf_widgetFile = "outlet_type_options.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $schoolSystemCode);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("outletType") ?>
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
                                <label class="control-label col-md-4">Outlet Name:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="outletAlias" placeholder="Use Zippo naming conventions " value="<?php echo $zf_formHandler->zf_getFormValue("outletAlias"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("outletAlias") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Outlet Location:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="outletLocation" placeholder="Zippo Tuskys, Zippo Naivas, ..." value="<?php echo $zf_formHandler->zf_getFormValue("outletLocation"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("outletLocation") ?>
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
                                <label class="control-label col-md-4">Outlet Area:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="outletArea" placeholder="Ruaka, Utawala, Doonholm, Ruaraka,.." value="<?php echo $zf_formHandler->zf_getFormValue("outletArea"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("outletArea") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Outlet Town:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="outletTown" placeholder="Nairobi, Kitengela, Naivasha,..." value="<?php echo $zf_formHandler->zf_getFormValue("outletTown"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("outletTown") ?>
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
                                <label class="control-label col-md-4">Outlet Email:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="outletEmail" placeholder="admin@zippo.co.ke" value="<?php echo $zf_formHandler->zf_getFormValue("outletEmail"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("outletEmail") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Mobile Number:</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" name="outletMobileNumber" placeholder="+123 123 456789" value="<?php echo $zf_formHandler->zf_getFormValue("outletMobileNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("outletMobileNumber") ?>
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
                                <label class="control-label col-md-4">Outlet Country:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me outletCountry" id="outletCountry" name="outletCountry" data-placeholder="Kenya, Algeria, South Africa, Venezuela"  value="<?php echo $zf_formHandler->zf_getFormValue("outletCountry"); ?>">
                                        <?php
                                            $zf_widgetFolder = "countries_options"; $zf_widgetFile = "countries_select.php";
                                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                        ?>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("outletCountry") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Outlet County:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me outletLocality" id="outletLocality" name="outletLocality" data-placeholder="Approx. specific location" value="<?php echo $zf_formHandler->zf_getFormValue("outletLocality"); ?>">
                                        <option value=""></option>
                                    </select>
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("outletLocality") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                </div>
                <!-- END OF OUTLET SETUP FORM-->
                
                <!-- START OF ADMIN SETUP FORM-->
                <div class="tab-pane" id="adminInfo">
                    <h3 class="form-section form-title">Basic Administrator's Info</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Designation:</label>
                                <div class="col-md-8">
                                    <select class="form-control select2me" name="adminDesignation" data-placeholder="Mr., Mrs., Miss, Ms., ..."  value="<?php echo $zf_formHandler->zf_getFormValue("adminDesignation"); ?>">
                                        <option value=""></option>
                                        <option value="Mr">Mr.</option>
                                        <option value="Mrs">Mrs.</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Ms">Ms</option>
                                    </select>
                                    <span class="help-block server-side-error">
                                        <?php echo $zf_formHandler->zf_getFormError("adminDesignation") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">National Id:</label>
                                <div class="col-md-8">
                                    <input type="text" name="adminId" class="form-control" placeholder="12345" value="<?php echo $zf_formHandler->zf_getFormValue("adminId"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("adminId") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">First Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="adminFirstName" class="form-control" placeholder="Athias" value="<?php echo $zf_formHandler->zf_getFormValue("adminFirstName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("adminFirstName") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Last Name:</label>
                                <div class="col-md-8">
                                    <input type="text" name="adminLastName" class="form-control" placeholder="Avians" value="<?php echo $zf_formHandler->zf_getFormValue("adminLastName"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("adminLastName") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Email Address:</label>
                                <div class="col-md-8">
                                    <input type="text" name="adminEmailAddress" class="form-control"  placeholder="athias@outlet.com" value="<?php echo $zf_formHandler->zf_getFormValue("adminEmailAddress"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("adminEmailAddress") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Mobile Number:</label>
                                <div class="col-md-8">
                                    <input type="text" name="adminMobileNumber" class="form-control" placeholder="+123 123 456 789" value="<?php echo $zf_formHandler->zf_getFormValue("adminMobileNumber"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("adminMobileNumber") ?>
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
                                <label class="control-label col-md-4">P.o Box Address:</label>
                                <div class="col-md-8">
                                    <input type="text" name="adminAddress" class="form-control"  placeholder="12345" value="<?php echo $zf_formHandler->zf_getFormValue("adminAddress"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("adminAddress") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label col-md-4">Gender:</label>
                                <div class="col-md-8">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                        <input type="radio" name="adminGender" value="Male" checked data-title="Male"> Male </label>
                                        <label class="radio-inline">
                                        <input type="radio" name="adminGender" value="Female"  data-title="Female"> Female </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Password:</label>
                                <div class="col-md-8">
                                    <input type="password" name="adminPassword" class="form-control" id="adminPassword"  placeholder="Password" value="<?php echo $zf_formHandler->zf_getFormValue("adminPassword"); ?>">
                                    <span class="help-block server-side-error" >
                                        <?php echo $zf_formHandler->zf_getFormError("adminPassword") ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Re-Password:</label>
                                <div class="col-md-8">
                                    <input type="password" name="adminRe_password" class="form-control"  placeholder="Re-enter Password" value="<?php echo $zf_formHandler->zf_getFormValue("adminRe_password"); ?>">
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                </div>
                <!-- END OF ADMINL SETUP FORM-->
                
                <!-- START OF CONFIRM SETUP SECTION-->
                <div class="tab-pane" id="confirmInfo">
                    <h3 class="block  form-title"><i class='fa fa-hospital-o' style='font-size: 25px !important; padding-right: 5px !important;'></i>Confirm Setup Information</h3>
                    
                    <h4 class="form-section confirm-inner-title">Outlet Setup Information</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Outlet Area:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="outletArea"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Outlet Location:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="outletLocation"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Outlet Type:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="outletType"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Mobile Number:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="outletMobileNumber"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                   <!--/row-->
                   
                    
                    <h4 class="form-section confirm-inner-title">Administrator Setup Information</h4> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Designation:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="adminDesignation"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">First Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="adminFirstName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Last Name:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="adminLastName"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Email Address:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="adminEmailAddress"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Mobile Number:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result"  data-display="adminMobileNumber"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <!--/row-->
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">P.o Box Address:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="adminAddress"></p>
                                </div>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-4">Gender:</label>
                                <div class="col-md-8">
                                    <p class="form-control-static confirm-form-result" data-display="adminGender"></p>
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