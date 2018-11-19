
<section class="home-promotion-block js-home-promotion-block" id="san-pham-khuyen-mai">    
    <div class="block-head">
        <div class="block-title effect-blink-infinite">
            <a href="{{ URL::Route('web-get-all-deals') }}">Deals sốc mỗi ngày</a>
        </div>
        <a class="view-more" href="{{ URL::Route('web-get-all-deals') }}">Xem tất cả <i class="fa fa-angle-right"></i></a>
    </div> 

    <div class="block-main">
        <div class="product-items-wrap owl-carousel owl-loaded owl-drag">
            @if(isset($hot_deals))
                @foreach($hot_deals as $k => $v_deals)
                <div class="owl-item">
                    <div class="product-item">
                        <div class="img-wrap">
                            @if(is_numeric($v_deals['link']))
                                <a href="{{ URL::Route('web-get-product-by-category') }}?n={{ $v_deals['link'] }}" class="pd-img" target="_self">
                                    <div class="pd-img-inner"><img alt="" src="{{ $v_deals['image'] }}" class="img-responsive"></div>
                                </a>
                            @else
                                <a href="{{ URL::Route('web-get-detail-product') }}?code={{ $v_deals['link'] }}" class="pd-img" target="_self">
                                    <div class="pd-img-inner"><img alt="" src="{{ $v_deals['image'] }}" class="img-responsive"></div>
                                </a>
                            @endif
                        </div>
                        <div class="text-wrap" style="cursor: pointer;">
                                @if(isset($v_deals['time']))
                                    <div class="pd-countdown" data-time-end="{{ $v_deals['time'] }}">
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
                                <i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star-half-empty  text-yellow"></i> / <span class="view">{{ $v_deals['totalReviews']}} lượt đánh giá</span>
                            </div>
                            <h4 class="pd-title"><a href="{{ $v_deals['link'] }}" target="_self">{{ $v_deals['title'] }}</a></h4>
                            @if(isset($v_deals['maxDealPrice']))
                                <div class="pd-price">
                                    <span class="format-currency" data-value="{{ isset($v_deals['maxDealPrice']) ? ((float)$v_deals['maxDealPrice'] * (float)Session::get('ExchangeRateCurrency-'.Request::ip())['JPY']) : '' }}" data-decimals="0"></span>
                                    <span content="VND">
                                    <sup>VND</sup>
                                    </span>
                                </div>
                            @endif
                            <div class="pd-save">Tiết kiệm {{ $v_deals['maxPercentOff'] }}%</div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="block-foot"></div>
    <!-- <script type="text/javascript" src="http://static.fado.vn/f/mobile/v1/js/library/home-promotion-block.js"></script> -->

</section>