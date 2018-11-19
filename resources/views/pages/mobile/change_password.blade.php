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
                <span class="title">Thay đổi mật khẩu</span>
            </a>
        </div>
    </div><!-- .block-head -->
</section>

@include('layouts.mobile.dropdown_block')

<section class="change-pass-block dropdown-block js-dropdown-block is-expand">
    <div class="block-head">
        <div class="block-title">Thay đổi mật khẩu</div>
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
            <div class="control-group">
                <input type="password" name="old_password" class="form-control" placeholder="{{ Lang::get('change_password.old_password') }}" value="">
            </div>

            <div class="control-group">
                <input type="password" name="new_password" class="form-control" placeholder="{{ Lang::get('change_password.new_password') }}" value="">
            </div>

            <div class="control-group">
                <input type="password" name="new_password_retype" class="form-control" placeholder="{{ Lang::get('change_password.new_password_retype') }}">
            </div>

            <div class="btn-wrap">
                <div class="row row-5px">
                    <div class="col-xs-6">
                        <a href="{{ URL::Route('web-get-homePage') }}" class="btn btn-default btn-block">{{ Lang::get('button.form.cancel.text') }}</a>
                    </div>

                    <div class="col-xs-6">
                        <input type="submit" class="btn btn-danger btn-block" value="{{ Lang::get('button.form.update.text') }}">
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection