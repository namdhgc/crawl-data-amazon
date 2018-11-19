/**
Custom module for you to write your own javascript functions
**/
var GroupCustomer = function () {

    var elem_block_loadding;
    var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-action');
                var rules = {

                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    price_list_id: {
                        required: true
                    },
                    payment_type_id: {
                        required: true
                    }
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