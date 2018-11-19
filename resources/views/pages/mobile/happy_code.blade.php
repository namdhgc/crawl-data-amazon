@extends('layouts/mobile/master')


@section('title')
@endsection


@section('css')
@endsection


@section('js')
<script src="{{ URL::asset('js/web/happy_code/order_happy_code.js') }}" type="text/javascript"></script>

<script>
    
    OrderHappyCode.init();

    $(document).ready(function() {

        $(document).on('change', '#happy_code_type', function () {

            current_price_happy_code = $(this).find(':selected').attr('data-price');

            $('#happy_code_price').text(current_price_happy_code);
            $('#happy_code_price').attr('data-price', current_price_happy_code);

        });
    });

</script>
@endsection


@section('content')
<section class="breadcrumb-block js-breadcrumb-block">
    <div class="block-head">
        <div class="block-title">
            <a href="#">
                <span class="icon"><i class="fa fa-long-arrow-left"></i></span>
                <span class="title">Đăng ký Happy Code</span>
            </a>
        </div>
    </div>
</section>

@include('layouts.mobile.dropdown_block')

<section class="reg-happy-code-block">
    <div class="block-main">
        <div class="dropdown-panel js-dropdown-panel is-expand">
            <div class="panel-head">
                <div class="panel-title">Đăng ký mua mã</div>
            </div>
            <div class="panel-main">
                
                <form action="{{ URL::Route('web-post-register-happy-code') }}" method="POST" class="reg-happy-code-form" id="form-order-happy-code" novalidate="novalidate">
                    <div class="control-group">
                        <select class="form-control" id="paymentMethod" name="paymentMethod" required="" aria-required="true">
                            <!-- <option value="">Hình thức thanh toán</option> -->
                            <option value="1">Chuyển khoản</option>
                            <option value="2">Thanh toán tại công ty Sumo shipping</option>
                        </select>
                    </div>

                    <div class="control-group">
                        <select class="form-control" id="happy_code_type" name="happy_code_type" required="" aria-required="true">
                            <option value="">-- Hãy chọn loại Happy code --</option>
                            @foreach( Config::get('spr.system.happy_code_type') as $key => $value )
                                <option class="happy_code_type" value="{{ $key }}" data-price="{{ $value['price'] }}">
                                    {{ Lang::get('happy_code_type.' .  $value['title']) }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" value="150" name="codePrice" id="codePrice">
                        <input type="hidden" value="10" name="discountValue" id="discountValue">
                    </div>

                    <div class="total-price control-group">
                        Thành tiền: <b class="text-red price-happy-code">
                        <span id="happy_code_price" data-value="0" data-decimals="0">0</span>
                        <sup>đ</sup></b>
                    </div>

                    <div class="btn-wrap">
                        <div class="row row-5px">
                            <div class="col-xs-6">
                                <a href="{{ URL::Route('web-get-homePage') }}" class="btn btn-default btn-block">{{ Lang::get('button.form.back_to_homepage.text') }}</a>
                            </div>

                            <div class="col-xs-6">
                                <input type="submit" class="btn btn-danger btn-block" value="{{ Lang::get('button.form.register.text') }}">
                            </div>
                        </div>
                    </div>

                    <div class="note-text">
                        <b>Lưu ý:</b> một đơn hàng chỉ có thể sử dụng được một mã
                    </div>
                </form>
            </div>
        </div>
        
        <div class="list-code-panel dropdown-panel is-expand">
            <div class="panel-head">
                <div class="panel-title">Danh sách mã</div>
            </div>

            <div class="panel-main">

            	@if(isset($data))
                    @foreach($data['data']['response'] as $key => $item)
                    <div class="code-box">
	                    <div class="box-head">
	                        <div class="title">Loại mã: 
	                        	{{ $item->happy_code_type }}
	                        	<br>
	                        </div>
	                        <div class="status">Trạng thái: 
	                        	<span style="color:red;">
	                        		{{ ($item->status == 0) ? Lang::get('happy-code.pending') : Lang::get('happy-code.processed') }}
	                        	</span> 
	                        </div>
	                        <div class="time">Ngày đăng ký: 
	                        	{{ gmdate("d-m-Y", $item->created_at) }}
	                        </div>
	                    </div>
	                </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@endsection