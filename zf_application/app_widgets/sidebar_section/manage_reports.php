<?php
    //Here we generate the actual application menu.

    $identificationCode = "Athias";

    $main_menu = array(
        
       
        //Float Reports
        "float_reports" => array(
            'name' => '<i class="fa fa-money"></i> Float Reports',
            'controller' => 'platform_admin',
            'action' => 'manage_reports',
            'parameter' => 'float_reports',
            'title' => '',
            'style' => 'disabled-link',
            'id' => ''
        ),
        
        //Outlet Reports
        "outlet_reports" => array(
            'name' => '<i class="fa fa-th-large"></i> Outlets Reports',
            'controller' => 'platform_admin',
            'action' => 'manage_reports',
            'parameter' => 'outlet_reports',
            'title' => '',
            'style' => 'disabled-link',
            'id' => ''
        ),
        
        //Bankers Reports
        "banker_reports" => array(
            'name' => '<i class="fa fa-bank"></i> Bankers\' Reports',
            'controller' => 'platform_admin',
            'action' => 'manage_reports',
            'parameter' => 'banker_reports',
            'title' => '',
            'style' => 'disabled-link',
            'id' => ''
        ),
        
        //Transaction Reports
        "transaction_reports" => array(
            'name' => '<i class="fa fa-exchange"></i> Transaction Reports',
            'controller' => 'platform_admin',
            'action' => 'manage_reports',
            'parameter' => 'transaction_reports',
            'title' => '',
            'style' => 'disabled-link',
            'id' => ''
        ),
        
        //User Reports
        "user_reports" => array(
            'name' => '<i class="fa fa-users"></i> User Reports',
            'controller' => 'platform_admin',
            'action' => 'manage_reports',
            'parameter' => 'user_reports',
            'title' => '',
            'style' => 'disabled-link',
            'id' => ''
        )
        
    );
    
    $active_menu_item = Zf_Core_Functions::Zf_URLSanitize();
    
    $parameter = Zf_SecureData::zf_decode_data($active_menu_item[2]);

?>

<li class="<?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_reports")) { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-bar-chart-o"></i>
        <span class="title">Zeepo Reports</span>
        <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_reports")) {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_reports")) { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($parameter == "float_reports") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['float_reports']); ?>
        </li>
        <li class="<?php if ($parameter == "outlet_reports") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['outlet_reports']); ?>
        </li>
        <li class="<?php if ($parameter == "banker_reports") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['banker_reports']); ?>
        </li>
        <li class="<?php if ($parameter == "transaction_reports") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['transaction_reports']); ?>
        </li>
        <li class="<?php if ($parameter == "user_reports") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['user_reports']); ?>
        </li>
    </ul>
</li>