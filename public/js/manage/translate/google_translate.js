
var GoogleTranslate = function () {

    return {
        init: function () {

          $(document).ready(function(){

              $('#google_translate_element').bind('DOMNodeInserted', function(event) {

                $('.goog-te-menu-value span:first').html('Translate');

                $('.goog-te-menu-frame.skiptranslate').load(function(){

                  setTimeout(function(){

                     $('.goog-te-menu-frame.skiptranslate').contents().find('.goog-te-menu2-item-selected .text').html('Translate');
                  }, 10);
                });
              });

              //$('.goog-te-gadget-simple').removeChild('img');
          });
        },
    };

}();
