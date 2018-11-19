/**
Custom module for you to write your own javascript functions
**/
var Category = function () {

    var elem_block_loadding;
    var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-action-category');
                var rules = {

                    name: {
                        required: true,
                        minlength: 5,
                        maxlength: 45
                    },
                    slug: {
                        minlength: 5,
                        maxlength: 150,
                    },
                    remake: {
                        maxlength: 200,
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