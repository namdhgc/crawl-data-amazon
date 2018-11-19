@extends('layouts/mobile/master')


@section('title')
@endsection


@section('css')
@endsection


@section('js')
@endsection


@section('content')
<section class="breadcrumb-block js-breadcrumb-block">
    <div class="block-head">
        <div class="block-title">
            <a href="#">
                <span class="icon"><i class="fa fa-long-arrow-left"></i></span>
                <span class="title">Sản phẩm yêu thích</span>
            </a>
        </div>
    </div>
</section>

<section class="userpage-menu-block dropdown-block js-dropdown-block">
    <div class="block-head">
        <div class="block-title">Quản lý cá nhân</div>
    </div>
    <div class="block-main">
        <ul class="lv1">
            <li><a href="http://fado.vn/chinh-sua-thong-tin">Thông tin cá nhân</a></li>
            <li><a href="http://fado.vn/thay-doi-mat-khau">Thay đổi mật khẩu</a></li>
        </ul>
    </div>
</section>

<section class="userpage-menu-block dropdown-block js-dropdown-block">
    <div class="block-head">
        <div class="block-title">Quản lý mua hàng</div>
    </div>
    <div class="block-main">
        <ul class="lv1">
            <li><a href="http://fado.vn/quan-ly-don-hang">Lịch sử đơn hàng</a></li>
            <li><a href="http://fado.vn/san-pham-yeu-thich">Sản phẩm yêu thích</a></li>
            <li><a href="http://fado.vn/xem-danh-sach-bao-gia">Danh sách báo giá</a></li>
            <li><a href="http://fado.vn/happy-code">Đăng ký Happy Code</a></li>
            <li><a href="http://fado.vn/danh-sach-ma-giam-gia">Danh sách mã giảm giá</a></li>
        </ul>
    </div>
</section>

<section class="favorite-product-block">
    <div class="block-main">
        <div class="list-product-panel dropdown-panel is-expand">
            <div class="panel-head">
                <div class="panel-title">Danh sách sản phẩm</div>
            </div>


            <div class="panel-main">
        	@if(isset($data) && $data['data']['meta']['success'])
                @foreach($data['data']['response'] as $key => $item)
                <div class="product-box">
                    <div class="remove-btn btnRemoveFavouriteProduct" rel="76184"><i class="fa fa-remove"></i></div>

                    <div class="box-head">
                        <a class="img" href="#">
                        	<span class="tb-cell">
                        		<img src="{{ $item->product_image }}" alt="{{ $item->product_image }}">
                        	</span>
                        </a>
                        <div class="info-wrap">
                            <div class="title">
                            	<a href="{{ URL::Route('web-get-detail-product') . '?code=' . $item->product_code }}">
                              		{{ $item->product_name }}
								</a>
                                <p>Style:Retail</p>
                            </div>
                            <div class="order-code">
                            	Mã SP: 
                            	<span>{{ $item->product_code }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            	@endforeach
            @endif
            </div>

            <div class="panel-foot">
                <div class="pagination-wrap">
                    <!-- <input type="number" class="page-input" value="1" min="1">
                    <a href="#">
                    	Trang sau <i class="fa fa-angle-right"></i>
                    </a> -->
               	</div>
            </div>
        </div>
    </div>
</section>
@endsection