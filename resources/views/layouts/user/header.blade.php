<style type="text/css">
    * {
        outline: none !important;
    }
    span.parent_sub_cate {
        font-weight: bold;
        border-bottom: solid;
        border-width: 1px;
    }
    div.sub_cate ul {
        margin-top: 5px;
    }
    .header-block .row-2-wrap .main-search-box .main-search-form .keyword-txt {
        left: 13px !important;
        border-radius: 17px !important;
        background: none !important;
    }
    #google_translate_element .goog-te-gadget .goog-te-combo {
        background: white !important;
    }

    #google_translate_element div[id^=":0.targetLanguage"]::before {
        content: "";
        background-image: url({{ URL::asset('fado/images/icon-lang.png') }});
        background-position: 0 0;
        position: absolute;
        display: block;
        width: 18px;
        height: 18px;
        z-index: 4;
        left: 7px;
        top: 6px;
    }
</style>
<section id="header-ajax" class=" header-block js-header-block @if(Request::is('/')) is-homepage  @endif">
    <div class="block-head">
        <div class="container">
            <div class="pull-left">
                <div class="language"></div>
                <div class="support">
                    <a href="#">Hỗ trợ khách hàng</a>
                    <div class="drop-list">
                        <a href="{{ URL::Route('web-get-frequently-asked-questions') }}">Tư vấn khách hàng</a>
                        <a href="{{ URL::Route('web-get-shopping-guide') }}">Hướng dẫn mua hàng</a>
                    </div>
                </div>
            </div>
            <div class="pull-right">
                <div class="right-segment">
                    <a class="item checkout" href="#" data-toggle="modal" data-target="#kiem-tra-don-hang"><span>Kiểm tra đơn hàng</span></a>
                    <div class="item acc" href="">
                        <i class="ficon user"></i>
                        @if(@Auth::guard('customer')->check() == true)
                        {{ @Auth::guard('customer')->user()->username }}
                        @else
                        <span>Tài khoản</span>
                        @endif
                        <i class="fa fa-caret-down"></i>
                        <div class="drop-list">
                            @if(@Auth::guard('customer')->check() == true)
                            <a href="{{ URL::Route('web-get-order-tracking') }}"><i class="fa fa-mail-forward"></i> Kiểm tra đơn hàng </a>
                            <a href="{{ URL::Route('web-get-user-information') }}"><i class="fa fa-user"></i> Thông tin người dùng </a>
                            <a href="{{ URL::Route('web-get-favorite-product') }}"><i class="fa fa-heart"></i> Sản phẩm yêu thích </a>
                            <a href="{{ URL::Route('web-get-show-price-request') }}"><i class="fa fa-comment"></i> Yêu cầu báo giá </a>
                            <a href="{{ URL::Route('web-get-happy-code') }}"><i class="fa fa-plus"></i> Đăng kí happy code </a>
                            <a href="{{ URL::Route('web-get-change-password') }}"><i class="fa fa-key"></i> Thay đổi mật khẩu </a>
                            <a href="{{ URL::Route('web-get-logout')}}"><i class="fa fa-sign-out"></i> Đăng xuất </a>
                            @else
                            <a href="#" data-toggle="modal" data-target="#dang-nhap"><i class="fa fa-sign-in"></i>Đăng nhập</a>
                            <a href="#" data-toggle="modal" data-target="#dang-ky-tai-khoan"><i class="fa fa-user-plus"></i>Đăng ký</a>
                            @endif
                        </div>
                    </div>
                    <a class="item min-cart js-call-cart-modal" href="{{ URL::Route('web-get-my-shopping-cart') }}">
                    <i class="ficon cart"></i>
                    @if( isset($_COOKIE['shopping_cart']) && Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null )
                    <span class="number">
                    {{ COUNT(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products']) }}
                    </span>
                    @endif
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div class="block-main">
        <div class="container">
            <div class="row-1-wrap">
                <div class="show-stat-box visible-lg">
                    <div class="item">
                        <div class="title">
                            @if(!empty(Cache::get('total_products')))
                            {{ Cache::get('total_products') }}
                            @endif
                        </div>
                        <div class="text">Sản phẩm trên Amazon</div>
                    </div>
                    <div class="item">
                        <div class="title">
                            @if(!empty(Cache::get('total_transaction_success')))
                            {{ Cache::get('total_transaction_success') }}
                            @endif
                        </div>
                        <div class="text">thành công qua {{ Cache::get('company_name') }}</div>
                    </div>
                </div>
            </div>
            <div class="row-2-wrap">
                <a class="logo" href="{{ URL::Route('web-get-homePage') }}">
                <span class="inner">
                <?php
                    $logo  = "";
                    if(!empty(Cache::get('logo'))){
                        $logo   = Cache::get('logo');
                    }
                    ?>
                <img src="{{ URL::asset( $logo ) }}" >
                </span>
                </a>
                <div class="main-cate-menu js-main-cate-menu">
                    <div class="menu-head sfsdfsdf">
                        <span class="icon"></span>
                        <span class="title">Danh mục</span>
                    </div>
                    <div class="menu-main">
                        <ul class="lv1" id="header-menu-ajax">
                            @foreach(Cache::get('product_categories') as $key => $value )
                            <li data-menu="" class="theme-cate-1">
                                <a href="javascript:;">
                                <span class="icon" 1=""><img src="{{ URL::asset($value['icon']) }}" alt=""></span>
                                <span class="text" title=">@if($value['title'] == '' || $value['title'] == null){{ $value['name'] }} @else $value['title'] @endif">@if($value['title'] == '' || $value['title'] == null){{ $value['name'] }} @else {{$value['title']}} @endif</span></a>
                                <div class="sub-menu-box">
                                    <div class="col-1">
                                        <div class="row row-5px">
                                            @if(isset($value['child'][0]) && $value['child'][0]['amazon_id'] != "")
                                            <div class="col-xs-3">
                                                <ul class="lv3">
                                                    @endif
                                                        @foreach( $value['child'] as $sub_key => $sub_value)
                                                            @if($sub_value['amazon_id'] == "" && is_array($sub_value['child']) && COUNT($sub_value['child']) > 0)
                                                            <div class="col-xs-3 sub_cate">
                                                                <span class="text parent_sub_cate"
                                                                title="@if($sub_value['title'] == '' || $sub_value['title'] == null){{ $sub_value['name'] }} @else $sub_value['title'] @endif"
                                                                >@if($sub_value['title'] == '' || $sub_value['title'] == null){{ $sub_value['name'] }} @else {{$sub_value['title']}} @endif</span>
                                                                <ul class="lv3">
                                                                    @foreach($sub_value['child'] as $child_key => $child_value)
                                                                    <li><a  title="@if($child_value['title'] == '' || $child_value['title'] == null){{ $child_value['name'] }} @else {{$child_value['title']}} @endif" href="{{ URL::Route('web-get-product-by-category', [ 'n' => $child_value['amazon_id']])  }}">@if($child_value['title'] == '' || $child_value['title'] == null){{ $child_value['name'] }} @else {{$child_value['title']}} @endif</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                            @else
                                                            <li><a title="@if($sub_value['title'] == '' || $sub_value['title'] == null){{ $sub_value['name'] }} @else {{$sub_value['title']}} @endif" href="{{ URL::Route('web-get-product-by-category', [ 'n' => $sub_value['amazon_id']])  }}">@if($sub_value['title'] == '' || $sub_value['title'] == null){{ $sub_value['name'] }} @else {{$sub_value['title']}} @endif</a></li>
                                                            @endif
                                                        @endforeach
                                                    @if(isset($value['child'][0]) && $value['child'][0]['amazon_id'] != "")
                                                </ul>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-2 visible-lg"><a href="#" class="banner-img"><img src="{{ URL::asset($value['background_image']) }}"></a></div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="main-search-box js-main-search-box">
                    <form action="{{ URL::Route('web-get-search-product-by-key') }}" method="GET">
                        <div class="main-search-form searchfrm" >
                            <!-- <div class="web-sel-control">
                                <input type="text" class="web-input" value="2">
                                <div class="current"><span class="notranslate">Amazon</span> <img src="http://static.fado.vn/f/desktop/v1/images/icon-jap.png" ></div>
                                <ul class="list langList">
                                    <li class="searchLang notranslate" data-value="2" data-lang="jp"><span class="notranslate">Amazon</span>
                                        <img src="http://static.fado.vn/f/desktop/v1/images/icon-jap.png">
                                    </li>
                                </ul>
                                </div> -->
                            <input type="text" class="keyword-txt" name="field-keywords" value="@if( Input::get('field-keywords') != null){{ Input::get('field-keywords') }}@endif" placeholder="Gõ tiếng Việt hoặc Anh để tìm sản phẩm trên Amazon">
                            <div class="cate-sel-control"></div>
                            <button type="submit" class="search-btn"></button>
                        </div>
                    </form>
                </div>
                <div class="other-links">
                    <ul class="list">
                        <!-- <li>
                            <a href="http://fado.vn/xuat-khau-vao-my.c53/">Xuất khẩu vào Mỹ
                                <span class="new"><img src="http://static.fado.vn/f/desktop/v1/images/icon-new.gif" ></span>
                            </a>
                            </li> -->
                        <li><a href="{{ URL::Route('web-get-frequently-asked-questions') }}">Tư vấn khách hàng</a></li>
                        <li><a href="{{ URL::Route('web-get-news') }}">Tin tức</a></li>
                        <li><a href="{{ URL::Route('web-get-frequently-asked-questions') }}">Câu hỏi thường gặp</a></li>
                        <!-- <li><a href="http://fado.vn/huong-dan-cach-mua-hang-tren-amazon-ship-ve-viet-nam.n432/">Hướng dẫn mua sắm</a></li>
                            <li><a href="http://fado.vn/ho-tro-khach-hang.c3/">Bảo vệ khách hàng
                                    <span class="new"><img src="http://static.fado.vn/f/desktop/v1/images/icon-new.gif" ></span>
                                </a></li>
                            <li class="visible-lg"><a href="http://fado.vn/dich-vu-van-chuyen-hang-hoa-tu-my-ve-viet-nam.n59/">Vận chuyển quốc tế</a></li>
                            <li class="visible-lg"><a href="http://fado.vn/huong-dan-do-size-quan-ao-my-danh-cho-nu.n76/">Bảng giá &amp; Tra cỡ</a></li> -->
                    </ul>
                </div>
                <div class="gg-translate">
                    <div id="google_translate_element">
                    </div>
                </div>
                <div class="contact">
                    <div class="phone"><i class="fa fa-phone"></i>
                        @if(!empty(Cache::get('hotline')))
                        {{ Cache::get('hotline') }}
                        @endif
                    </div>
                    <div class="email"><i class="fa fa-envelope"></i>
                        @if(!empty(Cache::get('email_support')))
                        {{ Cache::get('email_support') }}
                        @endif
                    </div>
                </div>
                <a class="min-cart js-call-cart-modal" href="#">
                <i class="ficon cart"></i>
                </a>
            </div>
        </div>
    </div>
</section>