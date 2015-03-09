    <?php
        //Accessing school profile model
        $zf_controller->Zf_loadModel("main_school_admin", "school_profile", "Athias");
        
        $systemSchoolCode = $zf_actionData;
    ?>
    
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
           
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">Manage School Profile</h3>
                    <div class="page-breadcrumb breadcrumb">
                        <i class="fa fa-home"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs($systemSchoolCode); ?>
                    </div>
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
                                <i class="fa fa-indent"></i> School Profile
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
                                            <li><a></i> School Profile Overview</a></li>
                                            <li><a><i class="fa fa-edit"></i> Edit School Profile</a></li>
                                        </ul>

                                        <div>
                                            <div> 
                                                <div class="row"> 
                                                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-12 margin-bottom-15">
                                                        <div class="zvss-logo-wrapper">
                                                            <div>
                                                                <?php $zf_controller->zf_targetModel->getSchoolLogo($systemSchoolCode); ?>
                                                            </div>
                                                            <div>School Logo</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-9 col-sm-8 col-xs-12 margin-bottom-15">
                                                        <div class="school-content-wrapper">
                                                            <h3>Brief School History</h3>
                                                            <hr>
                                                            <div class="school-profile-inner-content">
                                                                <?php $zf_controller->zf_targetModel->getSchoolHistory($systemSchoolCode); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin-bottom-15">
                                                        <div class="school-content-wrapper">
                                                            <h3>School Sponsors</h3>
                                                            <hr>
                                                            <div class="school-profile-inner-content">
                                                                <?php $zf_controller->zf_targetModel->getSchoolSponsors($systemSchoolCode); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin-bottom-15">
                                                        <div class="school-content-wrapper">
                                                            <h3>Main Administration</h3>
                                                            <hr>
                                                            <div class="school-profile-inner-content">
                                                                <?php $zf_controller->zf_targetModel->getSchoolMainAdmin($systemSchoolCode); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin-bottom-15">
                                                        <div class="school-content-wrapper">
                                                            <h3>School Details</h3>
                                                            <hr>
                                                            <div class="school-profile-inner-content">
                                                                <?php $zf_controller->zf_targetModel->getSchoolDetails($systemSchoolCode); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin-bottom-15">
                                                        <div class="school-content-wrapper">
                                                            <h3>School Structure</h3>
                                                            <hr>
                                                            <div class="school-profile-inner-content">
                                                                <?php $zf_controller->zf_targetModel->getSchoolStructure($systemSchoolCode); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin-bottom-15">
                                                        <div class="school-content-wrapper">
                                                            <h3>School Members</h3>
                                                            <hr>
                                                            <div class="school-profile-inner-content">
                                                                <?php $zf_controller->zf_targetModel->getSchoolMembers($systemSchoolCode); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 margin-bottom-15">
                                                        <div class="school-content-wrapper">
                                                            <h3>School Affiliates</h3>
                                                            <hr>
                                                            <div class="school-profile-inner-content">
                                                                <?php $zf_controller->zf_targetModel->getSchoolAffiliates($systemSchoolCode); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom-5">
                                                        <div class="school-content-wrapper performance-containers">
                                                            <h3>School Performance</h3>
                                                            <hr>
                                                            <div class="school-profile-inner-content">
                                                                <?php $zf_controller->zf_targetModel->getSchoolPerformance($systemSchoolCode); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 margin-bottom-5">
                                                        <div class="school-content-wrapper performance-containers">
                                                            <h3>Class Performance</h3>
                                                            <hr>
                                                            <div class="school-profile-inner-content">
                                                                <?php $zf_controller->zf_targetModel->getClassPerformance($systemSchoolCode); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <h4>Edit Profile</h4>
                                                <p> Tab Contents goes here</p>
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

