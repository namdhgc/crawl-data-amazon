<style type="text/css">
    .icon>img {
        margin-top: 9px;
    }
</style>
<section class="home-list-cate-block js-home-list-cate-block">
    <div class="list-cate-wrap">
        <div class="items-wrap owl-carousel owl-loaded owl-drag">
            
            <?php $index = 1;  ?>
            @foreach(Cache::get('product_categories') as $key => $value )
            <?php
                $link =  '' ;
            ?>
            @if($value['amazon_id'] =="")

                @foreach($value['child'] as $key_1 => $value_1)

                    @if($value_1['amazon_id'] =="")
                        @foreach($value_1['child'] as $key_2 => $value_2)

                            @if($value_2['amazon_id'] !="")
                                <?php $link =  URL::Route('web-get-product-by-category', [ 'n' => $value_2['amazon_id']]) ; break;?>
                            @endif
                        @endforeach
                    @else
                        <?php $link =  URL::Route('web-get-product-by-category', [ 'n' => $value_1['amazon_id']]) ; break;?>
                    @endif
                @endforeach
            @else 
                <?php $link =  URL::Route('web-get-product-by-category', [ 'n' => $value['amazon_id']]) ;?>
            @endif
            <div class="cate-item theme-cate-{{$index}}">
                <a href="{{ $link }}" class="icon"><img src="{{$value['icon']}}" alt=""></a>
                <div class="title"> 
                    <a href="{{ $link }}">@if($value['title'] == '' || $value['title'] == null){{$value['name']}}@else{{$value['title']}}@endif</a>
                </div>
            </div> 
            <?php $index++;?>
            @endforeach
        </div>
    </div>

    <div class="all-cate-wrap">
        <div class="cate-item">
            <a href="/xem-tat-ca-danh-muc" class="icon"><img src="http://static.fado.vn/f/mobile/v1/images/icon-cate/icon-cate-fado.png" alt=""></a>
            <div class="title"><a href="/xem-tat-ca-danh-muc">Tất cả danh mục</a></div>
        </div>
    </div>
</section>