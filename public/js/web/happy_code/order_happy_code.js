/**
Custom module for you to write your own javascript functions
**/
var OrderHappyCode = function () {

    var elem_block_loadding;
    var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-order-happy-code');
                var rules = {

                    payment_type: {
                        required: true,
                    },
                    happy_code_type: {
                        required: true,
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