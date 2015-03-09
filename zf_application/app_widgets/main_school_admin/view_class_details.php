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
                <li><a><i class="fa fa-institution"></i>Class overview</a></li>
                <li><a><i class="fa fa-building-o"></i> Streams overview</a></li>
            </ul>

            <div>
                <div> 
                    <div>
                        <div class="row">
                            <div class="col-lg-6 col-md-9 col-sm-8 col-xs-12 margin-bottom-15">
                                <div class="school-content-wrapper">
                                    <h3>Class Name</h3>
                                    <hr>
                                    <div class="school-class-inner-content">
                                        Content goes here.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-9 col-sm-8 col-xs-12 margin-bottom-15">
                                <div class="school-content-wrapper">
                                    <h3>Class Name</h3>
                                    <hr>
                                    <div class="school-class-inner-content">
                                        Content goes here.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="tab-pane active">
                        <div class="row">
                            <div class="col-lg-6 col-md-9 col-sm-8 col-xs-12 margin-bottom-15">
                                <div class="school-content-wrapper">
                                    <h3>Student/Pupil Distribution</h3>
                                    <hr>
                                    <div class="school-class-inner-content">
                                        Graph comparing student distribution goes here.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-9 col-sm-8 col-xs-12 margin-bottom-15">
                                <div class="school-content-wrapper">
                                    <h3>Age Distribution</h3>
                                    <hr>
                                    <div class="school-class-inner-content">
                                        Graph comparing age distribution goes here
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-9 col-sm-8 col-xs-12 margin-bottom-15">
                                <div class="school-content-wrapper">
                                    <h3>Gender Ratio</h3>
                                    <hr>
                                    <div class="school-class-inner-content">
                                        Graph comparing gender ratio goes here
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-9 col-sm-8 col-xs-12 margin-bottom-15">
                                <div class="school-content-wrapper">
                                    <h3>Average Mean Score</h3>
                                    <hr>
                                    <div class="school-class-inner-content">
                                        Graph comparing streams mean score goes here
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-9 col-sm-8 col-xs-12 margin-bottom-15">
                                <div class="school-content-wrapper">
                                    <h3>Fee Payment</h3>
                                    <hr>
                                    <div class="school-class-inner-content">
                                        Graph comparing streams payments goes here
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--This is the end of the tabs-->