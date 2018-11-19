@extends('layouts/user/master')

@section('title')
@endsection

@section('css')
@endsection

@section('js')
    <script src="{{ URL::asset('fado/js/quotation.js') }}" ></script>
    <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/price_request/price_request.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        PriceRequest.init();
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            QuotationDesktop.worldWideQuotation();
        });
    </script>
@endsection

@section('content')
<section class="breadcrumb-block">
    <div class="container">
        <div class="item">
            <a href="{{ URL::Route('web-get-homePage') }}">Trang chủ</a>
        </div>
        <div class="item">
            Yêu cầu báo giá
        </div>
    </div><!-- .container -->
</section>

<div class="request-quotation-page page">
    <div class="container page-container">
        <section class="steps-rq-quotation-block">
            <div class="step-item">
                <div class="title">Bước 1</div>
                <img class="dots" src="http://static.fado.vn/f/desktop/v1/images/img-dots-step.png" alt="">
                <div class="text">
                    Bạn cần nhập link chi tiết<br>SP cần mua
                </div>
            </div><!-- .step-item -->

            <div class="step-item">
                <div class="title">Bước 2</div>
                <img class="dots" src="http://static.fado.vn/f/desktop/v1/images/img-dots-step.png" alt="">
                <div class="text">
                    Điền thông tin của bạn và<br>gửi cho chúng tôi
                </div>
            </div><!-- .step-item -->

            <div class="step-item">
                <div class="title">Bước 3</div>
                <img class="dots" src="http://static.fado.vn/f/desktop/v1/images/img-dots-step.png" alt="">
                <div class="text">
                    Chúng tôi sẽ gửi báo giá ngay<br>trong 10 phút
                </div>
            </div><!-- .step-item -->
        </section><!-- .steps-rq-quotation-block -->




        @if(Session::has('data') )
        <div class="{{ (Session::get('data')['meta']['success'] == true) ? 'alert alert-success' : 'alert alert-danger' }}">
            <strong>{{ (Session::get('data')['meta']['success'] == true) ? 'Success' : 'Error' }}</strong>

            @foreach (Session::get('data')['meta']['msg'] as $key => $value)
                <p>{{ $value }}</p>
            @endforeach
        </div>
        @endif

        <section class="request-quotation-block js-request-quotation-block">

            <form class="request-quotation-form" id="price-request-form" action="{{ URL::Route('web-post-new-price-request') }}" method="POST">
                <div class="form-wrap">
                    <div class="wrap-head">
                        <div class="wrap-title"><span>1</span> Vui lòng cho chúng tôi biết thông tin sản phẩm bạn muốn mua !</div>
                    </div>

                    <div class="wrap-main">
                        <div class="link-group">
                            <div class="group-item link-item">
                                <div class="lbl">*</div>
                                <div class="input form-group form-md-line-input">
                                    <input type="text" name="link[]" id="link" placeholder="Đường dẫn sản phẩm bạn muốn mua" class="form-control-1" required>
                                </div>
                            </div>
                        </div>

                        <div class="group-item">
                            <div class="lbl">*</div>
                            <div class="input form-group form-md-line-input">
                                <textarea class="form-control-1" rows="5" name="message" id="message" placeholder="Bạn vui lòng cho chúng tôi biết thêm thông tin về sản phẩm như size, màu sắc, số lượng, option...."></textarea>
                            </div>
                        </div><!-- .group-item -->

                        <button class="add-product-btn" type="button"><i class="fa fa-plus"></i>Thêm link</button>
                    </div><!--.wrap-main -->
                </div><!-- .form-wrap -->

                <div class="form-wrap">
                    <div class="wrap-head">
                        <div class="wrap-title"><span>2</span> Thông tin liên hệ</div>
                        {{ csrf_field() }}
                    </div>

                    <div class="wrap-main">
                        <div class="row row-10px">
                        
                            <div class="col-md-4">
                                <div class="group-item">
                                    <div class="lbl">*</div>
                                    <div class="input form-group form-md-line-input">
                                        <input type="text" name="fullName" id="fullName" placeholder="Họ và tên" class="form-control-1" required value="">
                                    </div>
                                </div><!-- .group-item -->
                            </div>

                            <div class="col-md-4">
                                <div class="group-item">
                                    <div class="lbl">*</div>
                                    <div class="input form-group form-md-line-input">
                                        <input type="text" name="phone" id="phone" placeholder="Số điện thoại" class="form-control-1" required value="">
                                    </div>
                                </div><!-- .group-item -->
                            </div>

                            <div class="col-xs-4">
                                <div class="group-item">
                                    <div class="lbl">*</div>
                                    <div class="input form-group form-md-line-input">
                                        <input type="email" name="email" id="email" placeholder="Email liên hệ" class="form-control-1" required value="">
                                    </div>
                                </div><!-- .group-item -->
                            </div>
                            <div class="col-md-12">
                                <div class="group-item">
                                    <div class="lbl">*</div>
                                    <div class="input form-group form-md-line-input">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="g-recaptcha" data-sitekey="6LccdiUUAAAAAE0n2pSzf4gH74s8GfPbObb7IjzV"></div>
                                                <input type="hidden" class="hiddenRecaptcha" name="hiddenRecaptcha" id="hiddenRecaptcha">

                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .group-item -->
                            </div>
                        </div><!-- .row -->

                        <div class="note-text"><span>(*)</span> Chúng tôi sẽ không tiết lộ thông tin của bạn cho bất kỳ bên thứ ba</div>
                        <div class="text-center">
                            <button type="submit" id="btnSendRequest" class="btn btn-danger btn-lg">Gửi yêu cầu</button>
                        </div>
                    </div><!--.wrap-main -->
                </div><!-- .form-wrap -->
            </form><!-- .request-quotation-form -->
        </section><!-- .request-quotation-block -->
    </div><!-- .page-container -->
</div>
@endsection


