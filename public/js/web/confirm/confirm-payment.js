var ConfirmPayment = function () {

    var elem_block_loadding;
    var elm_active;
    // public functions

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


    var callBack_get_data   =   function(data) {

        if (data.meta.success) {

            var code    =   data.response;

            if(data.meta.code !=1000){
                 window.location.href =  '/confirm-payment/' + code;
            }else{
                window.location.href  = '/';
            }
           
        }else{

            window.location.href  = '/';
        }

    };

    var delete_product_on_shopping_cart       = function(){

        $(document).ready(function(){

            $(document).on('click','.bt-remove-cart-item',function(){

                var code                =   $(this).attr('data-id');
                var transaction_code    =   $(this).attr('data-code');
                var data        =   {
                    code:code,
                    transaction_code:transaction_code,
                };
                bootbox.confirm('<b>Bạn có chắc chắn muốn xóa sản phẩm này khỏi danh sách?', function (result) {
                    if (result === true) {
                        Spr.ajaxDefault('/delete-shoping-cart-2', data, callBack_get_data,$(this));
                    }
                });
                
            });

        });
    };


    return {

        //main function

        init: function () {
            setting_show_message();
            delete_product_on_shopping_cart();          
            
        },
    };

}();