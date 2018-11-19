;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var blockEle = $('.js-order-payment-method-block');
    if(!blockEle.length) {
      return ;
    }

    var orderPaymentAsideEle       = $('.order-payment-aside');
    var htmlEle                    = $('html');
    var paymentTypeInputEle        = orderPaymentAsideEle.find(".payment-type-input");
    var thatEle                    = null;
    var orderPaymentDetailBlockEle = orderPaymentAsideEle.find('.order-payment-detail-block');

    /* ========================================================================
      Call order payment asideEle
    =========================================================================== */
    (function(){
      var methodItemEle      = blockEle.find(".method-item");
      var aMethodItemEle     = methodItemEle.find("> a");
      var dataPaymentTypeVal = null;

      aMethodItemEle.on('click',function(e){
        e.preventDefault();

        thatEle = $(this);

        // ---------------- Show order payment aside ----------------
        dataPaymentTypeVal = thatEle.data("payment-type");
        orderPaymentAsideEle.addClass("is-show");
        htmlEle.addClass("is-state-aside");

        // set input val
        paymentTypeInputEle.val(dataPaymentTypeVal);
        paymentTypeInputEle.attr("value",dataPaymentTypeVal);

        orderPaymentDetailBlockEle.removeClass("is-show");
        orderPaymentDetailBlockEle.filter('[data-payment-type="' + dataPaymentTypeVal + '"]').addClass("is-show");
      });
    })();//end func
  });//end document ready
})(jQuery, window, document);
