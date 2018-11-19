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
    </div>
</section>



@include('layouts.mobile.dropdown_block')

<section class="user-profile-block dropdown-block js-dropdown-block is-expand">
    <div class="block-head">
        <div class="block-title">Thông tin cá nhân</div>
    </div>
    <div class="block-main">

        @if(Session::get('message')!='' && Session::get('message')!=null)
        <div class="{{ (Session::get('message')['meta']['code'] == 200) ? 'success' : 'error' }}">
            <h4> {{ Session::get('message')['meta']['msg'][0] }} </h4>
        </div>
        @endif

        <form action="{{ URL::Route('web-post-change-user-information') }}" method="POST">
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <input type="hidden" name="type" value="user_information">

            @if(isset($data))
                @foreach($data['data'] as $key => $item)
                <div class="control-group">
                    <input type="text" name="first_name" class="form-control" placeholder="{{ Lang::get('user_information.first_name') }}" value="{{ $item->first_name }}">
                </div>

                <div class="control-group">
                    <input type="text" name="last_name" class="form-control" placeholder="{{ Lang::get('user_information.last_name') }}" value="{{ $item->last_name }}">
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
                @endforeach
            @endif
        </form>
    </div>
</section>

@endsection