/**
Custom module for you to write your own javascript functions
**/
var UserRoles = function () {

	var elem_block_loadding;
	var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                $(".btn-delete").on("click", function() {

                    var id      = $(this).closest('[data-id]').data("id");
                    var name    = $(this).closest('[data-name]').data("name");

                    $("#id").attr("value", id);
                    $("#modal_delete_id").text(id);
                    $("#modal_delete_name").text(name);

                });

                $(".btn_modal_delete").on("click", function() {

                    $(".delete_form").submit();
                });

                $(".btn-edit").on("click", function() {

                    var id          = $(this).closest('[data-id]').data("id");
                    var username    = $(this).closest('[data-username]').data("username");
                    var fullname    = $(this).closest('[data-fullname]').data("fullname");
                    var email       = $(this).closest('[data-email]').data("email");
                    // var roles       = $(this).closest('[data-email]').data("roles");

                    $("#id").attr("value", id);
                    $("#modal_update_id").text(id);
                    $("#modal_update_username").text(username);
                    $("#modal_update_fullname").text(fullname);
                    $("#modal_update_email").text(email);
                    // $("#modal_update_roles").text(roles);
                });

                $(".btn_modal_update").on("click", function() {

                    $(".update_form").submit();
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