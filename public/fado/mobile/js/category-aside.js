;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var categoryAsideEle = $('.js-category-aside');
    if(!categoryAsideEle.length) {
      return false;
    }

    var catePanelEle = categoryAsideEle.find(".cate-panel");
    var htmlEle      = $('html');
    var submitBtnEle = categoryAsideEle.find(".submit-btn");
    var lv1LinkVal   = null;
    var lv2LinkVal   = null;

    /* ========================================================================
      Exit category aside
    =========================================================================== */
    (function(){
      var exitBtnEle = categoryAsideEle.find(".exit-btn");
      exitBtnEle.on('click',function(e){
        e.preventDefault();
        htmlEle.removeClass("is-state-aside");
        categoryAsideEle.removeClass("is-show");
      });
    })();

    /* ========================================================================
      Choose category to redirect
    =========================================================================== */
    (function(){
      var lv1Ele         = catePanelEle.find(".lv1");
      var aLv1Ele        = lv1Ele.find(" > li > a");
      var liLv1Ele       = lv1Ele.find("> li");
      var closeBtnLv1Ele = aLv1Ele.find(".close-btn");
      var lv2Ele         = catePanelEle.find(".lv2");
      var liLv2Ele       = lv2Ele.find("> li");
      var aLv2Ele        = lv2Ele.find(" > li > a");
      var closeBtnLv2Ele = aLv2Ele.find(".close-btn");
      var liNotActiveEle = null;
      var liParentEle    = null;
      var thatEle        = null;
      var liLv2ChildEle  = null;

      // ---------------- a lv1 click to show list lv2 child ----------------
      aLv1Ele.on('click',function(e){
        e.preventDefault();
        thatEle     = $(this);
        lv1LinkVal  = thatEle.attr("href");
        liParentEle = thatEle.parent("li");

        liParentEle.addClass("is-active");
        liNotActiveEle = lv1Ele.find("> li:not('.is-active')");
        liNotActiveEle.hide();
      });//end event click

      // ---------------- a lv2 click to show list lv2 ----------------
      aLv2Ele.on('click',function(e){
        e.preventDefault();
        thatEle     = $(this);
        lv2LinkVal  = thatEle.attr("href");
        liParentEle = thatEle.parent("li");

        liParentEle.addClass("is-active");
        liNotActiveEle = lv2Ele.find("> li:not('.is-active')");
        liNotActiveEle.hide();
      });//end event click

      // ---------------- click close btn lv2 ----------------
      closeBtnLv2Ele.on('click',function(e){
        e.stopPropagation();
        e.preventDefault();
        thatEle = $(this);
        liParentEle = thatEle.parent("a").parent("li");
        lv2LinkVal  = null;
        liLv2Ele.removeClass("is-active");
        liLv2Ele.show();
      });//end event click

      // ---------------- click close btn lv1 ----------------
      closeBtnLv1Ele.on('click',function(e){
        e.stopPropagation();
        e.preventDefault();
        thatEle = $(this);
        liParentEle = thatEle.parent("a").parent("li");
        lv1LinkVal  = null;
        lv2LinkVal  = null;
        liLv2Ele.removeClass("is-active");
        liLv1Ele.removeClass("is-active");
        liLv1Ele.show();
        liLv2Ele.show();
      });//end event click
    })();

    /* ========================================================================
      Submit btn to change page
    =========================================================================== */
    (function(){
      submitBtnEle.on('click',function(e){
        if(lv2LinkVal) {
          window.location.href = lv2LinkVal;
        }else if(lv1LinkVal){
          window.location.href = lv1LinkVal;
        }
      });//end event click
    })();
  });
})(jQuery, window, document);
