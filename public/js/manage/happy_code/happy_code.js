/**
Custom module for you to write your own javascript functions
**/
var HappyCode = function () {

    var elem_block_loadding;
    var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-action-happy-code');
                var rules = {

                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 500,
                    },
                    type: {
                        required: true
                    },
                    discount: {
                        required: true,
                        number: true,
                        minlength: 1,
                        maxlength: 2,
                    },
                    status: {
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