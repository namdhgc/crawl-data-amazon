/**
Custom module for you to write your own javascript functions
**/
var Department = function () {

	var elem_block_loadding;
	var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-action-department');
                var rules = {

                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    slug: {
                        minlength: 3,
                        maxlength: 150
                    },
                    description: {
                        maxlength: 500
                    }
                }
                Validate.base_validate(form, rules);



                $(".btn-delete").on("click", function() {

                    var id      = $(this).closest('[data-id]').data("id");
                    var name    = $(this).closest('[data-name]').data("name");
                    var slug    = $(this).closest('[data-slug]').data("slug");
                    var status  = $(this).closest('[data-status]').data("status");

                    $("#id").attr("value", id);
                    $("#modal_id").text(id);
                    $("#modal_name").text(name);
                    $("#modal_slug").text(slug);
                    $("#modal_status").text(status);

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