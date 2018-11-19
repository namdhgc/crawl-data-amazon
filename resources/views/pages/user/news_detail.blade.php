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
            <a href="{{ URL::Route('web-get-homePage') }}">Trang chủ</a>
        </div>
        <div class="item">
            <a href="{{ URL::Route('web-get-news') }}">Tin tức</a>
        </div>
    </div>
</section>

<div class="news-detail-page page">
    <div class="container page-container">
        <div class="main-col">
            <section class="news-detail-block">
                @if(isset($data))
                    @foreach($data['data']['response'] as $key => $item)
                    <div class="block-head">
                        <h1 class="block-title">{{ $item->title }}</h1>
                        <div class="date">
                            {{ gmdate("Y-m-d", $item->created_at) }}                 
                        </div>
                        <div class="text">                   
                        </div>
                    </div>
                    <!-- .block-head -->
                    <div class="block-main">
                        <div class="news-detail-content editor-content">
                            <div style="text-align:justify;">
                                <?php echo $item->description; ?>
                            </div>
                            
                        </div>
                        <!-- .news-detail-content -->
                        <!-- <div class="share-wrap">
                            Chia sẻ:
                            <a href="javascript:;" onclick="socialPopup('#')"><i class="fa fa-facebook"></i></a>
                            <a href="javascript:;" onclick="socialPopup('#')"><i class="fa fa-google-plus"></i></a>
                            <a href="javascript:;" onclick="socialPopup('#')"><i class="fa fa-twitter"></i></a>
                        </div> -->
                        <!-- .share-wrap -->
                        <div class="related-news-wrap">
                            <div class="wrap-title">Bài viết liên quan</div>
                            <ul class="list">
                                <li>
                                    <a href="#" title="Prime day là ngày gì? Cùng Fado mua hàng sale trên Amazon">Prime day là ngày gì? Cùng Sumoshipping mua hàng sale trên Amazon</a>
                                </li>
                            </ul>
                        </div>
                        <!-- .block-main -->
                        <div class="related-news-wrap">
                            <div class="wrap-title">Bài viết mới</div>
                            <ul class="list">
                                <li>
                                    <a href="#" title="Prime day là ngày gì? Cùng Fado mua hàng sale trên Amazon">Prime day là ngày gì? Cùng Sumoshippng mua hàng sale trên Amazon</a>
                                </li>
                            </ul>
                        </div>
                        <!-- .block-main -->
                    </div>
                    @endforeach
                @endif
            </section>
            <!-- .news-detail-block -->
        </div>
        <!-- .main-col -->
        <aside class="user-aside-v1">
            
        </aside>

        @include('layouts.user.aside_information')

        <!-- .user-aside-v1 -->        
        <div class="clearfix"></div>
    </div>
    <!-- .container .page-container -->
</div>
@endsection