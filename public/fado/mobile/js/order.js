var OrderMobile = {
    cart: function () {
        $(document).ready(function () {

            /*VALIDATE LOGIN CART*/
            $(".order-login-form").validate({
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
            $("#bt-login").click(function () {
                if ($(".order-login-form").valid() == false) {
                    return;
                }
                var $thisForm = $(this).parent().parent();
                var email = $thisForm.find("input[name='email']").val();
                var password = $thisForm.find("input[name='password']").val();
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
                            return  bootbox.alert(data.message);
                        }
                        // redirect
                        return window.location.href = paymentInforConfirmURL;
                    }
                });
            });

            $('.btnInforConfirm').click(function () {
                if ($(".login-type-rad:checked").val() === "0" || typeof $(".login-type-rad:checked").val() == 'undefined') {
                    return window.location.href = paymentInforConfirmURL;
                }

                if ($(".order-login-form").valid() == false) {
                    return;
                }
                var $this = $(this);
                var email = $(".order-login-form input[name='email']").val();
                var password = $(".order-login-form input[name='password']").val();
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
                            return bootbox.alert(data.message);
                        }
                        window.location.href = paymentInforConfirmURL;
                    }
                });
            });

            $('.order-login-form input').keypress(function (e) {
                if (e.which == 13) {
                    $(".order-login-form .btnInforConfirm").trigger("click");
                    return false;
                }
            });

            OrderMobile.removeItemCart();
        });
    }, removeItemCart: function () {
        $('.bt-remove-cart-item, .bt-remove-all-item').click(function () {
            var isDelAll = $(this).hasClass('bt-remove-all-item') ? 1 : 0;
            console.log(isDelAll);
            var asin = $(this).data('asin');
            strMsg = isDelAll ? 'Bạn có muốn xóa toàn bộ sản phẩm ra khỏi giỏ hàng không' : 'Bạn có muốn xóa sản phẩm này ra khỏi giỏ hàng không';
            bootbox.confirm(strMsg, function (result) {
                if (result === true) {
                    $.ajax({
                        url: deleteItemURL,
                        type: "POST",
                        async: true,
                        cache: false,
                        data: {asin: asin, isDelAll: isDelAll},
                        success: function (data) {
                            var result = $.parseJSON(data);
                            if (result.success === 1) {
                                window.location = window.location.href;
                            } else {
                                bootbox.alert(result.message);
                            }
                        }
                    });
                }
            });
        });
    },
    informationConfirm: function () {
        $(document).ready(function () {
            $('.order-receiver-profile-block').click(function () {
                setTimeout(function () {
                    if ($('.order-receiver-profile-block').hasClass('is-expand')) {
                        $('.order-receiver-profile-block input,.order-receiver-profile-block select').removeAttr('disabled');
                    } else {
                        $('.order-receiver-profile-block input,.order-receiver-profile-block select').attr('disabled', true);
                    }
                }, 50);
            });
            var buyerCityID = $('#buyerCityID').val();
            if (buyerCityID) {
                getDistrict(buyerCityID, 'buyer');
            }
            $('#buyerCityID, #receiverCityID').change(function () {
                var id = $(this).attr('id');
                var title = id === 'buyerCityID' ? 'buyer' : 'receiver';
                var cityID = $('#' + id).val();
                getDistrict(cityID, title);
            });
            $('#buyerDistrictID, #receiverDistrictID').change(function () {
                var id = $(this).attr('id');
                var title = id === 'buyerDistrictID' ? 'buyer' : 'receiver';
                var districtID = $('#' + id).val();
                getWard(districtID, title);
            });

            if (userLoginError) {
                $(".login-modal").modal('show');
                $notify = $(".login-modal .login-form .notify-wrap");
                $notify.show().find(".message").html(userLoginError);
                setTimeout(function () {
                    $notify.hide();
                }, 7000)
            }
        });

        OrderMobile.removeItemCart();

        /* VALIDATE*/
        $(".order-profile-form").validate({
            rules: {
                buyerFullname: {required: true},
                buyerEmail: {required: {
                        depends: function () {
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    }, minlength: 3, maxlength: 255, email: true},
                buyerPhone: {required: true, maxlength: 14, minlength: 9},
                buyerAddress: {required: true},
                buyerCityID: {required: true},
                buyerDistrictID: {required: true},
                buyerWardID: {required: true},
                receiverFullname: {required: true},
                receiverrEmail: {required: {
                        depends: function () {
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    }, minlength: 3, maxlength: 255, email: true},
                receiverPhone: {required: true, maxlength: 14, minlength: 9},
                receiverAddress: {required: true},
                receiverCityID: {required: true},
                receiverDistrictID: {required: true},
                receiverWardID: {required: true},
            }, messages: {
                buyerFullname: {
                    required: 'Bạn chưa nhập Họ và Tên.',
                },
                buyerEmail: {
                    required: 'Xin vui lòng nhập Email',
                    email: 'Xin vui lòng nhập đúng định dạng email. Ví dụ : support@fado.vn',
                    minlength: 'Email tối thiểu từ 3 kí tự trở lên.',
                    maxlength: 'Email tối đa 255 kí tự'
                },
                buyerPhone: {
                    required: 'Bạn chưa nhập số điện thoại.',
                    minlength: 'Số điện thoại ít nhất 9 ký tự.',
                    maxlength: 'Số điện thoại nhiều nhất 14 ký tự.'
                },
                buyerAddress: {
                    required: 'Bạn chưa nhập địa chỉ.',
                },
                buyerCityID: {
                    required: 'Bạn chưa chọn Tỉnh/Thành Phố.',
                },
                buyerDistrictID: {
                    required: 'Bạn chưa chọn Quận/Huyện.',
                },
                buyerWardID: {
                    required: 'Bạn chưa chọn Phường/Xã.',
                }, receiverFullname: {
                    required: 'Bạn chưa nhập Họ và Tên.',
                },
                receiverPhone: {
                    required: 'Bạn chưa nhập số điện thoại.',
                    minlength: 'Số điện thoại ít nhất 9 ký tự.',
                    maxlength: 'Số điện thoại nhiều nhất 14 ký tự.'
                },
                receiverAddress: {
                    required: 'Bạn chưa nhập địa chỉ.',
                },
                receiverCityID: {
                    required: 'Bạn chưa chọn Tỉnh/Thành Phố.',
                },
                receiverDistrictID: {
                    required: 'Bạn chưa chọn Quận/Huyện.',
                },
                receiverWardID: {
                    required: 'Bạn chưa chọn Phường/Xã.',
                }
            }
        });

        /*DISCOUNT CODE*/
        $('#discount-code').mouseenter(function () {
            $(this).inputmask({mask: '*****-*****-*****-*****'});
        }).mouseleave(function () {
            if ($(this).val() === '_____-_____-_____-_____') {
                $(this).val('');
            }
        });

        $('#bt-checkout').click(function () {
            var discountCode = $.trim($('#discount-code').val()).replace('_____-_____-_____-_____', '');
            console.log(discountCode);
            if (!discountCode) {
                return $(".order-profile-form").submit();
            }

            $.ajax({
                url: checkDiscountCodeURL,
                type: "POST",
                async: true,
                cache: false,
                data: {discountCode: discountCode, totalOrder: totalOrder},
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.error === 1) {
                        bootbox.dialog({
                            message: result.message,
                            buttons: {
                                danger: {
                                    label: "Nhập mã khác",
                                    className: "btn-danger btnClose",
                                    callback: function () {
                                        $('#discount-code').val('').addClass('error');
                                    }
                                },
                                main: {
                                    label: "Tiếp tục",
                                    className: "btn-primary btnConfirm",
                                    callback: function () {
                                        $('#discount-code').val('');
                                        $(".order-profile-form").submit();
                                    }
                                }
                            }
                        });
                    } else {
                        return $(".order-profile-form").submit();
                    }
                }
            });
        });

    },
    advisoryVAT: function () {

        $('input#isVAT').click(function () {
            isVATCheckbox = $(this);
            var isAcceptVAT = isVATCheckbox.is(':checked') ? 1 : 0;
            if (isAcceptVAT) {
                $("#tu-van-vat").modal()
            }
        });

        $("#bt-modal-advisory-vat").click(function () {
            $this = $(this);
            var phone = $this.parent().find(".phone-txt").val();
            if (!phone) {
                return bootbox.alert('Quý khách vui lòng nhập số điện thoại cần hỗ trợ.');
            }

            if (phone.length < 9 || phone.length > 13) {
                return bootbox.alert('Số điện thoại không hợp lệ, Quý khách vui lòng nhập lại.');
            }

            $.ajax({
                url: advisoryAddPhoneURL,
                type: "POST",
                async: true,
                cache: false,
                dataType: 'json',
                data: {asin: 'XUAT VAT', phone: phone, lang: '', note: 'Yêu cầu kế toán tư vấn xuất VAT'},
                beforeSend: function (xhr) {
                    $this.find("i").addClass("fa-spinner");
                },
                success: function (result) {
                    if (result.error == 1) {
                        return bootbox.alert(result.msg);
                    }
                    $this.find("i").removeClass("fa-spinner");
                    return bootbox.alert(result.msg, function () {
                        $("#tu-van-vat").modal("hide");
                    });
                }
            });
        });
    },
    paymentMethod: function () {
        $(document).ready(function () {
            $('.prepaidOption,.order-payment-methods-block a').click(function () {
                updatePrice();
            });

            $('input#tos').click(function () {
                tosCheckbox = $(this);
                var isAccept = tosCheckbox.is(':checked') ? 1 : 0;
                if (isAccept) {
                    var tosContent = $('#tosContent').html();
                    tosCheckbox.prop('checked', false);
                    bootbox.dialog({
                        title: "Điều khoản dịch vụ cần biết trước khi đặt mua hàng",
                        message: tosContent,
                        className: "rule-modal",
                        buttons: {
                            main: {
                                label: "Tôi đã đọc và đồng ý<br/>với các điều khoản trên",
                                className: "btn-danger btn-block btnAcceptTOS",
                                callback: function () {
                                    tosCheckbox.prop('checked', true);
                                }
                            }
                        }
                    }).find("div.modal-dialog").css({'margin': '10px auto', 'width': '95%'}).find(".modal-body").css({'max-height': '600px', 'overflow': 'scroll'});
                }
            });

            OrderMobile.advisoryVAT();

            $("#payment-type-4 .indicator,#payment-type-5 .indicator").click(function () {
                $(this).parent().find("[name='bankID']").prop("checked", true);
            })

            $('#btnCompleteOrder').click(function () {
                if ($(".paymentMethod").val() == "4" && typeof $("[name='bankID']:checked").val() == "undefined") {
                    return bootbox.alert('Quý khách vui lòng chọn một ngân hàng để tiến hành thanh toán.');
                }

                if ($(".paymentMethod").val() != "2" && $('input#isVAT').is(':checked') == true) {
                    return bootbox.alert('Vui lòng chọn hình thức thanh toán <strong>Nộp tiền mặt tại văn phòng fado</strong> để được xuất hóa đơn');
                }

                if ($('input#tos:checked').length < 1) {
                    return bootbox.alert('Quý khách vui lòng xem qua điều khoản và đồng ý với điều khoản của Fado trước khi đặt mua hàng.', function () {
                        $('.aside-main').animate({
                            scrollTop: $('input#tos').offset().top - 150
                        }, 300);
                        $('.blinker').fadeTo('fast', 0).fadeTo('fast', 1).fadeTo('fast', 0).fadeTo('fast', 1).fadeTo('fast', 0).fadeTo('fast', 1).fadeTo('fast', 0).fadeTo('fast', 1);
                    });
                }
                showLoadingFunc();
                return $('#frm').submit();
            });

            if (modalUpdateInfoUser) {
                $("#cap-nhat-tai-khoan").modal('show');
                $(".update-user-form").validate({
                    rules: {
                        fullName: {required: true, minlength: 3, maxlength: 255},
                        password: {required: true, maxlength: 255, minlength: 3},
                        retypePassword: {equalTo: "input[name='password']"},
                        captcha: {required: true},
                        phoneNumber: {
                            required: true, maxlength: 12, minlength: 9},
                    }, messages: {
                        fullName: {
                            required: 'Bạn chưa nhập Họ và Tên.',
                            minlength: 'Họ và tên tối thiểu từ 3 kí tự trở lên.',
                            maxlength: 'Họ và tên tối đa 255 kí tự'
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

                setTimeout(function () {
                    $("input[name='birthdate']").inputmask("d/m/y", {"placeholder": "__/__/____"});
                }, 500)
                $("#bt-update-info").click(function () {
                    if ($(".update-user-form").valid() == false) {
                        return;
                    }
                    var $thisForm = $(this).parent().parent().parent();
                    var email = $thisForm.find("input[name='email']").val();
                    var fullName = $thisForm.find("input[name='fullName']").val();
                    var birthdate = $thisForm.find("input[name='birthdate']").val();
                    var password = $thisForm.find("input[name='password']").val();
                    var retypePassword = $thisForm.find("input[name='retypePassword']").val();
                    var phoneNumber = $thisForm.find("input[name='phoneNumber']").val();
                    var captcha = $thisForm.find("input[name='captcha']").val();
                    var $notify = $thisForm.find(".notify-wrap");
                    var $this = $(this);
                    $.ajax({
                        url: updateInfoUserURL,
                        type: "POST",
                        dataType: 'json',
                        data: {
                            email: email,
                            fullName: fullName,
                            password: password,
                            retypePassword: retypePassword,
                            phoneNumber: phoneNumber,
                            captcha: captcha,
                            birthdate: birthdate,
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
                            setTimeout(function () {
                                $("#cap-nhat-tai-khoan").modal('hide');
                            }, 2000)
                            bootbox.dialog({
                                message: "Chúc mừng bạn đã cập nhật thông tin thành công",
                                title: "Thông Báo",
                                buttons: {
                                    success: {
                                        label: "Thoát",
                                        className: "btn-success",
                                        callback: function () {

                                        }
                                    }
                                }
                            });
                        }
                    });
                })
            }
        });
    }
};

function getDistrict(cityID, title) {
    if (typeof cityID === 'undefined' || !cityID) {
        return false;
    }
    if (typeof title === 'undefined' || !title) {
        return false;
    }
    var txtDistrictID = title === 'buyer' ? '#buyerDistrictID' : '#receiverDistrictID';
    var txtWardID = title === 'buyer' ? '#buyerWardID' : '#receiverWardID';
    $.ajax({
        url: getDistrictURL,
        type: "POST",
        async: true,
        cache: false,
        dataType: 'json',
        data: {cityID: cityID}
    }).done(function (res) {
        var option = '<option value="0">Vui lòng chọn Quận / Huyện</option>';
        $.each(res, function (k, v) {
            option += '<option value="' + v.district_id + '">' + v.district_name + '</option>';
        });
        $(txtDistrictID).html(option).removeAttr('disabled');
        if ($(txtDistrictID + ' option[value="' + districtID + '"]').length > 0) {
            $(txtDistrictID).val(districtID);
            getWard(districtID, title);
        } else {
            $(txtDistrictID).val(0);
            $(txtWardID).val(0).attr('disabled', 'disabled');
        }
    });
}

function getWard(districtID, title) {
    if (typeof districtID === 'undefined' || !districtID) {
        return false;
    }
    if (typeof title === 'undefined' || !title) {
        return false;
    }
    var txtWardID = title === 'buyer' ? '#buyerWardID' : '#receiverWardID';
    $.ajax({
        url: getWardURL,
        type: "POST",
        async: true,
        cache: false,
        dataType: 'json',
        data: {districtID: districtID}
    }).done(function (res) {
        var option = '<option value="0">Vui lòng chọn Phường / Xã</option>';
        $.each(res, function (k, v) {
            option += '<option value="' + v.ward_id + '">' + v.ward_name + '</option>';
        });
        $(txtWardID).html(option).removeAttr('disabled');
        $(txtWardID + ' option[value="' + wardID + '"]').length > 0 ? $(txtWardID).val(wardID) : $(txtWardID).val(0);
    });
}

function updatePrice() {
    setTimeout(function () {
        var prepaidType = $('.prepaidOption:checked').data('type');
        var prepaidPercent = $('.prepaidOption:checked').data('percent');
        var paymentMethod = $('.paymentMethod').val();
        var discountCode = $("input[name='discountCode']").val();

        $("input[name='prepaidPercent']").val(prepaidPercent);
        $("input[name='prepaidType']").val(prepaidType);
        $("input[name='paymentMethod']").val(paymentMethod);

        var $curentPriceLoad = $('.prepaidOption:checked').parent();
        var objData = {
            paymentMethod: paymentMethod,
            prepaidType: prepaidType,
            prepaidPercent: prepaidPercent,
            cityID: cityID,
            districtID: districtID,
            wardID: wardID,
            shippingWeigh: shippingWeigh,
            estimatedOrder: estimatedOrder,
            importFee: importFee,
            shippingFee: shippingFee,
            otherCharge: otherCharge,
            discountFee: discountFee,
            isUnknowFee: isUnknowFee,
            discountCode: discountCode,
            vatInvoice: $('#isVAT').val() === 'on' ? 1 : 0
        };
        $.ajax({
            url: calculateFeeURL,
            type: "POST",
            async: true,
            cache: false,
            dataType: 'json',
            data: objData,
            beforeSend: function (xhr) {
                $curentPriceLoad.find('.price-data').hide();
                $curentPriceLoad.find('.price-loading').show();
            },
        }).done(function (result) {
            if (result.error == 1) {
                return bootbox.alert('Xảy ra lỗi.');
            }

            $curentPriceLoad.find('.price-loading').hide();
            $curentPriceLoad.find('.price-data').html(result.data).show();

            $("i.otherCharge").popover({
                'html': true,
                'trigger': 'hover',
                'title': 'Phụ phí',
                'placement': 'top',
                'content': '<span style="font-weight:normal;color:#000">Phí mua hộ tối thiểu cho đơn hàng là $10, nếu chưa đủ $10 hệ thống sẽ cộng thêm phụ phí này vào đơn hàng. Quý khách vui lòng đặt mua thêm sản phẩm để giảm phụ phí này.</span>',
                'template': '<div class="popover" style="max-width:620px;"><div class="arrow"></div><h3 class="popover-title" style="font-weight:600;"></h3><div class="popover-content"></div></div>'
            });
        });
    }, 100);

}

