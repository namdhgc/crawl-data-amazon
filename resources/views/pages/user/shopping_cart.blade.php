@extends('layouts/user/master')

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

</section>
        <section class="breadcrumb-block">
    <div class="container">
        <div class="item">
            <a href="/">Trang chủ</a>
        </div>
        <div class="item">Giỏ hàng</div>
    </div>
</section>

<section class="steps-order-block">
    <div class="container">
        <div class="step-item is-active">
            <i class="fa fa-shopping-cart"></i><br>
            <div class="text">Giỏ hàng<br>của bạn</div>
        </div>
        <div class="step-item">
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
        @if( isset($_COOKIE['shopping_cart']) && (Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null && COUNT(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products']) > 0) )

        <section class="order-cart-block">
            <div class="block-head"><div class="block-title">Giỏ hàng của bạn</div></div>
            <div class="block-main">
                <form class="order-cart-form" method="POST" action="{{ URL::Route('web-post-update-shoping-cart-2') }}">
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
                            <?php  $price_total_all = 0; $count = 1; $price_discount_promotion = 0;?>
                            @if( isset($_COOKIE['shopping_cart']) && (Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null && COUNT(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products']) > 0) )
                                @foreach(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products'] as $key => $value)
                                <tr class="product-item">
                                    <td class="order">{{$count}}</td>
                                    <td class="product-info">
                                        <a target="_blank" href="{{ $value['img'] }}" class="img"><img alt="" src="{{ $value['img'] }}"></a>
                                        <div class="info-wrap">
                                            <div class="title">
                                                <a target="_blank" data-name="" href="{{ URL::Route('web-get-detail-product',['code' => $value['code']]) }}">{!! $value['name'] !!}</a>
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
        <section class="order-login-block">
            <div class="block-head">
                <div class="block-title">
                    Đăng nhập tài khoản
                </div>
            </div>

            <div class="block-main">
                <form id="frm-order-login" class="order-login-form" method="POST">
                    <div class="form-group-1 login-type-group">
                        <label class="control-radio-1">
                            <input type="radio" name="login-type" class="login-type-rad" checked="" value="0" />
                            <div class="indicator">Mua hàng không cần đăng nhập</div>
                        </label>

                        <label class="control-radio-1">
                            <input type="radio" name="login-type" class="login-type-rad" value="1" />
                            <div class="indicator">Tôi đã có tài khoản</div>
                        </label>
                    </div>

                    <div class="user-login-wrap is-disabled">
                        <div class="form-group-1">
                            <label class="lbl-1"><i class="fa fa-envelope-o"></i>Địa chỉ email hoặc số điện thoại của bạn:</label>
                            <input type="text" name="email" class="form-control-1 user-input" disabled=""  placeholder=""/>
                            <!--<div class="error-control-1">
                              Bạn chưa nhập địa chỉ email
                            </div>-->
                        </div>

                        <div class="form-group-1">
                            <div class="pull-left">
                                <label class="lbl-1"><i class="fa fa-key"></i>Mật khẩu:</label>
                            </div>

                            <div class="pull-right">
                                <a href="#" data-toggle="modal" data-target="#lay-lai-mat-khau">Quên mật khẩu</a>
                            </div>

                            <div class="clearfix"></div>

                            <input type="password" name="password" class="form-control-1 password-input" disabled=""  placeholder=""/>
                        </div>
                    </div>

                    <div class="form-group-1 btn-wrap">
                        <button class="btn btn-danger btnInforConfirm" data-login="0" type="button"><i class="fa"></i>Tiếp tục</button>
                    </div>
                                            <div class="login-with-text">
                        Đăng nhập với:
                        <a href="javascript:;" onclick="socialLogin('https://www.facebook.com/v2.2/dialog/oauth?client_id=379542705504383&state=536200ea3b250caf012926cd740e10de&response_type=code&sdk=php-sdk-5.3.1&redirect_uri=http%3A%2F%2Ffado.vn%2Fdang-nhap-bang-mang-xa-hoi-facebook&scope=email%2Cpublic_profile')"><img src="http://static.fado.vn/f/desktop/v1/images/icon-login-fb.png" alt="" /></a>
                        <a href="javascript:;" onclick="socialLogin('https://accounts.google.com/o/oauth2/auth?response_type=code&redirect_uri=http%3A%2F%2Ffado.vn%2Fdang-nhap-bang-mang-xa-hoi-google&client_id=701745402520-dg85nkn87it0untk25e7moq233jauc0p.apps.googleusercontent.com&scope=email+profile&access_type=online&approval_prompt=auto')"><img src="http://static.fado.vn/f/desktop/v1/images/icon-login-gp.png" alt="" /></a>
                    </div>

                    <div class="register-text">
                        Bạn chưa có tài khoản? Vui lòng <a href="#" data-toggle="modal" data-target="#dang-ky-tai-khoan">Đăng ký tại đây</a>
                    </div>
                </form>
            </div>
        </section>

        @else
            <div class="container">
                <div class="alert alert-danger text-center" role="alert">
                    <b>Hiện tại không có sản phẩm nào trong giỏ hàng</b>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection