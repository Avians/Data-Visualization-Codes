
    
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
                Zf_ApplicationWidgets::zf_load_widget("platform_admin", "dashboard_statistics.php");
            ?>
            <!-- END DASHBOARD STATS -->
            
            <div class="clearfix"></div>
            
            <!-- BEGIN INNER CONTENT -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-map-marker"></i>School Localities
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse">
                                </a>
                                <a href="#portlet-config" data-toggle="modal" class="config">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            xxxxx
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"><br></div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-top-10">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bars"></i>School Levels
                            </div>
                        </div>
                        <div class="portlet-body">
                            xxxxx
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-top-10">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bar-chart-o"></i>School Categories
                            </div>
                        </div>
                        <div class="portlet-body">
                            xxxxx
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"><br></div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-top-10">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-users"></i>School Genders
                            </div>
                        </div>
                        <div class="portlet-body">
                            xxxxx
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 margin-top-10">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-code-fork"></i>School Types
                            </div>
                        </div>
                        <div class="portlet-body">
                            xxxxx
                        </div>
                    </div>
                </div>
            </div>
            <!-- END INNER CONTENT -->
            
        </div>
    </div>
    <!-- END CONTENT -->

