@extends('layouts/mobile/master')

@section('title')
@endsection

@section('css')
@endsection

@section('js')
<script src="{{ URL::asset('fado/mobile/js/request-quotation.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('fado/mobile/js/list-web-block.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('fado/mobile/js/quotation.js') }}" type="text/javascript"></script>
@endsection

@section('content')
<section class="breadcrumb-block js-breadcrumb-block">
    <div class="block-head">
        <div class="block-title">
            <a href="http://fado.vn">
                <span class="icon"><i class="fa fa-long-arrow-left"></i></span>
                <span class="title">Nhập link báo giá</span>
            </a>
        </div>
    </div><!-- .block-head -->
</section>

@if(Session::has('data') )
<div class="{{ (Session::get('data')['meta']['success'] == true) ? 'alert alert-success' : 'alert alert-danger' }}">
    <strong>{{ (Session::get('data')['meta']['success'] == true) ? 'Success' : 'Error' }}</strong>

    @foreach (Session::get('data')['meta']['msg'] as $key => $value)
        <p>{{ $value }}</p>
    @endforeach
</div>
@endif

<section class="request-quotation-block-v1 js-request-quotation-block-v1">
    <div class="block-main">
        <form class="request-quotation-form" id="price-request-form" action="{{ URL::Route('web-post-new-price-request') }}" method="POST">
            <div class="step-panel">
                <div class="panel-head">
                    <div class="head-icon"><span>1</span></div>
                    <div class="panel-title">
                        Thông tin liên hệ  
                    </div>
                </div><!-- .panel-head -->

                <div class="panel-main">
                    <div class="row row-15px">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" name="fullName" id="fullName" class="form-control" placeholder="Họ và tên" required="" value="Hoài nam Đinh" aria-required="true">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="text" name="phone" id="phone" class="form-control" placeholder="Số điện thoại" required="" value="01231223421" aria-required="true">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="" email="" value="namdhinsight@gmail.com" aria-required="true">
                            </div>
                        </div>
                    </div><!-- .row -->
                </div><!-- .panel-main -->
            </div><!-- .step-panel -->

            <div class="step-panel product-panel ">
                <div class="panel-head">
                    <div class="head-icon"><span>2</span></div>
                    <div class="panel-title">
                        Gửi link sản phẩm bạn cần mua cho chúng tôi
                    </div>
                </div><!-- .panel-head -->

                <div class="panel-main">
                    <div class="note-flat"><span class="text-red">(*) Lưu ý:</span><br>
                        * Quý khách vui lòng điền đầy đủ cả “<b class="text-red">Loại mặt hàng</b>” để nhận được ước tính chính xác nhất.<br>
                        * Đây là chi phí tạm tính. Vui lòng nhấn nút "<b class="text-red">Nhận báo giá chính xác</b>" để được nhân viên báo giá chính xác của đơn hàng.
                    </div>

                    <div class="alert alert-warning">
                        Vì nội dung bảng dữ liệu bên dưới có thể rất dài, bạn vui lòng trượt ngang để xem thông tin chi tiết hơn. Xin cảm ơn !
                    </div>

                    <div class="product-tb table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="array-th">STT</th>
                                    <th class="product-info-th">Thông tin sản phẩm</th>
                                    <th class="product-type-th" data-ttip="">
                                        <a href="#" data-toggle="modal" data-target=".loai-mat-hang-modal">
                                            <span class="title">Loại mặt hàng</span>
                                            <span class="icon"></span>
                                        </a>
                                    </th>
                                    <th class="quantity-th">Số lượng</th>
                                    <th class="weight-th">Trọng lượng (lbs)</th>
                                    <th class="price-th">Đơn giá</th>
                                    <th class="us-tax-th">
                                        <a href="#" data-toggle="modal" data-target=".thue-tai-my-modal">
                                            <span class="title">Giá sau thuế tại Mỹ</span>
                                            <span class="icon"></span>
                                        </a>
                                    </th>
                                    <th class="trans-cost-th">
                                        <a href="#" data-toggle="modal" data-target=".phi-van-chuyen-ve-vn-modal">
                                            <span class="title">Phí dịch vụ</span>
                                            <span class="icon"></span>
                                        </a>
                                    </th>
                                    <th class="total-price-th">Tổng giá</th>
                                    <th class="control-th"></th>
                                </tr>
                            </thead>
                            <tbody id="tbodyListProduct">
                            
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="lbl-td" colspan="8">Tổng chi phí ước tính</td>
                                    <td class="total-price-td" colspan="2">
                                        <div class="total-price-list-td">0</div>
                                        <div class="vn-unit" data-1usdtovnd="23225">(~ 0<sup>đ</sup>)</div>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div><!-- .product-tb -->

                    <div class="exchange-rate-flat">Tỷ giá: <span class="text-red">1 $</span> = <span class="text-red">23,225<sup>đ</sup></span></div>

                    <div class="btn-wrap">
                        <div class="row row-5px">
                            <div class="col-xs-6">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target=".buy-for-me-rule-modal">Chính sách mua hộ</button>
                            </div>
                            <div class="col-xs-6">
                                <button type="submit" class="btn btn-danger quotationSubmit">Nhận báo giá chính xác</button>
                            </div>
                        </div>
                    </div>
                </div><!-- .panel-main -->
            </div><!-- .step-panel -->

            <div class="get-link-panel step-panel">
                <div class="panel-head">
                    <div class="panel-title">
                        Nhập link báo giá sản phẩm
                    </div>
                </div><!-- .panel-head -->

                <div class="panel-main">
                    <div class="point-item-wrap">
                        <div class="point-item usa-item"><span>U.S</span></div>
                        <div class="point-item eng-item"><span>England</span></div>
                        <div class="point-item ger-item"><span>Germany</span></div>
                        <div class="point-item jap-item"><span>Japan</span></div>
                    </div><!-- .earth-wrap -->

                    <div class="input-wrap">
                        <!-- <input type="text" class="link-input" placeholder="Nhập link sản phẩm bạn cần xem…" onkeyup="QuotationMobile.inputPaste($(this))"> -->
                        <input type="text" class="link-input" placeholder="Nhập link sản phẩm bạn cần xem…">
                        <button class="get-btn" disabled="disabled"><i class="fa fa-eye" aria-hidden="true"></i></button>
                    </div><!-- .input-wrap -->
                </div><!-- .panel-main -->
            </div><!-- .get-link-panel -->
        </form><!-- .request-quotation-form -->
    </div><!-- .block-main -->    
</section>
@endsection