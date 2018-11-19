;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var homeListCateBlockEle = $('.js-home-list-cate-block');
    if(!homeListCateBlockEle.length) {
      return;
    }

    /* ========================================================================
      carousel list cate wrap
    =========================================================================== */
    (function(){
      var itemsWrapEle = homeListCateBlockEle.find(".items-wrap");
      itemsWrapEle.owlCarousel({
        loop           :true,
        margin         :0,
        autoplay       :false,
        autoplayTimeout:7000,
        slideBy        :4,
        responsive     :{
          0:{
            items:4,
          },
          768:{
            items:4,
          },
          992:{
            items:4,
          },
          1199:{
            items:4,
          }
        }
      });//end owlCarousel
    })();//end func
  });//end document ready

  $(window).load(function(){

  });//end window load
})(jQuery, window, document);
