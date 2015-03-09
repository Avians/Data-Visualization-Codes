<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE INITIALIZE CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING ALL ACTIONS
 * THAT RELATES TO THE LOGIN PROCESSES.
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  16th/March/2014 Time: 11:00 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013 (sunday)
 * 
 */

class InitializeController extends Zf_Controller {
   
    
    public $zf_defaultAction = "authenticate";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }
    
    
    /**
     * This is the authentication action for the controller
     */
    public function actionAuthenticate($login_entitiy = NULL){
        
        if(empty($login_entitiy) || $login_entitiy = ""){
            
             $this->actionLogin(); exit();
            
        }else{
            
            echo "We shall process others";
             
        }
        
    }
    
    
    /**
     * This is the user activation action for the controller
     */
    public function actionActivateUserAccount($emailAddress = NULL){
        
        if($emailAddress != NULL && !empty($emailAddress)){
            
            $confirm_email = Zf_SecureData::zf_decode_url($emailAddress);
            
            $this->zf_targetModel->processActivateUserAccount($confirm_email);
            exit();
            
        }
        
    }


    /**
     * This is the login action for the controller
     */
    public function actionLogin(){
        
        Zf_View::zf_displayView('login');
        
    }

    
    /**
     * This is the logout action for the controller
     */
    public function actionLogout(){
        
        Zf_SessionHandler::zf_unsetSessionVariable("LoggedIn");
        Zf_SessionHandler::zf_unsetSessionVariable("zvss_identificationCode");
        Zf_SessionHandler::zf_sessionDestroy();
        Zf_GenerateLinks::zf_header_location('initialize');
        
    }
    
    
    /**
     * This is the login action for the controller
     */
    public function actionProcessUserLogin($loginAction){
        
        $loginAction = Zf_SecureData::zf_decode_url($loginAction);
        
        if($loginAction === 'login'){
            
            $this->zf_targetModel->processUserLogin(); exit();
            
        }
        
        if($loginAction === 'reset_password'){
            
            $this->zf_targetModel->processUserPassword(); exit();
            
        }
        
    }
    
    
    /**
     * This is the reset password action for the controller
     */
    public function actionReset_password(){
        
        Zf_View::zf_displayView('reset_password');
        
    }
    

}
?>
