<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE ZILAS CORE FUNCTIONS FILE, WHICH IS ESSENTIAL FOR ALL THE DEFAULT
 * APPLICATION FUNCTIONS THAT ARE NECESSARY FOR THE FRAMEWORK TO RUN PROPERLY
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  12th/August/2013  Time: 09:30 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013
 * 
 */


class Zf_Core_Functions {
    
    /**
     * -----------------------------------------------------------------------------
     * Responsible for sanitizing and spliting the URL passed and then it returns an
     * array with the URL parts as the array values.
     * -----------------------------------------------------------------------------
     */
    public static function Zf_URLSanitize() {

        /**
         * IF A URL HAS BEEN SET, GET IT FOR SANITIZATION
         */
        $zf_url = isset($_GET['url']) ? $_GET['url'] : null;


        /**
         * REMOVE THE LAST FORWARD SLASH "/" FROM THE URL
         */
        $zf_url = rtrim($zf_url, '/');


        /**
         * FILTER THE URL TO ONLY REMAIN WITH CLEAN URL
         */
        $zf_url = filter_var($zf_url, FILTER_SANITIZE_URL);


        /**
         * SPLIT THE URL, WITH "/" AS THE DELIMITER WHILE RETURNING EACH PART INTO
         * AN ARRAY
         */
        $zf_url = explode('/', $zf_url);

        //print_r($zf_url); echo "<br><br>"; //This is strictly for debugging purposes.


        /**
         * RETURNS AN ARRAY OF THE URL PARTS.
         */
        return $zf_url;
    }
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR GENERATING THE APPLICATION COPYRIGHT
     * INFORMATION
     * -------------------------------------------------------------------------
     */
    public static function Zf_ApplicationCopyright(){
        
        $zf_applicationcopyright = Zf_Configurations::Zf_ApplicationStatus();
        
        echo  $zf_applicationcopyright['application_copyright'];
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR AUTOLOADING THE APPLICATION LOGO.
     * -------------------------------------------------------------------------
     */
    public static function Zf_ApplicationLogo($width=NULL, $height=NULL, $style=NULL){
        
        $logo_path = ZF_ROOT_PATH.DS.APPLICATION_LOGO;
    
        $logo = '<a href="'.ZF_ROOT_PATH.'"><img src="'.$logo_path.'" alt="Zeepo Logo" title="'.APPLICATION_NAME.'" width="'.$width.'" height="'.$height.'" style="margin: 10px auto auto 10px !important;"></a>';
        echo  $logo;
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR GENERATING THE "powered by..." FRAMEWORK 
     * TAGLINE.
     * -------------------------------------------------------------------------
     */
    public static function Zf_FrameworkTagLine(){
        
        $zf_external_link = array(
            'name' => 'Developed by: iKrowd',
            'link' => 'http://www.ikrowd.co.ke', //Always ensure that the external link starts with http:// or https://
            'title' => 'iKrowd',
            'target' => '_blank',
            'style' => '',
            'id' => ''
        );
    
        $zf_frameworkTagline = Zf_GenerateLinks::zf_external_link($zf_external_link);
        echo  $zf_frameworkTagline;
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR DECODING THE IDENIFICATION CODE INTO AN 
     * ARRAY
     * -------------------------------------------------------------------------
     */
    public static function Zf_DecodeIdentificationCode($identificationCode){
        
        $zf_idenificationCode = explode(ZVSS_CONNECT, Zf_SecureData::zf_decode_data($identificationCode));
        
        return $zf_idenificationCode;
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD GENEARTES THE YEAR DROPDOWN OPTION
     * -------------------------------------------------------------------------
     */
    public static function Zf_GenerateYearOption($startYear = NULL){
        
        $option = "";

            for($year=$startYear; $year < date('Y')+1; $year++){
                
                $option = '<option value="'.$year.'">'.$year.'</option>';
                echo  $option;
                
            }
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR GENERATING A RANDOM STRING
     * -------------------------------------------------------------------------
     */
    public static function Zf_GenerateRandomString($zf_stringLength = NULL, $zf_type = NULL){
        
        $randomGenerator = new self;
        
        if(empty($zf_type) || $zf_type === "string"){
            
            $randomValue = $randomGenerator->Zf_GenerateRandomDataString($zf_stringLength);
            
        }else if($zf_type === "number"){
            
            $randomValue = $randomGenerator->Zf_GenerateRandomDataNumber($zf_stringLength);
            
        }
            
        return $randomValue;
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR GENERATING RANDOM DATA
     * -------------------------------------------------------------------------
     */
    public function Zf_GenerateRandomDataNumber($zf_stringLength){
       
            $randstr = "";
            for($i=0; $i<$zf_stringLength; $i++){
                    $randnum = mt_rand(0,61);
                    if($randnum < 10){
                            $randstr .= chr($randnum+48);
                    }
                    else if($randnum < 36){
                            $randstr .= chr($randnum+55);
                    }else{
                            $randstr .= chr($randnum+61);
                    }
            }
            return $randstr;
        
    }
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR GENERATING RANDOM DATA
     * -------------------------------------------------------------------------
     */
    public function Zf_GenerateRandomDataString($zf_stringLength){
       
            // start with a blank increpted_value 
            $increpted_value = ""; 

            // define possible characters 
             $possible = "aeioubcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZAEIOU1234567890{[(@^!|$`~;*)]}"; 

            // set up a counter 
            $i = 0;  

            // add random characters to $increpted_value until $length is reached 
            while ($i < $zf_stringLength) {  
              // pick a random character from the possible ones 
              $char = substr($possible, mt_rand(0, strlen($possible)-1), 1); 
              // we don't want this character if it's already in the increpted_value 
              if (!strstr($increpted_value, $char)) {  
                $increpted_value .= $char; 
                $i++; 
              } 
            } 
            // done! 
            return $increpted_value; 
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR GENERATING RANDOM DATA
     * -------------------------------------------------------------------------
     */
    public static function Zf_GeneratePassword($zf_passwordLength = 9, $zf_passwordStrength = 8){
       
        $vowels = 'aeiou';
	$consonants = 'bcdfghjklmnpqrstvwxyz';
	if ($zf_passwordStrength & 1) {
		$consonants .= 'BCDFGHJKLMNPQRSTVWXYZ';
	}
	if ($zf_passwordStrength & 2) {
		$vowels .= "AEIOU";
	}
	if ($zf_passwordStrength & 4) {
		$consonants .= '23456789';
	}
	if ($zf_passwordStrength & 8) {
		$consonants .= '&@#$%!';
	}
 
	$password = '';
	$alt = time() % 2;
	for ($i = 0; $i < $zf_passwordLength; $i++) {
		if ($alt == 1) {
			$password .= $consonants[(rand() % strlen($consonants))];
			$alt = 0;
		} else {
			$password .= $vowels[(rand() % strlen($vowels))];
			$alt = 1;
		}
	}
	return $password;
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR CLEANING IMAGE NAMES
     * -------------------------------------------------------------------------
     * @param string imageName The image name
     * @return string cleaned image name
     */
    public static function Zf_CleanName($imageName){
        
        $imageName = str_replace(" ", "", ucwords($imageName));
        
        $search = array("{","[","(","@","^","!","|","$","`","~",";","*",")","]","}");
        $cleanImageName = str_replace($search, "", $imageName);
        
        return $cleanImageName;
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR CLEANING IMAGE NAMES
     * -------------------------------------------------------------------------
     * @param string imageName The image name
     * @return string cleaned image name
     */
    public static function Zf_DateTime(){
        
       $zf_currentDateTime = date("Y-m-d")."T".date("H:i:s")."Z";
       
       echo $zf_currentDateTime;
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR CLEANING IMAGE NAMES
     * -------------------------------------------------------------------------
     * @param none
     * @return string current date time
     */
    public static function Zf_CurrentDateTime(){
        
       $zf_currentDateTime = date("j F Y")." - ".date("H:i");
       
       return $zf_currentDateTime;
        
    }
    
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR GENERATING CURRENT DATE
     * -------------------------------------------------------------------------
     * @param none
     * @return string current date
     */
    public static function Zf_CurrentDate(){
        
       $zf_currentDateTime = date("d-m-Y");
       
       return $zf_currentDateTime;
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR GENERATING CURRENT TIME
     * -------------------------------------------------------------------------
     * @param none
     * @return string current time
     */
    public static function Zf_CurrentTime(){
        
       $zf_currentDateTime = date("H:i:s");
       
       return $zf_currentDateTime;
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR FORMATING DATE STRINGS
     * -------------------------------------------------------------------------
     * @param none
     * @return string formatedDate
     */
    public static function Zf_FomartDate($date_format, $date_string){
        
        $formatedDate = date($date_format, strtotime($date_string));
        
        return $formatedDate;
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR FORMATING AMOUNTS OF MONEY
     * -------------------------------------------------------------------------
     * @param none
     * @return string current time
     */
    public static function Zf_FormatMoney($amount, $dec=NULL, $comm=NULL){
        
        if($dec == NULL && $comm ==NULL ){
            
            return number_format(round($amount, 2), 2, '.', ',');
            
        }else{
            
            return number_format(round($amount, $dec), $comm, '.', ',');
            
        }
        
    }
    
    
    /**
     * -------------------------------------------------------------------------
     * THIS IS THE STATIC METHOD FOR CHANGING TIME ZONES
     * -------------------------------------------------------------------------
     * @param none
     * @return string current time
     */
    public static function Zf_changeTimeZone($currentTimeZone = NULL){
        
        if($currentTimeZone == "server_time_zone" || $currentTimeZone == NULL || $currentTimeZone == ""){
            
            $server_time = ini_get('date.timezone');
            date_default_timezone_set($server_time);
            
        }else{
            
            date_default_timezone_set($currentTimeZone); 
            
        }
        
    }
    
    
  
}


/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * | This core function responsible responsible  for returning the     |
 * | lower case first.                                                 |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */
if(function_exists('lcfirst') === false) {
    function lcfirst($str) {
        $str[0] = strtolower($str[0]);
        return $str;
    }
}

?>
