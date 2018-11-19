<!--Footer-->
<section class="footer-block">
    <div class="block-main">
        <div class="container">
            <div class="row-1-section">
                <div class="content">
                    <p></p>
                    <b>{{ Cache::get('company_name') }}</b> - Sàn thương mại điện tử xuyên biên giới hàng đầu Việt Nam<br>
                    <p></p>
                </div>

                <a class="img" href="#" target="_blank"><img src="{{ URL::asset('fado/images/footer/icon-bo-cong-thuong.png') }}" alt=""></a>
            </div>

            <div class="row-2-section">
                <div class="section-head">
                    <div class="info-item"><i class="fa fa-envelope"></i>
                        @if(!empty(Cache::get('email_support')))
                            {{ Cache::get('email_support') }}
                        @endif 
                    </div>
                    <div class="info-item"><i class="fa fa-phone"></i>
                        @if(!empty(Cache::get('hotline')))
                            {{ Cache::get('hotline') }}
                        @endif
                    </div>
                    <!--<div class="info-item"><i class="fa fa-fax"></i>08 222 0220</div>-->
                </div>

                <div class="section-main">
                    <div class="row row-15px">

                    @if(isset($data_user))
                        @foreach($data_user['agency']['response'] as $key => $item)
                        <div class="col-xs-3">
                            <div class="branch-item item-{{ $key + 1}}">
                                <div class="img-col"><img src="http://static.fado.vn/f/desktop/v1/images/footer/icon-vn-circle.png" alt=""></div>
                                <div class="info-col">
                                    <p><b>{{ $item->name }}</b></p>
                                    <p><b>{{ $item->country }}</b> {{ $item->address }}</i></p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif

                    </div>
                </div>

                <div class="section-foot">
                    <!-- <a class="view-more-btn" href="/danh-sach-chi-nhanh/">Xem thêm chi nhánh</a> -->
                </div>
            </div>

            <div class="row-3-section">
                <div class="section-main">
                    <div class="row row-15px">
                        <div class="col-xs-3">
                            <div class="info-wrap">
                                <div class="wrap-title">Về Sumo shipping</div>
                                <div class="wrap-main">
                                    <ul class="link-list">
                                        <li><a href="{{ URL::Route('web-get-introduce') }}">Giới thiệu về Sumo shipping</a></li>
                                        <li><a href="{{ URL::Route('web-get-frequently-asked-questions') }}">Câu hỏi thường gặp</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-3">
                            <div class="info-wrap">
                                <div class="wrap-title">Dành cho khách hàng</div>
                                <div class="wrap-main">
                                    <ul class="link-list">
                                        <li><a href="{{ URL::Route('web-get-customer-feedback') }}">Phản hồi khách hàng </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-3">
                            <div class="info-wrap">
                                <div class="wrap-title">Đăng ký nhận thông tin</div>
                                <div class="wrap-main">
                                    <p>Đăng ký nhận thông tin qua email để nhận được hàng triệu ưu đãi từ Sumo shipping</p>

                                    <form action="{{ URL::Route('web-post-add-email-notification') }}" id="newsletter-form" class="newsletter-form" method="POST">
                                        <div class="input-wrap">
                                            {{ csrf_field() }}
                                            <input type="email" class="email-input" name="email" value="" placeholder="Vui lòng nhập địa chỉ mail của bạn">
                                            <button class="send-btn" type="submit"><i class="fa fa-send"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- <div class="info-wrap app-info-wrap">
                                <div class="wrap-title">Ứng dụng di động</div>
                                <div class="wrap-main">
                                    <div class="app">
                                        <div class="qr-img"><a href="#" target="_blank"><img src="#" alt="" /></a></div>
                                        <div class="info-field">
                                            <a href="#" target="_blank"><img src="{{ URL::asset('fado/images/footer/app-android.png') }}" alt="" /></a>
                                            <a href="#" target="_blank"><img src="{{ URL::asset('fado/images/footer/app-ios.png') }}" alt="" /></a>
                                        </div>
                                    </div>
                                </div>
                            </div> --><!-- .info-wrap -->
                        </div>

                        <div class="col-xs-3">
                            <!-- <div class="info-wrap social-info-wrap">
                                <div class="wrap-title">Kết nối chúng tôi</div>
                                <div class="wrap-main">
                                    <div id="fb-root"></div>
                                    <script>(function (d, s, id) {
                                            var js, fjs = d.getElementsByTagName(s)[0];
                                            if (d.getElementById(id))
                                                return;
                                            js = d.createElement(s);
                                            js.id = id;
                                            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
                                            fjs.parentNode.insertBefore(js, fjs);
                                        }(document, 'script', 'facebook-jssdk'));</script>
                                    <div class="fb-page" data-href="https://www.facebook.com/fadovietnam" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/fadovietnam" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/fadovietnam">Fado.vn - Mua Hàng Amazon</a></blockquote></div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="row-5-section">
                <div class="section-main">
                    <div class="row row-15px">
                        <div class="col-xs-9">
                            @if(!empty(Cache::get('description')))
                                @foreach(Cache::get('description') as $k => $val)
                                <div class="info-wrap">
                                    <div class="wrap-title">{{ $val['title'] }}</div>
                                    <div class="wrap-main js-scroll fd-scroll">
                                        <?php //echo $val['description']; ?>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

    <div class="block-foot">
        <div class="container">
            <div class="content">Copyright © 2016 Sumo shipping</div>
            <div class="img">
                <img src="{{ URL::asset('fado/images/footer/icon-amex.png') }}" alt="">
                <img src="{{ URL::asset('fado/images/footer/icon-visa.png') }}" alt="">
                <img src="{{ URL::asset('fado/images/footer/icon-mastercard.png') }}" alt="">
            </div>
        </div>
    </div>
</section>