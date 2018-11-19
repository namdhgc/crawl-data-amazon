<div class="home-cate-hidden-wrap">
    <?php $i=1; $total_item = 0;?>
    @foreach($banner as $k_banner => $v_banner)
        @if($i > 5)
        <section class="home-cate-block theme-cate-1 js-home-cate-block">
            <div class="block-head">
                <div class="icon"><img src="{{ URL::asset($v_banner['path']) }}" alt=""></div>
                <div class="block-title">{{ $v_banner['title'] }}</div>
            </div>

            <div class="block-main">
                <div class="slider-wrap swiper-container-horizontal">
                    <div class="swiper-wrapper">

                        @if(isset($v_banner['slide']))
                            @foreach($v_banner['slide'] as $k => $v)
                                <div class="swiper-slide">
                                    <img src="{{ URL::asset( $v->path ) }}" alt="">
                                    <a class="link" href="{{ $v->link }}">&nbsp;</a>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <nav class="control-nav">
                        <a class="prev" href="#"><i class="fa fa-angle-left"></i></a>
                        <a class="next" href="#"><i class="fa fa-angle-right"></i></a>
                    </nav>
                </div>

                <div class="cate-items-container">
                    <div class="cate-items-wrap owl-carousel owl-loaded owl-drag">
                        
                        @if(isset($v_banner['banner']))
                            @foreach($v_banner['banner'] as $k => $v)
                                <?php $index = $k +1 ;?>
                                    <div class="owl-item">
                                        <div class="cate-item">
                                        <a class="item-inner" href="{{ $v->mod_link }}">
                                            <img src="{{ URL::asset( $v->path ) }}" alt="">
                                        </a>
                                        </div>
                                    </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <?php $total_item++;?>
        @endif
        <?php $i++; ?>
    @endforeach
</div>
@if($total_item > 0)
<div class="home-view-all-cate">
    <a href="#">Xem thêm <i class="fa fa-angle-double-down"></i></a>
</div>
@endif