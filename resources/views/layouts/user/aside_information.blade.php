<aside class="sidebar-aside">


<div class="menu-side-box">
    <div class="box-head">
        <div class="box-title">
            <a href="#">Về Sumoshipping</a>
        </div>
    </div>
    <div class="box-main">
        <ul class="menu-list">
            <li><a href="{{ URL::Route('web-get-introduce') }}">Giới thiệu về Sumoshipping</a></li>
            <li><a href="{{ URL::Route('web-get-frequently-asked-questions') }}">Câu hỏi thường gặp</a></li>
        </ul>
    </div>
</div>

@if( isset($data_aside_user_information) )
    @foreach( $data_aside_user_information['category']['response'] as $k_cate => $item_cate )
        <div class="menu-side-box">
            <div class="box-head">
                <div class="box-title">
                    <a href="#">{{ $item_cate->name }}</a>
                </div>
            </div>
            <div class="box-main">
                <ul class="menu-list">
                @foreach( $data_aside_user_information['news']['response'] as $k_news => $item_news )
                    @if( $item_news->category_id == $item_cate->id )
                    <li> <a href="{{ URL::Route('web-get-news-detail', ['post_id' => $item_news->id ]) }}">{{ $item_news->title }}</a></li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>
    @endforeach
@endif

    <!-- <div class="menu-side-box">
        <div class="box-head">
            <div class="box-title">
                <a href="#">Về Sumoshipping</a>
            </div>
        </div>
        <div class="box-main">
            <ul class="menu-list">
                <li> <a href="{{ URL::Route('web-get-news') }}">Tin tức/Sự kiện</a></li>
                <li> <a href="{{ URL::route('web-get-customer-feedback') }}">Ý kiến khách hàng</a></li>
            </ul>
        </div>
    </div> -->
</aside>