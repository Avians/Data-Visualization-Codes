<?php

/**
 * -----------------------------------------------------------------------------
 * THIS CLASS FILE IS ESSENTIAL FOR GENERATING THE BREADCRUMBS DEPENDING ON THE
 * SECTION OF THE APPLICATION BEING ACCESSED.
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  25th/September/2013  Time: 17:30 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013
 * 
 */

class Zf_DateTime extends Zf_DateTimeCalculator{
    
    //This is a variable that holds an instance of the datetime calculator class.
    protected $dateTime;




    /**
     * -------------------------------------------------------------------------
     * THIS THE CLASS CONSTRUCTOR, IT RUNS BY DEFAULT WHENEVER THE CLASS IS
     * INITIALISED.
     * -------------------------------------------------------------------------
     * 
     */
    public function __construct($zf_start_date_time , $zf_mask_date_time) {
        
        $this->dateTime = new Zf_DateTimeCalculator($zf_start_date_time, $zf_mask_date_time);
        
        /**
         * CALL THE CONSTRUCTOR OF THE PARENT CLASS.
         */
        //$this->dateTime = parent::__construct($zf_start_date_time, $zf_mask_date_time);
            
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR ADDING A GIVEN AMOUNT OF TIME
     * TO A GIVEN DATE VALUE
     * -------------------------------------------------------------------------
     */
    public static function zf_addToDateTime($zf_date_parameters = NULL){
    
    /*|------------------------------------------------------|
     *|THIS IS THE PROTOTYPE ARRAY THAT THIS METHOD ACCEPTS  |
     *|------------------------------------------------------|      
     *
     * 
        $zf_date_parameters = array(

            "original_date" => Zf_Core_Functions::Zf_CurrentDate(), //today
            "date_mask" => "Y-m-d", //date mask should take the exact same format as the original date.
            "date_action" => array(

                "what" => "d", //Accepted paramters are: years=>years, mos=>months, m=>months, weeks=>weeks, days=>days, d=>days, hrs.=>hours, h=>hours, min=>minutes, sec=>seconds
                "howMuch" => 5 //This is the number of days

            )

        ); 
     * 
     * 
     */ 
        
        
        /**
         * Check to see that date parameters array is not emtpy
         */
        if(empty($zf_date_parameters) || !is_array($zf_date_parameters) || $zf_date_parameters == NULL){
            
            echo "<code><strong>Date Error:</strong> Missing Date Parameters</code> ";
            
        }else{
            
            $zf_start_date_time = $zf_date_parameters['original_date'];
            $zf_mask_date_time = $zf_date_parameters['date_mask'];
            $what = $zf_date_parameters['date_action']['what'];
            $howmuch = $zf_date_parameters['date_action']['howMuch'];
            
            $dateTime = new self($zf_start_date_time, $zf_mask_date_time);
            
            $dateTime->dateTime->add($what, $howmuch);
            
            $computedValue = $dateTime->dateTime->date_time;
            
            return $computedValue;
 
        }
        
        
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR SUBTRACTING A GIVEN AMOUNT OF TIME
     * FROM A GIVEN DATE VALUE
     * -------------------------------------------------------------------------
     */
    public static function zf_subtractFromDateTime($zf_date_parameters = NULL){
        
    /*|------------------------------------------------------|
     *|THIS IS THE PROTOTYPE ARRAY THAT THIS METHOD ACCEPTS  |
     *|------------------------------------------------------|      
     *
     * 
        $zf_date_parameters = array(

            "original_date" => Zf_Core_Functions::Zf_CurrentDate(), //today
            "date_mask" => "Y-m-d", //date mask should take the exact same format as the original date.
            "date_action" => array(

                "what" => "d", //Accepted paramters are: years=>years, mos=>months, m=>months, weeks=>weeks, days=>days, d=>days, hrs.=>hours, h=>hours, min=>minutes, sec=>seconds
                "howMuch" => 5 //This is the number of days

            )

        ); 
     * 
     * 
     */ 
        
        /**
         * Check to see that date parameters array is not emtpy
         */
        if(empty($zf_date_parameters) || !is_array($zf_date_parameters) || $zf_date_parameters == NULL){
            
            echo "<code><strong>Date Error:</strong> Missing Date Parameters</code> ";
            
        }else{
            
            $zf_start_date_time = $zf_date_parameters['original_date'];
            $zf_mask_date_time = $zf_date_parameters['date_mask'];
            $what = $zf_date_parameters['date_action']['what'];
            $howmuch = $zf_date_parameters['date_action']['howMuch'];
            
            $dateTime = new self($zf_start_date_time, $zf_mask_date_time);
            
            $dateTime->dateTime->subtract($what, $howmuch);
            
            $computedValue = $dateTime->dateTime->date_time;
            
            return $computedValue;
 
        }
        
    }
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR GETTING THE NUMBER OF DAYS BETWEEN
     * TWO GIVEN DATES
     * -------------------------------------------------------------------------
     */
    public static function zf_numberOfDays($zf_first_date = "NULL", $zf_second_date = "NULL"){
        
        /**
         * Check to see that date parameters array is not emtpy
         */
        if((empty($zf_first_date) || empty($zf_second_date)) || ($zf_first_date == NULL || $zf_second_date == NULL)){
            
            echo "<code><strong>Date Error:</strong> Missing Date Parameters</code> ";
            
        }else{
            
            $datetime1 = new DateTime($zf_first_date);
        
            $datetime2 = new DateTime($zf_second_date);
        
            $difference = $datetime1->diff($datetime2);
        
            return $difference->days; 
            
 
        }
        
    }
    
    
    
    
}

?>

