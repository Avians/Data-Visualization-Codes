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

class FileUpload_Model extends Zf_Model {
    
   
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
    
    
   /*
    * --------------------------------------------------------------------------------------
    * |                                                                                    |
    * |  The is the main method for the schoo set up.                                      |
    * |                                                                                    |
    * --------------------------------------------------------------------------------------
    */
    public function zf_uploadFile(){
        
        //He we collect  and validate all the school setup information
        $this->zf_formController->zf_postFormData('uploadFile')
                                ->zf_validateFormData('zf_fieldNotEmpty', 'uploadFile');
                
                             

        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();

        $this->_validResult = $this->zf_formController->zf_fetchValidData();
        
        //If the error result is empty.
        if (empty($this->_errorResult)) {
            
            
            //Prepare file for upload
            $zf_upload_parameters = array(
                
                "zf_fileUploadFolder" => ZF_DATASTORE."zvss_student_faces" ,
                "zf_fileFieldName" => $this->_validResult["uploadFile"]
            
            );
            
            $zf_upload_settings = array(
                
                'file_new_name_ext' => 'gif',
                'file_new_name_body' => 'Avians',
                'forbidden' => array('image/*')
            );

            //echo'<pre>'; print_r($this->_validResult); echo'<pre>'; exit(); //This is strictly for debugging purpose.
            
            Zf_File_Upload::zf_fileUpload($zf_upload_parameters, $zf_upload_settings);

            
        } else {

            echo "The form has some errors which MUST be rectified"; exit(); //This is strictly for debugging purpose.
            
        }
    }
    
    
    

}

?>
