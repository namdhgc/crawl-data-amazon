;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var stepsOrderPageEle = $('.js-steps-order-page');
    if(!stepsOrderPageEle.length) {
      return;
    }

    var thatEle = null;

    /* ========================================================================
      Demo rule modal
    =========================================================================== */
    // $.ajax({
    //   url    : "quy-dinh.html",
    //   cache  : false,
    //   method : "GET",
    //
    //   // Send ajax success
    //   success: function(resultData) {
    //     bootbox.dialog({
    //       message: resultData,
    //       title: "Điều khoản dịch vụ cần biết trước khi đặt mua hàng",
    //       className: "rule-modal",
    //       buttons: {
    //         exit: {
    //           label: "Thoát",
    //           className: "btn-default",
    //         },
    //         main: {
    //           label: "Đồng ý các điều khoản",
    //           className: "btn-danger",
    //           callback: function() {
    //
    //           }
    //         }
    //       }
    //     });//dialog
    //   },
    // });// end ajax

    /* ========================================================================
      Order cart block
    =========================================================================== */
    (function(){
      var orderCartBlockEle = stepsOrderPageEle.find(".order-cart-block");
      if(!orderCartBlockEle.length) {
        return;
      }

      // ---------------- Show/Hide order cart block main ----------------
      var viewMoreEle = orderCartBlockEle.find(".block-foot .view-more");
      var orderCartBlockMainEle = orderCartBlockEle.find(".block-main");
      viewMoreEle.on('click',function(){
        thatEle = $(this);

        if(orderCartBlockEle.hasClass("is-expand")){
          orderCartBlockEle.removeClass("is-expand");
          thatEle.text("+ Xem chi tiết");
        }else {
          orderCartBlockEle.addClass("is-expand");
          thatEle.text("- Ẩn chi tiết");
        }//end if
      });

      // ---------------- Show/Hide product box ----------------
      var productBoxEle          = orderCartBlockEle.find(".product-box");
      var productBoxFootEle      = productBoxEle.find(".box-foot");
      var productBoxParentEle    = null;
      var productBoxMainChildEle = null;

      productBoxFootEle.on("click",function(){
        thatEle = $(this);
        productBoxParentEle = thatEle.parent(".product-box");
        productBoxMainChildEle = productBoxParentEle.find(".box-main");

        if(productBoxParentEle.hasClass("is-expand")){
          productBoxParentEle.removeClass("is-expand");
          productBoxMainChildEle.slideUp(0);
          thatEle.text("+ Xem chi tiết giá");
        }else {
          productBoxParentEle.addClass("is-expand");
          productBoxMainChildEle.slideDown(0);
          thatEle.text("- Ẩn chi tiết giá");
        }
      });
    })();//end func

    /* ========================================================================
      Order receiver profile block
    =========================================================================== */
    (function(){
      var orderReceiverProfileBlockEle = stepsOrderPageEle.find('.order-receiver-profile-block');
      if(!orderReceiverProfileBlockEle.length) {
        return;
      }

      var blockHeadEle = orderReceiverProfileBlockEle.find(".block-head");
      var blockMainEle = orderReceiverProfileBlockEle.find(".block-main");

      // ---------------- Show/Hide block main ----------------
      var receiverProfileCbEle = orderReceiverProfileBlockEle.find(".receiver-profile-cb");
      blockHeadEle.on('click',function(){
        if(orderReceiverProfileBlockEle.hasClass("is-expand")) {
          orderReceiverProfileBlockEle.removeClass("is-expand");
          receiverProfileCbEle.attr('value',0);
        }else {
          orderReceiverProfileBlockEle.addClass("is-expand");
          receiverProfileCbEle.attr('value',1);
        }
      });
    })();
  });//end document ready

  $(window).load(function(){

  });//end window load
})(jQuery, window, document);
