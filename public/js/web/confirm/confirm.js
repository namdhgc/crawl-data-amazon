var Confirm = function () {

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

            window.location.href =  'confirm-orders-information';
        }

    };

    var delete_product_on_shopping_cart       = function(){

        $(document).ready(function(){

            $(document).on('click','.bt-remove-cart-item',function(){

                var code     =   $(this).attr('data-id');
                var data        =   {
                    code:code
                };
                bootbox.confirm('<b>Bạn có chắc chắn muốn xóa sản phẩm này khỏi danh sách?', function (result) {
                    if (result === true) {
                        Spr.ajaxDefault('delete-shoping-cart', data, callBack_get_data,$(this));
                    }
                });
                
            });

        });
    };

    var change_value_quantity     = function(){

        $(document).ready(function(){

            $(document).on('change','.inputQuantity',function(e){
                 e.preventDefault();
                var quantity    =   $(this).val();

                $(this).parent().find('.input-quantity').val(quantity);
                
            });

        });
    };

    return {

        //main function

        init: function () {
            setting_show_message();
            delete_product_on_shopping_cart();
            change_value_quantity();
            
            
        },
    };

}();