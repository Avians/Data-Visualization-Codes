
    
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
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue">
                        <div class="visual">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                12.5M$
                            </div>
                            <div class="desc">
                                Available Float
                            </div>
                        </div>
                        <a class="more" href="#">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat green">
                        <div class="visual">
                            <i class="fa fa-th-large"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                305
                            </div>
                            <div class="desc">
                                Total Outlets
                            </div>
                        </div>
                        <a class="more" href="#">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat purple">
                        <div class="visual">
                            <i class="fa fa-exchange"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                1500
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
                    <div class="dashboard-stat yellow">
                        <div class="visual">
                            <i class="fa fa-signal"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                12%
                            </div>
                            <div class="desc">
                                Growth Rate
                            </div>
                        </div>
                        <a class="more" href="#">
                            View more <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END DASHBOARD STATS -->
            <div class="clearfix">
            
            <!-- BEGIN DASHBOARD STATS -->
            <?php
                Zf_ApplicationWidgets::zf_load_widget("platform_admin", "dashboard_statistics.php");
            ?>
            <!-- END DASHBOARD STATS -->
            
        </div>
    </div>
    <!-- END CONTENT -->

