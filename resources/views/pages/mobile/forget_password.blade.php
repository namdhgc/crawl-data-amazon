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
                <h1 class="title">Lấy lại mật khẩu</h1>
            </a>
        </div>
    </div>
</section>

<section class="request-pass-block">
    <div class="block-main">
        <form action="{{ URL::Route('web-post-reset-password') }}" method="POST" class="request-pass-form">
          	<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="control-group">
                <input type="text" name="username" class="form-control" placeholder="Tên đăng nhập">
            </div>
            <div class="btn-wrap">
                <div class="row row-5px">
                    <div class="col-xs-6">
                        <button class="btn btn-default btn-block" type="reset">Nhập lại</button>
                    </div>

                    <div class="col-xs-6">
                        <button class="btn btn-danger btn-block" id="bt-request-pass" type="submit"><i class="fa"></i> Hoàn tất</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection