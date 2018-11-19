/**
Custom module for you to write your own javascript functions
**/
var FrequentlyAskedQuestions = function () {

    var elem_block_loadding;
    var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-add-edit-frequently-asked-questions');
                var rules = {

                    question: {
                        required: true,
                        minlength: 3,
                        maxlength: 500
                    },
                    answer: {
                        required: true,
                        minlength: 3,
                        maxlength: 500
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