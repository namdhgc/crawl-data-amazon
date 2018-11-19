@extends('layouts/user/master')

@section('title')
@endsection

@section('css')
@endsection

@section('js')
<script src="{{ URL::asset('fado/js/faqs-block.js') }}" type="text/javascript"></script>

@endsection

@section('content')
<section class="breadcrumb-block">
    <div class="container">
        <div class="item">
            <a href="#">Trang chủ</a>
        </div>
        <div class="item">
            Câu hỏi thường gặp
        </div>
    </div>
</section>

<div class="faqs-page page">
    <div class="container page-container">
        @include('layouts.user.aside_information')

        <div class="main-col">
            <section class="faqs-block js-faqs-block">
                <?php $i = 0; ?>
                @if(isset($data))
                    @foreach($data['data']['response'] as $key => $item)
                    <?php $i++; ?>
                    <div class="faq-box">
                        <div class="box-head">
                            <div class="icon">
                                <i class="fa">{{ $i }}</i>
                            </div>
                            <div class="text">
                                {{ $item->question  }}
                            </div>
                        </div><!-- .box-head -->

                        <div class="box-main" style="display: none;">
                            <p>{{ $item->answer }}</p>
                        </div>
                    </div>
                    @endforeach
                @endif
            </section>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

@endsection