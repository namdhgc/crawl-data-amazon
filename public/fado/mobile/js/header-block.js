;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var headerBlockEle = $('.js-header-block');
    if(!headerBlockEle.length) {
      return;
    }

    var overlayBgEle    = $('.overlay-bg');
    var sidebarAsideEle = $('.sidebar-aside');
    var htmlEle         = $('html');
    var searchFormEle   = headerBlockEle.find(".search-form");
    var windowEle       = $(window);

    /* ========================================================================
      Header scroll
    =========================================================================== */
    (function(){
      if(UAdetect._WEB_VIEW) {
        return;
      }

      var didScroll;
      var lastScrollTop = 0;
      var delta = 5;
      var navbarHeight = headerBlockEle.outerHeight();

      windowEle.scroll(function(event){
        didScroll = true;
      });

      setInterval(function() {
        if (didScroll) {
          var st = $(this).scrollTop();

          // Make sure they scroll more than delta
          if(Math.abs(lastScrollTop - st) <= delta)
              return;

          // If they scrolled down and are past the navbar, add class .nav-up.
          // This is necessary so you never see what is "behind" the navbar.
          if (st > lastScrollTop && st > navbarHeight){
            // Scroll Down
            headerBlockEle.addClass("is-scroll");
          } else {
            // Scroll Up
            if(st + windowEle.height() < $(document).height()) {
              headerBlockEle.removeClass('is-scroll');
            }
          }

          lastScrollTop = st;
          didScroll = false;
        }
      }, 250);
    })();

    /* ========================================================================
      Call sidebar aside
    =========================================================================== */
    (function(){
      var callSidebarBtnEle = $('.call-sidebar-btn');
      callSidebarBtnEle.on('click',function(e){
        e.preventDefault();
        htmlEle.addClass("is-state-aside");
        overlayBgEle.addClass("is-show");
        sidebarAsideEle.addClass("is-show");
      });
    })();//end func

    /* ========================================================================
      Call search form
    =========================================================================== */
    (function(){
      var callSearchBtnEle = $('.call-search-btn');
      var keywordInputEle = searchFormEle.find(".keyword-input");

      callSearchBtnEle.on('click',function(e){
        e.preventDefault();
        htmlEle.addClass("is-state-aside");
        overlayBgEle.addClass("is-show");
        headerBlockEle.addClass("is-sticky");
        searchFormEle.addClass("is-show");
        keywordInputEle.focus();
      });
    })();//end func

    /* ========================================================================
      Hide search form
    =========================================================================== */
    (function(){
      overlayBgEle.on('click',function(){
        htmlEle.removeClass("is-state-aside");
        overlayBgEle.removeClass("is-show");
        headerBlockEle.removeClass("is-sticky");
        searchFormEle.removeClass("is-show");
      });
    })();

    /* ========================================================================
      Search form web input select
    =========================================================================== */
    (function(){
      var webSelControlEle = searchFormEle.find(".web-sel-control");
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
