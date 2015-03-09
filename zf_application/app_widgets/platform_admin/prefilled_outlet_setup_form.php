 <?php
    //Get the identfication code held in a session variable.
    $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
    
    $editOutletTypes = "editOutletTypes";
    
    $zippoSetupParameters = $identificationCode.ZVSS_CONNECT.$editOutletTypes;
?>
<form action="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "ProcessAgencyInformation", $zippoSetupParameters); ?>" method="post" class="form-horizontal" >
    <h3 class="form-section form-title">Edit Outlet Types</h3>    
    <div class="row">
        <div class="col-md-6" style="border-right: 1px solid #efefef; min-height: 100px !important; ">
            <div class="form-group">
                <label class="control-label col-md-4">Select Outlet Type:</label>
                <div class="col-md-8">
                    <select class="form-control select2me outletTypesOptions" id="outletTypesOptions" name="outletTypeName" data-placeholder="Stand alone, Shop-in-Shop, Sub-Franchise, ..."  value="<?php echo $zf_formHandler->zf_getFormValue("outletTypeName"); ?>">
                        <?php
                            $zf_widgetFolder = "platform_admin"; $zf_widgetFile = "select_options.php"; $zf_externalWidgetData = "outletTypeForm";
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
    <div id="selectedOutletTypeForm"></div>
    
</form>
<?php
    Zf_SessionHandler::zf_unsetSessionVariable("zf_valueArray");
    Zf_SessionHandler::zf_unsetSessionVariable("zf_errorArray");
?>

