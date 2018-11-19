@extends('layouts/user/master')
@section('title')
@endsection
@section('css')
<style type="text/css">

  tbody.detail-price {
    display:block;
  }
</style>
@endsection
@section('js')
<script src="{{ URL::asset('js/web/confirm/confirm-payment.js') }}" type="text/javascript"></script>
<script type="text/javascript">
   ConfirmPayment.init();
   $(document).ready(function() {
       $('.paymentMethod').change(function(){

            console.log($(this).attr('data-tab-target'));
            $('.payment-type-wrap').removeClass('is-active');
            $($(this).attr('data-tab-target')).addClass('is-active');
            var des = $(this).parent().find('.desc').first().html();
            $('.col-head .tb-cell .col-title').html(des);
       });

       $('.item-main').first().show();
       $('input[name=payment_type_detail]').first().prop('checked', true);

       $('.prepaidOption').change(function(){

            $('.item-main').hide();
            var parent = $(this).parents('.pp-type-item').first();
            parent.find('.item-main').first().show();

            var paid_before = parent.find('.paid_before').first();
            $('#payment').val(paid_before.attr('data-value'));

            var cost_incurred = parent.find('.cost_incurred').first();
            if(cost_incurred.length ==1){

              var data    = cost_incurred.attr('data-value');

              $('#cost_incurred').val(data);

            }
       });

        $('.view-more').click(function(e){

                e.preventDefault();
                var item_code = $(this).attr('data-code');

                if($(this).hasClass('active')){

                    $(this).removeClass('active');
                    $(this).html('+ Xem chi tiết giá');
                    $('.detail-price[data-code="'+item_code+'"]').first().hide(500);
                }else {
                  console.log($('.detail-price[data-code="'+item_code+'"]').first());
                    $(this).addClass('active');
                    $(this).html('+ Ẩn chi tiết giá');
                    $('.detail-price[data-code="'+item_code+'"]').first().show(500);
                }
        });

        $('.blinker').click(function(){

            var display = $(this).attr('data-display');

            if(display == 0){

              $('.rule-modal').show();
              $(this).attr('data-display',1);

            }else{

              $(this).attr('data-display',0);

            }
        });

        $('.btnAcceptTOS').click(function(){

            $('.rule-modal').hide();
        });

        $('#btnCompleteOrder').click(function(){

          var display         = $('.blinker').attr('data-display');
          var payment_method  = 0;
          $('input[type=radio][name=payment_method]').each(function(){

                  if($(this).is(':checked')){

                      payment_method =  $(this).val();

                  }

                });

          if(display ==1){

            $('.type-payment-form').submit();

          }else{

              var message = '';

              if(payment_method == 0) {
                  var flag =  'false';

                  $('input[type=radio][name=bankID]').each(function(){

                    if($(this).is(':checked')){

                        flag =  'true';

                    }

                  });

                  if(flag =='false'){

                    message = 'Quý khách vui lòng chọn một ngân hàng để thanh toán.';

                  }else{

                    message = 'Quý khách vui lòng xem qua điều khoản và đồng ý với điều khoản của SumoShipping trước khi đặt mua hàng.';
                  }

              }else{

                message = 'Quý khách vui lòng xem qua điều khoản và đồng ý với điều khoản của SumoShipping trước khi đặt mua hàng.';

              }

                bootbox.dialog({
                  message: message,
                  title: "Thông Báo",
                  buttons: {
                      success: {
                          label: "Thoát",
                          className: "btn-success",
                          callback: function () {
                              return;
                          }
                      }
                  }
              });
          }

        });
        $(document).on('change','.inputQuantity',function(e){
                 e.preventDefault();
                var quantity    =   $(this).val();

                $(this).parent().find('.input-quantity').val(quantity);

        });
   });
</script>
@endsection
@section('content')
<section class="breadcrumb-block">
   <div class="container">
      <div class="item"><a href="{{ URL::Route('web-get-homePage') }}">Trang chủ</a></div>
      <div class="item"><a href="{{ URL::Route('web-get-my-shopping-cart') }}">Giỏ hàng</a></div>
      <div class="item">Xác nhận thông tin</div>
   </div>
</section>
<section class="steps-order-block">
   <div class="container">
      <div class="step-item is-active">
         <i class="fa fa-shopping-cart"></i><br>
         <div class="text">Giỏ hàng<br>của bạn</div>
      </div>
      <div class="step-item is-active">
         <i class="fa fa-user"></i><br>
         <div class="text">Thông tin<br>người mua-nhận
         </div>
      </div>
      <div class="step-item is-active">
         <i class="fa fa-credit-card-alt"></i><br>
         <div class="text">Hình thức<br>thanh toán
         </div>
      </div>
      <div class="step-item">
         <i class="fa fa-check"></i><br>
         <div class="text">Xác nhận<br>thành công
         </div>
      </div>
   </div>
</section>
<div class="steps-order-page page js-steps-order-page">
<div class="container page-container">
   <section class="order-cart-block">
      <div class="block-head"><div class="block-title">Giỏ hàng của bạn</div></div>
      <div class="block-main">
          <form class="order-cart-form" method="POST" action="{{ URL::Route('web-post-update-shoping-cart-3') }}">
              <input type="hidden" name="code" value="{{ $data['response']['transaction']->code }}">
              <table class="cart-tb">
                  <thead>
                      <tr>
                          <th style="width: 40px;">STT</th>
                          <th style="min-width: 200px;">Thông tin sản phẩm</th>
                          <th style="width: 90px;">Số lượng</th>
                          <th style="width: 230px;">Thành tiền</th>
                          <th></th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php  $price_remain = 0; $price_total_all = 0; $count = 1; $price_discount_promotion = 0;?>
                            @foreach($data['response']['detail_transaction'] as $key => $value)
                            <?php $type_product = json_decode($value->type_product); ?>
                            <?php $price_list_detail = json_decode($value->price_list_detail); ?>
                            <tr class="product-item">
                                <td class="order">{{$count}}</td>
                                <td class="product-info">
                                    <a target="_blank" href="{{ $value->img }}" class="img"><img alt="" src="{{ $value->img }}"></a>
                                    <div class="info-wrap">
                                        <div class="title">
                                            <a target="_blank" href="{{ URL::Route('web-get-detail-product',['code' => $value->product_code]) }}">{!! $value->name !!}</a>
                                        </div>
                                        <p><b class="text-red"><ins>Thông số đặt mua</ins></b>: </p>
                                        @foreach( $type_product as $type_key => $type_value )
                                          <p>{{ $type_key}}: <span class="text-blue">{{ $type_value }}</span></p>
                                        @endforeach
                                        <p>Cân nặng: <span class="text-blue">15 pounds</span></p>
                                        <p>Mã sản phẩm: <span class="text-blue">{{ $value->product_code }}</span></p>
                                        <p>Xem <a target="_blank" href="{{ Config::get('spr.system.link_get_data.amazon.jp.detail-product') . $value->product_code . '?th=1&psc=1' }}">link gốc</a> sản phẩm</p>
                                    </div>
                                </td>
                                <td class="quantity">
                                    <input  type="number" class="form-control inputQuantity" title="Quantity" min="1" maxlength="2" name="" value="{{ $value->quantity }}">
                                    <input  class="input-quantity" type="hidden" name="product[{{ $value->product_code }}][quantity]" value="{{ $value->quantity }}">
                                </td>
                                <td class="product-price" >
                                    <div class="price">
                                        <span class="format-currency" data-decimals='0' data-value="{{ $value->price_in_vn }}"></span> <sup>đ</sup>
                                    </div>
                                    <div class="detail-price" data-code="{{$value->product_code}}">
                                        <div class="item">
                                            <span class="lbl">Giá sản phẩm sau thuế tại Nhật</span>
                                            <span class="val">
                                                <span class="format-currency" data-decimals='0' data-value="{{ $value->price * $data['response']['transaction']->exchange_rate * $value->quantity }}"></span> <sup>đ</sup>
                                            </span>
                                        </div>
                                        @foreach( $price_list_detail as $price_key => $price_value )
                                        <div class="item">
                                            <span class="lbl">{{ $price_value->title }}</span>
                                            <span class="val">
                                                <span class="format-currency" data-decimals='0' data-value="{{ $price_value->price }}"></span> <sup>đ</sup>
                                            </span>
                                        </div>
                                        @endforeach
                                    </div>
                                    <a href="#" class="view-more" data-code="{{$value->product_code}}">+ Xem chi tiết</a>
                                </td>
                                <td class="tool">
                                    <button type="button" data-id="{{ $value->product_code }}" data-tooltip="Nhấp vào đây để xóa<br /> sản phẩm khỏi giỏ hàng" data-placement="left" class="btn btn-default ttip bt-remove-cart-item" data-code="{{ $data['response']['transaction']->code }}" style="cursor: pointer;"><i class="fa fa-remove"></i></button>
                                </td>
                            </tr>
                            <?php  $count++;?>
                            @endforeach
                  </tbody>
                  <tfoot>
                      <tr>
                          <td colspan="3"> Tổng cộng : </td>
                          <td colspan="1">
                              <span class="val">
                                  <span class="format-currency total-price-befor-promotion" data-decimals='0' data-value="{{ $data['response']['transaction']->total_price_in_vn }} }}"></span> <sup>đ</sup>
                              </span>
                          </td>
                          <td colspan="1"></td>
                      </tr>
                      <tr>
                          <td colspan="3"> Mã khuyến mại : </td>
                          <td colspan="1">
                              <span class="val">
                                  <span class="format-currency total-price-befor-promotion" data-decimals='0' data-value="-{{ $data['response']['transaction']->price_list_promotion_code }}"></span> <sup>đ</sup>
                              </span>
                          </td>
                          <td colspan="1"></td>
                      </tr>
                      <tr>
                          <td colspan="3"> Mã đại lý : </td>
                          <td colspan="1">
                              <span class="val">
                                  <span class="format-currency total-price-befor-promotion" data-decimals='0' data-value="-{{ $data['response']['transaction']->price_list_happy_code }}"></span> <sup>đ</sup>
                              </span>
                          </td>
                          <td colspan="1"></td>
                      </tr>
                      <tr>
                          <td colspan="3"> Tổng đơn hàng : </td>
                          <td colspan="1">
                              <span class="val">
                                  <span class="format-currency total-price-befor-promotion" data-decimals='0' data-value="{{ $data['response']['transaction']->total_price_in_vn }}"></span> <sup>đ</sup>
                              </span>
                          </td>
                          <td colspan="1"></td>
                      </tr>
                      <tr>
                          <td colspan="6">
                              <button data-tooltip="Nhấp vào đây để&lt;br /&gt;cập nhật thông tin sản phẩm" class="btn btn-success ttip" type="submit" style="cursor: pointer;"><i class="fa fa-refresh"></i> Cập nhật số lượng</button>
                          </td>
                      </tr>
                  </tfoot>
              </table>
          </form>
      </div>
  </section>
   <form class="type-payment-form" id="frm" action="{{ URL::Route('web-post-confirm-completed') }}" method="POST">
      <input type="hidden" id="transaction_code" name="transaction_code" value="{{ $data['response']['transaction']->code }}">
      <input type="hidden" id="payment" name="payment" value="{{ $data['response']['transaction']->total_price_in_vn }}">
      <input type="hidden" id="cost_incurred" name="cost_incurred" value="0">

      <section class="order-payment-type-block">
         <div class="block-head">
            <div class="block-title">Chọn hình thức thanh toán</div>
         </div>
         <div class="block-main">
            <div class="col-1">
               @foreach(Config::get('spr.type.type.payment') as $key => $val)
                 <label class="pt-radio-control">
                    <input type="radio" class="pt-rad paymentMethod" name="payment_method" data-tab-target="#payment-type-{{ $val['value'] }}"  data-type="{{ $val['value'] }}" value="{{ $val['value'] }}">
                    <div class="indicator">
                       <div class="icon"><img src="{{ URL::asset( $val['icon']) }}" alt=""></div>
                       <div class="title">
                          <p>{{ $val['description'] }} </p>
                          <p><span style="color:#43d243;;">Miễn phí chuyển khoản</span></p>
                       </div>
                       <div class="desc">{{ $val['description'] }}</div>
                    </div>
                 </label>
               @endforeach
            </div>
            <div class="col-2">
               <div class="col-head">
                  <div class="tb-cell">
                     <div class="col-title">Để thanh toán trực tuyến, tài khoản ngân hàng của bạn phải đăng ký sử dụng internet banking </div>
                  </div>
               </div>
               <div class="col-main">
                  <div id="payment-type-0" class="payment-type-wrap is-active">
                       <div class="solution-payment-wrap">
                          <div class="wrap-head">Chọn giải pháp thanh toán:</div>
                          <label class="sp-radio-control ttip" data-tooltip="VNPAY" style="cursor: pointer;">
                             <input type="radio" name="solution_payment" class="sp-input" value="vnpay" data-sp=".is-vnpay" checked="">
                             <div class="indicator">
                                <div class="inner"><img src="http://static.fado.vn/f/desktop/v1/images/payment/icon-vnpay.png" alt=""></div>
                             </div>
                          </label>
                       </div>
                       <div class="bank-radio-control-wrap  is-sp">
                          <div class="wrap-head">Chọn ngân hàng thanh toán:</div>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="NCB" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="NCB">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/ncb.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng SCB" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="SCB">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/scbbank.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng Sacombank" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="SACOMBANK">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/sacombank.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng Eximbank" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="EXIMBANK">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/eximbank.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng MSBANK" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="MSBANK">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/maritimebank.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng Nam Á" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="NAMABANK">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/namabank.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ví điện tử VnMart" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="VNMART">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/vnmart.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng Vietinbank" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="VIETINBANK">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/viettinbank.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng Vietcombank" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="VIETCOMBANK">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/vietcombank.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng HDBank" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="HDBANK">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/hdbank.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng Đông Á" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="DONGABANK">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/dongabank.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng TPBANK" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="TPBANK">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/tpbank.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng OJB" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="OJB">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/ojb.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng BIDV" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="BIDV">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/bidv.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng VPBank" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="VPBANK">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/vpbank.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng Agribank" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="AGRIBANK">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/agribank.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng ACB" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="ACB">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/acb.png" alt="">
                             </div>
                          </label>
                          <label class="bank-radio-control ttip is-vnpay is-show" data-tooltip="Ngân hàng OCB" style="cursor: pointer;">
                             <input type="radio" name="bankID" value="OCB">
                             <div class="indicator">
                                <img src="http://static.fado.vn/f/desktop/v1/images/icon-bank/oceanbank.png" alt="">
                             </div>
                          </label>
                       </div>
                    </div>
                  <div id="payment-type-1" class="payment-type-wrap">
                     <p>- Quý khách vui lòng đến trực tiếp tại một trong hai địa chỉ sau để thực hiện thanh toán: </p>
                     <p><b class="text-red">TP. HCM:</b> 85 Thăng Long, Phường 4, Quận Tân Bình, Tp Hồ Chí Minh <i>( Cổng Phan Thúc Duyện, góc đường Thăng Long, Phan Thúc Duyện)</i><br>
                        <b class="text-red">Địa điểm nhận thanh toán</b> Sumoshipping: số 46 đường 3/2 phường 12 quận 10
                        <b class="text-red">Hà Nội</b> Số 4, Ngõ 26, Nguyên Hồng, Đống Đa, Hà Nội.  <br>
                     </p>
                  </div>
                </div>
                <div class="col-foot">
                  @foreach($data['response']['payment_type_detail'] as $key => $val)
                   <div class="pp-type-item">
                      <label class="control-radio-1">
                         <input type="radio" class="pp-type-rad prepaidOption" name="payment_type_detail" data-type="{{ $val->type }}" data-percent="{{ $val->payment_value }}" value="{{ $val->id }}">
                         <div class="indicator">{{ $val->title}}</div>
                      </label>
                      <div class="item-main" style="display: none;">
                         <p>
                          {{ $val->description }}
                         </p>
                         <div class="price-data" style="" >
                         @if($val->type ==0)
                            <table class="price-tb">
                               <thead>
                                  <tr>
                                     <th class="lbl">Tổng giá trị đơn hàng :</th>

                                     <th class="val"><span class="format-currency" data-decimals='0' data-value="{{ $data['response']['transaction']->total_price_in_vn }}"></span><a class="view-more" data-code="{{ $val->id }}" href="#">Xem chi tiết</a>
                                     </th>
                                  </tr>
                                 </thead>
                                 <tbody style="display:none" class="detail-price" data-code="{{ $val->id }}">
                                  <tr>
                                     <td class="lbl">Phí giao hàng trong nước:</td>
                                     <td class="val">0<sup>đ</sup></td>
                                  </tr>
                                  <tr>
                                     <td class="lbl">Chi phí phải thanh toán trước để đơn hàng có hiệu lực:</td>
                                     <td class="val"><span class="format-currency paid_before" data-decimals='0' data-value="{{ $data['response']['transaction']->total_price_in_vn }}"></span><sup>đ</sup></td>
                                  </tr>
                               </tbody>
                            </table>
                          @else
                            <table class="price-tb">
                               <thead>
                                  <tr>
                                     <th class="lbl">Tổng giá trị đơn hàng :</th>

                                    <th class="val"><span class="format-currency" data-decimals='0' data-value="{{ $data['response']['transaction']->total_price_in_vn }}"></span><a class="view-more" href="#" data-code="{{ $val->id }}">Xem chi tiết</a>
                                    </th>
                                  </tr>
                                 </thead>
                                 <tbody style="display:none" class="detail-price" data-code="{{ $val->id }}">
                                 <tr>
                                     <td class="lbl">Tổng giá trị đơn hàng sau thuế tại Nhật :</td>
                                     <td class="val"><span class="format-currency" data-decimals='0' data-value="{{ $data['response']['transaction']->total_price_in_jp }}"><sup>đ</sup></td>
                                  </tr>
                                  <tr>
                                     <td class="lbl">Phí giao hàng trong nước:</td>
                                     <td class="val"><span class="format-currency" data-decimals='0' data-value="{{ $data['response']['transaction']->total_fee }}"><sup>đ</sup></td>
                                  </tr>
                                  @if($val->cost_incurred > 0)
                                  <tr>
                                     <td class="lbl">Phụ phí thu thêm:</td>
                                     <td class="val"><span class="format-currency cost_incurred" data-decimals='0' data-value="{{ ceil(($data['response']['transaction']->total_price_in_jp * (float)$val->cost_incurred)/100) }}"><sup>đ</sup></td>
                                  </tr>
                                  @endif
                                  <tr>
                                     <td class="lbl">Chi phí phải thanh toán trước để đơn hàng có hiệu lực:</td>
                                     <td class="val"><span class="format-currency paid_before" data-decimals='0' data-value="{{ ceil(( $data['response']['transaction']->total_price_in_jp * (float)$val->payment_value)/100) }}"></span><sup>đ</sup></td>
                                  </tr>
                               </tbody>
                            </table>
                          @endif
                          <!-- .price-tb -->
                         </div>
                         <div class="price-loading text-center" style="display: none;">
                          <img src="http://static.fado.vn/f/desktop/v1/images/loading-bar.gif">
                          <div class="text-center">Đang tính giá đơn hàng... </div>
                         </div>
                      </div>
                    </div>
                  @endforeach
                </div>
                <div class="choose-rule-wrap">
                  <label class="control-radio-1">
                    <input type="checkbox" id="tos">
                    <div class="indicator blinker" data-display="0">Với việc bấm vào nút bên dưới, tôi đồng ý với các điều khoản và điều kiện được nêu.</div>
                  </label>
                </div>
              </div>
            </div>
             <div class="block-foot">
                <a class="btn btn-default" href="{{ URL::Route('web-get-my-shopping-cart') }}">Quay lại giỏ hàng</a>
                <button class="btn btn-danger" id="btnCompleteOrder" type="button">Hoàn tất đặt hàng</button>
             </div>
         </div>
      </section>
   </form>
</div>
<div class="bootbox modal modal-2 fade rule-modal in" tabindex="-1" role="dialog" style="z-index: 1040; display: none;">
  <div class="modal-dialog" style="margin: 0px auto; width: 80%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="bootbox-close-button" data-dismiss="modal" aria-hidden="true">
          <i class="fa fa-close"></i>
        </button>
        <h4 class="modal-title">{{ $data['response']['rules'][0]->title }}</h4>
      </div>
      <div class="modal-body" style="max-height: 600px; overflow: scroll;">
        <div class="bootbox-body">
            <?php echo $data['response']['rules'][0]->description;?>
        </div>
      </div>
      <div class="modal-footer">
        <button data-bb-handler="main" type="button" class="btn btn-danger btn-block btnAcceptTOS">Tôi đã đọc và đồng ý với các điều khoản trên</button>
      </div>
    </div>
  </div>
</div>
@endsection