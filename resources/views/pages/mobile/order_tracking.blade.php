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
                <h1 class="title">Lịch sử đơn hàng</h1>
            </a>
        </div>
    </div>
</section>

@include('layouts.mobile.dropdown_block')

<section class="history-order-block">
    <div class="block-main">
        <div class="dropdown-panel js-dropdown-panel is-expand">
            <div class="panel-head">
                <div class="panel-title">Tìm kiếm đơn hàng</div>
            </div>
            <div class="panel-main">
                <form action="{{ URL::Route('web-get-order-tracking') }}" class="search-order-form">
                    <div class="control-group">
                        <div class="lbl">Mã đơn hàng:</div>
                        <input type="text" name="key_search" class="form-control" placeholder="Mã đơn hàng:" value="">
                    </div>
                    <div class="btn-wrap">
                        <button class="btn btn-danger btn-block" type="submit"><i class="fa fa-search"></i> Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="list-order-panel dropdown-panel is-expand">
            <div class="panel-head">
                <div class="panel-title">Danh sách đơn hàng</div>
            </div>
            <div class="panel-main">
                <div class="order-box-wrap">
                @if(isset($data))
                    @foreach($data['response'] as $key => $item)

                    <div class="order-box js-dropdown-box">
                        <div class="remove-btn btnCancelOrder" id="94191-0">
                            <i class="fa fa-remove"></i>
                        </div>
                        <div class="box-head" style="">
                            <a href="{{ URL::Route('web-get-order-tracking-detail', ['code' => $item->code,'phone_number' => $item->ba_phone_number ]) }}">
                                <div class="lbl">Mã đơn hàng</div>
                                <div class="info">{{ $item->code }}</div>
                            </a>
                        </div>
                        <div class="box-main">
                            <div class="info-item">
                                <div class="lbl">Khuyến mãi</div>
                                <div class="info"><font color="red">{{ $item->pm_code }}</font></div>
                            </div>
                            <div class="info-item">
                                <div class="lbl">Mã đại lý</div>
                                <div class="info">{{ $item->hc_code }}</div>
                            </div>
                            <div class="info-item">
                                <div class="lbl">Giá mua</div>
                                <div class="info">{{ $item->total_price_in_vn }}</div>
                            </div>
                            <div class="info-item">
                                <div class="lbl">Trạng thái</div>
                                <div class="info">
                                    <font color="blue">{{ Cache::get('transaction_status')[$item->status] }}</font>
                                    <br>
                                </div>
                            </div>
                            <div class="info-item">
                                <div class="lbl">Ngày tạo</div>
                                <div class="info">{{ gmdate("d-m-Y", $item->created_at) }}</div>
                            </div>
                        </div>

                        <div class="box-foot">
                            + Xem chi tiết
                        </div>
                    </div>
                    @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection