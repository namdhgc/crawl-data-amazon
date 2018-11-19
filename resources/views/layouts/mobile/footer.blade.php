<!--Footer-->
<section class="footer-info-block js-footer-info-block">
    <div class="block-main">
        <div class="info-panel drop-panel"> 
            @foreach(Cache::get('why_choose_us') as $k => $val)
                <div class="panel-head"><a href="#">{{ ucwords($val['title']) }}</a></div>
                <div class="panel-main">
                    <?php echo $val['description'] ?>
                </div>
                <?php break;?>
            @endforeach
        </div>
        <div class="info-panel">
            <div class="panel-head"><a href="{{ URL::Route('web-get-frequently-asked-questions') }}">Câu hỏi thường gặp</a></div>
        </div>

        <div class="info-panel">
            <div class="panel-head"><a href="{{ URL::Route('web-get-news') }}">Chăm sóc &amp; Hỗ trợ khách hàng</a></div>
        </div>
        <div class="info-panel">
            <div class="panel-head"><a href="{{ URL::Route('web-get-payment-method') }}">Phương thức thanh toán</a></div>
        </div>
    </div>
</section>
<section class="footer-contact-block">
    <a class="request-quotation-wrap" href="{{ URL::Route('web-get-price-request') }}">
        <div class="wrap-inner">
            Báo giá 9 phút<br>
            <span>Mua hàng cực dễ</span>
        </div>
    </a>
    <a class="hotline-wrap" href="tel:@if(!empty(Cache::get('hotline'))){{ Cache::get('hotline') }} @endif">
        <div class="wrap-inner">
            Tư vấn miễn phí<br>
            <span>1900 545 403</span>
        </div>
    </a>
</section>