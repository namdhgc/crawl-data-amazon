/**
Custom module for you to write your own javascript functions
**/
var Product = function () {

	var elem_block_loadding;
	var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-action-add-product');
                var rules = {

                    code: {
                        required: true,
                        minlength: 1,
                        maxlength: 200
                    },
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },
                    slug: {
                        required: true,
                        minlength: 3,
                        maxlength: 150
                    },
                    category: {
                        required: true,
                        number: true,
                    },
                    description: {
                        maxlength: 2000
                    },
                    media_id: {
                        required: true,
                        maxlength: 500
                    },
                    tag: {
                        maxlength: 100
                    },
                    price: {
                        required: true,
                        number: true,
                    },
                    original_price: {
                        required: true,
                        number: true,
                    },
                    type: {
                        number: true,
                    },
                    status: {
                        number: true,
                    },
                    sale: {
                        number: true,
                    },
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