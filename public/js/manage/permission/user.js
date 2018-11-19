/**
Custom module for you to write your own javascript functions
**/
var User = function () {

	var elem_block_loadding;
	var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-action-register-user');
                var rules = {

                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 75
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 150
                    },
                    password: {
                        required: true,
                        minlength: 6,
                        maxlength: 100
                    },
                    phone_number: {
                        number: true,
                        maxlength: 45
                    },
                    address: {
                        maxlength: 150
                    }
                }
                Validate.base_validate(form, rules);
            });
        }
    };

}();




/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();