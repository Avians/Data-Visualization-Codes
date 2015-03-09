<form action="<?php Zf_GenerateLinks::basic_internal_link('press_media', 'processSubscriptions'); ?>" method="post"  class="form-search">
    <div class="input-append">
        <input style="background:#ffffff;" class="m-wrap" type="email" name="email" value="<?php echo $zf_formHandler->zf_getFormValue("email"); ?>"><button class="btn theme-btn" type="submit">SUBSCRIBE</button>
    </div>
    <div class="clearfix"></div>
    <div class="form-error"><?php echo $zf_formHandler->zf_getFormError("email") ?></div>
</form>
<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");  
?>
