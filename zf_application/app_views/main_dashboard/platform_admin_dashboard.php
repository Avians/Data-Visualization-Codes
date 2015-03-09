<?php
  
    //Accessing the new transactions model

    $zf_controller->Zf_loadModel("platform_admin", "mainDashboardStatistics");
    
    $userid = $zf_actionData;
    
    $idCode = "kiPTpocl2mE-aUZwqNxzEYZAVQVLXAL2cN_al5lnWDB4rSCnOFdz1qhWIuCA2epcKQawMptDMW_2Pi5DJcSssg";
    
    $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode(Zf_SessionHandler::zf_getSessionVariable($idCode));
    
?> 


    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
           
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">
                        Zeepo Dashboard <small>Administrator</small>
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
                //Zf_ApplicationWidgets::zf_load_widget("platform_admin", "dashboard_statistics.php");
            ?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4 class="page-title">
                        Today's Transactions: <small class='time' style='font-size: 17px !important;'><?php echo strtoupper(Zf_Core_Functions::Zf_FomartDate('d - M - Y', Zf_Core_Functions::Zf_CurrentDate()))." &nbsp;&nbsp;&nbsp;&nbsp;".Zf_Core_Functions::Zf_CurrentTime();?></small>
                    </h4>
                </div>
            </div>
            <!-- END DASHBOARD STATS -->
            <div class="clearfix"></div>
            <!-- BEGIN DASHBOARD STATS -->
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue">
                        <div class="visual"></div>
                        <div class="details">
                            <div class="number" id="totalAmount">
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
                            <div class="number" id="countTransactions">
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
                                <i class="fa fa-line-chart" style="color: #ffffff !important;"></i>Transactions (Last 7 Days)
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
                                                <div class="number" id="totalInboundTransfer">
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
                                                <div class="number" id="totalOutboundTransfer">
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
                            <li><a><i class="fa fa-share-alt"></i> Vendor Summary</a></li>
                            <li><a><i class="fa fa-th-large"></i> Outlets Summary (By Service Type)</a></li>
                            <li><a><i class="fa fa-th-large"></i> Outlets Summary (Partners Performance)</a></li>
                        </ul>
                        <div>
                            <div>
                                <div data-always-visible="0" data-rail-visible="0">
                                    <div class="row" >
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
                                                <div class="portlet-body" style="min-height: 300px !important;">
                                                    <?php $zf_controller->zf_targetModel->AllPartnersTransactionsLineToday("partnersTabChart"); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div>
                                <?php 
                                    //FETCH ALL THE PARTNERSHIP SUMMARY
                                    $zf_controller->zf_targetModel->getPartnershipSummary();
                                ?>
                            </div>
                            <div>
                                <?php 
                                    //FETCH ALL THE OUTLET SUMMARY(By Transactions)
                                    $zf_controller->zf_targetModel->getAllOutletSummaryTransactions();
                                ?>
                            </div>
                            <div>
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
                                <div class="table-responsive" style="margin-right: 5px !important;">
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
                        <div class="portlet-body" style="min-height: 300px !important;">
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
                        <div class="portlet-body" style="min-height: 300px !important;">
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

            //Here we are generating the applications absolute path.
            var $absolute_path = "<?php echo ZF_ROOT_PATH; ?>";
            var $separator = "<?php echo DS; ?>";
            
            setInterval(function() {
                
                var processCountOutlets = $absolute_path + "platform_admin" + $separator + "mainDashboardStatistics" + $separator + "countOutlets";
                
                $.ajax({
                    type: "POST",
                    url: processCountOutlets,
                    //data: {agencyTypeCode: agencyTypeCode},
                    cache: false,
                    success: function(html) {
                       $("#countOutlets").html(html);
                    }
                });
                
                var processCountTransactions = $absolute_path + "platform_admin" + $separator + "mainDashboardStatistics" + $separator + "countTransactions";
                
                $.ajax({
                    type: "POST",
                    url: processCountTransactions,
                    //data: {agencyTypeCode: agencyTypeCode},
                    cache: false,
                    success: function(html) {
                       $("#countTransactions").html(html);
                    }
                });
                
                var processTotalAmount = $absolute_path + "platform_admin" + $separator + "mainDashboardStatistics" + $separator + "totalAmount";
                
                $.ajax({
                    type: "POST",
                    url: processTotalAmount,
                    //data: {agencyTypeCode: agencyTypeCode},
                    cache: false,
                    success: function(html) {
                       $("#totalAmount").html(html);
                    }
                });
                
                var processAllBoundTransactions = $absolute_path + "platform_admin" + $separator + "mainDashboardStatistics" + $separator + "allBoundTransactions";
                
                $.ajax({
                    type: "POST",
                    url: processAllBoundTransactions,
                    //data: {agencyTypeCode: agencyTypeCode},
                    cache: false,
                    success: function(html) {
                       $("#allBoundTransactions").html(html);
                    }
                });
                
                var processTotalAmount = $absolute_path + "platform_admin" + $separator + "mainDashboardStatistics" + $separator + "totalDeposits";
                
                $.ajax({
                    type: "POST",
                    url: processTotalAmount,
                    //data: {agencyTypeCode: agencyTypeCode},
                    cache: false,
                    success: function(html) {
                       $("#totalDeposits").html(html);
                    }
                });
                
                var processTotalAmount = $absolute_path + "platform_admin" + $separator + "mainDashboardStatistics" + $separator + "totalWithdrawals";
                
                $.ajax({
                    type: "POST",
                    url: processTotalAmount,
                    //data: {agencyTypeCode: agencyTypeCode},
                    cache: false,
                    success: function(html) {
                       $("#totalWithdrawals").html(html);
                    }
                });
                
                var processTotalAmount = $absolute_path + "platform_admin" + $separator + "mainDashboardStatistics" + $separator + "totalInboundTransfer";
                
                $.ajax({
                    type: "POST",
                    url: processTotalAmount,
                    //data: {agencyTypeCode: agencyTypeCode},
                    cache: false,
                    success: function(html) {
                       $("#totalInboundTransfer").html(html);
                    }
                });
                
                var processTotalAmount = $absolute_path + "platform_admin" + $separator + "mainDashboardStatistics" + $separator + "totalOutboundTransfer";
                
                $.ajax({
                    type: "POST",
                    url: processTotalAmount,
                    //data: {agencyTypeCode: agencyTypeCode},
                    cache: false,
                    success: function(html) {
                       $("#totalOutboundTransfer").html(html);
                    }
                });
                    

        });
    </script>
    
    <?php
    
    /**
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  This function works out and return the actual transaction dates                   |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    function zf_getTime($awayDays = NULL){
        
        $zf_date_parameters = array(

            "original_date" => Zf_Core_Functions::Zf_CurrentDate(), //today
            //"date_mask" => "Y-m-d", //date mask should take the exact same format as the original date.
            "date_mask" => "H:i:s", //date mask should take the exact same format as the original date.
            "date_action" => array(

                "what" => "min", //Accepted paramters are: years=>years, mos=>months, m=>months, weeks=>weeks, days=>days, d=>days, hrs.=>hours, h=>hours, min=>minutes, sec=>seconds
                "howMuch" => $awayDays //This is the number of days

            )

        );
        
        return $zf_date_parameters;
        
        
    }
    
    ?>

