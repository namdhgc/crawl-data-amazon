var UserDesktop = {
    changePassword: function () {
        /*VALIDATE LOST PASSWORD*/
        $(".change-pass-form").validate({
            rules: {
                password: {required: true, maxlength: 255, minlength: 3},
                newPassword: {required: true, maxlength: 255, minlength: 3},
                retypePassword: {required: true, maxlength: 255, minlength: 3},
            }, messages: {
                password: {
                    required: 'Bạn chưa nhập mật khẩu.',
                    minlength: 'Mật khẩu ít nhất 6 chữ và số.'
                },
                newPassword: {
                    required: 'Bạn chưa nhập mật khẩu mới.',
                    minlength: 'Mật khẩu ít nhất 6 chữ và số.'
                },
                retypePassword: {
                    required: 'Bạn chưa nhập mật khẩu nhắc lại.',
                    minlength: 'Mật khẩu ít nhất 6 chữ và số.'
                }
            }
        });
    }, edit: function () {
        /*VALIDATE EDIT PROFILE*/
        $(".user-profile-form").validate({
            rules: {
                fullName: {required: true, maxlength: 255, minlength: 3},
                phoneNumber: {required: true, maxlength: 14, minlength: 9},
                birthdate: {required: true},
                gender: {required: true},
                address: {required: true, maxlength: 255, minlength: 3},
                city: {required: true},
                district: {required: true},
                ward: {required: true},
            }, messages: {
                fullName: {
                    required: 'Bạn chưa nhập họ và tên.',
                    minlength: 'Họ tên ít nhất 3 ký tự.',
                    maxlength: 'Họ tên nhiều nhất 255 ký tự.'
                },
                phoneNumber: {
                    required: 'Bạn chưa nhập số điện thoại.',
                    minlength: 'Số điện thoại ít nhất 9 ký tự.',
                    maxlength: 'Số điện thoại nhiều nhất 14 ký tự.'
                },
                birthdate: {
                    required: 'Bạn chưa chọn ngày sinh.'
                },
                gender: {
                    required: 'Bạn chưa chọn ngày sinh.'
                },
                address: {
                    required: 'Bạn chưa nhập địa chỉ.',
                    minlength: 'Địa chỉ ít nhất 3 ký tự.',
                    maxlength: 'Địa chỉ nhiều nhất 255 ký tự.'
                },
                city: {
                    required: 'Bạn chưa chọn Tỉnh/ Thành phố.'
                },
                district: {
                    required: 'Bạn chưa chọn Quận/ Huyện.'
                },
                ward: {
                    required: 'Bạn chưa chọn đường.'
                }
            }
        });

        /*CHANGE CITY AND DISTRICT*/
        $('#city').change(function () {
            var cityID = $(this).val();
            $('#district').attr('disabled', 'disabled').html('<option selected="selected" value="">Vui lòng chọn Quận / Huyện</option>');
            $('#ward').attr('disabled', 'disabled').html('<option selected="selected" value="">Vui lòng chọn Phường / Xã</option>');
            if (cityID) {
                $.ajax({
                    url: getDistrictURL,
                    type: "POST",
                    async: true,
                    cache: false,
                    data: {cityID: cityID},
                    success: function (data) {
                        var result = $.parseJSON(data);
                        if (result) {
                            $('#district').removeAttr('disabled');
                            $.each(result, function (k, v) {
                                $('#district').append('<option value="' + v.district_id + '">' + v.district_name + '</option>');
                            });
                        }
                    }
                });
            }
        });
        $('#district').change(function () {
            var districtID = $(this).val();
            $('#ward').attr('disabled', 'disabled').html('<option selected="selected" value="">Vui lòng chọn Phường / Xã</option>');
            if (districtID) {
                $.ajax({
                    url: getWardURL,
                    type: "POST",
                    async: true,
                    cache: false,
                    data: {districtID: districtID},
                    success: function (data) {
                        var result = $.parseJSON(data);
                        if (result) {
                            $('#ward').removeAttr('disabled');
                            $.each(result, function (k, v) {
                                $('#ward').append('<option value="' + v.ward_id + '">' + v.ward_name + '</option>');
                            });
                        }
                    }
                });
            }
        });
    }, resetPassword: function () {
        /*VALIDATE EDIT PROFILE*/
        $(".reset-password-form").validate({
            rules: {
                email: {required: {
                        depends: function () {
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    }, minlength: 3, maxlength: 255, email: true},
                password: {required: true, maxlength: 255, minlength: 3},
                retypePassword: {equalTo: ".reset-password-form input[name=\"password\"]"},
                captcha: {required: true},
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
                },
                retypePassword: {
                    required: 'Bạn chưa xác nhận mật khẩu',
                    equalTo: 'Mật khẩu không trùng khớp. Xin vui lòng kiểm tra lại.'
                },
                captcha: {
                    required: 'Bạn chưa nhập mã bảo mật.',
                }
            }
        });

        if (messageSuccess) {
            bootbox.alert(messageSuccess, function () {
                window.location = baseurl;
            });
        }


    }, orderList: function () {
        $('.btnCancelProduct,.btnCancelOrder').click(function () {
            var data = ($(this).attr('id')).split('-');
            var orderID = parseInt(data[0]);
            var itemID = parseInt(data[1]);
            if (orderID) {
                var tmp = itemID === 0 ? 'đơn hàng' : ' sản phẩm';
                var warning = itemID === 0 ? '<br /><i style="font-size:13px;"><ins>Lưu ý</ins>: Việc hủy đơn hàng cũng đồng nghĩa với toàn bộ sản phẩm trong đơn hàng này sẽ bị hủy.</i>' : '';
                bootbox.confirm('<b>Quý khách có chắc chắn muốn hủy ' + tmp + ' này ?</b>' + warning, function (result) {
                    if (result === true) {
                        $.ajax({
                            type: "POST",
                            url: cancelURL,
                            cache: false,
                            dataType: 'json',
                            data: {orderID: orderID, itemID: itemID},
                            success: function (result) {
                                if (result.success === 1) {
                                    bootbox.alert('<b>' + result.message + '</b>', function () {
                                        window.location = window.location.href;
                                    });
                                } else {
                                    bootbox.alert(result.message);
                                }
                            }
                        });
                    }
                });
            }
        });
    }, orderView: function () {

        $("#payment-type-4 .indicator,#payment-type-5 .indicator").click(function () {
            $(this).parent().find("[name='bankID']").prop("checked", true);
        })

        $('.payment-method-modal .submit-btn').click(function () {
            var solutionPayment = $("[name='solution_payment']:checked").val();
            var bankID = $("[name='bankID']:checked").val();
            var paymentMethod = $('.paymentMethod:checked').data('type');
            if (typeof paymentMethod == "undefined") {
                return bootbox.alert('Quý khách vui lòng chọn một hình thức thanh toán.');
            }

            if (paymentMethod == "4" && typeof bankID == "undefined") {
                return bootbox.alert('Quý khách vui lòng chọn một ngân hàng để tiến hành thanh toán.');
            }
            $.ajax({
                type: "POST",
                url: paymentMethodURL,
                cache: false,
                dataType: 'json',
                data: {orderID: orderID, bankID: bankID, paymentMethod: paymentMethod, solutionPayment: solutionPayment},
                success: function (result) {
                    if (result.success === 1) {
                        if (typeof result.redirectURL == "undefined") {
                            return   window.location = window.location.href;
                        }
                        window.location = result.redirectURL;
                    } else {
                        bootbox.alert(result.message, function () {
                            window.location = window.location.href;
                        });
                    }
                }
            });
        });
    }, favourite: function () {
        $(document).ready(function () {
            $('.btnRemoveFavouriteProduct').click(function () {
                var $this = $(this);
                bootbox.confirm('<b>Bạn có chắc chắn muốn xóa sản phẩm này?', function (result) {
                    if (result === true) {
                        var favouriteID = $this.attr('rel');

                        if (favouriteID) {
                            $.ajax({
                                url: favouriteRemoveURL,
                                type: "POST",
                                async: true,
                                cache: false,
                                dataType: 'json',
                                data: {
                                    favouriteID: favouriteID
                                },
                                success: function (data) {
                                    if (data.error == 0) {
                                        bootbox.alert(data.message, function () {
                                            //reload
                                            window.location = window.location;
                                        });
                                    } else {
                                        bootbox.alert(data.message);
                                    }
                                }
                            });
                        } else {
                            bootbox.alert('Không thể xóa khỏi danh sách, xin vui lòng thử lại');
                        }
                    }
                });
            });
        });
    }, productOrderList: function () {
        $(document).ready(function () {

            var productTableEle = $('.journey-order-page').find(".product-tb");
            var viewMoreEle = productTableEle.find(".pd-price .view-more");
            var productPriceEle = null;
            var detailPriceEle = null;
            var thatEle = null;

            // Click to show/hide detail price
            viewMoreEle.click(function (e) {
                e.preventDefault();

                thatEle = $(this);
                productPriceEle = thatEle.parents(".pd-price");
                detailPriceEle = productPriceEle.find(".detail-price");

                // Show/hide detail price
                if (!detailPriceEle.is(":visible")) { // is hidden
                    detailPriceEle.slideDown(200);
                    thatEle.text("- Ẩn chi tiết");
                } else { // is show
                    detailPriceEle.slideUp(200);
                    thatEle.text("+ Xem chi tiết");
                }
            });//end click event
        });
    }, happyCode: function () {
        $(".reg-happy-code-form").validate({
            rules: {
                paymentMethod: {required: true},
                happyCode: {required: true},
            }, messages: {
                paymentMethod: {
                    required: 'Bạn chưa chọn phương thức thanh toán.',
                },
                happyCode: {
                    required: 'Bạn chưa chọn mã muốn mua',
                }
            }
        });
    }, editInfo: function () {
        $(document).ready(function () {
            $("input[name='birthdate']").inputmask("d/m/y", {"placeholder": "__/__/____"});
            $(".user-update-info").validate({
                rules: {
                    birthdate: {required: true},
                    fullname: {required: true},
                    phone: {required: true},
                    password: {required: true, maxlength: 255, minlength: 3},
                    retypePassword: {equalTo: "#password"},
                    captcha: {required: true}
                },
                messages: {
                    fullname: 'Vui lòng nhập họ và tên',
                    birthdate: 'Vui lòng nhập ngày sinh',
                    phone: 'Vui lòng nhập số điện thoại',
                    password: {
                        required: 'Bạn chưa nhập mật khẩu.',
                        minlength: 'Mật khẩu ít nhất 6 chữ và số.'
                    },
                    retypePassword: {
                        required: 'Bạn chưa xác nhận mật khẩu',
                        equalTo: 'Mật khẩu không trùng khớp. Xin vui lòng kiểm tra lại.'
                    },
                    captcha: {
                        required: 'Bạn chưa nhập mã bảo mật.',
                    }
                }
            });

            if (messageSuccess) {
                bootbox.alert(messageSuccess, function () {
                    window.location = baseurl;
                });
            }
        });
    }, registerGetGiftCode: function () {
        /*VALIDATE EDIT PROFILE*/
        $(".register-email-form").validate({
            rules: {
                email: {required: {
                        depends: function () {
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    }, minlength: 3, maxlength: 255, email: true},
                phoneNumber: {required: true, maxlength: 14, minlength: 9},
                address: {required: true, maxlength: 255, minlength: 3},
                fullName: {required: true, maxlength: 255, minlength: 3},
                captcha: {required: true},
            }, messages: {
                email: {
                    required: 'Xin vui lòng nhập Email',
                    email: 'Xin vui lòng nhập đúng định dạng email. Ví dụ : support@fado.vn',
                    minlength: 'Email tối thiểu từ 3 kí tự trở lên.',
                    maxlength: 'Email tối đa 255 kí tự'
                },
                fullName: {
                    required: 'Bạn chưa nhập họ và tên.',
                    minlength: 'Họ tên ít nhất 3 ký tự.',
                    maxlength: 'Họ tên nhiều nhất 255 ký tự.'
                },
                phoneNumber: {
                    required: 'Bạn chưa nhập số điện thoại.',
                    minlength: 'Số điện thoại ít nhất 9 ký tự.',
                    maxlength: 'Số điện thoại nhiều nhất 14 ký tự.'
                },
                address: {
                    required: 'Bạn chưa nhập địa chỉ.',
                    minlength: 'Địa chỉ ít nhất 3 ký tự.',
                    maxlength: 'Địa chỉ nhiều nhất 255 ký tự.'
                },
                captcha: {
                    required: 'Bạn chưa nhập mã bảo mật.',
                }
            },
            errorPlacement: function (error, element) {
                inputParentEle = element.parent(".group-inner");
                error.insertAfter(inputParentEle);
            }

        });
    }
};