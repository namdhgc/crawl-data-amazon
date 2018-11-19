/**
Custom module for you to write your own javascript functions
**/
var Roles = function () {

	var elem_block_loadding;
	var elm_active;
    var array_permission    = [];
    var roles_id            = null;
    var module_id           = null;


    var callBack_update_permission = function(data) {

        var theme   = '';
        var heading = '';
        var message = '';

        if (data.meta.success) {

            theme   = 'teal'; // blue color
            heading = 'Success';
            message = 'Congratulation';

        } else {

            theme   = 'ruby'; // red color
            heading = 'Error';
            message = 'Something wrong!';
        }

        ui_notification(theme, heading, message);
    };

    var callBack_get_permission_roles = function(data) {

        $('input:checkbox').removeAttr('checked');

        if (data.meta.success) {

            var item = data.response;

            $.each(item, function(key, item){

                var tr = $('tr[data-m-id="'+ item.module_id +'"]').first();
                tr.find('input[data-name="read"]').first().prop('checked', item.read);
                tr.find('input[data-name="write"]').first().prop('checked', item.write);
            });
        }

        $.uniform.update();
    };

    var callBack_delete_roles = function(data) {
        if (data.meta.success) {

        }
    };


    // BEGIN NOTIFICATION
    var ui_notification = function($theme, $heading, $message) {
        var t = {
                theme: $theme, // teal: blue, amethyst: violet, ruby: red, tangerine: orange, lemon: lemon, lime: green, ebony: black, smoke: gray
                sticky: false,
                horizontalEdge: 'top',
                verticalEdge: 'right'
            },
        n = $(this);
        t.heading = $heading, // heading of message
        t.life = 5000,
        $.notific8("zindex", 11500),
        $.notific8($message, t), // message
        n.attr("disabled", "disabled"),
        setTimeout(function() {
            n.removeAttr("disabled")
        }, 1e3)
    };
    // END NOTIFICATION


    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-action-roles');
                var rules = {

                    name: {

                        required: true,
                        minlength: 5,
                        maxlength: 45
                    },
                    remake: {
                        maxlength: 200,
                    }
                }

                Validate.base_validate(form, rules);

                $(document).on('click','.btn-delete-permission', function(e){

                    e.preventDefault();

                    $('#modal-delete-permission-role').modal('show');

                    var id      = $(this).closest('[data-id]').data("id");
                    var name    = $(this).closest('[data-name]').data("name");
                    var status  = $(this).closest('[data-status]').data("status");
                    
                    $("#id").attr("value", id);
                    $("#modal_id").text(id);
                    $("#modal_name").text(name);
                    $("#modal_status").text(status);

                    // console.log(id);

                    $(".btn_modal_delete").on("click", function() {

                        var data = {
                            id: id,
                        };

                        Spr.ajaxDefault('/manager/ajax/delete-roles', data, callBack_delete_roles,$(this));
                    });
                    
                });




                $(document).on('click','.btn-change-permission', function(e){

                    e.preventDefault();

                    $('#modal-permission-role').modal('show');

                    roles_id    = $(this).closest('[data-id]').data("id");

                    var data = {
                        roles_id: roles_id,
                    };

                    Spr.ajaxDefault('/manager/ajax/get-permission', data, callBack_get_permission_roles,$(this));
                });


                $(document).on('change', ".ckb-permission", function() {

                    var module_id   = $(this).attr('data-module_id');
                    var name        = $(this).attr('data-name');

                    if(this.checked) {

                        var temp_array = {
                            'roles_id'  : roles_id,
                            'module_id' : module_id,
                            'name'      : name,
                            'status'    : '1'
                        };

                    } else {

                        var temp_array = {
                            'roles_id'  : roles_id,
                            'module_id' : module_id,
                            'name'      : name,
                            'status'    : '0'
                        };

                    }

                    array_permission.push(temp_array);

                    var data = {
                        data: array_permission,
                    };

                    Spr.ajaxDefault('/manager/ajax/update-permission', data, callBack_update_permission,$(this));

                    array_permission = [];

                    // console.log(temp_array);
                });


                // BEGIN UI BLOCK
                $('.ckb-permission').click(function() {
                    App.blockUI({
                        target: '.modal-content',
                        boxed: true,
                        textOnly: true
                    });

                    window.setTimeout(function() {
                        App.unblockUI('.modal-content');
                    }, 2000);
                });
                // END UI BLOCK

            });
        },

        custom: function() {

        }
    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();