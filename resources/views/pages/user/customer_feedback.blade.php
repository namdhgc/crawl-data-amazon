@extends('layouts/user/master')

@section('title')
@endsection

@section('css')
<link href="{{ URL::asset('fado/css/all_fado.css') }}" media="screen" rel="stylesheet" type="text/css">
@endsection

@section('js')

<script src="{{ URL::asset('fado/js/faqs-block.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/web/customer_feedback/customer-feedback.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    CustomerFeedback.init();
</script>
 <?php
    $msg = null;
    (Session::get('msg')!=null) ? $msg = Session::get('msg'):'';
?>

@if($msg != null)
<script type="text/javascript">
    $(document).ready(function(){
        var msg     =  "<?php echo $msg;?>"
        CustomerFeedback.response_feedback(msg);
    });
</script>
@endif
@endsection

@section('content')
<section class="breadcrumb-block">
<div class="container">
        <div class="item">
            <a href="/">Trang chủ</a>
        </div>
        <div class="item"><a href="{{ URL::Route('web-get-customer-feedback') }}">Nhận xét khách hàng</a> </div>
        <div class="item">Đánh giá phản hồi</div>
    </div>
</section>

<div class="faqs-page page">
    <div class="container page-container">

        @include('layouts.user.aside_information')

        <div class="main-col">
            <section class="feedback-banner-block"><img src="http://static.fado.vn/f/desktop/v1/images/feedback-banner.png" alt=""></section>
            <section id="feedback-form-block" class="feedback-form-block">
            <div class="block-head">
                <div class="block-title">Phản hồi của khách hàng</div>
            </div>
            <div class="block-main">
                @if($errors->any())
                <h4 style="color: red">
                    @foreach ($errors->all() as $key => $value)
                      <div>{{ $value }}</div>
                    @endforeach
                  </h4>
                @endif
                <form class="feedback-form comment-form" id="customer-feedback" action="{{ URL::Route('web-post-customer-feedback') }}" method="POST" novalidate="novalidate">
                    <div class="row row-10px">
                        <div class="col-xs-6">
                            <div class="form-group @if($errors->has('description')) has-error @endif">
                                <textarea rows="5" id="description" name="description" class="form-control content-input" placeholder="Quý khách vui lòng gửi thắc mắc tại đây để dịch vụ của chúng tôi phục vụ quý khách tốt hơn nữa">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" placeholder="Họ và tên">
                            </div>

                            <div class="form-group @if($errors->has('email')) has-error @endif">
                                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Email" >
                            </div>
                            <div class="form-group @if($errors->has('phone_number')) has-error @endif">
                                <input type="phone_number" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="form-control" placeholder="Số điện thoại" >
                            </div>
                            <div class="form-group">
                                <div class="g-recaptcha" data-sitekey="6LccdiUUAAAAAE0n2pSzf4gH74s8GfPbObb7IjzV"></div>
                                <input type="hidden" class="hiddenRecaptcha" name="hiddenRecaptcha" id="hiddenRecaptcha">
                            </div>
                        </div><!-- .col-xs-6 -->
                    </div><!-- .row -->
                    <div class="btn-wrap">
                        <button type="submit" class="btn submit-btn btn-danger">Gửi phản hồi</button>
                    </div>
                </form><!-- .feedback-form -->
            </div><!-- .block-main -->
            </section>
            <section class="feedback-block js-feedback-block">
            <div class="block-head">
                <div class="block-title">Phản hồi hàng đầu</div>
            </div>
            <div class="block-main">
                <div class="row row-15px feedback-panel-wrap">
                    @if(isset($data))
                        @foreach($data['data']['response'] as $key => $item)
                        <div class="col-xs-6 feedback-panel-outer">
                            <div class="feedback-panel">
                                <div class="avatar-img"><img src="http://static.fado.vn/f/desktop/v1/images/feedback-avatar.png" alt=""></div>
                                <div class="info-pane">
                                  <div class="content-field">
                                    <div class="field-inner">{{ $item->description }}</div>
                                  </div>
                                  <div class="expand-btn">+ Hiện nội dung</div>

                                  <div class="title-field">
                                    <span class="name">{{ $item->customer_name }}</span> -
                                    <span class="address">{{ $item->email }}</span>
                                  </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div><!-- .row -->
            </div><!-- .block-main -->
            <div class="block-foot">
                <div class="pagination-wrap">
                    {!! Spr\Base\Controllers\Views\DataTable::paginate($data); !!}
                </div><!-- .pagination-wrap -->
            </div><!-- .block-foot -->
        </section>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@endsection