;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var homePromotionBlockEle = $('.js-home-promotion-block');
    if(!homePromotionBlockEle.length) {
      return;
    }

    /* ========================================================================
      Carousel product item
    =========================================================================== */
    (function(){
      var itemsWrapEle = homePromotionBlockEle.find(".product-items-wrap");
      var prevEle = homePromotionBlockEle.find(".control-nav .prev");
      var nextEle = homePromotionBlockEle.find(".control-nav .next");

      var listRoll = itemsWrapEle.owlCarousel({
        loop           : true,
        margin         : 0,
        autoplay       : false,
        autoplayTimeout: 7000,
        dots           : true,
        slideBy        : 2,
        responsive     : {
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
      });//end owlCarousel

      // Prev
      prevEle.click(function(){
        listRoll.trigger('prev.owl.carousel');
        return false;
      });

      // Next
      nextEle.click(function(){
        listRoll.trigger('next.owl.carousel');

        return false;
      });
    })();

    /* ========================================================================
      Coutdown product item
    =========================================================================== */
    (function(){
      var producItemEle = homePromotionBlockEle.find(".product-item");
      var countDownEle = producItemEle.find(".pd-countdown");

      countDownEle.each(function(idx,ele){
        var thatEle       = $(ele);
        var timeEnd       = thatEle.data("time-end");
        var hoursValEle   = thatEle.find(".hours .val");
        var minutesValEle = thatEle.find(".minutes .val");
        var secondsValEle = thatEle.find(".seconds .val");
        var totalHours    = 0;
        var time = new Date(timeEnd + new Date().getTime());
        console.log(time);
        thatEle.countdown(time, function(event) {
          totalHours = event.offset.totalDays * 24 + event.offset.hours;

          hoursValEle.text(totalHours);
          minutesValEle.text(event.strftime("%M"));
          secondsValEle.text(event.strftime("%S"));
        });
      });
    })();
  });
})(jQuery, window, document);
