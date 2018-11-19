;(function($, window, document, undefined){
  "use strict";

  $(document).ready(function(){
    var windowEle = $(window);

    /* ========================================================================
      Welcome modal
    =========================================================================== */
    (function(){
      var welcomeModalEle = $('.js-welcome-modal');
      if(!welcomeModalEle.length) {
        return;
      }

      welcomeModalEle.modal("show");
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

  });

  $(window).load(function(){
    /* ========================================================================
      Load googleTranslate delay
    =========================================================================== */
    // (function(){
    //   setTimeout(function(){
    //     $.getScript("http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit");

    //   },2000);
    // })();//end func

    /* ========================================================================
      Change default style google select box
    =========================================================================== */
    // (function(){
    //   setTimeout(function(){
    //     var googleSelectEle = $('.goog-te-combo');
    //     var optionEle       = googleSelectEle.find("option");
    //     var optionValSel		= null;

    //     // ---------------- Load first Time ----------------
    //     optionEle.filter(":contains('Tiếng Anh')").text("English");
    //     optionEle.filter(":contains('German')").text("Deutsch");
    //     optionEle.filter(":contains('Vietnamese')").text("Tiếng Việt");
    //     optionEle.filter(":contains('German')").text("Deutsch");
    //     optionEle.filter(":contains('Tiếng Đức')").text("Deutsch");
    //     optionEle.filter(":contains('Japanese')").text("日本の");
    //     optionEle.filter(":contains('Tiếng Nhật')").text("日本の");

    //     var optionLangEle = optionEle.filter(":contains('Select Language')");
    //     // -- Change text select language --
    //     if(optionLangEle.length) {
    //       optionLangEle.text("Ngôn ngữ / Select Language");
    //     }else {
    //       googleSelectEle.prepend($('<option>', { "value" : "orgininal" }).text("Ngôn ngữ ban đầu / Show original"));
    //     }

    //     // ---------------- Change select box ----------------
    //     googleSelectEle.on('change',function(){
    //       optionEle    = $(this).find("option");
    //       optionValSel = $(this).val();

    //       setTimeout(function(){
    //         googleSelectEle = $('.goog-te-combo');
    //         optionEle       = googleSelectEle.find("option");
    //         optionLangEle   = optionEle.filter(":contains('Select Language')");

    //         if(optionValSel != "orgininal") { //
    //           googleSelectEle.prepend($('<option>', { "value" : "orgininal" }).text("Ngôn ngữ ban đầu / Show original"));
    //         }else {
    //           // Show original
    //           $(".goog-te-banner-frame").contents().find('button:contains("Show original")').trigger("click");

    //           googleSelectEle = $('.goog-te-combo');
    //           optionEle       = googleSelectEle.find("option");
    //           optionLangEle   = optionEle.filter(":contains('Select Language')");
    //           optionLangEle.text("Ngôn ngữ / Select Language");
    //         }

    //         optionEle.filter(":contains('Tiếng Anh')").text("English");
    //         optionEle.filter(":contains('German')").text("Deutsch");
    //         optionEle.filter(":contains('Vietnamese')").text("Tiếng Việt");
    //         optionEle.filter(":contains('German')").text("Deutsch");
    //         optionEle.filter(":contains('Tiếng Đức')").text("Deutsch");
    //         optionEle.filter(":contains('Japanese')").text("日本の");
    //         optionEle.filter(":contains('Tiếng Nhật')").text("日本の");
    //       },2500);//end setTimeout
    //     });//end event change
    //   },4500);//end setTimeout
    // })();//end func

    /* ========================================================================
      Set postion for Chat
    =========================================================================== */
    (function(){
      setTimeout(function(){
        var tawkchatContainerEle = $('#tawkchat-container');
        var iframeChildEle       = tawkchatContainerEle.find("> iframe:first-of-type");
        var style = "";

        style = tawkchatContainerEle.attr("style");
        tawkchatContainerEle.attr("style", style + ";z-index: 35!important;");

        style = iframeChildEle.attr("style");
        iframeChildEle.attr("style",style + ";bottom: 45px!important; right: 8px!important; z-index: 35!important");
        tawkchatContainerEle.hide();

        var toggleChatBtnELe = $('.toggle-chat-btn');
        toggleChatBtnELe.on('click',function(){
          tawkchatContainerEle.show();
          toggleChatBtnELe.remove();
        });
      },2000);
    })();
  });//end window load
})(jQuery, window, document);
