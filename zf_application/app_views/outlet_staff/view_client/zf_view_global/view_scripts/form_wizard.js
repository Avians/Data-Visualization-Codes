var FormWizard = function () {


    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            function format(state) {
                if (!state.id) return state.text; // optgroup
                return "<img class='flag' src='assets/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }

            $("#country_list").select2({
                placeholder: "Select",
                allowClear: true,
                formatResult: format,
                formatSelection: format,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                rules: {
                    
                    //Outlet Details [outlet Form]
                    outletRegion: {
                        maxlength: 60,
                        minlength: 5,
                        required: true
                    },
                    outletName: {
                        maxlength: 60,
                        minlength: 5,
                        required: true
                    },
                    outletEmail: {
                        maxlength: 60,
                        minlength: 5,
                        required: true,
                        email: true
                    },
                    outletPhoneNumber: {
                        maxlength: 20,
                        minlength: 5,
                        required: true
                    },
                    outletMobileNumber: {
                        maxlength: 20,
                        minlength: 10,
                        required: true
                    },
                    outletAddress: {
                        maxlength: 30,
                        minlength: 2,
                        required: true
                    },
                    outletCountry: {
                        required: true
                    },
                    outletLocality: {
                        required: true
                    },
          
        
                   //Admin Details [outlet Form]
                    adminDesignation: {
                        required: true
                    },
                    adminId: {
                        maxlength: 30,
                        minlength: 5,
                        required: true
                    },
                    adminFirstName: {
                        maxlength: 30,
                        minlength: 2,
                        required: true
                    },
                    adminLastName: {
                        maxlength: 30,
                        minlength: 2,
                        required: true
                    },
                    adminEmailAddress: {
                        maxlength: 60,
                        minlength: 5,
                        required: true,
                        email: true
                    },
                    adminMobileNumber: {
                        maxlength: 20,
                        minlength: 10,
                        required: true
                    },
                    adminAddress: {
                        required: true
                    },
                    adminGender: {
                        required: true
                    },
                    adminPassword: {
                        maxlength: 30,
                        minlength: 5,
                        required: true
                    },
                    adminRe_password: {
                        maxlength: 30,
                        minlength: 5,
                        required: true,
                        equalTo: "#adminPassword"
                    },
                    
                   //Transaction Details [Transaction Form]
                    transactionOutlet: {
                        required: true
                    },
                    transactionFirstName: {
                        maxlength: 60,
                        minlength: 2,
                        required: true
                    },
                    transactionLastName: {
                        maxlength: 60,
                        minlength: 2,
                        required: true
                    },
                    transactionIdNumber: {
                        maxlength: 60,
                        minlength: 2,
                        required: true
                    },
                    transactionMobileNumber: {
                        maxlength: 20,
                        minlength: 5,
                        required: true
                    },
                    transactionAmount: {
                        maxlength: 7,
                        minlength: 2,
                        required: true
                    },
                    transactionType: {
                        required: true
                    },
                    transactionReference: {
                        maxlength: 20,
                        minlength: 3,
                        required: true
                    }
                    
                    
                },

                messages: { // custom messages for radio buttons and checkboxes
                    'adminGender': {
                        required: "Select at one option",
                        minlength: jQuery.format("Select at one option")
                    }
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "adminGender") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#adminGender_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    App.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "adminGender") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    success.show();
                    error.hide();
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                    form.submit();
                }

            });

            var displayConfirm = function() {
                $('#confirmInfo .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment') {
                        var payment = [];
                        $('[name="payment[]"]').each(function(){
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#new_transaction_form, #new_outlet_form')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#new_transaction_form, #new_outlet_form')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#new_transaction_form, #new_outlet_form').find('.button-previous').hide();
                } else {
                    $('#new_transaction_form, #new_outlet_form').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#new_transaction_form, #new_outlet_form').find('.button-next').hide();
                    $('#new_transaction_form, #new_outlet_form').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#new_transaction_form, #new_outlet_form').find('.button-next').show();
                    $('#new_transaction_form, #new_outlet_form').find('.button-submit').hide();
                }
                App.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#submit_form').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    handleTitle(tab, navigation, clickedIndex);
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#new_transaction_form, #new_outlet_form').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#submit_form').find('.button-previous').hide();
            $('#submit_form .button-submit').click(function () {
                
                //form.submit();
                
            }).hide();
        }

    };

}();