<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS SYSTEM ERROR 202 FILE. ITS AN ERROR RENDERED WHEN THE SELECETD ACTION
 * IS INVALID. I.E THE REQUESTED ACTION IS NOT AMONG THE EXECUTABLE ACTIONS IN A
 * GIVEN CONTROLLER.
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  12th/August/2013  Time: 09:00 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013
 * 
 */

?>

    
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
           
            <!-- BEGIN PAGE HEADER-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                    <h3 class="page-title">
                       ZIPPO - Platform Error!
                    </h3>
                    <ul class="page-breadcrumb breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <?php
                                $error_link = array(
                                    'name' => 'Main Page',
                                    'controller' => 'index',
                                    'action' => '',
                                    'parameter' => '',
                                    'title' => '',
                                    'style' => '',
                                    'id' => ''
                                );
                                Zf_GenerateLinks::zf_internal_link($error_link);
                            ?>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="#">
                                Error 202 (The selected  Action is invalid)
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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 default-errors-with-image">
                    <div class="error-image-wrapper">
                       <img src="<?php echo ZF_ROOT_PATH.ASSETS_VIEWS.'zf_default_errors'.DS.'view_client'.DS.'zf_view_global'.DS.'view_files'.DS.'view_images'.DS.'Under-Construction.jpg'; ?>" alt="under construction" > 
                    </div>
                    <div class="clearfix"><br><hr class="error-hr"></div>
                    <div class="construction-info">
                        <p><h3>While iKrowd team is working on this section of the platform, you may pass your ideas or comments for consideration via ,</h3></p>
                        <p><a href="mailto:mathew@ikrwod.co.ke">mathew@ikrowd.co.ke</a></p>
                    </div>
                </div>
            </div>
            <!-- END INNER CONTENT -->
            
        </div>
    </div>
    <!-- END CONTENT -->


