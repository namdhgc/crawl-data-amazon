;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
    var mainSearchBlock = $('.js-main-search-block');
    if(!mainSearchBlock.length) {
      return;
    }

    var windowEle       = $(window);

		/* ========================================================================
      Search form web input select
    =========================================================================== */
    (function(){
      var webSelControlEle = mainSearchBlock.find(".web-sel-control");
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
    })();
	});//end document ready
})(jQuery, window, document);
