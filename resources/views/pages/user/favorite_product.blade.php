@extends('layouts/user/master')

@section('title')
@endsection

@section('css')
@endsection

@section('js')
<script src="{{ URL::asset('assets/web/scripts/detail-product.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('fado/js/user.js') }}" type="text/javascript"></script>
<script>
    DetailProduct.favoriteProduct();
</script>
@endsection

@section('content')
<section class="breadcrumb-block">
    <div class="container">
        <div class="item">
            <a href="#">Trang chủ</a>
        </div>
        <div class="item">
            <a href="#">Quản lý mua hàng</a>
        </div>
        <div class="item">
            Sản phẩm yêu thích
        </div>
    </div><!-- .container -->
</section>
<div class="favorite-product-page page">
    <div class="container page-container">

        @include('layouts.user.aside_user')

        <div class="main-col">
            <section class="favorite-product-block block-1">
                <div class="block-head">
                    <div class="block-title">Sản phẩm yêu thích</div>
                </div><!-- .block-head -->
                <div class="block-main">
                    <form action="{{ URL::Route('web-post-delete-favorite-product') }}" method="POST">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <table class="product-tb table-2 table-2-striped">
                            <thead>
                                <tr>
                                    <th style="max-width: 100px;width: 100px;">Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th style="max-width: 100px;width: 100px;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($data) && $data['data']['meta']['success'])
                                    @foreach($data['data']['response'] as $key => $item)
                                    <tr>
                                        <td class="pd-img"><img src="{{ $item->product_image }}" alt=""></td>
                                        <td class="pd-title">
                                            <a href="{{ URL::Route('web-get-detail-product') . '?code=' . $item->product_code }}" target="_blank">
                                                    {{ $item->product_name }}
                                            </a>
                                            <p></p>
                                        </td>
                                        <td class="tool">
                                            <a target="_blank" href="{{ URL::Route('web-get-detail-product') . '?code=' . $item->product_code }}" class="btn btn-default btn-sm">
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </a>
                                            <button type="button" class="btn btn-default btn-sm btnRemoveFavouriteProduct" data-id="{{ $item->id }}" data-product_code="{{ $item->product_code }}" data-customer_id="{{ $item->customer_id }}"><i class="fa fa-remove"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </form>
                    <div class="pagination-wrap">
                        <center>
                            {!! Spr\Base\Controllers\Views\DataTable::paginate($data); !!}
                        </center>
                    </div><!-- .pagination-wrap -->
                </div><!-- .block-main -->
            </section><!-- .block-1 -->
        </div>
    </div><!-- .container .page-container -->
</div>
<div class="bootbox modal modal-2 fade bootbox-alert in" id="modal_alert" tabindex="-1" role="dialog" style="display: none; padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="bootbox-close-button" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                <h4 class="modal-title">Thông báo</h4>
            </div>
            <div class="modal-body">
                <div class="bootbox-body" id="modal_message"></div>
            </div>
            <div class="modal-footer">
                <button data-bb-handler="ok" type="button" class="btn btn-danger" data-dismiss="modal">Đồng ý</button>
            </div>
        </div>
    </div>
</div>
@endsection