<?php
  
    //Accessing the new transactions model

    $zf_controller->Zf_loadModel("platform_admin", "filteredDashboardStatistics");
    
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
                        Platform Dashboard <small>Administrator</small>
                    </h3>
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="index.html">
                                Home
                            </a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="#">
                                Dashboard
                            </a>
                        </li>
                        <li class="pull-right">
                            <div id="dashboard-report-range" class="dashboard-date-range tooltips" data-placement="top" data-original-title="Change dashboard date range">
                                <i class="fa fa-calendar"></i>
                                <span>
                                </span>
                                <i class="fa fa-angle-down"></i>
                            </div>
                        </li>
                    </ul>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <!-- END PAGE HEADER-->
            
             
            <!-- BEGIN DASHBOARD STATS -->
            <?php
                $date = Zf_Core_Functions::Zf_CurrentDate();
            ?>
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label col-md-4">Start Date:</label>
                        <div class="col-md-8">
                            <div class="input-group input-medium date date-picker" data-date="<?php echo $date;?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                <input type="text" id="startDate" class="form-control" readonly value="startDate">
                                <span class="input-group-btn">
                                    <button class="btn default calendarBtn" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label class="control-label col-md-3">End Date:</label>
                        <div class="col-md-9">
                            <div class="input-group input-medium date date-picker" data-date="<?php echo $date;?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                <input type="text" id="endDate" class="form-control" readonly value="endDate">
                                <span class="input-group-btn">
                                    <button class="btn default calendarBtn" type="button"><i class="fa fa-calendar"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div id="data_filter_button">
                      <button  type="button" class="btn btn-small blue-button" style="margin-left: 20px !important;" href="#responsive">Filter By Date</button>  
                    </div>             
                </div>
            </div>
            <!-- END DASHBOARD STATS -->
            <div class="clearfix"><br></div>
            <!-- BEGIN DASHBOARD STATS -->
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue">
                        <div class="visual"></div>
                        <div class="details">
                            <div class="number" id="amountTransacted">
                                <?php $zf_controller->zf_targetModel->getTotalAmount($userid); ?>
                            </div>
                            <div class="desc">
                                Amount Transacted
                            </div>
                        </div>
                        <a class="more" href="#">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <?php //echo "<pre>";echo $identifictionArray;echo "</pre>";?>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green">
                        <div class="visual">
                            <i class="fa fa-exchange"></i>
                        </div>
                        <div class="details">
                            <div class="number" id="totalTransactions">
                                <?php $zf_controller->zf_targetModel->getNumberOfTransactions($userid); ?>
                            </div>
                            <div class="desc">
                                Total Transactions
                            </div>
                        </div>
                        <a class="more" href="#">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purple">
                        <div class="visual"></div>
                        <div class="details">
                            <div class="number" id="totalCommissions">
                                <?php $zf_controller->zf_targetModel->getTotalCommissions($userid); ?>
                            </div>
                            <div class="desc">
                                Total Commissions
                            </div>
                        </div>
                        <a class="more" href="#">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat yellow">
                        <div class="visual">
                            <i class="fa fa-signal"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <?php $zf_controller->zf_targetModel->getComputeGrowthRate($userid); ?>
                            </div>
                            <div class="desc">
                                Trans.Growth Rate
                            </div>
                        </div>
                        <a class="more" href="#">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END DASHBOARD STATS -->
            
            <!-- START OF DASHBOARD CHARTS-->   
            <div class="row margin-bottom-20">
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption" >
                                <i class="fa fa-line-chart" style="color: #ffffff !important;"></i>Deposit &amp; Withdrawal Transactions
                            </div>
                        </div>
                        <div class="portlet-body" id="allBoundTransactions" style="min-height: 300px !important;">
                            <?php $zf_controller->zf_targetModel->AllBoundTransactionsLine($userid); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption" >
                                <i class="fa fa-undo" style="color: #ffffff !important;"></i>Transactions Breakdown
                            </div>
                        </div>
                        <div class="portlet-body" style="min-height: 415px !important">
                            <div class="scroller" style="height:385px" data-always-visible="1" data-rail-visible="0">
                                <div class="row">
                                    <?php //$zf_controller->zf_targetModel->getTotalPartnersTransactions(); ?>
                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 margin-bottom-10 margin-top-10">
                                        <div class="dashboard-stat blue">
                                            <div class="visual"></div>
                                            <div class="details">
                                                <div class="number" id="totalDeposits">
                                                    <?php $zf_controller->zf_targetModel->getTotalDeposits($userid); ?>
                                                </div>
                                                <div class="desc">
                                                    Total Deposits
                                                </div>
                                            </div>
                                            <a class="more" href="#">
                                                View more <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 margin-bottom-10 margin-top-10">
                                        <div class="dashboard-stat green">
                                            <div class="visual"></div>
                                            <div class="details">
                                                <div class="number" id="totalWithdrawals">
                                                    <?php $zf_controller->zf_targetModel->getTotalWithdrawals($userid); ?>
                                                </div>
                                                <div class="desc">
                                                    Total Withdrawals
                                                </div>
                                            </div>
                                            <a class="more" href="#">
                                                View more <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                        <hr class="commission">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 margin-bottom-10 margin-top-10">
                                        <div class="dashboard-stat red">
                                            <div class="visual"></div>
                                            <div class="details">
                                                <div class="number" id="getDepositsCommissions">
                                                    <?php $zf_controller->zf_targetModel->getDepositsCommissions($userid); ?>
                                                </div>
                                                <div class="desc">
                                                    Deposits Commission
                                                </div>
                                            </div>
                                            <a class="more" href="#">
                                                View more <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 margin-bottom-10 margin-top-10">
                                        <div class="dashboard-stat yellow">
                                            <div class="visual"></div>
                                            <div class="details">
                                                <div class="number" id="getWithdrawalsCommissions">
                                                    <?php $zf_controller->zf_targetModel->getWithdrawalsCommissions($userid); ?>
                                                </div>
                                                <div class="desc">
                                                    Withdrawals Commission
                                                </div>
                                            </div>
                                            <a class="more" href="#">
                                                View more <i class="m-icon-swapright m-icon-white"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW -->
            
            <div class="row margin-bottom-10">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                    <?php
                        $zf_widgetFolder = "indicators"; $zf_widgetFile = "class_setup_indicator.php";
                        //Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                    ?> 
                    <div id="tabbed-nav">
                        <ul>
                            <li><a><i class="fa fa-globe"></i>Global Summary</a></li>
                            <li><a><i class="fa fa-share-alt"></i> Partners Summary</a></li>
                            <li><a><i class="fa fa-th-large"></i> Outlets Summary (By Service Type)</a></li>
                            <li><a><i class="fa fa-th-large"></i> Outlets Summary (Partners Performance)</a></li>
                        </ul>
                        <div>
                            <div>
                                <div data-always-visible="0" data-rail-visible="0">
                                    <div class="row" id="transactionBlueBoxes">
                                        <?php $zf_controller->zf_targetModel->getTotalPartnersTransactions("tabs"); ?>
                                    </div>
                                    <div class="row margin-bottom-10">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="portlet box blue">
                                                <div class="portlet-title">
                                                    <div class="caption" >
                                                        <i class="fa fa-line-chart" style="color: #ffffff !important;"></i>Service Performance Summary
                                                    </div>
                                                </div>
                                                <div class="portlet-body" style="min-height: 300px !important;" id="vendorMoneyVariations">
                                                    <?php $zf_controller->zf_targetModel->AllPartnersTransactionsLineToday("partnersTabChart"); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div id="overallVendorSummary">
                                <?php 
                                    //FETCH ALL THE PARTNERSHIP SUMMARY
                                    $zf_controller->zf_targetModel->getPartnershipSummary();
                                ?>
                            </div>
                            <div id="outletTransactionSummary">
                                <?php 
                                    //FETCH ALL THE OUTLET SUMMARY(By Transactions)
                                    $zf_controller->zf_targetModel->getAllOutletSummaryTransactions();
                                ?>
                            </div>
                            <div id="outletVendorSummary">
                                <?php 
                                    //FETCH ALL THE OUTLET SUMMARY
                                    $zf_controller->zf_targetModel->getAllOutletSummaryPartners();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW -->
            
            <div class="row margin-top-20">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="portlet box">
                        <div class="school-content-wrapper">
                            <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                            <h3>Today's Outlets Transactions Summary</h3>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 action_buttons"></div>
                            </div>
                            <hr>
                            <div class="school-class-inner-content scroller"  data-always-visible="1" data-rail-visible="0">
                                <div  id="outletTransactions" class="table-responsive" style="margin-right: 5px !important;">
                                    <?php $zf_controller->zf_targetModel->getOutletTransactions($userid); ?>    
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW -->
            
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption" >
                                <i class="fa fa-pie-chart" style="color: #ffffff !important;"></i>Overall Service Performance (%)
                            </div>
                        </div>
                        <div id="allPartnersTransactionsPie" class="portlet-body" style="min-height: 300px !important;">
                            <?php $zf_controller->zf_targetModel->AllPartnersTransactionsPie($userid); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption" >
                                <i class="fa fa-line-chart" style="color: #ffffff !important;"></i>Overall Service Performance (Volume)
                            </div>
                        </div>
                        <div id="allPartnersTransactionsLine" class="portlet-body" style="min-height: 300px !important;">
                            <?php $zf_controller->zf_targetModel->AllPartnersTransactionsLine("partnersLowerChart"); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ROW -->
            
            <!-- START OF DASHBOARD CHARTS-->
        </div>
    </div>
    <!-- END CONTENT -->
    <script type="text/javascript">
        $(document).ready(function() {

            var $absolute_path = "<?php echo ZF_ROOT_PATH; ?>";
            var $separator = "<?php echo DS; ?>";
            var $connector = "<?php echo ZVSS_CONNECT; ?>";

            $("#data_filter_button").click(function(){

                var startDate = $("#startDate").val(); var endDate = $("#endDate").val();

                //Load all reload all the div with the necessary data.

                var processAmountTransacted = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "amountTransacted";
                $.ajax({
                    type: "POST",
                    url: processAmountTransacted,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#amountTransacted").html(html);
                    }
                });

                var processTransactionCount = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "transactionCount";
                $.ajax({
                    type: "POST",
                    url: processTransactionCount,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#totalTransactions").html(html);
                    }
                });

                var processTransactionCommissions = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "totalCommissions";
                $.ajax({
                    type: "POST",
                    url: processTransactionCommissions,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#totalCommissions").html(html);
                    }
                });

                var processDeposits = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "totalDeposits";
                $.ajax({
                    type: "POST",
                    url: processDeposits,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#totalDeposits").html(html);
                    }
                });

                var processWithdrawals = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "totalWithdrawals";
                $.ajax({
                    type: "POST",
                    url: processWithdrawals,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#totalWithdrawals").html(html);
                    }
                });

                var processDepositsCommissions = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "getDepositsCommissions";
                $.ajax({
                    type: "POST",
                    url: processDepositsCommissions,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#getDepositsCommissions").html(html);
                    }
                });

                var processWithdrawalsCommissions = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "getWithdrawalsCommissions";
                $.ajax({
                    type: "POST",
                    url: processWithdrawalsCommissions,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#getWithdrawalsCommissions").html(html);
                    }
                });

                var processTransactionBlueBoxes = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "transactionBlueBoxes";
                $.ajax({
                    type: "POST",
                    url: processTransactionBlueBoxes,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#transactionBlueBoxes").html(html);
                    }
                });

                var processVendorMoneyVariations = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "vendorMoneyVariations";
                $.ajax({
                    type: "POST",
                    url: processVendorMoneyVariations,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#vendorMoneyVariations").html(html);
                    }
                });

                var processOverallVendorSummary = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "overallVendorSummary";
                $.ajax({
                    type: "POST",
                    url: processOverallVendorSummary,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#overallVendorSummary").html(html);
                    }
                });

                var processOutletTransactionSummary = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "outletTransactionSummary";
                $.ajax({
                    type: "POST",
                    url: processOutletTransactionSummary,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#outletTransactionSummary").html(html);
                    }
                });

                var processOutletVendorSummary = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "outletVendorSummary";
                $.ajax({
                    type: "POST",
                    url: processOutletVendorSummary,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#outletVendorSummary").html(html);
                    }
                });

                var processOutletTransactions = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "outletTransactions";
                $.ajax({
                    type: "POST",
                    url: processOutletTransactions,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#outletTransactions").html(html);
                    }
                });

                var processAllPartnersTransactionsPie = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "allPartnersTransactionsPie";
                $.ajax({
                    type: "POST",
                    url: processAllPartnersTransactionsPie,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#allPartnersTransactionsPie").html(html);
                    }
                });
                
                var processAllPartnersTransactionsLine = $absolute_path + "platform_admin" + $separator + "filteredDashboardStatistics" + $separator + "allPartnersTransactionsLine";
                $.ajax({
                    type: "POST",
                    url: processAllPartnersTransactionsLine,
                    data: {startDate: startDate, endDate: endDate},
                    cache: false,
                    success: function(html) {
                       $("#allPartnersTransactionsLine").html(html);
                    }
                });


            });

         });
    </script>  
    
    
   

