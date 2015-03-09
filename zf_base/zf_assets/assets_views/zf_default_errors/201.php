<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS SYSTEM ERROR 201 FILE. ITS AN ERROR RENDERED WHEN THE SELECETD
 * DEFAULT ACTION IS NOT SET. I.E THE REQUESTED DEFAULT ACTION IS NOT SET IN THE
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
                                Error 201
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
                    <?php echo $zf_actionData; ?>
                </div>
            </div>
            <!-- END INNER CONTENT -->
            
        </div>
    </div>
    <!-- END CONTENT -->

