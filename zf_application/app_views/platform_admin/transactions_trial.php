
<?php
  
    //Accessing the new transactions model
    $zf_controller->Zf_loadModel("platform_admin", "makeNewTransaction");
   
?>  
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
           
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">
                        Manage Transactions
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
                            <i class="fa fa-arrows-h"></i> Make New Transaction
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <!--This is the start of the tabs-->
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                                <div id="tabbed-nav">
                                    <ul>
                                        <li><a><i class="fa fa-cube"></i>Enter Transaction Details</a></li>
                                        <li><a><i class="fa fa-edit"></i>Enter Transactions</a></li>
                                    </ul>
                                    <div>
                                        <div> 
                                            <?php 
                                                //LOAD NEW TRANSACTION FORM FORM
                                                Zf_ApplicationWidgets::zf_load_widget("platform_admin", "transaction_trial_form.php");
                                            ?>
                                        </div>
                                        <div>
                                            <?php 
                                                //LOAD EDIT TRANSACTIONS FORM
                                                Zf_ApplicationWidgets::zf_load_widget("platform_admin", "edit_trial_transaction.php");
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
            
            var $current_view = "transaction_trial_form";
            TrialTransaction.init($current_view, $absolute_path, $separator );


        });
    </script>
