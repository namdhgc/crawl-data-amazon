;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
    var homeBannerBlockEle = $('.js-home-banner-block');
    if(!homeBannerBlockEle.length) {
      return;
    }

		/* ========================================================================
      Main slider
		=========================================================================== */
		(function(){
      if (isIE () && isIE () < 10) {
				return;
			}

      var mainSlider = homeBannerBlockEle.find(".slider-wrap");
      var nextEle     = mainSlider.find(".control .next");
      var prevEle     = mainSlider.find(".control .prev");
      var pagerNavEle = mainSlider.find(".pager-nav");

      var mySwiper = new Swiper (mainSlider, {
        // Optional parameters
        speed                       : 500,
        loop                        : true,
        autoplay                    : 6000,
        autoplayDisableOnInteraction: false,
        nextButton                  : nextEle,
        prevButton                  : prevEle,
        pagination                  : pagerNavEle,
        paginationClickable         : true,
        preventClicks               : false,
      });//end swiper

      mainSlider.hover(function(){
        mySwiper.stopAutoplay();
      },function(){
        mySwiper.startAutoplay();
      });
		})();//end func
	});//end document ready
})(jQuery, window, document);
