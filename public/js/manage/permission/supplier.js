/**
Custom module for you to write your own javascript functions
**/
var Supplier = function () {

	var elem_block_loadding;
	var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-action-register-supplier');
                var rules = {

                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 75
                    },
                    code: {
                        minlength: 3,
                        maxlength: 200
                    },
                    slug: {
                        minlength: 3,
                        maxlength: 200
                    },
                    address: {
                        minlength: 3,
                        maxlength: 200
                    },
                    phone_number: {
                        number: true,
                        maxlength: 50
                    },
                    fax: {
                        maxlength: 50
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 150
                    },
                    website: {
                        maxlength: 200
                    },
                    tax_code: {
                        maxlength: 200
                    },
                    description: {
                        maxlength: 500
                    },
                }
                Validate.base_validate(form, rules);


                $('.btn-create-new').click(function(e){

                    console.log('abcasd');
                    e.preventDefault();

                    
                });
            });
        }
    };

}();




/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();