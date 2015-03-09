<?php

/**
 * -----------------------------------------------------------------------------
 * THIS IS THE GUEST DETAILS MODEL, ESSENTIAL FOR RETURNING ALL THE GUEST DETAILS
 * FOR A PARTICULAR USER BASED ON THE USER ROLE.
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

/*
 * ---------------------------------------------------------------------
 * |                                                                   |
 * |  This the Guest details Model which is responsible responsible for        |
 * |  handling all logics that are related to the template Controller  |
 * |                                                                   |
 * ---------------------------------------------------------------------
 */
class Guest_details_Model extends Zf_Model {

    private $_errorResult = array();
    private $_validResult = array();

    /*
     * --------------------------------------------------------------------------------------
     * |                                                                                    |
     * |  The is the main class constructor. It runs automatically within any class object  |
     * |                                                                                    |
     * --------------------------------------------------------------------------------------
     */

    public function __construct(){

        parent::__construct();
    }

    
    /**
     * This method is used to construct a table with all the guest details.
     */
    public function GuestDetails(){
        
        $userInfo = Zf_SessionHandler::zf_getSessionVariable('userInfo');

        $guestValues['registeringId'] = Zf_QueryGenerator::SQLValue($userInfo[nationalId]);
        
        if($userInfo['userRole'] == SUPER_ADMIN){
            
          $getGuestDetails = Zf_QueryGenerator::BuildSQLSelect('zgb_guests');
           
        }else{
            
           //$getGuestDetails = Zf_QueryGenerator::BuildSQLSelect('zgb_guests', $guestValues);
           $getGuestDetails = Zf_QueryGenerator::BuildSQLSelect('zgb_guests', $guestValues, "", "id", $sortDescending);
           
        }
        
        $executeGuestDetails = $this->Zf_AdoDB->Execute($getGuestDetails);
        
        if (!$executeGuestDetails){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
        
        }else{
            
            echo "<table border='1px' >";
            echo "<tr><th>Id</th><th>First Name</th><th>Last Name</th><th>Gender</th><th>Mobile No.</th><th>Email Address</th><th>Box Address</th><th>Residence City</th><th>Counrty</th></tr>";
            while (!$executeGuestDetails->EOF) {

                echo '<tr><td>' . $executeGuestDetails->fields[0] .  '</td><td>' . $executeGuestDetails->fields[3] .  '</td><td>' . $executeGuestDetails->fields[4] .  '</td><td>' . $executeGuestDetails->fields[5] .  '</td><td>' . $executeGuestDetails->fields[6] .  '</td><td>' . $executeGuestDetails->fields[1] .  '</td><td>' . $executeGuestDetails->fields[7] .  '</td><td>' . $executeGuestDetails->fields[8] .  '</td><td>' . $executeGuestDetails->fields[9] .  '</td></tr>';

                $executeGuestDetails->MoveNext();
            }
            echo "</table>";
            
        }
        
    }
    
    
    /**
     * This method is used to generate the charts that depict the guest gender. 
     */
    public function GuestGender(){
        
        $maleGuests['gender'] = Zf_QueryGenerator::SQLValue("Male");
        $femaleGuests['gender'] = Zf_QueryGenerator::SQLValue("Female");
        
        $selectColumns = array('gender');
        
            
        $getMaleGuests   = Zf_QueryGenerator::BuildSQLSelect('zgb_guests', $maleGuests, $selectColumns);
        $getFemaleGuests = Zf_QueryGenerator::BuildSQLSelect('zgb_guests', $femaleGuests, $selectColumns);
        
        $executeMaleGuests   = $this->Zf_AdoDB->Execute($getMaleGuests);
        $executeFemaleGuests = $this->Zf_AdoDB->Execute($getFemaleGuests);
        
        if (!$executeMaleGuests){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
                
            $maleCount = $executeMaleGuests->RecordCount();
            
        }
        
        if (!$executeFemaleGuests){
            
            echo "<strong>Query Execution Failed:</strong> <code>" . $this->Zf_AdoDB->ErrorMsg() . "</code>";
            
        }else{
            
            $femaleCount = $executeFemaleGuests->RecordCount();
            
        }
        
        $strXML  = "";
        $strXML .= "<chart bgColor='transparent' bgAlpha='50' showBorder='0' canvasBgColor='transparent'
            canvasBorderColor='efefef' canvasBorderThickness='1' canvasBorderAlpha='80' canvasBorder='0'
            xAxisName='Gender' yAxisName='Total Count' showValues='1' formatNumberScale='0' palette='1'
            showlegend='1' enablesmartlabels='0' showlabels='0' showpercentvalues='1' pieRadius='70'
            paletteColors='FF5904,0372AB' paletteThemeColor='6699FF' showToolTip='1' showToolTipShadow='1'>";
        $strXML .= "<set label='Male' value=' ".$maleCount." ' tooltext=' Total male count: ".$maleCount.",{br}Click for a detailed{br}information '  link=' ' />";
        $strXML .= "<set label='Female' value=' ".$femaleCount." ' tooltext='Total female count: ".$femaleCount.",{br}Click for a detailed{br}information '  link=' ' />";
        $strXML .= "
                    <styles>
                        <definition>
                              <style name='myToolTipFont' type='font' font='ProximaNova-Light' size='11' color='87b6d9'/>
                        </definition>
                        <application>
                              <apply toObject='ToolTip' styles='myToolTipFont' />
                        </application>
                    </styles> 

                   ";
        $strXML .= "</chart>";

        return $strXML;
         
    }
    
}
?>
