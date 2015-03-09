<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE INDEX CONTROLLER, ESSENTIAL FOR ROUTING AND EXECUTING ALL ACTIONS
 * THAT RELATE TO INDEX MODELS AND VIEWS.
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

class Main_dashboardController extends Zf_Controller {
   
    
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
     * This is super admin dashboard
     */
    public function actionSuper_admin_dashboard($identficationCode){
        
        Zf_View::zf_displayView('super_admin_dashboard');
        
    }
    
    
    /**
     * This is the platform admin dashboard
     */
    public function actionPlatform_admin_dashboard($identficationCode){
        
        Zf_View::zf_displayView('platform_admin_dashboard');
        
    }
    
    
    /**
     * This is the platform admin dashboard
     */
    public function actionPlatform_admin_filtered_dashboard($identficationCode){
        
        Zf_View::zf_displayView('platform_admin_filtered_dashboard');
        
    }
    
    
    /**
     * This is the zippo management dashboard
     */
    public function actionZippo_management_dashboard($identficationCode){
        
        Zf_View::zf_displayView('zippo_management_dashboard');
        
    }
    
    
    /**
     * This is the zippo operations dashboard
     */
    public function actionZippo_operations_dashboard($identficationCode){
        
        Zf_View::zf_displayView('zippo_operations_dashboard');
        
    }
    
    
    /**
     * This is the zippo finance dashboard
     */
    public function actionZippo_finance_dashboard($identficationCode){
        
        Zf_View::zf_displayView('zippo_finance_dashboard');
        
    }
    
    
    /**
     * This is the zippo treasury dashboard
     */
    public function actionZippo_treasury_dashboard($identficationCode){
        
        Zf_View::zf_displayView('zippo_treasury_dashboard');
        
    }
    
    
    /**
     * This is the zippo outlet staff dashboard
     */
    public function actionOutlet_staff_dashboard($identficationCode){
        
        Zf_View::zf_displayView('outlet_staff_dashboard');
        
    }
    
    
    

}
?>
