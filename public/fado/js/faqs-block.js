;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
    var faqsBlockEle = $('.js-faqs-block');

    if(!faqsBlockEle.length) {
      return ;
    }

    var faqBoxEle = faqsBlockEle.find(".faq-box");

		/* ========================================================================
      Expand/Unexpand faq box item
		=========================================================================== */
		(function(){
      var boxHeadEle        = faqBoxEle.find(".box-head");
      var boxMainEle        = faqBoxEle.find(".box-main");
			var boxMainCurrentEle = null;
      var boxParentEle      = null;
			var thatEle = null;

      boxHeadEle.click(function (){
        thatEle  = $(this);
        boxParentEle = thatEle.parents(".faq-box");
        boxMainCurrentEle   = boxParentEle.find(".box-main");

        if(!boxParentEle.hasClass('is-active')){
					faqBoxEle.removeClass('is-active');
          boxParentEle.addClass('is-active');
					boxMainEle.slideUp(200);
          boxMainCurrentEle.slideDown(200);
        }else{
          boxParentEle.removeClass('is-active');
          boxMainCurrentEle.slideUp(200);
        }
      });//end click event
		})();//end func
	});//end document ready
})(jQuery, window, document);
