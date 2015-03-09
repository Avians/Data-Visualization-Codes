<?php
  
    //Accessing the new transactions model
    $zf_controller->Zf_loadModel("platform_admin", "outletSetup");
    
?> 
    
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
           
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">
                        Suspended Outlets Directory
                    </h3>
                    <!-- END PAGE TITLE & BREADCRUMB-->
                </div>
            </div>
            <!-- END PAGE HEADER-->
            
            <div class="clearfix"></div>
            <!-- BEGIN INNER CONTENT -->
            
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="portlet-body table-responsive">
                        <?php echo $zf_generateTable ; ?>
                    </div>
                </div>
            </div>
            <!--row-->
            
            <div class="clearfix"><br></div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-map-marker"></i>Map of Suspended Outlets
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse">
                                </a>
                                <a href="#portlet-config" data-toggle="modal" class="config">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body" style="height: 450px !important;">
                            <?php $zf_controller->zf_targetModel->OutletMaps($outletTypes = "suspended"); ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--row-->
            
            <div class="clearfix"><br></div>
        </div>
    </div>
    <!-- END CONTENT -->

