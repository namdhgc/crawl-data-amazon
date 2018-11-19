var IndexMobile = {
    index: function () {
        $(document).ready(function () {
            if (invalidQuotationMessage) {
                bootbox.alert(invalidQuotationMessage);
            }
            if (checkoutError) {
                bootbox.alert(checkoutError);
            }


            if (emailQuotationError) {
                bootbox.confirm('<form id="frmEmailQuotation" action="' + urlQuotation + '" method="POST"> <div class="alert-1 alert alert-danger ">' + emailQuotationError + '</div><input class="form-control" placeholder="Vui lòng nhập địa chỉ email báo giá" name="email" type="text" autofocus=""></form>', function (result) {
                    if (result === true) {
                        $("#frmEmailQuotation").submit();
                    }
                });
            }
            if (userLoginError) {
                $("[data-target='#dang-nhap']").trigger("click");
                $(".login-modal .notify-wrap").show().find(".message").html(userLoginError);
            }
            IndexMobile.getDeal();
        });
    }, getDeal: function () {
        $(document).ready(function () {
            $.ajax({
                url: getDealURL,
                type: "GET",
                async: true,
                cache: false,
                dataType: 'html',
            }).done(function (res) {
                $('#san-pham-khuyen-mai').html(res);
            });
        });
    }
}
