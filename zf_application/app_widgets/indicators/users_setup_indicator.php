
<?php if(Zf_SessionHandler::zf_getSessionVariable('users_setup') == 'users_setup_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some server-side form errors. Please check below.
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('users_setup') == 'users_setup_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully registered the users. The user can now log in.
    </div> 
<?php 
}else if(Zf_SessionHandler::zf_getSessionVariable('users_setup') == 'users_email_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        <b>Error!!</b> The email address entered is already in use by another Zeepo user.
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('users_setup') == 'users_id_error'){?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        <b>Error!!</b> The user id entered is already in use by another Zeepo user.
    </div>
<?php      
}else if(Zf_SessionHandler::zf_getSessionVariable('users_setup') == 'users_edit_success'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully updated user details.
    </div> 
<?php 
}else if(Zf_SessionHandler::zf_getSessionVariable('users_setup') == 'users_delete_success'){
?>
    <div class="alert alert-info display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully deleted the user.
    </div> 
<?php  
}
Zf_SessionHandler::zf_unsetSessionVariable("users_setup");
?>