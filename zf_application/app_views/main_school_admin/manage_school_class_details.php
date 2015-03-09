<?php
    //Accessing school profile model

    $zf_actionData;//This is the incoming array from the controller action
    
    $identificationCode = $zf_actionData[0];//identification code
    $viewOption = $zf_actionData[1];//view option
    $schoolSystemCode = $zf_actionData[2];//school system code
    $schoolClassCode = $schoolSystemCode.ZVSS_CONNECT.$zf_actionData[3];//clean class name
?>

<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">

        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <h3 class="page-title">Manage Classes</h3>
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
                            <?php
                                if($viewOption == "editClass"){

                                    echo '<i class="fa fa-edit"></i> Edit Class Details';

                                }else if($viewOption == "viewClass"){

                                    echo '<i class="fa fa-lightbulb-o"></i> Class Profile';

                                }
                            ?>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"></a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <?php
                            if($viewOption == "editClass"){
                                
                                Zf_ApplicationWidgets::zf_load_widget("main_school_admin", "edit_class_details.php");

                            }else if($viewOption == "viewClass"){
                                
                                Zf_ApplicationWidgets::zf_load_widget("main_school_admin", "view_class_details.php");
                                
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END INNER CONTENT -->

    </div>
</div>
<!-- END CONTENT -->

