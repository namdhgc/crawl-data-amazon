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
            Thay đổi mật khẩu
        </div>
</section>
<div class="favorite-product-page page">
    <div class="container page-container">

        @include('layouts.user.aside_user')

        <div class="main-col">
            <section class="favorite-product-block block-1">
                <div class="block-head">
                    <div class="block-title">{{ Lang::get('change_password.change_password') }}</div>
                </div>

                <div class="block-main">
                    @if(Session::get('message')!='' && Session::get('message')!=null)
                    <div class="{{ (Session::get('message')['meta']['code'] == 200) ? 'success' : 'error' }}">
                        <h4> {{ Session::get('message')['meta']['msg'][0] }} </h4>
                    </div>
                    @endif

                    <form action="{{ URL::Route('web-post-change-user-information') }}" method="POST">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <input type="hidden" name="type" value="change_password">
                        <table class="table ">
                            <tr>
                                <th>{{ Lang::get('change_password.old_password') }}</th>
                                <td>
                                    <input type="password" class="form-control input-medium" name="old_password">
                                </td>
                            </tr>
                            <tr>
                                <th>{{ Lang::get('change_password.new_password') }}</th>
                                <td>
                                    <input type="password" class="form-control input-medium" name="new_password">
                                </td>
                            </tr>
                            <tr>
                                <th>{{ Lang::get('change_password.new_password_retype') }}</th>
                                <td>
                                    <input type="password" class="form-control input-medium" name="new_password_retype">
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input type="submit" class="btn btn-success" value="{{ Lang::get('button.form.update.text') }}">
                                    <a href="{{ URL::Route('web-get-homePage') }}" class="btn btn-warning">{{ Lang::get('button.form.cancel.text') }}</a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div><!-- .block-main -->
            </section><!-- .block-1 -->
        </div>
    </div><!-- .container .page-container -->
</div>

@endsection