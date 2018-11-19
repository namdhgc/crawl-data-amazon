;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
    var blockEle = $('.js-home-cate-block');
		if(!blockEle.length) {
			return ;
		}

		/* ========================================================================
      Slider
		=========================================================================== */
		(function(){
			if (isIE () && isIE () < 10) {
				return;
			}

			var mainEle = blockEle.find(".slider-wrap");
			if(mainEle.length){
				var timePlay = 4500;

        mainEle.each(function(idx,ele){
          var thatEle     = $(ele);
          var nextEle     = thatEle.find(".control .next");
          var prevEle     = thatEle.find(".control .prev");
					var pagerNavEle = thatEle.find(".pager-nav");

          var mySwiper = new Swiper (thatEle, {
  					// Optional parameters
						//preloadImages               : false,
						//lazyLoading                 : true,
						//lazyLoadingOnTransitionStart: true,
						//lazyLoadingInPrevNext       : true,
						width                       : 719,
						height                      : 278,
  					//effect                    :'fade',
						speed                       : 500,
  					loop                        : false,
  					autoplay                    : timePlay,
  					autoplayDisableOnInteraction: false,
  					nextButton                  : nextEle,
  					prevButton                  : prevEle,
  					pagination                  : pagerNavEle,
  					paginationClickable         : true,
						preventClicks               : false,
  				});//end swiper

					// Disable autoplay
					mySwiper.stopAutoplay();

					// Increase tiem autoplay
					timePlay = timePlay + 400;

					// Hover to enable autoplay
					// thatEle.hover(function(){
					// 	mySwiper.startAutoplay();
					// });
        });//end each
			}//end if
		})();//end func


		/* ========================================================================
			Brand item carousel
		=========================================================================== */
		(function(){
			var mainEle = blockEle.find('.block-foot');
			if(mainEle.length){
				mainEle.find('.brand-item-wrap').owlCarousel({
					rewind            : true,
					loop              : true,
					margin            : 20,
					autoplay          : true,
					autoplayTimeout   : 4000,
					autoplayHoverPause: true,
					slideBy           : 2,
					items             : 6,
					responsive        : {
						1200:{
							items: 6,
						}
					}
				});// owlCarousel

				mainEle.each(function(idx,ele){
					var thatEle = $(ele);
					var brandItemWrapEle = thatEle.find(".brand-item-wrap");

          // -- Control --
  		    var listRoll = brandItemWrapEle.owlCarousel();
					// Disable autoplay
					listRoll.trigger('stop.owl.autoplay');
  		    // Next
  		    thatEle.find('.control-nav .next').click(function(){
  	        listRoll.trigger('next.owl.carousel');
						listRoll.trigger('play.owl.autoplay');
  	        return false;
  		    });
  		    // Prev
  		    thatEle.find('.control-nav .prev').click(function(){
  	        listRoll.trigger('prev.owl.carousel');
						listRoll.trigger('play.owl.autoplay');
  	        return false;
  		    });
				});
			}//end if
		})();//end func

		/* ========================================================================
			Show all home cate hidden
			Use overflow div to hidden items change for use display,
			avoid error js plugin other
		=========================================================================== */
		(function(){
			var mainEle = $('.js-home-view-all-cate');
			if(mainEle.length){
				var homeCateHiddenWrapEle = $('.home-cate-hidden-wrap');

				mainEle.find("a").click(function(e){
					e.preventDefault();

					// Show cate hidden
					homeCateHiddenWrapEle.css("overflow","visible");
					homeCateHiddenWrapEle.css("height","auto");

					// Hide button show all
					mainEle.hide();
				});//end click
			}//end if
		})();//end func
	});//end document ready
})(jQuery, window, document);
