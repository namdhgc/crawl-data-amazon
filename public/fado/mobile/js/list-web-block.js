;(function($, window, document){
  "use strict";

  $(document).ready(function(){
    var listWebBlockEle = $(".js-list-web-block");
    if(!listWebBlockEle.length) {
      return;
    }

    /* ========================================================================

    =========================================================================== */
    (function(){
      var webItemWrapEle = listWebBlockEle.find(".web-item-wrap");

      webItemWrapEle.owlCarousel({
        rewind            : true,
        loop              : true,
        margin            : 0,
        autoplay          : true,
        autoplayTimeout   : 5000,
        autoplayHoverPause: true,
        slideBy           : 2,
        items             : 4,
        responsive        : {
          1200:{
            slideBy : 3,
            items   :6,
          }
        }
      });// owlCarousel

      // -- Control --
      var listRoll = webItemWrapEle.owlCarousel();
      // Next
      listWebBlockEle.find(".control-nav .next").click(function(){
        listRoll.trigger("next.owl.carousel");
        return false;
      });
      // Prev
      listWebBlockEle.find(".control-nav .prev").click(function(){
        listRoll.trigger("prev.owl.carousel");
        return false;
      });
		})();//end func
  });//end document ready
})(jQuery, window, document);