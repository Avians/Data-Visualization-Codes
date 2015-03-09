<?php

/**
 * -----------------------------------------------------------------------------
 * THIS CLASS FILE IS ESSENTIAL FOR LOADING THE CHARTS THAT HAVE BEEN GENERATED
 * USING THE FUSIONCHARTS PLUGIN.
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  25th/December/2013  Time: 21:40 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013
 * 
 */

class Zf_ConvertCurrency {
    
    //This is a variable that holds an instance of the currency conversion class.
    protected $converter;




    /**
     * -------------------------------------------------------------------------
     * THIS THE CLASS CONSTRUCTOR, IT RUNS BY DEFAULT WHENEVER THE CLASS IS
     * INITIALISED.
     * -------------------------------------------------------------------------
     * 
     */
    public function __construct() {
        
        $this->converter = new Zf_CurrencyConversion_Yahoo_Finance();
            
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR CONVERTING CURRENCY FROM ONE
     * DENOMINATION TO ANOTHER.
     * -------------------------------------------------------------------------
     */
    public static function zf_convertCurrency($zf_conversion_parameters = NULL){
        
        /**
         * Check to see that conversion parameters data is not emtpy
         */
        if(empty($zf_conversion_parameters) || !is_array($zf_conversion_parameters) || $zf_conversion_parameters == NULL){
            
            echo "<code><strong>Conversion Error:</strong> Missing Conversion Parameters</code> ";
            
        }else{
            
            $converter = new self;
            
            $amount=  $zf_conversion_parameters['amount'];
            $from=  $zf_conversion_parameters['from'];
            $to=  $zf_conversion_parameters['to'];
            $round=  $zf_conversion_parameters['round'];
            
            $value = $converter->converter->convert($amount, $from, $to, $round);
            
            return round( $value, 3);
 
        }
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS STATIC METHOD IS RESPONSIBLE FOR RETURNING THE AMOUNT OF MONEY AS
     * CONVERTED FROM ONE DENOMINATION TO THE OTHER.
     * -------------------------------------------------------------------------
     */
    public static function zf_currencyAmount($zf_amount_parameters = NULL){
        
        /**
         * Check to see that amount parameters data is not emtpy
         */
        if(empty($zf_amount_parameters) || !is_array($zf_amount_parameters) || $zf_amount_parameters == NULL){
            
            echo "<code><strong>Conversion Error:</strong> Amount Conversion Parameters</code> ";
            
        }else{
            
            $converter = new self;
            
            $finalAmount=  $zf_amount_parameters['amount'];
            $from=  $zf_amount_parameters['from'];
            $to=  $zf_amount_parameters['to'];
            $round=  $zf_amount_parameters['round'];
            
            $value = $converter->converter->amountTo($finalAmount, $from, $to, $round);
            
            return round( $value, 3);
 
        }
        
    }

    
}

?>