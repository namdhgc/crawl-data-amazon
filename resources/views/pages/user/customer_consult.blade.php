@extends('layouts/user/master')

@section('title')
@endsection

@section('css')
@endsection

@section('js')
@endsection

@section('content')
<section class="breadcrumb-block">
    <div class="container">
        <div class="item">
            <a href="#">Trang chủ</a>
        </div>
        <div class="item">
            Tư vấn khách hàng
        </div>
</section>
<div class="news-page page">
    <div class="container page-container">

        <aside class="sidebar-aside">
            <div class="menu-side-box">
                <div class="box-head">
                    <div class="box-title">
                        <a href="#">Danh mục tư vấn</a>
                    </div>
                </div><!-- .box-head -->
                <div class="box-main">
                    <ul class="menu-list">
                            <li> <a href="#">Đồng hồ</a></li>
                            <li> <a href="#">Đồ dùng điện tử</a></li>
                            <li> <a href="#">Thời trang, Giày dép &amp; Trang sức</a></li>
                            <li> <a href="#">Chăm sóc sắc đẹp</a></li>
                            <li> <a href="#">Chăm sóc sức khỏe</a></li>
                            <li> <a href="#">Chăm sóc trẻ em</a></li>
                            <li> <a href="#">Đồ chơi trẻ em &amp; Trò chơi các loại</a></li>
                            <li> <a href="#">Sách</a></li>
                    </ul><!-- .menu-list -->
                </div><!-- .box-main -->
            </div><!-- .menu-side-box -->
        </aside><!-- sidebar-aside -->
        <div class="main-col">
            <section class="news-block js-news-block">
                <div class="block-main">
                    <div class="news-item first">
                        <a class="img" href="#" style="background-image:url('http://static.fado.vn/uploads/news/2017/01/09/thumbs/600x300_Fado.VN_1483936813.0755.jpeg')"></a>
                        <div class="text-wrap">
                            <div class="wrap-inner">
                                <div class="balance">
                                    <div class="title">
                                        <a href="http:#">Đặt mua camera hành trình xe máy chống nước tốt nhất hiện nay</a>
                                    </div>
                                    <div class="date">09/01/2017</div>
                                    <div class="text">
                                        Trong những năm gần đây, việc trang bị camera hành trình cho xe máy, xe ô tô để theo dõi lộ trình chuyến đi đã dần trở nên phổ biến hơn ở nước ta. Nhằm...                                            </div>
                                </div><!-- .balance -->

                                <div class="view-more">
                                    <a href="#">Xem thêm <i class="fa fa-angle-double-right"></i></a>
                                </div>
                            </div><!-- .wrap-inner -->
                        </div><!-- .text-wrap -->
                    </div><!-- .news-item -->
                    <div class="row row-15px">
                        <div class="col-xs-6">
                            <div class="news-item">
                                <a class="img" href="#" style="background-image:url('http://static.fado.vn/uploads/news/2016/12/02/thumbs/600x300_Fado.VN_1480667998.4791.jpg')"></a>

                                <div class="text-wrap">
                                    <div class="wrap-inner">
                                        <div class="balance" style="height: 149px;">
                                            <div class="title">
                                                <a href="#">Có nên mua điện thoại xách tay giá rẻ không?</a>
                                            </div>
                                            <div class="date">02/12/2016</div>
                                            <div class="text">
                                                Điện thoại xách tay luôn là mặt hàng có sức hút lớn và được nhiều khách hàng quan tâm tìm hiểu. Một trong những câu hỏi chúng được người tiêu dùng quan...
                                            </div>
                                        </div>
                                        <div class="view-more">
                                            <a href="#">Xem thêm <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div><!-- .wrap-inner -->
                                </div><!-- .text-wrap -->
                            </div><!-- .news-item -->
                        </div><!-- .col-xs-6 -->

                            <div class="col-xs-6">
                                <div class="news-item">
                                    <a class="img" href="#" style="background-image:url('http://static.fado.vn/uploads/news/2016/07/28/thumbs/600x300_Fado.VN_1469700718.2324.jpg')"></a>

                                    <div class="text-wrap">
                                        <div class="wrap-inner">
                                            <div class="balance" style="height: 149px;">
                                                <div class="title">
                                                    <a href="http://fado.vn/nhan-dat-mua-may-doc-sach-amazon-kindle-gia-re.n633/">Nhận đặt mua máy đọc sách amazon kindle giá rẻ</a>
                                                </div>
                                                <div class="date">28/07/2016</div>
                                                <div class="text">
                                                    Đọc sách luôn là một trong những sở thích tuyệt vời giúp bạn học thêm được những kiến thức hay cho mình. Nếu như những cuốn sách đã trở nên quá nhàm...
                                                </div>
                                            </div>
                                            <div class="view-more">
                                                <a href="#">Xem thêm <i class="fa fa-angle-double-right"></i></a>
                                            </div>
                                        </div><!-- .wrap-inner -->
                                    </div><!-- .text-wrap -->
                                </div><!-- .news-item -->
                            </div><!-- .col-xs-6 -->
                    </div>
                </div><!-- .block-main -->
                <div class="block-foot">
                    <div class="pagination-wrap">
                        <ul><li class="is-active"><a style="cursor:pointer;">1</a></li><li><a href="http://fado.vn/do-dung-dien-tu-36.2/">2</a></li><li><a href="http://fado.vn/do-dung-dien-tu-36.3/">3</a></li><li><a href="http://fado.vn/do-dung-dien-tu-36.4/">4</a></li><li><a href="http://fado.vn/do-dung-dien-tu-36.5/">5</a></li><li><a href="http://fado.vn/do-dung-dien-tu-36.2/"><i class="fa fa-angle-double-right"></i></a></li><li><a href="http://fado.vn/do-dung-dien-tu-36.5/"><i class="fa fa-angle-double-right"></i><i class="fa fa-angle-double-right"></i></a></li></ul>
                    </div>
                </div>

            </section><!-- .news-block -->
        </div><!-- main-col -->

        <div class="clearfix"></div>
    </div><!-- .container .page-container -->
</div>
@endsection