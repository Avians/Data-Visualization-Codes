<?php
    //Here we generate the actual application menu.

    $identificationCode = "Athias";

    $main_menu = array(

        //New Users
        "new_user" => array(
            'name' => '<i class="fa fa-plus-square"></i> New User',
            'controller' => 'platform_admin',
            'action' => 'manage_users',
            'parameter' => 'new_users',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Platform Users
        "platform_users" => array(
            'name' => '<i class="fa fa-home"></i> Zeepo Admin Users',
            'controller' => 'platform_admin',
            'action' => 'manage_users',
            'parameter' => 'platform_users',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Outlet User
        "outlet_users" => array(
            'name' => '<i class="fa fa-th-large"></i> Zeepo Outlet Users',
            'controller' => 'platform_admin',
            'action' => 'manage_users',
            'parameter' => 'outlet_users',
            'title' => '',
            'style' => 'disabled-link',
            'id' => ''
        ),
        
        //User Reports
        "user_reports" => array(
            'name' => '<i class="fa fa-file-text-o"></i> Zeepo User Reports',
            'controller' => 'platform_admin',
            'action' => 'manage_users',
            'parameter' => 'user_reports',
            'title' => '',
            'style' => 'disabled-link',
            'id' => ''
        )
        
    );
    
    $active_menu_item = Zf_Core_Functions::Zf_URLSanitize();
    
    $parameter = Zf_SecureData::zf_decode_data($active_menu_item[2]);

?>

<li class="<?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_users")) { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-users"></i>
        <span class="title">Zeepo Users</span>
        <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_users")) {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_users")) { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($parameter == "new_user") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['new_user']); ?>
        </li>
        <li class="<?php if ($parameter == "platform_users") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['platform_users']); ?>
        </li>
        <li class="<?php if ($parameter == "outlet_users") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['outlet_users']); ?>
        </li>
        <li class="<?php if ($parameter == "user_reports") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['user_reports']); ?>
        </li>
    </ul>
</li>