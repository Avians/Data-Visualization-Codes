<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ZVSS PLATFORM ADMIN CONTROLLER, ESSENTIAL FOR ROUTING AND 
 * EXECUTING ALL ACTIONS THAT RELATE TO ZVSS PLATFORM ADMIN MODELS AND VIEWS.
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  14th/August/2013  Time: 11:00 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013 (sunday)
 * 
 */

class Platform_adminController extends Zf_Controller {
   
    
    public $zf_defaultAction = "index";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
        if(Zf_SessionHandler::zf_getSessionVariable("LoggedIn") != true){
            
            Zf_GenerateLinks::zf_header_location('initialize', 'login');
            exit();
            
        }
        
    }

    
    /**
     * This is the index action for the controller
     */
    public function actionIndex(){
        
        Zf_View::zf_displayView('index');
        
    }
    
    /**
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     + ZIPPO SETUP SECTION
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     */
    /**
     * This is the zippo setup action for the controller
     */
    public function actionZippo_setup($action_filter){
        
        $action_filter = Zf_SecureData::zf_decode_url($action_filter);
        
        //echo $action_filter; exit();
        
        
        if($action_filter == "vendor_setup"){
            
            $this->actionVendor_setup(); exit();
            
        }else if($action_filter == "agent_setup"){
            
            $this->actionAgent_setup(); exit();
            
        }else if($action_filter == "outlet_setup"){
            
            $this->actionOutlet_setup(); exit();
            
        }else if($action_filter == "commission_setup"){
            
            $this->actionCommission_setup(); exit();
            
        } 
        
    }
    
    
    /**
     * This is the action for setting up a vendor
     */
    public function actionVendor_setup() {
        
        Zf_View::zf_displayView('vendor_setup'); exit();
        
    }
    
    
    /**
     * This is the action for setting up an agent
     */
    public function actionAgent_setup() {
        
        Zf_View::zf_displayView('agent_setup'); exit();
        
    }
    
    
    /**
     * This is the action for setting up an outlet
     */
    public function actionOutlet_setup() {
        
        Zf_View::zf_displayView('outlet_setup'); exit();
        
    }
    
    
    /**
     * This is the action for setting up commissions
     */
    public function actionCommission_setup() {
        
        Zf_View::zf_displayView('commission_setup'); exit();
        
    }
    
    
    
    /**
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     + MANAGE OUTLETS SECTION
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     */
    /**
     * This is the ManageTransactions action for the controller
     */
    public function actionManage_outlets($action_filter){
        
        $action_filter = Zf_SecureData::zf_decode_url($action_filter);
        
        
        if($action_filter == "new_outlet"){
            
            $this->actionNew_outlet(); exit();
            
        }else if($action_filter == "outlets_directory"){
            
            $this->actionOutlets_directory(); exit();
            
        }else if($action_filter == "active_outlets"){
            
            $this->actionActive_outlets(); exit();
            
        }else if($action_filter == "suspended_outlets"){
            
            $this->actionSuspended_outlets(); exit();
            
        }
        else if($action_filter == "outlets_report"){
            
            $this->actionOutlets_report(); exit();
            
        }
        
    }
    
    
    /**
     * This is the new outlets action for the controller
     */
    public function actionNew_outlet(){
        
        Zf_View::zf_displayView('new_outlet');
        
    }
    
    
    /**
     * This is the outlet directory action for the controller
     */
    public function actionOutlets_directory(){
        
        $tableData = array();
        
        $tableData['tableTitle'] = "List of All Outlets";
        
        $tableData['tableQuery'] = "SELECT * FROM zvss_outlet_details"; 
        
        $zf_phpGridSettings = $this->actionGenerateOutletsTable($tableData);
        
        Zf_View::zf_displayView('outlets_directory', '', $zf_phpGridSettings);
        
    }
    
    
    /**
     * This is the active outlets action for the controller
     */
    public function actionActive_outlets(){
        
        $tableData = array();
        
        $tableData['tableTitle'] = "List of Active Outlets";
        
        $tableData['tableQuery'] = "SELECT * FROM zvss_outlet_details WHERE outletStatus ='1' "; 
        
        $zf_phpGridSettings = $this->actionGenerateOutletsTable($tableData);
        
        Zf_View::zf_displayView('active_outlets', '', $zf_phpGridSettings);
        
    }
    
    
    /**
     * This is the suspended outlets action for the controller
     */
    public function actionSuspended_outlets(){
        
        $tableData = array();
        
        $tableData['tableTitle'] = "List of Suspended Outlets";
        
        $tableData['tableQuery'] = "SELECT * FROM zvss_outlet_details WHERE outletStatus ='0' "; 
        
        $zf_phpGridSettings = $this->actionGenerateOutletsTable($tableData);
        
        Zf_View::zf_displayView('suspended_outlets', '', $zf_phpGridSettings);
        
    }
    
    
    /**
     * This is the outlets reports action for the controller
     */
    public function actionOutlets_report(){
        
        Zf_View::zf_displayView('outlets_report');
        
    }
    
    
    
    /**
     * This is the outlet setup action for the controller
     */
    public function actionOutletSetup($identificationCode){
       
        //Decode the url parameter
        $identificationCode = Zf_SecureData::zf_decode_url($identificationCode);
        
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        
        if($identificationCode === Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
            
            $this->zf_targetModel->registerNewOutlet(); exit();
            
        }else{
            
            Zf_GenerateLinks::zf_header_location("initialize", "logout");
            
        }
         
    }

    
    
    
    /**
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     + MANAGE TRANSACTIONS SECTION
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     */
    /**
     * This is the ManageTransactions action for the controller
     */
    public function actionManage_transactions($action_filter){
        
        $action_filter = Zf_SecureData::zf_decode_url($action_filter);
        
        if($action_filter == "new_transactions"){
            
            $this->actionNew_transactions(); exit();
            
        }else if($action_filter == "inbound_transactions"){
            
            $this->actionInbound_transactions(); exit();
            
        }else if($action_filter == "outbound_transactions"){
            
            $this->actionOutbound_transactions(); exit();
            
        }else if($action_filter == "all_transactions"){
            
            $this->actionAll_transactions(); exit();
            
        }else if($action_filter == "transactions_report"){
            
            $this->actionTransactions_report(); exit();
        
        }else if($action_filter == "transactions_trial"){
            
            $this->actionTransactions_trial(); exit();
            
        }
        
    }
    
    /**
     * This is the new transactions action for the controller
     */
    public function actionNew_transactions(){
        
        $dateFormat = 'Y-m-d';
        $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today);
        
        $tableData = array();
        
        $tableData['tableTitle'] = "List of All Transaction";
        
        $tableData['tableQuery'] = "SELECT * FROM zvss_new_transaction WHERE transactionDate = '$dateToday' "; 
        
        $zf_phpGridSettings = $this->actionGenerateTransactionsTable($tableData, '', 1);
        
        Zf_View::zf_displayView('new_transactions','', $zf_phpGridSettings);
        
    }
    
    
    /**
     * This is the new transactions action for the controller
     */
    public function actionTransactions_trial(){
        
        Zf_View::zf_displayView('transactions_trial');
        
    }
    
  
    /**
     * This is the inbound transactions action for the controller
     */
    public function actionInbound_transactions(){
        
        $tableData = array();
        
        $tableData['tableTitle'] = "List of Deposit Transaction";
        
        $tableData['tableQuery'] = "SELECT * FROM zvss_new_transaction WHERE transactionType = 'Deposit' "; 
        
        $zf_phpGridSettings = $this->actionGenerateTransactionsTable($tableData);
        
        Zf_View::zf_displayView('inbound_transactions','', $zf_phpGridSettings);
        
    }
    
    
    /**
     * This is the outbound transactions action for the controller
     */
    public function actionOutbound_transactions(){
        
        $tableData = array();
        
        $tableData['tableTitle'] = "List of Withdrawal Transactions";
        
        $tableData['tableQuery'] = "SELECT * FROM zvss_new_transaction WHERE transactionType = 'Withdrawal' "; 
        
        $zf_phpGridSettings = $this->actionGenerateTransactionsTable($tableData);
        
        Zf_View::zf_displayView('outbound_transactions','', $zf_phpGridSettings);
        
    }
    
    /**
     * This is the all transactions action for the controller
     */
    public function actionAll_transactions(){
        
        $tableData = array();
        
        $tableData['tableTitle'] = "List of All Transaction";
        
        $tableData['tableQuery'] = "SELECT * FROM zvss_new_transaction "; 
        
        $zf_phpGridSettings = $this->actionGenerateTransactionsTable($tableData);
        
        Zf_View::zf_displayView('all_transactions','', $zf_phpGridSettings);
        
    }

    
    /**
     * This is the action for processing a new transaction for the controller
     */
    public function actionMakeNewTransaction($identificationCode){
       
        //Decode the url parameter
        $identificationCode = Zf_SecureData::zf_decode_url($identificationCode);
        
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        
        if($identificationCode === Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
            
            $this->zf_targetModel->makeNewTransaction(); exit();
            
        }else{
            
            Zf_GenerateLinks::zf_header_location("initialize", "logout");
            
        }
         
    }

    
    /**
     * This is the action for processing a new transaction for the controller
     */
    public function actionTransactionTrial($identificationCode){
       
        //Decode the url parameter
        $identificationCode = Zf_SecureData::zf_decode_url($identificationCode);
        
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
            
        $this->zf_targetModel->transactionTrial(); exit();
        
         
    }

    
    /**
     * This is the action for editing transaction for the controller
     */
    public function actionEditTransaction($identificationCode){
       
        //Decode the url parameter
        $identificationCode = Zf_SecureData::zf_decode_url($identificationCode);
        
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        
        if($identificationCode === Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
            
            $this->zf_targetModel->editTransaction(); exit();
            
        }else{
            
            Zf_GenerateLinks::zf_header_location("initialize", "logout");
            
        }
         
    }
    
    
    /**
     * This is the action for processing a new transaction for the controller
     */
    public function actionMakeNewCommission($identificationCode){
       
        //Decode the url parameter
        $identificationCode = Zf_SecureData::zf_decode_url($identificationCode);
        
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        
        if($identificationCode === Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
            
            $this->zf_targetModel->makeNewCommission(); exit();
            
        }else{
            
            Zf_GenerateLinks::zf_header_location("initialize", "logout");
            
        }
         
    }
    
    
    /**
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     + MANAGE TRANSACTIONS SECTION
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     */
    /**
     * This is the ManageTransactions action for the controller
     */
    public function actionManage_users($action_filter){
        
        $action_filter = Zf_SecureData::zf_decode_url($action_filter);
        
        if($action_filter == "new_users"){
            
            $this->actionNew_user(); exit();
            
        }else if($action_filter == "platform_users"){
            
            $this->actionPlatform_users(); exit();
            
        }
        
    }
    
    /**
     * This is the new transactions action for the controller
     */
    public function actionNew_user(){
        
        Zf_View::zf_displayView('new_user');
        
    }
    
    /**
     * This is the new transactions action for the controller
     */
    public function actionPlatform_users(){
        
        $tableData = array();
        
        $tableData['tableTitle'] = "List of Zeepo Admin Users";
        
        $tableData['tableQuery'] = "SELECT * FROM zvss_platform_main_admins "; 
        
        $zf_phpGridSettings = $this->actionGenerateUsersTable($tableData);
        
        Zf_View::zf_displayView('platform_users','', $zf_phpGridSettings);
        
    }
    
    
    
    /**
     * This is the user setup action for the controller
     */
    public function actionUserSetup($identificationCode){
       
        //Decode the url parameter
        $identificationCode = Zf_SecureData::zf_decode_url($identificationCode);
        
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        
        
        if($identificationCode === Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
            
            $this->zf_targetModel->registerNewUser(); exit();
            
        }else{
            
            Zf_GenerateLinks::zf_header_location("initialize", "logout");
            
        }
         
    }
    
    /**
     * This is the user setup action for the controller
     */
    public function actionEditAdminUsers($parameterData){
        
        //explode the parameterData incase it has any data concatinated with it.
        $filteredData = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_url($parameterData));
        
        if($filteredData[0] === Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
            
            if($filteredData[1] == "editAdminUsers"){
            
                $this->zf_targetModel->editAdministrationUser("editAdminUsers"); exit();

            }else if($filteredData[1] == "deleteAdminUsers"){
            
                $this->zf_targetModel->editAdministrationUser("deleteAdminUsers"); exit();

            }
            
        }else{
            
            Zf_GenerateLinks::zf_header_location("initialize", "logout");
            
        }
       
        
         
    }
    
  
    
    /**
     * This is the action that generates the transaction table
     */
    public function actionGenerateTransactionsTable($tableData, $zf_subGrid = NULL, $exclude = NULL){
        
        //This holds the name of the database table that is being accessed.
        $zf_phpGridSettings['zf_tableName'] = 'zvss_new_transaction'; 
        
        //This is the title of the table as it will appear on the user view
        $tableTitle = $tableData['tableTitle'];
        
        //This holds all the grid setting e.g. title, width, height e.t.c
        $zf_phpGridSettings['zf_gridSettings'] = zf_phpGridConfigurations::Zf_PhpGridSettings($tableTitle, $zf_subGrid);

        //This holds all the grid actions e.g exporting data, editing data e.t.c
        $zf_phpGridSettings['zf_gridActions'] = zf_phpGridConfigurations::Zf_PhpGridActions();

        //This array holds all the data related to required grid columns
        $zf_gridColumns = array();

        $transactionOutlet = array("title"=>"Transaction Outlet", "name"=>"outletCode", "width"=>25, "editable"=>false); 
        $zf_gridColumns[] = $transactionOutlet;
        
        $transactionFirstName = array("title"=>"First Name", "name"=>"transactionFirstName", "width"=>20, "editable"=>true);
        $zf_gridColumns[] = $transactionFirstName;
        
        $transactionLastName = array("title"=>"Last Name", "name"=>"transactionLastName", "width"=>20, "editable"=>true);
        $zf_gridColumns[] = $transactionLastName;
        
//        $transactionIdNo = array("title"=>"ID/PP Number", "name"=>"transactionIdNumber", "width"=>20, "editable"=>true);
//        $zf_gridColumns[] = $transactionIdNo;
        
        $transactionMobile = array("title"=>"Mobile Number", "name"=>"transactionMobileNumber", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $transactionMobile;
        
        $transactionAmount = array("title"=>"Amount", "name"=>"transactionAmount", "width"=>15, "editable"=>true);
        $zf_gridColumns[] = $transactionAmount;
        
        $transactionCommission = array("title"=>"Commission", "name"=>"transactionCommission", "width"=>15, "editable"=>true);
        $zf_gridColumns[] = $transactionCommission;
        
        $transactionCode = array("title"=>"Transaction Code", "name"=>"transactionReference", "width"=>25, "editable"=>false); 
        $zf_gridColumns[] = $transactionCode;
        
        $transactionEntity = array("title"=>"Transacting Vendor", "name"=>"transactingEntity", "width"=>25, "editable"=>true);
        $zf_gridColumns[] = $transactionEntity;
        
        $transactionType = array("title"=>"Transaction Type", "name"=>"transactionType", "width"=>25, "editable"=>true);
        $zf_gridColumns[] = $transactionType;
        
        if($exclude != 1){
            $transactionDate = array("title"=>"Trans. Date", "name"=>"transactionDate", "width"=>15, "editable"=>true);
            $zf_gridColumns[] = $transactionDate;
        }
        
        //This action column of the table 
        $action = array("title"=>"Actions", "name"=>"act", "align"=>"center", "width"=>20, "export"=>false, "hidden"=>true);
        $zf_gridColumns[] = $action;

        $zf_phpGridSettings['zf_gridColumns'] = $zf_gridColumns;
        
        //echo $tableQuery; exit();

        $zf_phpGridSettings['zf_gridQuery'] = $tableData['tableQuery'];
        
        return $zf_phpGridSettings;
        
    }
    
  
    
    /**
     * This is the action that generates the transaction table
     */
    public function actionGenerateOutletsTable($tableData, $zf_subGrid = NULL){
        
        //This holds the name of the database table that is being accessed.
        $zf_phpGridSettings['zf_tableName'] = 'zvss_outlet_details'; 
        
        //This is the title of the table as it will appear on the user view
        $tableTitle = $tableData['tableTitle'];
        
        //This holds all the grid setting e.g. title, width, height e.t.c
        $zf_phpGridSettings['zf_gridSettings'] = zf_phpGridConfigurations::Zf_PhpGridSettings($tableTitle, $zf_subGrid);

        //This holds all the grid actions e.g exporting data, editing data e.t.c
        $zf_phpGridSettings['zf_gridActions'] = zf_phpGridConfigurations::Zf_PhpGridActions();

        //This array holds all the data related to required grid columns
        $zf_gridColumns = array();

        $outletName = array("title"=>"Outlet Area", "name"=>"outletArea", "width"=>25, "editable"=>false); 
        $zf_gridColumns[] = $outletName;
        
        $outletRegion = array("title"=>"Outlet Location", "name"=>"outletLocation", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $outletRegion;
        
        $outletEmail= array("title"=>"Outlet Email", "name"=>"outletEmail", "width"=>20, "editable"=>true);
        $zf_gridColumns[] = $outletEmail;
        
        $outletPhoneNumber = array("title"=>"Outlet Phone Number", "name"=>"outletMobileNumber", "width"=>20, "editable"=>true);
        $zf_gridColumns[] = $outletPhoneNumber;
        
        $dateOfRegistration = array("title"=>"Date of Registration", "name"=>"dateOfRegistration", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $dateOfRegistration;
        
        $outletStatus = array("title"=>"Outlet Status", "name"=>"outletStatus", "width"=>20, "editable"=>true);
        $zf_gridColumns[] = $outletStatus;
        
        //This action column of the table 
        $action = array("title"=>"Actions", "name"=>"act", "align"=>"center", "width"=>20, "export"=>false, "hidden"=>false);
        $zf_gridColumns[] = $action;

        $zf_phpGridSettings['zf_gridColumns'] = $zf_gridColumns;
        
        //echo $tableQuery; exit();

        $zf_phpGridSettings['zf_gridQuery'] = $tableData['tableQuery'];
        
        return $zf_phpGridSettings;
        
    }
    
    
    
    
    /**
     * This is the action that generates the transaction table
     */
    public function actionGenerateUsersTable($tableData, $zf_subGrid = NULL, $exclude = NULL){
        
        //This holds the name of the database table that is being accessed.
        $zf_phpGridSettings['zf_tableName'] = 'zvss_platform_main_admins'; 
        
        //This is the title of the table as it will appear on the user view
        $tableTitle = $tableData['tableTitle'];
        
        //This holds all the grid setting e.g. title, width, height e.t.c
        $zf_phpGridSettings['zf_gridSettings'] = zf_phpGridConfigurations::Zf_PhpGridSettings($tableTitle, $zf_subGrid);

        //This holds all the grid actions e.g exporting data, editing data e.t.c
        $zf_phpGridSettings['zf_gridActions'] = zf_phpGridConfigurations::Zf_PhpGridActions();

        //This array holds all the data related to required grid columns
        $zf_gridColumns = array();

        $adminDesignation = array("title"=>"Designation", "name"=>"adminDesignation", "width"=>10, "editable"=>false); 
        $zf_gridColumns[] = $adminDesignation;
        
        $adminIdNo = array("title"=>"ID Number", "name"=>"adminId", "width"=>20, "editable"=>true);
        $zf_gridColumns[] = $adminIdNo;
        
        $adminFirstName = array("title"=>"First Name", "name"=>"adminFirstName", "width"=>20, "editable"=>true);
        $zf_gridColumns[] = $adminFirstName;
        
        $adminLastName = array("title"=>"Last Name", "name"=>"adminLastName", "width"=>20, "editable"=>true);
        $zf_gridColumns[] = $adminLastName;
        
        $adminMobileNumber = array("title"=>"Mobile Number", "name"=>"adminMobileNumber", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $adminMobileNumber;
        
        $adminAddress = array("title"=>"Address", "name"=>"adminAddress", "width"=>15, "editable"=>true);
        $zf_gridColumns[] = $adminAddress;
       
        
        //This action column of the table 
        $action = array("title"=>"Actions", "name"=>"act", "align"=>"center", "width"=>20, "export"=>false, "hidden"=>true);
        $zf_gridColumns[] = $action;

        $zf_phpGridSettings['zf_gridColumns'] = $zf_gridColumns;
        
        //echo $tableQuery; exit();

        $zf_phpGridSettings['zf_gridQuery'] = $tableData['tableQuery'];
        
        return $zf_phpGridSettings;
        
    }
    
    
    
    /**
     * This is the action for processing all agency information for the controller
     */
    public function actionProcessAgencyInformation($dataFilter){
        
        //explode the dataFilter incase it has any data concatinated with it.
        $filteredData = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_url($dataFilter));
        
        //print_r($filteredData); exit();
        
        $identificationCode = $filteredData[0]; //This is the unique identification code
        $filterAction = @$filteredData[1];//This is any other intended action
        $agencyTypeCode = @$filteredData[2];//This is the class code
       
        
        if($filterAction == "addNewAgencyType"){
            
            $this->zf_targetModel->processAddNewAgencyType($identificationCode); exit();//Actually a partner, here refered to us agency
            
        }else if($filterAction == "addAgencyTypeEntity"){
            
            $this->zf_targetModel->processAddNewAgencyEntity($identificationCode); exit();
            
        }else if($filterAction == "addNewAgentType"){
            
            $this->zf_targetModel->processAddNewAgentType($identificationCode); exit();//This is the actual agent types.
            
        }else if($filterAction == "addNewOutletType"){
            
            $this->zf_targetModel->processAddNewOutletType($identificationCode); exit();
            
        }else if($filterAction == "editAgencyTypes"){
            
            $this->zf_targetModel->processEditAgencyType($identificationCode); exit();
            
        }else if($filterAction == "editOutletTypes"){
            
            $this->zf_targetModel->processEditOutletType($identificationCode); exit();
            
        }
        
        
        
    }
    
    
    /**
     * This is the action for processing oulet locality information for the controller
     */
    public function actionProcessOutletInformation($dataFilter){
        
        $dataFilter = Zf_SecureData::zf_decode_data($dataFilter);
        
        if($dataFilter == "outletLocality"){
            
            $this->zf_targetModel->zvss_getOutletLocality();
            
        }else if($dataFilter == "outletCode"){
            
            $this->zf_targetModel->zvss_getOutletCode(); exit();
            
        }else if($dataFilter == "transactionReference"){
            
            $this->zf_targetModel->zvss_editTransactionForm(); exit();
            
        }else if($dataFilter == "findAgencyEntities" ){
            
            $this->zf_targetModel->zvss_getAgencyEntities(); exit();
            
        }else if($dataFilter == "trialTransaction" ){
            
            $this->zf_targetModel->zvss_editTrialTransactions(); exit();
            
        }
        
    }
    
    
    /**
     * This is the action for processing user information in readiness for editing
     */
    public function actionProcessUsersAndAgencyInformation($dataFilter){
        
        $dataFilter = Zf_SecureData::zf_decode_data($dataFilter);
        
        //echo $dataFilter; exit();
        
        if($dataFilter == "edit_admin_users"){
            
            $this->zf_targetModel->zvss_getAdminUserInformation("edit_admin_users");
            
        } 
        if($dataFilter == "delete_admin_users"){
            
            $this->zf_targetModel->zvss_getAdminUserInformation("delete_admin_users");
            
        } 
        if($dataFilter == "getAgentTypeForm"){
            
            $this->zf_targetModel->zvss_getAgentTypeInformation("delete_admin_users");
            
        }
        if($dataFilter == "getOutletTypeForm"){
            
            $this->zf_targetModel->zvss_getOutletTypeInformation("delete_admin_users");
            
        } 
        
    }
    
    
    /**
     * This is the action for processing oulet locality information for the controller
     */
    public function actionUpdateTrialTransaction(){
        
        $this->zf_targetModel->zvss_updateTrialTransaction(); exit();
        
    }
    
    
    /**
     * This is the action for processing oulet locality information for the controller
     */
    public function actionProcessCustomerInformation(){
  
        $this->zf_targetModel->zvss_processCustomerDetails(); exit();
        
    }
    
    /**
     * This is the action for processing oulet locality information for the controller
     */
    public function actionMainDashboardStatistics($dataFilter){
        
        $dataFilter = Zf_SecureData::zf_decode_data($dataFilter);
        
        if($dataFilter == "countOutlets"){
            
            $this->zf_targetModel->getNumberOfOutlets(); exit();
            
        }else if($dataFilter == "countTransactions"){
            
            $this->zf_targetModel->getNumberOfTransactions(); exit();
            
        }else if($dataFilter == "totalAmount"){
            
            $this->zf_targetModel->getTotalAmount(); exit();
            
        }else if($dataFilter == "allBoundTransactions"){
            
            $this->zf_targetModel->AllBoundTransactionsLine(); exit();
            
        }
        else if($dataFilter == "totalDeposits"){
            
            $this->zf_targetModel->getTotalDeposits(); exit();
            
        }else if($dataFilter == "totalWithdrawals"){
            
            $this->zf_targetModel->getTotalWithdrawals(); exit();
            
        }else if($dataFilter == "totalInboundTransfer"){
            
            $this->zf_targetModel->getTotalInboundTransfer(); exit();
            
        }else if($dataFilter == "totalOutboundTransfer"){
            
            $this->zf_targetModel->getTotalOutboundTransfer(); exit();
            
        }
        
    }
    
    /**
     * This is the action for processing oulet locality information for the controller
     */
    public function actionFilteredDashboardStatistics($dataFilter){
        
        $dataFilter = Zf_SecureData::zf_decode_data($dataFilter);
        
        if($dataFilter == "amountTransacted"){
            
            $this->zf_targetModel->getTotalAmount(); exit();
            
        }else if($dataFilter == "transactionCount"){
            
            $this->zf_targetModel->getNumberOfTransactions(); exit();
            
        }else if($dataFilter == "totalCommissions"){
            
            $this->zf_targetModel->getTotalCommissions(); exit();
            
        }else if($dataFilter == "totalAmountcountOutlets"){
            
            $this->zf_targetModel->getNumberOfOutlets(); exit();
            
        }else if($dataFilter == "allBoundTransactions"){
            
            $this->zf_targetModel->AllBoundTransactionsLine(); exit();
            
        }
        else if($dataFilter == "totalDeposits"){
            
            $this->zf_targetModel->getTotalDeposits(); exit();
            
        }else if($dataFilter == "totalWithdrawals"){
            
            $this->zf_targetModel->getTotalWithdrawals(); exit();
            
        }else if($dataFilter == "getDepositsCommissions"){
            
            $this->zf_targetModel->getDepositsCommissions(); exit();
            
        }else if($dataFilter == "getWithdrawalsCommissions"){
            
            $this->zf_targetModel->getWithdrawalsCommissions(); exit();
         
        }else if($dataFilter == "transactionBlueBoxes"){
            
            $this->zf_targetModel->getTotalPartnersTransactions("tabs"); exit();
         
        }else if($dataFilter == "vendorMoneyVariations"){
            
            $this->zf_targetModel->AllPartnersTransactionsLineToday("partnersTabChart"); exit();
            
        }else if($dataFilter == "overallVendorSummary"){
            
            $this->zf_targetModel->getPartnershipSummary(); exit();
        
        }else if($dataFilter == "outletTransactionSummary"){
            
            $this->zf_targetModel->getAllOutletSummaryTransactions(); exit();
        
        }else if($dataFilter == "outletVendorSummary"){
            
            $this->zf_targetModel->getAllOutletSummaryPartners(); exit();
            
        }else if($dataFilter == "outletTransactions"){
            
            $this->zf_targetModel->getOutletTransactions(); exit();
            
        }else if($dataFilter == "allPartnersTransactionsPie"){
            
            $this->zf_targetModel->AllPartnersTransactionsPie($userid); exit();
            
        }else if($dataFilter == "allPartnersTransactionsLine"){
            
            $this->zf_targetModel->AllPartnersTransactionsLine("partnersLowerChart"); exit();
            
        }
        
    }
    
    
    /**
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  This function works out and return the actual transaction dates                   |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    private function zf_getDates($awayDays = NULL){
        
        $zf_date_parameters = array(

            "original_date" => Zf_Core_Functions::Zf_CurrentDate(), //today
            //"date_mask" => "Y-m-d", //date mask should take the exact same format as the original date.
            "date_mask" => "d-m-Y", //date mask should take the exact same format as the original date.
            "date_action" => array(

                "what" => "d", //Accepted paramters are: years=>years, mos=>months, m=>months, weeks=>weeks, days=>days, d=>days, hrs.=>hours, h=>hours, min=>minutes, sec=>seconds
                "howMuch" => $awayDays //This is the number of days

            )

        );
        
        return $zf_date_parameters;
        
        
    }
    
    

}
?>
