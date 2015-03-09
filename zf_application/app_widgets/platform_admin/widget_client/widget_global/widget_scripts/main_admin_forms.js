<script type="text/javascript" >

    var OutletEntities = function(){
        
        //Here we process school locality.
        var agencyTypeCodes = function ($absolute_path, $separator){
            
            //This is the code that generates the actual locality dropdown
            $('.agencyTypeCode').change(function(){
                
                var processAgencyEntities = $absolute_path + "platform_admin" + $separator + "processOutletInformation" + $separator + "findAgencyEntities";
                var agencyTypeCode = $("#agencyTypeCode").val();
                
                //alert(agencyTypeCode+"-"+processAgencyEntities);

                $.ajax({
                    type: "POST",
                    url: processAgencyEntities,
                    data: {agencyTypeCode: agencyTypeCode},
                    cache: false,
                    success: function(html) {
                       $("#agencyEntity").html(html);
                    }
                });
                
                //var mobileMoney = agencyTypeCode.split("[`^`]"); 
                
                //if(mobileMoney[1] === "MobileMoney"){
                    //alert(mobileMoney[1]);
                //}

            });
            
        }
        
           
       var outletDataEntities = function ($absolute_path, $separator){
            //This is the code that generates the actual locality dropdown
            $('.outletCountry').change(function(){
                
                var processLocality = $absolute_path + "platform_admin" + $separator + "processOutletInformation" + $separator + "outletLocality";
                var countryCode = $("#outletCountry").val();
                
                //alert(countryCode+"-"+processLocality);

                $.ajax({
                    type: "POST",
                    url: processLocality,
                    data: {countryCode: countryCode},
                    cache: false,
                    success: function(html) {
                       $("#outletLocality").html(html);
                    }
                });   

            });
            
               
        }
        
        var processCommissionForm = function (){
             //This function is only for hiding and showing the value or the proportion section of the form.
             
             $("#commissionValue, #commissionProportion, #commissionValueConfirm, #commissionProportionConfirm").hide(); $("#commissionValueRadio, #commissionProportionRadio").attr("checked", false);
             
             //Get the radio button that has been checked.
             $("#commissionValueRadio").click(function(){
                 
                 //Ensure that the commissions proportions form is hidden
                 $("#commissionProportionRadio").attr("checked", false); $("#commissionProportion, #commissionProportionConfirm").hide();
                 
                 //Show the commissions values form.
                 $("#commissionValue, #commissionValueConfirm").fadeIn(1500);
                 
             });
             
             $("#commissionProportionRadio").click(function(){
                 
                 //Ensure that the commissions values form is hidden
                 $("#commissionValueRadio").attr("checked", false); $("#commissionValue, #commissionValueConfirm").hide();
                 
                 //Show the commissions proportions form.
                 $("#commissionProportion, #commissionProportionConfirm").fadeIn(1500);
                 
             });
             
        }
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "outletSetup_form" || $current_view === "new_transaction_form" || $current_view === "commission_setup_form" || $current_view === "edit_transaction_form"){

                    outletDataEntities($absolute_path, $separator);
                    agencyTypeCodes($absolute_path, $separator);

                }
                
                if($current_view === "commission_setup_form"){
                    
                    processCommissionForm();
                    
                }

            }

        };  
        
    }(); 
    
    
    var OutletCodes = function(){
        
        //Here we process school locality.
        var outletcode = function ($absolute_path, $separator){
            
            $('.outletOptions').change(function(){
                
                var processOutletCodes = $absolute_path + "platform_admin" + $separator + "processOutletInformation" + $separator + "outletCode";
                var outletOptions = $("#outletOptions").val();
                
                //alert(countryCode+"-"+processLocality);

                $.ajax({
                    type: "POST",
                    url: processOutletCodes,
                    data: {outletOptions: outletOptions},
                    cache: false,
                    success: function(html) {
                       $("#outletName").html(html);
                    }
                });   

            });
               
        }
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "new_transaction_form"){

                    outletcode($absolute_path, $separator);

                }

            }

        };  
        
    }(); 
    
    
    var CustomerDetails = function(){
        
        //Here we process school locality.
        var customerDetailsForm = function ($absolute_path, $separator){
            
            $('#customerId').keypress(function(){
                
                setTimeout(function(){
                    
                    var processCustomerDetails = $absolute_path + "platform_admin" + $separator + "processCustomerInformation";
                    var customerId = $('#customerId').val();
                    
                    
                    $.ajax({
                        type: "POST",
                        url: processCustomerDetails,
                        data: {customerId: customerId},
                        cache: false,
                        success: function(html) { 
                            
                           if(html == "show_old_form"){
                 
                                $("#selectedCustomerForm").fadeOut(20);
                                $('#oldCustomerForm').fadeIn(20);
                                
                            }else{
                                
                                $('#oldCustomerForm').remove();
                                $("#selectedCustomerForm").fadeIn(25, function(){
                                    
                                    $("#selectedCustomerForm").html(html);
                                    
                                });
                                
                                
                            }
                            
                        }
                    });
                    
                    
                }, 10);
                
            });
               
        }
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "new_transaction_form"){

                    customerDetailsForm($absolute_path, $separator);

                }

            }

        };  
        
    }(); 
    
    
    
    var EditTransactions = function(){
        
        //Here we process school locality.
        var transactionReference = function ($absolute_path, $separator){
            
            $('.zippo-outlet').hide();
            
            $('.ref-button').click(function(){
                
                var processReferenceCode = $absolute_path + "platform_admin" + $separator + "processOutletInformation" + $separator + "transactionReference";
                var referenceCode = $("#referenceCode").val(); var outletCode = $("#outletCode").val();

                $.ajax({
                    type: "POST",
                    url: processReferenceCode,
                    data: {referenceCode: referenceCode, outletCode: outletCode},
                    cache: false,
                    success: function(html) {
                       $("#editTransactionForm").html(html);
                    }
                });   

            });
               
        }
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "edit_transaction_form"){

                    transactionReference($absolute_path, $separator);

                }

            }

        };  
        
    }(); 
    
    
    var TrialTransaction = function(){
        
        var editTrialTransaction = function ($absolute_path, $separator){
               
//            $('.transactionID').change(function(){
//                
//                var processTransactionId = $absolute_path + "platform_admin" + $separator + "processOutletInformation" + $separator + "trialTransaction";
//                var transactionId = $("#transactionID").val();
//                
//                $.ajax({
//                    type: "POST",
//                    url: processTransactionId,
//                    data: {transactionId: transactionId},
//                    cache: false,
//                    success: function(html) {
//                       $("#prefilledTrialTransactionForm").html(html);
//                    }
//                });   
//
//            });

            $('#transactionID').keypress(function(){
                
                var userid = $(this);
                
                setTimeout(function(){
                    
                    var processTransactionId = $absolute_path + "platform_admin" + $separator + "processOutletInformation" + $separator + "trialTransaction";
                    var transactionId = $("#transactionID").val();
                    
                    
                    $.ajax({
                        type: "POST",
                        url: processTransactionId,
                        data: {transactionId: transactionId},
                        cache: false,
                        success: function(html) {
                            
                           if(html == "show_old_form"){
                 
                                $("#prefilledTrialTransactionForm").fadeOut(20);
                                $('#oldTrialForm').fadeIn(20);
                                
                            }else{
                                
                                $('#oldTrialForm').remove();
                                $("#prefilledTrialTransactionForm").fadeIn(25, function(){
                                    
                                    $("#prefilledTrialTransactionForm").html(html);
                                    
                                });
                                
                            }
                         
                        }
                        
                        
                    });
                    
                    
                }, 10);
                
                
            });
               
        }
               
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "transaction_trial_form"){

                    editTrialTransaction($absolute_path, $separator);

                }

            }

        };  
        
    }(); 
    
    
    var SelectedOptions = function(){
        
        //Here we process subject options.
        var user_options = function ($absolute_path, $separator){
            
            $('.userOptions').change(function(){
                
                var processUserOption = $absolute_path + "platform_admin" + $separator + "processUsersAndAgencyInformation" + $separator + "edit_admin_users";
                var userIdentificationCode = $("#userOptions").val();
                
                //alert(countryCode+"-"+processLocality);

                $.ajax({
                    type: "POST",
                    url: processUserOption,
                    data: {userIdentification: userIdentificationCode},
                    cache: false,
                    success: function(html) {  
                       $("#selectedUserForm").fadeIn(4000, function(){
                           $("#selectedUserForm").html(html);
                       });
                    }
                });   

            });
            
            $('.deleteUserOptions').change(function(){
                
                var processDeleteUserOption = $absolute_path + "platform_admin" + $separator + "processUsersAndAgencyInformation" + $separator + "delete_admin_users";
                var deleteUserIdentificationCode = $("#deleteUserOptions").val();

                $.ajax({
                    type: "POST",
                    url: processDeleteUserOption,
                    data: {userIdentification: deleteUserIdentificationCode},
                    cache: false,
                    success: function(html) {  
                       $("#deleteUserForm").fadeIn(4000, function(){
                           $("#deleteUserForm").html(html);
                       });
                    }
                });   

            });
            
        }
        
        //Here we process subject options.
        var agent_type_options = function ($absolute_path, $separator){
            
            $('.agentTypesOptions').change(function(){
                
                var processAgentTypesOption = $absolute_path + "platform_admin" + $separator + "processUsersAndAgencyInformation" + $separator + "getAgentTypeForm";
                var agentTypeName = $("#agentTypesOptions").val();

                $.ajax({
                    type: "POST",
                    url: processAgentTypesOption,
                    data: {agentTypeName: agentTypeName},
                    cache: false,
                    success: function(html) {  
                       $("#selectedAgentTypeForm").fadeIn(4000, function(){
                           $("#selectedAgentTypeForm").html(html);
                       });
                    }
                });   

            });
        }
        
        //Here we process subject options.
        var outlet_type_options = function ($absolute_path, $separator){
            
            $('.outletTypesOptions').change(function(){
                
                var processOutletTypesOption = $absolute_path + "platform_admin" + $separator + "processUsersAndAgencyInformation" + $separator + "getOutletTypeForm";
                var outletTypeName = $("#outletTypesOptions").val();

                $.ajax({
                    type: "POST",
                    url: processOutletTypesOption,
                    data: {outletTypeName: outletTypeName},
                    cache: false,
                    success: function(html) {  
                       $("#selectedOutletTypeForm").fadeIn(4000, function(){
                           $("#selectedOutletTypeForm").html(html);
                       });
                    }
                });   

            });
        }
        
        
         //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "manage_users"){

                    user_options($absolute_path, $separator);

                }else if($current_view === "zippo_setup"){
                    
                    agent_type_options($absolute_path, $separator);
                    outlet_type_options($absolute_path, $separator);
                    
                }
            }

        };  
        
    }();
    
</script>


