@extends('layouts/mobile/master')


@section('title')
@endsection


@section('css')
@endsection


@section('js')
@endsection


@section('content')
<section class="breadcrumb-block js-breadcrumb-block">
    <div class="block-head">
        <div class="block-title">
            <a href="#">
                <span class="icon"><i class="fa fa-long-arrow-left"></i></span>
                <h1 class="title">Tin Tức</h1>
            </a>
        </div>
    </div>
</section>

<section class="news-block">
    <div class="block-main">
        <div class="row">                            
            <!-- <div class="col-sm-6">
                <div class="news-item">
                    <a class="img" href="http://fado.vn/nhung-trang-mua-hang-online-o-my-uy-tin-nhat.n1201/" style="background-image:url('http://static.fado.vn/uploads/news/2017/07/05/thumbs/600x300_Fado.VN_1499241701.6819.jpg')"></a>

                    <div class="text-wrap">
                        <div class="wrap-inner">
                            <div class="balance">
                                <div class="title">
                                    <a href="http://fado.vn/nhung-trang-mua-hang-online-o-my-uy-tin-nhat.n1201/">Những trang mua hàng online ở Mỹ uy tín nhất</a>
                                </div>
                                <div class="date">05/07/2017</div>
                                <div class="text">
                                    Tìm kiếm những trang mua hàng online ở Mỹ uy tín nhất luôn được xem là nhu cầu chính đáng của không ít người tiêu dùng hiện nay bởi hơn hết ngoài sự thống...                                        </div>
                            </div>
                            <div class="view-more">
                                <a href="http://fado.vn/nhung-trang-mua-hang-online-o-my-uy-tin-nhat.n1201/">Xem thêm <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --> 
            @if(isset($data))
                @foreach($data['data']['response'] as $key => $item)
                <div class="col-sm-6">
                    <div class="news-item">
                        <a class="img" href="{{ URL::Route('web-get-news-detail', ['post_id' => $item->id ]) }}" style="background-image:url({{ URL::asset($item->path) }})"></a>

                        <div class="text-wrap">
                            <div class="wrap-inner">
                                <div class="balance">
                                    <div class="title">
                                        <a href="{{ URL::Route('web-get-news-detail', ['post_id' => $item->id ]) }}">{{ $item->title }}</a>
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
    </div>

    <div class="block-foot">
        <div class="pagination-wrap">
            <!-- <input type="number" class="page-input" value="1" min="1"><a href="http://fado.vn/tin-tuc.c4.2/">Trang sau <i class="fa fa-angle-right"></i></a> -->
        </div>
    </div>
</section>

@endsection