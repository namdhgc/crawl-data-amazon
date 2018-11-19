<style type="text/css">
  .swiper-wrapper, .swiper-slide {
    height: auto !important;
  }
</style>
<section class="home-slider-block js-home-slider-block">
   <div class="slider-wrap swiper-container-horizontal">
      <div class="swiper-wrapper">
       @if(isset($main_slide))
            @foreach($main_slide['response'] as $key => $item)
            <div class="swiper-slide">
                <img src="{{ URL::asset( $item->path ) }}">
                <a class="link" href="{{ $item->link }}">&nbsp;</a>
            </div>
            @endforeach
        @endif
      </div>
      <div class="outer-pager-nav">
         <nav class="slider-pager-nav"></nav>
      </div>
   </div>
</section>