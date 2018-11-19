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
            <span class="title">Chi tiết đơn hàng</span>
            </a>
        </div>
    </div>
</section>
<section class="order-detail-block js-order-detail-block">

	@if(!empty($data['data_cus_info']) && !empty($data['data_order_detail']) && !empty($data['data_status']))

    @else

    @endif


	    <div class="block-main">
    		@if(isset($data['data_status']) && !empty($data['data_status']))
	        <div class="status-order-panel dropdown-panel js-dropdown-panel is-expand">
	            <div class="panel-head">
	                <div class="panel-title">Trạng thái đơn hàng</div>
	            </div>
	            <div class="panel-main">
	                
	            	<div class="info-item">
	                    <div class="lbl">Mã đơn hàng:</div>
	                    <div class="info"><b class="text-blue">{{ $data['data_status']->code }}</b></div>
	                </div>
	                <div class="info-item">
	                    <div class="lbl">Ngày tạo:</div>
	                    <div class="info">{{ $data['data_status']->created_at }}</div>
	                </div>
					@if($data['data_status']->expected_day != 0 && $data['data_status']->expected_day != null)
	                <div class="info-item">
	                    <div class="lbl">Ngày giao hàng dự kiến:</div>
	                    <div class="info">{{ $data['data_status']->expected_day }}</div>
	                </div>
	                @endif
	                <div class="info-item">
	                    <div class="lbl">Trạng thái:</div>
	                    <div class="info"><font color="blue">{{ $data['data_status']->status }} - {{ $data['data_status']->verify }}</font></div>
	                </div>
	                <div class="info-item">
	                    <div class="lbl">Phương thức thanh toán:</div>
	                    <div class="info"><font color="blue">{{ $data['data_status']->payment_method }}</font></div>
	                </div>
	                <div class="info-item">
	                    <div class="lbl">Hình thức thanh toán:</div>
	                    <div class="info">
	                        <font color="#419641">{{ $data['data_status']->title }}</font>                                            
	                    </div>
	                </div>
	            </div>
	        </div>
	        @endif







          	@if(!empty($data['data_cus_info']))
	        <div class="profile-panel dropdown-panel js-dropdown-panel is-expand">
	            <div class="panel-head">
	                <div class="panel-title">Thông tin người mua</div>
	            </div>
	            <div class="panel-main">
	                <div class="info-item">
	                    <div class="lbl">Họ và tên:</div>
	                    <div class="info">{{ $data['data_cus_info']->ba_first_name . ' ' . $data['data_cus_info']->ba_last_name }}</div>
	                </div>
	                <div class="info-item">
	                    <div class="lbl">Số điện thoại:</div>
	                    <div class="info">{{ $data['data_cus_info']->ba_phone_number }}</div>
	                </div>
	                <div class="info-item">
	                    <div class="lbl">Email:</div>
	                    <div class="info">{{ $data['data_cus_info']->ba_email }}</div>
	                </div>
	                <div class="info-item">
	                    <div class="lbl">Địa chỉ:</div>
	                    <div class="info"> {{ $data['data_cus_info']->ba_address .' , '. $data['data_cus_info']->ba_ward .' , '. $data['data_cus_info']->ba_district .' , '. $data['data_cus_info']->ba_city }} </div>
	                </div>
	            </div>
	        </div>
	        <div class="profile-panel dropdown-panel js-dropdown-panel is-expand">
	            <div class="panel-head">
	                <div class="panel-title">Thông tin người nhận</div>
	            </div>
	            <div class="panel-main">
	                <div class="info-item">
	                    <div class="lbl">Họ và tên:</div>
	                    <div class="info">{{ $data['data_cus_info']->ra_first_name . ' ' . $data['data_cus_info']->ra_last_name }}</div>
	                </div>
	                <div class="info-item">
	                    <div class="lbl">Số điện thoại:</div>
	                    <div class="info">{{ $data['data_cus_info']->ra_phone_number }}</div>
	                </div>
	                <div class="info-item">
	                    <div class="lbl">Email:</div>
	                    <div class="info">{{ $data['data_cus_info']->ra_email }}</div>
	                </div>
	                <div class="info-item">
	                    <div class="lbl">Địa chỉ:</div>
	                    <div class="info"> {{ $data['data_cus_info']->ra_address .' , '.$data['data_cus_info']->ra_ward .' , '. $data['data_cus_info']->ra_district .' , '. $data['data_cus_info']->ra_city }} </div>
	                </div>
	            </div>
	        </div>
	        @endif




	        <div class="list-product-panel dropdown-panel js-dropdown-panel is-expand">
	            <div class="panel-head">
	                <div class="panel-title">Danh sách sản phẩm</div>
	            </div>
	            <div class="panel-main">
	            	@if(!empty($data['data_order_detail']))
                        @foreach($data['data_order_detail'] as $k => $item)
                            <?php $price_list_detail = json_decode($item->price_list_detail);?>
			                <div class="product-box js-dropdown-box">
			                    <div class="remove-btn btnCancelProduct" id="94191-191372"><i class="fa fa-remove"></i></div>
			                    <div class="box-head">
			                        <a class="img" href="{{ URL::Route('web-get-detail-product',['code' => $item->product_code]) }}">
			                        	<span class="tb-cell">
			                        		<img src="{{ $item->img }}" alt="">
			                        	</span>
			                        </a>
			                        <div class="info-wrap">
			                            <div class="title">
			                            	<a href="{{ URL::Route('web-get-detail-product',['code' => $item->product_code]) }}">
			                            		{{ $item->name }}
			                            	</a>
			                            </div>
			                            <div class="quantity">
			                            	Số lượng: 
			                            	<span class="text-red">{{ $item->quantity }}</span>
			                            </div>
			                        </div>
			                    </div>
			                    <div class="box-main" data-code="{{ $item->product_code}}">
			                        <div class="info-item">
			                            <div class="lbl">Giá sau thuế Nhật:</div>
			                            <div class="info">
			                            	<span class="format-currency" data-decimals='0' data-value="{{ ceil($item->price * $item->exchange_rate * $item->quantity) }}"></span>
			                            	<sup>đ</sup>
			                            </div>
			                        </div>
			                        @foreach( $price_list_detail as $price_key => $price_value )
                                    <div class="info-item">
                                        <div class="lbl">{{ $price_value->title }}</div>
                                        <div class="info">
                                            <span class="format-currency" data-decimals='0' data-value="{{ $price_value->price }}"></span> <sup>đ</sup>
                                        </div>
                                    </div>
                                    @endforeach
			                    </div>
			                    <div class="box-foot">
			                        + Xem chi tiết
			                    </div>
			                </div>

			                
			                <!-- <div class="total-price-box">
			                    <div class="box-head">
			                        <div class="box-title">Tổng chi phí</div>
			                    </div>
			                    <div class="box-main">
			                        <div class="info-item">
			                            <div class="lbl">Phí giao hàng trong nước:</div>
			                            <div class="info">+ 0<sup>đ</sup></div>
			                        </div>
			                        <div class="info-item">
			                            <div class="lbl">Phụ phí đơn hàng:</div>
			                            <div class="info">+ 55,790<sup>đ</sup></div>
			                        </div>
			                        <div class="info-item">
			                            <div class="lbl">Phí thu tiền tại nhà: </div>
			                            <div class="info">
			                                + 30,000                                    <sup>đ</sup>
			                            </div>
			                        </div>
			                        <div class="info-item">
			                            <div class="lbl">Tổng chi phí đơn hàng:   </div>
			                            <div class="info">
			                                477,008                                <sup>đ</sup>
			                            </div>
			                        </div>
			                        <div class="info-item">
			                            <div class="lbl">Phải thanh toán trước:</div>
			                            <div class="info">
			                                477,008                                <sup>đ</sup>
			                            </div>
			                        </div>
			                        <div class="info-item">
			                            <div class="lbl">Phí bưu điện thu hộ:</div>
			                            <div class="info">
			                                0                                    <sup>đ</sup>
			                            </div>
			                        </div>
			                        <div class="info-item">
			                            <div class="lbl">Số tiền thanh toán khi nhận hàng:</div>
			                            <div class="info">
			                                0                                <sup>đ</sup>
			                            </div>
			                        </div>
			                    </div>
			                </div> -->
	                 	@endforeach
                 	@endif


	                <div class="note-text">
	                    <span>Ghi chú:</span> <br>
	                    <b style="margin: 0; padding: 0;">Phí giao hàng trong nước:</b> là phí giao hàng từ TP.Hồ Chí Minh đến tay khách hàng<br style="margin: 0; padding: 0;">
	                    <b style="margin: 0; padding: 0;">Phụ phí đơn hàng</b> là số tiền cộng thêm để đạt phí mua hộ(phí thông quan, phí vận chuyển của đơn) tối thiểu $10 cho đơn hàng. Quý khách có thể chọn mua thêm sản phẩm để trừ phụ phí này
	                </div>
	            </div>
	        </div>
	        <div class="payment-panel dropdown-panel js-dropdown-panel is-expand">
	            <div class="panel-head">
	                <div class="panel-title">Hướng dẫn thanh toán</div>
	            </div>
	            <div class="panel-main">
	                Chúng tôi đang tiến hành xác minh đơn hàng, nếu hợp lệ chúng tôi sẽ đên tận nhà quý khách để thu phí thanh toán cho đơn hàng.
	            </div>
	        </div>
	    </div>
    
</section>
@endsection