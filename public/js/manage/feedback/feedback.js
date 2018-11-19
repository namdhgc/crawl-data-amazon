var Feedback = function () {

    var elem_block_loadding;
    var elm_active;


    var callback_verify         =   function(data){

        if(data.meta.success){

            var id      =   data.response.id;
            var a       =   $('a[data-id="'+ id +'"]').first();
            var tr      =   $('tr[data-id="'+ id +'"]').first();
            var span       =   a.find('span').first();

            a.attr('data-active',data.response.verify);
            tr.attr('data-status',data.response.verify);

            if(data.response.verify == 1) {

                span.removeClass('label-danger');
                span.addClass('label-success');
                span.text('Hiển thị');
            }else {

                span.removeClass('label-success');
                span.addClass('label-danger');
                span.text('Không hiển thị');
            }

        }

    }

        var callback_status         =   function(data){

        if(data.meta.success){

            var id      =   data.response.id;
            var tr      =   $('tr[data-id="'+ id +'"]').first();
            var span    =   tr.find('span.item-status').first();
            tr.attr('data-status',1);
            span.removeClass('label-danger');
            span.addClass('label-success');
            span.text('Đã xem');

        }

    }

    return {

        //main function

        init: function () {

            $(document).ready(function(){

                $(document).on('click','.btn-delete', function(e){

                    e.preventDefault();

                    $('#frm_del').find('#id').val($(this).attr('data-id'));

                })

                $(document).on('click','.btn-change-verify', function(e){

                    e.preventDefault();

                    var id                =   $(this).attr('data-id');

                    var data    =   {

                        id    :   id,
                    };

                    Spr.ajaxDefault('/manager/ajax/change-verify-feedback', data, callback_verify,$(this));

                });

                $(document).on('click','.btn-view', function(e){

                    // e.preventDefault();

                    // var id                =   $(this).attr('data-id');

                    // var data    =   {

                    //     id    :   id,
                    // };

                    // Spr.ajaxDefault('/manager/ajax/change-status-feedback', data, callback_status,$(this));

                });

            });
        }
    };

}();