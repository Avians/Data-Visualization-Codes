 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $editAgentTypes = "editAgencyTypes";
    
    $zippoSetupParameters = $identificationCode.ZVSS_CONNECT.$editAgentTypes;
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "ProcessAgencyInformation", $zippoSetupParameters); ?>" method="post" class="form-horizontal" >
    <h3 class="form-section form-title">Edit Agent Types</h3>    
    <div class="row">
        <div class="col-md-6" style="border-right: 1px solid #efefef; min-height: 100px !important; ">
            <div class="form-group">
                <label class="control-label col-md-4">Select Agent Type:</label>
                <div class="col-md-8">
                    <select class="form-control select2me agentTypesOptions" id="agentTypesOptions" name="agentTypeName" data-placeholder="Direct, Managed, Franchise, ..."  value="<?php echo $zf_formHandler->zf_getFormValue("userIdentificationCode"); ?>">
                        <?php
                            $zf_widgetFolder = "platform_admin"; $zf_widgetFile = "select_options.php"; $zf_externalWidgetData = "agentTypeForm";
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
    <div id="selectedAgentTypeForm"></div>
    
</form>
<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>

