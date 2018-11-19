@extends('layouts/user/master')

@section('title')
{{ Lang::get('price_request.price_request_title') }}
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
            Yêu cầu báo giá
        </div>
</section>
<div class="favorite-product-page page">
    <div class="container page-container">
        
        @include('layouts.user.aside_user')
        
        <div class="main-col">
            <section class="favorite-product-block block-1">
                <div class="block-head">
                    <div class="block-title">{{ Lang::get('price_request.price_request_title') }}</div>
                </div><!-- .block-head -->
                <div class="block-main">
                    <form action="{{ URL::Route('web-post-delete-favorite-product') }}" method="POST">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <table class="product-tb table-2 table-2-striped">
                            <thead>
                                <tr>
                                    <th style="max-width: 100px;width: 100px;">{{ Lang::get('price_request.message') }}</th>
                                    <th style="max-width: 100px;width: 100px;">{{ Lang::get('price_request.status') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($data) && $data['data']['meta']['success'])
                                    @foreach($data['data']['response'] as $key => $item)
                                    <tr>
                                        <td class="pd-title">
                                            <a href="" target="_blank"></a>
                                            <p>{{ $item->message }}</p>
                                        </td>
                                        <td>{{ ($item->status == 1) ? Lang::get('price_request.processed') : Lang::get('price_request.not_processed_yet') }}</td>
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