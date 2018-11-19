<aside class="order-payment-aside js-order-payment-aside">
    <form class="order-payment-detail-form type-payment-form" id="frm" action="{{ URL::Route('web-post-confirm-completed') }}" method="POST">

        <input type="hidden" id="transaction_code" name="transaction_code" value="{{ $data['response']['transaction']->code }}">
        <input type="hidden" id="payment" name="payment" value="{{ $data['response']['transaction']->total_price_in_vn }}">
        <input type="hidden" id="cost_incurred" name="cost_incurred" value="0">

        <div class="aside-head">
            <div class="aside-title">Chi tiết thanh toán</div>
            <a href="#" class="exit-btn"><i class="fa fa-chevron-left"></i></a>
        </div>
        <div class="aside-main">
            <input type="hidden" name="paymentMethod" class="paymentMethod payment-type-input" value="0">
            <section class="order-payment-detail-block" data-payment-type="0" id="payment-type-0">
                <div id="payment-type-0" class="payment-type-wrap is-active">
                    <div class="solution-payment-wrap">
                        <div class="wrap-head"><i class="fa fa-check text-green"></i> Vui lòng chọn giải pháp thanh toán:</div>

                        <div class="row row-5px wrap-main">
                            <div class="col-xs-6 col-sm-4">
                                <label class="radio-control sp-control ttip" data-tooltip="VNPAY">
                                    <input type="radio" name="solutionPayment" class="sp-input" value="vnpay" data-sp=".is-vnpay" checked="">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/payment/icon-vnpay.png" alt=""></div>
                                        <div class="title">VNPAY</div>
                                    </div><!-- .indicator -->
                                </label><!-- .radio-control -->
                            </div>
                        </div><!-- .row .row-5px -->
                    </div>

                    <div class="control-item-wrap bank-sp-control-wrap">
                        <div class="wrap-head"><i class="fa fa-check text-green"></i> Vui lòng chọn ngân hàng thanh toán:</div>
                        <div class="wrap-main row row-5px">
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="NCB">
                                    <input type="radio" name="bankID" value="NCB">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/ncb.png" alt=""></div>
                                        <div class="title">NCB</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng SCB">
                                    <input type="radio" name="bankID" value="SCB">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/scbbank.png" alt=""></div>
                                        <div class="title">Ngân hàng SCB</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng Sacombank">
                                    <input type="radio" name="bankID" value="SACOMBANK">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/sacombank.png" alt=""></div>
                                        <div class="title">Ngân hàng Sacombank</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng Eximbank">
                                    <input type="radio" name="bankID" value="EXIMBANK">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/eximbank.png" alt=""></div>
                                        <div class="title">Ngân hàng Eximbank</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng MSBANK">
                                    <input type="radio" name="bankID" value="MSBANK">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/maritimebank.png" alt=""></div>
                                        <div class="title">Ngân hàng MSBANK</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng Nam Á">
                                    <input type="radio" name="bankID" value="NAMABANK">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/namabank.png" alt=""></div>
                                        <div class="title">Ngân hàng Nam Á</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ví điện tử VnMart">
                                    <input type="radio" name="bankID" value="VNMART">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/vnmart.png" alt=""></div>
                                        <div class="title">Ví điện tử VnMart</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng Vietinbank">
                                    <input type="radio" name="bankID" value="VIETINBANK">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/viettinbank.png" alt=""></div>
                                        <div class="title">Ngân hàng Vietinbank</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng Vietcombank">
                                    <input type="radio" name="bankID" value="VIETCOMBANK">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/vietcombank.png" alt=""></div>
                                        <div class="title">Ngân hàng Vietcombank</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng HDBank">
                                    <input type="radio" name="bankID" value="HDBANK">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/hdbank.png" alt=""></div>
                                        <div class="title">Ngân hàng HDBank</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng Đông Á">
                                    <input type="radio" name="bankID" value="DONGABANK">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/dongabank.png" alt=""></div>
                                        <div class="title">Ngân hàng Đông Á</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng TPBANK">
                                    <input type="radio" name="bankID" value="TPBANK">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/tpbank.png" alt=""></div>
                                        <div class="title">Ngân hàng TPBANK</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng OJB">
                                    <input type="radio" name="bankID" value="OJB">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/ojb.png" alt=""></div>
                                        <div class="title">Ngân hàng OJB</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng BIDV">
                                    <input type="radio" name="bankID" value="BIDV">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/bidv.png" alt=""></div>
                                        <div class="title">Ngân hàng BIDV</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng VPBank">
                                    <input type="radio" name="bankID" value="VPBANK">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/vpbank.png" alt=""></div>
                                        <div class="title">Ngân hàng VPBank</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng Agribank">
                                    <input type="radio" name="bankID" value="AGRIBANK">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/agribank.png" alt=""></div>
                                        <div class="title">Ngân hàng Agribank</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng ACB">
                                    <input type="radio" name="bankID" value="ACB">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/acb.png" alt=""></div>
                                        <div class="title">Ngân hàng ACB</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng OCB">
                                    <input type="radio" name="bankID" value="OCB">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/oceanbank.png" alt=""></div>
                                        <div class="title">Ngân hàng OCB</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                            <div class="col-xs-6 col-sm-4 bank-item is-vnpay is-show">
                                <label class="radio-control ttip" data-tooltip="Ngân hàng INDOVINA">
                                    <input type="radio" name="bankID" value="IVB">
                                    <div class="indicator">
                                        <div class="icon"><img src="http://static1.fado.vn/f/desktop/v1/images/icon-bank/ivb.png" alt=""></div>
                                        <div class="title">Ngân hàng INDOVINA</div>
                                    </div>
                                    <!-- .indicator -->
                                </label>
                                <!-- .radio-control -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--            <section class="order-payment-detail-block" data-payment-type="1"  id="payment-type-1">
                <div class="block-head">
                    <div class="block-title"><i class="fa fa-check"></i> Vui lòng chọn phương thức thanh toán:</div>
                </div>
                
                <div class="block-main">
                    <p>Xin quý khác chuyển khoản số tiền vào một trong các tài khoản dưới đây</p>
                    <p>
                        <b class="text-red">* Ngân hàng Vietcombank:</b><br/>
                        - Số tài khoản: <b>0071 000 865 011</b><br/>
                        - Chủ tài khoản: Công ty TNHH Microlink Việt Nam<br/>
                        - Chi nhánh: (phòng giao dịch Nguyễn Hữu Cảnh) chi nhánh Tp.HCM
                    </p>
                    <p>
                        <b class="text-red">* Ngân hàng Á Châu</b><br/>
                        - Số tài khoản: <b>203 278 279</b><br/>
                        - Chủ tài khoản: Công ty TNHH Microlink Việt Nam<br/>
                        - Chi nhánh: Sài Gòn
                    </p>
                    <p><span class="text-red">Sau khi thanh toán thành công quí khách vui lòng thông báo cho chúng tôi qua email</span> <a href="mailto:support@fado.vn?Subject=" target="_top">support@fado.vn</a></p>
                </div>
                </section>.order-payment-detial-block -->
            <section class="order-payment-detail-block is-show" data-payment-type="1">
                <div class="block-head">
                    <div class="block-title"><i class="fa fa-check"></i> Vui lòng chọn phương thức thanh toán:</div>
                </div>
                <div class="block-main">
                    <p>- Quý khách vui lòng đến trực tiếp tại một trong các địa chỉ sau để thực hiện thanh toán: </p>
                    <p><b class="text-red">TP. HCM:</b> 85 Thăng Long, Phường 4, Quận Tân Bình, Tp Hồ Chí Minh <i>( Cổng Phan Thúc Duyện, góc đường Thăng Long, Phan Thúc Duyện)</i><br>
                        <b class="text-red">Địa điểm nhận thanh toán</b> Sumoshipping: số 46 đường 3/2 phường 12 quận 10                        <b class="text-red">Hà Nội</b> Số 4, Ngõ 26, Nguyên Hồng, Đống Đa, Hà Nội. 
                    </p>
                    <!-- <p><a target="_blank" href="#">Xem thêm chi nhánh</a></p> -->
                </div>
            </section>
            <section class="order-prepayment-block">
                <div class="block-head">
                    <div class="block-title"><i class="fa fa-check"></i> Vui lòng chọn % bạn muốn thanh toán:</div>
                </div>




                @foreach($data['response']['payment_type_detail'] as $key => $val)
                <label class="prepayment-control">
                    <input type="radio" class="pp-type-rad prepaidOption" name="payment_type_detail" data-type="{{ $val->type }}" data-percent="{{ $val->payment_value }}" value="{{ $val->id }}">
                    <div class="prepayment-panel">
                        <div class="panel-head">
                            <div class="panel-title">{{ $val->title }}</div>
                        </div>
                        <div class="panel-main">
                            <div class="note-text">
                                {{ $val->description }}
                            </div>
                            <div class="price-data" style="display: none"></div>
                            @if($val->type ==0)
                                <div class="price-wrap">
                                    <div class="price-item">
                                        <div class="lbl">Tổng giá trị đơn hàng</div>
                                        <div class="val">
                                            <span class="format-currency" data-decimals='0' data-value="{{ $data['response']['transaction']->total_price_in_vn }}"></span>
                                        </div>
                                    </div>
                                    <div class="price-item">
                                        <div class="lbl">Phí giao hàng trong nước:</div>
                                        <div class="val">0<sup>đ</sup></div>
                                    </div>
                                    <div class="price-item">
                                        <div class="lbl">Chi phí phải thanh toán trước để đơn hàng có hiệu lực:</div>
                                        <div class="val">
                                            <span class="format-currency paid_before" data-decimals='0' data-value="{{ $data['response']['transaction']->total_price_in_vn }}"></span>
                                            <sup>đ</sup>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="price-wrap">
                                    <div class="price-item">
                                        <div class="lbl">Tổng giá trị đơn hàng</div>
                                        <div class="val">
                                            <span class="format-currency" data-decimals='0' data-value="{{ $data['response']['transaction']->total_price_in_jp }}"><sup>đ</sup></span>
                                        </div>
                                    </div>
                                    <div class="price-item">
                                        <div class="lbl">Phí giao hàng trong nước:</div>
                                        <div class="val">
                                            <span class="format-currency" data-decimals='0' data-value="{{ $data['response']['transaction']->total_fee }}"><sup>đ</sup>
                                        </div>
                                    </div>
                                    <div class="price-item">
                                        <div class="lbl">Phụ phí thu thêm:</div>
                                        <div class="val">
                                            <span class="format-currency cost_incurred" data-decimals='0' data-value="{{ ceil(($data['response']['transaction']->total_price_in_jp * (float)$val->cost_incurred)/100) }}"><sup>đ</sup>
                                        </div>
                                    </div>

                                    <div class="price-item">
                                        <div class="lbl">Chi phí phải thanh toán trước để đơn hàng có hiệu lực:</div>
                                        <div class="val">
                                            <span class="format-currency paid_before" data-decimals='0' data-value="{{ $data['response']['transaction']->total_price_in_vn }}"></span>
                                            <sup>đ</sup>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </label>
                @endforeach

                <div class="choose-rule-wrap">
                    <label class="control-input">
                        <input type="checkbox" id="tos">
                        <div class="indicator blinker" data-display="0" style="opacity: 1;">Tôi đồng ý với các điều khoản &amp; điều kiện được nêu</div>
                    </label>
                </div>
            </section>
        </div>


        <div class="bootbox modal modal-2 fade rule-modal in" tabindex="-1" role="dialog" style="z-index: 1040; display: none; padding-left: 0px;">
            <div class="modal-dialog" style="margin: 10px auto; width: 95%;">
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
                        <button data-bb-handler="main" type="button" class="btn btn-danger btn-block btnAcceptTOS">Tôi đã đọc và đồng ý<br>với các điều khoản trên</button>
                    </div>
                </div>
            </div>
        </div>




        <div class="aside-foot">
            <div class="row row-5px">
                <div class="col-xs-6"><a href="{{ URL::Route('web-get-homePage') }}" class="btn btn-default btn-block">Tiếp tục mua sắm</a></div>
                <div class="col-xs-6"><button class="btn btn-danger btn-block" type="button" id="btnCompleteOrder">Thanh Toán</button></div>
            </div>
        </div>
    </form>
</aside>