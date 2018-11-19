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
    worldWideQuotation: function () {
        $(document).ready(function () {
            /*VALIDATE FORM QUOTATION*/
            var validateQuotation = $(".request-quotation-form").validate({
                rules: {
                    "image[]": {required: true},
                }, messages: {
                    "image[]": {
                        required: 'Bạn chưa nhập đường dẫn sản phẩm bạn muốn mua.',
                    }
                }
            });

            $(document).on('click', '.add-product-btn', function () {
                var input = '<div class="group-item link-item">'
                        + '<div class="lbl"><br></div>'
                        + '<div class="input" style="float: left">'
                        + '<input type="file" name="image[]" class="form-control input-large" required>'
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
                    $("input[name='image[]']").each(function () {
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

function validateURL(s) {
    var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
    return regexp.test(s);
}
