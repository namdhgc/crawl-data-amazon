var IndexLoadData = function () {

	var elem_block_loadding;
	var elm_active;

    // public functions

    var play_sound_notifi = function() {

        // $.playSound('/assets/uploads/sound/the_bells_2.mp3', false);

        $(document).mousemove(function (e) {
            stop_sound_notifi();
        });

        $(document).keypress(function (e) {
            stop_sound_notifi();
        });

        $(document).click(function (e) {
            stop_sound_notifi();
        });
    }

    var stop_sound_notifi = function() {

        $.stopSound();
    }

    var setting_show_message  =  function(){
      toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "10000",
            "hideDuration": "10000",
            "timeOut": "10000",
            "extendedTimeOut": "10000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          }
    }

    var show_message = function(res) {
        toastr['success'](res, "Notifications")
    };

    var callBack_get_data_pending = function(data) {

        stop_sound_notifi();
        if (data.meta.success) {

            if(data.response.data.total > 0){

                var new_pending =   data.response.data.total ;
                var msg         =   'Có, <span class="count" >'+ new_pending + '</span> đơn hàng mới chưa xử lý.' + '<a href="/manager/transaction"> Chi tiết...</a>';

                if($('#list-notifi #new-order').length != 0) {

                    $('#list-notifi #new-order').remove();
                }

                $('#list-notifi').append('<p id="new-order">'+msg+'</p>');
                $('#list-notifi').removeClass('hide');
                $('#order-pending').text(data.response.data.total);
                $('#order-pending').attr('data-value-order',data.response.data.total);
                play_sound_notifi();
            }else {

                $('#list-notifi #new-order').remove();

                if($('#list-notifi p').length == 0) {

                    $('#list-notifi p').addClass('hide');
                }
                stop_sound_notifi();
            }
        }

    };

    var callBack_get_request_pending = function(data) {

        stop_sound_notifi();
        if (data.meta.success) {

            if(data.response.data.total > 0){
                var new_pending =   data.response.data.total ;
                var msg         =   'Có <span class="count" >'+ new_pending + '</span> Yêu cầu báo giá mới chưa được xử lý.' + '<a href="/manager/price-request-management"> Chi tiết...</a>';
                // show_message(msg);
                if($('#list-notifi #price-request').length != 0) {

                    $('#list-notifi #price-request').remove();
                }

                $('#list-notifi').append('<p id="price-request">'+msg+'</p>');
                $('#list-notifi').removeClass('hide');
                $('#request-pending').text(data.response.data.total);
                $('#request-pending').attr('data-value-request',data.response.data.total);
                play_sound_notifi();
            }else {

                $('#list-notifi #price-request').remove();

                if($('#list-notifi p').length == 0) {

                    $('#list-notifi p').addClass('hide');
                }
                stop_sound_notifi();
            }
        }

    };

    var callBack_get_feed_back_pending = function(data) {

        stop_sound_notifi();
        if (data.meta.success) {

            if(data.response.data.total > 0){
                var new_pending =   data.response.data.total ;
                var msg         =   'Có <span class="count" >'+ new_pending + '</span> Phản hồi mới chưa được xử lý.' + '<a href="/manager/feedback"> Chi tiết...</a>';
                // show_message(msg);
                if($('#list-notifi #feed-back').length != 0) {

                    $('#list-notifi #feed-back').remove();
                }

                $('#list-notifi').append('<p id="feed-back">'+msg+'</p>');
                $('#list-notifi').removeClass('hide');
                $('#feed-back-pending').text(data.response.data.total);
                $('#feed-back-pending').attr('data-value-request',data.response.data.total);
                play_sound_notifi();
            }else {

                $('#list-notifi #feed-back').remove();

                if($('#list-notifi p').length == 0) {

                    $('#list-notifi p').addClass('hide');
                }
                stop_sound_notifi();
            }
        }

    };
    

    var transaction_pending       = function(){


        var pending     =   $('#order-pending').attr('data-value-order');
        var data        =   {
            pending:pending
        };

        Spr.ajaxDefault('/manager/ajax/transaction-pending', data, callBack_get_data_pending,'');

    };

    var request_pending       = function(){

        var pending     =   $('#request-pending').attr('data-value-request');
        var data        =   {
            pending:pending
        };

        Spr.ajaxDefault('/manager/ajax/price-request-pending', data, callBack_get_request_pending,'');
    };

    var feed_back_pending       = function(){

        Spr.ajaxDefault('/manager/ajax/feed-back-pending', {}, callBack_get_feed_back_pending,'');
    };

    return {

        //main function

        init: function () {

            $(document).ready(function(){

                $('#list-notifi').pulsate({
                    color: "#bf1c56"
                });
                // setting_show_message();
                var reload_data = setInterval(function(){

                    transaction_pending();
                    request_pending();
                    feed_back_pending();


                }, 30000);
                transaction_pending();
                request_pending();
                feed_back_pending();
            });


        }
    };

}();