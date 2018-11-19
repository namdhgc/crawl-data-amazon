@extends('layouts/user/master')

@section('title')
@endsection

@section('css')
<style type="text/css" >
    .btn-submit-form {
        border: 0;
        background: 0 0;
        outline: 0;
        display: inline-block;
        text-align: center;
    }
</style>
@endsection

@section('js')
    <script src="{{ URL::asset('js/web/hot_deals/hot_deals.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/web/confirm/confirm.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/jquery-validation/js/localization/messages_vi.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        hotDeals.init();
        Confirm.init();
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
                    Spr.ajaxDefault(url, data, callBackChangeDataAddress,'.' + $(this).parents('td').first().attr('class'));
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
                    Spr.ajaxDefault(url, data, callBackChangeDataAddress,'.' + $(this).parents('td').first().attr('class'));
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
    </script>
@endsection

@section('content')
<section class="breadcrumb-block">
    <div class="container">
        <div class="item"><a href="http://fado.vn">Trang chủ</a></div>
        <div class="item"><a href="/gio-hang-cua-ban">Giỏ hàng</a></div>
        <div class="item">Xác nhận thông tin</div>
    </div>
</section>
<section class="steps-order-block">
<div class="container">
    <div class="step-item is-active">
        <i class="fa fa-shopping-cart"></i><br>
        <div class="text">Giỏ hàng<br>của bạn</div>
    </div>
    <div class="step-item is-active">
        <i class="fa fa-user"></i><br>
        <div class="text">Thông tin<br>người mua-nhận
        </div>
    </div>
    <div class="step-item">
        <i class="fa fa-credit-card-alt"></i><br>
        <div class="text">Hình thức<br>thanh toán
        </div>
    </div>
    <div class="step-item">
        <i class="fa fa-check"></i><br>
        <div class="text">Xác nhận<br>thành công
        </div>
    </div>
</div>
</section>
<div class="steps-order-page page js-steps-order-page">
<div class="container page-container">
    <section class="order-cart-block">
        <div class="block-head"><div class="block-title">Giỏ hàng của bạn</div></div>
        <div class="block-main">

            <form class="order-cart-form" method="POST" action="{{ URL::Route('web-post-update-shoping-cart') }}">
                <table class="cart-tb">
                    <thead>
                        <tr>
                            <th style="width: 40px;">STT</th>
                            <th style="min-width: 200px;">Thông tin sản phẩm</th>
                            <th style="width: 90px;">Số lượng</th>
                            <th style="width: 230px;">Thành tiền</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  $price_remain = 0; $price_total_all = 0; $count = 1; $price_discount_promotion = 0;?>
                        @if( isset($_COOKIE['shopping_cart']) && (Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null && COUNT(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products']) > 0) )
                            @foreach(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products'] as $key => $value)
                            <tr class="product-item">
                                <td class="order">{{$count}}</td>
                                <td class="product-info">
                                    <a target="_blank" href="{{ $value['img'] }}" class="img"><img alt="" src="{{ $value['img'] }}"></a>
                                    <div class="info-wrap">
                                        <div class="title">
                                            <a target="_blank" href="{{ URL::Route('web-get-detail-product',['code' => $value['code']]) }}">{!! $value['name'] !!}</a>
                                        </div>
                                        <p><b class="text-red"><ins>Thông số đặt mua</ins></b>: </p>
                                        @foreach($value['type_product'] as $type_key => $type_value )
                                        <p>{{ $type_key}}: <span class="text-blue">{{ $type_value }}</span></p>
                                        @endforeach
                                        <p>Cân nặng: <span class="text-blue">15 pounds</span></p>
                                        <p>Mã sản phẩm: <span class="text-blue">{{ $value['code'] }}</span></p>
                                        <p>Xem <a target="_blank" href="{{ Config::get('spr.system.link_get_data.amazon.jp.detail-product') . $value['code'] . '?th=1&psc=1' }}">link gốc</a> sản phẩm</p>
                                    </div>
                                </td>
                                <td class="quantity">
                                    <input  type="number" class="form-control inputQuantity" title="Quantity" min="1" maxlength="2" name="" value="{{ $value['quantity'] }}">
                                    <input  class="input-quantity" type="hidden" name="product[{{ $value['code'] }}][quantity]" value="{{ $value['quantity'] }}">
                                </td>
                                <td class="product-price">
                                    <div class="price">
                                        <span class="format-currency" data-decimals='0' data-value="{{ $value['price-total'] }}"></span> <sup>đ</sup>
                                    </div>
                                        <div class="detail-price" data-code="{{$value['code']}}">
                                            <div class="item">
                                                <span class="lbl">Giá sản phẩm sau thuế tại Nhật</span>
                                                <span class="val">
                                                    <span class="format-currency" data-decimals='0' data-value="{{ $value['price_jp'] * $value['exchange-rate'] * $value['quantity'] }}"></span> <sup>đ</sup>
                                                </span>
                                            </div>
                                            @foreach($value['price_list'] as $price_item_key => $price_item_value)
                                            <div class="item">
                                                <span class="lbl">{{ $price_item_value->key }}</span>
                                                <span class="val">
                                                    <span class="format-currency" data-decimals='0' data-value="{{ $price_item_value->price * $value['quantity'] }}"></span> <sup>đ</sup>
                                                </span>
                                            </div>
                                            @endforeach
                                            <div class="item">
                                                <span class="lbl">Chiết khấu</span>
                                                <span class="val">
                                                    <span class="format-currency" data-decimals='0' data-value="-{{ $value['price_save'] * $value['quantity'] }}"></span> <sup>đ</sup>
                                                </span>
                                            </div>
                                        </div>
                                        <a href="#" data-code="{{$value['code']}}" class="view-more">+ Xem chi tiết</a>
                                </td>
                                <td class="tool">
                                    <button type="button" data-id="{{ $value['code'] }}" data-tooltip="Nhấp vào đây để xóa<br /> sản phẩm khỏi giỏ hàng" data-placement="left" class="btn btn-default ttip bt-remove-cart-item" style="cursor: pointer;"><i class="fa fa-remove"></i></button>
                                </td>
                            </tr>
                            <?php $price_total_all += $value['price-total']; $count++;?>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"> Tổng cộng : </td>
                            <td colspan="1">
                                <span class="val">
                                    <span class="format-currency total-price-befor-promotion" data-decimals='0' data-value="{{ $price_total_all }}"></span> <sup>đ</sup>
                                </span>
                            </td>
                            <td colspan="1"></td>
                        </tr>
                        <tr>
                            <td colspan="3"> Mã khuyến mãi : </td>
                            <td colspan="1">
                                <span class="val">
                                    <span class="format-currency discount-promotion"  data-decimals='0' data-value="@if(isset($_COOKIE['shopping_cart']) && (Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null && COUNT(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products']) > 0) && !empty(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['promotion']))<?php

                                        $discount = (int)Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['promotion']['discount'];
                                        $price_discount_promotion = 0;

                                        if($discount != 0 ){
                                            if($discount < 100) {

                                                $price_discount_promotion = ( $price_total_all * $discount ) / 100;
                                            }else {

                                                $price_discount_promotion = $discount;
                                            }
                                        }
                                        $price_remain = $price_total_all - $price_discount_promotion;

                                        echo $price_discount_promotion;
                                    ?>@else 0 @endif"></span> <sup>đ</sup>
                                </span>
                            </td>
                            <td colspan="1"></td>
                        </tr>
                        <tr>
                            <td colspan="3">Mã đại lý : </td>
                            <td colspan="1">
                                <span class="val">
                                    <span class="format-currency discount-happy-code"  data-decimals='0' data-value="0"></span> <sup>đ</sup>
                                </span>
                            </td>
                            <td colspan="1"></td>
                        </tr>
                        <tr>
                            <td colspan="3"> Tổng đơn hàng : </td>
                            <td colspan="1">
                                <span class="val">
                                    <span class="format-currency total-price-after-discount"  data-decimals='0' data-value="@if($price_remain < 0 )0 @else{{ $price_total_all - $price_discount_promotion }}@endif"></span> <sup>đ</sup>
                                </span>
                            </td>
                            <td colspan="1"></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <a href="/" class="btn btn-default">Tiếp tục mua sắm</a>
                                <button data-tooltip="Nhấp vào đây để&lt;br /&gt;cập nhật thông tin sản phẩm" class="btn btn-success ttip" type="submit" style="cursor: pointer;"><i class="fa fa-refresh"></i> Cập nhật số lượng</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </section>

    @if(isset($data) && !$data['meta']['success'] && $data['meta']['code'] == '0034')

        {{ $data['meta']['msg']['create-acc'] }}. Vui longf <a>login</a> hoac su dung tinh nang <a>Quen mat khau</a> de thuc hien giao dich
    @endif
    <form action="{{ URL::Route('web-post-confirm-orders') }}" id="user-information" method="POST">
        <section class="order-profile-block">
            <div class="block-head">
                <div class="block-title">
                    Thông tin cá nhân
                </div>
            </div>

            <div class="block-main">
                <table class="profile-tb">
                    <thead>
                        <tr>
                            <th style="width: 50%">
                                <div class="pull-left">THÔNG TIN NGƯỜI MUA</div>
                                @if(!Auth::guard('customer')->check())
                                <div class="pull-right">
                                    <label class="control-radio-1">
                                        <input type="checkbox" class="buyer-new-acc-cb" name="create_new_acc">
                                        <div class="indicator" id="create_new_acc">Sử dụng thông tin này để tạo tài khoản mới</div>
                                    </label>
                                </div>
                                @endif
                                <div class="clearfix"></div>
                            </th>
                            <th style="width: 50%">
                                <div class="pull-left">THÔNG TIN NGƯỜI NHẬN</div>
                                <div class="pull-right">
                                    <label class="control-radio-1">
                                        <input type="checkbox" class="buyer-profile-cb" name="receiverInfo">
                                        <div class="indicator" id="receiverInfo">Người nhận khác người mua</div>
                                    </label>
                                </div>
                                <div class="clearfix"></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="buyer-profile-wrap">
                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-user"></i></div>
                                            <input type="text" placeholder="Họ" class="input-2" name="buyerFirstname" value="@if(Auth::guard('customer')->check()){{Auth::guard('customer')->user()->first_name}}@endif" />
                                    </div>
                                </div>

                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-user"></i></div>

                                            <input type="text" placeholder="Tên" class="input-2" name="buyerLastname" value="@if(Auth::guard('customer')->check()){{Auth::guard('customer')->user()->last_name}}@endif" />
                                    </div>
                                </div>

                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-phone"></i></div>

                                            <input type="text" placeholder="Số điện thoại" class="input-2" name="buyerPhone" value="@if(Auth::guard('customer')->check()){{Auth::guard('customer')->user()->phone_number}}@endif" />
                                    </div>
                                </div>

                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-envelope"></i></div>

                                            <input type="email" placeholder="Email" class="input-2" name="buyerEmail" value="@if(Auth::guard('customer')->check()){{Auth::guard('customer')->user()->email}}@endif" />
                                    </div>
                                </div>

                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-send"></i></div>
                                        <input type="text" placeholder="Địa chỉ" class="input-2" name="buyerAddress" value="@if(Auth::guard('customer')->check()){{Auth::guard('customer')->user()->address}}@endif" />
                                    </div>
                                </div>

                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-map-marker"></i></div>
                                        <select name="buyerCityID" id="buyerCityID" data-url-get-data="{{ URL::Route('post-get-data-district') }}" class="city" data-type="buyer"  @if(Auth::guard('customer')->check() && Auth::guard('customer')->user()->city != null) value="Auth::guard('customer')->user()->city" @endif>
                                            <option value="0">Vui lòng chọn Tỉnh / Thành</option>
                                            @foreach($city as $key => $value)
                                                <option @if(Auth::guard('customer')->check() && Auth::guard('customer')->user()->city != null && Auth::guard('customer')->user()->city == $value->id ) selected @endif value="{{ $value->id }}" >{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-map-marker"></i></div>
                                        <select name="buyerDistrictID"  id="buyerDistrictID" data-url-get-data="{{ URL::Route('post-get-data-ward') }}"  class="district" data-type="buyer">
                                            <option value="0">Vui lòng chọn Quận / Huyện</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-map-marker"></i></div>
                                        <select name="buyerWardID"  id="buyerWardID" class="ward" data-type="buyer">
                                            <option value="0">Vui lòng chọn Phường / Xã</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td class="receiver-profile-wrap is-disable" disabled="">

                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-user"></i></div>
                                        <input type="text" placeholder="Họ  người nhận hàng" class="input-2" name="receiverFirstname" value="" />
                                    </div>
                                </div>

                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-user"></i></div>
                                            <input type="text" placeholder="Tên người nhận hàng" class="input-2" name="receiverLastname" value="" />
                                    </div>
                                </div>

                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-phone"></i></div>
                                            <input type="text" placeholder="Số điện thoại người nhận hàng" class="input-2" name="receiverPhone" value="" />
                                    </div>
                                </div>

                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-envelope"></i></div>
                                            <input type="email" placeholder="Email người nhận hàng" class="input-2" name="receiverEmail" value=""/>
                                    </div>
                                </div>

                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-send"></i></div>
                                        <input type="text" placeholder="Địa chỉ người nhận hàng" class="input-2" name="receiverAddress" />
                                    </div>
                                </div>

                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-map-marker"></i></div>
                                        <select name="receiverCityID" id="receiverCityID" data-url-get-data="{{ URL::Route('post-get-data-district') }}" class="city" data-type="receiver">
                                            <option value="0">Vui lòng chọn Tỉnh / Thành</option>
                                            @foreach($city as $key => $value)
                                                <option  value="{{ $value->id }}" >{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-map-marker"></i></div>
                                        <select name="receiverDistrictID"  id="receiverDistrictID" data-url-get-data="{{ URL::Route('post-get-data-ward') }}" class="district" data-type="receiver">
                                            <option value="0">Vui lòng chọn Quận / Huyện</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group-1">
                                    <div class="form-control-2">
                                        <div class="icon"><i class="fa fa-map-marker"></i></div>
                                        <select name="receiverWardID"  id="receiverWardID" class="ward" data-type="receiver">
                                            <option value="0">Vui lòng chọn Phường / Xã</option>
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <section class="order-sale-code-block">
            <div class="block-head"><div class="block-title">Nhập mã khuyến mãi</div></div>
            <div class="block-main">
                <table class="sale-code-tb">
                    <thead>
                        <tr>
                            <th style="width: 50%">Nhập mã giảm giá</th>
                            <th style="width: 50%">Nhập mã đại lý (nếu có)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>
                                <div class="input-wrap sale-code-wrap">
                                    <from id="use-promotion-code" action="{{ URL::Route('web-post-use-promotion-code') }}" method="POST" accept-charset="utf-8">
                                        <input id="discount-code" name="discountCode" type="text" placeholder="Nhập mã giảm giá" value="" class="txt">
                                        <button class="btn-submit-form check-btn btn-submit-form-use-promotion" type="button" >Nhập</button>
                                    </from>

                                </div>
                                <p>- Ngoài mã khuyến mãi và chiết khấu được quy định sẵn, mà quý khách sẽ được giảm khi đặt hàng.</p>
                                <p>- SumoShipping cũng sẽ xem xét số lượng từng món hàng hàng của quý khách để tăng mức chiết khấu thêm cho quý khách.</p>
                                <p>- Nếu có chiết khấu cộng thêm, chúng tôi sẽ ghi rõ trên đơn hàng của quý khách.</p>
                            </td>
                            <td>
                                <div class="input-wrap agency-code-wrap">
                                    <from id="use-happy-code" action="{{ URL::Route('web-post-use-happy-code') }}" method="POST" accept-charset="utf-8">
                                        <input id="discount-happy-code" name="happyCode" type="text" placeholder="Nhập mã đại lý" value="" class="txt">
                                        <button class="btn-submit-form check-btn btn-submit-form-use-happy-code"  type="button">Nhập</button>
                                    </from>
                                    
                                </div>
                                <p>- Ngoài mã khuyến mãi và chiết khấu được quy định sẵn, mà quý khách sẽ được giảm khi đặt hàng.</p>
                                <p>- SumoShipping cũng sẽ xem xét số lượng từng món hàng hàng của quý khách để tăng mức chiết khấu thêm cho quý khách.</p>
                                <p>- Nếu có chiết khấu cộng thêm, chúng tôi sẽ ghi rõ trên đơn hàng của quý khách.</p>
                            </td>
                        </tr></tbody>
                </table>
            </div>
            <div class="block-foot">
                <a class="btn btn-default" href="#">Quay lại giỏ hàng</a>
                <button class="btn btn-danger" type="submit">Bước 3 : hình thức thanh toán</button>
            </div>
        </section>
    </form>
</div>
@endsection