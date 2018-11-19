/**
Custom module for you to write your own javascript functions
**/
var News = function () {

	var elem_block_loadding;
	var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-upload-news');
                var rules = {

                    title: {
                        required: true,
                        minlength: 3,
                        maxlength: 500
                    },
                    image: {
                        required: true
                    },
                    category_id: {
                        required: true
                    },
                    lang_code: {
                        required: true
                    },
                    sub_description: {
                        required: true,
                        maxlength: 10000
                    },
                    description: {
                        required: true,
                        maxlength: 10000
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