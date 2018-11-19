;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var orderPaymentAsideEle = $('.js-order-payment-aside');
    if(!orderPaymentAsideEle.length) {
      return;
    }

    var htmlEle = $('html');

    /* ========================================================================
      Exit sort aside
    =========================================================================== */
    (function(){
      var exitBtnEle = orderPaymentAsideEle.find(".exit-btn");
      exitBtnEle.on('click',function(e){
        e.preventDefault();
        htmlEle.removeClass("is-state-aside");
        orderPaymentAsideEle.removeClass("is-show");
      });
    })();

    /* ========================================================================
      Change solution payment
    =========================================================================== */
    (function(){
      var spInputEle           = orderPaymentAsideEle.find(".sp-input");
      var bankSpControlWrapEle = orderPaymentAsideEle.find(".bank-sp-control-wrap");
      var bankItem             = bankSpControlWrapEle.find(".bank-item");

      // Load first time
      var dataSp = spInputEle.filter(":checked").data("sp");
      bankItem.filter(dataSp).addClass("is-show");

      // Change solution payment input
      spInputEle.on('change',function(e){
        e.preventDefault();
        dataSp = $(this).data("sp");

        bankItem.filter(":not(" + dataSp + ")").removeClass("is-show");
        bankItem.filter(dataSp).addClass("is-show");
      });
    })();
  });//end document ready
})(jQuery, window, document);
