;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var breadCrumbBlockEle = $('.js-breadcrumb-block');
    if(!breadCrumbBlockEle.length) {
      return;
    }

    var htmlEle = $('html');

    /* ========================================================================
      Back to prev page
    =========================================================================== */
    (function(){
      var aBlockTitleEle = breadCrumbBlockEle.find(".block-title a");
      var hrefVal = null;
      aBlockTitleEle.on('click',function(e){
        hrefVal = $(this).attr("href");

        if(hrefVal === "#" || hrefVal === "") {
          e.preventDefault();
          window.history.back();
        }
      });
    })();//end func

    /* ========================================================================
      Call category aside
    =========================================================================== */
    (function(){
      var callCateBtnEle = breadCrumbBlockEle.find(".call-cate-btn");
      if(!callCateBtnEle.length) {
        return;
      }

      var categoryAsideEle = $('.js-category-aside');

      callCateBtnEle.on('click',function(e){
        e.preventDefault();
        categoryAsideEle.addClass("is-show");
        htmlEle.addClass("is-state-aside");
      });//end click event
    })();
  });//end document ready
})(jQuery, window, document);
