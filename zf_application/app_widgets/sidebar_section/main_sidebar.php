<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- add "navbar-no-scroll" class to disable the scrolling of the sidebar menu -->
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu">
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler hidden-phone">
                </div>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <form class="sidebar-search" action="extra_search.html" method="POST">
                    <div class="form-container">
                        <div class="input-box">
                            <a href="javascript:;" class="remove">
                            </a>
                            <input type="text" placeholder="Search..."/>
                            <input type="button" class="submit" value=" "/>
                        </div>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            
            <!-- START OF ACTUAL SIDE BAR MENU-->
            <?php
                //LOAD THE WIDGET THAT HAS THE sIDEBAR MENU
                Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "actual_sidebar.php");
            ?>
            <!-- END OF ACTUAL SIDE BAR MENU-->
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
