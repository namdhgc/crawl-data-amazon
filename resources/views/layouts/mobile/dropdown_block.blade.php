
<section class="userpage-menu-block dropdown-block js-dropdown-block">
    <div class="block-head">
        <div class="block-title">Quản lý cá nhân</div>
    </div>
    <div class="block-main">
        <ul class="lv1">
            <li><a href="{{ Route('web-get-user-information') }}">Thông tin cá nhân</a></li>
            <li><a href="{{ Route('web-get-change-password') }}">Thay đổi mật khẩu</a></li>
        </ul>
    </div>
</section>

<section class="userpage-menu-block dropdown-block js-dropdown-block">
    <div class="block-head">
        <div class="block-title">Quản lý mua hàng</div>
    </div>
    <div class="block-main">
        <ul class="lv1">
            <li><a href="{{ URL::Route('web-get-order-tracking') }}">Lịch sử đơn hàng</a></li>
            <li><a href="{{ URL::Route('web-get-favorite-product') }}">Sản phẩm yêu thích</a></li>
            <li><a href="{{ URL::Route('web-get-show-price-request') }}">Danh sách báo giá</a></li>
            <li><a href="{{ URL::Route('web-get-happy-code') }}">Đăng ký Happy Code</a></li>
        </ul>
    </div>
</section>