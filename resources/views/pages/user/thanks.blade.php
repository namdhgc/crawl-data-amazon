@extends('layouts/user/master')

@section('title')
    <title>Cảm ơn</title>
@endsection

@section('css')
@endsection

@section('js')
<script>
	$(document).ready(function(){
		var home_page = $('#home_page').attr('href');

		setTimeout(function () {    
		    window.location.href = home_page; 
		},4000); // 4 seconds
	});
</script>
@endsection


@section('content')
<section class="breadcrumb-block">
    <div class="container">
        <div class="item">
            <a href="{{ URL::Route('web-get-homePage') }}" id="home_page">Trang chủ</a>
        </div>
    </div>
</section>

<div class="request-quotation-page page" style="padding: 50px">
    <div class="container page-container">
		<h2>Chúng tôi xin cảm ơn về các thông tin bạn đã cung cấp.</h2>
        <a href="{{ URL::Route('web-get-homePage') }}">Hãy bấm vào đây nếu bạn không được tự động chuyển về trang chủ.</a>
        <br>

        @if(Session::has('data') )
        <div class="{{ (Session::get('data')['meta']['success'] == true) ? 'alert alert-success' : 'alert alert-danger' }}">
            <strong>{{ (Session::get('data')['meta']['success'] == true) ? 'Success' : 'Error' }}</strong>

            @foreach (Session::get('data')['meta']['msg'] as $key => $value)
                <p>{{ $key . ': ' . $value }}</p>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection

