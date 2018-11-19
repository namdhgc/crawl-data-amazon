(function ($, window, document, undefined) {
    "use strict";
    $(document).ready(function () {
        // show popup facebook like 
        if (typeof $.cookie("popup-facebook-like") == "undefined") {
            if (typeof $.cookie("starTime") == "undefined") {
                $.cookie("starTime", jQuery.now(), {expires: 30});
            }

            var countDown = parseInt($.cookie("starTime")) + 60000 - jQuery.now();
            setTimeout(function () {
                bootbox.dialog({
                    message: '<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Ffadovietnam%2F&tabs&width=390&height=214&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=833483216672042" width="390" height="214" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>',
                    title: "",
                }).addClass("bootbox-facebook-like");
                $.cookie("popup-facebook-like", true, {expires: 30})
            }, countDown)
        }

        $(".modal").on("shown.bs.modal", function (event) {
            var $captcha = $(this).find(".captcha");
            if ($captcha.length) {
                $captcha.attr('src', baseurl + '/captcha/' + $captcha.data("ref"));
            }
        });
        if (typeof lang !== 'undefined') {
            /*SELECT BOX LANG HEADER CHANG*/
            $("li[data-lang='" + lang + "']").addClass('is-selected');
            var currentLang = $(".searchfrm .searchLang[data-lang='" + lang + "']");
            $(".searchfrm .web-sel-control").find("input").val(currentLang.data("value"));
            $(".searchfrm .web-sel-control").find(".current").html(currentLang.html());

        } else {
            $("li[data-lang='us']").addClass('is-selected');
        }

        // $('.search-btn').click(function () {
        //     return searchRedirect($(this).parent().parent());
        // });
        // $(".keyword-txt").keyup(function (e) {
        //     if (e.keyCode == 13) {
        //         searchRedirect($(this).parent().parent());
        //     }
        // });
        MainDesktop.loginModel();
        MainDesktop.regisgerModel();
        MainDesktop.requestPassModel();
        MainDesktop.orderTrakingModal();

        // load header ajax
        // $.ajax({
        //     url: headerAjax,
        //     type: "POST",
        //     dataType: 'html',
        //     data: {},
        //     beforeSend: function () {

        //     },
        //     success: function (data) {
        //         $("#header-menu-ajax").prepend(data);

        //     }
        // });

    });

})(jQuery, window, document);
var MainDesktop = {
    loginModel: function () {
        /*VALIDATE LOGIN MODEL*/
        $(".login-form").validate({
            rules: {
                email: {required: {
                        depends: function () {
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    }, minlength: 3, maxlength: 255, email: true},
                password: {required: true, maxlength: 255, minlength: 3},
            }, messages: {
                email: {
                    required: 'Xin vui lòng nhập Email',
                    email: 'Xin vui lòng nhập đúng định dạng email. Ví dụ : support@fado.vn',
                    minlength: 'Email tối thiểu từ 3 kí tự trở lên.',
                    maxlength: 'Email tối đa 255 kí tự'
                },
                password: {
                    required: 'Bạn chưa nhập mật khẩu.',
                    minlength: 'Mật khẩu ít nhất 6 chữ và số.'
                }
            }
        });

        /* LOGIN MODEL*/
        $(".login-modal #bt-login").click(function () {
            if ($(".login-form").valid() == false) {
                return;
            }
            var $thisForm = $(this).parent().parent().parent();
            var email = $thisForm.find("input[name='email']").val();
            var password = $thisForm.find("input[name='password']").val();
            var $notify = $thisForm.find(".notify-wrap");
            var $this = $(this);
            $.ajax({
                url: loginURL,
                type: "POST",
                dataType: 'json',
                data: {
                    email: email,
                    password: password,
                    ajax: true
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
                    // redirect
                    window.location = data.redirectURL;
                }
            });
        });

        $('.login-form input').keypress(function (e) {
            if (e.which == 13) {
                $(".login-modal #bt-login").trigger("click");
                return false;
            }
        });

    }, orderTrakingModal: function () {
        /*VALIDATE REQUEST PASS MODEL*/
        $(".check-product-bill-form").validate({
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
        $(".check-product-bill-form .bt-traking-order").click(function () {
            if ($(".check-product-bill-form").valid() == false) {
                return;
            }
            var $thisForm = $(this).parent().parent().parent();
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

        $('.check-product-bill-form input').keypress(function (e) {
            if (e.which == 13) {
                $(".check-product-bill-form .bt-traking-order").trigger("click");
                return false;
            }
        });
    }, requestPassModel: function () {
        /*VALIDATE REQUEST PASS MODEL*/
        $(".request-pass-form").validate({
            rules: {
                email: {required: {
                        depends: function () {
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    }, minlength: 3, maxlength: 255, email: true},
                captcha: {required: true},
            }, messages: {
                email: {
                    required: 'Xin vui lòng nhập Email',
                    email: 'Xin vui lòng nhập đúng định dạng email. Ví dụ : support@fado.vn',
                    minlength: 'Email tối thiểu từ 3 kí tự trở lên.',
                    maxlength: 'Email tối đa 255 kí tự'
                }, captcha: {
                    required: 'Vui lòng nhập mã bảo mật'
                },
            }
        });

        /* REQUEST PASS MODEL*/
        $(".request-pass-modal #bt-request-pass").click(function () {
            if ($(".request-pass-form").valid() == false) {
                return;
            }
            var $thisForm = $(this).parent().parent().parent();
            var email = $thisForm.find("input[name='email']").val();
            var captcha = $thisForm.find("input[name='captcha']").val();
            var $notify = $thisForm.find(".notify-wrap");
            var $this = $(this);
            $.ajax({
                url: lostPasswordURL,
                type: "POST",
                dataType: 'json',
                data: {
                    email: email,
                    captcha: captcha,
                    ajax: true
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
                    // redirect
                    bootbox.dialog({
                        message: data.message,
                        title: "Thông Báo",
                        buttons: {
                            success: {
                                label: "Thoát",
                                className: "btn-success",
                                callback: function () {
                                    // redirect
                                    window.location = data.redirectURL;
                                }
                            }
                        }
                    });
                }
            });
        });

        $('.request-pass-form input').keypress(function (e) {
            if (e.which == 13) {
                $(".request-pass-modal #bt-request-pass").trigger("click");
                return false;
            }
        });
    },
    regisgerModel: function () {
        /*VALIDATE LOGIN MODEL*/
        $(".reg-user-form").validate({
            rules: {
                fullName: {required: true, minlength: 3, maxlength: 255},
                email: {required: {
                        depends: function () {
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    }, minlength: 3, maxlength: 255, email: true},
                password: {required: true, maxlength: 255, minlength: 3},
                retypePassword: {equalTo: ".reg-user-form input[name='password']"},
                captcha: {required: true},
                phoneNumber: {
                    required: true, maxlength: 12, minlength: 9},
            }, messages: {
                fullName: {
                    required: 'Bạn chưa nhập Họ và Tên.',
                    minlength: 'Họ và tên tối thiểu từ 3 kí tự trở lên.',
                    maxlength: 'Họ và tên tối đa 255 kí tự'
                },
                email: {
                    required: 'Xin vui lòng nhập Email',
                    email: 'Xin vui lòng nhập đúng định dạng email. Ví dụ : support@fado.vn',
                    minlength: 'Email tối thiểu từ 3 kí tự trở lên.',
                    maxlength: 'Email tối đa 255 kí tự'
                },
                password: {
                    required: 'Bạn chưa nhập mật khẩu.',
                    minlength: 'Mật khẩu ít nhất 6 chữ và số.'
                },
                retypePassword: {
                    required: 'Bạn chưa xác nhận mật khẩu',
                    equalTo: 'Mật khẩu không trùng khớp. Xin vui lòng kiểm tra lại.'
                },
                captcha: {
                    required: 'Vui lòng nhập mã bảo mật'
                },
                phoneNumber: {
                    required: 'Bạn chưa nhập số điện thoại.',
                    minlength: 'Số điện thoại tối thiểu 9 kí tự trở lên.',
                    maxlength: 'Số điện thoại tối đa 12 kí tự trở lên'
                },
            }
        });

        /* LOGIN MODEL*/
        $(".reg-user-form #bt-register").click(function () {
            if ($(".reg-user-form").valid() == false) {
                return;
            }
            var $thisForm = $(this).parent().parent().parent();
            var email = $thisForm.find("input[name='email']").val();
            var fullName = $thisForm.find("input[name='fullName']").val();
            var password = $thisForm.find("input[name='password']").val();
            var retypePassword = $thisForm.find("input[name='retypePassword']").val();
            var phoneNumber = $thisForm.find("input[name='phoneNumber']").val();
            var captcha = $thisForm.find("input[name='captcha']").val();
            var $notify = $thisForm.find(".notify-wrap");
            var $this = $(this);
            $.ajax({
                url: registerURL,
                type: "POST",
                dataType: 'json',
                data: {
                    email: email,
                    fullName: fullName,
                    password: password,
                    retypePassword: retypePassword,
                    phoneNumber: phoneNumber,
                    captcha: captcha,
                    ajax: true
                },
                beforeSend: function () {
                    $this.prop("disabled", true);
                    $this.find("i").addClass("fa-spinner");
                },
                success: function (data) {
                    $this.prop("disabled", false);
                    $this.find("i").removeClass("fa-spinner");
                    console.log(data);
                    if (data.error == 1) {
                        return  $notify.fadeIn().find(".message").html(data.message);
                    }
                    // close modal
                    $('.modal').modal('hide');
                    // redirect
                    bootbox.dialog({
                        message: "Chúc mừng bạn đã đăng ký thành công",
                        title: "Thông Báo",
                        buttons: {
                            success: {
                                label: "Thoát",
                                className: "btn-success",
                                callback: function () {
                                    // redirect
                                    window.location = data.redirectURL;
                                }
                            }
                        }
                    });
                }
            });
        });
        $('.reg-user-form input').keypress(function (e) {
            if (e.which == 13) {
                $(".reg-user-form #bt-register").trigger("click");
                return false;
            }
        });
    }
}

function searchRedirect(elSearch) {
    
    // var lang = elSearch.find(".langList .is-selected").data("lang");
    // var keyword = $.trim(elSearch.find('.keyword-txt').val());

    // if (typeof keyword === 'undefined' || !keyword) {
    //     return false;
    // }
    // if (typeof lang === 'undefined' || !lang) {
    //     return false;
    // }
    // var strURL = '/' + lang + '/s/search/?rh=k:' + keyword + '&keywords=' + keyword;
    // strURL = baseurl + strURL.split(' ').join('+');
    // return window.location = strURL;
}

function socialLogin(url) {
    var left = (screen.width / 2) - (600 / 2);
    var top = (screen.height / 2) - (800 / 2);
    return window.open(url, 'Đăng nhập', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=600, height=800, top=0, left=' + left);
}
function socialPopup(url) {
    var left = (screen.width / 2) - (600 / 2);
    var top = (screen.height / 2) - (800 / 2);
    return window.open(url, 'share', 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=600, height=600, top=0, left=' + left);
}
function imgCatchaError(image, name) {
    image.onerror = "";
    image.src = baseurl + '/captcha/' + name;
    return true;
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}