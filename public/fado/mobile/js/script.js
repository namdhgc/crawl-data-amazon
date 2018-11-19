(function ($, window, document, undefined) {
    "use strict";
    $(document).ready(function () {

        $('.search-form .submit-btn').click(function () {
            return searchRedirect();
        });
        $(".search-form .keyword-input").keyup(function (e) {
            if (e.keyCode == 13) {
                searchRedirect();
            }
        });

        $(".modal").on("shown.bs.modal", function (event) {
            var $captcha = $(this).find(".captcha");
            if ($captcha.length) {
                $captcha.attr('src', baseurl + '/captcha/' + $captcha.data("ref"));
            }
        });
        $(".filter-list a,.sort-list a,.js-category-aside a.submit-btn,.product-item a, a.product-item,.cate-item a,.item-product a,.sub-cate-menu-panel .lv3 li:not(.back) a,.sub-cate-menu-panel  li.view-cate a").click(function () {
            showLoadingFunc();
        })
        MainMobile.orderTrakingModal();
    });

})(jQuery, window, document);


var MainMobile = {
    orderTrakingModal: function () {
        /*VALIDATE REQUEST BILL MODEL*/
        $(".check-bill-form").validate({
            rules: {
                phone: {required: true, maxlength: 12, minlength: 9},
                orderID: {required: true},
            }, messages: {
                phone: {
                    required: 'Bạn chưa nhập số điện thoại.',
                    minlength: 'Số điện thoại tối thiểu 9 kí tự trở lên.',
                    maxlength: 'Số điện thoại tối đa 12 kí tự trở lên'
                }, orderID: {
                    required: 'Bạn chưa nhập mã đơn hàng.'
                },
            }
        });

        /* REQUEST PASS MODEL*/
        $(".check-bill-form .bt-traking-order").click(function () {
            if ($(".check-bill-form").valid() == false) {
                return;
            }
            var $thisForm = $(this).parent().parent().parent().parent();
            var orderID = $thisForm.find("input[name='orderID']").val();
            var phone = $thisForm.find("input[name='phone']").val();
            var $notify = $thisForm.find(".notify-wrap");
            var $this = $(this);
            $.ajax({
                url: orderViewURL,
                type: "POST",
                dataType: 'json',
                data: {
                    orderID: orderID,
                    phone: phone
                },
                beforeSend: function () {
                    $this.prop("disabled", true);
                    $this.find("i").addClass("fa-spinner");
                },
                success: function (data) {
                    $this.prop("disabled", false);
                    $this.find("i").removeClass("fa-spinner");
                    if (data.error == 1) {
                        return  $notify.fadeIn().find(".message").html(data.message);
                    }
                    // close modal
                    $('.modal').modal('hide');
                    window.location = orderViewURL + "?orderID=" + orderID + "&phone=" + phone;
                }
            });
        });
    }
}
function searchRedirect() {
    // var lang = $(".search-form .list .is-selected").data("lang");
    // var keyword = $.trim($('.search-form .keyword-input').val());
    // c
    // strURL = baseurl + strURL.split(' ').join('+');
    // return window.location = strURL;
    var key = $('.search-form input').first().val();
    var url = $('.search-form button').first().attr('data-url');

    if(key != undefined && key != '') {

        window.location.href = url + '?field-keywords='+key;
    }
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}