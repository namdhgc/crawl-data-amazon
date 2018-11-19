var QuotationDesktop = {
    list: function () {
        $(document).ready(function () {
//request quotation via email
            $(document).on('click', '.btnRequestQuotation', function () {
                QuotationDesktop.modal();
            });
            $('.bt-remove-quotation').click(function () {
                var $this = $(this);
                var id = $this.attr('rel');
                if (id) {
                    bootbox.confirm('<b>Bạn có chắc chắn muốn xóa sản phẩm này khỏi danh sách?', function (result) {
                        if (result === true) {
                            $.ajax({
                                type: "POST",
                                url: removeQuotationURL,
                                cache: false,
                                dataType: 'json',
                                data: {
                                    'id': id
                                },
                                success: function (result) {
                                    if (result.error === 0) {
                                        bootbox.alert('<b>' + result.msg + '</b>', function () {
                                            window.location.reload();
                                        });
                                    } else {
                                        bootbox.alert(result.msg);
                                    }
                                }
                            });
                        }
                    });
                }
            });
        });
    },
    modal: function () {
        bootbox.dialog({
            message: quotationForm,
            title: "Gửi yêu cầu báo giá sản phẩm qua email",
            buttons: {
                default: {
                    label: "Thoát",
                    className: "btn-default",
                    callback: function () {
                    }
                },
                success: {
                    label: "Gửi yêu cầu",
                    className: "btn-success",
                    callback: function () {
                        var fullname = $.trim($('#quotationFullname').val());
                        var email = $.trim($('#quotationEmail').val());
                        var phone = $.trim($('#quotationPhone').val());
                        var quotationContent = $.trim($('#quotationContent').val());
                        var captcha = $.trim($('#captcha').val());
                        $('#quotationFullnameError,#quotationEmailError,#quotationPhoneError,#captchaError').hide();
                        if (!fullname || fullname === '' | fullname === 'undefined') {
                            $('#quotationFullnameError').text('Vui lòng nhập họ và tên của quý khách.').show();
                            return false;
                        }
                        if (!phone || phone === '' | phone === 'undefined') {
                            $('#quotationPhoneError').text('Vui lòng nhập số điện thoại của quý khách').show();
                            return false;
                        }

                        if (!email || email === '' | email === 'undefined') {
                            $('#quotationEmailError').text('Vui lòng nhập địa chỉ email của quý khách').show();
                            return false;
                        }
                        if (validateEmail(email) === false) {
                            $('#quotationEmailError').text('Địa chỉ email không đúng, xin vui lòng kiểm tra lại.').show();
                            return false;
                        }
                        if (!captcha || captcha === '' | captcha === 'undefined') {
                            $('#captchaError').text('Vui lòng nhập mã bảo mật').show();
                            return false;
                        }

                        $.ajax({
                            url: quotationByEmailURL,
                            type: "POST",
                            async: true,
                            cache: false,
                            data: {
                                //asin: asin,
                                quotationContent: quotationContent,
                                email: email,
                                fullname: fullname,
                                phone: phone,
                                captcha: captcha
                            },
                            dataType: 'json',
                            success: function (result) {
                                bootbox.alert(result.msg, function () {
                                    window.location.reload();
                                });
                            }
                        });
                    }
                }
            }
        });
    },
    worldWideQuotation: function () {
        $(document).ready(function () {
            /*VALIDATE FORM QUOTATION*/
            var validateQuotation = $(".request-quotation-form").validate({
                rules: {
                    fullname: {required: true},
                    "link[]": {required: true},
                    email: {required: {
                            depends: function () {
                                $(this).val($.trim($(this).val()));
                                return true;
                            }
                        }, minlength: 3, maxlength: 255, email: true},
                    phone: {
                        required: true, maxlength: 12, minlength: 9},
                    captcha: {required: true},
                }, messages: {
                    fullname: {
                        required: 'Bạn chưa nhập họ và tên.',
                    }, "link[]": {
                        required: 'Bạn chưa nhập đường dẫn sản phẩm bạn muốn mua.',
                    }, email: {
                        required: 'Xin vui lòng nhập Email',
                        email: 'Xin vui lòng nhập đúng định dạng email. Ví dụ : support@fado.vn',
                        minlength: 'Email tối thiểu từ 3 kí tự trở lên.',
                        maxlength: 'Email tối đa 255 kí tự'
                    }, phone: {
                        required: 'Bạn chưa nhập số điện thoại.',
                        minlength: 'Số điện thoại tối thiểu 9 kí tự trở lên.',
                        maxlength: 'Số điện thoại tối đa 12 kí tự trở lên'
                    },
                    captcha: {
                        required: 'Bạn chưa nhập mã bảo mật.',
                    }
                }
            });

            $(document).on('click', '.add-product-btn', function () {
                var input = '<div class="group-item link-item">'
                        + '<div class="lbl">*</div>'
                        + '<div class="input">'
                        + '<input type="text" name="link[]" placeholder="Đường dẫn sản phẩm bạn muốn mua" class="form-control-1" required>'
                        + '</div>'
                        + '<button type="button" class="remove-btn btn-danger btn ttip btnDeleleLink" data-tooltip-pos="left" data-tooltip="Xóa sản phẩm này khỏi danh sách" style="cursor: pointer;"><i class="fa fa-remove"></i></button>'
                        + '</div><!-- .group-item -->';
                $('.link-group').append(input);
                $(".request-quotation-form").validate();
            });

            $(document).on('click', '.link-item .remove-btn', function () {
                $(this).parent().remove();
            });

            $('#btnSendRequest').click(function () {
                if ($(".request-quotation-form").valid()) {
                    // kiểm tra nếu có input nào null thì remove ko cho submit
                    $("input[name='link[]']").each(function () {
                        var $this = $(this);
                        if (!$this.val()) {
                            $this.parent().parent().remove();
                        }
                    });
                    $('.request-quotation-form').submit();
                }
            });
        });
    }
};
function getDistrict(cityID) {
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
                    var trigger = false;
                    $('#district').removeAttr('disabled');
                    $.each(result, function (k, v) {
                        if (v.district_id == districtID) {
                            trigger = true;
                        }
                        $('#district').append('<option value="' + v.district_id + '">' + v.district_name + '</option>');
                    });
                    trigger === true ? $('#district').val(districtID).trigger('change') : '';
                }
            }
        });
    }
}

function getWard(districtID) {
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
                    var trigger = false;
                    $('#ward').removeAttr('disabled');
                    $.each(result, function (k, v) {
                        if (v.ward_id == wardID) {
                            trigger = true;
                        }
                        $('#ward').append('<option value="' + v.ward_id + '">' + v.ward_name + '</option>');
                    });
                    trigger === true ? $('#ward').val(wardID).trigger('change') : '';
                }
            }
        });
    }
}
function validateURL(s) {
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    return regexp.test(s);
}
