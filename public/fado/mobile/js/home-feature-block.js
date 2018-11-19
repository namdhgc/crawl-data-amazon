;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
    var homeFeatureBlockEle = $('.js-home-feature-block');
    if(!homeFeatureBlockEle.length) {
      return;
    }

    var pagerNavEle = homeFeatureBlockEle.find(".pager-nav");

		/* ========================================================================
      Slider
		=========================================================================== */
		(function(){
      (function(){
        // ----------------  Slider init ----------------
        var sliderWrapEle = homeFeatureBlockEle.find(".slider-wrap");
        var pagerItemEle = pagerNavEle.find(".pager-item");

        var mySwiper = new Swiper (sliderWrapEle, {
          // Optional parameters
          speed                       : 500,
          loop                        : true,
          autoplay                    : false,
          autoplayDisableOnInteraction: false,
          paginationClickable         : true,
          preventClicks               : false,
          onSlideChangeStart          : function(swiper) {
            pagerItemEle.removeClass("is-active");
            if(swiper.snapIndex > 5) {
              pagerItemEle.eq(0).addClass("is-active");
            }else {
              pagerItemEle.eq(swiper.snapIndex - 1).addClass("is-active");
            }
          },
        });//end swiper

        // ---------------- Change slider page nav ----------------
        var thatEle = null;
        var sliderTo = null;
        pagerItemEle.on('click',function(){
          thatEle = $(this);
          sliderTo = thatEle.index() + 1;
          mySwiper.slideTo(sliderTo);
        });//end click
  		})();//end func
		})();
	});
})(jQuery, window, document);
