/**
Custom module for you to write your own javascript functions
**/
var Bank = function () {

    var elem_block_loadding;
    var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-action-bank');
                var rules = {

                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 200,
                    },
                    agency: {
                        required: true,
                        minlength: 3,
                        maxlength: 200,
                    },
                    account_number: {
                        required: true,
                        maxlength: 20
                    },
                    account_holder: {
                        required: true,
                        maxlength: 50,
                    },
                    description: {
                        maxlength: 500,
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