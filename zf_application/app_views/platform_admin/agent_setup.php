<?php
    //Accessing agency types model
    $zf_controller->Zf_loadModel("platform_admin", "processAgencyInformation");

    $schoolSystemCode = $zf_actionData;
    
?>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Agent Types Setup</h3>
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
                            <i class="fa fa-building-o"></i> Manage Agent Types
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
                                    $zf_widgetFolder = "indicators"; $zf_widgetFile = "agent_setup_indicator.php";
                                    Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                ?> 
                                <div id="tabbed-nav">
                                    <ul>
                                        <li><a></i>Agent types overview</a></li>
                                        <li><a><i class="fa fa-plus-square"></i> Add an agent type</a></li>
                                        <li><a><i class="fa fa-edit"></i> Edit an agent type</a></li>
                                    </ul>
                                    <div>
                                        <div> 
                                            <?php 
                                                //FETCH ALL THE OUTLET TYPE DATA
                                                $zf_controller->zf_targetModel->getAgentTypes();
                                            ?>
                                        </div>
                                        <div>
                                            <?php
                                                //LOAD AGENCY SETUP FORM
                                                Zf_ApplicationWidgets::zf_load_widget("platform_admin", "add_agent_type_form.php");
                                            ?> 
                                        </div>
                                        <div>
                                            <?php
                                                //We pull a dropdown of agents types, from which an editing form appears.
                                                $zf_controller->zf_targetModel->confirmAgentTypePresence();
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

    </div>
</div>
<!-- END CONTENT -->
<script type="text/javascript">
    $(document).ready(function() {

        //Here we are generating the applications absolute path.
        var $absolute_path = "<?php echo ZF_ROOT_PATH; ?>";
        var $separator = "<?php echo DS; ?>";
        var $current_view = "zippo_setup";

        SelectedOptions.init($current_view, $absolute_path, $separator );

    });
</script>

