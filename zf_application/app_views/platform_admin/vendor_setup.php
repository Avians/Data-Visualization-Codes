<?php
    //Accessing agency types model
    $zf_controller->Zf_loadModel("platform_admin", "processAgencyInformation");
    
?>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Manage Partners</h3>
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
                            <i class="fa fa-building-o"></i> Manage Partner Types
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
                                        <li><a></i>Vendor types overview</a></li>
                                        <li><a><i class="fa fa-plus-square"></i> Add a vendor type</a></li>
                                        <li><a><i class="fa fa-plus-square"></i> Add a vendor</a></li>
<!--                                        <li><a><i class="fa fa-edit"></i> Edit a vendor type</a></li>
                                        <li><a><i class="fa fa-edit"></i> Edit a vendor</a></li>-->
                                    </ul>
                                    <div>
                                        <div> 
                                            <?php 
                                                //FETCH ALL THE AGENCY DATA
                                                $zf_controller->zf_targetModel->getAgencyTypes();
                                            ?>
                                        </div>
                                        <div>
                                            <?php
                                                //LOAD AGENCY SETUP FORM
                                                Zf_ApplicationWidgets::zf_load_widget("platform_admin", "add_agency_form.php");
                                            ?> 
                                        </div>
                                        <div>
                                            <?php
                                                //HERE WE CONFIRM THE PRENSENCE OF AN AGENCY TYPE, THEN LOAD THE ADD ENTITY FORM
                                                $zf_controller->zf_targetModel->confirmAgencyTypePresence();
                                            ?>
                                        </div>
                                        <div>
                                            Edit an outlet type form 
                                        </div>
                                        <div>
                                            Edit an outlet type-entity form
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

