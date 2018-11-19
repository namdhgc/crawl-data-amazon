<?php
// $im = new \imagick( public_path('images/qwwe.jpg'));
// // resize by 200 width and keep the ratio
// $im->thumbnailImage( 200, 0);
// // write to disk
// $im->writeImage( public_path('images/qwwe_2.jpg') );
// $output = $im->getimageblob();
//   $outputtype = $im->getFormat();

//   header("Content-type: $outputtype");
//   echo $output;
//   exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ Lang::get('login.title') }}</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/css/components.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ URL::asset('assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/pages/css/login-3.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="shortcut icon" href="favicon.ico" /> </head>

</head>
<body class=" login">

    <div class="logo">
        <!-- <a href="index.html">
            <img src="../assets/pages/img/logo-big.png" alt="" /> </a> -->
    </div>
    <!-- END LOGO -->
    <!-- BEGIN LOGIN -->
    <div class="content">
        <form class="login-form" action="{{ URL::Route('guest-post-login') }}" method="post" @if($errors->has('forgot-pass')) style="display: none;" @endif>
            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
            <h3 class="form-title">Đăng nhập vào hệ thống</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span> Vui lòng nhập tên đang nhập và mật khẩu. </span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Tên đăng nhập</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Tên đăng nhập" name="username" /> </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Mật khẩu</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Mật khẩu" name="password" /> </div>
            </div>
            <div class="form-actions">
                <label class="rememberme mt-checkbox mt-checkbox-outline">
                    <input type="checkbox" name="remember" value="1" /> Ghi nhớ tài khoản
                    <span></span>
                </label>
                <button type="submit" class="btn green pull-right"> Đăng nhập </button>
                @if($errors->any())
                <h4 style="color: red">{{$errors->first()}}</h4>
                @endif
            </div>
            <div class="forget-password">
                <h4>Quên mật khẩu ?</h4>
                <p> Ấn
                    <a href="javascript:;" id="forget-password"> vào đây </a> để lấy lại mật khẩu. </p>
            </div>
        </form>

        <form class="forget-form" action="{{ URL::Route('guest-post-reset-password') }}" method="POST"   @if($errors->has('forgot-pass')) style="display: block;" @endif>
            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
            <h3>Quên mật khẩu ?</h3>
            <p> Nhập email để lấy lại mật khẩu. </p>
            <div class="form-group">
                <div class="input-icon">
                    <i class="fa fa-envelope"></i>
                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
            </div>
             @if($errors->any())
            <h4 style="color: red">{{$errors->first()}}</h4>
            @endif
            <div class="form-actions">
                <button type="button" id="back-btn" class="btn grey-salsa btn-outline"> Quay lại </button>
                <button type="submit" class="btn green pull-right"> Tiếp tục </button>
            </div>
        </form>
    </div>

    <script src="{{ URL::asset('assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/pages/scripts/login.min.js') }}" type="text/javascript"></script>
</body>
</html>

