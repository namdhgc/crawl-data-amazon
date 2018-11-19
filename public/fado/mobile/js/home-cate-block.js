;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var homeCateBlockEle = $('.js-home-cate-block');
    if(!homeCateBlockEle.length) {
      return;
    }

    /* ========================================================================
      Slider
    =========================================================================== */
    (function(){
      var sliderWrapEle = homeCateBlockEle.find(".slider-wrap");

      if(UAdetect._WEB_VIEW) {
        sliderWrapEle.addClass("is-webview");
        return;
      }

      sliderWrapEle.each(function(idx,ele){
        var thatEle     = $(ele);
        var nextEle     = thatEle.find(".control-nav .next");
        var prevEle     = thatEle.find(".control-nav .prev");

        var mySwiper = new Swiper (thatEle, {
          loop                    : true,
          autoplay                : false,
          nextButton              : nextEle,
          prevButton              : prevEle,
          preventClicks           : false,
          preventClicksPropagation: false,
        });//end swiper
      });//end each
    })();

    /* ========================================================================
      Cate item carousel
    =========================================================================== */
    (function(){
      var cateItemsContainerEle = homeCateBlockEle.find(".cate-items-container");
      var itemsWrapEle = cateItemsContainerEle.find(".cate-items-wrap");

      itemsWrapEle.owlCarousel({
        rewind            : true,
        loop              : true,
        margin            : 0,
        autoplay          : false,
        slideBy           : 2,
        items             : 2,
        responsive        : {
          0:{
            items:2,
          },
          768:{
            items:3,
          },
          992:{
            items:3,
          },
          1199:{
            items:4,
          }
        }
      });// owlCarousel
    })();

    /* ========================================================================
      Brand item carousel
    =========================================================================== */
    (function(){
      // ---------------- Init Carousel ----------------
      var brandItemsContainerEle = homeCateBlockEle.find(".brand-items-container");
      var itemsWrapEle = brandItemsContainerEle.find(".brand-items-wrap");

      itemsWrapEle.owlCarousel({
        rewind     : true,
        loop       : true,
        margin     : 30,
        autoplay   : false,
        slideBy    : 2,
        items      : 2,
        responsive : {
          0:{
            items  :2,
            margin : 20,
          },
          768:{
            items  :4,
            margin : 30,
          },
          992:{
            items:4,
          },
          1199:{
            items:5,
          }
        }
      });// owlCarousel

      // ---------------- Set control nav ----------------
      brandItemsContainerEle.each(function(idx,ele){
        var thatEle = $(ele);
        var brandItemWrapEle = thatEle.find(".brand-items-wrap");

        // -- Control --
        var listRoll = brandItemWrapEle.owlCarousel();

        // Next
        thatEle.find('.control-nav .next').click(function(){
          listRoll.trigger('next.owl.carousel');
          return false;
        });
        // Prev
        thatEle.find('.control-nav .prev').click(function(){
          listRoll.trigger('prev.owl.carousel');
          return false;
        });
      });//end each event
    })();

    /* ========================================================================
      Show all cate
    =========================================================================== */
    (function(){
      var homeCateHiddenWrapEle = $('.home-cate-hidden-wrap');
      var homeViewAllCateEle = $('.home-view-all-cate');

      homeViewAllCateEle.on('click',function(e){
        e.preventDefault();
        homeCateHiddenWrapEle.css("overflow","visible");
        homeCateHiddenWrapEle.css("height","auto");
        homeViewAllCateEle.hide();
      });
    })();
  });
})(jQuery, window, document);
