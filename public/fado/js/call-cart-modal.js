;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
		/* ========================================================================
      Call cart modal
		=========================================================================== */
		(function(){
			var mainEle = $('.js-call-cart-modal');
			if(mainEle.length){
        mainEle.click(function(event) {
          // event.preventDefault();

          $.ajax({
						url: cartModalUrl,
						cache: false,
						method: "GET",
						dataType: 'json',
						success: function (resultData) {
							bootbox.dialog({
								title: "Giỏ hàng",
								message: resultData.html,
								className: "cart-modal",
								backdrop: true,
							});
						},
      		});// end ajax
        });//end click event
			}//end if
		})();//end func
	});//end document ready
})(jQuery, window, document);
