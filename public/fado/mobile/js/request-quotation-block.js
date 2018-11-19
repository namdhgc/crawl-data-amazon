;(function($, window, document, undefined){
	"use strict";

	$(document).ready(function(){
    var requestQuotationBLockEle = $('.js-request-quotation-block');
    if(!requestQuotationBLockEle.length) {
      return;
    }

		/* ========================================================================
      File input control
		=========================================================================== */
		(function(){
			var fileControlEle = requestQuotationBLockEle.find('.file-control');
			if(!fileControlEle.length){
        return;
			}//end if

      var fileInputEle = fileControlEle.find(".file-input");
      var thatEle, fileControlParentEle, pathEle, filename = null;

      // ---------------- Change file upload ----------------
      fileInputEle.change(function(){
        thatEle              = $(this);
        fileControlParentEle = thatEle.parents(".file-control");
        filename             = thatEle.val().split('\\').pop(); // get file name
        pathEle              = fileControlParentEle.find(".path");
        
        // Set path file
        pathEle.text(filename);
      });//end each event
		})();//end func
	});//end document ready
})(jQuery, window, document);
