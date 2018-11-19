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
<script src="{{ URL::asset('assets/web/scripts/detail-product.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('fado/js/user.js') }}" type="text/javascript"></script>
<script>
    DetailProduct.favoriteProduct();
</script>
@endsection

@section('content')
<section class="breadcrumb-block">
    <div class="container">
        <div class="item">
            <a href="#">Trang chủ</a>
        </div>
        <div class="item">
            <a href="#">Thành viên</a>
        </div>
        <div class="item">
            Thông tin cá nhân
        </div>
</section>
<div class="favorite-product-page page">
    <div class="container page-container">

        @include('layouts.user.aside_user')

        <div class="main-col">
            <section class="favorite-product-block block-1">
                <div class="block-head">
                    <div class="block-title">{{ Lang::get('user_information.user_information') }}</div>
                </div><!-- .block-head -->
                <div class="block-main">
                    @if(Session::get('message')!='' && Session::get('message')!=null)
                    <div class="{{ (Session::get('message')['meta']['code'] == 200) ? 'success' : 'error' }}">
                        <h4> {{ Session::get('message')['meta']['msg'][0] }} </h4>
                    </div>
                    @endif
                    <form action="{{ URL::Route('web-post-change-user-information') }}" method="POST">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <input type="hidden" name="type" value="user_information">
                        <table class="table ">
                        @if(isset($data))
                            @foreach($data['data'] as $key => $item)
                            <tr>
                                <th>{{ Lang::get('user_information.first_name') }}</th>
                                <td>
                                    <input type="text" class="form-control input-medium" name="first_name" value="{{ $item->first_name }}">
                                </td>
                            </tr>
                            <tr>
                                <th>{{ Lang::get('user_information.last_name') }}</th>
                                <td>
                                    <input type="text" class="form-control input-medium" name="last_name" value="{{ $item->last_name }}">
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input type="submit" class="btn btn-success" value="{{ Lang::get('button.form.update.text') }}">
                                    <a href="{{ URL::Route('web-get-homePage') }}" class="btn btn-warning">{{ Lang::get('button.form.cancel.text') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </table>
                    </form>
                </div><!-- .block-main -->
            </section><!-- .block-1 -->
        </div>
    </div><!-- .container .page-container -->
</div>

@endsection