<?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    //Decode the session variable
    $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
    
    //echo "<code>".$identificationCode."</code><br><pre>";print_r($identifictionArray);echo "</pre>"; //Strictly for debugging purposes.

    $main_menu = array(
        
        //Super Admin Dashboard
        "super_admin_dashboard" => array(
            'name' => '<i class="fa fa-home"></i> <span class="title">Main Dashboard</span><span class="selected"></span>',
            'controller' => 'main_dashboard',
            'action' => 'super_admin_dashboard',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Platform Admin Dashboard
        "platform_admin_dashboard" => array(
            'name' => '<i class="fa fa-home"></i> <span class="title">Main Dashboard</span><span class="selected"></span>',
            'controller' => 'main_dashboard',
            'action' => 'platform_admin_dashboard',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Platform Admin Dashboard
        "platform_admin_filtered_dashboard" => array(
            'name' => '<i class="fa fa-filter"></i> <span class="title">Filter Dashboard</span><span class="selected"></span>',
            'controller' => 'main_dashboard',
            'action' => 'platform_admin_filtered_dashboard',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Zippo Management Dashboard
        "zippo_management_dashboard" => array(
            'name' => '<i class="fa fa-home"></i> <span class="title">Main Dashboard</span><span class="selected"></span>',
            'controller' => 'main_dashboard',
            'action' => 'zippo_management_dashboard',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Zippo Operations Dashboard
        "zippo_operations_dashboard" => array(
            'name' => '<i class="fa fa-home"></i> <span class="title">Main Dashboard</span><span class="selected"></span>',
            'controller' => 'main_dashboard',
            'action' => 'zippo_operations_dashboard',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Zippo Finance Dashboard
        "zippo_finance_dashboard" => array(
            'name' => '<i class="fa fa-home"></i> <span class="title">Main Dashboard</span><span class="selected"></span>',
            'controller' => 'main_dashboard',
            'action' => 'zippo_finance_dashboard',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Zippo Treasury Dashboard
        "zippo_treasury_dashboard" => array(
            'name' => '<i class="fa fa-home"></i> <span class="title">Main Dashboard</span><span class="selected"></span>',
            'controller' => 'main_dashboard',
            'action' => 'zippo_treasury_dashboard',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Outlet Staff Dashboard
        "outlet_staff_dashboard" => array(
            'name' => '<i class="fa fa-home"></i> <span class="title">Main Dashboard</span><span class="selected"></span>',
            'controller' => 'main_dashboard',
            'action' => 'outlet_staff_dashboard',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        
        
        
    );
    
    $active_menu_item = Zf_Core_Functions::Zf_URLSanitize();
?>
<!--START OF PLATFORM SUPER ADMIN-->
 <?php if($identifictionArray[3] == PLATFORM_SUPER_ADMIN){ ?>
    <li class="start <?php if (($active_menu_item[0] == "main_dashboard") && ($active_menu_item[1]== "super_admin_dashboard")) { echo "active";} ?>">
        <?php Zf_GenerateLinks::zf_internal_link($main_menu['platform_super_dashboard']); ?>
    </li>
 <?php } ?>
<!--END OF PLATFORM SUPER ADMIN-->

<!--START OF ZIPPO PLATFORM ADMIN-->
 <?php if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){ ?>
    <li  class="start <?php if (($active_menu_item[0] == "main_dashboard") && ($active_menu_item[1]== "platform_admin_dashboard" || $active_menu_item[1]== "platform_admin_filtered_dashboard")) { echo "active";} ?>">
        <a href="javascript:;">
            <i class="fa fa-cogs"></i>
            <span class="title">Zeepo Dashboard</span>
            <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "zippo_setup")) {?><span class="selected"></span><?php } ?>
            <span class="arrow <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "zippo_setup")) { echo "open";} ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="<?php if ($active_menu_item[1]== "platform_admin_dashboard") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['platform_admin_dashboard']); ?>
            </li>
            <li class="<?php if ($active_menu_item[1]== "platform_admin_filtered_dashboard") { echo "active";} ?>">
                <?php Zf_GenerateLinks::zf_internal_link($main_menu['platform_admin_filtered_dashboard']); ?>
            </li>
        </ul>
    </li>
 <?php } ?>
<!--END OF ZIPPO PLATFORM ADMIN-->

<!--START OF ZIPPO MANAGEMENT-->  
 <?php if($identifictionArray[3] == ZIPPO_MANAGEMENT){ ?>
    <li class="start <?php if (($active_menu_item[0] == "main_dashboard") && ($active_menu_item[1]== "zippo_management_dashboard")) { echo "active";} ?>">
        <?php Zf_GenerateLinks::zf_internal_link($main_menu['zippo_management_dashboard']); ?>
    </li>
 <?php } ?>
 <!--END OF ZIPPO MANAGEMENT-->

<!--START OF ZIPPO OPERATIONS-->   
 <?php if($identifictionArray[3] == ZIPPO_OPERATIONS){ ?>
    <li class="start <?php if (($active_menu_item[0] == "main_dashboard") && ($active_menu_item[1]== "zippo_operations_dashboard")) { echo "active";} ?>">
        <?php Zf_GenerateLinks::zf_internal_link($main_menu['zippo_operations_dashboard']); ?>
    </li>
 <?php } ?>
<!--END OF ZIPPO OPERATIONS-->

<!--START OF ZIPPO FINANCE-->    
 <?php if($identifictionArray[3] == ZIPPO_FINANCE){ ?>
    <li class="start <?php if (($active_menu_item[0] == "main_dashboard") && ($active_menu_item[1]== "zippo_finance_dashboard")) { echo "active";} ?>">
        <?php Zf_GenerateLinks::zf_internal_link($main_menu['zippo_finance_dashboard']); ?>
    </li>
 <?php } ?>
<!--END OF ZIPPO FINANCE-->

<!--START OF ZIPPO TREASURY-->   
 <?php if($identifictionArray[3] == ZIPPO_TREASURY){ ?>
    <li class="start <?php if (($active_menu_item[0] == "main_dashboard") && ($active_menu_item[1]== "zippo_treasury_dashboard")) { echo "active";} ?>">
        <?php Zf_GenerateLinks::zf_internal_link($main_menu['zippo_treasury_dashboard']); ?>
    </li>
 <?php } ?>
<!--END OF ZIPPO TREASURY-->

<!--START OF OUTLET STAFF-->   
 <?php if($identifictionArray[3] == ZIPPO_OUTLET_STAFF || $identifictionArray[3] == ZIPPO_OUTLET_JUNIOR_STAFF){ ?>
    <li class="start <?php if (($active_menu_item[0] == "main_dashboard") && ($active_menu_item[1]== "outlet_staff_dashboard")) { echo "active";} ?>">
        <?php Zf_GenerateLinks::zf_internal_link($main_menu['outlet_staff_dashboard']); ?>
    </li>
 <?php } ?>
<!--END OF OUTLET STAFF-->

<!--END OF SCHOOL ALUMNI-->