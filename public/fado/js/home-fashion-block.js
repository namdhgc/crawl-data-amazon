;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
    var blockEle = $('.js-home-fashion-block');
		if(!blockEle.length) {
			return ;
		}

		/* ========================================================================
			Carousel brand/product item
		=========================================================================== */
		(function(){
			var mainEle = blockEle.find('.group-item-wrap');
			if(mainEle.length){
        mainEle.owlCarousel({
	        loop           : true,
	        margin         : 0,
	        autoplay       : true,
	        autoplayTimeout: 7000,
	        slideBy        : 1,
					items          : 1,
	        responsive     : {
            1200:{
              items:1,
            }
	        }
	    	});// owlCarousel

				// -- Control --
		    var listRoll = mainEle.owlCarousel();
				// Disable autoplay
				listRoll.trigger('stop.owl.autoplay');
		    // Next
		    blockEle.find('.control-nav .next').click(function(){
	        listRoll.trigger('next.owl.carousel');
					listRoll.trigger('play.owl.autoplay');
	        return false;
		    });
		    // Prev
		    blockEle.find('.control-nav .prev').click(function(){
	        listRoll.trigger('prev.owl.carousel');
					listRoll.trigger('play.owl.autoplay');
	        return false;
		    });
			}//end if
		})();//end func
	});//end document ready
})(jQuery, window, document);
