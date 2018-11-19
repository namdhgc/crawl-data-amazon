/**
Custom module for you to write your own javascript functions
**/
var Contact = function () {

    var elem_block_loadding;
    var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-action-contact');
                var rules = {

                    email: {
                        required: true,
                        email: true
                    },
                    phone_number: {
                        minlength: 3,
                        maxlength: 20,
                        number: true
                    },
                    title: {
                        required: true,
                        minlength: 3,
                        maxlength: 200,
                    },
                    content: {
                        required: true,
                        minlength: 3,
                        maxlength: 2000,
                    }
                }
                Validate.base_validate(form, rules);

            });
        },

        changeContactStatus: function() {

            var id      = null;
            var status  = null;

            $('.btn-view').click(function() {

                id      = $(this).closest('[data-id]').data("id");
                status  = $(this).closest('[data-status]').data("status");
            });

            $('.btn-cancel').click(function() {

                if (status == 0) {
                    // update status from 0 to 1
                    status      = 1;
                    var token   = $('#token').val();

                    var data = {
                        id: id,
                        status: status,
                        _token: token
                    };

                    var callBack = function(data) {
                        if (data.meta.success) {

                            console.log(data.response);
                            location.reload();
                        } else {

                            console.log(data);
                        }
                    };

                    Spr.ajaxDefault('/manager/ajax/change-contact-status', data, callBack,$(this));

                    
                }
            });
        }
    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();