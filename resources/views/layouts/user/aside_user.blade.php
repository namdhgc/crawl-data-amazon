<aside class="sidebar-aside">
    <div class="menu-side-box">
        <div class="box-head">
            <div class="box-title">
                <a href="#">Quản lý cá nhân</a>
            </div>
        </div><!-- .box-head -->
        <div class="box-main">
            <ul class="menu-list">
                <li> <a href="{{ URL::Route('web-get-user-information') }}">Thông tin cá nhân</a></li>
                <li> <a href="{{ URL::Route('web-get-change-password') }}">Thay đổi mật khẩu</a></li>
            </ul><!-- .menu-list -->
        </div><!-- .box-main -->
    </div><!-- .menu-side-box -->
    <div class="menu-side-box">
        <div class="box-head">
            <div class="box-title">
                <a href="#">Quản lý mua hàng</a>
            </div>
        </div><!-- .box-head -->
        <div class="box-main">
            <ul class="menu-list">
                <li> <a href="{{ URL::Route('web-get-order-tracking') }}">Lịch sử đơn hàng</a></li>
                <li> <a href="{{ URL::Route('web-get-price-request') }}">Yêu cầu báo giá</a></li>
                <li> <a href="{{ URL::Route('web-get-favorite-product') }}">Sản phẩm yêu thích</a></li>
                <li> <a href="{{ URL::Route('web-get-happy-code') }}">Đăng ký happy code</a></li>
                <!-- <li> <a href="#">Danh sách mã giảm giá</a></li> -->
            </ul>
        </div>
    </div>
</aside>