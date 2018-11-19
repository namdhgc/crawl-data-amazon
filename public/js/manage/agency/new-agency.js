/**
Custom module for you to write your own javascript functions
**/
var NewAgency = function () {

	var elem_block_loadding;
	var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-action-add-agency');
                var rules = {

                    name: {
                        required: true,
                        minlength: 5,
                        maxlength: 200
                    },
                    phone_number: {
                        maxlength: 20,
                        number: true,
                        required: true
                    },
                    address: {
                        maxlength: 200,
                        required: true
                    },
                    country: {
                        maxlength: 200,
                        required: true
                    }
                }
                Validate.base_validate(form, rules);
            });
        },

        custom: function() {
            $(document).ready(function() {

                $(".btn-delete").on("click", function() {

                    var id              = $(this).closest('[data-id]').data("id");
                    var name            = $(this).closest('[data-name]').data("name");
                    var phone_number    = $(this).closest('[data-phone_number]').data("phone_number");
                    var address         = $(this).closest('[data-address]').data("address");
                    var country         = $(this).closest('[data-country]').data("country");

                    $("#id").attr("value", id);
                    $("#modal_id").text(id);
                    $("#modal_name").text(name);
                    $("#modal_phone_number").text(phone_number);
                    $("#modal_address").text(address);
                    $("#modal_country").text(country);

                });

                $(".btn_modal_delete").on("click", function() {

                    $(".delete_form").submit();
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