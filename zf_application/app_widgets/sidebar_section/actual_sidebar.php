
<?php
    
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    //Decode the session variable
    $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
    
    //echo "<code>".$identificationCode."</code><br><pre>";print_r($identifictionArray);echo "</pre>"; //Strictly for debugging purposes.
    
    
    //START OF THE MAIN DASHBOARD
    if($identifictionArray[3] == PLATFORM_SUPER_ADMIN || $identifictionArray[3] == ZIPPO_PLATFORM_ADMIN || $identifictionArray[3] == ZIPPO_OUTLET_STAFF || $identifictionArray[3] == ZIPPO_OUTLET_JUNIOR_STAFF){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "main_dashboard.php", $identificationCode);
        
    }
    //END OF THE MAIN DASHBOARD
    
    //START OF THE ZIPPO SETUP
    if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "manage_vendors.php", $identificationCode);
        
    }
    //END OF THE ZIPPO SETUP
    
    
    //START OF THE MANAGE OUTLETS MENU
    if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "manage_outlets.php", $identificationCode);
        
    }
    //END OF THE MANAGE OUTLETS MENU
    
    
    //START OF THE MANAGE TRANSACTIONS
    if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "manage_transactions_platform_admin.php", $identificationCode);
        
    }
    //END OF THE MANAGE TRANSACTIONS
    
    //START OF THE MANAGE FLOAT MENU
    if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "manage_floats.php", $identificationCode);
        
    }
    //END OF THE MANAGE FLOAT MENU
    
    
    if(($identifictionArray[3] == ZIPPO_OUTLET_STAFF) || ($identifictionArray[3] == ZIPPO_OUTLET_JUNIOR_STAFF)){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "manage_transactions_outlet_staff.php", $identificationCode);
        
    }
    //END OF THE MANAGE TRANSACTIONS
    
    
    //THIS IS THE MENU FOR ADDING OUTLET USERS.
    if($identifictionArray[3] == ZIPPO_OUTLET_STAFF){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "manage_outlet_users.php", $identificationCode);
        
    }
    
    //START OF THE MANAGE REPORTS MENU
    if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "manage_reports.php", $identificationCode);
        
    }
    //END OF THE MANAGE REPORTS MENU
    
    //START OF THE MANAGE USERS
    if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "manage_users.php", $identificationCode);
        
    }
    //END OF THE MANAGE USERS
    
    
    
    //START OF DEFAULT CONSTRUCTION PACKAGES FOR ANY SCHOOL
    if($identifictionArray[3] == SCHOOL_PRINCIPAL || $identifictionArray[3] == SCHOOL_MAIN_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "construction_menu.php", $identificationCode);
        
    }
    //END OF DEFAULT CONSTRUCTION PACKAGES FOR ANY SCHOOL
    
    
    //START OF SCHOOL ADMINISTRATIVE PACKAGES
    if($identifictionArray[3] == SCHOOL_PRINCIPAL || $identifictionArray[3] == SCHOOL_ADMIN){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "administration_menu.php", $identificationCode);
        
    }
    //END SCHOOL ADMINISTRATIVE PACKAGES
    
    
    //START OF SCHOOL STUDENTS PACKAGES
    if($identifictionArray[3] == SCHOOL_STUDENT){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "students_menu.php", $identificationCode);
        
    }
    //END SCHOOL STUDENTS PACKAGES
    
    
    //START OF SCHOOL PARENTS PACKAGES
    if($identifictionArray[3] == SCHOOL_PARENT){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "parents_menu.php", $identificationCode);
        
    }
    //END OF SCHOOL PARENTS PACKAGES
    
    
    //START OF SCHOOL ALUMNI PACKAGES
    if($identifictionArray[3] == SCHOOL_ALUMNI){
        
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "alumni_menu.php", $identificationCode);
        
    }
    //END OF SCHOOL ALUMNI PACKAGES
    
    
    //START OF SCHOOL GENERAL PACKAGES
    if($identifictionArray[3] != SCHOOL_MAIN_ADMIN && $identifictionArray[3] != BANNED_USER && $identifictionArray[3] != GUEST_USER){
    
        Zf_ApplicationWidgets::zf_load_widget("sidebar_section", "general_menu.php", $identificationCode);
        
    }
    //END OF SCHOOL GENERAL PACKAGES
      
?>