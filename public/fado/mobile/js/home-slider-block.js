;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var homeSliderBLockEle = $('.js-home-slider-block');


    /* ========================================================================
      Slider
    =========================================================================== */
    (function(){
      // -- Init var --
      var sliderWrapEle = homeSliderBLockEle.find(".slider-wrap");
      var pagerNavEle   = sliderWrapEle.find(".slider-pager-nav");

      var mySwiper = new Swiper (sliderWrapEle, {
        // Optional parameters
        speed                       : 500,
        loop                        : true,
        autoplay                    : false,
        autoplayDisableOnInteraction: false,
        pagination                  : pagerNavEle,
        paginationClickable         : true,
        preventClicks               : false,
      });//end swiper
    })();//end func
  });//end document ready
})(jQuery, window, document);
