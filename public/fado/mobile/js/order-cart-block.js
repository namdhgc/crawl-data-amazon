;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var orderCartBlock = $('.js-order-cart-block');
    if(!orderCartBlock.length) {
      return;
    }

    var productPanelEle = orderCartBlock.find('.product-panel');
    var thatEle = null;

    /* ========================================================================
      Show/hide detail price
    =========================================================================== */
    (function(){
      var viewMoreBtnEle        = productPanelEle.find('.view-more-btn');
      var productPanelParentEle = null;
      var detailPriceEle        = null;

      viewMoreBtnEle.on('click', function(e){
        e.preventDefault();
        thatEle               = $(this);
        productPanelParentEle = thatEle.parents(".product-panel");
        detailPriceEle        = productPanelParentEle.find(".detail-price");

        if(!detailPriceEle.is(":visible")) { // is hidden
          detailPriceEle.slideDown(0);
          thatEle.text("- Ẩn chi tiết");
        }else { // is show
          detailPriceEle.slideUp(0);
          thatEle.text("+ Xem chi tiết");
        }
      });
    })();//end func
  });//end document ready
})(jQuery, window, document);
