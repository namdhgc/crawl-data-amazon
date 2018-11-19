;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var sidebarAsideEle = $('.js-sidebar-aside');
    if(!sidebarAsideEle.length) {
      return;
    }

    var infoPanelEle        = sidebarAsideEle.find(".info-panel");
    var subCateMenuPanelEle = sidebarAsideEle.find(".sub-cate-menu-panel");
    var cateListEle         = subCateMenuPanelEle.find(".cate-list");
    var overlayBgEle        = $('.overlay-bg');
    var htmlEle             = $("html");
    var exitBtnEle          = sidebarAsideEle.find(".exit-btn");
    var cateMenuPanelEle    = sidebarAsideEle.find(".cate-menu-panel");
    var lv1Ele              = cateMenuPanelEle.find(".lv1");
    var aLv1Ele             = lv1Ele.find(".a-lv1");

    /* ========================================================================
      Hide sidebar aside
    =========================================================================== */
    (function(){
      overlayBgEle.add(exitBtnEle).on('click',function(e){
        e.preventDefault();
        htmlEle.removeClass("is-state-aside");
        overlayBgEle.removeClass("is-show");
        sidebarAsideEle.removeClass("is-show");
      });
    })();//end func

    /* ========================================================================
      Support show/hide drop list
    =========================================================================== */
    (function(){
      var supportItemEle = sidebarAsideEle.find('.item.support');
      if(!supportItemEle.length){
        return;
      }//end if

      var dropListELe = supportItemEle.find(".drop-list");
      var titleEle    = supportItemEle.find(".title");

      titleEle.on('click',function(){
        if(supportItemEle.hasClass("is-expand")) {
          supportItemEle.removeClass("is-expand");
          dropListELe.slideUp(200);
        }else {
          supportItemEle.addClass("is-expand");
          dropListELe.slideDown(200);
        }
      });
    })();//end func

    /* ========================================================================
      Click lv1 to show sub menu panel
    =========================================================================== */
    (function(){
      var thatEle       = null;
      var cateIdData    = null;
      var lv2CurrentEle = null;

      aLv1Ele.on('click',function(e){
        thatEle = $(this);
        cateIdData = thatEle.data("cate-id");

        if(!cateIdData) {
          return;
        }

        e.preventDefault();

        // Hide info, cate menu panel
        infoPanelEle.hide();
        aLv1Ele.hide();

        // Show sub menu
        cateListEle.hide();
        lv2CurrentEle = subCateMenuPanelEle.find("[data-cate-id='" + cateIdData + "']");
        lv2CurrentEle.show();
        subCateMenuPanelEle.show();
      });
    })();

    /* ========================================================================
      click cate list to change current sub menu
    =========================================================================== */
    (function(){
      var aCateListEle   = subCateMenuPanelEle.find("li:not(.view-cate) a[data-cate-id]");
      var cateIdData     = null;
      var thatEle        = null;
      var cateCurrentEle = null;

      // ---------------- Change show cate menu ----------------
      aCateListEle.on("click",function(e){
        thatEle = $(this);
        cateIdData = thatEle.data("cate-id");

        if(cateIdData || cateIdData == "0") {
          e.preventDefault();

          if(cateIdData == "0") {
            // -------- Back to lv1 --------
            subCateMenuPanelEle.hide();
            cateListEle.hide();
            infoPanelEle.show();
            aLv1Ele.show();
          }else {
            // -------- Change to other sub menu --------
            cateListEle.hide();
            cateCurrentEle = subCateMenuPanelEle.find("[data-cate-id='" + cateIdData + "']");
            cateCurrentEle.show();
          }//end if
        }//end if
      });//end event
    })();
  });//end document ready
})(jQuery, window, document);
