/**
Custom module for you to write your own javascript functions
**/
var PriceList = function () {

	var elem_block_loadding;
	var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-action-price-list');
                var rules = {

                    name: {
                        required: true,
                        minlength: 5,
                        maxlength: 50
                    },
                    type: {
                        required: true
                    },
                    description: {
                        maxlength: 100
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