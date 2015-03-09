<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ZVSS MAIN SCHOOL ADMIN CONTROLLER, ESSENTIAL FOR ROUTING AND 
 * EXECUTING ALL ACTIONS THAT RELATE TO ZVSS MAIN SCHOOL ADMIN MODELS AND VIEWS.
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

class Main_school_adminController extends Zf_Controller {
   
    
    public $zf_defaultAction = "index";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
        Zf_SessionHandler::zf_sessionLoggedIn();
        
    }

    /**
     * This is the index action for the controller
     */
    public function actionIndex(){
        
        //This is a direct re-direction to the main_dashboard controller.
        Zf_GenerateLinks::zf_header_location("main_dashboard", "school_main_admin_dashboard"); exit();
        
    }
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW IS THE ACTIONS THAT RELATED TO SCHOOL PROFILE                     |
     +-------------------------------------------------------------------------+ 
     */
    
    /**
     * This is the manage_school_profile action for the controller 
     */
    public function actionManage_school_profile($identificationCode){
        
       if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
           $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode(Zf_SecureData::zf_decode_url($identificationCode));
           
           $systemSchoolCode = $identificationArray[2];
           
           Zf_View::zf_displayView('manage_school_profile', $systemSchoolCode); exit();
           
       }else{
           
           Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();
           
       }

    }
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO CLASS MANAGEMENT.             |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_classes action for the controller
    public function actionManage_school_classes($parameterData){
        
        //explode the parameterData incase it has any data concatinated with it.
        $filteredData = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_url($parameterData));
        
        $identificationCode = $filteredData[0]; //This is the unique identification code
        $filterAction = @$filteredData[1];//This is any other intended action
        $classCode = @$filteredData[2];//This is the class code
 
        
        if($identificationCode == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
            
            $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
           
            $systemSchoolCode = $identificationArray[2];
            
            if($filterAction == "addNewClass"){
                
                $this->zf_targetModel->processAddNewClass($identificationCode); exit();
                
            }else if($filterAction == "addNewStream"){
                
                $this->zf_targetModel->processAddNewStream($identificationCode); exit();
                
            }else{
                
                Zf_View::zf_displayView('manage_school_classes', $systemSchoolCode); exit();
                
            }

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
       
  
    } 
    
    
    //This is the manage_school_class-details action for the controller 
    public function actionManage_school_class_details($parameterData){
        
        $parameterData = Zf_SecureData::zf_decode_data($parameterData);
        
        $filteredData = explode("[`^`]", Zf_SecureData::zf_decode_data($parameterData));
        
        $identificationCode = $filteredData[0];//identification code
        $viewOption = $filteredData[1];//view option
        $schoolSystemCode = $filteredData[2];//school system code
        $schoolClassCode = $schoolSystemCode.ZVSS_CONNECT.$filteredData[3];//clean class name
        
        if($identificationCode == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
            
            if($viewOption == "editClass"){
                
                Zf_View::zf_displayView('manage_school_class_details', $filteredData); exit();
                
            }else if($viewOption == "viewClass"){
                
                Zf_View::zf_displayView('manage_school_class_details', $filteredData); exit();
                
            }else if($viewOption == "graphClass"){
                
                Zf_View::zf_displayView('manage_school_class_details', $filteredData); exit();
                
            }
            
        }else{
            
            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();
            
        }    
        
    }
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO DEPARTMENTS MANAGEMENT.       |
     +-------------------------------------------------------------------------+ 
     */
    
    // This is the manage_school_departments action for the controller 
    public function actionManage_school_departments($parameterData){
        
        //explode the parameterData incase it has any data concatinated with it.
        $filteredData = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_url($parameterData));
        
        $identificationCode = $filteredData[0]; //This is the unique identification code
        $filterAction = @$filteredData[1];//This is any other intended action
        $classCode = @$filteredData[2];//This is the class code
 
        
        if($identificationCode == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
            
            $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
           
            $systemSchoolCode = $identificationArray[2];
            
            if($filterAction == "addNewDepartment"){
                
                $this->zf_targetModel->processAddNewDepartment($identificationCode); exit();
                
            }else if($filterAction == "addNewSubDepartment"){
                
                $this->zf_targetModel->processAddNewSubDepartment($identificationCode); exit();
                
            }else{
                
                Zf_View::zf_displayView('manage_school_departments', $systemSchoolCode); exit();
                
            }

        }else{
            
            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
        
        
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO HOSTELS MANAGEMENT.           |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_hostels action for the controller
    public function actionManage_school_hostels($parameterData){
        
        //explode the parameterData incase it has any data concatinated with it.
        $filteredData = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_url($parameterData));
        
        $identificationCode = $filteredData[0]; //This is the unique identification code
        $filterAction = @$filteredData[1];//This is any other intended action
 
        
        if($identificationCode == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
            
            $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
           
            $systemSchoolCode = $identificationArray[2];
            
            if($filterAction == "addNewHostel"){
                
                $this->zf_targetModel->processAddNewHostel($identificationCode); exit();
                
            }else{
                
                Zf_View::zf_displayView('manage_school_hostels', $systemSchoolCode); exit();
                
            }

        }else{
            
            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
         
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO LIBRARY MANAGEMENT.           |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_library action for the controller 
    public function actionManage_school_library($identificationCode){
        
        if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
            Zf_View::zf_displayView('manage_school_library'); exit();

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
        
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO TRANSPORT MANAGEMENT.         |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_transport action for the controller 
    public function actionManage_school_transport($identificationCode){
        
        if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
            Zf_View::zf_displayView('manage_school_transport'); exit();

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
         
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO TEACHERS MANAGEMENT.          |
     +-------------------------------------------------------------------------+ 
     */
    
    // This is the manage_school_teachers action for the controller 
    public function actionManage_school_teachers($identificationCode){
        
        if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
            Zf_View::zf_displayView('manage_school_teachers'); exit();

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
        
    } 
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO STUDENTS MANAGEMENT.          |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_students action for the controller 
    public function actionManage_school_students($parameterData){
        
        //explode the parameterData incase it has any data concatinated with it.
        $filteredData = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_url($parameterData));
        
        $identificationCode = $filteredData[0]; //This is the unique identification code
        $filterAction = @$filteredData[1];//This is any other intended action
 
        
        if($identificationCode == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
            
            $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
           
            $systemSchoolCode = $identificationArray[2];
            
            if($filterAction == "studentsAdmissionForm"){
                
                $this->zf_targetModel->processStudentsAdmissionForms($identificationCode); exit();
                
            }else{
                
                Zf_View::zf_displayView('manage_school_students', $systemSchoolCode); exit();
                
            }

        }else{
            
            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
        
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO SUB STAFF MANAGEMENT.         |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_sub_staff action for the controller 
    public function actionManage_school_sub_staff($identificationCode){
        
        if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
            Zf_View::zf_displayView('manage_school_sub_staff'); exit();

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
        
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO SCHOOL FEES MANAGEMENT.       |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_fees action for the controller 
    public function actionManage_school_fees($identificationCode){
        
        if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
            Zf_View::zf_displayView('manage_school_fees'); exit();

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
            
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO SUBJECT MANAGEMENT.           |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_subjects action for the controller 
    public function actionManage_school_subjects($identificationCode){
        
        if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
            Zf_View::zf_displayView('manage_school_subjects'); exit();

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
         
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO EXAMINATION MANAGEMENT.       |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_exams action for the controller 
    public function actionManage_school_exams($identificationCode){
        
        if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
            Zf_View::zf_displayView('manage_school_exams'); exit();

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
         
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO MARKSHEET MANAGEMENT.         |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_marksheet action for the controller 
    public function actionManage_school_marksheet($identificationCode){
        
        if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
            Zf_View::zf_displayView('manage_school_marksheet'); exit();

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        } 
             
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO TIME-TABLE MANAGEMENT.        |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_timetable action for the controller
    public function actionManage_school_timetable($identificationCode){
        
        if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
            Zf_View::zf_displayView('manage_school_timetable'); exit();

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
         
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO NOTICE BOARD MANAGEMENT.      |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_notice_board action for the controller 
    public function actionManage_school_notice_board($identificationCode){
        
        if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
            Zf_View::zf_displayView('manage_school_notice_board'); exit();

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
           
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO CALENDER MANAGEMENT.          |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_ action for the controller 
    public function actionManage_school_calendar($identificationCode){
        
        if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
            Zf_View::zf_displayView('manage_school_calendar'); exit();

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
             
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO AFFILIATES MANAGEMENT.        |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_school_affiliates action for the controller 
    public function actionManage_school_affiliates($identificationCode){
        
        if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
            Zf_View::zf_displayView('manage_school_affiliates'); exit();

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
         
    } 
    
    
    
    /**
     +-------------------------------------------------------------------------+
     | BELOW ARE ALL THE ACTIONS THAT RELATED TO USER PROFILE MANAGEMENT.      |
     +-------------------------------------------------------------------------+ 
     */
    
    //This is the manage_user_profile action for the controller
    public function actionManage_school_user_profile($identificationCode){
        
        if(Zf_SecureData::zf_decode_url($identificationCode) == Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode")){
           
            Zf_View::zf_displayView('manage_user_profile'); exit(); 

        }else{

            Zf_GenerateLinks::zf_header_location('initialize', 'login'); exit();

        }
              
    } 
            
   
}
?>
