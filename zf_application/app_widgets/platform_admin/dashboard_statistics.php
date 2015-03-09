<?php
    //Here we generate the actual application menu.

    $identificationCode = "Athias";

?>
<div class="row">
    
    <!--Manage Float-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "manage_float")?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-money fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Float
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage Outlets-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "manage_outlets", "outlets_directory")?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-th-large fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Outlets
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage Banks/Telcos/MTS/Merchants-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "manage_drugs")?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-bank fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Money Banks
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage Transactions-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "manage_transactions", "all_transactions")?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-exchange fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Transactions
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--Manage Reports-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "manage_reports")?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-file-text-o fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Reports
                    </div>
                </div>
            </div>
        </div>
    </a>
    
    <!--User Profile-->
    <a href="<?php Zf_GenerateLinks::basic_internal_link("platform_admin", "user_profile")?>">
        <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
            <div class="dashboard-button-wrapper">
                <div class="fa-dashboard-icons">
                    <i class="fa fa-users fa-font-details"></i>
                </div>
                <div class="dashboard-details">
                    <div class="actual-detail-content">
                        Manage Users
                    </div>
                </div>
            </div>
        </div>
    </a>
    
</div>