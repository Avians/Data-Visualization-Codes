<div class="header navbar navbar-fixed-top">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="header-inner">
        <!-- BEGIN LOGO -->
        <?php
        $main_logo = array(
            'name' => '<div class="zila-logo-name"><p>ZIPPO<sup style="font-size: 12px !important;">TM</sup></p></div>',
            'controller' => 'index',
            'action' => '',
            'parameter' => '',
            'title' => '',
            'style' => 'navbar-brand',
            'id' => ''
        );
        //Zf_GenerateLinks::zf_internal_link($main_logo);
        Zf_Core_Functions::Zf_ApplicationLogo('100px');
        ?>
        <!-- END LOGO -->

        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <img src="<?php echo ZF_ROOT_PATH . ZF_CLIENT . "zf_app_global" . DS . "app_global_files" . DS . "app_global_images" . DS . "main_icons" . DS . "menu-toggler.png"; ?>" alt=""/>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->

        <!-- BEGIN TOP NAVIGATION MENU -->
        <ul class="nav navbar-nav pull-right">
            <?php
            
                /* BEGIN NOTIFICATION DROPDOWN */
                //Zf_ApplicationWidgets::zf_load_widget("header_section", "notifications.php");
                /* END NOTIFICATION DROPDOWN */

                /* BEGIN INBOX DROPDOWN */
                //Zf_ApplicationWidgets::zf_load_widget("header_section", "inbox_messages.php");
                /* END INBOX DROPDOWN */

                /* BEGIN TODO DROPDOWN */
                //Zf_ApplicationWidgets::zf_load_widget("header_section", "pending_tasks.php");
                /* END TODO DROPDOWN */

                /* BEGIN USER LOGIN DROPDOWN */
                Zf_ApplicationWidgets::zf_load_widget("header_section", "user_section.php");
                /* END USER LOGIN DROPDOWN */
                
           ?> 
        </ul>
        <!-- END TOP NAVIGATION MENU -->

    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>