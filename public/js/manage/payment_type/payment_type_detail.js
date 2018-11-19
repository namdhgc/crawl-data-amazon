/**
Custom module for you to write your own javascript functions
**/
var PaymentTypeDetail = function () {

	var elem_block_loadding;
	var elm_active;

    var checkPaymentAndType = function() {

        var payment_value   = $('#payment_value').val();
        var type            = $('#type').val();

        if (payment_value == 100 && type == 0) {

            $('#specified_value').attr('disabled', true);
            $('#bonus').attr('disabled', true);
        } else {

            $('#specified_value').attr('disabled', false);
            $('#bonus').attr('disabled', false);
        }
    };

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-add-edit-payment-type-detail');
                var rules = {

                    title: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    description: {
                        required: true,
                        minlength: 3,
                        maxlength: 300
                    },
                    payment_value: {
                        required: true,
                        number: true,
                        max: 100
                    },
                    type: {
                        number: true,
                        required: true,
                        max: 3
                    },
                    cost_incurred: {
                        number: true,
                        max: 100
                    },
                    specified_value: {
                        number: true,
                        required: true,
                    },
                    bonus: {
                        number: true,
                    },
                }
                Validate.base_validate(form, rules);

                $(document).on('change','#payment_value',function(e){

                    checkPaymentAndType();
                });

                $(document).on('change','#type',function(e){

                    checkPaymentAndType();
                });
            });
        },
    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();