;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
    var blockEle = $('.js-home-opinion-block');
    if(!blockEle.length) {
      return;
    }

		/* ========================================================================
      Carousel opinion earch tab
		=========================================================================== */
		(function(){
			var mainEle = blockEle.find(".tab-wrap");
			if(mainEle.length){
				mainEle.find(".opinion-item-wrap").owlCarousel({
					rewind            : true,
					loop              : true,
					margin            : 30,
					autoplay          : true,
					autoplayTimeout   : 6000,
					slideBy           : 2,
					items             : 2,
					autoplayHoverPause: true,
					responsive        : {
						1200:{
							items: 2,
						}
					}
				});// owlCarousel


        mainEle.each(function(idx,ele){
          var thatEle            = $(ele);
          var opinionItemWrapEle = thatEle.find(".opinion-item-wrap");

          // -- Control --
  		    var listRoll = opinionItemWrapEle.owlCarousel();
					// Disable autoplay
					//listRoll.trigger('stop.owl.autoplay');
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
      Title tabs
		=========================================================================== */
    (function(){
			var mainEle = blockEle.find('.block-head .title-tabs');
			if(mainEle.length){
        var liEle       = mainEle.find("li");
        var liActiveEle = liEle.filter(".is-active").last();
        var tabWrapEle  = blockEle.find(".tab-wrap");

        // ---------------- Load first sub menu box ----------------
        var dataTab          = liActiveEle.data("tab");
        var tabWrapActiveEle = blockEle.find(dataTab);

				// Set active
        tabWrapEle.removeClass("is-active");
        tabWrapActiveEle.addClass("is-active");

        // ---------------- Click to change tab active ----------------
        liEle.click(function(e){
          e.preventDefault();

          dataTab          = $(this).data("tab");
          tabWrapActiveEle = blockEle.find(dataTab);

          // -- Active tab wrap --
          tabWrapEle.removeClass("is-active");
          tabWrapActiveEle.addClass("is-active");

          // -- Active li current click --
          liEle.removeClass("is-active");
          $(this).addClass("is-active");
        });
			}//end if
		})();//end func

		/* ========================================================================
      Show/Hide choose item content
		=========================================================================== */
		(function(){
			var chooseItemEle = blockEle.find('.choose-item');
      var contentEle = chooseItemEle.find(".content");

      contentEle.each(function() {
        var thatEle = $(this);
        var scollWrapEle = thatEle.parent(".scroll-wrap");

        // Check have overflow content
        if(thatEle.height() > scollWrapEle.height()) {
          scollWrapEle.addClass("is-hide");
        }//end if

        // Button click to show/hide content
        if(scollWrapEle.hasClass("is-hide")) {
          var expandBtnChildEle = scollWrapEle.next(".expand-btn");

          expandBtnChildEle.click(function(e){
            e.preventDefault();

            if(scollWrapEle.hasClass("is-expand")) {
              // Hide content
              expandBtnChildEle.text("+ Chi tiết");
              scollWrapEle.removeClass("is-expand");
            }else {
              // Show content
              expandBtnChildEle.text("- Đóng lại");
              scollWrapEle.addClass("is-expand");
            }
          });//end click event
        }//.end if
      });
		})();//end func
	});//end document ready
})(jQuery, window, document);
