/**
Custom module for you to write your own javascript functions
**/
var RegisterUser = function () {

	var elem_block_loadding;
	var elm_active;

    var openModal = function (data) {

        $("#dang-ky-tai-khoan").modal();
        var msg = '';

        for (var key in data['meta']['msg']) {
            msg += key + ": " + data['meta']['msg'][key];
            msg += "<br>";
        }

        $("#modal_error").html(msg);
        $("#modal_error").prop("style", "display: block");
        

    };

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-register-user');
                var rules = {

                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength: 100
                    },
                    retypePassword: {
                        equalTo : "#password"
                    },
                    fullName: {
                        required: true,
                        maxlength: 100
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 100
                    },
                    phone_number: {
                        required: true,
                        minlength: 9,
                        maxlength: 20
                    },
                    hiddenRecaptcha: {
                         required: function () {
                             if (grecaptcha.getResponse() == '') {
                                 return true;
                             } else {
                                 return false;
                             }
                         }
                     }
                }
                Validate.base_validate(form, rules);
            });
        },

        custom: function(data) {
            openModal(data);
        },
    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();