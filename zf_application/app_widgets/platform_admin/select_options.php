<?php

   if($zf_externalWidgetData == "editUserAdmins" || $zf_externalWidgetData == "deleteUserAdmins"){
       
       $zf_model_data->zvss_buildUserOptions(); //This is builds the user dropdown list
       
   }else if($zf_externalWidgetData == "agentTypeForm"){
       
       $zf_model_data->zvss_buildAgentTypeOptions(); //This is builds the agents dropdown list
       
   }else if($zf_externalWidgetData == "outletTypeForm"){
       
       $zf_model_data->zvss_buildOutletTypeOptions(); //This is builds the outlets dropdown list
       
   }else if($zf_externalWidgetData == "editTrialTransaction"){
       
       $zf_model_data->zvss_buildTransactionIdOptions(); //This is builds the outlets dropdown list
       
   }
   
  
?>