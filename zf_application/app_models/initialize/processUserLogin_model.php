<?php

//THIS CODE IS WRITTEN BY:
//1. ATHIAS AVIANS (MATHEW JUMA), THE CHIEF AND CORE DEVELOPER OF ZILAS FRAMEWORK PROJECT.

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Index Model which is responsible responsible for        |
 * |  handling all logics that are related to the template Controller  |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */

class ProcessUserLogin_Model extends Zf_Model {
    
   
    private $_errorResult = array();
    private $_validResult = array();

   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main class constructor. It runs automatically within any class object  |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function __construct() {
        
         parent::__construct();
            
    }
    
    
    //THIS METHOD DOES THE PROCESSING OF ALL LOGINS
    public function processUserLogin(){
      
      //Here we collect all the form data  
      $this->zf_formController->zf_postFormData('email')
                              ->zf_validateFormData('zf_maximumLength', 30, 'Your email')
                              ->zf_validateFormData('zf_minimumLength', 5, 'Your email')
                              ->zf_validateFormData('zf_checkEmail')
                              ->zf_validateFormData('zf_fieldNotEmpty', 'Email')
              
                              ->zf_postFormData('password')
                              ->zf_validateFormData('zf_maximumLength', 30, 'Your password')
                              ->zf_validateFormData('zf_minimumLength', 5, 'Your password')
                              ->zf_validateFormData('zf_fieldNotEmpty', 'Password');
      
      
      $this->_errorResult = $this->zf_formController->zf_fetchErrorData();
       
       
      $this->_validResult = $this->zf_formController->zf_fetchValidData();
      
      //echo'<pre>'; print_r($this->_validResult); echo'<pre>'; //exit(); //This is strictly for debugging purpose.
      //echo'<pre>'; print_r($this->_errorResult); echo'<pre>'; exit(); //This is strictly for debugging purpose.
      //echo Zf_SecureData::zf_data_encode('kennyzippo2014')." ==> Password<br>"; //This is strictly for setting up zippo users
      
      //$zvss_unsecure_data = "254".ZVSS_CONNECT."30".ZVSS_CONNECT."zippo_platform_admin".ZVSS_CONNECT."9".ZVSS_CONNECT."KE25138058";
      //echo Zf_SecureData::zf_encode_data("+254".ZVSS_CONNECT."30".ZVSS_CONNECT."Donholm-Tumaini".ZVSS_CONNECT."2".ZVSS_CONNECT."24723088-01")."<br><br>";exit();
      //$zvss_unsecure_data = "254".ZVSS_CONNECT."30".ZVSS_CONNECT."zippo_platform_admin".ZVSS_CONNECT."9".ZVSS_CONNECT."zippoKenny"; //This is strictly for setting up zippo users
      //echo "Identification code is: ".Zf_SecureData::zf_encode_data($zvss_unsecure_data); exit();
      
      if(empty($this->_errorResult)){
          
          foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {
              
              if($zvss_fieldName == 'email'){
                  
                  $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue); 
                  
              }
              
          }
          
          //This is the status column against which we compare.
          $zvss_columnStatus = array('userStatus');
          
          
          //Generate the SQL Query
          $zvss_selectUserStatus = Zf_QueryGenerator::BuildSQLSelect('zvss_application_users', $zvss_value, $zvss_columnStatus);
          
          
          //Execute the SQL Query
          $zvss_executeSelectUserStatus = $this->Zf_AdoDB->Execute($zvss_selectUserStatus);
          
          //Get the execution results
          if(!$zvss_executeSelectUserStatus){
               
               echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
               
           }else{
               
               //The the result count
               if($zvss_executeSelectUserStatus->RecordCount() > 0){
                   
                   //Fetch the actual result
                   $userStatus = $zvss_executeSelectUserStatus->fields['userStatus'];
                   
                   //Verify is the user status is 1
                   if($userStatus != 1){
                       
                       //echo "You need to activate your account.";
                       Zf_SessionHandler::zf_setSessionVariable("account_sign_up", "need_to_confirm");
                       Zf_GenerateLinks::zf_header_location('initialize', 'login');
                       exit();
                       
                   }else{
                       
                       //Account is active, so verify the user password.
                       $zvss_columnPassword = array('password');
                       
                       //Generate the SQL Query
                       $zvss_selectUserPassword = Zf_QueryGenerator::BuildSQLSelect('zvss_application_users', $zvss_value, $zvss_columnPassword);
                       
                       //Execute the SQL Query
                       $zvss_executeSelectUserPassword = $this->Zf_AdoDB->Execute($zvss_selectUserPassword);

                       //Get the execution results
                       if(!$zvss_executeSelectUserPassword){

                           echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                       }else{
                           
                           //The the result count
                           if($zvss_executeSelectUserPassword->RecordCount() > 0){
                               
                               while(!$zvss_executeSelectUserPassword->EOF){
                                    
                                    if($zvss_executeSelectUserPassword->fields['password'] === Zf_SecureData::zf_data_encode($this->_validResult['password'])){
                                        
                                        //We set the Session variable 'LoggedIn' to true
                                        Zf_SessionHandler::zf_setSessionVariable("LoggedIn", TRUE);
                                        
                                        $zvss_valueUserEmail['email'] = Zf_QueryGenerator::SQLValue($this->_validResult['email']); 
                                        $zvss_columnIdentificationCode = array('identificationCode');
                                        $zvss_sqlSelectIdentificationCode = Zf_QueryGenerator::BuildSQLSelect('zvss_application_users', $zvss_valueUserEmail, $zvss_columnIdentificationCode);
                                        
                                        $zvss_executeSelectIdentificationCode = $this->Zf_AdoDB->Execute($zvss_sqlSelectIdentificationCode);
                                        
                                        if(!$zvss_executeSelectIdentificationCode){
                                            
                                            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
                                            
                                        }else{
                                            
                                            //Encrypted user identification code direct from the database.
                                            $identificationCode = $zvss_executeSelectIdentificationCode->fields['identificationCode'];
                                            
                                            //Store the identification code in a session variable. NB: The session should be visible throughout the application
                                            Zf_SessionHandler::zf_setSessionVariable("zvss_identificationCode", $identificationCode);
                                            
                                            
                                            /**
                                             * -------------------------------------------------------------
                                             * This is the actual contents of identification code when decoded
                                             * is an array as shown below.
                                             * ------------------------------------------------------------
                                            Array
                                            (
                                                [0] => 254                              //Is the country code
                                                [1] => 027                              //Is the locality code
                                                [2] => p2eiNfFAvcd3CsUXLV579%BW8oj1SO   //Is the school's system generated code
                                                [3] => 7                                //Is the user role in the school
                                                [4] => 0001                             //Is the user code in the school
                                            )
                                             * 
                                             */
                                            
                                            
                                            //Here we decode the identification code into an identification Array.
                                            $identifictionArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
                                            
                                            
                                            //echo "<pre>"; print_r($identifictionArray); echo "</pre>";exit();
                                            //EACH OF THE REDIRECTIONS IN THIS SECTION ARE ROLE BASED AS SPECIFIED AND TAKES IN THE IDENTIFICTION CODE AS A PARAMETER.
                                            
                                            //If the user role is a Platform Super Admin == 10
                                            if($identifictionArray[3] == PLATFORM_SUPER_ADMIN){
                                                
                                                Zf_GenerateLinks::zf_header_location("main_dashboard", "super_admin_dashboard", $identificationCode);
                                                exit();
                                                
                                            }   
                                            //If the user role is a ZIPPO PLATFORM ADMIN == 9
                                            else if($identifictionArray[3] == ZIPPO_PLATFORM_ADMIN){
                                                
                                                Zf_GenerateLinks::zf_header_location("main_dashboard", "platform_admin_dashboard", $identificationCode);
                                                exit();
                                                
                                            }
                                            //If the user role is a ZIPPO MANAGEMENT == 8
                                            else if($identifictionArray[3] == ZIPPO_MANAGEMENT){
                                                
                                                Zf_GenerateLinks::zf_header_location("main_dashboard", "zippo_management_dashboard", $identificationCode);
                                                exit();
                                                
                                            }
                                            //If the user role is a ZIPPO OPERATIONS == 7
                                            else if($identifictionArray[3] == ZIPPO_OPERATIONS){
                                                
                                                Zf_GenerateLinks::zf_header_location("main_dashboard", "zippo_operations_dashboard", $identificationCode);
                                                exit();
                                                
                                            }
                                            //If the user role is a ZIPPO FINANCE == 6
                                            else if($identifictionArray[3] == ZIPPO_FINANCE){
                                                
                                                Zf_GenerateLinks::zf_header_location("main_dashboard", "zippo_finance_dashboard", $identificationCode);
                                                exit();
                                                
                                            }
                                            //If the user role is a ZIPPO TREASURY == 5
                                            else if($identifictionArray[3] == ZIPPO_TREASURY){
                                                
                                                Zf_GenerateLinks::zf_header_location("main_dashboard", "zippo_treasury_dashboard", $identificationCode);
                                                exit();
                                                
                                            }
                                            //If the user role is a ZIPPO OUTLET STAFF == 2
                                            else if($identifictionArray[3] == ZIPPO_OUTLET_STAFF || $identifictionArray[3] == ZIPPO_OUTLET_JUNIOR_STAFF){
                                                
                                                Zf_GenerateLinks::zf_header_location("main_dashboard", "outlet_staff_dashboard", $identificationCode);
                                                exit();
                                                
                                            }
                                            //If the user role is a BANNED USER == 1
                                            else if($identifictionArray[3] == BANNED_USER){
                                                
                                                Zf_GenerateLinks::zf_header_location("banned_user", "index", $identificationCode);
                                                exit();
                                                
                                            }
                                            //If the user role is a GUEST USER == 0
                                            else if($identifictionArray[3] == GUEST_USER){
                                                
                                                Zf_GenerateLinks::zf_header_location("guest_user", "index", $identificationCode);
                                                exit();
                                                
                                            }
                                            //Else log the user out of the systen
                                            else{
                                                
                                                //Custom Error Array
                                                $zvss_errorData = array( "zf_fieldName" => "password", "zf_errorMessage" => "* The password entered is invalid" );

                                                Zf_FormController::zf_validateSpecificField($this->_validResult, $zvss_errorData);
                                                Zf_GenerateLinks::zf_header_location('initialize', 'login');
                                                exit();
                                                
                                            }
                                            
                                        }

                                        
                                    }else{
                                        
                                        //Custom Error Array
                                        $zvss_errorData = array( "zf_fieldName" => "password", "zf_errorMessage" => "* The password entered is invalid" );
                   
                                        Zf_FormController::zf_validateSpecificField($this->_validResult, $zvss_errorData);
                                        Zf_GenerateLinks::zf_header_location('initialize', 'login');
                                        exit();
                                        
                                    }
                                    
                                }
                               
                           }else{
                               
                               //Custom Error Array
                               $zvss_errorData = array( "zf_fieldName" => "password", "zf_errorMessage" => "* Your password field is empty." );

                               Zf_FormController::zf_validateSpecificField($this->_validResult, $zvss_errorData);
                               Zf_GenerateLinks::zf_header_location('initialize', 'login');
                               exit();
                               
                           }

                       }
                       
                   }
                   
               }else{
                   
                   //Custom Error Array
                   $zvss_errorData = array( "zf_fieldName" => "email", "zf_errorMessage" => "* The email entered is invalid" );

                   Zf_FormController::zf_validateSpecificField($this->_validResult, $zvss_errorData);
                   Zf_GenerateLinks::zf_header_location('initialize', 'login');
                   exit();
                   
               }
           
           }
          
          
      }else{
          
          Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
          Zf_GenerateLinks::zf_header_location('initialize', 'login');
          exit();
          
      }
         
        
    }
    
    
    //THIS METHOD DOES THE RESETTING OF ALL PASSWORDS
    public function processUserPassword(){
        
      $this->zf_formController->zf_postFormData('email')
                              ->zf_validateFormData('zf_maximumLength', 30, 'Your email')
                              ->zf_validateFormData('zf_minimumLength', 5, 'Your email')
                              ->zf_validateFormData('zf_checkEmail')
                              ->zf_validateFormData('zf_fieldNotEmpty', 'Email');
      
      $this->_errorResult = $this->zf_formController->zf_fetchErrorData();
       
       
      $this->_validResult = $this->zf_formController->zf_fetchValidData();
      
      
      if(empty($this->_errorResult)){
          
          echo  "The form has no client side errors.";
          
      }else{
          
          Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
          Zf_GenerateLinks::zf_header_location('initialize', 'reset_password');
          
      }        
        
    }
    
}

?>
