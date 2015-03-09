<!-- BEGIN HEADER -->
<?php
    //LOAD THE WIDGET THAT HAS THE VERY TOP SECTION
    Zf_ApplicationWidgets::zf_load_widget("header_section", "main_header.php");
?>
<!-- END HEADER -->

<div class="clearfix"></div>

<!-- BEGIN CONTAINER -->
<div class="page-container">

    <!-- BEGIN SIDEBAR -->
    <?php
        //LOAD THE WIDGET THAT HAS THE SIDEBAR MENU
       Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "main_sidebar.php");
    ?>
    <!-- END SIDEBAR -->
