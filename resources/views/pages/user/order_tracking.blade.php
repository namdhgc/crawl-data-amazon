@extends('layouts/user/master')

@section('title')

@endsection

@section('css')
@endsection

@section('js')
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
            Order Tracking
        </div>
</section>

<div class="history-order-page page">
    <div class="container page-container">

        @include('layouts.user.aside_user')

        <div class="main-col">
            <section class="history-order-block block-1">
                <div class="block-head">
                    <div class="block-title">Lịch sử đơn hàng</div>
                </div>

                <div class="block-main">
                    <form action="{{ URL::Route('web-get-order-tracking') }}" class="search-order-form">
                        <div class="group-item">
                            <div class="lbl">Mã đơn hàng:</div>
                            <input type="text" class="form-control-1" name="key_search" placeholder="" value="">
                        </div>
                        <span class="clearfix hidden-lg"></span>
                        <button type="submit" class="submit-btn btn-danger btn">
                            <i class="fa fa-search"></i> Tìm kiếm
                        </button>
                    </form>

                    <table class="order-tb table-2 table-2-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Mã Khuyến mãi</th>
                                <th>Mã đại lý</th>
                                <th>Giá mua</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($data))
                            @foreach($data['response'] as $key => $item)
                            <tr>
                                <td>{{ $item->code }}</td>
                                <td>{{ $item->pm_code }}</td>
                                <td>{{ $item->hc_code }}</td>
                                <td>{{ $item->total_price_in_vn }}</td>
                                <td>{{ Cache::get('transaction_status')[$item->status] }}</td>
                                <td>{{ gmdate("d-m-Y", $item->created_at) }}</td>
                                <td>
                                    <a href="{{ URL::Route('web-get-order-tracking-detail', ['code' => $item->code,'phone_number' => $item->ba_phone_number ]) }}" class="btn btn-default btn-sm">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <button class="btnCancelOrder btn btn-default btn-sm" id="94191-0">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                    <div class="pagination-wrap"> <ul>  </ul></div>
                </div>
            </section>
        </div>
    </div>
</div>

@endsection