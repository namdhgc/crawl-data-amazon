@extends('layouts/mobile/master')


@section('title')
@endsection


@section('css')
@endsection


@section('js')
@endsection


@section('content')
<section class="breadcrumb-block js-breadcrumb-block">
    <!-- <a class="call-cate-btn" href="#"><img src="http://static.fado.vn/f/mobile/v1/images/icon-category-page.png" alt=""></a> -->
    <div class="block-head">
        <div class="block-title">
            <a href="{{ URL::Route('web-get-homePage') }}" title="{{Lang::get('web/breadcrumb.home-page')}}">
                <span class="icon"><i class="fa fa-long-arrow-left"></i></span>
                <h1 class="title ninja">{{Lang::get('web/breadcrumb.home-page')}}</h1>
            </a>
        </div> 
    </div>
</section>

<section class="category-block js-category-block" data-infinite="true">
        <div class="block-head">
            <!-- <a class="filter-wrap" href=""><i class="fa fa-filter"></i> Bộ lọc</a>
            <a class="sort-wrap" href=""><i class="fa fa-sort-amount-asc"></i> Sắp xếp</a> -->
            <!-- This function not working at this moment -->
        </div>

        <div class="block-main">

            @if($data['data']['meta']['success'])
                @if(!empty($data['data']['response']))
                    @foreach($data['data']['response'] as $key => $item)
                    <!-- <div class="item-product" itemtype="http://schema.org/ItemList"> -->
                    <div class="item-product">
                        <a href="{{ URL::Route('web-get-detail-product',$item['link']) }}">
                            <div class="pd-img-inner">
                                <img src="{{ isset($item['img']) ? $item['img'] : '' }}" alt="">
                                 
                            </div>

                            <div class="pd-status">
                            </div>
                        </a>
                        <a class="text-wrap" href="{{ URL::Route('web-get-detail-product',$item['link']) }}">
                            <div class="pd-stat">
                                <i class="fa fa-star text-yellow"></i>
                                <i class="fa fa-star text-yellow"></i>
                                <i class="fa fa-star text-yellow"></i>
                                <i class="fa fa-star text-yellow"></i>
                                <i class="fa fa-star text-gray"></i> / 
                                <span class="view">(8) lượt xem</span>
                            </div>
                            <div class="pd-title">{{ isset($item['title']) ? $item['title'] : '' }}</div>
                            <div class="pd-price">
                                <span class="curr">
                                    <span class="format-currency" data-value="{{ isset($item['price']) ? ((float)$item['price'] * (float)Session::get('ExchangeRateCurrency-'.Request::ip())['JPY']) : '' }}" data-decimals="0">
                                    </span>
                                    <span itemprop="priceCurrency" content="VND">
                                        <sup>đ</sup>
                                    </span>
                                </span>
                            </div>
                            <div class="merchant">                                  
                                Bán bởi: <span>Amazon.com</span>
                            </div>
                        </a>
                    </div>
                    @endforeach
                @endif
                @else
                <div class="col-xs-12 col-sm-12">
                   <section class="result-search-block js-result-search-block">
                      <div class="tb-cell">
                         <div class="block-head">
                            <div class="block-title">Rất tiếc</div>
                         </div>
                         <div class="block-main">
                            <p>
                               Chúng tôi không tìm thấy kết quả cho từ khóa "<span class="text-red"></span>", bạn vui lòng thử kiểm tra lại chính tả và thử lại với từ khoá khác xem nhé.<br>
                               Hãy cho chúng tôi biết bạn muốn tìm sản phẩm nào ?
                            </p>
                            <p>
                               Bạn cần giúp đỡ thêm? <br>
                               Vui lòng liên hệ bộ phận chăm sóc khách hàng Sumo shipping <br>
                               Hotline: <span class="phone">1900 545 403</span>
                            </p>
                            <div class="btn-wrap">
                               <a href="{{ URL::Route('web-get-homePage') }}" class="btn btn-outline-danger">Quay về trang chủ</a>
                            </div>
                         </div>
                      </div>
                   </section>
                </div>
            @endif
        </div>
        <div class="block-foot">
            <div class="pagination-wrap">
                <!-- <input type="number" class="page-input" value="1" min="1">
                <a class="next" href="#">Trang sau <i class="fa fa-angle-right"></i></a> -->
            </div>
        </div>
    </section>
@endsection