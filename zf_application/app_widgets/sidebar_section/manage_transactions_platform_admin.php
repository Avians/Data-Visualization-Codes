<?php
    //Here we generate the actual application menu.

    $main_menu = array(
        
        //New Transactions
        "new_transactions" => array(
            'name' => '<i class="fa fa-arrows-h"></i> New Transactions',
            'controller' => 'platform_admin',
            'action' => 'manage_transactions',
            'parameter' => 'new_transactions',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Inbound Transactions
        "inbound_transactions" => array(
            'name' => '<i class="fa fa-sign-in"></i> Deposit Transactions',
            'controller' => 'platform_admin',
            'action' => 'manage_transactions',
            'parameter' => 'inbound_transactions',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Out bound transactions
        "outbound_transactions" => array(
            'name' => '<i class="fa fa-sign-out"></i> Withdrawal Transactions',
            'controller' => 'platform_admin',
            'action' => 'manage_transactions',
            'parameter' => 'outbound_transactions',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //All Transactions
        "all_transactions" => array(
            'name' => '<i class="fa fa-exchange"></i> All Transactions',
            'controller' => 'platform_admin',
            'action' => 'manage_transactions',
            'parameter' => 'all_transactions',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Transactions Trials
        "transaction_trial" => array(
            'name' => '<i class="fa fa-exchange"></i> Transactions Trial',
            'controller' => 'platform_admin',
            'action' => 'manage_transactions',
            'parameter' => 'transactions_trial',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Transaction Reports
        "transaction_reports" => array(
            'name' => '<i class="fa fa-file-text-o"></i> Transaction Reports',
            'controller' => 'platform_admin',
            'action' => 'manage_transactions',
            'parameter' => 'transaction_reports',
            'title' => '',
            'style' => '',
            'id' => ''
        )
        
    );
    
    $active_menu_item = Zf_Core_Functions::Zf_URLSanitize();
    
    $parameter = Zf_SecureData::zf_decode_data($active_menu_item[2]);

?>

<li class="<?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_transactions")) { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-exchange"></i>
        <span class="title">Zeepo Transactions</span>
        <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_transactions")) {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if (($active_menu_item[0] == "platform_admin") && ($active_menu_item[1]== "manage_transactions")) { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($parameter == "new_transactions") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['new_transactions']); ?>
        </li>
        <li class="<?php if ($parameter == "inbound_transactions") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['inbound_transactions']); ?>
        </li>
        <li class="<?php if ($parameter == "outbound_transactions") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['outbound_transactions']); ?>
        </li>
        <li class="<?php if ($parameter == "all_transactions") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['all_transactions']); ?>
        </li>
        <li class="<?php if ($parameter == "transaction_trial") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['transaction_trial']); ?>
        </li>
        <li class="<?php if ($parameter == "transaction_reports") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['transaction_reports']); ?>
        </li>
    </ul>
</li>