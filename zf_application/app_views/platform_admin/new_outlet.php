
    
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">New Outlet Setup</h3>
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
                            <i class="fa fa-hospital-o"></i>General Outlet Information
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
                            <a href="#portlet-config" data-toggle="modal" class="config">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="tabbable-custom ">
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#schoolInfoForm" data-toggle="tab">
                                        Enter General Outlet Info.
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active form" id="schoolInfoForm">
                                    <?php 
                                        //LOAD SCHOOL SETUP FORM
                                        Zf_ApplicationWidgets::zf_load_widget("platform_admin", "new_outlet_form.php");
                                    ?>
                                </div>
                            </div>
                        </div>
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
        var $current_view = "outletSetup_form";

        OutletEntities.init($current_view, $absolute_path, $separator );


    });
</script>