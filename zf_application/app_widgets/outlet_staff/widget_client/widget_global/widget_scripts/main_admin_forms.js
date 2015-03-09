<script type="text/javascript" >

    var OutletLocations = function(){
        
        //Here we process school locality.
        var outletLocality = function ($absolute_path, $separator){
            
            $('.outletCountry').change(function(){
                
                var processLocality = $absolute_path + "platform_admin" + $separator + "processOutletInformation" + $separator;
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
        
        
        //Here we initialize all the above functions
        return { 

            init:function($current_view, $absolute_path, $separator){

                if($current_view === "outletSetup_form"){

                    outletLocality($absolute_path, $separator);

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
    
</script>


