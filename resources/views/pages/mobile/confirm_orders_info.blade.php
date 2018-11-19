@extends('layouts/mobile/master')

@section('title')
@endsection

@section('css')

<style type="text/css">
    
    .order-buyer-profile-block .register-new-acc-control input:checked+.indicator::before {
        content: "\f046" !important;
    }

    .order-buyer-profile-block .register-new-acc-control .indicator::before {
        content: "\f096" !important;
        position: absolute;
        font-family: FontAwesome;
        left: 0;
        top: 0;
        line-height: 30px;
        height: 30px;
        width: 25px;
        text-align: center;
        color: #b11e22;
    }
    .order-buyer-profile-block .register-new-acc-control .indicator {
        padding-left: 35px;
        position: relative;
    }

    .order-buyer-profile-block .register-new-acc-control input {
        position: absolute;
        z-index: -1;
        visibility: hidden;
        opacity: 0;
    }

</style>
@endsection

@section('js')
<script src="{{ URL::asset('js/web/hot_deals/hot_deals.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/web/confirm/confirm.js') }}" type="text/javascript"></script>
<!-- <script src="{{ URL::asset('fado/mobile/js/order-cart-block.js') }}" type="text/javascript"></script> -->
<!-- <script src="{{ URL::asset('fado/mobile/js/order-profile-block.js') }}" type="text/javascript"></script> -->
<script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/localization/messages_vi.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    hotDeals.init();
    Confirm.init();
    $(document).ready(function() {

        $('.view-more').click(function(e){

            e.preventDefault();
            // var item_code = $(this).attr('data-code');

            // if($(this).hasClass('active')){

            //     $(this).removeClass('active');
            //     $(this).html('+ Xem chi tiết');
            //     $('.detail-price[data-code="'+item_code+'"]').first().hide(500);
            // }else {

            //     $(this).addClass('active');
            //     $(this).html('+ Ẩn chi tiết');
            //     $('.detail-price[data-code="'+item_code+'"]').first().show(500);
            // }

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

        $('.buyer-profile-cb').change(function() {

            if( $(this).is(':checked') ) {

                $('.receiver-profile-wrap').removeClass('is-disable');
            }else {

                $('.receiver-profile-wrap').addClass('is-disable');
            }
        });

        $('.btn-submit-form-use-promotion').click(function(e) {

            e.preventDefault();
            $('.alert-use-promotion-code').hide();
            var from    = $('#use-promotion-code');
            var url     = from.attr('action');
            var value   = from.find('input#discount-code').first().val();

            if(value != ''){

                var data    = {

                    promotion_code : value
                }

                Spr.ajaxDefault(url, data, callBackUsePromotionCode,'.order-cart-form');
            }

        });

        $('.btn-submit-form-use-happy-code').click(function(e) {

            e.preventDefault();
            $('.alert-use-happy-code').hide();
            var from    = $('#use-happy-code');
            var url     = from.attr('action');
            var value   = from.find('input#discount-happy-code').first().val();

            if(value != ''){

                var data    = {

                    happy_code : value
                }

                Spr.ajaxDefault(url, data, callBackUseHappyCode,'.order-cart-form');
            }

        });

        var elmChangeData = '';

        var callBackUsePromotionCode = function(res) {

            if(res.meta.success) {

                var discount = parseFloat(res.response.discount);
                var total_price_befor_promotion = parseFloat($('.total-price-befor-promotion').first().attr('data-value'));
                var price_discount_promotion =  0;

                if(discount < 100) {

                    discount = discount * total_price_befor_promotion / 100 ;
                }
                price_discount_promotion = total_price_befor_promotion - discount;

                if(price_discount_promotion < 0) price_discount_promotion = 0;
                $('.total-price-after-discount').first().attr('data-value', price_discount_promotion);
                $('.discount-promotion').first().attr('data-value', discount);
            }
            Spr.format_all_currency();
        }

        var callBackUseHappyCode = function(res) {

            if(res.meta.success) {

                var discount = parseFloat(res.response.discount);
                var total_price_before_happy_code = parseFloat($('.total-price-befor-promotion').first().attr('data-value'));
                var price_discount_happy_code =  0;

                if(discount < 100) {

                    discount = discount * total_price_before_happy_code / 100 ;
                }
                price_discount_happy_code = total_price_before_happy_code - discount;

                if(price_discount_happy_code < 0) price_discount_happy_code = 0;
                $('.total-price-after-discount').first().attr('data-value', price_discount_happy_code);
                $('.discount-happy-code').first().attr('data-value', discount);
            }
            Spr.format_all_currency();
        }

        var callBackChangeDataAddress = function(res) {

            if(res.meta.success) {

                var data = res.response;
                var length_data = data.length;

                for (var i = 0; i < length_data; i++) {

                    $(elmChangeData).append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
                }
                $(elmChangeData).val("0");
            }

        }

        $('.city').change(function(){

            var type = $(this).attr('data-type');

            if($(this).val() != 0) {

                elmChangeData = '.district[data-type="'+type+'"]';
                var url = $(this).attr('data-url-get-data');

                var data = {
                    city_id : $(this).val()
                }
                Spr.ajaxDefault(url, data, callBackChangeDataAddress,'.order-profile-form');
            }
            $('.district[data-type="'+type+'"]').html('<option value="0">Vui lòng chọn Quận / Huyện</option>');
            $('.ward[data-type="'+type+'"]').html('<option value="0">Vui lòng chọn Phường / Xã</option>');
            $('.district[data-type="'+type+'"]').val(0);
            $('.ward[data-type="'+type+'"]').val(0);

        });


        $('.district').change(function(){

            var type = $(this).attr('data-type');

            if($(this).val() != 0) {

                elmChangeData = '.ward[data-type="'+type+'"]';
                var url = $(this).attr('data-url-get-data');

                var data = {
                    district_id : $(this).val()
                }
                Spr.ajaxDefault(url, data, callBackChangeDataAddress,'.order-profile-form');
            }
            $('.ward[data-type="'+type+'"]').html('<option value="0">Vui lòng chọn Phường / Xã</option>');
            $('.ward[data-type="'+type+'"]').val(0);

        });



        var rules_buyer_information = {

            buyerFirstname: {
              required: true
            },
            buyerLastname: {
              required: true
            },
            buyerPhone: {
              required: true
            },
            buyerEmail: {
              required: true,
              email: true
            },
            buyerCityID: {
              required: true,
              valueNotEquals: "0"
            },
            buyerAddress: {
              required: true
            },
            buyerDistrictID: {
              required: true,
              valueNotEquals: "0"
            },
            buyerWardID: {
              required: true,
              valueNotEquals: "0"
            }
        };

        var rules_receiver_information = {

            buyerFirstname: {
              required: true
            },
            buyerLastname: {
              required: true
            },
            buyerPhone: {
              required: true
            },
            buyerEmail: {
              required: true,
              email: true
            },
            buyerCityID: {
              required: true,
              valueNotEquals: "0"
            },
            buyerAddress: {
              required: true
            },
            buyerDistrictID: {
              required: true,
              valueNotEquals: "0"
            },
            buyerWardID: {
              required: true,
              valueNotEquals: "0"
            },
            receiverFirstname: {
              required: true
            },
            receiverLastname: {
              required: true
            },
            receiverPhone: {
              required: true
            },
            receiverEmail: {
              required: true,
              email: true
            },
            receiverCityID: {
              required: true,
              valueNotEquals: "0"
            },
            receiverAddress: {
              required: true
            },
            receiverDistrictID: {
              required: true,
              valueNotEquals: "0"
            },
            receiverWardID: {
              required: true,
              valueNotEquals: "0"
            }
        };

        $('#user-information').submit(function(e) {

            $('#user-information').validate().settings.rules = {};
            $('#user-information').validate().resetForm();
            if( $('.buyer-profile-cb').is(':checked')){

                $('#user-information').validate().settings.rules = rules_receiver_information;
            }else {

                $('#user-information').validate().settings.rules =  rules_buyer_information;
            }

            if(!$('#user-information').valid()) {

                e.preventDefault();
            }
        });

        $('.buyer-profile-cb').change(function() {

            $('#user-information').validate().resetForm();
        });
    });


    // namdh


    // $(document).ready(function () {
    //     var orderProfileBlockEle = $('.js-order-profile-block');
    //     if (!orderProfileBlockEle.length) {
    //         return;
    //     }

    //     var thatEle = null;

    //     /* ========================================================================
    //      Show/hide receiver profile panel
    //      =========================================================================== */
    //     (function () {
    //         var hasReceiverInputEle = orderProfileBlockEle.find(".has-receiver-input");
    //         var receiverProfilePanelEle = orderProfileBlockEle.find(".receiver-profile-panel");
    //         var inputReceiverProfilePanelEle = receiverProfilePanelEle.find("input, select");

    //         hasReceiverInputEle.on('change', function () {
    //             thatEle = $(this);

    //             if (thatEle.is(":checked")) {
    //                 receiverProfilePanelEle.addClass("is-show");
    //                 inputReceiverProfilePanelEle.prop('disabled', false);
    //             } else {
    //                 receiverProfilePanelEle.removeClass("is-show");
    //                 inputReceiverProfilePanelEle.prop('disabled', true);
    //             }
    //         });
    //     })();//end func
    // });


    $(document).ready(function () {
        $('#receiverInfo').click(function () {
            setTimeout(function () {
                if ($('.receiver-profile-wrap').hasClass('is-disable')) {
                    $('.receiver-profile-wrap input,.receiver-profile-wrap select').attr('disabled', true);
                } else {
                    $('.receiver-profile-wrap input,.receiver-profile-wrap select').removeAttr('disabled');
                }
            }, 50);
        });



        $('#receiverInfo').click(function() {
            
            var d           = document.getElementsByClassName("order-receiver-profile-block");
            var class_list  = d[0].classList['value'];
            var sub_string  = 'is-expand';
            
            if (class_list.indexOf(sub_string) !== -1) {

                // already exists class is-expand
                $('#order-receiver-profile-block').removeClass(sub_string);
                
            } else {

                // no exists class is-expand
                $('#order-receiver-profile-block').addClass(sub_string);
            }
        });


        $(document).on('click', '#receiverInfo', function() {

            var chk_box = $('.buyer-profile-cb');

            if(chk_box.prop('checked') == false) {
                
                // console.log(chk_box);
                chk_box.prop('checked', true);
                chk_box.attr('checked','checked');
                chk_box.attr('checked',true);

            } else {
                
                // console.log(chk_box);
                chk_box.prop('checked', false);
                chk_box.removeAttr('checked');
            }
        });

        $(document).on('click', '#create_new_acc', function(e) {

            e.preventDefault();
            var chk_box = $('.buyer-new-acc-cb');

            if(chk_box.prop('checked') == false) {
                
                // console.log(chk_box);
                chk_box.prop('checked', true);
                chk_box.attr('checked','checked');
                chk_box.attr('checked',true);

            } else {
                
                // console.log(chk_box);
                chk_box.prop('checked', false);
                chk_box.removeAttr('checked');

            }
        });

    });

    //end namdh
</script>
@endsection

@section('content')
<div class="js-steps-order-page">
    <section class="order-steps-block">
        <div class="block-main">
            <div class="step-item item-1 is-active">
                <div class="number"><span>1</span></div>
                <div class="title">Điền thông tin</div>
            </div>
            <div class="step-item item-2">
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
	                            <div class="quantity">
                                    Số lượng: 
                                    <input  type="number" class="form-control inputQuantity" title="Quantity" min="1" maxlength="2" name="" value="{{ $value['quantity'] }}">
                                    <input  class="input-quantity" type="hidden" name="product[{{ $value['code'] }}][quantity]" value="{{ $value['quantity'] }}">
                                </div>
	                            <div class="code">
                                    Mã sản phẩm: 
                                    <span>{{ $value['code'] }}</span>
                                </div>
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


                <div class="btn-wrap">
                    <button class="update-btn btn btn-default btn-block" type="submit">Cập nhật số lượng</button>
                </div>
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




    <form class="order-profile-form" id="user-information" method="post" action="{{ URL::Route('web-post-confirm-orders') }}" novalidate="novalidate">
        <section class="order-buyer-profile-block dropdown-block is-expand">
            <div class="block-head">
                <div class="block-title">Thông tin cá nhân</div>
            </div>

            <div class="block-main">
                <div class="control-group">
                    <div class="icon"><i class="fa fa-user"></i></div>
                    <div class="control-wrap">
                        <input type="text" class="form-control" placeholder="Họ" name="buyerFirstname" value="@if(Auth::guard('customer')->check()){{Auth::guard('customer')->user()->first_name}}@endif" required="" aria-required="true">
                    </div>
                </div>
                <div class="control-group">
                    <div class="icon"><i class="fa fa-user"></i></div>
                    <div class="control-wrap">
                        <input type="text" class="form-control" placeholder="Tên" name="buyerLastname" value="@if(Auth::guard('customer')->check()){{Auth::guard('customer')->user()->last_name}}@endif" required="" aria-required="true">
                    </div>
                </div>

                <div class="control-group">
                    <div class="icon"><i class="fa fa-phone"></i></div>
                    <div class="control-wrap">
                        <input type="text" class="form-control" placeholder="Số điện thoại" name="buyerPhone" value="@if(Auth::guard('customer')->check()){{Auth::guard('customer')->user()->phone_number}}@endif" required="" aria-required="true">
                    </div>
                </div>

                <div class="control-group">
                    <div class="icon"><i class="fa fa-envelope"></i></div>
                    <div class="control-wrap">
                        <input type="text" class="form-control" placeholder="Email" name="buyerEmail" value="@if(Auth::guard('customer')->check()){{Auth::guard('customer')->user()->email}}@endif" required="" aria-required="true">
                    </div>
                </div>

                <div class="control-group">
                    <div class="icon"><i class="fa fa-send"></i></div>
                    <div class="control-wrap">
                        <input type="text" class="form-control" placeholder="Địa chỉ" name="buyerAddress" value="@if(Auth::guard('customer')->check()){{Auth::guard('customer')->user()->address}}@endif" required="" aria-required="true">
                    </div>
                </div>

                <div class="control-group">
                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                    <div class="control-wrap">
                        <select class="form-control city" name="buyerCityID" id="buyerCityID" data-url-get-data="{{ URL::Route('post-get-data-district') }}" data-type="buyer"  @if(Auth::guard('customer')->check() && Auth::guard('customer')->user()->city != null) value="Auth::guard('customer')->user()->city" @endif required="" aria-required="true">
                        	<option value="0">Vui lòng chọn Tỉnh / Thành</option>
                          	@foreach($city as $key => $value)
                                <option @if(Auth::guard('customer')->check() && Auth::guard('customer')->user()->city != null && Auth::guard('customer')->user()->city == $value->id ) selected @endif value="{{ $value->id }}" >{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                    <div class="control-wrap">
                        <select class="form-control district" name="buyerDistrictID" id="buyerDistrictID" data-url-get-data="{{ URL::Route('post-get-data-ward') }}" data-type="buyer" required="" aria-required="true">
                            <option value="0">Vui lòng chọn Quận / Huyện</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                    <div class="control-wrap">
                        <select class="form-control ward" name="buyerWardID" id="buyerWardID" data-type="buyer" required="" aria-required="true">
                            <option value="0">Vui lòng chọn Phường / Xã</option>
                        </select>
                    </div>
                </div>
                @if(!Auth::guard('customer')->check())
                <label class="register-new-acc-control">
                    <input type="checkbox" class="buyer-new-acc-cb" name="create_new_acc" checked="false">
                    <div class="indicator" id="create_new_acc">
                        Sử dụng thông tin để <span class="text-blue">tạo tài khoản</span>
                    </div>
                </label>
                @endif
            </div>
        </section>

        <section class="dropdown-block receiver-profile-wrap js-order-profile-block order-receiver-profile-block" id="order-receiver-profile-block">
            <div class="block-head">
                <div class="block-title indicator" id="receiverInfo">Người nhận khác người mua</div>
                <input type="checkbox" class="receiver-profile-cb buyer-profile-cb" name="receiverInfo">
            </div>

            <div class="block-main">
                <div class="control-group">
                    <div class="icon"><i class="fa fa-user"></i></div>
                    <div class="control-wrap">
                        <input type="text" class="form-control" placeholder="Họ người nhận" name="receiverFirstname" required="" aria-required="true" disabled="disabled">
                    </div>
                </div>

                <div class="control-group">
                    <div class="icon"><i class="fa fa-user"></i></div>
                    <div class="control-wrap">
                        <input type="text" class="form-control" placeholder="Tên người nhận" name="receiverLastname" required="" aria-required="true" disabled="disabled">
                    </div>
                </div>

                <div class="control-group">
                    <div class="icon"><i class="fa fa-phone"></i></div>
                    <div class="control-wrap">
                        <input type="text" class="form-control" placeholder="Số điện thoại người nhận" name="receiverPhone" required="" aria-required="true" disabled="disabled">
                    </div>
                </div>

                <div class="control-group">
                    <div class="icon"><i class="fa fa-envelope"></i></div>
                    <div class="control-wrap">
                        <input type="text" class="form-control" placeholder="Email người nhận" name="receiverEmail" disabled="disabled">
                    </div>
                </div>
                <div class="control-group">
                    <div class="icon"><i class="fa fa-send"></i></div>
                    <div class="control-wrap">
                        <input type="text" class="form-control" placeholder="Địa chỉ người nhận" name="receiverAddress" required="" aria-required="true" disabled="disabled">
                    </div>
                </div>

                <div class="control-group">
                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                    <div class="control-wrap">
                        <select class="form-control city" name="receiverCityID" id="receiverCityID" data-url-get-data="{{ URL::Route('post-get-data-district') }}" data-type="receiver" required="" aria-required="true" disabled="disabled">
                            <option value="0">Vui lòng chọn Tỉnh / Thành</option>
                            @foreach($city as $key => $value)
                                <option  value="{{ $value->id }}" >{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                    <div class="control-wrap">
                        <select class="form-control district" name="receiverDistrictID" id="receiverDistrictID" data-url-get-data="{{ URL::Route('post-get-data-ward') }}" data-type="receiver" required="" aria-required="true" disabled="disabled">
                            <option value="0">Vui lòng chọn Quận / Huyện</option>
                        </select>
                    </div>
                </div>

                <div class="control-group">
                    <div class="icon"><i class="fa fa-map-marker"></i></div>
                    <div class="control-wrap">
                        <select name="receiverWardID" class="form-control ward" id="receiverWardID" data-type="receiver" required="" aria-required="true" disabled="disabled">
                            <option value="0">Vui lòng chọn Phường / Xã</option>
                        </select>
                    </div>
                </div>
            </div>
        </section>

        <section class="order-discount-code-block dropdown-block js-dropdown-block is-expand">
            <div class="block-head">
                <div class="block-title">Sử dụng mã giảm giá</div>
            </div>

            <div class="block-main">
                <div class="input-wrap sale-code-wrap">
                    <from id="use-promotion-code" action="{{ URL::Route('web-post-use-promotion-code') }}" method="POST" accept-charset="utf-8">
                        <input id="discount-code" name="discountCode" type="text" class="form-control" placeholder="Nhập mã giảm giá">
                        <button class="btn btn-danger check-btn btn-submit-form btn-submit-form-use-promotion" type="button">Nhập</button>
                    </from>
                </div>
                <div class="note-text">
                    <i class="fa fa-check text-green"></i> Ngoài mã giảm giá &amp; chiết khấu được quy định sẵn, SumoShipping cũng sẽ xem xét số lượng từng món hàng hàng của Quý khách để tăng mức chiết khấu thêm cho Quý khách.
                </div>
            </div>
        </section>

        <section class="order-agency-code-block dropdown-block js-dropdown-block is-expand">
            <div class="block-head">
                <div class="block-title">Sử dụng mã đại lý (nếu có)</div>
            </div>

            <div class="block-main">
                <div class="input-wrap agency-code-wrap">
                    <from id="use-happy-code" action="{{ URL::Route('web-post-use-happy-code') }}" method="POST" accept-charset="utf-8">
                        <input id="discount-happy-code" name="happyCode" type="text" placeholder="Nhập mã đại lý" value="" class="form-control txt">
                        <button class="btn btn-danger check-btn btn-submit-form btn-submit-form-use-happy-code" type="button">Nhập</button>
                    </from>
                </div>

                <div class="note-text">
                    <i class="fa fa-check text-green"></i> Ngoài mã giảm giá &amp; chiết khấu được quy định sẵn, SumoShipping cũng sẽ xem xét số lượng từng món hàng hàng của Quý khách để tăng mức chiết khấu thêm cho Quý khách.
                </div>
            </div>
        </section>

        <section class="order-next-step-block">
            <div class="block-main">
                <button class="btn btn-danger btn-block" type="submit">Tiếp tục</button>
            </div>
        </section>
    </form>
</div>
@endsection