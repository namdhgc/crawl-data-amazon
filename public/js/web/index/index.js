/**
Custom module for you to write your own javascript functions
**/
var Index = function () {

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function() {


                var x = setInterval(function() {

                     // Time lấy được từ amazon

                    $('.countdown').each(function(){

                        var time    =  $(this).attr('data-time-end');
                        time = time - 1000 ;
                        $(this).attr('data-time-end', time);
                        var seconds = parseInt(time, 10);
                        var days    = Math.floor(seconds / (3600*24*1000));
                        var hrs     = Math.floor(seconds / (3600*1000));
                        var mnts    = Math.floor((seconds - (hrs * 3600*1000)) / (60*1000));
                        var secs    = Math.floor((seconds - (hrs * 3600*1000) - (mnts * 60*1000))/1000);

                        $(this).find('.hours .val').first().text(hrs);
                        $(this).find('.minutes .val').first().text(mnts);
                        $(this).find('.seconds .val').first().text(secs);

                        if(time < 0){
                            clearInterval(x);
                        }
                    });

                }, 1000);
            });
        },
    }
}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();
