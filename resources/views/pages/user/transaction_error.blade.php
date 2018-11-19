@extends('layouts/user/master')

@section('title')
@endsection

@section('css')
@endsection

@section('js')
@endsection

@section('content')
<section class="breadcrumb-block">
    <div class="container">
        <div class="item">
            <a href="/">Trang chủ</a>
        </div>
        <div class="item">
            Thông báo
        </div>
    </div><!-- .container -->
</section>
<div class="steps-order-page page js-steps-order-page">
    <div class="container page-container">
        <section class="order-finish-block">
            <div class="block-head">
                <div class="block-title">Thông báo </div>
            </div><!-- .block-head -->

            <div class="block-main">
                <div class="text">
                    <p>Xin Cảm ơn Quý khách đã ghé thăm <span><a class="text-red" href="/">SumoShipping.vn</a></span></p>

                    <p>Mã đơn hàng <span class="text-blue">{{ $data['order_code']}}</span> hiện không tồn tại trên hệ thống .</p>

                    <p>Một lần nữa, xin cám ơn quý khách đã tin tưởng và sử dụng dịch vụ của chúng tôi.</p>
                </div>

                <div class="btn-wrap">
                    <a href="/" class="btn btn-outline-danger">Tiếp tục mua hàng</a>
                </div>
            </div><!-- .block-main -->

            <div class="block-foot">
                <div class="text">
                	<p> <i class="text-red">(*)Lưu ý :</i> Mọi thắc mắc của quý khách xin vui lòng liên hệ với , <a href="/" class="text-red">SumoShipping.vn</a> qua <strong>Email</strong> hoặc <strong>Hotline</strong> .</p>
                    <p> <a href="/" class="text-red">SumoShipping.vn</a> xin chân thành cảm ơn .</p>
                </div>
            </div>
        </section><!-- .order-finish-block -->
    </div><!-- .page-container -->
</div>
@endsection