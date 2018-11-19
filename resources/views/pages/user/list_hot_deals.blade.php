@extends('layouts/user/master')

@section('title')
@endsection

@section('css')
<style>
    .discount_elem{
        font-size: 15px;
        /*font-weight: bold;*/
        color: black;
    }

    .discountRanges{
        list-style-type: none;
    }

    .discountRanges:hover{
        text-decoration: underline;
        color: red;
    }
</style>
@endsection

@section('js')
	<script src="{{ URL::asset('js/web/hot_deals/hot_deals.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
         hotDeals.init();
    </script>

    <script type="text/javascript">
        $(document).ready(function(){

            $(document).on('click', '.category', function(){

                var parent  = $(this).parents('ul').first();
                var param   = '';
                var params  = parent.attr('data-filter')

                if($(this).hasClass('is-active')){

                    $(this).removeClass('is-active');
                } else {

                    $(this).addClass('is-active');
                }

                parent.find('li').each(function(){

                    if($(this).hasClass('is-active')){

                        if(param == '') {

                            param += $(this).attr('data-id')
                        }else {

                            param += '%252C'+$(this).attr('data-id')
                        }
                    } 
                });

                if(param != '') {

                    params += '=' + param;
                }

                window.location.href = window.location.origin+ window.location.pathname +  "?" + params;
                // window.location.href = window.location.origin+ window.location.pathname + window.location.search +  "?" + params;
            });


            $(document).on('click', '.discountRanges', function(){

                var parent  = $(this).parents('ul').first();
                var param   = $(this).attr('data-value');
                var params  = parent.attr('data-filter');

                params += ':' + param;

                // console.log(window.location);
                window.location.href = window.location.origin + window.location.pathname + "?" + params;
                // window.location.href = window.location.origin + window.location.pathname + window.location.search + "?" + params;

            });
        });
    </script>
@endsection

@section('content')
<section class="breadcrumb-block">
    <div class="container">
        <div class="item"><a href="http://fado.vn">Trang chủ</a></div>
        <div class="item"><a href="javascript:;">Sản phẩm khuyến mãi</a></div>
    </div>
</section>

<div class="category-promotion-page page js-category-promotion-page">
    <div class="container page-container">
        <aside class="sidebar-aside" id="leftCol">    <div class="cate-side-box">
        <div class="box-head">
            <div class="icon"><i class="fa fa-bars" aria-hidden="true" style="color:#fff;"></i></div>
            <div class="box-title">Danh mục</div><div class="clearfix"></div>
        </div>
        <div class="box-main">
            <ul class="lv1 lv1-checkbox" data-filter="cate">
                <?php 
                    if( isset($_GET['cate']) ) $param = $_GET['cate']; 
                ?>

                @foreach($data['fillter']['cate'] as $key => $value)
                    <li class="category @if( isset($param) ) @if(strpos($param,$value->nodeId) !== false) is-active @endif @endif" data-id="{{ $value->nodeId }}">
                        <a href="javascript:;">{{ $value->category }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="side-box js-side-box">
        <div class="box-head">
            <div class="box-title">Khoảng khuyến mãi</div>
            <div class="expand-icon"></div>
        </div>
        <div class="box-main">
            <div class="scroll fd-scroll">
                <div class="scroll-inner">
                    <ul class="" data-filter="discountRanges">
                        <li class="discountRanges " data-range="10-25" data-value="10-25,25-50,50-70,70-">
                            <a href="javascript:;"><span class="val discount_elem">Giảm từ 10% trở lên</span> <span class="quanity"></span></a>
                        </li>
                        <li class="discountRanges " data-range="25-50" data-value="25-50,50-70,70-">
                            <a href="javascript:;"><span class="val discount_elem">Giảm từ 25% trở lên</span> <span class="quanity"></span></a>
                        </li>
                        <li class="discountRanges " data-range="50-70" data-value="50-70,70-">
                            <a href="javascript:;"><span class="val discount_elem">Giảm từ 50% trở lên</span> <span class="quanity"></span></a>
                        </li>
                        <li class="discountRanges " data-range="70-" data-value="70-">
                            <a href="javascript:;"><span class="val discount_elem">Giảm trên 70%</span> <span class="quanity"></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="side-box js-side-box">
        <div class="box-head">
            <div class="box-title">Khoảng giá</div>
            <div class="expand-icon"></div>
        </div>
        <div class="box-main">
            <div class="scroll fd-scroll">
                <div class="scroll-inner">
                    <ul class="property-list">
                        <li class="priceRanges " data-range="-25">
                            <a href="javascript:;"><span class="val">Dưới $25</span> <span class="quanity">(5597)</span></a>
                        </li>
                        <li class="priceRanges " data-range="25-50">
                            <a href="javascript:;"><span class="val">Từ $25 đến $50</span> <span class="quanity">(1647)</span></a>
                        </li>
                        <li class="priceRanges " data-range="50-100">
                            <a href="javascript:;"><span class="val">Từ $50 đến $100</span> <span class="quanity">(940)</span></a>
                        </li>
                        <li class="priceRanges " data-range="100-200">
                            <a href="javascript:;"><span class="val">Từ $100 đến $200</span> <span class="quanity">(940)</span></a>
                        </li>
                        <li class="priceRanges " data-range="200-">
                            <a href="javascript:;"><span class="val">Từ $200 trở lên</span> <span class="quanity">(404)</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
</aside>
        <div class="main-col">
<section class="category-block">
    <div class="block-head">
        <div class="block-title">Hiển thị từ 1 đến {{ $data['item'] }} trong tổng số {{ $data['total_item'] }} kết quả </div>
        <div class="filter-wrap">
            <div class="pull-left">
                <i class="fa fa-cog"></i>
                <span>Sắp xếp theo:</span>
                <select class="filter-sel" id="sortOrder">
                    <option value="BY_SCORE">Phù hợp nhất</option>
                    <option value="BY_PRICE_ASCENDING">Giá từ thấp đến cao</option>
                    <option value="BY_PRICE_DESCENDING">Giá từ cao đến thấp</option>
                    <option value="BY_DISCOUNT_ASCENDING">Giảm từ thấp đến cao</option>
                    <option value="BY_DISCOUNT_DESCENDING">Giảm từ cao đến thấp</option>
                </select>
            </div>
            <div class="pull-right visible-lg">
                <div class="pagination-wrap">
                    <ul>
                    @if(isset($data))
                    	@for($i=1;$i<=$data['total_page'];$i++)
                        	<li><a href="{{ URL::Route('web-get-all-deals') }}?page={{ $i }}">{{ $i }}</a></li>
                        @endfor
                    @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="block-main">
        <div class="row row-10px">
        	@if(isset($data))
        		@foreach($data['response'] as $k => $v)
		            <div class="col-xs-4 col-lg-3">
		                <div class="item-product">
                            @if(is_numeric($v['link']))
                                <a href="{{ URL::Route('web-get-product-by-category') }}?n={{ $v['link'] }}" class="pd-img" target="_blank">
                                    <div class="pd-img-inner"><img alt="" src="{{ $v['image'] }}" class="img-responsive"></div>
                                    <div class="sale-rate">Giảm<span>{{ $v['maxPercentOff'] }}%</span></div>
                                </a>
                            @else
                                <a href="{{ URL::Route('web-get-detail-product') }}?code={{ $v['link'] }}" class="pd-img" target="_blank">
                                    <div class="pd-img-inner"><img alt="" src="{{ $v['image'] }}" class="img-responsive"></div>
                                    <div class="sale-rate">Giảm<span>{{ $v['maxPercentOff'] }}%</span></div>
                                </a>
                            @endif
		                    <div class="text-wrap ttip" data-tooltip="Giá <ins>CHƯA BAO GỒM</ins> thuế tại Mỹ<br/> và phí vận chuyển về Việt Nam.<br/>Nhấp chuột để xem chi tiết." data-ttip-pos="top" data-ttip-type="red" style="cursor: pointer;">
		                    	@if(isset($v['time']))
		                        	<div class="countdown" data-time-end="{{ $v['time'] }}">
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
		                        @if(isset($v['maxDealPrice']))
			                        <div class="pd-price">
										<span class="format-currency" data-value="{{ isset($v['maxDealPrice']) ? ((float)$v['maxDealPrice'] * (float)Session::get('ExchangeRateCurrency-'.Request::ip())['JPY']) : '' }}" data-decimals="0"></span>
	                                    <span content="VND">
	                                    <sup>VND</sup>
	                                    </span>
			                        </div>
		                        @endif
		                        <h4 class="pd-title"><a href="{{ $v['link'] }}" target="_blank">{{ $v['title'] }}</a></h4>
		                                                        <div class="merchant">Bán bởi: <span>Amazon.co.jp</span></div>
		                                                </div>
		                    <div class="pd-stat">
		                        <i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star-half-empty  text-yellow"></i> / <span class="view">{{ $v['totalReviews']}} lượt đánh giá</span>
		                    </div>
		                </div>
		        	</div>
        		@endforeach
        	@endif
       	</div>
   		<div class="clearfix"></div>
    </div>
    <div class="block-foot">
        <div class="pagination-wrap">
            <ul>
	            @if(isset($data))
	            	@for($i=1;$i<=$data['total_page'];$i++)
	                	<li><a href="{{ URL::Route('web-get-all-deals') }}?page={{ $i }}">{{ $i }}</a></li>
	                @endfor
	            @endif
            </ul>
        </div>
    </div>
</section></div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection