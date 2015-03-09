<?php

$identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");

//returns an array holding the user details
$userDetails = $zf_model_data->zf_getUserDetails($identificationCode);

if($userDetails === 0){
                        
    echo '<strong>Error Detected:</strong> <pre>Both Order Maker and Supplier Must be present</pre>';

}else{

    //Here we prepare Order Maker details
    foreach ($userDetails as $value) {

        $userName = $value['adminFirstName']." ".$value['adminLastName'];

    }
    
}

//echo "<pre>";print_r($userDetails);echo "</pre>";exit();

$firstName = $userDetails['adminFirstName'];

$user_menu = array(
    
        //USER PROFILE
        "my_profile" => array(
            'name' => '<i class="fa fa-user"></i> My Profile',
            'controller' => 'platform_user',
            'action' => 'view_profile',
            'parameter' => '', //Username e.g Athias
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
        //UPDATE USER PROFILE
        "update_profile" => array(
            'name' => '<i class="fa fa-edit"></i> Update Profile',
            'controller' => 'platform_user',
            'action' => 'update_profile',
            'parameter' => '', //Username e.g Athias
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
        //CALENDER
        "my_calender" => array(
            'name' => '<i class="fa fa-calendar"></i> My Calendar',
            'controller' => 'platform_user',
            'action' => 'emails',
            'parameter' => '',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
        //MAIL INBOX
        "mail_inbox" => array(
            'name' => '<i class="fa fa-envelope"></i> My Inbox<span class="badge badge-danger">3</span>',
            'controller' => 'platform_user',
            'action' => 'emails',
            'parameter' => '',
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
        //USER TASKS
        "user_tasks" => array(
            'name' => '<i class="fa fa-tasks"></i> My Tasks<span class="badge badge-success">7</span>',
            'controller' => 'platform_user',
            'action' => 'user_tasks',
            'parameter' => '', //Username e.g Athias
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
        //LOCK USER
        "lock_user" => array(
            'name' => '<i class="fa fa-lock"></i> Lock Screen',
            'controller' => 'initialize',
            'action' => 'lock_user',
            'parameter' => '', //Username e.g Athias
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
        //LOGOUT
        "logout" => array(
            'name' => '<i class="fa fa-power-off"></i> Log Out',
            'controller' => 'initialize',
            'action' => 'logout',
            'parameter' => '', //Username e.g Athias
            'title' => '',
            'style' => '',
            'id' => ''
        ),
    
);
?>
<li class="dropdown user">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <img alt="" src="<?php echo ZF_ROOT_PATH . ZF_CLIENT . "zf_app_global" . DS . "app_global_files" . DS . "app_global_images" . DS . "users" . DS . "user.png"; ?>" height="30px"/>
        <span class="username">
            <?php echo $userName; ?>
        </span>
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu">
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['my_profile']); ?>
        </li>
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['update_profile']); ?>
        </li>
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['my_calender']); ?>
        </li>
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['mail_inbox']); ?>
        </li>
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['user_tasks']); ?>
        </li>
        <li class="divider"></li>
        <li>
            <a href="javascript:;" id="trigger_fullscreen">
                <i class="fa fa-arrows"></i> Full Screen
            </a>
        </li>
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['lock_user']); ?>
        </li>
        <li>
            <?php Zf_GenerateLinks::zf_internal_link($user_menu['logout']); ?>
        </li>
    </ul>
</li>