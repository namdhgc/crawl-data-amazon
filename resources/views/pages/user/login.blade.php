<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8"/>
      <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"/>
      <title>Đăng nhập</title>
      <link href="{{ URL::asset('fado/css/login.min.css') }}" rel="stylesheet" type="text/css" />
      <link href="{{ URL::asset('assets/global/plugins/bootstrap-toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
      <style type="text/css">
         .logo img{
            width: 215px;
         }
         .clearfix {
            height: 80px;
         }
      </style>

      <script src="{{ URL::asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
      <script src="{{ URL::asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
      <script src="{{ URL::asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/global/plugins/bootstrap-toastr/toastr.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/pages/scripts/ui-blockui.min.js') }}" type="text/javascript"></script>
      <script src="{{ URL::asset('js/lib/helper.js') }}" type="text/javascript"></script>

        <script src="{{ URL::Asset('js/lib/function.js') }}" type="text/javascript"></script>
        <script src="{{ URL::Asset('js/lib/spr.js') }}" type="text/javascript"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>

        <script src="{{ URL::asset('fado/js/jquery.validate.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/localization/messages_vi.min.js') }}" type="text/javascript"></script>
      <script type="text/javascript">
         // var baseurl = 'http://fado.vn';
         // var staticurl = 'http://static1.fado.vn';
         // var headerAjax = '/menu-header-ajax';
         // var loginURL = '/dang-nhap';
         // var registerURL = '/dang-ky-thanh-vien';
         // var lostPasswordURL = '/quen-mat-khau';
      </script>
   </head>
   <body>
      <header>
         <a class="logo" href="{{ URL::Route('web-get-homePage') }}">
                <span class="inner">
                <?php 
                    $logo  = "";
                    if(!empty(Cache::get('logo'))){
                        $logo   = Cache::get('logo');  
                    }
                    ?>
                <img src="{{ URL::asset( $logo ) }}" >
                </span>
                </a>
      </header>
      <section class="user-block">
         <div class="block-main">
            <div class="intro-segment">
               <div class="title">
                  QUYỀN LỢI THÀNH VIÊN
               </div>
               <ul class="list">
                  <li>
                     <i class="fd checked-red">
                     </i>
                     Mua hàng khắp thế giớ cực dễ dàng, nhanh chóng.
                  </li>
                  <li>
                     <i class="fd checked-red">
                     </i>
                     Theo dõi đơn hàng hành trình đơn hàng.
                  </li>
                  <li>
                     <i class="fd checked-red">
                     </i>
                     Nhận nhiều ưu đãi hấp dẫn từ khắp thế giới.
                  </li>
               </ul>
            </div>
            <!-- .intro-segment -->
            <div class="user-segment">
               <div class="segment-head">
                  <a class="title-tab is-active" href="javascript:void(0)" data-forcus="login-form">
                  Đăng nhập
                  </a>
                  <a class="title-tab" href="javascript:void(0)" data-forcus="register-form">
                  Đăng ký
                  </a>
               </div>
               <!-- .segment-head -->
               <div class="segment-main">
                  <form class="login-form theme-form form-action-user" action="{{ URL::Route('customer-post-login') }}" method="POST" id="login-form">
                     <div class="notify-wrap" style="display: none">
                        <div class="alert-1 alert alert-danger message">
                        </div>
                     </div>
                     <div class="form-group border-group">
                        <div class="group-inner error">
                           <div class="icon">
                              <i class="fd email">
                              </i>
                           </div>
                           <input class="form-control" placeholder="Tên đăng nhập" type="text" name="username"/>
                           <div class="border">
                           </div>
                        </div>
                     </div>
                     <!-- .form-group -->
                     <div class="form-group border-group">
                        <div class="group-inner">
                           <div class="icon">
                              <i class="fd key">
                              </i>
                           </div>
                           <input class="form-control" placeholder="Vui lòng nhập mật khẩu" type="password" name="password"/>
                           <div class="border">
                           </div>
                        </div>
                     </div>
                     <!-- .form-group -->
                     <div class="request-pass-field">
                        <a data-toggle="modal" data-target="#lay-lai-mat-khau" href="#">
                        Quên mật khẩu ?
                        </a>
                        <a data-toggle="modal" id="finish-request-pass-modal" class="hidden" data-target=".finish-request-pass-modal" href="#"></a>
                     </div>
                     <div class="btn-wrap">
                        <button type="button" id="bt-login" class="submit-btn btn btn-pill btn-lg btn-main-color">
                        <i class="fa"></i> Đăng nhập
                        </button>
                     </div>
                     <div class="login-width-field">
                        <div class="field-title">
                           <span>
                           Hoặc đăng nhập qua
                           </span>
                        </div>
                        <div class="row">
                           <div class="col-xs-6">
                              <a class="social-btn fb" href="javascript:;" onclick="socialLogin('https://www.facebook.com/v2.9/dialog/oauth?client_id=379542705504383&state=e2874004bf4fadc679f4732bf53c027e&response_type=code&sdk=php-sdk-5.5.0&redirect_uri=http%3A%2F%2Ffado.vn%2Fdang-nhap-bang-mang-xa-hoi-facebook&scope=email%2Cpublic_profile')">
                              <i aria-hidden="true" class="fa fa-facebook-f">
                              </i>
                              Facebook
                              </a>
                           </div>
                           <div class="col-xs-6">
                              <a class="social-btn gp" href="javascript:;" onclick="socialLogin('https://accounts.google.com/o/oauth2/auth?response_type=code&redirect_uri=http%3A%2F%2Ffado.vn%2Fdang-nhap-bang-mang-xa-hoi-google&client_id=701745402520-dg85nkn87it0untk25e7moq233jauc0p.apps.googleusercontent.com&scope=email+profile&access_type=online&approval_prompt=auto')">
                              <i aria-hidden="true" class="fa fa-google-plus">
                              </i>
                              Google
                              </a>
                           </div>
                        </div>
                     </div>
                     <!-- .login-width-field -->
                     <div class="register-field">
                        Bạn chưa có tài khoản
                        <a href="/dang-ky-thanh-vien">
                        Đăng ký ngay
                        </a>
                     </div>
                  </form>

                  <form class="register-form reg-user-form theme-form form-action-user" action="{{ URL::Route('web-post-ajax-register-user') }}" method="POST" style="display:none;" novalidate="novalidate" id="register-form">
                     <div class="notify-wrap" style="display: none">
                         <div class="alert-1 alert alert-danger message">
                         </div>
                     </div>
                     <div class="form-group border-group">
                         <div class="group-inner">
                             <div class="icon"><i class="fd user"></i></div>
                             <input type="text" class="form-control" placeholder="Tên đăng nhập" name="username">
                             <div class="border"></div>
                         </div>
                     </div><!-- .form-group -->

                     <div class="form-group border-group">
                         <div class="group-inner">
                             <div class="icon"><i class="fd user"></i></div>
                             <input type="text" class="form-control" placeholder="Họ và tên" name="fullName">
                             <div class="border"></div>
                         </div>
                     </div>

                     <div class="form-group border-group">
                         <div class="group-inner">
                             <div class="icon"><i class="fd email"></i></div>
                             <input type="email" class="form-control" placeholder="Vui lòng điền địa chỉ Email" name="email">
                             <div class="border"></div>
                         </div>
                     </div><!-- .form-group -->

                     <div class="form-group border-group">
                         <div class="group-inner">
                             <div class="icon"><i class="fd phone"></i></div>
                             <input type="text" class="form-control" placeholder="Vui lòng điền Số điện thoại" name="phone_number">
                             <div class="border"></div>
                         </div>
                     </div><!-- .form-group -->

                     <div class="form-group border-group">
                         <div class="group-inner">
                             <div class="icon"><i class="fd key"></i></div>
                             <input type="password" class="form-control" placeholder="Vui lòng đặt mật khẩu" name="password" id="password">
                             <div class="border"></div>
                         </div>
                     </div><!-- .form-group -->

                     <div class="form-group border-group">
                         <div class="group-inner">
                             <div class="icon"><i class="fd key"></i></div>
                             <input type="password" class="form-control" placeholder="Vui lòng nhập lại mật khẩu" name="retypePassword">
                             <div class="border"></div>
                         </div>
                     </div><!-- .form-group -->

                     <div class="form-group border-group clearfix">
                         <div class="group-inner">
                              <div class="g-recaptcha" data-sitekey="6LccdiUUAAAAAE0n2pSzf4gH74s8GfPbObb7IjzV" data-callback="recaptchaCallback"></div>
                              <input type="hidden" class="hiddenRecaptcha" name="hiddenRecaptcha" id="hiddenRecaptcha">
                         </div>
                     </div><!-- .form-group -->

                     <div class="btn-wrap">
                         <button type="button" id="bt-register" class="submit-btn btn btn-pill btn-lg btn-main-color"><i class="fa"></i> Đăng ký</button>
                     </div>
                 </form>
                  <!-- .login-form -->
               </div>
               <!-- .segment-main -->
            </div>
            <script type="text/javascript">
               function callback_login (res) {

                    if(res.meta.success) {

                        window.location.href = window.location.origin;
                    }else{

                        $('#login-form').find('.notify-wrap').show();
                        $('#login-form').find('.notify-wrap').find('div').html(res.meta.msg.login);
                    }
                }

                $(document).ready(function() {

                    $('#bt-login').click(function(e) {

                        e.preventDefault();
                        console.log('ádasd');
                        var username = $('#login-form').find('input[name="username"]').first().val();
                        var password = $('#login-form').find('input[name="password"]').first().val();

                        if(username == '' || password == '') {

                            $('#login-form').find('.notify-wrap').find('div').html('Tên đăng nhập và mật khẩu không được để trống');
                            $('#login-form').find('.notify-wrap').show();
                        }else {

                                var data    =   {
                                    username    : username,
                                    password    : password
                                };

                                Spr.ajaxDefault($('#login-form').attr('action'), data, callback_login,$('.user-segment'));
                        }
                        
                    });
                });
            </script>
            <!-- .user-segment -->
         </div>
         <!-- .block-main -->
      </section>
      <!-- .user-block -->
      <footer>
         <div class="container">
            <div class="copyright-segment">
               Copyright © 2017 Sumoshipping
               <br/>
               Đơn vị chủ quản:
               <span>
               <?php echo Cache::get('company_name');?>
               </span>
            </div>
            <nav class="menu-page-nav">
               <ul class="lv1-ul">
                  <li>
                     <a href="{{ URL::Route('web-get-frequently-asked-questions') }}" target="_blank">
                     Hỏi đáp
                     </a>
                  </li>
                  <!-- <li class="line">
                     /
                  </li>
                  <li>
                     <a href="#" target="_blank">
                     Hướng dẫn
                     </a>
                  </li>
                  <li class="line">
                     /
                  </li>
                  <li>
                     <a href="#" target="_blank">
                     Hỗ trợ
                     </a>
                  </li> -->
               </ul>
            </nav>
         </div>
         <!-- .container -->
         <div class="modal request-pass-modal" id="lay-lai-mat-khau" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                     <span aria-hidden="true">
                     ×
                     </span>
                     </button>
                     <h4 class="modal-title">
                        Lấy lại mật khẩu
                     </h4>
                  </div>
                  <div class="modal-body">
                     <form class="request-pass-form" id="form-reset-pass" action="{{ URL::Route('web-post-ajax-reset-password') }}" method="POST">
                        <div class="notify-wrap"  style="display: none">
                           <div class="alert-1 alert alert-danger message">
                           </div>
                        </div>
                        <!-- .notify-wrap -->
                        <div class="form-group border-group">
                           <div class="group-inner">
                              <div class="icon">
                                 <i class="fd email">
                                 </i>
                              </div>
                              <input class="form-control" placeholder="Vui lòng điền địa chỉ Email" name="email" type="email"/>
                              <div class="border">
                              </div>
                           </div>
                        </div>
                        <!-- .form-group -->
                        <div class="btn-wrap">
                           <button type="button" id="bt-request-pass" class="submit-btn btn btn-pill btn-lg btn-main-color">
                           <i class="fa"></i> Xác nhận
                           </button>
                        </div>
                     </form>
                     <!-- .request-pass-form -->
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>
         <!-- /.modal -->                    
         <div class="modal finish-request-pass-modal" role="dialog" tabindex="-1">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                     <span aria-hidden="true">
                     ×
                     </span>
                     </button>
                     <h4 class="modal-title">
                        Email thay đổi mật khẩu vừa được gửi đi
                     </h4>
                  </div>
                  <div class="modal-body">
                     <div class="intro-pane">
                        <div class="text">
                           Vui lòng tuần tự làm theo các bước hướng dẫn sau để thay đổi mật khẩu của bạn tại website Fado.vn
                        </div>
                     </div>
                     <div class="step-pane-wrap">
                        <div class="step-pane">
                           <div class="img-col">
                              <span>
                              <i class="fd email60-white">
                              </i>
                              </span>
                           </div>
                           <div class="info-col">
                              <div class="title">
                                 Bước 1:
                              </div>
                              <div class="desc">
                                 Mở Email trong hộp thư đến (Inbox)
                              </div>
                           </div>
                        </div>
                        <div class="step-pane">
                           <div class="img-col">
                              <span>
                              <i class="fd link60-white">
                              </i>
                              </span>
                           </div>
                           <div class="info-col">
                              <div class="title">
                                 Bước 2:
                              </div>
                              <div class="desc">
                                 Nhấp chọn vào đường dẫn trong Email
                              </div>
                           </div>
                        </div>
                        <div class="step-pane">
                           <div class="img-col">
                              <span>
                              <i class="fd lock60-white">
                              </i>
                              </span>
                           </div>
                           <div class="info-col">
                              <div class="title">
                                 Bước 3:
                              </div>
                              <div class="desc">
                                 Tiếp tục thay đổi mật khẩu tại website Fado.vn
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- .step-pane-wrap -->
                  </div>
               </div>
               <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
         </div>

         <script type="text/javascript">
            
            function callback_reset_pass (res) {

               if(res.meta.success) {
                  $('#lay-lai-mat-khau').modal('hide');
                  $('.finish-request-pass-modal').modal('show');
              }else{

                  $('#form-reset-pass').find('.notify-wrap').show();
                  $('#form-reset-pass').find('.notify-wrap').find('div').html(res.meta.msg['forgot-pass']);
              }
            }

            function callback_register(res) {

               if(res.meta.success) {
                  
                  window.location.href = window.location.origin;
              }else{
                  
                  $('#register-form').find('.notify-wrap').show();

                  var msg = '';

                  for (var key in res.meta.msg) {
                     msg += key +" : " + res.meta.msg[key] + '</br>';
                  }
                  $('#register-form').find('.notify-wrap').find('div').html(msg);
                  $('#register-form').find('.notify-wrap').find('div').show();
                  grecaptcha.reset();
              }
            }

            function recaptchaCallback() {
              $('#hiddenRecaptcha').valid();
            };
            $(document).ready(function() {

               $('#bt-request-pass').click(function(e) {

                  e.preventDefault();

                  var email = $('#form-reset-pass input[name="email"]').first().val();

                  var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
                  if (testEmail.test(email)) {

                     var data    =   {
                        email    : email,
                    };

                    Spr.ajaxDefault($('#form-reset-pass').attr('action'), data, callback_reset_pass,$('#lay-lai-mat-khau'));
                  }else {

                     $('#form-reset-pass .notify-wrap').show();
                     $('#form-reset-pass .notify-wrap div').html('Bạn cần nhập email để lấy lại mật khẩu');

                  }
               });

               $('.title-tab').click(function(e){

                  e.preventDefault();

                  var forcus = $(this).attr('data-forcus');

                  $('.form-action-user').hide();
                  $('#'+forcus).show();
                  $('.title-tab').removeClass('is-active');
                  $(this).addClass('is-active');
               });

               var form  = $('#register-form');
                var rules = {

                    username: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength: 100
                    },
                    retypePassword: {
                        equalTo : "#password"
                    },
                    fullName: {
                        required: true,
                        maxlength: 100
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 100
                    },
                    phone_number: {
                        required: true,
                        minlength: 9,
                        maxlength: 20
                    },
                    hiddenRecaptcha: {
                         required: function () {
                             if (grecaptcha.getResponse() == '') {
                                 return true;
                             } else {
                                 return false;
                             }
                         }
                     }
                }

                 form.validate({

                     focusInvalid: false, // do not focus the last invalid input
                     rules: rules,
                     lang: 'vi',
                     errorElement : 'div',
                     errorLabelContainer: '.alert-danger'
                 });



                $('#bt-register').click(function(e) {

                  e.preventDefault();

                     if(form.valid()){

                        var token = $("#g-recaptcha-response").val();
                        var username = form.find('input[name="username"]').first().val();
                        var password = form.find('input[name="password"]').first().val();
                        var email = form.find('input[name="email"]').first().val();
                        var phone_number = form.find('input[name="phone_number"]').first().val();
                        var fullName = form.find('input[name="fullName"]').first().val();
                        var retypePassword = form.find('input[name="retypePassword"]').first().val();

                        var abc = fullName.split(" ");
                        var first_name = abc[0];
                        var last_name = (abc[1] == undefined) ? "" : abc[1];


                        var data = {

                           username : username,
                           password : password,
                           email : email,
                           phone_number : phone_number,
                           first_name : first_name,
                           last_name : last_name,
                           retypePassword : retypePassword,
                           'g-recaptcha-response' : token,
                        }

                        Spr.ajaxDefault(form.attr('action'), data, callback_register,$('.user-segment'));
                     }
                });
            });
         </script>
      </footer>
   </body>
</html>