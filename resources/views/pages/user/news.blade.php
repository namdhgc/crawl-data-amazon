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
            Tin tức/sự kiện
        </div>
</section>

<div class="news-page page">
    <div class="container page-container">
        <div class="main-col">
            <section class="news-block js-news-block">
                <div class="block-main">
                    <div class="row row-15px">
                    @if(isset($data))
                        @foreach($data['data']['response'] as $key => $item)
                        <div class="col-xs-6">
                            <div class="news-item">
                                <a class="img" href="{{ URL::Route('web-get-news-detail', ['post_id' => $item->id ]) }}" style="background-image:url({{ URL::asset($item->path) }})"></a>

                                <div class="text-wrap">
                                    <div class="wrap-inner">
                                        <div class="balance" style="height: 149px;">
                                            <div class="title">
                                                <a href="{{ URL::Route('web-get-news-detail', ['post_id' => $item->id ]) }}">
                                                    {{ $item->title }}
                                                </a>
                                            </div>
                                            <div class="date">{{ gmdate("Y-m-d", $item->created_at) }}</div>
                                            <div class="text">
                                                {{ $item->sub_description }}
                                            </div>
                                        </div>
                                        <div class="view-more">
                                            <a href="{{ URL::Route('web-get-news-detail', ['post_id' => $item->id ]) }}">Xem thêm <i class="fa fa-angle-double-right"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    </div>
                </div><!-- .block-main -->
                <div class="block-foot">
                    <!-- <div class="pagination-wrap">
                        <ul><li class="is-active"><a style="cursor:pointer;">1</a></li><li><a href="http://fado.vn/tin-tuc.c4.2/">2</a></li><li><a href="http://fado.vn/tin-tuc.c4.3/">3</a></li><li><a href="http://fado.vn/tin-tuc.c4.4/">4</a></li><li><a href="http://fado.vn/tin-tuc.c4.5/">5</a></li><li><a href="http://fado.vn/tin-tuc.c4.6/">6</a></li><li><a href="http://fado.vn/tin-tuc.c4.7/">7</a></li><li><a href="http://fado.vn/tin-tuc.c4.8/">8</a></li><li><a href="http://fado.vn/tin-tuc.c4.9/">9</a></li><li><a href="http://fado.vn/tin-tuc.c4.10/">10</a></li><li><a href="http://fado.vn/tin-tuc.c4.2/"><i class="fa fa-angle-double-right"></i></a></li><li><a href="http://fado.vn/tin-tuc.c4.11/"><i class="fa fa-angle-double-right"></i><i class="fa fa-angle-double-right"></i></a></li></ul>
                    </div> -->
                </div>
            </section><!-- .news-block -->
        </div><!-- main-col -->

        @include('layouts.user.aside_information')

        <div class="clearfix"></div>
    </div><!-- .container .page-container -->
</div>
@endsection