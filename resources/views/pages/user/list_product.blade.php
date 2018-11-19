@extends('layouts/user/master')
@section('title')
@endsection
@section('css')
<style type="text/css">
   .main-col-full {
      width: 100% !important;
   }
</style>
@endsection
@section('js')
<script type="text/javascript">
   var lang = 'us'
</script>
@endsection
@section('breadcrumb')
<section class="breadcrumb-block">
   <div class="container" itemtype="http://schema.org/BreadcrumbList">
      <div class="item">
         <a href="{{ URL::Route('web-get-homePage') }}" title="{{Lang::get('web/breadcrumb.home-page')}}">{{Lang::get('web/breadcrumb.home-page')}}</a>
      </div>
      @if(Session::has('breadCrumb_'.Request::ip()))
      @foreach(Session::get('breadCrumb_'.Request::ip()) as $key => $value)

         <div class="item" itemprop="itemListElement"  itemtype="http://schema.org/ListItem">
            <a href="@if($value['amazon_id'] != ''){{ URL::Route('web-get-product-by-category', [ 'n' => $value['amazon_id']]) }}@else javascript::void(0)@endif" itemprop="item">
            <span itemprop="name">{{$value['name']}}</span>
            </a>
            <meta itemprop="position" content="$key" />
         </div>
      @endforeach
      @endif
   </div>
</section>
@endsection
@section('content')
<div class="category-page page">
   <div class="container page-container">
      <aside class="sidebar-aside @if(empty($data['data']['response']))hide @endif" >
      @if($data['filter']['meta']['success'])
         @if(!empty($data['filter']['response']))
            @foreach($data['filter']['response'] as $k_filter => $v_filter)
                  <div class="cate-side-box">
                  <div class="box-head">
                     <div class="icon"><i class="fa fa-bars" aria-hidden="true" style="color:#fff;"></i></div>
                     <div class="box-title">{{ $k_filter }}</div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="box-main">
                     <ul class="lv1">
                        @if(is_array($v_filter))
                           @foreach($v_filter as $k_sub => $v_sub)
                              @if(!empty($v_sub['link']) && $v_sub['name'] != '')
                                 <li class="is-active">
                                    <a href="{{ URL::Route('web-get-search-product-by-key').'?'. $v_sub['link'] }}">{{ $v_sub['name'] }}</a>
                                 </li>
                              @elseif($v_sub['name'] != '')
                                 <li class="is-active">
                                    <a href="javascript:;">{{ $v_sub['name'] }}</a>
                                 </li>
                              @endif
                           @endforeach
                        @endif
                     </ul>
                  </div>
                  </div>
            @endforeach
         @else
            <div class="cate-side-box">
            </div>
         @endif
      @endif
      </aside>
      <div class="main-col @if(empty($data['data']['response']))main-col-full @endif">
         <section class="category-block">
            <div class="block-head">
               @if($data['data']['meta']['success'])
                  @if(!empty($data['data']['response']))
                     <div class="block-title">
                        Hiển thị từ 1 đến 48 trong tổng số 50,085 kết quả
                     </div>
                  @endif
                  <div class="filter-wrap">
                     <div class="pull-left">
                        <i class="fa fa-cog"></i>
                        <span>Sắp xếp theo:</span>
                        <select id="sort" class="filter-sel">
                           <option value="/us/s/cat/?rh=n:6358539011&sort=featured-rank" selected="selected">
                              Nổi bật nhất
                           </option>
                           <option value="/us/s/cat/?rh=n:6358539011&sort=price-asc-rank" >
                              Giá từ thấp đến cao
                           </option>
                           <option value="/us/s/cat/?rh=n:6358539011&sort=price-desc-rank" >
                              Giá từ cao đến thấp
                           </option>
                           <option value="/us/s/cat/?rh=n:6358539011&sort=date-desc-rank" >
                              Vừa được đăng bán
                           </option>
                        </select>
                     </div>
                     @if(!empty($data['data']['response']))
                        <div class="pull-right visible-lg">
                           <div class="pagination-wrap">
                              <ul>
                                 <li><a class="page-begin" href=""></a></li>
                                 <li class="is-active" ><a class="page-one" href="">1</a></li>
                                 <li><a class="page-two" href="">2</a></li>
                                 <li class="dots">...</li>
                                 <li><a href="javascript:;">400</a></li>
                                 <li class="next"><a class="page-next" href=""><i class="fa fa-angle-right"></i></a></li>
                              </ul>
                           </div>
                        </div>
                     @endif
                  </div>
               @endif
            </div>
            <div class="block-main">
               <div class="row row-10px" itemtype="http://schema.org/ItemList">
                  <meta itemprop="itemListOrder" content="Descending" />
                  @if($data['data']['meta']['success'])
                     @if(!empty($data['data']['response']))
                        @foreach($data['data']['response'] as $key => $item)
                        <div class="col-xs-4 col-lg-3">
                           <div class="item-product" itemtype="http://schema.org/ItemList">
                              <a class="pd-img" itemprop="url" href="{{ URL::Route('web-get-detail-product',$item['link']) }}">
                                 <div class="pd-img-inner">
                                    <img class="img-responsive" itemprop='image' src="{{ isset($item['img']) ? $item['img'] : '' }}" alt="img" />
                                    @if($item['discount_percent'] != 0)
                                    <div class="sale-rate">Giảm<span data-value="{{$item['discount_percent']}}" data-old="{{$item['old_price']}}">{{ $item['discount_percent'] }}%</span></div>
                                    @endif
                                 </div>
                              </a>
                              <div class="text-wrap ttip" data-tooltip="Giá <ins>CHƯA BAO GỒM</ins> thuế tại Nhật<br/> và phí vận chuyển về Việt Nam.<br/>Nhấp chuột để xem chi tiết." data-ttip-pos="top" data-ttip-type="red">
                                 <div class="pd-price" >
                                    <div class="pull-left" content="1077359">

                                 @if($item['price'] != 0)
                                    <span class="format-currency" data-value="{{ isset($item['price']) ? ((float)$item['price'] * (float)Session::get('ExchangeRateCurrency-'.Request::ip())['JPY']) : '' }}" data-decimals="0"></span>
                                    <span content="VND">
                                    <sup>VND</sup>
                                    </span>
                                    @if(isset($item['price_up']) && $item['price_up']!=0)
                                    - <span class="format-currency" data-value="{{ isset($item['price_up']) ? ((float)$item['price_up'] * (float)Session::get('ExchangeRateCurrency-'.Request::ip())['JPY']) : '' }}" data-decimals="0"></span>
                                    <span content="VND">
                                    <sup>VND</sup>
                                    </span>
                                    @endif
                                 @else
                                    <span>{{ Lang::get('web/product.out-of-stock') }}</span>
                                 @endif
                                    </div>
                                 </div>
                                 <h4 class="pd-title" itemprop="name">

                                    <a href="{{ URL::Route('web-get-detail-product',$item['link']) }}">{{ isset($item['title']) ? $item['title'] : '' }}</a>
                                 </h4>
                                 <div class="merchant">
                                    Bán bởi: <span>Amazon.com</span>
                                 </div>
                              </div>
                              <div class="pd-stat">
                                 <i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star-half-empty  text-yellow"></i>
                                 <span>{{ isset($item['rate']) ? $item['rate'] : '' }}</span>/5
                                 &nbsp;(<span>2080</span> đánh giá)
                              </div>
                           </div>
                        </div>
                        @endforeach
                     @else
                        <div class="col-xs-12 col-lg-12">
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
                                       <a href="/" class="btn btn-outline-danger">Quay về trang chủ</a>
                                    </div>
                                 </div>
                              </div>
                           </section>
                        </div>
                     @endif
                  @else
                     <div class="col-xs-12 col-lg-12">
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
                                       <a href="/" class="btn btn-outline-danger">Quay về trang chủ</a>
                                    </div>
                                 </div>
                              </div>
                           </section>
                        </div>                  
                  @endif
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="block-foot">
            @if($data['data']['meta']['success'])
               @if(!empty($data['data']['response']))
                  <div class="pagination-wrap">
                     <ul>
                           <li><a class="page-begin" href=""></a></li>
                           <li class="is-active" ><a class="page-one" href="">1</a></li>
                           <li><a class="page-two" href="">2</a></li>
                           <li class="dots">...</li>
                           <li><a href="javascript:;">400</a></li>
                           <li class="next"><a class="page-next" href=""><i class="fa fa-angle-right"></i></a></li>
                     </ul>
                  </div>
               @endif
            @endif
            </div>
         </section>
      </div>
      <div class="clearfix"></div>
   </div>
</div>
@endsection