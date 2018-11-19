@extends('layouts/mobile/master')


@section('title')
@endsection


@section('css')
<style>
	/*@media screen and (max-height: 575px) { 
		#rc-imageselect, .g-recaptcha {
			transform:scale(0.77);
			-webkit-transform:scale(0.77);
			transform-origin:0 0;
			-webkit-transform-origin:0 0;
		}
	}*/

	.help-block-error {
		color: red;
	}
</style> 


@endsection


@section('js')
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="{{ URL::asset('js/web/register/register_user.js') }}" type="text/javascript"></script>
<script>
	RegisterUser.init();
</script>
@endsection


@section('content')
<section class="breadcrumb-block js-breadcrumb-block">
    <div class="block-head">
        <div class="block-title">
            <a href="#">
                <span class="icon"><i class="fa fa-long-arrow-left"></i></span>
                <h1 class="title">Đăng ký</h1>
            </a>
        </div>
    </div>
</section>

<section class="user-register-block">
    <div class="block-main">
        <form action="{{ URL::Route('web-post-register-user') }}" method="POST" class="register-form" id="form-register-user">
          	
          	<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="note-text">
                Mật khẩu phải có độ dài ít nhất 6 kí tự, không được phép dài quá 30 kí tự, bao gồm cả số và chữ.
            </div>

            <div class="control-group">
                <input name="username" type="text" class="form-control" placeholder="Tên đăng nhập" required="" aria-required="true">
            </div>
            <div class="control-group">
                <input name="password" type="password" class="form-control" placeholder="Mật khẩu" required="" aria-required="true">
            </div>
            <div class="control-group">
                <input name="retypePassword" type="password" class="form-control" placeholder="Xác nhận mật khẩu" required="" aria-required="true">
            </div>
            <div class="control-group">
                <input name="first_name" type="text" class="form-control" placeholder="Họ" required="" aria-required="true">
            </div>
            <div class="control-group">
                <input name="last_name" type="text" class="form-control" placeholder="Tên" required="" aria-required="true">
            </div>
            <div class="control-group">
                <input name="email" type="email" class="form-control" placeholder="Địa chỉ Email" required="" aria-required="true">
            </div>
            <div class="control-group">
                <input name="phone_number" type="text" class="form-control" placeholder="Số điện thoại" required="" aria-required="true">
            </div>
            <div class="control-group gc-reset">
                <div class="g-recaptcha" data-sitekey="6LccdiUUAAAAAE0n2pSzf4gH74s8GfPbObb7IjzV"></div>
             	<input type="hidden" class="hiddenRecaptcha" name="hiddenRecaptcha" id="hiddenRecaptcha">
            </div>

            <button type="submit" class="btn btn-danger btn-block" id="bt-register" type="button"><i class="fa"></i> Đăng ký</button>
        </form>
        <div class="text-1">
            <!--Bạn muốn trở thành nhà phân phối trên sàn Giaodichtra? <br />-->
            <!--Tài khoản của bạn chưa được xác thực? <a href="">Xác thực tại đây</a>-->
        </div>
    </div>
</section>
@endsection