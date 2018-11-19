@extends('layouts/mobile/master')

@section('title')
@endsection

@section('css')
<style type="text/css">
    .fotorama__wrap {
        margin: 0 auto !important;
    }

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
    .box-foot {
        cursor: pointer;
    }
    .product-detail-block .block-head {
        text-align: left !important;
    }
</style>
@endsection

@section('js')

    <script src="{{ URL::asset('assets/web/scripts/detail-product.js') }}" type="text/javascript"></script>
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

@section('content')
<section class="breadcrumb-block js-breadcrumb-block">
    <div class="block-head">
        <div class="block-title">
            <a href="#">
                <span class="icon"><i class="fa fa-long-arrow-left"></i></span>
                <h1 class="title">
                    Cool Water By Davidoff For Men. Eau De Toilette Spray 4.2 Ounces
                </h1>
            </a>
        </div>
    </div>
</section>
<section class="product-detail-block js-product-detail-block">
    <div class="block-head">
        <div class="pd-meta-data">
            <div class="item"><span class="lbl">Thương hiệu:</span> <a href="#"></a></div>
            <div class="item">
                <i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star-half-empty  text-yellow"></i> (1963 lượt đánh giá)
            </div>
            <div class="item">Người bán: <a href="#">Amazon.com.</a> </div>
            <div class="item"> Bán tại: <img src="http://static.fado.vn/f/desktop/v1/images/icon-amazon.png" alt="">&nbsp;
                Amazon Mỹ
            </div>
        </div>
        <div class="pd-img-wrap fotorama" data-arrows="true"
             data-click="true"
             data-swipe="true" data-width="658" data-height="658"
             data-allowfullscreen="true"
             data-nav="thumbs">
           {{--  <div class="pd-images js-pd-images fotorama" id="img-product-detail"
            data-width="420" data-height="480"  data-arrows="true"
             data-click="true"
             data-swipe="true"
             data-allowfullscreen="true"
             data-nav="thumbs"> --}}
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
            {{-- </div> --}}
        </div>
        <div class="social-share">
            <div class="fb-like fb_iframe_widget fb_iframe_widget_fluid" data-href="/us/dp/B0009OAHC8/ref=twister_dp_update?ie=UTF8&amp;psc=1" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=&amp;container_width=400&amp;href=http%3A%2F%2Ffado.vn%2Fus%2Fdp%2FB0009OAHC8%2Fref%3Dtwister_dp_update%3Fie%3DUTF8%26psc%3D1&amp;layout=button&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=true&amp;size=small"><span style="vertical-align: bottom; width: 112px; height: 20px;"><iframe name="f178f4352b33d04" width="1000px" height="1000px" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" src="https://www.facebook.com/v2.7/plugins/like.php?action=like&amp;app_id=&amp;channel=http%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FXBwzv5Yrm_1.js%3Fversion%3D42%23cb%3Df13f18cc220f044%26domain%3Dfado.vn%26origin%3Dhttp%253A%252F%252Ffado.vn%252Ff142bb92a14e508%26relation%3Dparent.parent&amp;container_width=400&amp;href=http%3A%2F%2Ffado.vn%2Fus%2Fdp%2FB0009OAHC8%2Fref%3Dtwister_dp_update%3Fie%3DUTF8%26psc%3D1&amp;layout=button&amp;locale=vi_VN&amp;sdk=joey&amp;share=true&amp;show_faces=true&amp;size=small" style="border: none; visibility: visible; width: 112px; height: 20px;" class=""></iframe></span></div>
        </div>
    </div>
    <div class="block-main">
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
            <div class="scroll">
                @if(!empty($data['product_des']))
                 	{{ $data['product_des'] }}
                @endif
            </div>
            <a class="view-more" href="#gioi-thieu-san-pham">Xem chi tiết <i class="fa fa-angle-down"></i></a>
        </div>
        <input type="hidden" name="merchantID" value="ATVPDKIKX0DER">
        <div class="pd-choose">
            @foreach($data['type_product']['variationValues'] as $key => $value)
                <div class="item item-option">
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
                <div class="lbl">Số lượng:</div>
                <div class="val">
                    <input type="number" name="quanity" class="quantity-input" value="1" min="1" max="999">
                </div>
            </div>
        </div>
        <div class="pd-btn-wrap">
            <button id="bt-add-quotation" class="btn btn-danger" style="display: none"><i class="fa fa-link"></i>Yêu cầu báo giá</button>
            <button id="bt-buy-now" class="btn btn-danger"><i class="fa fa-dollar"></i>Mua ngay</button>
            <button id="bt-add-to-cart" class="btn btn-default"><i class="fa fa-shopping-basket"></i>Giỏ hàng</button>
            <button id="bt-add-favourite" class="btn btn-default"><i class="fa fa-heart-o"></i> Yêu Thích</button>
        </div>
    </div>
</section>
@if(!empty($data['product_des']))
    <section class="product-tab-block dropdown-block is-expand js-dropdown-block js-product-tab-block" id="gioi-thieu-san-pham">
        <div class="block-head">
            <div class="block-title">Giới thiệu</div>
        </div>
        <div class="block-main editor-content">
              {{ $data['product_des'] }}
        </div>
    </section>
@endif

@if(!empty($data['feature_base']))
    <section class="product-tab-block dropdown-block is-expand js-dropdown-block js-product-tab-block" id="dac-tinh-thong-so-san-pham">
        <div class="block-head">
            <div class="block-title">Thông số</div>
        </div>
        <div class="block-main">
            <div class="param-items-wrap">
                <div class="param-item">
                    @foreach($data['feature_base'] as $k_fb => $val_fb)
                        <div class="item ">
                            <span class="lbl">{{ $val_fb['lbl'] }}</span>
                            <span class="val">{{ $val_fb['val'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
@if(!empty($data['product_infor']))
    <section class="product-tab-block dropdown-block is-expand js-dropdown-block js-product-tab-block" id="thong-tin-chi-tiet">
            <div class="block-head">
                <div class="block-title">Thông tin</div>
            </div>
            <div class="block-main info-wrap editor-content">
                <div id="aplus_feature_div" class="param-item">
                        <?php echo $data['product_infor'];?>
                </div>
            </div>
    </section>
@endif
<section class="product-tab-block dropdown-block js-dropdown-block is-expand" id="binh-luan-facebook">
    <div class="block-head">
        <div class="block-title">Bình luận Facebook</div>
    </div>
    <div class="block-main">
        <div id="fb-root"></div>

        <div class="fb-comments" data-href="{{ Request::fullUrl() }}" data-width="100%" data-numposts="4"></div>
    </div>
</section>

<section id="danh-gia-va-binh-luan" class="product-tab-block dropdown-block js-dropdown-block js-product-tab-block is-expand">
    <div class="block-head">
        <div class="block-title">Đánh giá và bình luận</div>
    </div>
    <div class="block-main">
        <div id="commentList" class="comment-items-wrap" data-page="1">
        @if(!empty($data['customer_review']))
            @foreach($data['customer_review'] as $k => $v_cr)
            @if($v_cr['title'] != "" &&  $v_cr['customer'] != "" && $v_cr['comment']!= "")
            <div class="comment-item is-checked">
                <div class="title">
                    <i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i><i class="fa fa-star text-yellow"></i>                <span>{{ $v_cr['title'] }}</span>
                </div>
                <div class="by">{{ $v_cr['customer'] }}</div>
                <div class="meta">
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
</section>
@endsection