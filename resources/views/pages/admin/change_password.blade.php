@extends('layouts/admin/master')

@section('title')
	<title>{{ Lang::get('menu.change-password') }}</title>
@endsection

@section('css')
<style>
    /*.success {
        color: green;
    }

    .error {
        color: red;
    }*/
</style>
@endsection

@section('js')
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="portlet light bordered">

            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Thay đổi mật khẩu</span>
                </div>
                <div class="actions">
                    <div class="btn-group">
                    </div>
                </div>
            </div>
            <div class="portlet-body form">

                @if(Session::get('message')!='' && Session::get('message')!=null)
                <div class="alert {{ (Session::get('message')['meta']['code'] == 200) ? 'alert-success' : 'alert-danger' }}">
                    <h4> {{ Session::get('message')['meta']['msg'][0] }} </h4>
                </div>
                @endif

                <form role="form" action="{{ URL::Route('auth-post-change-admin-password') }}" method="POST">
                    <div class="form-body">
                        <div class="form-group">
                            <label for="">Mật khẩu cũ</label>
                            <div class="input-group">
                                <input type="password" name="old_password" class="form-control" id="" placeholder="Mật khẩu cũ">
                                <span class="input-group-addon">
                                    <i class="fa fa-key font-red"></i>
                                </span>
                            </div>
                        </div><div class="form-group">
                            <label for="">Mật khẩu mới</label>
                            <div class="input-group">
                                <input type="password" name="new_password" class="form-control" id="" placeholder="Mật khẩu mới">
                                <span class="input-group-addon">
                                    <i class="fa fa-key font-red"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Nhập lại mật khẩu mới</label>
                            <div class="input-group">
                                <input type="password" name="new_password_retype" class="form-control" id="" placeholder="Nhập lại mật khẩu mới">
                                <span class="input-group-addon">
                                    <i class="fa fa-key font-red"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn blue">Xác nhận</button>
                        <button type="button" class="btn default btn-cancel">Huỷ</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
@endsection