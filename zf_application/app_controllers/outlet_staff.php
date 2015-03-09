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

class Outlet_staffController extends Zf_Controller {
   
    
    public $zf_defaultAction = "index";
    
    //This is a variable that holds the user id.
    protected $userid;



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
        if(Zf_SessionHandler::zf_getSessionVariable("LoggedIn") != true){
            
            Zf_GenerateLinks::zf_header_location('initialize', 'login');
            exit();
            
        }
        
        
        $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode(Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode"));
        
        $this->userid = $identifictionArray[2].ZVSS_CONNECT.$identifictionArray[4];
        
        //echo $this->userid; exit();
        
    }

    
    /**
     * This is the index action for the controller
     */
    public function actionIndex(){
        
        Zf_View::zf_displayView('index');
        
    }
    
    /**
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     + MANAGE OUTLETS STAFF SECTION
     ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
     */
    /**
     * This is the ManageTransactions action for the controller
     */
    public function actionManage_users($action_filter){
        
        $action_filter = Zf_SecureData::zf_decode_url($action_filter);
        
        
        if($action_filter == "new_users"){
            
            $this->actionNew_users(); exit();
            
        }else if($action_filter == "outlet_users"){
            
            $this->actionOutlet_users(); exit();
          
        }else if($action_filter == "users_report"){
            
            $this->actionUsers_report(); exit();
            
        }
        
    }
    
    
    /**
     * This is the new outlets action for the controller
     */
    public function actionNew_users(){
        
        Zf_View::zf_displayView('new_outlet_staff');
        
    }
    
    
    /**
     * This is the outlet users action for the controller
     */
    public function actionOutlet_users(){
        
        Zf_View::zf_displayView('outlet_users');
        
    }
    
    
    /**
     * This is the users report action for the controller
     */
    public function actionUsers_report(){
        
        Zf_View::zf_displayView('users_report');
        
    }
    
    
    /**
     * THIS SECTION HANDLES THE PROCESSING OF ALL OUTLET STAFF FORMS
     */
    
    
    /**
     * This is the users report action for the controller
     */
    /**
     * This is the user setup action for the controller
     */
    public function actionOutletUserSetup($identificationCode){
       
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
            
            $this->actionNew_transactions($this->userid); exit();
            
        }else if($action_filter == "inbound_transactions"){
            
            $this->actionInbound_transactions($this->userid); exit();
            
        }else if($action_filter == "outbound_transactions"){
            
            $this->actionOutbound_transactions($this->userid); exit();
            
        }else if($action_filter == "all_transactions"){
            
            $this->actionAll_transactions($this->userid); exit();
            
        }else if($action_filter == "transaction_report"){
            
            $this->actionTransaction_reports($this->userid); exit();
            
        }
        
    }
    
    
    /**
     * This is the new transactions action for the controller
     */
    public function actionNew_transactions($userid){
        
        $dateFormat = 'Y-m-d';
        $today = Zf_DateTime::zf_subtractFromDateTime($this->zf_getDates(0));
        $dateToday = Zf_Core_Functions::Zf_FomartDate($dateFormat, $today);
        
        $userid = explode(ZVSS_CONNECT, $userid);
        
        $tableData = array();
        
        $tableData['tableTitle'] = "List of Todays Transactions ";
        
        $tableData['tableQuery'] = "SELECT * FROM zvss_new_transaction WHERE outletCode = '$userid[0]' AND transactionDate = '$dateToday' "; 
        
        $zf_phpGridSettings = $this->actionGenerateTransactionsTable($tableData, '', 1);
        
        $zf_data = $userid;
        
        Zf_View::zf_displayView('new_transactions',$zf_data , $zf_phpGridSettings);
        
    }
    
    
    /**
     * This is the inbound transactions action for the controller
     */
    public function actionInbound_transactions($userid){
        
        $userid = explode(ZVSS_CONNECT, $userid);
        
        $tableData = array();
        
        $tableData['tableTitle'] = "List of All Deposit Transactions ";
        
        $tableData['tableQuery'] = "SELECT * FROM zvss_new_transaction WHERE outletCode = '$userid[0]' AND transactionType = 'Deposit' "; 
        
        $zf_phpGridSettings = $this->actionGenerateTransactionsTable($tableData);
        
        $zf_data = $userid;
        
        Zf_View::zf_displayView('inbound_transactions',$zf_data , $zf_phpGridSettings);
        
    }
    
    
    /**
     * This is the outbound transactions action for the controller
     */
    public function actionOutbound_transactions($userid){
        
        $userid = explode(ZVSS_CONNECT, $userid);
        
        $tableData = array();
        
        $tableData['tableTitle'] = "List of All Withdrawal Transactions ";
        
        $tableData['tableQuery'] = "SELECT * FROM zvss_new_transaction WHERE outletCode = '$userid[0]' AND transactionType = 'Withdrawal' "; 
        
        $zf_phpGridSettings = $this->actionGenerateTransactionsTable($tableData);
        
        $zf_data = $userid;
        
        Zf_View::zf_displayView('outbound_transactions',$zf_data , $zf_phpGridSettings);
        
    }
    
    
    /**
     * This is the all transactions action for the controller
     */
    public function actionAll_transactions($userid){
        
        $userid = explode(ZVSS_CONNECT, $userid);
        
        $tableData = array();
        
        $tableData['tableTitle'] = "List of All Transactions ";
        
        $tableData['tableQuery'] = "SELECT * FROM zvss_new_transaction WHERE outletCode = '$userid[0]' "; 
        
        $zf_phpGridSettings = $this->actionGenerateTransactionsTable($tableData);
        
        $zf_data = $userid;
        
        Zf_View::zf_displayView('all_transactions',$zf_data , $zf_phpGridSettings);
        
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
     * This is the action that generates the transaction table
     */
    public function actionGenerateTransactionsTable($tableData, $zf_subGrid = NULL, $exclude = NULL){
        
        $dateFormat = 'd-m-Y';
        
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

        $transactionFirstName = array("title"=>"First Name", "name"=>"transactionFirstName", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $transactionFirstName;
        
        $transactionLastName = array("title"=>"Last Name", "name"=>"transactionLastName", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $transactionLastName;
        
        $transactionIdNo = array("title"=>"ID/PP Number", "name"=>"transactionIdNumber", "width"=>18, "editable"=>false);
        $zf_gridColumns[] = $transactionIdNo;
        
        $transactionMobile = array("title"=>"Mobile Number", "name"=>"transactionMobileNumber", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $transactionMobile;
        
        $transactionAmount = array("title"=>"Amount", "name"=>"transactionAmount", "width"=>17, "editable"=>false);
        $zf_gridColumns[] = $transactionAmount;
        
        $transactionEntity = array("title"=>"Transacting Entity", "name"=>"transactingEntity", "width"=>25, "editable"=>false);
        $zf_gridColumns[] = $transactionEntity;
        
        $transactionType = array("title"=>"Trans. Type", "name"=>"transactionType", "width"=>20, "editable"=>false);
        $zf_gridColumns[] = $transactionType;
        
        $transactionOutlet = array("title"=>"Transaction Code", "name"=>"transactionReference", "width"=>25, "editable"=>false); 
        $zf_gridColumns[] = $transactionOutlet;
        
        if($exclude != 1){
        $transactionDate = array("title"=>"Trans. Date", "name"=>"transactionDate", "width"=>15, "editable"=>true);
        $zf_gridColumns[] = $transactionDate;
        }
        
        if($exclude != 1){
        $transactionTime = array("title"=>"Trans. Time", "name"=>"transactionTime", "width"=>15, "editable"=>false);
        $zf_gridColumns[] = $transactionTime;
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
     * This is the action for processing oulet locality information for the controller
     */
    public function actionProcessOutletInformation(){
        
        $this->zf_targetModel->zvss_getOutletLocality(); exit();
        
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
