
  <?php
  
    //Accessing the new transactions model
    $zf_controller->Zf_loadModel("platform_admin", "userSetup");
    
    $userid = $zf_actionData;
    
?>  
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
           
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">
                        Zeepo Users
                    </h3>
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
                            <i class="fa fa-arrows-h"></i> Zeepo Administrative Users
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
                                    $zf_widgetFolder = "indicators"; $zf_widgetFile = "users_setup_indicator.php";
                                    Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                ?>
                                <div id="tabbed-nav">
                                    <ul>
                                        <li><a><i class="fa fa-bars"></i> View Zeepo Admin Users</a></li>
                                        <li><a><i class="fa fa-edit"></i> Edit Zeepo Admin Users</a></li>
                                        <li><a><i class="fa fa-remove"></i> Delete Zeepo Admin Users</a></li>
                                    </ul>

                                    <div>
                                        <div class="portlet-empty table-responsive" style="margin-right: 4% !important;">
                                            <?php echo $zf_generateTable ; ?>
                                        </div> 
                                        <div>
                                            <?php
                                                //We pull a dropdown of all users, select their names, from which an editing form appears.
                                                $zf_controller->zf_targetModel->confirmUserPresence("edit");
                                            ?>
                                        </div>
                                        <div>
                                            <?php
                                                //We pull a dropdown of all users, select their names, from which an editing form appears.
                                                $zf_controller->zf_targetModel->confirmUserPresence("delete");
                                            ?>
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
            
            <div class="clearfix"><br></div>
        </div>
    </div>
    <!-- END CONTENT -->
    
    <script type="text/javascript">
        $(document).ready(function() {

            //Here we are generating the applications absolute path.
            var $absolute_path = "<?php echo ZF_ROOT_PATH; ?>";
            var $separator = "<?php echo DS; ?>";
            var $current_view = "manage_users";

            SelectedOptions.init($current_view, $absolute_path, $separator );

        });
    </script>

