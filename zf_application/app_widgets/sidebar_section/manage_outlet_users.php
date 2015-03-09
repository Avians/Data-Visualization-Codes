<?php
    //Here we generate the actual application menu.

    $identificationCode = "Athias";

    $main_menu = array(

        //New Users
        "new_user" => array(
            'name' => '<i class="fa fa-plus-square"></i> New Outlet Staff',
            'controller' => 'outlet_staff',
            'action' => 'manage_users',
            'parameter' => 'new_users',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        
        //Outlet User
        "outlet_users" => array(
            'name' => '<i class="fa fa-th-large"></i> Zeepo Outlet Staff',
            'controller' => 'outlet_staff',
            'action' => 'manage_users',
            'parameter' => 'outlet_users',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //User Reports
        "user_reports" => array(
            'name' => '<i class="fa fa-file-text-o"></i> Outlet Staff Reports',
            'controller' => 'outlet_staff',
            'action' => 'manage_users',
            'parameter' => 'users_reports',
            'title' => '',
            'style' => 'disabled-link',
            'id' => ''
        )
        
    );
    
    $active_menu_item = Zf_Core_Functions::Zf_URLSanitize();
    
    $parameter = Zf_SecureData::zf_decode_data($active_menu_item[2]);

?>

<li class="<?php if (($active_menu_item[0] == "outlet_staff") && ($active_menu_item[1]== "manage_users")) { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-users"></i>
        <span class="title">Zeepo Users</span>
        <?php if (($active_menu_item[0] == "outlet_staff") && ($active_menu_item[1]== "manage_users")) {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if (($active_menu_item[0] == "outlet_staff") && ($active_menu_item[1]== "manage_users")) { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($parameter == "new_users") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['new_user']); ?>
        </li>
        <li class="<?php if ($parameter == "outlet_users") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['outlet_users']); ?>
        </li>
        <li class="<?php if ($parameter == "user_reports") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['user_reports']); ?>
        </li>
    </ul>
</li>