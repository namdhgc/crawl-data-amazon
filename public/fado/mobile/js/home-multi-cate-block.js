;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
    var homeMultiCateBlockEle = $('.js-home-multi-cate-block');
    if(!homeMultiCateBlockEle.length) {
      return;
    }

		/* ========================================================================
      Carousel cate item
		=========================================================================== */
		(function(){
      var cateItemsWrapEle = homeMultiCateBlockEle.find(".cate-items-wrap");
      var prevEle = homeMultiCateBlockEle.find(".control-nav .prev");
      var nextEle = homeMultiCateBlockEle.find(".control-nav .next");

      var listRoll = cateItemsWrapEle.owlCarousel({
        loop           : true,
        margin         : 10,
        autoplay       : false,
        autoplayTimeout: 7000,
				dots           : true,
        slideBy        : 3,
        responsive     : {
          0:{
            items:3,
          },
          768:{
            items:4,
          },
          992:{
            items:4,
          },
          1199:{
            items:6,
          }
        }
    	});//end owlCarousel

      // Prev
      prevEle.click(function(){
        listRoll.trigger('prev.owl.carousel');
        return false;
      });

      // Next
      nextEle.click(function(){
        listRoll.trigger('next.owl.carousel');

        return false;
      });
		})();


	});
})(jQuery, window, document);
