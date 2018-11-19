/**
Custom module for you to write your own javascript functions
**/
var HappyCodeOrder = function () {

    var elem_block_loadding;
    var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-action-happy-code-order');
                var rules = {
                    
                    status: {
                        required: true,
                        number: true
                    },
                    amount: {
                        number: true,
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