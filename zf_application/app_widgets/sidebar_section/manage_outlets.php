<?php
    //Here we generate the actual application menu.

    $main_menu = array(
        
        //New Outlet
        "new_outlet" => array(
            'name' => '<i class="fa fa-square"></i> New Outlet',
            'controller' => 'platform_admin',
            'action' => 'manage_outlets',
            'parameter' => 'new_outlet',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Outlets Directory
        "outlets_directory" => array(
            'name' => '<i class="fa fa-folder-open"></i> Outlets Directory',
            'controller' => 'platform_admin',
            'action' => 'manage_outlets',
            'parameter' => 'outlets_directory',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Active Outlets
        "active_outlets" => array(
            'name' => '<i class="fa fa-check-square-o"></i> Active Outlets',
            'controller' => 'platform_admin',
            'action' => 'manage_outlets',
            'parameter' => 'active_outlets',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Suspended Outlets
        "suspended_outlets" => array(
            'name' => '<i class="fa fa-ban"></i> Suspended Outlets',
            'controller' => 'platform_admin',
            'action' => 'manage_outlets',
            'parameter' => 'suspended_outlets',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Outlet Reports
        "outlets_report" => array(
            'name' => '<i class="fa fa-bar-chart-o"></i> Outlet Reports',
            'controller' => 'platform_admin',
            'action' => 'manage_outlets',
            'parameter' => 'outlets_report',
            'title' => '',
            'style' => '',
            'id' => ''
        )
        
    );
    
    $active_menu_item = Zf_Core_Functions::Zf_URLSanitize();
    
    $parameter = Zf_SecureData::zf_decode_data($active_menu_item[2]);

?>

<li class="<?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_outlets")) { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-th-large"></i>
        <span class="title">Zeepo Outlets</span>
        <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_outlets")) {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_outlets")) { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($parameter == "new_outlet") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['new_outlet']); ?>
        </li>
        <li class="<?php if ($parameter == "outlets_directory") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['outlets_directory']); ?>
        </li>
        <li class="<?php if ($parameter == "active_outlets") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['active_outlets']); ?>
        </li>
        <li class="<?php if ($parameter == "suspended_outlets") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['suspended_outlets']); ?>
        </li>
        <li class="<?php if ($parameter == "outlets_report") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['outlets_report']); ?>
        </li>
    </ul>
</li>