<!--This is the start of the tabs-->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 zozo_tab_wrapper">
        <?php
        
            $zf_widgetFolder = "indicators";
            $zf_widgetFile = "class_setup_indicator.php";
            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
            
        ?> 
        <div id="tabbed-nav">
            <ul>
                <li><a></i>Class overview</a></li>
                <li><a><i class="fa fa-plus-square"></i> Add a class (Form)</a></li>
                <li><a><i class="fa fa-plus-square"></i> Add a stream</a></li>
            </ul>

            <div>
                <div> 
                    <?php
                    
                        //FETCH CLASS DATA
                        //$zf_controller->zf_targetModel->getSchoolClassesStreams($schoolSystemCode);
                        
                    ?>
                </div>
                <div>
                    <div class="tab-pane active">
                        <?php
                        
                            //LOAD CLASS SETUP FORM
                            //Zf_ApplicationWidgets::zf_load_widget("main_school_admin", "add_class_form.php");
                            
                        ?>
                    </div>
                </div>
                <div>
                    <div class="tab-pane active">
                        <?php
                        
                            //$zf_controller->zf_targetModel->confirmClassPresence($schoolSystemCode);
                            
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--This is the end of the tabs-->