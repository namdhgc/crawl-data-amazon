@extends('layouts/mobile/master')

@section('title')
@endsection

@section('css')
@endsection

@section('js')
<script src="{{ URL::asset('js/web/hot_deals/hot_deals.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/web/shopping_cart/shopping-cart.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    hotDeals.init();
    ShoppingCart.init();
    $(document).ready(function() {

        $('.view-more').click(function(e){

             e.preventDefault();
            var item_code = $(this).attr('data-code');

            if($(this).hasClass('active')){

                $(this).removeClass('active');
                $(this).html('+ Xem chi tiết giá');
                $('.detail-price[data-code="'+item_code+'"]').first().hide(500);
            }else {

                $(this).addClass('active');
                $(this).html('+ Ẩn chi tiết giá');
                $('.detail-price[data-code="'+item_code+'"]').first().show(500);
            }
        });

        $('.login-type-rad').change(function() {

            if( $(this).val() ==1 ) {

                $('.user-login-wrap').removeClass('is-disabled');
                $('.password-input').removeAttr('disabled','disabled');
                $('.user-input').removeAttr('disabled','disabled');
                $('.btnInforConfirm').attr('data-login',$(this).val());
            }else {
                $('.user-login-wrap').addClass('is-disabled');
                $('.password-input').attr('disabled');
                $('.user-input').attr('disabled');
                $('.btnInforConfirm').attr('data-login',$(this).val());

            }
        });
    });
</script>
@endsection

@section('content')
<div class="cart-page">
    <section class="breadcrumb-block js-breadcrumb-block">
        <div class="block-head">
            <div class="block-title">
                <a href="/">
                <span class="icon"><i class="fa fa-long-arrow-left"></i></span>
                <span class="title">Tiếp tục mua sắm</span>
                </a>
            </div>
        </div>
    </section>
    <section class="cart-block js-cart-block">
        <div class="block-main">
            @if( isset($_COOKIE['shopping_cart']) && (Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null && COUNT(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products']) > 0) )

            <div class="cart-panel">
                <div class="panel-main">
                    <form class="order-cart-form" method="POST" action="{{ URL::Route('web-post-update-shoping-cart-2') }}">
                        
                    	<?php  $price_total_all = 0; $count = 1; $price_discount_promotion = 0;?>
                        @if( isset($_COOKIE['shopping_cart']) && (Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null && COUNT(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products']) > 0) )
                            @foreach(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products'] as $key => $value)

	                        <input type="hidden" name="isInfomation" value="0">
	                        <input type="hidden" name="B0009OAHC8[perItem]" value="a:7:{s:14:&quot;estimatedOrder&quot;;d:19.52;s:9:&quot;importFee&quot;;d:3.1200000000000001;s:9:&quot;unitPrice&quot;;d:17.989999999999998;s:11:&quot;shippingFee&quot;;d:7;s:13:&quot;discountPrice&quot;;d:1.01;s:13:&quot;shippingWeigh&quot;;d:1;s:14:&quot;otherChargeFee&quot;;d:0;}">
	                        <input type="hidden" name="B0009OAHC8[quantity]" value="1">

	                        <div class="product-box">
	                            <div class="remove-btn bt-remove-cart-item" data-asin="B0009OAHC8"><i class="fa fa-remove"></i></div>
	                            <div class="box-head">
	                                <div class="img">
	                                    <a class="inner" href="{{ $value['img'] }}">
	                                    <img alt="" src="{{ $value['img'] }}">
	                                    </a>
	                                </div>
	                                <div class="info-wrap">
	                                    <div class="title">
	                                        <a href="/us/dp/B0009OAHC8/ref=twister_dp_update?ie=UTF8&amp;psc=1&amp;smid=ATVPDKIKX0DER">Cool Water By Davidoff For Men. Eau De Toilette Spray 4.2 Ounces</a>
	                                    </div>
	                                    <div class="note">
	                                    	<b class="text-red"><ins>Thông số đặt mua</ins></b>:
	                                    	@foreach($value['type_product'] as $type_key => $type_value )
                                            <p>{{ $type_key}}: <span class="text-blue">{{ $type_value }}</span></p>
                                            @endforeach
                                            <p>Cân nặng: <span class="text-blue">15 pounds</span></p>
	                                    </div>
	                                    <div class="quantity">
                                            Số lượng: 
                                            <input  type="number" class="form-control input-medium inputQuantity" title="Quantity" min="1" maxlength="2" name="" value="{{ $value['quantity'] }}">
                                            <input  class="input-quantity" type="hidden" name="product[{{ $value['code'] }}][quantity]" value="{{ $value['quantity'] }}">
                                        </div>
	                                    <div class="code">
                                            Mã sản phẩm: 
                                            <span>{{ $value['code'] }}</span>
                                        </div>
	                                    <div class="price">
	                                        <div class="new">
	                                        	{{ $value['price-total'] }}<sup>đ</sup>
	                                        	<?php $hidden_price_total = $value['price-total']; ?>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="box-main detail-price" data-code="{{$value['code']}}">
	                                <div class="price-item item">
	                                    <div class="lbl">Giá sau thuế Mỹ/Nhật:</div>
	                                    <div class="val">
	                                    	<span class="format-currency" data-decimals='0' data-value="{{ $value['price_jp'] * $value['exchange-rate'] * $value['quantity'] }}"></span>
	                                    	<sup>đ</sup>
	                                    </div>
	                                </div>
	                                @foreach($value['price_list'] as $price_item_key => $price_item_value)
                                    <div class="price-item">
                                        <span class="lbl">{{ $price_item_value->key }}</span>
                                        <span class="val">
                                            <span class="format-currency" data-decimals='0' data-value="{{ $price_item_value->price * $value['quantity'] }}"></span> <sup>đ</sup>
                                        </span>
                                    </div>
                                    @endforeach
	                                <div class="price-item">
	                                    <span class="lbl">Chiết khấu:</span>
	                                    <span class="val">
	                                    	<span class="format-currency" data-decimals='0' data-value="-{{ $value['price_save'] * $value['quantity'] }}"></span>
	                                    	<sup>đ</sup>
	                                    </span>
	                                </div>
	                            </div>
	                            <div class="box-foot view-more detail-price" data-code="{{$value['code']}}">
	                                + Xem chi tiết giá
	                            </div>
	                        </div>

                        	@endforeach
                       	@endif

                        <div class="btn-wrap">
                            <button class="update-btn btn btn-default btn-block" type="submit">
                                <i class="fa fa-refresh"></i>
                                Cập nhật số lượng
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="next-step-panel">
                <div class="panel-main">
                    <!-- <div class="total-price">
                        <div class="lbl">Thành tiền</div>
                        <div class="val">664,932<sup>đ</sup></div>
                    </div> -->
                    <button class="btn btn-danger btn-block call-aside-btn btnInforConfirm" data-login="0">Tiến hành thanh toán</button>
                </div>
            </div>

            @else
            <div class="cart-panel">
                <div class="alert alert-danger text-center" role="alert">
                    <b>Hiện tại không có sản phẩm nào trong giỏ hàng</b>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>

<aside class="cart-login-aside js-cart-login-aside">
    <div class="aside-head">
        <div class="aside-title">Thông tin mua hàng</div>
        <a href="#" class="exit-btn"><i class="fa fa-chevron-left"></i></a>
    </div>

    <div class="aside-main">
        <section class="order-no-login-block">
            <div class="block-head">
                <a href="#" class="btnInforConfirm">Mua hàng không cần đăng nhập</a>
            </div>
        </section>

        <section class="order-user-login-block dropdown-block js-dropdown-block is-expand">
            <div class="block-head">
                <div class="block-title">Tôi đã có tài khoản</div>
            </div>
            <div class="block-main">
                <form class="login-form order-login-form" action="" novalidate="novalidate">
                    <div class="control-group">
                        <input type="text" name="email" class="form-control" placeholder="Địa chỉ Email hoặc số điện thoại" required="" aria-required="true">
                    </div>

                    <div class="control-group">
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required="" aria-required="true">
                    </div>

                    <button class="btn btn-danger btn-block" id="bt-login"><i class="fa"></i> Đăng nhập</button>
                </form>
                                <div class="login-with">
                    Đăng nhập với
                    <a href="https://www.facebook.com/v2.9/dialog/oauth?client_id=379542705504383&amp;state=0128dd6fd2443d62f9a60f5f5563a9d7&amp;response_type=code&amp;sdk=php-sdk-5.5.0&amp;redirect_uri=http%3A%2F%2Ffado.vn%2Fdang-nhap-bang-mang-xa-hoi-facebook&amp;scope=email%2Cpublic_profile">
                        <i class="fd ic-login-fb"></i>
                    </a>
                    <a href="https://accounts.google.com/o/oauth2/auth?response_type=code&amp;redirect_uri=http%3A%2F%2Ffado.vn%2Fdang-nhap-bang-mang-xa-hoi-google&amp;client_id=701745402520-dg85nkn87it0untk25e7moq233jauc0p.apps.googleusercontent.com&amp;scope=email+profile&amp;access_type=online&amp;approval_prompt=auto">
                        <i class="fd ic-login-gp"></i>
                    </a>
                    <br>
                    Bạn chưa có tài khoản vui lòng <a href="http://fado.vn/dang-ky-thanh-vien">Đăng ký tại đây</a>
                </div>
            </div>
        </section>
    </div>
</aside>
@endsection