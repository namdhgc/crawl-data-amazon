;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var windowEle = $(window);

    /* ========================================================================
      Change Lang
    =========================================================================== */

    $('#change-lang').change(function() {

        $('form#change-languages').submit();
    });

    /* ========================================================================
      Welcome modal
    =========================================================================== */
     (function(){
       var welcomeModalEle = $('.js-welcome-modal');
       if(!welcomeModalEle.length) {
         return;
       }
    
       welcomeModalEle.modal("show");
    
       var aboutBtnEle = welcomeModalEle.find('.about-btn');
    
       aboutBtnEle.on('click',function(e){
         welcomeModalEle.modal("hide");
       });
     })();

    /* ========================================================================
      Banner bottom scroll
    =========================================================================== */
    (function(){
      var bannerBottomScrollEle = $('.js-banner-bottom-scroll');
      if(!bannerBottomScrollEle.length) {
        return;
      }

      var hideBannerBottomScroll = Cookies.get('hide_banner_bottom_scroll');
      if(!hideBannerBottomScroll) {
        bannerBottomScrollEle.addClass("is-show");
      }else {
        return;
      }

      var exitBtnEle            = bannerBottomScrollEle.find(".exit-btn");
      var footerBlockEle        = $('.footer-block');
      var offsetEnd             = footerBlockEle.offset().top;
      var offsetBannerBottomVal = 0;

      // Click remove banner bottom
      exitBtnEle.on('click',function(e){
        e.preventDefault();

        Cookies.set('hide_banner_bottom_scroll', 'true', {expires: 2});
        bannerBottomScrollEle.remove();
      });

      // Hide when scroll to foooter block
      var windowOffsetBottomVal  = 0;

      if(bannerBottomScrollEle.hasClass("is-show")) {
        windowEle.scroll(function() {
          windowOffsetBottomVal = windowEle.scrollTop() + windowEle.height();
          offsetEnd             = footerBlockEle.offset().top;

          if(windowOffsetBottomVal > offsetEnd) {
            bannerBottomScrollEle.hide();
          }else{
            bannerBottomScrollEle.show();
          }
        });
      }
    })();

    /* ========================================================================
      Back to top
    =========================================================================== */
    (function(){
      var mainEle = $('.js-back-to-top');

      if(mainEle.length){
        windowEle.scroll(function () {
          if ($(this).scrollTop() > 200) {
            mainEle.fadeIn();
          } else {
            mainEle.fadeOut();
          }
        });

        mainEle.click(function () {
          $('body,html').animate({
            scrollTop: 0
          }, 300);
          return false;
        });
      }//end if
    })();

    /* ========================================================================
      Fix placeholder for older IE9
    =========================================================================== */
    $('input, textarea').placeholder();

    /* ========================================================================
      Parallax banner top page
    =========================================================================== */
    (function() {
      if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        return;
      }

      var bannerTopPageEle = $('.js-banner-top-page');
      if(!bannerTopPageEle.length) {
        return;
      }

      var s = skrollr.init({
        render: function(data) {
          //Debugging - Log the current scroll position.
          //console.log(data.curTop);
        }
      });
    }());
  });//end document ready

  $(window).load(function(){


    /* ========================================================================
      Animated hotline scroll
    =========================================================================== */
    (function(){
      var hotlineScrollEle = $('.js-hotline-scroll');
      if(!hotlineScrollEle.length) {
        return;
      }

      setInterval(function() {
        $('.js-hotline-scroll .animated-circles').addClass('animated');
        setTimeout(function () {
          $('.js-hotline-scroll .animated-circles').removeClass('animated');
        }, 5000);
      }, 10000);
    })();

  });//end window load
})(jQuery, window, document);
