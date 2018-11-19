/**
Custom module for you to write your own javascript functions
**/
var Setting = function () {

    var callBack_get_data =  function(data){

        if (data.meta.success) {

           var selected_id  = data.response.id;
           var active       = data.response.status;
           console.log(active);

           var tr   = $('tr[data-id="'+ selected_id +'"]').first();

           var a    = $('a[data-id="'+ selected_id +'"]').first();

           if(active == 0){

                a.removeClass('yellow').addClass('grey-mint');
                a.text('Không hoạt động');

           }else{

                a.removeClass('grey-mint').addClass('yellow');
                a.text('Hoạt động');
           }      
        }
    }



    return {

        //main function

        init: function () {

            $(document).ready(function(){

                $(document).on('click','.btn-create-new',function(){
                    var key = $(this).attr('data-id');
                    $('#modalEditSetting').find('#key').first().val(key);
                });

                $(document).on('click','.btn-delete-support',function(){
                    var id = $(this).attr('data-id');
                    $('#frm_del_support').find('#id').first().val(id);
                    $('#deleteSupportModal').show(500);
                });


                $(document).on('click','.btn-change-active',function(){

                    var id = $(this).attr('data-id');
                    

                    var data = {

                        id : id
                    };

                    Spr.ajaxDefault('/manager/ajax/change-status-support', data, callBack_get_data,'.portlet-body');
                });



            });
        },
    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();