var ConfigPrice = function() {

    var callBack_update_config_price = function(data) {

        console.log(data);
    };

    return {
        init: function() {
            $(".mt-repeater").each(function() {
                $(this).repeater({
                    show: function() {
                        $(this).slideDown(), $(".date-picker").datepicker({
                            rtl: App.isRTL(),
                            orientation: "left",
                            autoclose: !0
                        })
                    },
                    hide: function(e) {
                        confirm("Are you sure you want to delete this element?") && $(this).slideUp(e)
                    },
                    ready: function(e) {}
                })
            });

            $(document).on('change','.form-control',function(e){

                var elem    = $(this).closest("div");
                var key     = elem.find("input[type=text]").attr("name");
                var value   = elem.find("input[type=text]").val();

                // if ( key.includes('prepay') || key.includes('transaction_processing_fee') ) {

                //     var elem    = $(this).closest('.mt-repeater');
                //     var value   = document.getElementById('mt-repeater').getElementsByTagName('input');

                //     console.log(value);
                // }

                if (key != '' && value != '') {

                    var data = {
                        key: key,
                        value: value
                    };

                    App.blockUI({
                        target: '.portlet-body',
                        boxed: true,
                        textOnly: true
                    });

                    window.setTimeout(function() {
                        App.unblockUI('.portlet-body');
                    }, 2500);

                    Spr.ajaxDefault('/manager/ajax/update-config-price', data, callBack_update_config_price,$(this));
                }

                
            });
        }
    }
}();