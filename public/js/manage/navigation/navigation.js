/**
Custom module for you to write your own javascript functions
**/
var Navigation = function () {

    var elem_block_loadding;
    var elm_active;

    var callBack_get_data =  function(data){

        if (data.meta.success) {

           var selected_id  = data.response.id;
           var active       = data.response.display;


           var tr   = $('tr[data-id="'+ selected_id +'"]').first();

           var a    = $('a[data-id="'+ selected_id +'"]').first();

           if(active == 0){

                a.removeClass('yellow').addClass('grey-mint');
                a.text('Không hoạt động');

           }else{

                a.removeClass('grey-mint').addClass('yellow');
                a.text('Hoạt động');
           }

           tr.attr('data-display',active);
           a.attr('data-active',active);
        }
    }

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                $(document).on('click','.btn-delete', function(e){

                    e.preventDefault();

                    $('#frm_del').find('#id').val($(this).attr('data-id'));

                });

                $(document).on('click','.clear-msg',function(){

                    $(this).closest('div').find('div.alert').hide();

                });

                $(document).on('click','.btn-change-active',function(e){

                    e.preventDefault();

                    var id      = $(this).attr('data-id');
                    var active  = $(this).attr('data-active');
                    var lang    = $(this).attr('data-lang-code');

                    var data = {

                        id        : id,
                        display   :active,
                        lang_code :lang,

                    };



                    Spr.ajaxDefault('/manager/ajax/update-active-navigation', data, callBack_get_data,'.portlet-body');
                })

            });
        }
    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();