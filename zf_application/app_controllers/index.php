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

class IndexController extends Zf_Controller {
   
    
    public $zf_defaultAction = "index";



    public function __construct() {
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        parent::__construct();
        
    }

    
    /**
     * This is the index action for the controller
     */
    public function actionIndex(){
        
        /**
         * ------------------------------------------------------------------------------
         * "$zf_actionData" IS A ZILAS STANDARD VARIABLE FOR PASsSING DATA DIRECTLY FROM
         * CONTROLLER INTO A TARGET VIEW. THIS VARIABLE CAN EITHER PASS AN ARRAY
         * OF DATA OR JUST A SINGLE DATA ELEMENT INTO THE TARGET VIEW.
         *                                              
         * NB: 1. If the data passed to the view is an array then, just assign the array  
         *        to a variable, then pass the variable as second parameter to the        
         *        Zf_View::Zf_displayView(). Finally just echo the array keys of the      
         *        passed array, AS A VARIABLE(S), within the target view.                 
         *                                                                                
         *     2. If the data being passed from the controller to the view is a single    
         *        data element,then, just assign it to a variable, then pass that same    
         *        variable to the Zf_View::Zf_displayView() as the second parameter, then 
         *        just echo the very same VARIABLE within the target view.
         * -------------------------------------------------------------------------------
         */
        
        
        $zf_actionData = array('framework' => "Zilas PHP Framework", 'version' => "Version 1.01", 'type' => 'Open source');
        
        Zf_SessionHandler::zf_setSessionVariable("User", "Avians");
        
        Zf_View::zf_displayView('index', $zf_actionData);
        
    }
    
    
    /**
     * This is the login action for the controller
     */
    public function actionLogin(){
        
        $zf_actionData = "In this section you will require the login username and pasword.";
        
        Zf_View::zf_displayView('login', $zf_actionData);
        
    }
    

}
?>
