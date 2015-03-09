 <?php
    //Accessing school profile model
    $zf_controller->Zf_loadModel("main_school_admin", "manage_school_students");

    $schoolSystemCode = $zf_actionData;
    
?> 
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
           
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">Manage Students Admissions</h3>
                    <div class="page-breadcrumb breadcrumb">
                        <i class="fa fa-home"></i> <?php Zf_BreadCrumbs::zf_load_breadcrumbs(); ?>
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
                                <i class="fa fa-group"></i> Students Admissions Profile
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse"></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            
                            <!--This is the start of the tabs-->
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
                                    <?php
                                        $zf_widgetFolder = "indicators"; $zf_widgetFile = "student_registration_forms_indicator.php";
                                        Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
                                    ?> 
                                    <div id="tabbed-nav">
                                        <ul>
                                            <li><a></i>Students admission forms overview</a></li>
                                            <li><a><i class="fa fa-plus-square"></i> Manage students admission forms</a></li>
                                        </ul>

                                        <div>
                                            <div> 
                                                <?php 
                                                    //FETCH HOSTEL DATA
                                                    $zf_controller->zf_targetModel->getStudentsAdmissionForms($schoolSystemCode);
                                                ?>
                                            </div>
                                            <div>
                                                <div class="tab-pane active">
                                                    <?php
                                                        //LOAD HOSTEL SETUP FORM
                                                        Zf_ApplicationWidgets::zf_load_widget("main_school_admin", "students_admission_forms.php");
                                                    ?>
                                                </div>
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

