
<?php if(Zf_SessionHandler::zf_getSessionVariable('account_sign_up') == 'need_to_confirm'){ ?>
    <div class="alert alert-info display-none error-fadeout">
        <button class="close" data-dismiss="alert"></button>
        You need to activate your account. Check your email for an activation link.
    </div>
<?php
}else if(Zf_SessionHandler::zf_getSessionVariable('account_sign_up') == 'confirmed_account'){
?>
    <div class="alert alert-success display-none success-fadeout">
        <button class="close" data-dismiss="alert"></button>
        Thank you for successfully confirming your school account. You can now login here.
    </div> 
<?php 
}
Zf_SessionHandler::zf_unsetSessionVariable("account_sign_up");
?>