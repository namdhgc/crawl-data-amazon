var QuotationDesktop = {
    list: function () {
        $(document).ready(function () {
//request quotation via email

            $('[data-toggle="tooltip"]').tooltip();
            
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
    worldWideQuotation2: function () {
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
    },

    worldWideQuotation: function () {
        $(document).ready(function () {
            var requestQuotationBlockV1Ele = $('.js-request-quotation-block-v1');
            if (!requestQuotationBlockV1Ele.length) {
                return false;
            }

            var requestQuotationFormEle = requestQuotationBlockV1Ele.find('.request-quotation-form');// From
            var tbodyListProductEle = requestQuotationBlockV1Ele.find('#tbodyListProduct'); //tbody
            var totalPriceListTdEle = requestQuotationBlockV1Ele.find('.total-price-list-td'); //Tổng chi phí

            var totalPriceListVNDEle = requestQuotationBlockV1Ele.find('.vn-unit'); //Tổng chi phí giá vnđ
            var priceVNDBy1USDVal = parseInt(totalPriceListVNDEle.data('1usdtovnd')); // giá vnd = 1 usd

            var btnGetLinkEle = requestQuotationBlockV1Ele.find('.get-btn'); // Nút xem ngay
            var inputLinkEle = requestQuotationBlockV1Ele.find('.link-input'); // input nhập link
            var productPanelEle = requestQuotationBlockV1Ele.find('.product-panel');
            var quotationSubmitEle = productPanelEle.find('.quotationSubmit');
            var btnGetPasteEle = requestQuotationBlockV1Ele.find('.get-btn');
            
            var tdProductLoadingEle = '<tr class="product-tr is-loading">'
                    + '<td class="array-td"></td>'
                    + '<td class="product-info-td">'
                    + '<div class="product-info-pane"><div class="pane-inner"><div class="img-col"><img src="" alt=""/></div><div class="info-col"><div class="title"><a href="#" target="_blank">(Tên sản phẩm)</a></div><div class="web">Từ website: <span class="text-blue">(website)</span></div></div></div></div><input type="text" class="note-input form-control" placeholder="Ghi chú SP: màu sắc, size,..."/>'
                    + '</td>'
                    + '<td class="product-type-td">'
                    + '<select class="form-control"><option value="0">Loại hàng</option></select>'
                    + '</td>'
                    + '<td class="quantity-td">0</td>'
                    + '<td class="weight-td">0</td>'
                    + '<td class="price-td">0</td>'
                    + '<td class="us-tax-td">0</td>'
                    + '<td class="trans-cost-td">0</td>'
                    + '<td class="total-price-td">0</td>'
                    + '<td class="control-td"><a class="remove-btn" href=""><img src="' + iconRemoveProduct + '" alt=""/></a></td>'
                    + '</tr>';

            var optionListPackageType = '<select class="form-control is-effect" data-contry=""><option value="0" data-name=""  data-import_percent="0" data-ship_fee="0" >Loại hàng</option>';
            for (var i in objListPackageType) {
                optionListPackageType += '<option value="' + i + '" data-name="' + objListPackageType[i] + '">' + objListPackageType[i] + '</option>';
            }
            optionListPackageType += '</select>';
            // ======================== GET LINK ============================
            // Click xem ngay
            btnGetLinkEle.on("click", function (e) {
                e.preventDefault();
                var linkProductVal = $.trim(inputLinkEle.val());
                ajaxAddProduct(linkProductVal);
            });

            inputLinkEle.on("keypress", function (event) {
                event.stopPropagation();
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == 13) { // nhấp enter
                    var linkProductVal = $.trim($(this).val());
                    ajaxAddProduct(linkProductVal); // get product
                    $(this).blur();

                    requestQuotationFormEle.submit(function () {
                        return false;
                    });
                } else if (keycode != 118 && keycode != 8) {
                    return false;
                }
            });
            inputLinkEle.on('paste', throttle(function () {
                var linkProductVal = inputLinkEle.val();
                inputLinkEle.val('');
                if(linkProductVal === ''){
                    return false;
                }
                ajaxAddProduct(linkProductVal); // get product
            }));
            //===========================================================

            // Key up press
            function throttle(f, delay) {
                var timer = null;
                return function () {
                    var context = this,
                            args = arguments;
                    clearTimeout(timer);
                    timer = window.setTimeout(function () {
                        f.apply(context, args);
                    }, delay || 500);
                };
            }

            function setCookie(name, value, days) {
                var d = new Date();
                d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
                var expires = "expires=" + d.toUTCString();
                document.cookie = name + "=" + value + ";" + expires + ";path=/";
            }

            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for (var i = 0; i < ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }

            function checkCookie(name) {
                var value = getCookie(name);
                if (value != "") {
                    console.log('cookie: ' + value);
                } else {
                    console.log('cookie: ' + value + ' is delete.');
                }
            }
            function removeCookie(name) {
                setCookie(name, null, -1);
            }

            // Ajax add product
            function ajaxAddProduct(linkProductVal) {
                btnGetPasteEle.attr('disabled', 'disabled');
                var trLoadingEle = tbodyListProductEle.find('tr.is-loading');
                if (trLoadingEle.length) {
                    inputLinkEle.val('');
                    bootbox.alert('<b>Có sản phẩm đang load báo giá. Vui lòng đợi, rồi hãy nhập link tiếp theo!</b>');
                    return false;
                }

                if (!validateURL(linkProductVal) || linkProductVal === '') {
                    bootbox.alert('<b>Vui lòng nhập đúng link sản phẩm!</b>');
                    inputLinkEle.val('');
                    return false;
                }
                inputLinkEle.attr('disabled', 'disabled');
                var trProductEle = tbodyListProductEle.find('tr.product-tr');
                var tdQuantityEle, urlProduct, quantityCurrentVal, check = 0, stt = 0;
                trProductEle.each(function (i, ele) {
                    urlProduct = $.trim($(ele).data('url'));
                    if (linkProductVal === decodeURIComponent(urlProduct)) {
                        check = 1;
                        tdQuantityEle = $(ele).find('.quantity-td .quantity');
                        quantityCurrentVal = parseInt(tdQuantityEle.val());
                        tdQuantityEle.val(quantityCurrentVal + 1);
                        stt = $(ele).data('stt');
                        var cookie = getCookie('listproduct[' + stt + ']');
                        cookie = JSON.parse(cookie);
                        cookie.quantity = quantityCurrentVal + 1;
                        var tdPriceVal = parseFloat(cookie.product_price);
                        setCookie('listproduct[' + stt + ']', JSON.stringify(cookie));
                        inputLinkEle.val("");

                        // tổng giá sp
                        var totalPriceTdEle = $(ele).find('.total-product-price-td');
                        var totalPriceTdVal = parseFloat(totalPriceTdEle.text());
                        totalPriceTdEle.text(ceilPrice(tdPriceVal + totalPriceTdVal));
                        // Tổng giá
                        var totalPriceProctListCurrent = ceilPrice(parseFloat(totalPriceListTdEle.text()));
                        totalPriceListTdEle.text(ceilPrice(totalPriceProctListCurrent + tdPriceVal));
                        // Giá vnd
                        var totalPriceListVal = ceilPrice(parseFloat(totalPriceListTdEle.text()));
                        var totalPriceVND = totalPriceListVal * priceVNDBy1USDVal;
                        totalPriceListVNDEle.html('(~ ' + formatVND(totalPriceVND) + ' <sup>đ</sup>)');
                        return false;
                    }
                });
                if (check === 1 && stt !== 0) {
                    var destination = tbodyListProductEle.find('tr[data-stt="' + stt + '"]').offset().top;
                    $("html:not(:animated),body:not(:animated)").animate({
                        scrollTop: destination - 50
                    }, 300);
                    inputLinkEle.val("");
                    inputLinkEle.removeAttr('disabled');
                    return false;
                }
                $.ajax({
                    url: urlWorldWideQuotation,
                    type: "POST",
                    data: {url: linkProductVal, status: 'get-product'},
                    dataType: 'text json',
                    beforeSend: function () {
                        inputLinkEle.val("");
                        inputLinkEle.focus();
                        inputLinkEle.blur();
                        if (!productPanelEle.hasClass('is-show')) {
                            productPanelEle.addClass('is-show');
                        }
                        tbodyListProductEle.append(tdProductLoadingEle);// loading
                    },
                    error: function (err) {
                        //console.log(err);
                        inputLinkEle.val("");
                        bootbox.alert("Không thể gửi được thông tin, xin quý khách lòng thử lại !!!!");
                        tbodyListProductEle.find('tr.is-loading').remove();
                        var trListProductEle = tbodyListProductEle.find('tr.product-tr');
                        if (!trListProductEle.length) {
                            tbodyListProductEle.html('');// tbody rong
                            totalPriceListTdEle.text('0.00');
                            productPanelEle.removeClass('is-show');
                        }
                        inputLinkEle.removeAttr('disabled');
                        return false;
                    },
                    success: function (res) {
                        console.log(res);
                        if (res.error == 1) {
//                            bootbox.alert(res.message);
                            tbodyListProductEle.find('tr.is-loading').remove();
                            var trListProductEle = tbodyListProductEle.find('tr.product-tr');
                            if (!trListProductEle.length) {
                                tbodyListProductEle.html('');// tbody rong
                                totalPriceListTdEle.text('0.00');
                                productPanelEle.removeClass('is-show');
                            }
//                            return false;
                        }
                        var result = res.data;
                        console.log(result);
                        var sttTdLastEle = tbodyListProductEle.find('td.array-td');
                        var stt;
                        sttTdLastEle.each(function (idx, ele) {
                            stt = idx + 1;
                        });

                        result.product_url = encodeURIComponent(result.product_url);
                        result.product_image = result.product_image ? result.product_image : noImage;
                        result.product_name = result.product_name ? result.product_name : 'Hiện website này Fado chưa cập nhật báo giá tự động. Quý khách vui lòng điền thông tin đầy đủ và nhấn gửi "Nhận báo giá chính xác" để Fado xử lý và gửi báo giá chính xác qua email';
                        result.quantity = 1;
                        result.shipping_weight = result.shipping_weight ? result.shipping_weight : 1;
                        // set cookie
                        setCookie('listproduct[' + stt + ']', JSON.stringify(result));
                        checkCookie('listproduct[' + stt + ']');

                        var shipping_weight = result.shipping_weight ? result.shipping_weight : 1;
                        var product_price = result.product_price ? parseFloat(result.product_price) : 0;
                        var estimated_fee = result.estimated_fee ? parseFloat(result.estimated_fee) : 0;
                        var discount_price = result.discount_price ? parseFloat(result.discount_price) : 0;
                        var other_charge_fee = result.other_charge_fee ? parseFloat(result.other_charge_fee) : 0;
                        var import_fee = result.import_fee ? parseFloat(result.import_fee) : 0;
                        var shipping_fee = result.shipping_fee ? parseFloat(result.shipping_fee) : 0;

                        var totalShipPrice = import_fee + shipping_fee - discount_price + other_charge_fee;
                        var totalPriceTd = ceilPrice(parseFloat(estimated_fee + totalShipPrice));

                        if (result.packageTypeFeeList) {
                            var arrPackageTypeFeeList = JSON.parse(result.packageTypeFeeList);
                            var namPackageType = '', idPackageType = 0, importFreePercent = 0, shipFeePercent = 0, selected = '';
                            var is_effect = result.id_package_type ? '' : 'is-effect';
                            optionListPackageType = '<select class="form-control ' + is_effect + '" data-contry="' + result.contry + '"><option value="0" data-name=""  data-import_percent="" data-ship_fee="" >Loại hàng</option>';
                            for (var i in arrPackageTypeFeeList) {
                                idPackageType = arrPackageTypeFeeList[i]['id'];
                                namPackageType = objListPackageType[arrPackageTypeFeeList[i]['product_type']];
                                importFreePercent = arrPackageTypeFeeList[i]['import_percent'];
                                shipFeePercent = arrPackageTypeFeeList[i]['ship_fee'];
                                selected = idPackageType === result.id_package_type ? 'selected="selected"' : '';
                                optionListPackageType += '<option value="' + idPackageType + '" data-name="' + namPackageType + '" data-import_percent="' + importFreePercent + '" data-ship_fee="' + shipFeePercent + '" ' + selected + '>' + namPackageType + '</option>';
                            }
                            optionListPackageType += '</select>';
                        }
                        var classDataTip = '';
                        if (totalPriceTd == 0) {
                            classDataTip = '<td class="total-price-td total-product-price-td ttip-v1" data-ttip="Fado chưa cập nhật lấy giá tự động cho website này. Quý khách vui lòng điền thông tin đầy đủ và nhấn gửi Nhận báo giá chính xác để Fado xử lý và gửi báo giá chính xác qua email." data-hasqtip="2" aria-describedby="qtip-2">0<br><i class="fa fa-question-circle-o" aria-hidden="true"></i></td>';
                        } else {
                            classDataTip = '<td class="total-price-td total-product-price-td ttip-v1" >' + totalPriceTd + '</td>';
                        }
                        var htmlTrProductResult = '<tr class="product-tr count_tr_' + stt + '" data-stt="' + stt + '" data-url="' + result.product_url + '">'
                                + '<td class="array-td">' + stt + '</td>'
                                + '<td class="product-info-td">'
                                + '<div class="product-info-pane"><div class="pane-inner"><div class="img-col"><img src="' + result.product_image + '" alt="' + result.product_name + '"/></div><div class="info-col"><div class="title"><a href="' + decodeURIComponent(result.product_url) + '" target="_blank">' + result.product_name + '</a></div><div class="web">Từ website: <span class="text-blue">' + result.hostname + '</span></div></div></div></div><input type="text" class="note-input form-control" placeholder="Ghi chú SP: màu sắc, size,..."/>'
                                + '</td>'
                                + '<td class="product-type-td">' + optionListPackageType + '</td>'
                                + '<td class="quantity-td"><input type="text" onkeypress="return isInt(event)" class="form-control quantity" value="' + result.quantity + '"></td>'
                                + '<td class="weight-td"><input type="text" class="form-control shipWeight" onkeypress="return isFloat(event)" value="' + ceilPrice(shipping_weight) + '"></td>'
                                + '<td class="price-td">' + ceilPrice(product_price) + '</td>'
                                + '<td class="us-tax-td">' + ceilPrice(estimated_fee) + '</td>'
                                + '<td class="trans-cost-td">' + ceilPrice(totalShipPrice) + '</td>'
                                + classDataTip
                                + '<td class="control-td"><a class="remove-btn" href=""><i class="fa fa-times" style="font-size:1.8em; color: black"></i></a></td>'
                                + '</tr>';
                        tbodyListProductEle.find('tr.is-loading').remove();
                        tbodyListProductEle.append(htmlTrProductResult);
                        callQTip($(".total-product-price-td"));
                        
                        // Tổng giá
                        var totalPriceProctListCurrent = ceilPrice(parseFloat(totalPriceListTdEle.text()));
                        totalPriceListTdEle.text(ceilPrice(totalPriceProctListCurrent + totalPriceTd));

                        // Giá vnd
                        var totalPriceListVal = ceilPrice(parseFloat(totalPriceListTdEle.text()));
                        var totalPriceVND = totalPriceListVal * priceVNDBy1USDVal;
                        totalPriceListVNDEle.html('(~ ' + formatVND(totalPriceVND) + ' <sup>đ</sup>)');

                        var destination = tbodyListProductEle.find('tr[data-stt="' + stt + '"]').offset().top;
                        $("html:not(:animated),body:not(:animated)").animate({
                            scrollTop: destination - 50
                        }, 300);
                    },
                });
                inputLinkEle.removeAttr('disabled');
            } //end func

            //Xóa sản phẩm
            tbodyListProductEle.on('click', '.remove-btn', function (e) {
                e.preventDefault();
                var that = $(this);
                bootbox.confirm("<b>Bạn muốn xóa sản phẩm này khỏi danh sách báo giá!</b>!", function (result) {
                    if (result) {
                        // Xóa tr
                        var trListProductCurrentEle = that.closest('tr.product-tr');
                        var totalPriceTdEle = trListProductCurrentEle.find('.total-product-price-td');
                        var totalPriceTdVal = ceilPrice(parseFloat(totalPriceTdEle.text()));
                        removeCookie('listproduct[' + trListProductCurrentEle.data('stt') + ']'); //xóa cookie
                        trListProductCurrentEle.remove(); // xoa tr

                        var trListProductEle = tbodyListProductEle.find('tr.product-tr');
                        trListProductEle.each(function (i, eleTr) {
                            // stt
                            $(eleTr).find('td.array-td').text(i + 1);
                        });
                        if (!trListProductEle.length) {
                            tbodyListProductEle.html('');// tbody rong
                            totalPriceListTdEle.text('0.00');
                            totalPriceListVNDEle.html('(~ 0 <sup>đ</sup>)');
                            productPanelEle.removeClass('is-show');
                        } else {
                            // Tổng giá
                            var totalPriceProctListCurrent = ceilPrice(parseFloat(totalPriceListTdEle.text()));
                            totalPriceListTdEle.text(ceilPrice(totalPriceProctListCurrent - totalPriceTdVal));

                            // Giá vnd
                            var totalPriceListVal = ceilPrice(parseFloat(totalPriceListTdEle.text()));
                            var totalPriceVND = totalPriceListVal * priceVNDBy1USDVal;
                            totalPriceListVNDEle.html('(~ ' + formatVND(totalPriceVND) + ' <sup>đ</sup>)');
                        }
                    }
                });
            });

            // Submit Form
            requestQuotationFormEle.validate({
                errorClass: 'error-class',
                rules: {
                    fullname: {
                        required: true,
                        maxlength: 255
                    },
                    email: {
                        required: true,
                        maxlength: 255,
                    },
                    phone: {
                        required: true,
                        number: true,
                        minlength: 9,
                        maxlength: 12,
                    },

                },
                messages: {
                    fullname: {
                        required: 'Họ và tên không được để trống.',
                        maxlength: 'Nhập Họ và tên tối đa 255 kí tự.'
                    },
                    email: {
                        required: 'Email không được để trống.',
                        maxlength: 'Nhập Email tối đa 255 kí tự.'
                    },
                    phone: {
                        required: 'Số điện thoại không được để trống. ',
                        number: 'Số điện thoại phải là các kí tự số. ',
                        minlength: 'Số điện thoại phải có ít nhất 9 kí tự.',
                        maxlength: 'Số điện thoại phải có nhiều nhất 12 kí tự.',
                    },
                },
                submitHandler: function () {
                    
                    var fullname = requestQuotationFormEle.find('input[name="fullname"]').val();
                    var email = requestQuotationFormEle.find('input[name="email"]').val();
                    var phone = requestQuotationFormEle.find('input[name="phone"]').val();

                    var trProductEle = tbodyListProductEle.find('tr.product-tr');
                    if (!trProductEle.length) {
                        bootbox.alert('<b>Không có sản phẩm để báo giá!</b>');
                        return false;
                    }
                    quotationSubmitEle.addClass('hidden');
                    $.ajax({
                        url: urlWorldWideQuotation,
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            fullname: fullname,
                            email: email,
                            phone: phone,
                            status: 'add-product'
                        },
                        success: function (result) {
                            if (result.error == 1) {
                                bootbox.alert('<b style="color: red">' + result.message + '</b>');
                                return false;
                            } else {
                                window.location.href = baseurl + '/gui-link-bao-gia-thanh-cong';
                            }
                        }
                    }); //end ajax

                }
            });

            //Note
            tbodyListProductEle.on('change', '.note-input', function () {
                var note = $.trim($(this).val());
                var trListProductCurrentEle = $(this).closest('tr.product-tr');
                var stt = trListProductCurrentEle.data('stt');
                var cookie = getCookie('listproduct[' + stt + ']');
                cookie = JSON.parse(cookie);
                cookie.note = note;
                cookie = JSON.stringify(cookie);
                setCookie('listproduct[' + stt + ']', cookie);
            });

            //loại hàng
            //loại hàng
            tbodyListProductEle.on('change', 'select.form-control', function () {
                var that = $(this);
                var id_package_type = parseInt($.trim(that.val()));
                var optionSelectedEle = that.find('option:selected');
                var name_package_type = $.trim(optionSelectedEle.data('name'));
                var import_percent = $.trim(optionSelectedEle.data('import_percent'));
                import_percent = isNaN(parseFloat(import_percent)) ? 0 : parseFloat(import_percent);
                var ship_fee = $.trim(optionSelectedEle.data('ship_fee'));
                ship_fee = isNaN(parseFloat(ship_fee)) ? 0 : parseFloat(ship_fee);
                var trListProductCurrentEle = that.closest('tr.product-tr');
                var stt = trListProductCurrentEle.data('stt');
                var inputshipWeightEle = trListProductCurrentEle.find('input.shipWeight');
                var inputshipWeightVal = isNaN(parseFloat(inputshipWeightEle.val())) ? 0 : parseFloat(inputshipWeightEle.val());
                var tdPriceEle = trListProductCurrentEle.find('.price-td');
                var tdUSTaxEle = trListProductCurrentEle.find('.us-tax-td');
                var tdUSTaxVal = parseFloat(tdUSTaxEle.text());
                var tdTransCostEle = trListProductCurrentEle.find('.trans-cost-td');
                var tdTotalPriceEle = trListProductCurrentEle.find('.total-product-price-td');
                
                var cookie = getCookie('listproduct[' + stt + ']');
                cookie = JSON.parse(cookie);
                cookie.id_package_type = id_package_type;
                cookie.name_package_type = name_package_type;
                cookie.shipping_fee = 0;
                cookie.import_fee_percent = import_percent;
                var contry = that.data('contry');
                var importFreeVal = cookie.import_fee, tdTransCostVal;
                switch (contry) {
                    case 'us':
                        importFreeVal = tdUSTaxVal * import_percent / 100;
                        cookie.shipping_fee = ship_fee * inputshipWeightVal;
                        break;
                    case 'jp':
                        importFreeVal = parseFloat(tdPriceEle.text()) * import_percent / 100;
                        cookie.shipping_fee = inputshipWeightVal * 10;
                        break;
                    case 'de':
                        importFreeVal = parseFloat(tdPriceEle.text()) * parseFloat(import_percent) / 100;
                        cookie.shipping_fee = inputshipWeightVal * 11.6;
                        break;
                    default:
                        break;
                }
                importFreeVal = isNaN(parseFloat(importFreeVal)) ? 0 : parseFloat(importFreeVal); 
                cookie.import_fee = ceilPrice(importFreeVal);
                tdTransCostVal = parseFloat(cookie.import_fee) + parseFloat(cookie.shipping_fee) - parseFloat(cookie.discount_price) + parseFloat(cookie.other_charge_fee);
                tdTransCostEle.text(ceilPrice(tdTransCostVal));
                // Tong gia cua san pham
                var tdTotalPriceNewVal = tdUSTaxVal + tdTransCostVal;
                tdTotalPriceEle.text(ceilPrice(tdTotalPriceNewVal));
                // setcookie
                cookie = JSON.stringify(cookie);
                setCookie('listproduct[' + stt + ']', cookie);
                checkCookie(cookie);
                if (id_package_type <= 0) {
                    that.addClass('is-effect');
                } else {
                    that.removeClass('is-effect');
                }
                //Tong Chi phi
                var totalPriceListTdVal = 0;
                var tdTotalPriceEle = tbodyListProductEle.find('.total-product-price-td');
                tdTotalPriceEle.each(function (i, val) {
                    totalPriceListTdVal += parseFloat($(val).text());
                });
                totalPriceListTdEle.text(ceilPrice(totalPriceListTdVal));
                
                // Giá vnd
                var totalPriceListVal = ceilPrice(parseFloat(totalPriceListTdEle.text()));
                var totalPriceVND = totalPriceListVal * priceVNDBy1USDVal;
                totalPriceListVNDEle.html('(~ ' + formatVND(totalPriceVND) + ' <sup>đ</sup>)');
                
            });

            //khoi luong
            tbodyListProductEle.on('change', 'input.shipWeight', function () {
                var that = $(this);
                var shippingWeight = $.trim(that.val());
                if(!checkFloat(shippingWeight)){
                    that.val('0');
                    return false;
                }
                var trListProductCurrentEle = that.closest('tr.product-tr');
                var stt = trListProductCurrentEle.data('stt');
                var selectedFormEle = trListProductCurrentEle.find('select.form-control');
                var tdUSTaxEle = trListProductCurrentEle.find('.us-tax-td');
                var tdUSTaxVal = parseFloat(tdUSTaxEle.text());
                var tdTransCostEle = trListProductCurrentEle.find('.trans-cost-td');
                var tdTotalPriceEle = trListProductCurrentEle.find('.total-product-price-td');
                var shipFreeVal = 0, tdTransCostVal;
                var contry = selectedFormEle.data('contry');
                switch (contry) {
                    case 'us':
                        var optionSelectedEle = selectedFormEle.find('option:selected');
                        var ship_fee = $.trim(optionSelectedEle.data('ship_fee'));
                        if (!ship_fee || ship_fee == 0) {
                            bootbox.alert('<b>Vui lòng chọn loại hàng trước!</b>');
                            that.val('0');
                            return false;
                        }
                        shipFreeVal = parseFloat(ship_fee) * parseFloat(shippingWeight);
                        break;
                    case 'jp':
                        shipFreeVal = parseFloat(shippingWeight) * 10;
                        break;
                    case 'de':
                        shipFreeVal = parseFloat(shippingWeight) * 11.6;
                        break;
                    default:
                        break;
                }
                var cookie = getCookie('listproduct[' + stt + ']');
                cookie = JSON.parse(cookie);
                cookie.shipping_weight = shippingWeight;
                cookie.shipping_fee = ceilPrice(shipFreeVal);
                tdTransCostVal = parseFloat(cookie.import_fee) + parseFloat(cookie.shipping_fee) - parseFloat(cookie.discount_price) + parseFloat(cookie.other_charge_fee);
                tdTransCostEle.text(ceilPrice(tdTransCostVal));
                // Tong gia cua san pham
                var tdTotalPriceNewVal = tdUSTaxVal + tdTransCostVal;
                tdTotalPriceEle.text(ceilPrice(tdTotalPriceNewVal));

                //Tong Chi phi
                var totalPriceListTdVal = 0;
                var tdTotalPriceEle = tbodyListProductEle.find('.total-product-price-td');
                tdTotalPriceEle.each(function (i, val) {
                    totalPriceListTdVal += parseFloat($(val).text());
                });
                totalPriceListTdEle.text(ceilPrice(totalPriceListTdVal));

                // Giá vnd
                var totalPriceListVal = ceilPrice(parseFloat(totalPriceListTdEle.text()));
                var totalPriceVND = totalPriceListVal * priceVNDBy1USDVal;
                totalPriceListVNDEle.html('(~ ' + formatVND(totalPriceVND) + ' <sup>đ</sup>)');

                cookie = JSON.stringify(cookie);
                setCookie('listproduct[' + stt + ']', cookie);
            });

            //Số lượng
            tbodyListProductEle.on('change', 'input.quantity', function () {
                var quantity = $.trim($(this).val());
                if(!checkInt(quantity)){
                    $(this).val('1');
                    return false;
                }
                var trListProductCurrentEle = $(this).closest('tr.product-tr');
                var stt = trListProductCurrentEle.data('stt');
                var cookie = getCookie('listproduct[' + stt + ']');
                cookie = JSON.parse(cookie);
                cookie.quantity = quantity;
                cookie = JSON.stringify(cookie);
                setCookie('listproduct[' + stt + ']', cookie);

                // thuế tại mỹ
                var estimatedFeeEle = trListProductCurrentEle.find('td.us-tax-td');
                var estimatedFeeVal = parseFloat(estimatedFeeEle.text());
                // phí dịch vụ
                var serviceFeeEle = trListProductCurrentEle.find('td.trans-cost-td');
                var serviceFeeVal = parseFloat(serviceFeeEle.text());
                // tổng giá sp
                var totalPriceTdEle = trListProductCurrentEle.find('.total-product-price-td');
                var totalPriceTdOldEle = parseFloat(totalPriceTdEle.text());
                var totalPriceTdNewEle = ceilPrice(parseFloat((estimatedFeeVal + serviceFeeVal) * quantity));
                totalPriceTdEle.text(totalPriceTdNewEle);
                //tổng giá
                var totalPriceListTdOldEle = parseFloat(totalPriceListTdEle.text());
                totalPriceListTdEle.text(ceilPrice(totalPriceListTdOldEle + (totalPriceTdNewEle - totalPriceTdOldEle)));
                // Giá vnd
                var totalPriceListVal = ceilPrice(parseFloat(totalPriceListTdEle.text()));
                var totalPriceVND = totalPriceListVal * priceVNDBy1USDVal;
                totalPriceListVNDEle.html('(~ ' + formatVND(totalPriceVND) + ' <sup>đ</sup>)');
                return false;
            });
        });
    },
    
    inputPaste: function ($this){
        var btnGetLinkEle = $this.next('.get-btn');
        if(!btnGetLinkEle.length){
            bootbox.alert('không tồn tại button');
            return false;
        }
        var inputLinkEle = $.trim($this.val());
        if(inputLinkEle !== ''){
            btnGetLinkEle.removeAttr('disabled', 'disabled');
        }
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
function ceilPrice(nStr) {
    return Math.ceil(nStr * 100) / 100;
}

function formatVND(n) {
    return n.toFixed(0).replace(/./g, function (c, i, a) {
        return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
    });
}
function checkInt(str) {
    var regexInt = new RegExp('/^\d+$/');
    return $.isNumeric(str) && !regexInt.test(str) && parseInt(str) > 0;
}
function checkFloat(str) {
    str = parseFloat(str);
    var regexFloat = new RegExp('/^((\d+(\.\d*)?)|((\d*\.)?\d+))$/');
    return $.isNumeric(str) && !regexFloat.test(str) && str > 0.00;
}
function isInt(event){
    var charCode = (event.which) ? event.which : event.keyCode;
    if (charCode > 31 && (charCode < 49 || charCode > 57))
        return false;
    return true;
}
function isFloat(event) {
  var theEvent = event || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
