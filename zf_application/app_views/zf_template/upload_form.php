
    
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
           
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">
                        Template Page <small>Blank Page</small>
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
            
            <div class="clearfix"></div>
            
            <!-- BEGIN INNER CONTENT -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 default-errors">
                    <h1>File Upload Test forms</h1>

                    <fieldset class="left">
                        <legend>File Upload</legend>
                        <p>Pick up a file to upload, and press "upload" </p>
                        <form name="form1" enctype="multipart/form-data" method="post" action="<?php Zf_GenerateLinks::basic_internal_link("zf_template", "fileUpload"); ?>" />
                            <div><input type="file" size="32" name="uploadFile" value="" style="margin: 10px auto 10px auto !important;"/></div>
                            <input type="submit" name="Submit" value="upload" style="margin: 10px auto 10px -15% !important;"/></p>
                        </form>
                    </fieldset>
                </div>
            </div>
            <!-- END INNER CONTENT -->
            
        </div>
    </div>
    <!-- END CONTENT -->

