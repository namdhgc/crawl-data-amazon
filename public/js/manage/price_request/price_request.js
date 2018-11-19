/**
Custom module for you to write your own javascript functions
**/
var PriceRequest = function () {

	var elem_block_loadding;
	var elm_active;

    var id              = null;
    var message         = null;
    var processor_id    = null;

    var callBack_update_status_price_request = function(data) {

        if (data.meta.success) {

            // Change button Take into Pending
            var selected_id = data.response.id;
            var tr = $('tr[data-id="'+ selected_id +'"]').first();

            tr.find('td[class="status"]').first().text('1');
            tr.find('button[class="btn btn-xs green btn-take"]').first().prop('disabled', true);
            tr.find('i[class="fa fa-pencil"]').first().removeClass('fa fa-pencil');
            tr.find('button[class="btn btn-xs green btn-take"]').first().removeClass('green').addClass('yellow');
            tr.find('span[class="title-btn-action"]').first().text('Inprogress');

            var link_attr    = {
                'data-toggle' : 'modal',
                'href'        : '#todo-task-modal'
            };

            var node_attr    = {
                'data-id'  : id
            };

            var node        = Spr.createElm("li", "todo-tasks-item", "", node_attr);
            var h4_tag      = Spr.createElm("h4", "todo-inline");
            var a_link      = Spr.createElm("a", "", "", link_attr);
            var text        = Spr.createTextNode(message);

            node.appendChild(h4_tag).appendChild(a_link).appendChild(text);

            document.getElementById("todo-tasks-content").appendChild(node);
        }

    };

    var callBack_check_status_price_request = function(data) {

        if (data.meta.success) {

            if (data.meta.code == 666) {
                // no record with status = 0

                var data = {
                    id: id,
                    processor_id: processor_id
                };

                Spr.ajaxDefault('/manager/ajax/update-status-price-request', data, callBack_update_status_price_request,$(this));

            } else {

                // Change button Take into Pending
                var selected_id = data.response.id;
                var tr = $('tr[data-id="'+ selected_id +'"]').first();

                tr.find('button[class="btn btn-xs green btn-take"]').first().prop('disabled', true);
                tr.find('button[class="btn btn-xs green btn-take"]').first().removeClass('green').addClass('yellow');

            }
        }
    };


    var callBack_get_detail_price_request = function(data) {

        if (data.data.meta.success) {

            var item            = data.data.response.data[0];
            var split_char      = "|";

            var updated_date    = Date("d/m/y", item.updated_at);
            var message         = item.message;
            var str             = item.link;
            // var link            = str.replace(/\|/g , "<br>");
            var array           = str.split(split_char);
            var arr_length      = array.length;
            var link            = '';

            for (var i = 0; i < arr_length; i++) {

                link += '<input type="text" class="form-control" value="' + array[i] + '">' + '<br/>';
            }


            $('#updated_date').text(updated_date);
            $('#message').text(message);
            $('#link').html(link);
        }
    };

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#price-request-form');
                var rules = {
                    
                    link: {
                        required: true,
                        maxlength: 2000
                    },
                    message: {
                        maxlength: 500
                    },
                    fullName: {
                        required: true,
                        maxlength: 200
                    },
                    phone: {
                        required: true,
                        minlength: 9,
                        maxlength: 11,
                    },
                    email: {
                        required: true,
                        maxlength: 200
                    }
                }
                Validate.base_validate(form, rules);
            });


            $(document).on('click','.btn-take', function(e){

                e.preventDefault();

                id              = $(this).closest('[data-id]').data("id");
                message         = $(this).closest('[data-message]').data("message");
                processor_id    = $(this).closest('[data-processor_id]').data("processor_id");

                var data = {
                    id: id,
                };

                App.blockUI({
                    target: '.portlet-body',
                    boxed: true,
                    textOnly: true
                });

                window.setTimeout(function() {
                    App.unblockUI('.portlet-body');
                }, 4000);

                Spr.ajaxDefault('/manager/ajax/check-status-price-request', data, callBack_check_status_price_request,$(this));
            });

            $(document).on('click','.todo-tasks-item', function(e){

                id = $(this).closest('[data-id]').data("id");

                var data = {
                    id: id,
                };

                Spr.ajaxDefault('/manager/ajax/get-detail-price-request', data, callBack_get_detail_price_request,$(this));
            });
        },
    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();