;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
		var windowEle = $(window);

		/* ========================================================================
			Web select control box (in main search box header)
		=========================================================================== */
		(function(){
			var mainEle = $('.js-main-search-box');

			if(mainEle.length){
				var webSelControlEle = mainEle.find(".web-sel-control");
				var webInputEle      = webSelControlEle.find(".web-input");
				var welSelEle        = webSelControlEle.find('.web-sel');
				var currentEle       = webSelControlEle.find('.current');
				var listEle          = webSelControlEle.find(".list");
				var liEle            = listEle.find("li");
				var liSelectedEle    = listEle.find("li.is-selected");

				// ---------------- Init first active in list ----------------
				currentEle.html(liSelectedEle.html());
				webInputEle.attr('value',liSelectedEle.data("value"));

				// ---------------- Click to change value select list ----------------
				liEle.click(function(e){
					var thatEle   = $(this);
					var dataValue = thatEle.data("value");

					// Set selected ele
					liEle.removeClass("is-selected");
					thatEle.addClass("is-selected");

					// Change value input
					currentEle.html(thatEle.html());
					webInputEle.attr('value',dataValue);
				});

				// ---------------- Click show/hidden select list ----------------
				currentEle.click(function(e){
					e.stopPropagation();
					listEle.slideToggle(200);
				});

				// ---------------- Hiddene list when click outsite list ----------------
				windowEle.click(function() {
					if(listEle.is(":visible")){
						listEle.slideUp(200);
					}
				});
			}//end if
		})();//end func
	});//end document
})(jQuery, window, document);
