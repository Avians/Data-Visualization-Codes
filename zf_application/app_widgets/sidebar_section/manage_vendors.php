<?php
    //Here we generate the actual application menu.

    $main_menu = array(
        
        
        //Vendor setup
        "vendor_setup" => array(
            'name' => '<i class="fa fa-share-alt"></i> Vendors Setup',
            'controller' => 'platform_admin',
            'action' => 'zippo_setup',
            'parameter' => 'vendor_setup',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Agent setup
        "agent_setup" => array(
            'name' => '<i class="fa fa-delicious"></i> Agents Setup',
            'controller' => 'platform_admin',
            'action' => 'zippo_setup',
            'parameter' => 'agent_setup',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Outlet setup
        "outlet_setup" => array(
            'name' => '<i class="fa fa-square"></i> Outlet Setup',
            'controller' => 'platform_admin',
            'action' => 'zippo_setup',
            'parameter' => 'outlet_setup',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Commission setup
        "commission_setup" => array(
            'name' => '<i class="fa fa-toggle-off"></i> Commission Setup',
            'controller' => 'platform_admin',
            'action' => 'zippo_setup',
            'parameter' => 'commission_setup',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        
        //Own product setup
        "own_product" => array(
            'name' => '<i class="fa fa-cubes"></i> Own Product',
            'controller' => 'platform_admin',
            'action' => 'zippo_setup',
            'parameter' => 'Own Products',
            'title' => '',
            'style' => 'disabled-link',
            'id' => ''
        ),
        
    );
    
    $active_menu_item = Zf_Core_Functions::Zf_URLSanitize();
    
    $parameter = Zf_SecureData::zf_decode_data($active_menu_item[2]);

?>

<li class="<?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "zippo_setup")) { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-cogs"></i>
        <span class="title">Zeepo Setup</span>
        <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "zippo_setup")) {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "zippo_setup")) { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($parameter == "vendor_setup") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['vendor_setup']); ?>
        </li>
        <li class="<?php if ($parameter == "agent_setup") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['agent_setup']); ?>
        </li>
        <li class="<?php if ($parameter == "outlet_setup") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['outlet_setup']); ?>
        </li>
        <li class="<?php if ($parameter == "commission_setup") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['commission_setup']); ?>
        </li>
        <li class="<?php if ($parameter == "own_product") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['own_product']); ?>
        </li>
    </ul>
</li>