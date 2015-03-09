
<?php if(Zf_SessionHandler::zf_getSessionVariable('student_forms_setup') == 'student_forms_error'){ ?>
    <div class="alert alert-danger display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have some errors either creating or updating students registration forms. Check in <strong>"Manage students admission forms"</strong> section and rectify the errors!!
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('student_forms_setup') == 'student_forms_inserted'){ 
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You have successfully created students registration forms.
    </div>
<?php  
}else if(Zf_SessionHandler::zf_getSessionVariable('student_forms_setup') == 'student_forms_updated'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You successfully updated students registration forms.
    </div> 
<?php
} 
Zf_SessionHandler::zf_unsetSessionVariable("student_forms_setup");
?>