;
(function ($, window, document, undefined) {
    "use strict";

    $(document).ready(function () {
        var orderProfileBlockEle = $('.js-order-profile-block');
        if (!orderProfileBlockEle.length) {
            return;
        }

        var thatEle = null;

        /* ========================================================================
         Show/hide receiver profile panel
         =========================================================================== */
        (function () {
            var hasReceiverInputEle = orderProfileBlockEle.find(".has-receiver-input");
            var receiverProfilePanelEle = orderProfileBlockEle.find(".receiver-profile-panel");
            var inputReceiverProfilePanelEle = receiverProfilePanelEle.find("input, select");

            hasReceiverInputEle.on('change', function () {
                thatEle = $(this);

                if (thatEle.is(":checked")) {
                    receiverProfilePanelEle.addClass("is-show");
                    inputReceiverProfilePanelEle.prop('disabled', false);
                } else {
                    receiverProfilePanelEle.removeClass("is-show");
                    inputReceiverProfilePanelEle.prop('disabled', true);
                }
            });
        })();//end func
    });//end document ready
})(jQuery, window, document);
