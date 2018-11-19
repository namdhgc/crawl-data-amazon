<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Thanh Toán</title>

        <!-- ###### CSS ###### -->
        <link href="http://static1.fado.vn/f/desktop/v1/css/??global.pttt.min.css" media="screen" rel="stylesheet" type="text/css">

        <!--[if lt IE 9]>
          <script src="http://static1.fado.vnf/desktop/v1/js/library/html5shiv.min.js"></script>
          <script src="http://static1.fado.vnf/desktop/v1/js/library/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>


        <header class="header-block js-header-block">
            <div class="container">
                <a class="" href="#" title="Logo Sumo shipping">&nbsp;</a>

                <button class="btn btn-default call-menu-btn hidden-lg hidden-md"></button>
            </div>

            <nav class="menu-page-nav">
                <div class="container">
                    <ul class="lv1">
                        <li><a href="{{ URL::Route('web-get-introduce') }}">Về Sumo shipping</a></li>
                        <li><a href="#">Hướng dẫn thanh toán</a></li>
                        <li><a href="{{ URL::Route('web-get-frequently-asked-questions') }}">Trợ giúp</a></li>
                    </ul>
                </div>
            </nav>
        </header>

        <section class="banner-block">
            <div class="container">
                <div class="block-head">
                    <div class="block-title">Thanh toán trên Sumo shipping <span>cực đơn giản</span></div>
                </div>
            </div>
        </section>

        <section class="intro-block js-intro-block">
            <div class="container">
                <div class="block-head">
                    <div class="block-title">
                        Bạn mua hàng trên <span class="text-red">Sumo shipping</span>
                        <span class="break">nhưng gặp khó khăn trong khi thanh toán?</span>
                    </div>

                    <div class="text">
                        <p>Khi tạo đơn hàng trên <span class="text-red">Sumo shipping</span>, Quý khách sẽ nhận được e-mail xác nhận trạng thái <span class="text-break">"<b>Đã kiểm duyệt - chờ thanh toán</b>"</span>.</p>
                        <p>Quý khách vui lòng chọn thực hiện thanh toán theo 1 trong 4 phương thức thanh toán sau đây.</p>
                    </div>
                </div>

                <div class="block-main">
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="intro-item">
                                <a class="img" href="#thanh-toan-truc-tuyen"><img src="http://static1.fado.vn/thumb/80x79/f/desktop/v1/images/img-intro-item-1.png" alt="" /></a>
                                <div class="title"><a href="#thanh-toan-truc-tuyen">Thanh toán trực tuyến</a></div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="intro-item">
                                <a class="img" href="#thanh-toan-sumo-shipping"><img src="http://static1.fado.vn/thumb/80x79/f/desktop/v1/images/img-intro-item-3.png" alt="" /></a>
                                <div class="title"><a href="#thanh-toan-sumo-shipping">Thanh toán tại văn phòng Sumo shipping</a></div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-md-4">
                            <div class="intro-item">
                                <a class="img" href="#thanh-toan-tai-nha"><img src="http://static1.fado.vn/thumb/80x79/f/desktop/v1/images/img-intro-item-4.png" alt="" /></a>
                                <div class="title"><a href="#thanh-toan-tai-nha">Thanh toán tại nhà</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="stats-block js-stats-block">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="stats-item">
                            <div class="img"><img src="http://static1.fado.vn/thumb/42x47/f/desktop/v1/images/icon-stats-01.png" alt="" /></div>
                            <div class="number"><span class="timer" data-from="0" data-to="800"></span> Triệu +</div>
                            <div class="title">Sản phẩm trên Sumo shipping</div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="stats-item">
                            <div class="img"><img src="http://static1.fado.vn/thumb/47x47/f/desktop/v1/images/icon-stats-02.png" alt="" /></div>
                            <div class="number"><span class="timer" data-from="0" data-to="200000"></span> +</div>
                            <div class="title">Giao dịch thành công</div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="stats-item">
                            <div class="img"><img src="http://static1.fado.vn/thumb/37x47/f/desktop/v1/images/icon-stats-03.png" alt="" /></div>
                            <div class="number"><span class="timer" data-from="0" data-to="60000"></span> Giờ +</div>
                            <div class="title">Phục vụ khách hàng</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="payment-method-block">
            <div class="container">
                <div class="method-item" id="thanh-toan-truc-tuyen">
                    <div class="img" style="background-image:url('http://static1.fado.vn/thumb/1012x602/f/desktop/v1/images/img-method-1.png')"></div>
                    <div class="text-wrap">
                        <div class="title">Thanh toán trực tuyến</div>

                        <div class="text method-1">
                            <p>- Thông tin của bạn được giữ an toàn 100% và chỉ được sử dụng cho giao dịch này. Chúng tôi sẽ không bao giờ tiết lộ thông tin thẻ của bạn cho bất kỳ bên thứ ba.</p>

                            <p>- Hệ thống thanh toán của chúng tôi tuân thủ PCI-DSS, có nghĩa là toàn bộ quá trình thanh toán theo các tiêu chuẩn bảo mật cao nhất và là tương đương với cơ sở hạ tầng cấp ngân hàng.</p>

                            <p>- MIỄN PHÍ chuyển khoản.</p>
                        </div>
                    </div>
                </div>



                <div class="method-item" id="thanh-toan-sumo-shipping">
                    <div class="img col-sm-push-6" style="background-image:url('http://static1.fado.vn/thumb/691x675/f/desktop/v1/images/img-method-3.png')"></div>
                    <div class="text-wrap col-sm-pull-6">
                        <div class="title">Thanh toán tại VP của Sumo shipping</div>

                        <div class="text method-3">
                            <p>- Quý khách vui lòng cung cấp mã đơn hàng và số điện thoại tạo đơn hàng khi đến thanh toán</p>
                            <p>- Quý khách vui lòng đến trực tiếp tại một trong hai địa chỉ sau để thực hiện thanh toán:</p>
                            <p>
                                <b>TP. HCM:</b><br />
                                <i class="fa fa-map-marker"></i>85 Thăng Long, Phường 4, Quận Tân Bình, Tp Hồ Chí Minh <i>( Cổng Phan Thúc Duyện, góc đường Thăng Long, Phan Thúc Duyện)</i><br />
                                <i class="fa fa-phone"></i>1900 545 403                            </p>
                            <p>
                                <b>HÀ NỘI:</b><br />
                                <i class="fa fa-map-marker"></i>Số 4, Ngõ 26, Nguyên Hồng, Đống Đa, Hà Nội. <br />
                                <i class="fa fa-phone"></i>04 666 247 47                            </p>
                        </div>

                        <!-- <div class="view-more">
                            <a href="/danh-sach-chi-nhanh/" target="_blank">Xem thêm chi nhánh</a>
                        </div> -->
                    </div>
                </div>

                <div class="method-item" id="thanh-toan-tai-nha">
                    <div class="img" style="background-image:url('http://static1.fado.vn/thumb/570x500/f/desktop/v1/images/img-method-4.jpg')"></div>
                    <div class="text-wrap">
                        <div class="title">Thanh toán tại nhà quý khách</div>

                        <div class="text method-4">
                            <p>- Quý Khách yêu cầu Sumo shipping đến địa chỉ cụ thể để nhận thanh toán trước cho đơn hàng bằng tiền mặt. (Chỉ Áp dụng cho khu vực nội thành TP. Hồ Chí Minh &amp; Hà Nội)</p>
                            <p>- Thực hiện thu phí cho 1 lần đến thu tiền tại nhà là
                                30.000 VNĐ, phí này sẽ được tính chung trong đơn hàng.</p>
                            <p>- Nhân viên khi đến thu tiền sẽ giao cho khách hàng phiếu thu tiền có đóng dấu xác nhận của Sumo shipping, không thu thêm ngoài đơn hàng.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @include('layouts.user.footer')

        <!-- <section class="request-call-block js-request-call-block">
            <div class="container">
                <div class="block-head">
                    <div class="block-title">Thông tin liên hệ</div>
                    <div class="text">
                        <p>Quý khách muốn hiểu rõ hơn, Vui lòng để lại số điện thoại, Sumo shipping sẽ gọi lại quý khách trong thời gian sớm nhất.</p>
                        <p>Cám ơn quý khách đã sử dụng dịch vụ của chúng tôi.</p>
                    </div>
                </div>

                <div class="block-main">
                    <form class="request-call-form">
                        <input type="text" class="txt phone-input" placeholder="Số điện thoại của bạn" />

                        <button class="submit-btn">Gửi ngay</button>
                    </form>
                </div>
            </div>
        </section> -->

        <script src="http://static1.fado.vn/f/desktop/v1/js/library/??pttt/libs.min.js,pttt/utility.js,pttt/header-block.js,pttt/stats-block.js,pttt/intro-block.js,pttt/request-call-block.js,pttt/main.js"></script>
    </body>
</html>
