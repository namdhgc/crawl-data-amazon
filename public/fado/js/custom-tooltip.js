;(function($, window, document, undefined){
  "use strict";

  $(window).load(function(){
    /* ========================================================================
      Tooltip
    =========================================================================== */
    (function(){
      var tooltipEle = $('.ttip');
      if(tooltipEle.length){
        var thatEle       = null;
        var tooltipPosVal = null;
        var dataTtipType  = "dark";

        var posObj = {
          "top"    : "south",
          "right"  : "west",
          "bottom" : "north",
          "left"   : "east",
        };

        tooltipEle.each(function() {
          thatEle = $(this);
          tooltipPosVal = thatEle.data("ttip-pos");

          if($(this).data("ttip-type")){
            dataTtipType = $(this).data("ttip-type");
          }

          if(tooltipPosVal) {
            tooltipPosVal = posObj[tooltipPosVal];
          }else {
            tooltipPosVal = posObj.top;
          }

          thatEle.darkTooltip({
            gravity: tooltipPosVal,
            size   : 'small',
            theme  : dataTtipType,
            trigger: 'hover',
            opacity: 1,
          });
        });
      }
    })();//end func

  });//end window load
})(jQuery, window, document);
