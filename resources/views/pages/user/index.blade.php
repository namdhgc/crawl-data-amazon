 @extends('layouts/user/master')

@section('title')
@endsection

@section('css')
    <style type="text/css" media="screen">
        .w25 {
            width: 480px !important;
        }
        .gg-translate {
            width: 184px !important;
            right: 246px !important;
        }
        .gg-translate select {
            width: 184px !important;
        }
        .hide{
            display: none;
        }
    </style>
@endsection

@section('js')
    <script src="{{ URL::asset('fado/js/cate-scroll.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/lib/carousel.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/web/index/index.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function(){

        var owl     =   $(".owl-stage");
        owl.owlCarousel();
        $(document).on('click','.next-deals',function(){

                owl.trigger('next.owl.carousel');
        });

        $(document).on('click','.prev-deals',function(){

               owl.trigger('prev.owl.carousel');
        });

        $(document).on('click','.home-view-all-cate',function(){

                $('section.home-cate-block ').removeClass('hide');
        });

        

    });
        Index.init();
    </script>
@endsection

@section('content')

<section class="home-banner-block js-home-banner-block">
    <div class="container">
        <div class="slider-wrap">
            <div class="swiper-wrapper">

                @if(isset($main_slide))
                    @foreach($main_slide['response'] as $key => $item)
                    <div class="swiper-slide" style='background-image: url("{{ URL::asset( $item->path ) }}")' data-url="{{ URL::asset( $item->path ) }}">
                        <a class="link" href="{{ $item->link }}" target="_blank">&nbsp;</a>
                    </div>
                    @endforeach
                @endif

            </div>
            <div class="control">
                <a class="prev" href="#"><i class="fa fa-angle-left"></i></a>
                <a class="next" href="#"><i class="fa fa-angle-right"></i></a>
            </div>
            <div class="outer-pager-nav"><nav class="pager-nav"></nav></div>
        </div>
            @if(isset($nav_right['data']))
                @foreach($nav_right['data']['response'] as $k_nav   =>  $v_nav)
                    <a class="banner-item visible-lg" href="{{ $v_nav->link }}" style='background-image: url("{{ URL::asset( $v_nav->path ) }}")' target="_self"></a>
                @endforeach
            @endif
    </div>
</section><section class="home-feature-block">
    <div class="container">
        <div class="row">
            @if(!empty(Cache::get('services')))
                @foreach(Cache::get('services') as $k => $val)
                <div class="col-xs-5x">
                    <div class="info-item">
                        <div class="icon">
                            <i class="{{ $val['icon_class'] }}"></i>
                        </div>
                        <div class="title">{{ $val['title'] }}</div>
                        <div class="text">
                            <?php echo $val['description'];?>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif    
        </div>
    </div>
</section>
<section class="home-promotion-block js-home-promotion-block" id="san-pham-khuyen-mai">
    <div class="container">
        <div class="block-head">
            <div class="block-title effect-blink-infinite">
                <a href="{{ URL::Route('web-get-all-deals') }}">Deals sốc mỗi ngày</a>
            </div>
        </div>
        <div class="block-main">
            <div class="tab-1 tab-wrap is-active">
                <nav class="control-nav">
                    <a class="prev prev-deals" href="javascript:;"><i class="fa fa-angle-left"></i></a>
                    <a class="next next-deals" href="javascript:;"><i class="fa fa-angle-right"></i></a>
                </nav>
                <div class="product-item-wrap owl-carousel owl-loaded owl-drag">
                    <div class="owl-stage">
                        @if(isset($hot_deals))
                            @foreach($hot_deals as $k => $v_deals)
                                <div class="product-item" style="width: 312.5px;">
                                    <div class="img-wrap">
                                        @if(is_numeric($v_deals['link']))
                                            <a href="{{ URL::Route('web-get-product-by-category') }}?n={{ $v_deals['link'] }}" class="pd-img" target="_blank">
                                                <div class="pd-img-inner"><img alt="" src="{{ $v_deals['image'] }}" class="img-responsive"></div>
                                            </a>
                                        @else
                                            <a href="{{ URL::Route('web-get-detail-product') }}?code={{ $v_deals['link'] }}" class="pd-img" target="_blank">
                                                <div class="pd-img-inner"><img alt="" src="{{ $v_deals['image'] }}" class="img-responsive"></div>
                                            </a>
                                        @endif
                                    </div>
                                        <div class="text-wrap" style="cursor: pointer;">
                                                @if(isset($v_deals['time']))
                                                    <div class="countdown" data-time-end="{{ $v_deals['time'] }}">
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
                                            <h4 class="pd-title"><a href="{{ $v_deals['link'] }}" target="_blank">{{ $v_deals['title'] }}</a></h4>
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
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="block-foot">
            <a class="view-more" href="{{ URL::Route('web-get-all-deals') }}">Xem tất cả sản phẩm khuyến mãi <i class="fa fa-angle-double-right"></i></a>
        </div>
    </div>
</section>

<section class="home-img-block">
    <div class="container">
        <a href="#"><img src="{{ URL::asset('fado/images/bner/inventory.jpg') }}" alt=""></a>
    </div>
</section>

@if(isset($banner))
    <?php $i=0; ?>
    @foreach($banner as $k_banner => $v_banner)
    @if($i < 5)
    <section class="home-cate-block hc-item-3  theme-cate-1 js-home-cate-block"  id="banner-{{ $v_banner['id'] }}">
    @else
    <section class="home-cate-block hc-item-3  theme-cate-1 js-home-cate-block hide" id="banner-{{ $v_banner['id'] }}">
    @endif
        <div class="container">
            <div class="block-head">
                <div class="icon"><img src="{{ URL::asset($v_banner['path']) }}" alt="" /></div>

                <a href="#" class="color-grey">
                    <div class="block-title">
                        <h3 class="text-1">{{ $v_banner['title'] }}</h3>
                        <div class="text-2">{{ $v_banner['description'] }}</div>
                    </div>
                </a>
            </div>

            <div class="block-main">
                <div class="slider-wrap">
                    <div class="swiper-wrapper">
                        @if(isset($v_banner['slide']))
                            @foreach($v_banner['slide'] as $k => $v)
                                <div class="swiper-slide" style='background-image: url("{{ URL::asset( $v->path ) }}")'>
                                    <a class="link" href="{{ $v->link }}"></a>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="control">
                        <a class="prev" href="#"><i class="fa fa-angle-left"></i></a>
                        <a class="next" href="#"><i class="fa fa-angle-right"></i></a>
                    </div>

                    <div class="outer-pager-nav">
                        <nav class="pager-nav"></nav>
                    </div>
                </div>

                @if(isset($v_banner['banner']))
                    @foreach($v_banner['banner'] as $k => $v)
                        <?php $index = $k +1 ;?>
                            <div class="p-item h12 w15 item-{{ $index }}">
                                <a class="item-inner link-effect" href="{{ $v->mod_link }}">
                                    <img src="{{ URL::asset( $v->path ) }}" alt="" />
                                </a>
                            </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    <?php $i++; ?>
    @endforeach
@endif

<div class="home-view-all-cate js-home-view-all-cate">
    <a href="#">Xem thêm danh mục  <i class="fa fa-angle-double-down"></i></a>
</div><!-- .home-view-more -->

<section class="home-multi-cate-block js-home-multi-cate-block">
</section>

<!-- <section class="home-opinion-block js-home-opinion-block" id="vi-sao-chon-fado">
    <div class="container">
        <div class="block-head">
            <ul class="title-tabs">
                <li  data-tab=".tab-1">Khách hàng nói về chúng tôi</li>
                <li class="is-active" data-tab=".tab-2">Vì sao chọn Sumo shipping</li>
                <li data-tab=".tab-3">Báo chí nói về chúng tôi</li>
            </ul>
        </div>

        <div class="block-main">
            <div class="tab-1 tab-wrap">
                <nav class="control-nav">
                    <a class="prev" href="#"><i class="fa fa-angle-left"></i></a>
                    <a class="next" href="#"><i class="fa fa-angle-right"></i></a>
                </nav>

                <div class="opinion-item-wrap owl-carousel">
                    <div class="opinion-item">
                        <div class="img">
                            <img src="{{ URL::asset('fado/images/upload/o-dung.jpg') }}" alt="" />
                        </div>
                        <div class="text-wrap">
                            <div class="text-1">
                                Giao hàng rất nhanh,rất uy tín,nhân viên nhiệt tình thân thiện,an tâm về dịch vụ.Cảm ơn Fado nhé dịch vụ rất tuyệt !!!
                            </div>

                            <div class="text-2"><span class="name">Anh Dũng</span> | <span class="job">(Bình Thạnh – TP.HCM )</span></div>
                        </div>
                    </div>
                    <div class="opinion-item">
                        <div class="img">
                            <img src="{{ URL::asset('fado/images/upload/o-hang.jpg') }}" alt="" />
                        </div>
                        <div class="text-wrap">
                            <div class="text-1">
                                13. Thanh toán dễ dàng, lại an toàn nữa chứ, mua tại Fado mấy lần mà ko xảy ra vấn đề gì cả
                            </div>

                            <div class="text-2"><span class="name">Chị Hằng</span> | <span class="job">(Quận Thanh Khê – TP. Đà Nẵng)</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-2 tab-wrap">
                <div class="row row-15px">
                    @if(!empty(Cache::get('why_choose_us')))
                    <?php $count = 0;?>
                        @foreach(Cache::get('why_choose_us') as $k => $val)
                        @if($count == 0 || $count == 3)
                            <div class="clearfix">
                        @endif
                        <div class="col-xs-4">
                            <div class="choose-item">
                                <div class="item-head">
                                    <div class="icon"><img src="{{ URL::asset( $val['path'] ) }}" alt="" /></div>
                                    <div class="item-title">{{ $val['title'] }}</div>
                                </div>

                                <div class="scroll-wrap">
                                    <div class="content">
                                        <p>
                                        <?php echo $val['description'] ?>
                                        </p>
                                    </div>
                                </div>
                                <a href="#" class="expand-btn">+ Chi tiết</a>
                            </div>
                        </div>
                        @if($count == 2 || $count == 5)
                            </div>
                        @endif
                        <?php $count++;?>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section> -->
@endsection