/**
Custom module for you to write your own javascript functions
**/
var CustomerFeedback = function () {

    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#customer-feedback');
                var rules = {

                    description: {
                        required: true,
                        maxlength: 2000
                    },
                    name: {
                        required: true,
                        maxlength: 100
                    },
                    email: {
                        required: true,
                        email:true,
                       noSpace: true
                    },
                    phone_number : {
                       required: true,
                       minlength: 9,
                       noSpace: true
                    }
                    ,hiddenRecaptcha: {
                         required: function () {
                             if (grecaptcha.getResponse() == '') {
                                 return true;
                             } else {
                                 return false;
                             }
                         }
                     }
                }
                Validate.base_validate(form, rules);
            });
        },
        response_feedback : function (data){
            if(data =='success'){

                var message =   'Cảm ơn quý khách đã gửi phản hồi cho chúng tôi,chúng tôi sẽ xem sét và trả lời quý khách trong thời gian sớm nhất';

            }else{

                var message =   'Chúng tôi thực sự xin lỗi quý khách ,do sự cố nên phản hồi của quý khách chưa được gửi đi. Xin quý khách vui lòng gửi lại. Chúng tôi xin chân thành cảm ơn !';
            }

            bootbox.dialog({
              message: message,
              title: "Thông Báo",
              buttons: {
                  success: {
                      label: "Thoát",
                      className: "btn-success",
                      callback: function () {
                          return;
                      }
                  }
              }
            });
        },
    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();