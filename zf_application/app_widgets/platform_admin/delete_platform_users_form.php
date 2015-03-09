 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $editUsers = "deleteAdminUsers";
    
    $manageUsersParameters = $identificationCode.ZVSS_CONNECT.$editUsers;
?>
<form id="subjectUpdateForm" action="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "editAdminUsers", $manageUsersParameters); ?>" method="post" class="form-horizontal" >
    <h3 class="form-section form-title">Delete Zeepo User</h3>    
    <div class="row">
        <div class="col-md-6" style="border-right: 1px solid #efefef; min-height: 100px !important; ">
            <div class="form-group">
                <label class="control-label col-md-4">Select Zeepo User:</label>
                <div class="col-md-8">
                    <select class="form-control select2me deleteUserOptions" id="deleteUserOptions" name="identificationCode" data-placeholder="First name Second name"  value="<?php echo $zf_formHandler->zf_getFormValue("userIdentificationCode"); ?>">
                        <?php
                            $zf_widgetFolder = "platform_admin"; $zf_widgetFile = "select_options.php"; $zf_externalWidgetData = "deleteUserAdmins";
                            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile, $zf_externalWidgetData);
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->
    
    <!--Here we show the dynamically generated form-->
    <div id="deleteUserForm"></div>
    
</form>
<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>

