<?php
    //Here we generate the actual application menu.

    //This is the actual encrypted user identification code.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    //Decode the session variable
    $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
    
    //echo "<code>".$identificationCode."</code><br><pre>";print_r($identifictionArray);echo "</pre>"; //Strictly for debugging purposes.


    $main_menu = array(
        
        //School Profile
        "school_profile" => array(
            'name' => '<i class="fa fa-institution"></i> <span class="title">School Profile </span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_profile',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Classess
        "manage_classes" => array(
            'name' => '<i class="fa fa-building-o"></i> <span class="title">Manage Classes </span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_classes',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Departments
        "manage_departments" => array(
            'name' => '<i class="fa fa-sitemap"></i> <span class="title">Manage Departments </span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_departments',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Hostels
        "manage_hostels" => array(
            'name' => '<i class="fa fa-hospital-o"></i> <span class="title">Manage Hostels </span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_hostels',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Library
        "manage_library" => array(
            'name' => '<i class="fa fa-folder-open"></i> <span class="title">Manage Library </span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_library',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Transport
        "manage_transport" => array(
            'name' => '<i class="fa fa-truck"></i> <span class="title">Manage Transport </span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_transport',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Teachers
        "manage_teachers" => array(
            'name' => '<i class="fa fa-group"></i> <span class="title">Manage Teachers </span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_teachers',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Students
        "manage_students" => array(
            'name' => '<i class="fa fa-graduation-cap"></i> <span class="title">Manage Students </span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_students',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Sub Staff
        "manage_sub_staff" => array(
            'name' => '<i class="fa fa-male"></i> <span class="title">Manage Sub Staff</span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_sub_staff',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Fees
        "manage_fees" => array(
            'name' => '<i class="fa fa-money"></i> <span class="title">Manage School Fees</span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_fees',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Subjects
        "manage_subjects" => array(
            'name' => '<i class="fa fa-book"></i> <span class="title">Manage Subjects</span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_subjects',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Exams
        "manage_exams" => array(
            'name' => '<i class="fa fa-print"></i> <span class="title">Manage Examination</span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_exams',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Marksheet
        "manage_marksheet" => array(
            'name' => '<i class="fa fa-check-square-o"></i> <span class="title">Manage Marksheet</span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_marksheet',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Timetable
        "manage_timetable" => array(
            'name' => '<i class="fa fa-clock-o"></i> <span class="title">Manage Timetable</span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_timetable',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Notice Board
        "manage_notice_board" => array(
            'name' => '<i class="fa fa-comments-o"></i> <span class="title">Manage Noitce Board</span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_notice_board',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Calender
        "manage_calendar" => array(
            'name' => '<i class="fa fa-calendar"></i> <span class="title">Manage Calendar</span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_calendar',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage Affiliates
        "manage_affiliates" => array(
            'name' => '<i class="fa fa-share-square-o"></i> <span class="title">Manage Affiliates</span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_affiliates',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        ),
        
        //Manage User Profile
        "manage_user" => array(
            'name' => '<i class="fa fa-user"></i> <span class="title">Manage User Profile</span><span class="selected"></span>',
            'controller' => 'main_school_admin',
            'action' => 'manage_school_user_profile',
            'parameter' => $identificationCode,
            'title' => '',
            'style' => '',
            'id' => ''
        )
        
    );
    
    $active_menu_item = Zf_Core_Functions::Zf_URLSanitize();
    
    $parameter = Zf_SecureData::zf_decode_data($active_menu_item[2]);

?>

<li class="<?php if ($active_menu_item[1]== "manage_school_profile") { echo "active";} ?>">
    <?php Zf_GenerateLinks::zf_internal_link($main_menu['school_profile']); ?>
</li>

<!--Set up school structure-->
<li class="<?php if (($active_menu_item[0] == "main_school_admin") && 
            (($active_menu_item[1]== "manage_school_classes")||($active_menu_item[1]== "manage_school_departments")||($active_menu_item[1]== "manage_school_hostels")||($active_menu_item[1]== "manage_school_library")||($active_menu_item[1]== "manage_school_transport"))) 
            { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-th"></i>
        <span class="title">School Structure </span>
        <?php if (($active_menu_item[0] == "main_school_admin") && 
         (($active_menu_item[1]== "manage_school_classes")||($active_menu_item[1]== "manage_school_departments")||($active_menu_item[1]== "manage_school_hostels")||($active_menu_item[1]== "manage_school_library")||($active_menu_item[1]== "manage_school_transport"))) 
        {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if (($active_menu_item[0] == "main_school_admin") && 
            (($active_menu_item[1]== "manage_school_classes")||($active_menu_item[1]== "manage_school_departments")||($active_menu_item[1]== "manage_school_hostels")||($active_menu_item[1]== "manage_school_library")||($active_menu_item[1]== "manage_school_transport"))) 
            { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($active_menu_item[1]== "manage_school_classes") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_classes']); ?>
        </li>
        <li class="<?php if ($active_menu_item[1]== "manage_school_departments") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_departments']); ?>
        </li>
        <li class="<?php if ($active_menu_item[1]== "manage_school_hostels") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_hostels']); ?>
        </li>
        <li class="<?php if ($active_menu_item[1]== "manage_school_library") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_library']); ?>
        </li>
        <li class="<?php if ($active_menu_item[1]== "manage_school_transport") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_transport']); ?>
        </li>
    </ul>
</li>

<!--Set up school admissions-->
<li class="<?php if (($active_menu_item[0] == "main_school_admin") && 
            (($active_menu_item[1]== "manage_school_teachers")||($active_menu_item[1]== "manage_school_students")||($active_menu_item[1]== "manage_school_sub_staff"))) 
            { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-sign-in"></i>
        <span class="title">School Admissions </span>
        <?php if (($active_menu_item[0] == "main_school_admin") && 
         (($active_menu_item[1]== "manage_school_teachers")||($active_menu_item[1]== "manage_school_students")||($active_menu_item[1]== "manage_school_sub_staff"))) 
        {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if (($active_menu_item[0] == "main_school_admin") && 
            (($active_menu_item[1]== "manage_school_teachers")||($active_menu_item[1]== "manage_school_students")||($active_menu_item[1]== "manage_school_sub_staff"))) 
            { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($active_menu_item[1]== "manage_school_teachers") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_teachers']); ?>
        </li>
        <li class="<?php if ($active_menu_item[1]== "manage_school_students") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_students']); ?>
        </li>
        <li class="<?php if ($active_menu_item[1]== "manage_school_sub_staff") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_sub_staff']); ?>
        </li>
    </ul>
</li>

<!--Set up school entities-->
<li class="<?php if (($active_menu_item[0] == "main_school_admin") && 
            (($active_menu_item[1]== "manage_school_fees")||($active_menu_item[1]== "manage_school_subjects")||($active_menu_item[1]== "manage_school_exams")||($active_menu_item[1]== "manage_school_marksheet"))) 
            { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-th-list"></i>
        <span class="title">School Entities </span>
        <?php if (($active_menu_item[0] == "main_school_admin") && 
         (($active_menu_item[1]== "manage_school_fees")||($active_menu_item[1]== "manage_school_subjects")||($active_menu_item[1]== "manage_school_exams")||($active_menu_item[1]== "manage_school_marksheet"))) 
        {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if (($active_menu_item[0] == "main_school_admin") && 
            (($active_menu_item[1]== "manage_school_fees")||($active_menu_item[1]== "manage_school_subjects")||($active_menu_item[1]== "manage_school_exams")||($active_menu_item[1]== "manage_school_marksheet"))) 
            { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($active_menu_item[1]== "manage_school_fees") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_fees']); ?>
        </li>
        <li class="<?php if ($active_menu_item[1]== "manage_school_subjects") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_subjects']); ?>
        </li>
        <li class="<?php if ($active_menu_item[1]== "manage_school_exams") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_exams']); ?>
        </li>
        <li class="<?php if ($active_menu_item[1]== "manage_school_marksheet") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_marksheet']); ?>
        </li>
    </ul>
</li>

<!--Set up school communication-->
<li class="<?php if (($active_menu_item[0] == "main_school_admin") && 
            (($active_menu_item[1]== "manage_school_timetable")||($active_menu_item[1]== "manage_school_notice_board")||($active_menu_item[1]== "manage_school_calendar"))) 
            { echo "active";} ?>">
    <a href="javascript:;">
        <i class="fa fa-bullhorn"></i>
        <span class="title">School Communication </span>
        <?php if (($active_menu_item[0] == "main_school_admin") && 
         (($active_menu_item[1]== "manage_school_timetable")||($active_menu_item[1]== "manage_school_notice_board")||($active_menu_item[1]== "manage_school_calendar"))) 
        {?><span class="selected"></span><?php } ?>
        <span class="arrow <?php if (($active_menu_item[0] == "main_school_admin") && 
            (($active_menu_item[1]== "manage_school_timetable")||($active_menu_item[1]== "manage_school_notice_board")||($active_menu_item[1]== "manage_school_calendar"))) 
            { echo "open";} ?>"></span>
    </a>
    <ul class="sub-menu">
        <li class="<?php if ($active_menu_item[1]== "manage_school_timetable") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_timetable']); ?>
        </li>
        <li class="<?php if ($active_menu_item[1]== "manage_school_notice_board") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_notice_board']); ?>
        </li>
        <li class="<?php if ($active_menu_item[1]== "manage_school_calendar") { echo "active";} ?>">
            <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_calendar']); ?>
        </li>
    </ul>
</li>

<li class="<?php if ($active_menu_item[1]== "manage_school_affiliates") { echo "active";} ?>">
    <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_affiliates']); ?>
</li>

<li class="<?php if ($active_menu_item[1]== "manage_school_user_profile") { echo "active";} ?>">
    <?php Zf_GenerateLinks::zf_internal_link($main_menu['manage_user']); ?>
</li>
