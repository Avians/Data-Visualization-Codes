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

class Manage_school_classes_Model extends Zf_Model {
    
    
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
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR THE ADDITION OF A NEW
     * CLASS INTO THE SCHOOL.
     * -------------------------------------------------------------------------
     */
    public function processAddNewClass($identificationCode) {
        
        //Decode the identification code
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        $schoolSystemCode = $identificationArray[2];

        //Here we collect all the class data  
        $this->zf_formController->zf_postFormData('schoolClassName')
                ->zf_validateFormData('zf_maximumLength', 30, 'Class name')
                ->zf_validateFormData('zf_minimumLength', 5, 'Class name')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Class name')
                ->zf_postFormData('schoolClassAlias')
                ->zf_validateFormData('zf_maximumLength', 20, 'Class alias')
                ->zf_validateFormData('zf_minimumLength', 2, 'Class alias')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Class alias');


        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();


        $this->_validResult = $this->zf_formController->zf_fetchValidData();

        if (empty($this->_errorResult)) {
            
            //print_r($this->_validResult); exit();//This is strictly for debugging purpose
            
            foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

              if($zvss_fieldName == 'schoolClassName'){

                  $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue); 

              }

            }
             
            $schoolClassCode = $schoolSystemCode . ZVSS_CONNECT . Zf_Core_Functions::Zf_CleanName($this->_validResult['schoolClassName']);
            
            $zvss_value["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
            
            //This is the status column against which we compare.
            $zvss_columns = array('schoolClassName', 'schoolClassCode');


            //Generate the SQL Query
            $zvss_selectSchoolClasses = Zf_QueryGenerator::BuildSQLSelect('zvss_school_classes', $zvss_value, $zvss_columns);
            

            //Execute the SQL Query
            $zvss_executeSelectSchoolClasses = $this->Zf_AdoDB->Execute($zvss_selectSchoolClasses);

            //Get the execution results
            if(!$zvss_executeSelectSchoolClasses){

                 echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

             }else{

                 //The the result count
                 if($zvss_executeSelectSchoolClasses->RecordCount() > 0){

                    //There is a class with a similar name so throw an exception and re-direct to new class page
                    Zf_SessionHandler::zf_setSessionVariable("class_setup", "class_existence_error");

                    $zf_errorData = array("zf_fieldName" => "schoolClassName", "zf_errorMessage" => "* This class already exists!!.");
                    Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                    Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_classes', $identificationCode);
                    exit();
                     
                 }else{
                     
                     //There is a no class with a similar name so insert into the database
                     foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

                        $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue);

                     }
                     
                     //Other database values
                     $zvss_value["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
                     $zvss_value["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
                     $zvss_value["classStatus"] = Zf_QueryGenerator::SQLValue(0);
                     
                     //Build the insert SQL query for a new class
                     $insertSchoolClass = Zf_QueryGenerator::BuildSQLInsert('zvss_school_classes', $zvss_value);
                     
                     //Execute the insert school class query.
                     $executeInsertSchoolClass  = $this->Zf_AdoDB->Execute($insertSchoolClass);
                     
                    //Acceptable fields include: schoolSystemCode, schoolClassCode, schoolStreamCode, schoolStreamName
                    $zvss_stream_values["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
                    $zvss_stream_values["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
                    $zvss_stream_values["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
                    $zvss_stream_values["schoolStreamName"] = Zf_QueryGenerator::SQLValue($this->_validResult['schoolClassName']);
                    
                    //Build the insert SQL query for a new stream
                    $insertSchoolStream = Zf_QueryGenerator::BuildSQLInsert('zvss_school_streams', $zvss_stream_values);
                    
                    //Execute the insert school stream query.
                    $executeInsertSchoolStream = $this->Zf_AdoDB->Execute($insertSchoolStream);
                            
                    if(!$executeInsertSchoolClass || !$executeInsertSchoolStream){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{
                        
                        //Redirect to the manage classes section.
                        Zf_SessionHandler::zf_setSessionVariable("class_setup", "class_setup_success");
                        Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_classes', $identificationCode);
                        exit();

                    }
                     
                 }

             }

            } else {

              //print_r($this->_errorResult); exit();//This is strictly for debugging purpose
              Zf_SessionHandler::zf_setSessionVariable("class_setup", "class_setup_error");
              Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
              Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_classes', $identificationCode);
              exit();

            }
        
    }
    

    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR THE ADDITION OF A NEW
     * STREAM INTO THE SCHOOL.
     * -------------------------------------------------------------------------
     */
    public function processAddNewStream($identificationCode) {
        
        //Decode the identification code
        $identificationArray = Zf_Core_Functions::Zf_DecodeIdentificationCode($identificationCode);
        $schoolSystemCode = $identificationArray[2];
        
        //Recieve the stream data.
        $this->zf_formController->zf_postFormData('schoolClassCode')
                ->zf_validateFormData('zf_maximumLength', 200, 'Class name')
                ->zf_validateFormData('zf_minimumLength', 5, 'Class name')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Class name')
                
                ->zf_postFormData('schoolStreamName')
                ->zf_validateFormData('zf_maximumLength', 30, 'Stream name')
                ->zf_validateFormData('zf_minimumLength', 2, 'Stream name')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Stream name')
                
                ->zf_postFormData('schoolStreamCapacity')
                ->zf_validateFormData('zf_maximumLength', 4, 'Stream capacity')
                ->zf_validateFormData('zf_minimumLength', 1, 'Stream capacity')
                ->zf_validateFormData('zf_integerData', 'Stream capacity')
                ->zf_validateFormData('zf_fieldNotEmpty', 'Stream capacity');


        $this->_errorResult = $this->zf_formController->zf_fetchErrorData();


        $this->_validResult = $this->zf_formController->zf_fetchValidData();

        if (empty($this->_errorResult)) {
            
            //print_r($this->_validResult); exit();//This is strictly for debugging purpose
            
            //Check if there is a single stream whose stream code is the same as the class code
            //If there exists such a stream, then update its values, else create a new stream
            
            foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

              if($zvss_fieldName == 'schoolClassCode'){

                  $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue); 

              }

            }
            
            $zvss_value['schoolStreamCode'] = Zf_QueryGenerator::SQLValue($this->_validResult['schoolClassCode']);
            
            //Generate the SQL Query for selecting the default stream
            $zvss_selectDefaultClassStreams = Zf_QueryGenerator::BuildSQLSelect('zvss_school_streams', $zvss_value);
            
            //Execute the SQL Query for selecting the default stream
            $zvss_executeSelectDefaultClassStreams = $this->Zf_AdoDB->Execute($zvss_selectDefaultClassStreams);
            
            //Get the execution results
            if(!$zvss_executeSelectDefaultClassStreams){

                 echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

            }else{
                
                $schoolClassCode = $this->_validResult['schoolClassCode'];
                $schoolStreamCode = $this->_validResult['schoolClassCode'].ZVSS_CONNECT.Zf_Core_Functions::Zf_CleanName($this->_validResult['schoolStreamName']);
                $classStreamName = $this->_validResult['schoolStreamName'];
                $classStreamCapacity = $this->_validResult['schoolStreamCapacity'];
                
                //Get the result count for the default class streams
                if($zvss_executeSelectDefaultClassStreams->RecordCount() > 0){
                    
                    //These are the fields to be updated.
                    $zvss_value["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($schoolStreamCode);
                    $zvss_value["schoolStreamName"] = Zf_QueryGenerator::SQLValue($classStreamName);
                    $zvss_value["schoolStreamCapacity"] = Zf_QueryGenerator::SQLValue($classStreamCapacity);
                    $zvss_value["schoolStreamOccupancy"] = Zf_QueryGenerator::SQLValue(0);
            
                    //This are the where column against which we compare.
                    $zvss_columns['schoolClassCode'] = Zf_QueryGenerator::SQLValue($schoolClassCode);
                    $zvss_columns['schoolStreamCode'] = Zf_QueryGenerator::SQLValue($schoolClassCode);
                    
                    //Generate the SQL Query for updating the class stream
                    $zvss_updateDefaultClassStreams = Zf_QueryGenerator::BuildSQLUpdate('zvss_school_streams', $zvss_value, $zvss_columns);
                    
                    //Execute the SQL Query for updating the default class stream
                    $zvss_executeUpdateDefaultClassStreams = $this->Zf_AdoDB->Execute($zvss_updateDefaultClassStreams);
                    
                    //Get the execution results for updating the default class stream
                    if(!$zvss_executeUpdateDefaultClassStreams){

                        echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                    }else{
                        
                        //Redirect to the manage classes section.
                        Zf_SessionHandler::zf_setSessionVariable("class_setup", "stream_setup_success");
                        Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_classes', $identificationCode);
                        exit();

                    }
                    
                }else{
                    
                    //Create a new stream in the class
                     $zvss_value["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($schoolStreamCode);
            
                    //This is the status column against which we compare.
                    $zvss_columns = array('schoolStreamName', 'schoolStreamCode');


                    //Generate the SQL Query
                    $zvss_selectSchoolStreams = Zf_QueryGenerator::BuildSQLSelect('zvss_school_streams', $zvss_value, $zvss_columns);


                    //Execute the SQL Query
                    $zvss_executeSelectSchoolStreams = $this->Zf_AdoDB->Execute($zvss_selectSchoolStreams);

                    //Get the execution results
                    if(!$zvss_executeSelectSchoolStreams){

                         echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                     }else{

                         //The the result count
                         if($zvss_executeSelectSchoolStreams->RecordCount() > 0){

                            //There is a class with a similar name so throw an exception and re-direct to new class page
                            Zf_SessionHandler::zf_setSessionVariable("class_setup", "stream_existence_error");

                            $zf_errorData = array("zf_fieldName" => "schoolStreamName", "zf_errorMessage" => "* This strean already exists!!.");
                            Zf_FormController::zf_validateSpecificField($this->_validResult, $zf_errorData);
                            Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_classes', $identificationCode);
                            exit();

                         }else{

                             //There is a no class with a similar name so insert into the database
                             foreach ($this->_validResult as $zvss_fieldName => $zvss_fieldValue) {

                                $zvss_value[$zvss_fieldName] = Zf_QueryGenerator::SQLValue($zvss_fieldValue);

                             }

                             //Other database values
                             $zvss_value["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
                             $zvss_value["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($schoolStreamCode);
                             $zvss_value["schoolStreamOccupancy"] = Zf_QueryGenerator::SQLValue(0);

                             //Build the insert SQL queries
                            $insertClassStream = Zf_QueryGenerator::BuildSQLInsert('zvss_school_streams', $zvss_value);

                            $executeInsertClassStream = $this->Zf_AdoDB->Execute($insertClassStream);

                            if(!$executeInsertClassStream){

                                echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

                            }else{

                                //Redirect to the manage classes section.
                                Zf_SessionHandler::zf_setSessionVariable("class_setup", "stream_setup_success");
                                Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_classes', $identificationCode);
                                exit();

                            }


                         }
                     }
                    
                }
                 
            }
 

            
        }else{
            
            //print_r($this->_errorResult); exit();//This is strictly for debugging purpose
            
            Zf_SessionHandler::zf_setSessionVariable("class_setup", "stream_setup_error");
            Zf_FormController::zf_validateGeneralForm($this->_validResult, $this->_errorResult);
            Zf_GenerateLinks::zf_header_location('main_school_admin', 'manage_school_classes', $identificationCode);
            exit();
            
        }
    }
    
    
    /**
     * =========================================================================
     * THE PUBLIC AND PRIVATE METHODS BELOW ARE RESPONSIBLE FOR BUILDING THE 
     * LOGIC THAT FETCHES AND RENDERS ALL THE CLASS AND STREAM INFORMATION. 
     * =========================================================================
     */
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR CONFIRMING IF A CLASS
     * IS ALREADY EXISTING
     * -------------------------------------------------------------------------
     */
    public function confirmClassPresence($schoolSystemCode){
        
        $confirmClass = $this->fetchClassInformation($schoolSystemCode);
        
        if($confirmClass == 0){
                                                        
            echo '<h3 class="form-section form-title">Add Stream Warning!!</h3> 
                    <div class="school-class-inner-content">
                        <span class="content-view-errors" >
                            There are no classes yet! You need to add atleast one class to be able to add streams.
                        </span>
                   </div>';

        }else{

            //LOAD STREAM SETUP FORM
            Zf_ApplicationWidgets::zf_load_widget("main_school_admin", "add_stream_form.php", $schoolSystemCode);

        }
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PUBLIC METHOD THAT IS RESPONSIBLE FOR GETTING THE GENERAL 
     * CLASS AND STREAM BASED INFORMATION
     * -------------------------------------------------------------------------
     */
    public function getSchoolClassesStreams($schoolSystemCode){
        
        $identificationCode = Zf_SessionHandler::zf_getSessionVariable("zvss_identificationCode");
                
        $schoolClasses = $this->fetchClassInformation($schoolSystemCode);
        
       // print_r($schoolClasses);
        
        $school_classes = "";
        
        if($schoolClasses == 0){
            
            $school_classes .='<div class="tab-pane active form">
                                <h3 class="form-section form-title">Class Overview Warning!!</h3>
                                <div class="school-class-inner-content">
                                    <span class="content-view-errors" >
                                        There are no classes yet! You need to add atleast one class to have a class overview.
                                    </span>
                                </div>
                            </div>';
            
        }else{
            
            $school_classes .= '<div class="row">';
            
            foreach ($schoolClasses as  $value) {
                
                $schoolClassName = $value['schoolClassName']; $schoolClassCode =  $value['schoolClassCode'];
                
                $classStreams = $this->fetchStreamInformation($schoolClassCode);
                
                //These are the action parameters
                $editClass = Zf_SecureData::zf_data_encode($identificationCode.ZVSS_CONNECT.'editClass'.ZVSS_CONNECT.$schoolClassCode);
                $viewClass = Zf_SecureData::zf_data_encode($identificationCode.ZVSS_CONNECT.'viewClass'.ZVSS_CONNECT.$schoolClassCode);
                
                $school_classes .= '<div class="col-lg-6 col-md-9 col-sm-8 col-xs-12 margin-bottom-15">
                                        <div class="school-content-wrapper">
                                            <div class="row">
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                    <h3>'.$schoolClassName.'</h3>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 action_buttons">
                                                     <a href="'.ZF_ROOT_PATH.'main_school_admin'.DS.'manage_school_class_details'.DS.$editClass.'" title="Edit '.$schoolClassName.'"><i class="fa fa-edit"></i></a>&nbsp;';
                
                                                if($classStreams != 0){
                                                    
                                                     $school_classes .= ' 
                                                                            <a href="'.ZF_ROOT_PATH.'main_school_admin'.DS.'manage_school_class_details'.DS.$viewClass.'" title="View '.$schoolClassName.'"><i class="fa fa-bars"></i></a>&nbsp;
                                                                        ';
                                                     
                                                }
                                                
                               $school_classes .= '</div>
                                               </div>
                                            <hr>
                                            <div class="school-class-inner-content scroller"  data-always-visible="1" data-rail-visible="0">
                                                <div class="table-responsive" style="margin-right: 5px !important;">
                                                    ';
                                                        
                                                    if($classStreams == 0){
                                                       
                                                        $school_classes .= '<span class="content-view-errors" >No streams have been created in '.$schoolClassName.'</span>';
                                                        
                                                    }else{
                                                        
                                                        $school_classes .= '<table class="table table-striped table-bordered table-hover">
                                                                                <thead>
                                                                                        <tr>
                                                                                                <th>Stream Name</th><th>Capacity</th><th>Occupancy</th><th>Availability</th>
                                                                                        </tr>
                                                                                </thead>
                                                                                <tbody>';
                                                        
                                                        foreach ($classStreams as $value) {
                                                            
                                                            $schoolStreamName = $value['schoolStreamName']; $schoolStreamCapacity =  $value['schoolStreamCapacity']; 
                                                            $schoolStreamOccupancy = $value['schoolStreamOccupancy']; $schoolStreamAvailability = $schoolStreamCapacity - $schoolStreamOccupancy;
                                                            
                                                            $school_classes .= '<tr><td>'.$schoolStreamName.'</td><td>'.$schoolStreamCapacity.'</td><td>'.$schoolStreamOccupancy.'</td><td class="content-table-flags">'.$schoolStreamAvailability.'</td></tr>';
                                                            
                                                        }
                                                        
                                                        $school_classes .= '</tbody>
                                                                            </table>';
                                                        
                                                    }
               
               $school_classes .= '</div>
                                        
                                      </div>
                                      <div class="clearfix  margin-bottom-5"></div>
                                     </div>
                                  </div>';
                
            }
            
            $school_classes .= '</div>';
            
        }
        
        echo $school_classes;
        
    }
    
   
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * CLASS INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchClassInformation($schoolSystemCode){
        
        $zvss_sqlValue["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
        
        $fetchSchoolClasses = Zf_QueryGenerator::BuildSQLSelect('zvss_school_classes', $zvss_sqlValue);
        
        $zf_executeFetchSchoolClasses= $this->Zf_AdoDB->Execute($fetchSchoolClasses);

        if(!$zf_executeFetchSchoolClasses){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolClasses->RecordCount() > 0){

                while(!$zf_executeFetchSchoolClasses->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolClasses->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchSchoolClasses->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    
   
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE PRIVATE METHOD THAT IS RESPONSIBLE FOR ACTUALLY FETCHING THE
     * STREAM INFORMATION
     * -------------------------------------------------------------------------
     */
    private function fetchStreamInformation($schoolClassCode){
        
        $streamFilter = explode(ZVSS_CONNECT, $schoolClassCode); $schoolSystemCode = $streamFilter[0];
        
        $zvss_sqlValue["schoolSystemCode"] = Zf_QueryGenerator::SQLValue($schoolSystemCode);
        $zvss_sqlValue["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        
        $fetchSchoolStreams = Zf_QueryGenerator::BuildSQLSelect('zvss_school_streams', $zvss_sqlValue);
        $zf_executeFetchSchoolStreams = $this->Zf_AdoDB->Execute($fetchSchoolStreams);
       
        $zvss_sqlValueNoStream["schoolClassCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        $zvss_sqlValueNoStream["schoolStreamCode"] = Zf_QueryGenerator::SQLValue($schoolClassCode);
        
        $fetchSchoolNoStreams = Zf_QueryGenerator::BuildSQLSelect('zvss_school_streams', $zvss_sqlValueNoStream);
        $zf_executeFetchSchoolNoStreams = $this->Zf_AdoDB->Execute($fetchSchoolNoStreams);

        if(!$zf_executeFetchSchoolStreams || !$zf_executeFetchSchoolNoStreams){

            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";

        }else{

            if($zf_executeFetchSchoolNoStreams->RecordCount() > 0){
                
                return 0;

            }else if($zf_executeFetchSchoolStreams->RecordCount() > 0){

                while(!$zf_executeFetchSchoolStreams->EOF){
                    
                    //print "<pre>";print_r($zf_executeFetchSchoolClasses->GetRows()); print "</pre>"; //This is strictly for debugging purpose.
                    
                    //$results = $zf_executeFetchSchoolClasses->fields;
                    $results = $zf_executeFetchSchoolStreams->GetRows();
                    
                }
                
                return $results;

                
            }else{
                
                return 0;
                
            }
        }
        
    }
    

}

?>
