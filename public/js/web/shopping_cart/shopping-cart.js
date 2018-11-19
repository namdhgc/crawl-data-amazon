var ShoppingCart = function () {

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

            window.location.href =  '/my-shopping-cart';
        }

    };

    var delete_product_on_shopping_cart       = function(){

        $(document).ready(function(){

            $(document).on('click','.bt-remove-cart-item',function(){

                var code     =   $(this).attr('data-id');
                var data        =   {
                    code:code
                };
                bootbox.confirm('<b>Quý khách vui lòng chọn một ngân hàng để thanh toán', function (result) {
                    if (result === true) {
                        return;
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
                console.log(quantity);

                $(this).parent().find('.input-quantity').val(quantity);
                
            });

        });
    };

    var callBack_get_login  =   function(data){

        if(data.meta.success){

            window.location.href =  'confirm-orders-information';

        }else{

            window.location.href =  'my-shopping-cart';
        }
    }



    var btn_confirm     = function(){

        $(document).ready(function(){

            $(document).on('click','.btnInforConfirm',function(e){
                e.preventDefault();
                var login_type    =   $(this).attr('data-login');
                if(login_type ==0){

                    window.location.href =  '/confirm-orders-information';

                }else{

                    var user_name   =   $('.user-input').val();
                    var password    =   $('.password-input').val();
                    console.log(user_name);
                    console.log(password);
                    var data = {
                        username : user_name,
                        password : password,
                    };
                    Spr.ajaxDefault('auth-login', data, callBack_get_login,$(this));
                }
            });

        });
    };

    return {

        //main function

        init: function () {

            setting_show_message();
            delete_product_on_shopping_cart();
            change_value_quantity();
            btn_confirm();
            
        }
    };

}();