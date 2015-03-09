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
                        Make Transactions
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
                                        <li><a><i class="fa fa-cube"></i> Enter Transaction Details</a></li>
                                        <li><a><i class="fa fa-bars"></i> Todays Transactions</a></li>
                                        <li><a><i class="fa fa-edit"></i> Edit Transactions</a></li>
                                        <li><a><i class="fa fa-file-text-o"></i> Transactions Report</a></li>
                                    </ul>

                                    <div>
                                        <div> 
                                            <?php 
                                                //LOAD NEW TRANSACTION FORM FORM
                                                Zf_ApplicationWidgets::zf_load_widget("platform_admin", "new_transaction_form.php");
                                            ?>
                                        </div>
                                        <div class="portlet-empty table-responsive" style="margin-right: 4% !important;">
                                            <?php echo $zf_generateTable ; ?>
                                            <div class="clearfix"><hr></div>
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="portlet box blue">
                                                        <div class="portlet-title">
                                                            <div class="caption" >
                                                                <i class="fa fa-exchange" style="color: #ffffff !important;"></i>Inbound and Outbound Transactions
                                                            </div>
                                                        </div>
                                                        <div class="portlet-body" style="min-height: 300px !important;">
                                                            <?php $zf_controller->zf_targetModel->InboundOutboundTransactionsPie(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="portlet box blue">
                                                        <div class="portlet-title">
                                                            <div class="caption" >
                                                                <i class="fa fa-sign-out" style="color: #ffffff !important;"></i>Inbound &amp; Outbound Transactions (Last 7 Days)
                                                            </div>
                                                        </div>
                                                        <div class="portlet-body" style="min-height: 300px !important;">
                                                            <?php $zf_controller->zf_targetModel->InboundOutboundTransactionsLine(); ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div>
                                            <?php 
                                                //LOAD EDIT TRANSACTION FORM FORM
                                                Zf_ApplicationWidgets::zf_load_widget("platform_admin", "edit_transaction_form.php");
                                            ?>
                                        </div>
                                        <div>We will view transactions reports here</div>
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
            var $current_view = "edit_transaction_form";
            
            OutletEntities.init($current_view, $absolute_path, $separator );
            OutletCodes.init($current_view, $absolute_path, $separator );
            
            var $current_view = "new_transaction_form";
            CustomerDetails.init($current_view, $absolute_path, $separator );


        });
    </script>
    

