<?php
    //Here we generate the actual application menu.

    $main_menu = array(
        
        
        
        //Outlet Floats
        "outlet_floats" => array(
            'name' => '<i class="fa fa-bank"></i> Banker Floats',
            'controller' => 'platform_admin',
            'action' => 'manage_floats',
            'parameter' => 'outlet_floats',
            'title' => '',
            'style' => 'disabled-link',
            'id' => ''
        ),
        
        //Banker Floats
        "banker_floats" => array(
            'name' => '<i class="fa fa-th-large"></i> Outlet Floats',
            'controller' => 'platform_admin',
            'action' => 'manage_floats',
            'parameter' => 'banker_floats',
            'title' => '',
            'style' => 'disabled-link',
            'id' => ''
        ),
        
        //Float Reports
        "float_reports" => array(
            'name' => '<i class="fa fa-money"></i> Float Reports',
            'controller' => 'platform_admin',
            'action' => 'manage_floats',
            'parameter' => 'float_reports',
            'title' => '',
            'style' => 'disabled-link',
            'id' => ''
        )
        
    );
    
    $active_menu_item = Zf_Core_Functions::Zf_URLSanitize();
    
    $parameter = Zf_SecureData::zf_decode_data($active_menu_item[2]);

?>

<li class="<?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_floats")) { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-money"></i>
        <span class="title">Zeepo Floats</span>
        <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_floats")) {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_floats")) { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($parameter == "banker_floats") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['banker_floats']); ?>
        </li>
        <li class="<?php if ($parameter == "outlet_floats") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['outlet_floats']); ?>
        </li>
        <li class="<?php if ($parameter == "float_reports") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['float_reports']); ?>
        </li>
    </ul>
</li>