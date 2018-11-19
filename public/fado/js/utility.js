/* ========================================================================
  Balance Height
=========================================================================== */
function balanceHeight(domElement,typeSetOpt){
  var maxHeight = 0;
  var typeSet = typeSetOpt || "outerHeight";

  if(jQuery.type(domElement) === "string"){
    domElement = $(domElement);
  }

  // Reset height
  domElement.height("auto");
  // Get max height to balance
  domElement.each(function(){
    if(typeSet == "height") {
      if($(this).height() > maxHeight){
        maxHeight = $(this).height();
      }
    }else {
      if($(this).outerHeight(true) > maxHeight){
        maxHeight = $(this).outerHeight(true);
      }
    }
  });

  domElement.height(maxHeight);
}

/* ========================================================================
  Check IE
=========================================================================== */
function isIE () {
  var myNav = navigator.userAgent.toLowerCase();
  return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1]) : false;
}

/* ========================================================================
  Map google
=========================================================================== */
function loadMap(options) {
  var settings = {
    dom: '',
    lat: 0,
    lng: 0,
    title: '',
    content: '',
  };

  settings = $.extend( {}, settings, options );

  if(document.querySelector(settings.dom) === null) {
    return;
  }

  var position = {lat: settings.lat, lng: settings.lng};

  var map = new google.maps.Map(document.querySelector(settings.dom), {
    zoom: 17,
    scrollwheel: false,
    center: position
  });

  var infowindow = new google.maps.InfoWindow({
    content: settings.content,
    title: settings.title,
  });

  var marker = new google.maps.Marker({
    position: position,
    map: map,
    title: settings.title,
    icon: {
      url: 'images/icon-pin-location.png',
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(15, 14)
    }
  });


  google.maps.event.addListenerOnce(map, "idle", function () {
    var center = map.getCenter();
    google.maps.event.trigger(map, "resize");
    infowindow.open(map, marker);
    map.setCenter(center);
  });

  return;
} // end function

/* ========================================================================
  Format money
  Exam:  valuePrice.formatMoney(0,'')
=========================================================================== */
Number.prototype.formatMoney = function(places, symbol, thousand, decimal) {
  places = !isNaN(places = Math.abs(places)) ? places : 2;
  symbol = symbol !== undefined ? symbol : "$";
  //thousand = thousand || ",";
  thousand = thousand || ".";
  decimal = decimal || ".";
  var number = this,
      negative = number < 0 ? "-" : "",
      i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
      j = (j = i.length) > 3 ? j % 3 : 0;
  return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
};

;(function($, window, document, viewport, undefined){
  "use strict";

  $(document).ready(function(){
    /* ========================================================================
      Disabled element
    =========================================================================== */
    $('.is-disabled').click(function(e){
      e.preventDefault();
    });

    /* ========================================================================
      Custom Scroll bar when overflow
    =========================================================================== */
    (function(){
      var mainEle = $('.js-scroll');

      if(mainEle.length){
        mainEle.mCustomScrollbar({
          theme:"dark"
        });
      }//end if
    })();

    /* ========================================================================
      Video item play popup
      Ex: <a class="js-play-video" href="http://youtube....">Click here</a>
    =========================================================================== */
    (function(){
      var mainEle = $('.js-play-video');

      if(mainEle.length){
        mainEle.magnificPopup({
          //delegate: 'a',
          type: 'iframe',
          //gallery:{enabled:true}
        });
      }//end if
    })(); // end func

    /* ========================================================================
      a tag scroll to offset
    =========================================================================== */
    (function(){
      var mainEle = $('a');
      if(mainEle.length){
        var dataScroll    = null;
        var hrefAttr      = null;
        var targetEle     = null;
        var offsetTop     = null;
        var heightTopMenu = 60; // header when scroll

        mainEle.click(function(event) {
          dataScroll = $(this).data("scroll");

          if(dataScroll == "scroll") {
            event.preventDefault();

            hrefAttr  = $(this).attr("href");
            targetEle = $(hrefAttr);

            if(targetEle.length) {
              offsetTop = targetEle.offset().top;

              // ---------------- Except height menu ---------------
              offsetTop = offsetTop - heightTopMenu - 15;

              // Scroll to target
              $('html,body').stop().animate({
                scrollTop: offsetTop,
              },300);
            }//end if
          }// end if
        });//end click
      }//end if
    })();//end func

    /* ========================================================================
      Fix multi modal bootstrap
    =========================================================================== */
    (function(){
      var mainEle = $('.modal-1');
      if(mainEle.length){
        var toggleEle = mainEle.find("[data-toggle*='re-modal']");

        toggleEle.click(function() {
          var dataTarget     = $(this).data("target");
          var targetModalEle = $(dataTarget);

          if(targetModalEle.length) {
            var modalCurrentEle = $(this).parents(".modal-1");
            modalCurrentEle.modal("hide");

            setTimeout(function(){
              targetModalEle.modal("show");
            }, 500);
          }
        });
      }//end if
    })();//end func

    /* ========================================================================
      Date time picker
    =========================================================================== */
    (function(){
      var mainEle = $('.js-date-picker');

      if(mainEle.length){
        mainEle.datepicker({
          format: "dd-mm-yyyy",
          language: "vi",
        });
      }//end if
    })(); // end func
  });
})(jQuery, window, document, ResponsiveBootstrapToolkit);
