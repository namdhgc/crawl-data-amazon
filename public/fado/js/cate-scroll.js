;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
    var cateScrollEle = $('.js-cate-scroll');
    // Check
    if(!cateScrollEle.length) {
      return;
    }
    // Init var
    var windowEle           = $(window);
    var widthCateScrollVal  = cateScrollEle.outerWidth(true);
    var heightCateScrollVal = cateScrollEle.outerHeight(true);
    var widthBodyVal        = 1200;
    var topFixedVal         = 90;
		var liEle               = cateScrollEle.find("li");

    // Start positon to show scroll
    var homePromotionBlockEle = $('.home-promotion-block');
    var offsetStart           = homePromotionBlockEle.offset().top - topFixedVal; //-30px css style top:30px of cateScrollEle

		/* ========================================================================
      Change size window
		=========================================================================== */
		(function(){
      var outsiteBodyVal = 0;
      var leftFixedVal   = 0;
      var widthWindowVal = 0;
      var offsetTop      = 0;

      // ---------------- Load first time ----------------
      widthWindowVal = windowEle.width();
      outsiteBodyVal = (widthWindowVal - widthBodyVal) / 2;
      leftFixedVal   = outsiteBodyVal - widthCateScrollVal;
      cateScrollEle.css("left", leftFixedVal);

      // ---------------- Event resize ----------------
			windowEle.resize(function() {
        widthWindowVal = windowEle.width();
        offsetTop      = windowEle.scrollTop();
        outsiteBodyVal = (widthWindowVal - widthBodyVal) / 2;
        leftFixedVal   = outsiteBodyVal - widthCateScrollVal;

        // Set left positon
        cateScrollEle.css("left", leftFixedVal);

        // Hide/show when change size window
        if(widthWindowVal >= 1330 && offsetTop >= offsetStart) {
          cateScrollEle.show();
        }else {
          cateScrollEle.hide();
        }
      });// end window resize
		})();//end func

    /* ========================================================================
      Scroll window
		=========================================================================== */
    (function(){
      // End postion to hide scroll
      var homeMultiCateBlockEle = $('.home-multi-cate-block');
      var offsetEnd             = homeMultiCateBlockEle.offset().top - heightCateScrollVal - 40;

      // ---------------- Event resize ----------------
      windowEle.scroll(function() {
        var offsetTopVal = windowEle.scrollTop();
        offsetEnd        = homeMultiCateBlockEle.offset().top - heightCateScrollVal - 40; // Update end

        if(offsetTopVal >= offsetStart && offsetTopVal <= offsetEnd) {
          cateScrollEle.show();
        }else {
          cateScrollEle.hide();
        }
      });//end window scroll
    })();//end func

    /* ========================================================================
      Click scroll to
		=========================================================================== */
    (function(){
      var hrefAttr              = "";
      var homeCateHiddenWrapEle = $('.home-cate-hidden-wrap');

      liEle.each(function(idx,ele) {
        var thatEle   = $(this);
        var aChildEle = thatEle.find("a");

        // ---------------- Click to scroll target ----------------
        aChildEle.click(function(event){
          event.preventDefault();

          // Get target to scroll
          hrefAttr      = $(this).attr("href");
          var targetEle = $(hrefAttr);

          // -------- Show hidden home cates --------
          if(idx > 5) {
            // Show cate hidden
  					homeCateHiddenWrapEle.css("overflow","visible");
  					homeCateHiddenWrapEle.css("height","auto");
            $('.js-home-view-all-cate').hide();
          }//


          if(targetEle.length) {
            var offsetTop = targetEle.offset().top;
            offsetTop     = offsetTop - topFixedVal; // -30px css style top:30px of cateScrollEle

            // Scroll to target
            $('html,body').stop().animate({
              scrollTop: offsetTop,
            },300);
          }//end if
        });// end click
      });// end each
    })();//end func

    /* ========================================================================
      Scroll Spy (change active ele current position)
		=========================================================================== */
    (function(){
			var aEle                                              = cateScrollEle.find("a");
			var lastItemActive,fromTop,curItems,curItem,idCurItem = "";
			var scrollItems                                       = aEle.map(function(){
	    	var item = $($(this).attr("href"));
	      if (item.length && item.is(":visible")) {
					return item;
				}
	    });

			windowEle.scroll(function(){
				// Get container scroll position
				fromTop = windowEle.scrollTop() + topFixedVal + 2;

				// Get list id of current scroll item
				curItems = scrollItems.map(function(){
					if ($(this).offset().top < fromTop)
						return this;
				});

				// Get the id of the current element
   			curItem = curItems[curItems.length-1];

				idCurItem = null;
				if(curItem && curItem.length) {
					idCurItem = curItem[0].id;
				}

				if (lastItemActive !== idCurItem) {
						lastItemActive = idCurItem;
						// Set/remove active class
						aEle
							.parent().removeClass("is-active")
							.end().filter("[href='#"+idCurItem+"']").parent().addClass("is-active");
				}
			});//end scroll
    })();//end func
	});//end document ready
})(jQuery, window, document);
