var IndexDesktop = {
    index: function () {
        $(document).ready(function () {
            if (invalidQuotationMessage) {
                bootbox.alert(invalidQuotationMessage);
            }
            if (checkoutError) {
                bootbox.alert(checkoutError);
            }

            if (openModalLogin) {
                $("#dang-nhap").modal("show")
            }

            if (openModalRegister) {
                $("#dang-ky-tai-khoan").modal("show")
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
            getDeal();
        });
    }

}
function getDeal() {
    $.ajax({
        url: getDealURL,
        type: "GET",
        async: true,
        cache: false,
        dataType: 'html',
    }).done(function (res) {
        $('#san-pham-khuyen-mai').html(res);
        var pdPriceEle = $('#san-pham-khuyen-mai .text-wrap');
        if (pdPriceEle.length) {
            pdPriceEle.darkTooltip({
                content: "Giá <ins>CHƯA BAO GỒM</ins> thuế tại Mỹ<br/> và phí vận chuyển về Việt Nam.<br/>Nhấp chuột để xem chi tiết.",
                gravity: "south",
                size: 'small',
                theme: 'red',
                trigger: 'hover',
                animation: 'none',
            });
        }
    });
}

