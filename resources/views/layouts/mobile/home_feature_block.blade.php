<style type="text/css">
    .js-home-feature-block .swiper-slide, .js-home-feature-block .swiper-wrapper {
        height: auto !important;
    }
    .pager-item i {
        line-height: 32px !important;
    }
</style>
<section class="home-feature-block js-home-feature-block">
    <div class="slider-wrap swiper-container-horizontal">
        <div class="swiper-wrapper" >
            @if(!empty(Cache::get('services')))
                @foreach(Cache::get('services') as $k => $val)
                <div class="swiper-slide">
                    <div class="feature-item">
                        <div class="title">{{ $val['title'] }}</div>
                        <div class="desc"><?php echo $val['description'];?></div>
                    </div>
                </div>
                @endforeach
            @endif    
        </div><!-- .slider-wrapper -->
    </div><!-- .slider-wrap -->

    <nav class="pager-nav">
        @if(!empty(Cache::get('services')))
        <?php $index = 1;?>
            @foreach(Cache::get('services') as $k => $val)
                <div class="pager-item @if($index == 1) is-active @endif">
                    <div class="icon"><i class="{{ $val['icon_class'] }}"></i></div>
                </div>
                <?php $index++;?>
            @endforeach
        @endif        
    </nav><!-- .pager-nav -->
</section><!-- .home-feature-block -->