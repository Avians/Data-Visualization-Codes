<?php
    //Accessing agency types model
    $zf_controller->Zf_loadModel("platform_admin", "makeNewCommission");

    $schoolSystemCode = $zf_actionData;
    
?>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Commission Setup</h3>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix"></div>

        <!-- BEGIN INNER CONTENT -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-building-o"></i> Manage Commissions
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <!--This is the start of the tabs-->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                                <?php
                                    $zf_widgetFolder = "indicators"; $zf_widgetFile = "class_setup_indicator.php";
                                    //Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                ?> 
                                <div id="tabbed-nav">
                                    <ul>
                                        <li><a></i>Commissions overview</a></li>
                                        <li><a><i class="fa fa-plus-square"></i> Create a new commission</a></li>
                                        <li><a><i class="fa fa-edit"></i> Edit commissions</a></li>
                                    </ul>
                                    <div>
                                        <div> 
                                            <?php 
                                                //FETCH ALL THE COMMISSION DATA
                                                $zf_controller->zf_targetModel->getCommissionInformation();
                                            ?>
                                        </div>
                                        <div>
                                            <?php 
                                                //LOAD NEW COMMISSION FORM FORM
                                                Zf_ApplicationWidgets::zf_load_widget("platform_admin", "commission_setup_form.php");
                                            ?>
                                        </div>
                                        <div>
                                            We will edit all the commissions here.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--This is the end of the tabs-->

                    </div>
                </div>
            </div>
        </div>
        <!-- END INNER CONTENT -->

    </div>
</div>
<!-- END CONTENT -->
<script type="text/javascript">
    $(document).ready(function() {

        //Here we are generating the applications absolute path.
        var $absolute_path = "<?php echo ZF_ROOT_PATH; ?>";
        var $separator = "<?php echo DS; ?>";
        var $current_view = "commission_setup_form";

        OutletEntities.init($current_view, $absolute_path, $separator );
        OutletCodes.init($current_view, $absolute_path, $separator );


    });
</script>

