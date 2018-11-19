@extends('layouts/user/master')

@section('title')
@endsection

@section('css')
@endsection

@section('js')

<script type="text/javascript">
	
	$('.login-form').validate({
	    rules : {
	        password : {
	            minlength : 5
	        },
	        password_retype : {
	            minlength : 5,
	            equalTo : "#password"
	        }
	    }
	});
</script>
@endsection

@section('content')
<section class="breadcrumb-block">
    <div class="container">
        <div class="item">
            <a href="{{ URL::Route('web-get-homePage') }}">Trang chủ</a>
        </div>
        <div class="item">
           	Reset Password
        </div>
    </div>
</section>
<div class="request-quotation-page page">
    <div class="container page-container">
		<form action="{{ URL::Route('web-post-action-reset-password') }}" method="POST" class="login-form form-1">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<input type="hidden" name="username" value="{{ Input::get('username') }}">
	    	<input type="hidden" name="token_reset_password" value="{{ Input::get('token_reset_password') }}">


	        <div class="form-group-1">
	            <label class="lbl-1"><i class="fa fa-key"></i>Mật khẩu mới:</label>
	            <input type="password" name="password" id="password" class="form-control-1" placeholder="" required="">
	        </div>
	        <div class="form-group-1">
	            <label class="lbl-1"><i class="fa fa-key"></i>Gõ lại mật khẩu mới:</label>
	            <input type="password" name="password_retype" class="form-control-1" placeholder="" required="">
	        </div>

	        <div class="form-group-1 btn-wrap">
	            <div class="pull-left">
	                <button type="submit" class="btn btn-danger" id="bt-login"><i class="fa"></i>Xác nhận mất khẩu</button>
	            </div>
	        </div>
	        <div class="notify-wrap" style="display: none">
	            <div class="alert-1 alert alert-danger message">
	            </div>
	        </div>
	    </form>
	</div>
</div>

@endsection