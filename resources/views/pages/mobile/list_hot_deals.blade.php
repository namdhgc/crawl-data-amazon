@extends('layouts/mobile/master')


@section('title')
@endsection


@section('css')
<style>
    .curr {
        display: inline-block !important;
    }
</style>
@endsection


@section('js')
<script src="{{ URL::asset('js/web/hot_deals/hot_deals.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    hotDeals.init();
</script>
@endsection


@section('content')
<section class="breadcrumb-block js-breadcrumb-block">
    <a class="call-cate-btn" href="#"><img src="http://static.fado.vn/f/mobile/v1/images/icon-category-page.png" alt=""></a>

    <div class="block-head">
        <div class="block-title">
            <a href="#">
                <span class="icon"><i class="fa fa-long-arrow-left"></i></span>
                <h1 class="title">Sản phẩm giảm giá</h1>
            </a>
        </div>
        <div class="desc"></div>
    </div>
</section>

<section class="category-block js-category-block">
    <div class="block-top">
        <!-- <div class="web-sel-control">
            <div class="current">
                Sản phẩm tại:
                <div class="web"><span>Amazon</span><img src="http://static.fado.vn/f/desktop/v1/images/icon-us.png" alt=""></div>
            </div>

            <ul class="list">
                <li class="is-selected"><a href="#"><span>Amazon</span><img src="http://static.fado.vn/f/desktop/v1/images/icon-us.png" alt=""></a></li>
                <li class=""><a href="/xem-tat-ca-san-pham-giam-gia-jp/"><span>Amazon</span><img src="http://static.fado.vn/f/desktop/v1/images/icon-jap.png" alt=""></a></li>
                <li class=""><a href="/xem-tat-ca-san-pham-giam-gia-de/"><span>Amazon</span><img src="http://static.fado.vn/f/desktop/v1/images/icon-de.gif" alt=""></a></li>
            </ul>
        </div> -->
    </div>
    <div class="block-head">
        <!-- <a class="filter-wrap" href=""><i class="fa fa-filter"></i> Bộ lọc</a> -->
        <!--<a class="sort-wrap" href=""><i class="fa fa-sort-amount-asc"></i> Sắp xếp</a>-->
    </div>

    <div class="block-main">
    	@if(isset($data))
        	@foreach($data['response'] as $k => $v)
    	
            <div class="item-product" data-tooltip="Giá <ins>CHƯA BAO GỒM</ins> thuế tại Mỹ<br/> và phí vận chuyển về Việt Nam.<br/>Nhấp chuột để xem chi tiết." data-ttip-pos="top" data-ttip-type="red">

            <?php

            	$url = "";
            	if(is_numeric($v['link'])){
            		$url = URL::Route('web-get-product-by-category').'?n='.$v['link'];
            	}else{
            		$url = URL::Route('web-get-detail-product').'?code='.$v['link'];
            	}
        		
             ?>

                <a href="{{ $url }}" class="pd-img">
                    <div class="pd-img-inner">
                        <img src="{{ $v['image'] }}" alt="">
                    </div>
                    <div class="sale-rate">Giảm<span>{{ $v['maxPercentOff'] }} %</span></div>
                </a>

                <a class="text-wrap" href="{{ $url }}">
                @if(isset($v['time']))
                    <div class="pd-countdown countdown" data-time-end="{{ $v['time'] }}">
                        <div class="item time hours">
                            <span class="val notranslate"></span>
                            <span class="lbl">Giờ</span>
                        </div>
                        <div class="item break">:</div>
                        <div class="item time minutes">
                            <span class="val notranslate"></span>
                            <span class="lbl">Phút</span>
                        </div>
                        <div class="item break">:</div>
                        <div class="item time seconds">
                            <span class="val notranslate"></span>
                            <span class="lbl">Giây</span>
                        </div>
                    </div>
                @endif    
                    <div class="pd-stat">
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star text-yellow"></i>
                        <i class="fa fa-star-half-empty  text-yellow"></i>  / 
                        <span class="view">{{ $v['totalReviews']}} lượt xem</span>
                    </div>
                    <div class="pd-title">{{ $v['title'] }}</div>
                <?php

    	        	$curr_price = "";
    	        	$deals_price = "";

    	        	if(isset($v['maxDealPrice']) && is_numeric($v['maxDealPrice'])){
    	        		$curr_price = ((float)$v['maxDealPrice'] * (float)Session::get('ExchangeRateCurrency-'.Request::ip())['JPY']);
    	        	}
    	        	if(isset($v['maxCurrentPrice']) && is_numeric($v['maxCurrentPrice'])){
    	        		$deals_price = ((float)$v['maxCurrentPrice'] * (float)Session::get('ExchangeRateCurrency-'.Request::ip())['JPY']);
    	        	}
        		
             	?>    
                @if(isset($v['maxDealPrice']))
                    <div class="pd-price">
    					<span class="curr format-currency" data-value="{{ $curr_price }}" data-decimals="0"></span>
                        <sup> đ </sup>
                        @if(isset($v['maxCurrentPrice']))
                        <p>
                        <span class="old format-currency" data-value="{{ $deals_price }}" data-decimals="0"></span>
                        <sup> đ </sup>
                        </p>
                        @endif
                    </div>
    		    @endif
                    <div class="merchant">Bán bởi: <span>Amazon.com</span></div>
                </a>
            </div>

           @endforeach
        @endif

    </div>

    <div class="block-foot">
        <div class="pagination-wrap">
        	@if(isset($data))
                @for($i=1;$i<=$data['total_page'];$i++)
                    <a href="{{ URL::Route('web-get-all-deals') }}?page={{ $i }}">{{ $i }}</a>
                @endfor
            @endif
       	</div>
    </div>
</section>
@endsection