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
            Xác nhận đặt hàng
        </div>
    </div><!-- .container -->
</section>
<div class="steps-order-page page js-steps-order-page">
    <div class="container page-container">
        <section class="order-finish-block">
            <div class="block-head">
                <div class="block-title">Quý khách đã đặt hàng thành công!</div>
            </div><!-- .block-head -->

            <div class="block-main">
                <div class="text">
                    <p>Xin Cảm ơn Quý khách <strong>{{ $data['info']->ba_first_name }} {{ $data['info']->ba_last_name }}</strong> đã mua hàng trên <span><a class="text-red" href="/">SumoShipping.vn</a></span></p>

                    <p>Mã đơn hàng vừa đặt của quý khách là <span class="text-blue"><a href="/chi-tiet-don-hang-96238">{{ $data['info']->code }}</a></span>.</p>

                    <p>Chúng tôi sẽ nhanh chóng tiến hành kiểm duyệt đơn hàng của quý khách để đảm bảo hàng hóa được nhập khẩu theo đúng pháp luật Việt Nam.</p>

                    <p>Sau khi hoàn tất kiểm duyệt, Chúng tôi sẽ liên hệ với Quý khách qua số điện thoại <b>{{ $data['info']->ba_phone_number }}</b> để xác nhận đơn hàng trong thời gian sớm nhất và sẽ gửi mail thông báo yêu cầu thanh toán để đơn hàng có hiệu lực. Nếu không nhận được mail trong hộp thư đến vui lòng kiểm tra tại các nhãn khác trong hộp thư của quý khách.</p>

                    <p>Một lần nữa, xin cám ơn quý khách đã tin tưởng và sử dụng dịch vụ của chúng tôi.</p>
                </div>

                <div class="btn-wrap">
                    <a href="/" class="btn btn-outline-danger">Tiếp tục mua hàng</a>
                    <a id="noLogin" class="btn btn-outline-danger" data-toggle="modal" href="{{ URL::Route('web-get-order-tracking-detail', ['code' => $data['info']->code, 'phone_number' => $data['info']->ba_phone_number]) }}">Xem lại hóa đơn</a>
                    <a class="btn btn-outline-danger" target="_blank" href="">Hướng dẫn thanh toán</a>
                </div>
            </div><!-- .block-main -->

            <div class="block-foot">
                <div class="text">
                	<p> <i class="text-red">(*)Lưu ý :</i> Trong trường hợp thời gian giao hàng thay đổi , <a href="/" class="text-red">SumoShipping.vn</a> sẽ thông báo với quý khách sớm nhất .</p>
                </div>
            </div>
        </section><!-- .order-finish-block -->
    </div><!-- .page-container -->
</div>
@endsection