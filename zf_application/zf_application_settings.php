<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE APPLICATION SETTINGS FILE. ALL THE SETTINGS ARE DONE ON THIS 
 * FILES BY THE APPLICATION DEVELOPER. 
 * -----------------------------------------------------------------------------
 *
 * @author Mathew Juma O. (ATHIAS AVIANS) <mathew@headsafrica.com>
 * @time  12th/August/2013  Time: 12:20 EMT
 * @link http://www.zilasframework.com/
 * @copyright Copyright &copy; 2013 Zilas Software LLC
 * @license http://www.zilasframework.com/license/
 * @version 1.01 Final
 * @since version 1.01 Final - 11th/August/2013
 * 
 */


/**
 * -----------------------------------------------------------------------------
 * THESE ARE CONSTANTS FOR CONFIGURING, APPLICATION FOLDER PATH, APPLICATION
 * NAME, and ALSO APPLICATION LOGO PATH
 * -----------------------------------------------------------------------------
 */
    @define('APPLICATION_FOLDER'     , 'zippo/');
    @define('APPLICATION_NAME'       , 'Zippo Float Management System');
    @define('APPLICATION_LOGO'       , 'zf_client/zf_app_global/app_global_files/app_global_images/zeepo.png');
    @define('APPLICATION_COPYRIGHT'  , '<span style="font-family: ProximaNova-Light !important; font-size: 14px !important;">&copy;</span>'.date('Y').',&nbsp;Zeepo Management System. All Rights Reserved.');
    @define("DATE_FORMAT"            , date('Y-m-d H:i:s'));
    
    
/**
 * -----------------------------------------------------------------------------
 * THIS CONSTANT HOLDS THE STATUS OF THE APPLICATION i.e Enabled or Disabled
 * -----------------------------------------------------------------------------
 */
    @define('APPLICATION_STATUS'     , 'enabled');
 
    
/**
 * -----------------------------------------------------------------------------
 * THIS CONSTANT HOLDS THE CONSTRUCTION INDICATOR i.e default or custom
 * -----------------------------------------------------------------------------
 */
    @define('CONSTRUCTION_INDICATOR' , 'default');
    
    
/**
 * -----------------------------------------------------------------------------
 * THIS CONSTANT HOLDS DEFAULT APPLICATION CONTROLLER, WHICH IS THE ENTRY
 * CONTROLLER IF THE "first" URL PARAMETER IS EMPTY.
 * -----------------------------------------------------------------------------
 */
    @define('DEFAULT_CONTROLLER'     , 'initialize-controller');
    
/**
 * -----------------------------------------------------------------------------
 * THIS CONSTANT SETS THE PREFERRED TIME ZONE SO AS TO OVER-RIDE THE DEFAULT
 * SERVER TIME ZONE SET IN php.ini
 * 
 * Accepted parameters are: 'Avalid time zone' or 'server_time_zone' or ''
 * The default value is: "server_time_zone"
 * -----------------------------------------------------------------------------
 */
    @define('TIME_ZONE' , 'Africa/Nairobi');    
    
    
/**
 * -----------------------------------------------------------------------------
 * THESE ARE CONSTANTS FOR CONFIGURING COMMON APPLICATION DEFAULTS, can either
 * be "enabled" or "disabled". 
 * -----------------------------------------------------------------------------
 */
    @define('APPLICATION_SEO'          , 'enabled');
    @define('APPLICATION_CACHING'      , 'disabled');
    @define('APPLICATION_URLENCRYPT'   , 'enabled');
    @define('APPLICATION_ENCRYPTION'   , 'enabled');
    @define('APPLICATION_DECRYPTION'   , 'enabled');
    @define('APPLICATION_FUSIONCHARTS' , 'enabled');
    @define('APPLICATION_PHPGRID'      , 'enabled');
    
    
/**
 * -----------------------------------------------------------------------------
 * THESE ARE CONSTANTS FOR CONFIGURING DEFAULT APPEAREANCE OF BREADCRUMBS, can 
 * either be "enabled" or "disabled". 
 * -----------------------------------------------------------------------------
 */
    @define('APPLICATION_BREADCRUMBS',  'enabled');
    @define('BREADCRUMBS_SYMBOL'     ,  ' | ');
    
    
 /**
  * -----------------------------------------------------------------------------
  * THESE ARE CONSTANTS FOR DATABASE CONFIGURATION, THESE DETAILS CAN BE CHANGED
  * DEPENDING ON THE DATABASE CONNECTION ESTABLISHED 
  * 
  *  USE VALID DATABASE DRIVER INCLUDING: access, ado_access, ado_mssql, db2,
  *  fbsql (FrontBase), firebird, ibase, idap, informix, mssql, mysql, odbc,
  *  odbc_db2, odbc_mssql, odbc_oracle, oracle, oci8, pdo, postgres,
  *  postgres7,  postgres8, postgres9,  postgres64, sqlanywhere, sqlite, 
  *  vfp (Visual Fox Pro)
  * -----------------------------------------------------------------------------
  */  
    @define("DATABASE_HOST"          ,  "127.0.0.1");
    @define("DATABASE_USERNAME"      ,  "root");
    @define("DATABASE_PASSWORD"      ,  "root");
    @define("DATABASE_DRIVER"        ,  "mysql");  
    @define("DATABASE_NAME"          ,  "zippo");
    @define("CHARACTER_SET"          ,  "utf8");
    @define("CONNECTION_TYPE"        ,  false);
    @define("DATABASE_DEBUG"         ,  false);
    
    
 /**
  * -----------------------------------------------------------------------------
  * THESE ARE CONSTANTS FOR THE CONFIGURATION OF AN SMTP MAIL SERVER. THIS IS 
  * NECESSARY IF YOU ARE USING A SPECIFIC MAIL SERVER IN SENDING YOUR EMAILS TO
  * PARTICULAR ENTITIES.
  * 
  * -----------------------------------------------------------------------------
  */  
    @define("SMTP_MAIL_SERVER"       ,  "disabled");//enabled or disabled
    @define("SMTP_SERVER_HOST"       ,  "");    //e.g. smtp1.example.com;smtp2.example.com
    @define("SMTP_SERVER_AUTH"       ,  "");    //true or false
    @define("SMTP_SERVER_USERNAME"   ,  "");    //smtpusername
    @define("SMTP_SERVER_PASSWORD"   ,  "");    //smtppassword
     

?>
