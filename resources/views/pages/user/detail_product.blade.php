@extends('layouts/user/master')

@section('title')
@endsection

@section('css')
    <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet"> <!-- 3 KB -->
    <style type="text/css">
        .fotorama1497546017572 .fotorama__nav--thumbs .fotorama__nav__frame{
        padding:10px;
        height:80px}
        .fotorama1497546017572 .fotorama__thumb-border{
        height:78px;
        border-width:1px;
        margin-top:10px}

        ul.list-color li, ul.p-size li {
            border: 1px solid #e0e0e0;
            cursor: pointer;
            display: inline-block;
            position: relative;
            margin-top: 4px;
            margin-bottom: 4px;
            list-style: none;
        }

        ul.p-size li {
            padding: 5px;
        }

        ul.list-color li.selected, ul.p-size li.selected {
            border-color: #e47911;
        }

        ul.list-color li:hover, ul.p-size li:hover {
            border-color: #e47911 !important;
        }

        .out-of-stock {
            opacity: .5;
            color: #bbb;
            border: 1px dashed #CCC !important;
        }

        li.item-out-of-stock {
            border: 1px dashed #CCC;
        }

        .old-price {
            text-decoration:line-through;
        }
        .box-head .help-block {
            color:red;
        }
        #bt-add-quotation {
            width: 200px !important;
        }
    </style>
@endsection

@section('js')
    <script src="{{ URL::asset('assets/web/scripts/detail-product.js') }}" type="text/javascript"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/pages/scripts/ui-blockui.min.js') }}" type="text/javascript"></script>

    <script id="config" type="text/javascript">

        DetailProduct.config({!! json_encode($data['type_product']) !!});

    </script>

    <script type="text/javascript">

        $('.p-size li').click(function(){

            $('.p-size li').removeClass('selected');
            $(this).addClass('selected');
            DetailProduct.changeProductType($(this).parent());
        });

        $('.p-size').change(function() {

            var value = $(this).val();
            $(this).find('.selected').removeClass('selected');
            $(this).find('option[value="'+value+'"]').first().addClass('selected');
            DetailProduct.changeProductType($(this));
        });

        $('.quantity-input').change(function() {

            var value = parseInt($('.quantity-input').val());
            DetailProduct.showLoadding();
            DetailProduct.updatePriceList(value);
        });

        function updatePrice (code) {

            window.history.pushState("", "", '/dp?code='+code);
            DetailProduct.setSelectedCustomerChoice(code);
        }


        var code = Helper.getURLParameter('code');
        DetailProduct.setSelectedCustomerChoice(code);
        $('#data-price .box-foot').click(function(e){

            e.preventDefault();
            if($(this).hasClass('active')){

                $(this).removeClass('active');
                $(this).html('+ Xem chi tiết giá');
                $('#data-price .box-main').first().hide(500);
            }else {

                $(this).addClass('active');
                $(this).html('+ Ẩn chi tiết giá');
                $('#data-price .box-main').first().show(500);
            }
        });


        function callback_buy_now(res) {

            if(res.meta.success) {
                if(res.meta.auth ==1){
                    window.location.href = "/confirm-orders-information";
                }else{
                    window.location.href = "/my-shopping-cart";
                }
            }
        }

        function callback (res) {

            if(res.meta.success) {

                var count_data  = res.response.length;
                var total = 0;
                 $('table.cart-tb tbody').html('');
                for (var i = count_data - 1; i >= 0; i--) {
                    total += parseFloat(res.response[i]['price-total']);
                    $html = "<tr>"
                            + "<td class='product-info'>"
                                + "<div class='img'>"
                                    + "<a href='"+res.response[i]['img']+"' target='_blank'><img src='"+res.response[i]['img']+"'></a>"
                                + "</div>"
                            + "<div class='text-wrap'>"
                                + "<a class='product_title' href='/dp?code="+res.response[i]['code']+"' style='text-align:left;'' target='_blank'>"+res.response[i]['name']+"</a>"
                            + " </div>"
                            + "</td>"
                            + "<td class='text-center'>"+res.response[i]['quantity']+"</td>"
                            + "<td class='text-center'><span class='format-currency' data-decimals='0' data-value='"+res.response[i]['price']+"'></span> <sup>đ</sup></td>"
                            + "<td class='text-center'><span class='format-currency' data-decimals='0' data-value='"+res.response[i]['price-total']+"'></span> <sup>đ</sup></td>";
                    $('table.cart-tb tbody').append($html);
                }
                $('.total-all-product-cart').attr('data-value', total);
                $('span.format-currency').each(function() {
                    var price = parseFloat($(this).attr('data-value'));
                    var decimal = parseInt($(this).attr('data-decimals'));

                    price = Helper.formatNumber(price, decimal);
                    $(this).text(price);
                  });
                $('table.cart-tb').show();
                $('.empty-data-cart').hide();
                $('.shopping-cart').modal('show');
            }
        }

        $(document).ready(function () {
            $(document).on('click','.js-call-cart-modal', function(e) {
                e.preventDefault();
                $('.shopping-cart').modal('show');
            });

            $(document).on('click','.bt-buy-now', function(e){

                e.preventDefault();

                var code        = Helper.getURLParameter('code');
                var quantity    = $('.quantity-input').val();
                var name        = $('.pd-title').first().html();

                var data = {
                    code        : code,
                    quantity    : parseInt(quantity),
                    name        : name
                };

                Spr.ajaxDefault('/add-product-to-shopping-cart', data, callback_buy_now,".block-main");
            });

            $(document).on('click','#bt-add-to-cart', function(e){
                e.preventDefault();

                var code        = Helper.getURLParameter('code');
                var quantity    = $('.quantity-input').val();
                var name        = $('.pd-title').first().html();

                var data = {
                    code        : code,
                    quantity    : parseInt(quantity),
                    name        : name
                };

                Spr.ajaxDefault('/add-product-to-shopping-cart', data, callback,".block-main");
            });
        });
    </script>

    @if(Session::get('message')!='' && Session::get('message')!=null)
    <script type="text/javascript">

        $(document).ready(function () {
            var data = '{{ json_encode(Session::get('message')) }}';
            DetailProduct.custom(data);
        });
    </script>
    @endif

@endsection
@section('breadcrumb')
    <section class="breadcrumb-block">
       <div class="container" itemtype="http://schema.org/BreadcrumbList">
            <div class="item">
                <a href="{{ URL::route('web-get-homePage') }}" title="{{Lang::get('web/breadcrumb.home-page')}}">{{Lang::get('web/breadcrumb.home-page')}}</a>
            </div>
          @foreach($data['bread_crumb'] as $key => $value)

            <div class="item" itemprop="itemListElement"  itemtype="http://schema.org/ListItem">
                <a href="@if($value['node'] != ''){{ URL::route('web-get-product-by-category', [ 'n' => $value['node']]) }}@else javascript::void(0)@endif" itemprop="item" data-title="{{$value['name']}}">
                <span itemprop="name">{{$value['name']}}</span>
                </a>
                <meta itemprop="position" content="$key" />
            </div>
          @endforeach
       </div>
    </section>
@endsection
@section('content')
<div class="product-detail-page page">
    <div class="container  page-container">
        <section class="product-detail-block js-product-detail-block" itemscope itemtype="http://schema.org/Product">
            <div class="block-head">
            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

            @if(!empty($data['product_base']))
            <h1 class="pd-title" itemprop="name">{{ $data['product_base']['name'] }}</h1>
            <div class="pd-meta-data">
                <div class="item" itemprop="brand" itemscope="itemscope" itemtype="http://schema.org/Organization">
                    <span class="lbl">{{ $data['product_base']['made_by'] }}</span>
                    <!-- <a href="#"> -->
                        <span itemprop="name">N/A</span>
                    <!-- </a> -->
                </div>
                <div class="item" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                    <i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star-half-empty  text-yellow"></i><i class="fa fa-star text-gray"></i>
                    <span itemprop="bestRating">{{ $data['product_base']['review'] }}</span> |
                    <span itemprop="ratingCount">{{ $data['product_base']['reply'] }}</span>
                </div>
                <div class="item">
                    Người bán: <a href="#">{{ $data['product_base']['seller'] }}</a>
                </div>
            </div>
            @endif
            </div>
            <div class="block-main">
                <div class="col-1-wrap">
                    <div class="pd-images js-pd-images fotorama" id="img-product-detail"
                    data-width="420" data-height="480"  data-arrows="true"
                     data-click="true"
                     data-swipe="true"
                     data-allowfullscreen="true"
                     data-nav="thumbs">
                        @if(!empty($data['type_product']))
                            @foreach($data['type_product']['data_img'] as $k => $v_img)
                                @foreach($v_img as $key => $value)
                                    <a data-full="{{ $value['large'] }}" >
                                        <img style="max-height:480px" src="{{ $value['large'] }}"  />
                                    </a>
                                @endforeach
                            <?php break;?>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-2-wrap">
                    <div class="price-box js-price-box" style="display:none;" id="data-price" data-url="{{ URL::Route('web-post-price-of-product') }}">
                        <div class="box-head">
                            <p class="main-price">

                            </p>
                            <div class="price-save" style="font-size:17px;color:#90898E;">

                            </div>
                        </div>
                        <div class="box-main" style="display: none;">

                            <table class="price-tb @if(empty($data['price']['response']) || $data['price']['response']['current_price'] == 0) hide @endif">
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="box-foot" >+ Xem chi tiết giá</div>
                    </div>
                    <div class="price-box js-price-box box-loadding" >
                        <div class="box-head ">
                            <center>
                                <img src="{{ URL::asset('assets/web/img/loading.gif')}}">
                                <div class="help-block-no-price help-block" style="display:none">
                                <b>Hiện tại Fado không thể báo giá trực tiếp cho sản phẩm này. Quý khách vui lòng nhấn F5 để thử lại hoặc nhấn nút yêu cầu báo giá bên dưới để nhận báo giá qua email.</b>
                                </div>
                                <div class="help-block-select-type help-block" style="display:none">
                                 <b>Vui long lựa chọn thuộc tính sản phẩm để có giá chi tiết.</b>
                                </div>
                            </center>
                        </div>
                        <div class="box-foot" ><center> Đang cập nhật giá vui lòng đợi </center></div>
                    </div>
                    <div class="pd-desc">
                        @if($data['product_des'] != "")
                        <div class="scroll" itemprop="description">
                            @if(!empty($data['product_des']))
                                <span>
                                    <?php echo $data['product_des']; ?>
                                </span>
                            @endif
                        </div>
                        <a class="view-more" href="#gioi-thieu-san-pham">Xem chi tiết <i class="fa fa-angle-down"></i></a>
                        @endif
                    </div>

                    <input type="hidden" name="merchantID" value="ATVPDKIKX0DER" />
                    <div class="pd-choose">

                        @foreach($data['type_product']['variationValues'] as $key => $value)

                            <div class="item">
                                <div class="lbl">{{ str_replace('_name','',$key) }}:</div>
                                <div class="val">

                                    @if(COUNT($value > 5) && $key != "color_name")
                                    <select class="inline-property-select p-size" data-name="{{ $key }}">
                                        <option value="-1">Select {{ str_replace('_name','',$key) }}</option>
                                            @foreach($value as $v_key => $v_value)
                                                <option class="item-{{ $key }} item-type-product" value="{{ $v_key }}" data-value="{{ $v_key }}"> {{ $v_value }}</option>
                                            @endforeach
                                    </select>
                                    @else

                                    <ul class="p-size" data-name="{{ $key }}">
                                        @foreach($value as $v_key => $v_value)
                                            <li data-value="{{ $v_key }}" alt="{{ $v_value }}"  class="item-{{ $key }} item-type-product" >
                                            @if($key != "color_name")
                                                 {{ $v_value }}
                                            @else
                                                @foreach($data['type_product']['data_img'] as $img_key => $img_value)
                                                    @if(strpos($img_key, $v_value) !== false)
                                                        <img src="{{ $img_value[0]['thumb'] }}" alt="{{ $v_value }}">
                                                        <?php break;?>
                                                    @endif
                                                @endforeach
                                            @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                    @endif

                                </div>
                            </div>
                        @endforeach
                        @if(isset($data['weight']))
                            <div class="item">
                                <div class="lbl">Trọng lượng: </div>
                                <div class="val">
                                    <div class="lbl">{{ $data['weight']['current_weight'] }}  (Kg) </div>
                                </div>
                            </div>
                        @endif
                        <div class="item">
                            <div class="lbl">Chọn số lượng:</div>
                            <div class="val">
                                <input type="number" name="quanity" class="quantity-input text-center" value="1" min="1" max="999" />
                            </div>
                        </div>
                    </div>
                    <div class="pd-btn-wrap">
                        <button id="bt-add-quotation" class="btn btn-danger" style="display: none"><i class="fa fa-link"></i>Yêu cầu báo giá</button>
                        <button id="bt-buy-now" class="btn btn-danger bt-buy-now" ><i class="fa fa-dollar"></i>Mua ngay</button>
                        <button id="bt-add-to-cart" class="btn btn-default" ><i class="fa fa-shopping-basket"></i>Giỏ hàng</button>
                        <button id="bt-add-favourite" class="btn btn-default"><i class="fa fa-heart-o"></i> Yêu Thích</button>
                    </div>
                   {{--  <div class="pd-promotion">
                        <div class="item"><img class="img-responsive" src="http://static.fado.vn/f/desktop/v1/bner/p1.png" /></div>
                        <div class="item">
                            <a href="http://fado.vn/event-us/chuong-trinh-khuyen-mai-noel-va-tet-duong-lich-39/?utm_source=onsite&utm_medium=banner&utm_campaign=Noel_2016_Detail"><img class="img-responsive" src="http://static.fado.vn/f/desktop/v1/images/440x60nam-moi.jpg" /></a>
                        </div>
                    </div> --}}
                </div>

                <div class="col-3-wrap">
                    <div class="feature-box js-feature-box">
                        @if(!empty(Cache::get('commitment'))) 
                            @foreach(Cache::get('commitment') as $k => $val)   
                            <div class="info-item">
                                <div class="icon"><img src="{{ URL::asset( $val['path'] ) }}" alt="" /></div>
                                <div class="text-wrap">
                                    <div class="title">{{ $val['title'] }}</div>
                                    <div class="content">
                                        <?php echo $val['description'];?>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif 
                    </div>
                </div>
            </div>
        </section>
        <div id="sticky-wrapper" class="sticky-wrapper" style="height: 50px;">
            <section class="product-tab-title-block js-product-tab-title-block" style="width: 1200px;">
                <ul class="tabs-list">
                    <li class="is-disabled priceHistoryTab"><a data-scroll="scroll" href="#bien-dong-gia">Biến động giá</a></li>
                    <li class=""><a data-scroll="scroll" href="#gioi-thieu-san-pham">Giới thiệu</a></li>
                    <li class=""><a data-scroll="scroll" href="#dac-tinh-thong-so-san-pham">Thông số</a></li>
                    <li class=""><a data-scroll="scroll" href="#thong-tin-chi-tiet">Thông tin</a></li>
                    <li class=""><a data-scroll="scroll" href="#san-pham-kem-theo">Sản phẩm kèm theo</a></li>
                    <li class=""><a data-scroll="scroll" href="#danh-gia-va-binh-luan">Đánh giá và bình luận</a></li>
                    <li class="recall"><a href="#" data-toggle="modal" data-target="#tu-van-mien-phi">Tư vấn miễn phí</a></li>
                    <li class="add-cart">
                        <button class="add-cart-btn bt-tab-add-cart-now bt-buy-now">Mua ngay</button>
                    </li>
                </ul>
            </section>
        </div>
        <div class="product-tab-title-break"></div>
        <section class="product-tab-block js-product-tab-block" id="bien-dong-gia" style="display:none;">
            <div class="block-head">
                <div class="block-title">Biến Động Giá</div>
            </div>
            <div class="block-main editor-content">
                <div id="Chart" style="height: 300px"></div>
            </div>
        </section>
        @if(!empty($data['product_des']))
            <section class="product-tab-block js-product-tab-block" id="gioi-thieu-san-pham">
                <div class="block-head">
                    <div class="block-title">Giới thiệu</div>
                </div>
                <div class="block-main editor-content">
                      {{ $data['product_des'] }}
                </div>
            </section>
        @endif
        @if(!empty($data['feature_base']))
            <section class="product-tab-block js-product-tab-block" id="dac-tinh-thong-so-san-pham">
                <div class="block-head">
                    <div class="block-title">Thông số</div>
                </div>
                <div class="block-main editor-content">
                    <div class="info-list-wrap">
                        @foreach($data['feature_base'] as $k_fb => $val_fb)
                            <div class="item ">
                                <span class="lbl">{{ $val_fb['lbl'] }}</span>
                                <span class="val">{{ $val_fb['val'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        @if(!empty($data['product_infor']))
            <section class="product-tab-block js-product-tab-block" id="thong-tin-chi-tiet">
                    <div class="block-head">
                        <div class="block-title">Thông tin</div>
                    </div>
                    <div class="block-main editor-content">
                        <div id="aplus_feature_div" class="feature">
                                <?php echo $data['product_infor'];?>
                        </div>
                    </div>
            </section>
        @endif
        <section class="product-tab-block fb-comment-tab-block js-product-tab-block" id="binh-luan-facebook">
            <div class="block-head">
                <div class="block-title">Bình luận Facebook</div>
            </div>
            <div class="block-main">
                <div id="fb-root"></div>

                <div class="fb-comments" data-href="{{ Request::fullUrl() }}" data-width="100%" data-numposts="4"></div>
            </div>
        </section>
        <section id="danh-gia-va-binh-luan" class="product-tab-block js-product-tab-block">
            <div class="block-head">
                <div class="block-title">Đánh giá và bình luận</div>
            </div>
            <div class="block-main">
                <div class="product-comment-wrap">
                    <div id="commentList" class="wrap-main" data-page="1">
                    @if(!empty($data['customer_review']))
                        @foreach($data['customer_review'] as $k => $v_cr)
                        @if($v_cr['title'] != "" &&  $v_cr['customer'] != "" && $v_cr['comment']!= "")
                            <div class="comment-item is-checked">
                                <div class="title">
                                    <span>{{ $v_cr['title'] }}</span>
                                </div>
                                <div class="by">
                                    <span>{{ $v_cr['customer'] }}</span>
                                </div>
                                <div class="content is-hide">
                                    <div class="scroll">
                                        <div aria-expanded="false" class="a-expander-content a-expander-partial-collapse-content">
                                            {{ $v_cr['comment'] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="expand-btn">+ Hiện nội dung</div>
                            </div>
                        @endif
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="bootbox modal modal-2 fade bootbox-alert in" id="modal_alert" tabindex="-1" role="dialog" style="display: none; padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="bootbox-close-button" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i></button>
                <h4 class="modal-title">Thông báo</h4>
            </div>
            <div class="modal-body">
                <div class="bootbox-body" id="modal_message"></div>
            </div>
            <div class="modal-footer">
                <button data-bb-handler="ok" type="button" class="btn btn-danger" data-dismiss="modal">Đồng ý</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade sizechart-modal modal-1" id="huong-dan-chon-size" tabindex="-1" role="dialog" style="display:none;">
    <div class="modal-dialog" role="document" style="width:860px;">
        <div class="modal-box">
            <div class="box-head">
                <div class="box-title">Kích thước sản phẩm</div>
                <button class="exit-btn" data-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
            <div class="box-main"></div>
        </div>
    </div>
</div>
<div id="fb-root"></div>
<div class="modal fade trans-time-modal modal-1" id="thoi-gian-giao-hang" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-box">
            <div class="box-main">
                <button class="exit-btn" data-dismiss="modal"><i class="fa fa-close"></i></button>
                <img src="http://static.fado.vn/f/desktop/v1/images/order-steps-time.png" alt="" />
            </div>
            <!-- .box-main -->
        </div>
        <!-- .modal-box -->
    </div>
    <!-- .modal-dialog -->
</div>
<!-- .trans-time-modal -->
<div class="modal fade recall-modal modal-1" id="tu-van-mien-phi" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-box">
            <div class="box-head">
                <div class="box-title">Chăm sóc khách hàng</div>
                <button class="exit-btn" data-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
            <!-- .box-head -->

            <div class="box-main">
                <form class="recall-form">
                    <p class="text">
                        NẾU QUÝ KHÁCH GẶP VƯỚNG MẮC, VUI LÒNG LIÊN HỆ
                    </p>

                    <div class="time">
                        <div class="phone">1900 545 403</div>
                        <div class="email">/ Email: <span>Support@fado.vn</span></div>
                        <br>
                        <div class="date">Thứ 2 đến Thứ 6: Từ 08h - 22h, kể cả thứ 7 - CN</div>
                    </div>
                    <!-- .time -->

                    <p class="text">
                        Hoặc để lại số điện thoại, chuyên viên tư vấn <span class="text-red">fado.vn</span> sẽ gọi lại ngay cho bạn.
                    </p>

                    <input type="text" class="form-control-1 phone-txt" placeholder="Vui lòng nhập số điện thoại của quý khách" />

                    <button class="btn btn-danger" id="bt-modal-recall" type="button"><i class="fa"></i> Gửi yêu cầu</button>
                </form>
                <!-- .recall-form -->
            </div>
            <!-- .box-main -->
        </div>
        <!-- .modal-box -->
    </div>
    <!-- .modal-dialog -->
</div>
<!-- .recall-modal -->
@endsection