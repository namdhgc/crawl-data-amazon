@extends('layouts/mobile/master')


@section('title')
@endsection


@section('css')
@endsection


@section('js')
@endsection


@section('content')
<section class="breadcrumb-block js-breadcrumb-block">
    <div class="block-head">
        <div class="block-title">
            <a href="#">
                <span class="icon"><i class="fa fa-long-arrow-left"></i></span>
                <h1 class="title">Đăng nhập</h1>
            </a>
        </div>
    </div>
</section>

<section class="user-login-block">
    <div class="block-main">
        <form action="{{ URL::Route('customer-post-login') }}" method="POST" class="login-form" novalidate="novalidate">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="control-group">
                <input name="username" type="text" class="form-control" placeholder="Tên đăng nhập" required="" aria-required="true">
            </div>

            <div class="control-group">
                <input name="password" type="password" class="form-control" placeholder="Mật khẩu" required="" aria-required="true">
            </div>

            <button class="btn btn-danger btn-block" id="bt-login" type="submit"><i class="fa"></i> Đăng nhập</button>
        </form><!-- .login-form -->
        <div class="forget-pass">
            Bạn muốn lấy lại mật khẩu? <a href="{{ URL::Route('web-get-forget-password') }}">Lấy tại đây</a>
        </div>
        
        <div class="login-with">
            Đăng nhập với 
            <a href="{{ URL::Route('web-get-login-facebook') }}">
                <img src="http://static.fado.vn/f/desktop/v1/images/icon-login-fb.png" alt="">
            </a> 
            <a href="{{ URL::Route('web-get-login-google') }}">
                <img src="http://static.fado.vn/f/desktop/v1/images/icon-login-gp.png" alt="">
            </a>
            <br>
            Bạn chưa có tài khoản vui lòng <a href="{{ URL::Route('web-get-register') }}">Đăng ký tại đây</a>
        </div>
    </div>
</section><!-- .user-login-block -->
<script type="text/javascript">
    // $(document).ready(function () {
    //     UserMobile.login();
    // });
</script> 
@endsection