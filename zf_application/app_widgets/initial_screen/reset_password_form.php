<!-- BEGIN LOGIN FORM -->
<form class="login-form" action="<?php Zf_GenerateLinks::basic_internal_link("initialize", "processUserLogin", "reset_password"); ?>" method="post">
    <h3 class="form-title">Forgot your password?</h3>
    <p>
        Enter your e-mail address to reset your password.
    </p>
   <div class="form-group">
        <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email Address" name="email" value="<?php echo $zf_formHandler->zf_getFormValue("email"); ?>"/>
        </div>
       <div class="controls server-side-error">
            <?php echo $zf_formHandler->zf_getFormError("email") ?>
        </div>
   </div>
    
   <div class="form-actions">
        <a href="<?php Zf_GenerateLinks::basic_internal_link('initialize'); ?>" >
            <button type="button" id="back-btn" class="btn" style="color:#333333 !important;">
                <i class="m-icon-swapleft"></i> Back 
            </button>
        </a>
        <button type="submit" class="btn blue pull-right">
            Submit <i class="m-icon-swapright m-icon-white"></i>
        </button>
   </div>
    </div>
</form>
<!-- END LOGIN FORM -->