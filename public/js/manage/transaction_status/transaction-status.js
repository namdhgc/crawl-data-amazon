var TransactionStatus = function () {

    var elem_block_loadding;
    var elm_active;

    var callBack_change_type =  function(data){

        if (data.meta.success) {

           var selected_id  = data.response.id;
           var type       = data.response.type;


           var tr   = $('tr[data-id="'+ selected_id +'"]').first();

           var a    = $('a[data-id="'+ selected_id +'"]').first();

           if(type == 0){

                a.removeClass('yellow').addClass('grey-mint');
                a.text('Mặc định');

           }else{

                a.removeClass('grey-mint').addClass('yellow');
                a.text('Bình thường');
           }

           tr.attr('data-type',type); 
           a.attr('data-type',type);       
        }
    }
    // public functions
    return {

        //main function

        init: function () { 

            $(document).ready(function(){

                var form  = $('#form-action-transaction-status');
                var rules = {

                    name: {
                        required:true,
                        minlength: 5,
                        maxlength: 150
                    },
                    description: {
                        maxlength: 100
                    }
                }
                Validate.base_validate(form, rules);
                 

                $(document).on('click','.btn-change-active',function(e){

                    e.preventDefault();

                    var id      = $(this).attr('data-id');
                    var type    = $(this).attr('data-type');

                    var data = {

                        id          : id,
                        type        :type,

                    };

                    Spr.ajaxDefault('/manager/ajax/update-type-transaction-status', data, callBack_change_type,'.portlet-body');
                });               
            });
        }
    };

}();