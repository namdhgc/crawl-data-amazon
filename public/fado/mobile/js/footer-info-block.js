;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
    var footerInfoBlockEle = $('.js-footer-info-block');
    if(!footerInfoBlockEle.length) {
      return;
    }

    var dropPanelEle = footerInfoBlockEle.find(".drop-panel");

		/* ========================================================================
      Show/hide drop panel main
		=========================================================================== */
		(function(){
      var aPanelHeadEle  = dropPanelEle.find(".panel-head a");
      var panelParentEle = null;
      var thatEle        = null;
      var mainPanelEle   = null;

      aPanelHeadEle.on('click',function(e){
        e.preventDefault();
        
        thatEle = $(this);
        panelParentEle = thatEle.parents(".drop-panel");
        mainPanelEle = panelParentEle.find(".panel-main");

        if(panelParentEle.hasClass("is-expand")){
          mainPanelEle.slideUp(200);
          panelParentEle.removeClass("is-expand");
        }else {
          mainPanelEle.slideDown(200);
          panelParentEle.addClass("is-expand");
        }
      });
		})();
	});
})(jQuery, window, document);
