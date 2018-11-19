<style type="text/css">
    
    .user-link {

        background: url({{ URL::asset('assets/uploads/images/img-avatar.png') }}) no-repeat left center !important;
    }
</style>
<aside class="sidebar-aside js-sidebar-aside">
    <div class="exit-btn visible-xs visible-sm"><i class="fa fa-close"></i></div>

    <div class="aside-container">
        <div class="aside-head">
            <div class="user-link">
                <ul class="link-list">
                @if(Auth::guard('customer')->check())
                    <li>
                        <a href="">Xin chào, 
                        @if(@Auth::guard('customer')->check() == true) 
                            {{ @Auth::guard('customer')->user()->username }}
                        @endif
                        </a>
                    </li>
                @else 
                    <li><a href="{{ URL::Route('web-get-login') }}" >Đăng nhập</a></li>
                    <li>/</li>
                    <li><a href="{{ URL::Route('web-get-register') }}">Đăng ký</a></li>
                @endif
                </ul>
            </div>

            <div class="info-link">
                <ul class="link-list">
                    <li>
                        @if(Auth::check())
                            <a href="{{ URL::Route('web-get-user-information') }}">Thông tin</a>
                        @else
                            <a href="{{ URL::Route('web-get-homePage') }}">Thông tin</a>
                        @endif
                    </li>
                    <li>/</li>
                    <li class="cart">
                    <a href="{{ URL::Route('web-get-my-shopping-cart') }}"><img src="{{ URL::asset('assets/uploads/images/icon-cart-min.png') }}" alt=""><span class="number">@if( isset($_COOKIE['shopping_cart']) && Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null )
                {{ COUNT(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products']) }}
            @else 
                0
            @endif</span></a>
                    </li>
                    @if(Auth::guard('customer')->check())
                    <li><a href="{{ URL::Route('web-get-logout') }}">Thoát</a></li>
                    @endif
                       
                </ul>
            </div>
        </div>

        <div class="aside-main">
            <div class="info-panel">
                <div class="item gg-translate">
                    <div id="google_translate_element">
                        
                    </div>
                </div>

                <div class="item hotline">

                    Hotline: <span><a href="tel:@if(!empty(Cache::get('hotline'))){{ Cache::get('hotline') }} @endif">@if(!empty(Cache::get('hotline')))
                            {{ Cache::get('hotline') }}
                        @endif</a></span>
                </div>
                <div class="item hotline">
                    Email: <span>@if(!empty(Cache::get('email_support')))
                            {{ Cache::get('email_support') }}
                        @endif</span>
                </div>

                <div class="item support">
                    <div class="title">Chăm sóc &amp; Hỗ trợ khách hàng</div>

                    <div class="drop-list">
                        <a href="{{ URL::Route('web-get-frequently-asked-questions') }}">Tư vấn khách hàng</a>
                        <a href="{{ URL::Route('web-get-shopping-guide') }}">Hướng dẫn mua hàng</a>
                        <a href="{{ URL::Route('web-get-frequently-asked-questions') }}">Câu hỏi thường gặp</a>
                    </div>
                </div>

                <div class="item checkout">
                    <a href="{{ URL::Route('web-get-order-tracking') }}">Kiểm tra đơn hàng</a>
                </div>
            </div>

            
        </div>
    </div>
</aside>

<div class="modal fade check-bill-modal" id="kiem-tra-don-hang" tabindex="-1" role="dialog" style="z-index: 1040; display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="exit-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <div class="modal-title">Kiểm tra đơn hàng</div>
            </div>
            <div class="modal-body">
                <form action="{{ URL::route('web-get-order-tracking-detail') }}" method="GET" class="check-bill-form" novalidate="novalidate">
                    <div class="control-group">
                        <input type="text" class="form-control" name="code" placeholder="Mã đơn hàng" required="" aria-required="true">
                    </div>

                    <div class="control-group">
                        <input type="text" class="form-control" name="phone_number" placeholder="Số điện thoại" required="" aria-required="true">
                    </div>

                    <div class="btn-wrap">
                        <div class="row row-5px">
                            <div class="col-xs-6">
                                <button class="btn btn-default btn-block" type="reset">Nhập lại</button>
                            </div>

                            <div class="col-xs-6">
                                <button class="btn btn-danger btn-block bt-traking-order" type="submit"><i class="fa"></i> Kiểm tra</button>
                            </div>
                        </div>
                    </div>
                    <div class="notify-wrap" style="display: none;margin: 10px 0 0 0">
                        <div class="alert-1 alert alert-danger message">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
