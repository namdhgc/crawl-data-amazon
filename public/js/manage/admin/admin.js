/**
Custom module for you to write your own javascript functions
**/
var ManagerAdmin = function () {

	var elem_block_loadding;
	var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-add-new');
                var rules = {

                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 75
                    },
                    password: {
                        maxlength: 100,
                        minlength: 3,
                        required: true
                    },
                    roles: {
                        required: true,
                        number: true
                    },
                    email: {
                        maxlength: 100,
                        required: true,
                        email: true
                    },
                    first_name: {
                        maxlength: 100,
                        required: true
                    },
                    last_name: {
                        maxlength: 100,
                        required: true
                    },
                    phone_number: {
                        maxlength: 20,
                        minlength: 3,
                        required: true
                    },
                    address: {
                        maxlength: 100,
                        minlength: 3,
                        required: true
                    },
                }
                Validate.base_validate(form, rules);
            });
        },

    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();