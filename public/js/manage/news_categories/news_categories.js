/**
Custom module for you to write your own javascript functions
**/
var NewsCategories = function () {

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
                    content: {
                        required: true,
                        maxlength: 2000
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