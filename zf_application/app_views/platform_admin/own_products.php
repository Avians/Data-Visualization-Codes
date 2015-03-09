<?php
    //Accessing school profile model
    $zf_controller->Zf_loadModel("main_school_admin", "manage_school_classes");

    $schoolSystemCode = $zf_actionData;
    
?>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Outlet Types</h3>
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
                            <i class="fa fa-building-o"></i> Manage Outlet Types
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
                                        <li><a></i>Outlet Types overview</a></li>
                                        <li><a><i class="fa fa-plus-square"></i> Add an outlet type</a></li>
                                        <li><a><i class="fa fa-plus-square"></i> Add an outlet type entity</a></li>
                                        <li><a><i class="fa fa-edit"></i> Edit an outlet type</a></li>
                                        <li><a><i class="fa fa-edit"></i> Edit an outlet type entity</a></li>
                                    </ul>

                                    <div>
                                        <div> 
                                            Overview of the outlet types
                                        </div>
                                        <div>
                                            Add an outlet type form 
                                        </div>
                                        <div>
                                            Add an outlet type-entity form
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

