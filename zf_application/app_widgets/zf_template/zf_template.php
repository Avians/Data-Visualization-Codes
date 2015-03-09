<div class="widget_wrapper">
    <b>This data is from within the widget</b><br><hr>
    <div class="data">
        <?php
        
            echo "Our External Data is: ".$zf_externalWidgetData."<br>";

            $zf_model_data->buildQueries($zf_externalWidgetData);

        ?>
    </div>
</div>
