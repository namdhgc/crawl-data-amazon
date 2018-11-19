@extends('layouts/mobile/master')

@section('title')
@endsection

@section('css')
<style>
    .exit-btn {

        padding-top: 19px !important;
    }
</style>
@endsection

@section('js')

<!-- <script src="{{ URL::asset('fado/mobile/js/steps-order-page.js') }}" type="text/javascript"></script> -->
<script src="{{ URL::asset('fado/mobile/js/order-payment-methods-block.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('fado/mobile/js/order-payment-aside.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function() {
    	$('.view-more').click(function(e){

            e.preventDefault();

            var d           = document.getElementsByClassName("order-cart-block");
            var class_list  = d[0].classList['value'];
            var sub_string  = 'is-expand';
            
            if (class_list.indexOf(sub_string) !== -1) {

                // already exists class is-expand
                $('#order-cart-block').removeClass(sub_string);
                $(this).html('+ Xem chi tiết');
                
            } else {

                // no exists class is-expand
                $('#order-cart-block').addClass(sub_string);
                $(this).html('- Ẩn chi tiết');
            }
        });

        $('.view-more-price').click(function(e){

            e.preventDefault();
            var item_code = $(this).attr('data-code');

            if($(this).hasClass('active')){

                $(this).removeClass('active');
                $(this).html('+ Xem chi tiết giá');
                $('.detail-price[data-code="'+item_code+'"]').first().hide(500);
            }else {

                $(this).addClass('active');
                $(this).html('- Ẩn chi tiết giá');
                $('.detail-price[data-code="'+item_code+'"]').first().show(500);
            }

        });

        $('.blinker').click(function(){

            var display = $(this).attr('data-display');

            if(display == 0){

              $('.rule-modal').show();
              $(this).attr('data-display',1);

            }else{

              $(this).attr('data-display',0);

            }
        });

        $('.btnAcceptTOS').click(function(){

            $('.rule-modal').hide();
        });

        $('.bootbox-close-button').click(function(){

            $('.rule-modal').hide();
        });


        $('#btnCompleteOrder').click(function(){

            var display         = $('.blinker').attr('data-display');
            var payment_method  = 0;
            $('a[name=payment_method]').each(function(){

                if($(this).is(':checked')){

                    payment_method =  $(this).val();

                }

                if(display ==1){

                    $('.type-payment-form').submit();

                }else{

                    var message = '';

                    if(payment_method == 0) {
                        var flag =  'false';

                        $('input[type=radio][name=bankID]').each(function(){

                            if($(this).is(':checked')){

                                flag =  'true';

                            }
                        });

                    if(flag =='false'){

                        message = 'Quý khách vui lòng chọn một ngân hàng để thanh toán.';

                    }else{

                        message = 'Quý khách vui lòng xem qua điều khoản và đồng ý với điều khoản của SumoShipping trước khi đặt mua hàng.';
                    }

                    }else{

                        message = 'Quý khách vui lòng xem qua điều khoản và đồng ý với điều khoản của SumoShipping trước khi đặt mua hàng.';

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
                }
            });
        });
	});

    
</script>
@endsection


@section('content')
<div class="js-steps-order-page">
	<section class="order-steps-block">
        <div class="block-main">
            <div class="step-item item-1">
                <div class="number"><span>1</span></div>
                <div class="title">Điền thông tin</div>
            </div>

            <div class="step-item item-2 is-active">
                <div class="number"><span>2</span></div>
                <div class="title">Hình thức thanh toán</div>
            </div>
        </div>
    </section>

    <section class="order-cart-block dropdown-block" id="order-cart-block">
        <div class="block-head">
            <div class="block-title">Đơn hàng của bạn </div>
        </div>
        <div class="block-main">
            <form class="order-cart-form" method="POST" action="{{ URL::Route('web-post-update-shoping-cart') }}">

            	<?php  $price_remain = 0; $price_total_all = 0; $count = 1; $price_discount_promotion = 0;?>
                @if( isset($_COOKIE['shopping_cart']) && (Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null && COUNT(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products']) > 0) )
                    @foreach(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products'] as $key => $value)

	                <input type="hidden" name="isInfomation" value="1">
	                <input type="hidden" name="B0009OAHC8[perItem]" value="a:7:{s:14:&quot;estimatedOrder&quot;;d:19.52;s:9:&quot;importFee&quot;;d:3.1200000000000001;s:9:&quot;unitPrice&quot;;d:17.989999999999998;s:11:&quot;shippingFee&quot;;d:7;s:13:&quot;discountPrice&quot;;d:1.01;s:13:&quot;shippingWeigh&quot;;d:1;s:14:&quot;otherChargeFee&quot;;d:0;}">
	                <input type="hidden" name="B0009OAHC8[quantity]" value="1">
	                <div class="product-box">
	                    <div class="remove-btn bt-remove-cart-item" data-asin="B0009OAHC8"><i class="fa fa-remove"></i></div>
	                    <div class="box-head">
	                        <div class="img">
	                            <a class="inner" href="{{ URL::Route('web-get-detail-product',['code' => $value['code']]) }}">
	                            <img alt="" src="{{ $value['img'] }}">
	                            </a>
	                        </div>
	                        <div class="info-wrap">
	                            <div class="title">
	                                <a href="{{ URL::Route('web-get-detail-product',['code' => $value['code']]) }}">
	                                	{!! $value['name'] !!}
	                                </a>
	                            </div>
	                            <div class="note">
	                            	<b class="text-red"><ins>Thông số đặt mua</ins></b>:
		                            	@foreach($value['type_product'] as $type_key => $type_value )
	                                    <p>{{ $type_key}}: <span class="text-blue">{{ $type_value }}</span></p>
	                                    @endforeach
                                    <p>
                                    	Cân nặng: <span class="text-blue">15 pounds</span>
                                    </p>
                                 	<p>
                                 		Mã sản phẩm: <span class="text-blue">{{ $value['code'] }}</span>
                                 	</p>
                                 	<p>
                                 		Xem <a target="_blank" href="{{ Config::get('spr.system.link_get_data.amazon.jp.detail-product') . $value['code'] . '?th=1&psc=1' }}">link gốc</a> sản phẩm
                                 	</p>
	                            </div>
	                            <div class="quantity">Số lượng: 
	                            	<span>{{ $value['quantity'] }}</span>
	                            </div>
	                            <div class="code">Mã sản phẩm: <span>{{ $value['code'] }}</span></div>
	                            <div class="price">
	                                <!-- <div class="new">{{ $value['price_jp'] * $value['exchange-rate'] }} <sup>đ</sup></div> -->
                                    <span class="format-currency new" data-decimals='0' data-value="{{ $value['price-total'] }}"></span>
                                    <sup>đ</sup>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="box-main detail-price" data-code="{{$value['code']}}">
	                        <div class="price-item">
	                            <div class="lbl">Giá sau thuế Mỹ/Nhật:</div>
	                            <div class="val">
	                            	<span class="format-currency" data-decimals='0' data-value="{{ $value['price_jp'] * $value['exchange-rate'] * $value['quantity'] }}">
	                            	</span> <sup>đ</sup>
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
                                <span class="lbl">Chiết khấu</span>
                                <span class="val">
                                    <span class="format-currency" data-decimals='0' data-value="-{{ $value['price_save'] * $value['quantity'] }}"></span> <sup>đ</sup>
                                </span>
                            </div>
	                    </div>
	                    <div class="box-foot view-more-price detail-price" data-code="{{$value['code']}}">
	                        + Xem chi tiết giá
	                    </div>
	                </div>
                    <?php $price_total_all += $value['price-total']; $count++;?>
                	@endforeach
                @endif
            </form>
        </div>
        <div class="block-foot">
            <div class="total-price">
                <div class="lbl">Tổng giá trị đơn hàng</div>
                <div class="val">
                    <span class="format-currency total-price-befor-promotion" data-decimals='0' data-value="{{ $price_total_all }}">
                    </span>
                    <sup>đ</sup>
                </div>
            </div>
            <div class="view-more">+ Xem chi tiết</div>
        </div>
    </section>


    <section class="order-payment-methods-block js-order-payment-method-block dropdown-block js-dropdown-block is-expand">
        <div class="block-head">
            <div class="block-title">Hình thức thanh toán</div>
        </div>

        <div class="block-main">
            
            <!-- <div class="method-item">
                <a href="#" data-payment-type="4" value="1">
                    <div class="icon">
                    	<img src="http://namdh.amazon.dev/fado/images/icon-bank-card.png" alt="">
                    </div>
                    <div class="text">
                        Thanh toán trực tuyến với 27 ngân hàng trong nước<br>
                        <span class="text-green">Miễn phí chuyển khoản</span>
                    </div>
                </a>
            </div>
            

            <div class="method-item">
                <a href="#" data-payment-type="2" value="1">
                    <div class="icon">
                    	<img src="http://namdh.amazon.dev/fado/images/icon-payment-5.png" alt="">
                    </div>
                    <div class="text">
                        Nộp tiền mặt tại văn phòng Sumo shipping<br>
                        <span class="text-green">Miễn phí</span>
                    </div>
                </a>
            </div> -->

            @foreach(Config::get('spr.type.type.payment') as $key => $val)
            <div class="method-item">
                <a href="#" data-payment-type="{{ $val['value'] }}" value="{{ $val['value'] }}" name="payment_method" data-tab-target="#payment-type-{{ $val['value'] }}"  data-type="{{ $val['value'] }}">
                    <!-- <input type="radio" class="pt-rad paymentMethod" data-payment-type="{{ $val['value'] }}" value="{{ $val['value'] }}" name="payment_method" data-tab-target="#payment-type-{{ $val['value'] }}"  data-type="{{ $val['value'] }}" value="{{ $val['value'] }}"> -->
                    <div class="icon">
                        <img src="{{ URL::asset( $val['icon']) }}" alt="">
                    </div>
                    <div class="text">
                        {{ $val['description'] }}
                        <br>
                        <span class="text-green">Miễn phí chuyển khoản</span>
                        <!-- <div class="desc">{{ $val['description'] }}</div> -->
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>

    <section class="order-next-step-block">
        <div class="block-main">
            <a class="btn btn-danger btn-block" href="{{ URL::Route('web-get-homePage') }}">Tiếp tục mua sắm</a>
            <!-- <a class="btn btn-default" href="{{ URL::Route('web-get-my-shopping-cart') }}">Quay lại giỏ hàng</a> -->
            <!-- <button class="btn btn-danger" id="btnCompleteOrder" type="button">Hoàn tất đặt hàng</button> -->
        </div>
    </section>

</div>

@include('layouts.mobile.order_payment_aside')

@endsection
