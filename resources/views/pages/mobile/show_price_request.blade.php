@extends('layouts/mobile/master')


@section('title')
@endsection


@section('css')
<style>

.code-box{
	border: 1px solid #eaeaea;
    position: relative;
    margin-bottom: 15px;
}

.box-head {
	padding: 10px;
}

.title {
	color: #006cff;
}

	    
</style>
@endsection


@section('js')
@endsection


@section('content')
<section class="breadcrumb-block js-breadcrumb-block">
    <div class="block-head">
        <div class="block-title">
            <a href="#">
                <span class="icon"><i class="fa fa-long-arrow-left"></i></span>
                <span class="title">Yêu cầu báo giá</span>
            </a>
        </div>
    </div>
</section>

@include('layouts.mobile.dropdown_block')

<section class="list-quotation-block">
    <div class="block-main">
        <div class="list-product-panel dropdown-panel is-expand">
            <div class="panel-head">
                <div class="panel-title">{{ Lang::get('price_request.price_request_title') }}</div>
            </div>

            <div class="panel-main">
                @if(isset($data))
                    @foreach($data['data']['response'] as $key => $item)
                    <div class="code-box">
	                    <div class="box-head">
	                        <div class="message">{{ Lang::get('price_request.message') }}:
	                        	<span class="title">{{ $item->message }}</span>
	                        	<br>
	                        </div>
	                        <div class="status">{{ Lang::get('price_request.status') }}:
	                        	<span style="color:red;">
	                        		{{ ($item->status == 1) ? Lang::get('price_request.processed') : Lang::get('price_request.not_processed_yet') }}
	                        	</span> 
	                        </div>
	                    </div>
	                </div>
                    @endforeach
                @endif

                <!-- <div class="text-center">Hiện tại chưa có sản phẩm nào trong danh sách yêu cầu báo giá</div> -->                
            </div>
        </div>
    </div>
</section>

@endsection