@extends('layouts/user/master')

@section('title')

@endsection

@section('css')
<style type="text/css">
    .price{
        color: red;
    }
</style>
@endsection

@section('js')
    <script type="text/javascript">
        
        $(document).ready(function(){

            $('.view-more').click(function(e){

                e.preventDefault();
                var item_code = $(this).attr('data-code');

                if($(this).hasClass('active')){

                    $(this).removeClass('active');
                    $(this).html('+ Xem chi tiết giá');
                    $('.detail-price[data-code="'+item_code+'"]').first().hide(500);
                }else {
                  console.log($('.detail-price[data-code="'+item_code+'"]').first());
                    $(this).addClass('active');
                    $(this).html('+ Ẩn chi tiết giá');
                    $('.detail-price[data-code="'+item_code+'"]').first().show(500);
                }
            });
        });
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
            Order Tracking Detail
        </div>
</section>

<div class="order-detail-page page">
    <div class="container page-container">

        @include('layouts.user.aside_user')

        <div class="main-col">
            <section class="order-detail-block js-order-detail-block block-1">
                <div class="block-head">
                    <div class="block-title">Chi tiết đơn hàng</div>
                </div>
                    <div class="block-main">
                        @if(!empty($data['data_cus_info']) && !empty($data['data_order_detail']) && !empty($data['data_status']))
                            <div class="info-wrap status-order">
                                <div class="row row-10px">
                                    <div class="col-xs-6">
                                        <div class="wrap-head">
                                            <div class="wrap-title">Trạng thái đơn hàng</div>
                                        </div>
                                        @if(isset($data['data_status']) && !empty($data['data_status']))
                                        <div class="wrap-main">
                                            <div class="info-item">
                                                <div class="lbl">Mã đơn hàng:</div>
                                                <div class="val"><font color="green">{{ $data['data_status']->code }}</font></div>
                                            </div>

                                            <div class="info-item">
                                                <div class="lbl">Ngày tạo:</div>
                                                <div class="val">
                                                    <span class="date-time" dateTime="{{ $data['data_status']->created_at }}" ></span> 
                                                </div>
                                            </div>
                                            @if($data['data_status']->expected_day != 0 && $data['data_status']->expected_day != null)
                                            <div class="info-item">
                                                <div class="lbl">Ngày giao hàng dự kiến : </div>
                                                <div class="val">
                                                    <span class="date-time" dateTime="{{ $data['data_status']->expected_day }} "></span>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="info-item">
                                                <div class="lbl">Trạng thái:</div>
                                                <div class="val">
                                                    <font color="red">{{ $data['data_status']->status }} - {{ $data['data_status']->verify }}</font>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <div class="lbl">Phương thức thanh toán:</div>
                                                <div class="val"><font color="blue"><?php echo $data['data_status']->payment_method ?></font></div>
                                            </div>

                                            <div class="info-item">
                                                <div class="lbl">Hình thức thanh toán:</div>
                                                <div class="val">
                                                    <font color="#419641">{{ $data['data_status']->title }}</font>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="wrap-head">
                                            <div class="wrap-title">Thông tin giao dịch</div>
                                        </div>
                                        @if(isset($data['data_order_info']) && !empty($data['data_order_info']))
                                        @foreach($data['data_order_info'] as $k => $item)
                                        <div class="wrap-main">
                                            <div class="info-item">
                                                <div class="lbl">Tổng giá trị đơn hàng:</div>
                                                <div class="val price">
                                                    <span class="format-currency font-red" data-decimals='0' data-value="{{ $item->total_amount }}"></span>
                                                    <sup class="font-red">đ</sup>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <div class="lbl">Tổng số tiền cần thanh toán trước :</div>
                                                <div class="val price">
                                                    <span class="format-currency" data-decimals='0' data-value="{{ $item->paid_before }}"></span>
                                                    <sup class="font-red">đ</sup>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <div class="lbl">Chi phí đơn hàng :</div>
                                                <div class="val price">
                                                <span class="format-currency font-red" data-decimals='0' data-value="{{ $item->total_fee }}"></span>
                                                <sup class="font-red">đ</sup>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <div class="lbl">Phụ phí đơn hàng :</div>
                                                <div class="val price">
                                                <span class="format-currency font-red" data-decimals='0' data-value="{{ $item->cost_incurred }}"></span>
                                                <sup class="font-red">đ</sup>
                                                </div>
                                            </div>

                                            <div class="info-item">
                                                <div class="lbl">Tổng số tiền đã thanh toán :</div>
                                                <div class="val price">
                                                <span class="format-currency font-red" data-decimals='0' data-value="{{ $item->amount_paid }}"></span>
                                                <sup class="font-red">đ</sup>
                                                </div>
                                            </div>
                                            <div class="info-item">
                                                <div class="lbl">Tổng số tiền chưa thanh toán :</div>
                                                <div class="val price">
                                                <span class="format-currency font-red" data-decimals='0' data-value="{{ $item->amount_unpaid }}"></span>
                                                <sup class="font-red">đ</sup>
                                                </div>
                                            </div>
                                            @if($item->amount_paid == 0 && empty($item->amount_paid))
                                            <div class="info-item">
                                                <div class="lbl">Tổng số tiền cần thanh toán trước :</div>
                                                <div class="val price">
                                                <span class="format-currency font-red" data-decimals='0' data-value="{{ $item->paid_before }}"></span>
                                                <sup class="font-red">đ</sup>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>      
                            </div>
                            @if(!empty($data['data_cus_info']))
                            <div class="row row-10px">
                                <div class="col-xs-6">
                                    <div class="info-wrap">
                                        <div class="wrap-head">
                                            <div class="wrap-title">Thông tin người mua</div>
                                        </div>
                                        <div class="wrap-main">
                                            <div class="info-item">
                                                <div class="lbl">Họ và tên:</div>
                                                <div class="val">{{ $data['data_cus_info']->ba_first_name . ' ' . $data['data_cus_info']->ba_last_name }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="lbl">Số điện thoại:</div>
                                                <div class="val">{{ $data['data_cus_info']->ba_phone_number }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="lbl">Email:</div>
                                                <div class="val">{{ $data['data_cus_info']->ba_email }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="lbl">Địa chỉ:</div>
                                                <div class="val">{{ $data['data_cus_info']->ba_address .' , '. $data['data_cus_info']->ba_ward .' , '. $data['data_cus_info']->ba_district .' , '. $data['data_cus_info']->ba_city }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="info-wrap">
                                        <div class="wrap-head">
                                            <div class="wrap-title">Thông tin người nhận</div>
                                        </div>

                                        <div class="wrap-main">
                                            <div class="info-item">
                                                <div class="lbl">Họ và tên:</div>
                                                <div class="val">{{ $data['data_cus_info']->ra_first_name . ' ' . $data['data_cus_info']->ra_last_name }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="lbl">Số điện thoại:</div>
                                                <div class="val">{{ $data['data_cus_info']->ra_phone_number }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="lbl">Email:</div>
                                                <div class="val">{{ $data['data_cus_info']->ra_email }}</div>
                                            </div>
                                            <div class="info-item">
                                                <div class="lbl">Địa chỉ:</div>
                                                <div class="val">{{ $data['data_cus_info']->ra_address .' , '.$data['data_cus_info']->ra_ward .' , '. $data['data_cus_info']->ra_district .' , '. $data['data_cus_info']->ra_city }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="product-wrap">
                                <div class="wrap-head">
                                    <div class="wrap-title">Danh sách sản phẩm</div>
                                </div>

                                <div class="wrap-main">
                                    <table class="product-tb table-2">
                                        <thead>
                                            <tr>
                                                <th style="max-width: 80px;width: 80px;">Hình ảnh</th>
                                                <th>Sản phẩm</th>
                                                <th style="max-width: 60px;width: 60px;">Số lượng</th>
                                                <th style="max-width: 230px;width: 230px;">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(!empty($data['data_order_detail']))
                                            @foreach($data['data_order_detail'] as $k => $item)
                                                <?php $price_list_detail = json_decode($item->price_list_detail);?>
                                                <tr>
                                                    <td class="pd-img">
                                                        <img src="{{ $item->img }}" alt="">
                                                    </td>

                                                    <td class="pd-info" style="">
                                                        <a target="_blank" class="pd-title" href="{{ URL::Route('web-get-detail-product',['code' => $item->product_code]) }}">{{ $item->name }}</a>
                                                    </td>

                                                    <td class="pd-price">
                                                        <div class="price">
                                                            <span>{{ $item->quantity }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="pd-price">
                                                        <div class="price">
                                                            <span class="format-currency" data-decimals='0' data-value="{{ $item->price_in_vn }} "></span>
                                                            <sup>đ</sup>
                                                        </div>
                                                        <div class="detail-price" data-code="{{ $item->product_code}}">
                                                            <div class="item">
                                                                <span class="lbl">Giá sản phẩm sau thuế tại Nhật</span>
                                                                <span class="val">
                                                                    <span class="format-currency" data-decimals='0' data-value="{{ ceil($item->price * $item->exchange_rate * $item->quantity) }}"></span> <sup>đ</sup>
                                                                </span>
                                                            </div>
                                                            @foreach( $price_list_detail as $price_key => $price_value )
                                                            <div class="item">
                                                                <span class="lbl">{{ $price_value->title }}</span>
                                                                <span class="val">
                                                                    <span class="format-currency" data-decimals='0' data-value="{{ $price_value->price }}"></span> <sup>đ</sup>
                                                                </span>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        <a href="#" class="view-more" data-code="{{ $item->product_code}}">+ Xem chi tiết</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                    <div>
                                        <div class="title" style="font-size: 14px; font-weight: 700; margin: 0; padding: 0;">Ghi chú:</div>
                                        <div class="line" style="height: 3px; line-height: 3px; margin: 0; margin-bottom: 8px; padding: 0;">
                                            <img src="http://static.fado.vn/email/v1/images/line.png" alt="" style="display: inline; margin: 0; padding: 0; vertical-align: middle;">
                                            <br style="margin: 0; padding: 0;">
                                        </div>
                                        <b style="margin: 0; padding: 0;">Phí giao hàng trong nước:</b> là phí giao hàng từ TP.Hồ Chí Minh đến tay khách hàng<br style="margin: 0; padding: 0;">
                                        <b style="margin: 0; padding: 0;">Phụ phí đơn hàng</b> là số tiền cộng thêm để đạt phí mua hộ(phí thông quan, phí vận chuyển của đơn) tối thiểu $10 cho đơn hàng. Quý khách có thể chọn mua thêm sản phẩm để trừ phụ phí này
                                    </div>
                                </div>
                            </div>

                            <div class="payment-wrap">
                                <div class="wrap-head">
                                    <div class="wrap-title">Hướng dẫn thanh toán</div>
                                </div>
                                <div class="wrap-main">
                                    Chúng tôi đang tiến hành xác minh đơn hàng, nếu hợp lệ chúng tôi sẽ đên tận nhà quý khách để thu phí thanh toán cho đơn hàng.
                                </div>
                            </div>
                        @else
                            <p><strong>Thông tin đơn hàng không tồn tại trên hệ thống, xin vui lòng kiểm tra lại</strong></p>
                        @endif
                    </div>
            </section>
        </div>
    </div>
</div>

@endsection