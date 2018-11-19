@extends('layouts/user/master')

@section('title')

@endsection

@section('css')
<style>

    .success {
        color: green;
    }
</style>
@endsection

@section('js')
<script src="{{ URL::asset('js/web/happy_code/order_happy_code.js') }}" type="text/javascript"></script>
<script>

    OrderHappyCode.init();

    $(document).ready(function() {

        $(document).on('change', '#happy_code_type', function () {

            current_price_happy_code = $(this).find(':selected').attr('data-price');
            $('#happy_code_price').text(current_price_happy_code);
            $('#happy_code_price').attr('data-price', current_price_happy_code);

        });
    });

</script>
@endsection

@section('content')
<section class="breadcrumb-block">
    <div class="container">
        <div class="item">
            <a href="#">Trang chủ</a>
        </div>
        <div class="item">
            <a href="#">Quản lý mua hàng</a>
        </div>
        <div class="item">
            Happy code
        </div>
</section>
<div class="favorite-product-page page">
    <div class="container page-container">

        @include('layouts.user.aside_user')

        <div class="main-col">
            <section class="favorite-product-block block-1">
                <div class="block-head">
                    <div class="block-title">{{ Lang::get('happy-code.happy_code_title') }}</div>
                </div><!-- .block-head -->

                <div class="block-main">
                    @if(Session::get('message')!='' && Session::get('message')!=null)
                    <div class="{{ (Session::get('message')['meta']['code'] == 200) ? 'success' : 'error' }}">
                        <h4> {{ Session::get('message')['meta']['msg'][0] }} </h4>
                    </div>
                    @endif

                    <form action="{{ URL::Route('web-post-register-happy-code') }}" method="POST" id="form-order-happy-code">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <table class="table ">
                            <tr>
                                <th>{{ Lang::get('happy-code.payment') }}</th>
                                <td>
                                    <select class="form-control input-medium" name="payment_type">
                                        <option value="1">Chuyển khoản</option>
                                        <option value="2">Thanh toán tại công ty Sumo shipping</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ Lang::get('happy-code.type') }}</th>
                                <td>
                                    <select class="form-control input-medium" name="happy_code_type" id="happy_code_type">
                                    <option value="">-- Hãy chọn loại Happy code --</option>
                                    <!-- @if( isset($happy_code_type['data']['response']) )
                                        @foreach($happy_code_type['data']['response'] as $key => $item)
                                            <option class="happy_code_type" value="{{ $item->id }}" data-price="{{ $item->price }}" >{{ $item->title }}</option>
                                        @endforeach
                                    @endif -->
                                    @foreach( Config::get('spr.system.happy_code_type') as $key => $value )
                                    <option class="happy_code_type" value="{{ $key }}" data-price="{{ $value['price'] }}">{{ Lang::get('happy_code_type.' .  $value['title']) }}</option>
                                    @endforeach
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>{{ Lang::get('happy-code.price') }}</th>
                                <td>
                                    <span id="happy_code_price" class="format-currency" data-value="0" data-decimals="0">
                                        <sup>đ</sup>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input type="submit" class="btn btn-success" value="{{ Lang::get('button.form.register.text') }}">
                                    <a href="{{ URL::Route('web-get-homePage') }}" class="btn btn-warning">{{ Lang::get('button.form.back_to_homepage.text') }}</a>
                                </td>
                            </tr>
                        </table>
                    </form>


                    <table class="order-tb table-2 table-2-striped">
                        <thead>
                            <tr>
                                <th>{{ Lang::get('happy-code.type') }}</th>
                                <th>{{ Lang::get('happy-code.status') }}</th>
                                <th>{{ Lang::get('happy-code.registed_date') }}</th>
                                <th>{{ Lang::get('happy-code.effective_date') }}</th>
                                <th>{{ Lang::get('happy-code.expired_date') }}</th>
                                <th>{{ Lang::get('happy-code.code') }}</th>
                            </tr>
                        </thead>
                            <tbody>
                                @if(isset($data))
                                    @foreach($data['data']['response'] as $key => $item)
                                    <tr>
                                        <td style="">
                                            <span class="text-blue font-weight-600">{{ $item->happy_code_type }}</span>
                                        </td>
                                        <td style=";">
                                            <span style="color:red;">{{ ($item->status == 0) ? Lang::get('happy-code.pending') : Lang::get('happy-code.processed') }}</span>
                                        </td>
                                        <td class="time">
                                            {{ isset($item->created_at) ? gmdate("d-m-Y", $item->created_at) : '' }}
                                        </td>
                                        <td class="time">
                                            {{ isset($item->effective_at) ? gmdate("d-m-Y h:i:s", $item->effective_at) : '' }}
                                        </td>
                                        <td class="time">

                                        </td>
                                        <td class="code">
                                            {{ isset($item->code) ? $item->code : '' }}
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                </div><!-- .block-main -->
            </section><!-- .block-1 -->
        </div>
    </div><!-- .container .page-container -->
</div>

@endsection