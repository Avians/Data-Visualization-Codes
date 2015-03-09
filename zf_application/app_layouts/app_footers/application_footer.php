        </div>
        <!-- END CONTAINER -->
        
        
        <?php
        
        if(empty($activeURL[0]) || ($activeURL[0] == "initialize" && empty($activeURL[1])) || ($activeURL[0] == "initialize" && $activeURL[1] == "login" || $activeURL[0] == "initialize" && $activeURL[1] == "reset_password")){
            
            //BEGIN LOGIN FOOTER
            $zf_widgetFolder = "initial_screen"; $zf_widgetFile = "form_footer.php";
            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
            //BEGIN LOGIN FOOTER
            
        }else{
            
            //BEGIN DASHBOARD FOOTER 
            $zf_widgetFolder = "footer_section"; $zf_widgetFile = "dashboard_footer.php";
            Zf_ApplicationWidgets::zf_load_widget($zf_widgetFolder, $zf_widgetFile);
            //END DASHBOARD FOOTER 
            
        }
 
            
        ?>
        
        <!--This is the javascript that dictates the zozo tabs-->
        <script type="text/javascript">
            $(document).ready(function() { 
                /* default activation and setting options for all the tabs*/
                 var tabbedNav = $("#tabbed-nav").zozoTabs({
                     position: "top-left",
                     theme: "silver",
                     rounded: true,
                     shadows: true,
                     size: "small",
                     animation: {
                         duration: 600,
                         easing: "easeOutQuint",
                         effects: "none"
                     },
                     defaultTab: "tab1"
                 });

            });
        </script>
        
    </body>
</html>
