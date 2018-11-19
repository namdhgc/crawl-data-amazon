;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
    var allCateTableEle = $(".js-all-category-table");

    if(!allCateTableEle.length) {
      return;
    }

    var windowEle             = $(window);
    var tdEle                 = allCateTableEle.find("td");
    var heightAllCateTableVal = allCateTableEle.outerHeight(true);
    var footerBlockEle        = $(".footer-block");
    var marginHeight          = 30;
    var endFixedOffsetTopVal  = footerBlockEle.offset().top;

		/* ========================================================================
      Fixed all cate table
		=========================================================================== */
		(function(){
			allCateTableEle.sticky({topSpacing:0});
			var parentStickyEle  = null;
			var currentOffsetTop = null;

      windowEle.scroll(function(){
        currentOffsetTop = windowEle.scrollTop() + heightAllCateTableVal;

        if(currentOffsetTop > endFixedOffsetTopVal) {
          allCateTableEle.unstick();
        }else {
					parentStickyEle = allCateTableEle.parent(".sticky-wrapper");
					if(!parentStickyEle.length) {
						allCateTableEle.sticky({topSpacing:0});
					}
        }
      });//end scroll
		})();//end func

    /* ========================================================================
      Click scroll to
		=========================================================================== */
    (function(){
      var hrefAttr  = null;
      var targetEle = null;
			var offsetTop = null;

      tdEle.click(function(){
        var thatEle = $(this);
        hrefAttr    = $(this).data("target");
        targetEle   = $(hrefAttr);

        if(targetEle.length) {
          offsetTop = targetEle.offset().top;

          // ---------------- Except height menu ----------------
          offsetTop = offsetTop - heightAllCateTableVal;

          // Scroll to target
          $('html,body').stop().animate({
            scrollTop: offsetTop,
          },300);
        }//end if
      });//end click
    })();//end func

    /* ========================================================================
      Scroll Spy (change active ele current position)
		=========================================================================== */
    (function(){
			var fromTop        = 0;
			var curItems       = null;
			var curItem        = null;
			var idCurItem      = null;
			var lastItemActive = "";
			var scrollItems    = tdEle.map(function(){
	    	var item = $($(this).data("target"));
	      if (item.length) {
					return item;
				}
	    });

			windowEle.scroll(function(){
				// Get container scroll position
				fromTop = windowEle.scrollTop() + heightAllCateTableVal + 2;

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
					tdEle.removeClass("is-active");
          allCateTableEle.find("td[data-target='#"+idCurItem+"']").addClass("is-active");
				}
			});//end scroll event
    })();//end func
	});//end document ready
})(jQuery, window, document);
