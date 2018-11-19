@extends('layouts/admin/master')

@section('title')
	<title>{{ Lang::get('menu.register-user') }}</title>
@endsection

@section('css')
    <style type="text/css" >

        th.sorting*>a {
            display: block;
            width: 100%;
        }
        th.un-sort>a, th.sorting>a, th.sorting_asc>a, th.sorting_desc>a {
            text-decoration: none;
            color: black;
        }
        th.un-sort>a:hover, th.un-sort>a:focus,th.sorting>a:hover, th.sorting>a:focus, th.sorting_asc>a:hover, th.sorting_asc>a:focus, th.sorting_desc>a:hover, th.sorting_desc>a:focus{
            color: black;
        }
        th>a>p {
            margin: 0px !important;
        }
    </style>
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
	<script src="{{ URL::asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/datatables.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('assets/pages/scripts/table-datatables-managed.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/permission/user.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        User.init();
    </script>
@endsection


@section('content')
	<div class="row">
        <div class="col-md-12">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">{{ Lang::get('user.form_register_user') }}</span>
                    </div>
                    <div class="actions">
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="{{ URL::Route('auth-post-register-user') }}" class="form-edit" id="form-action-register-user" enctype="multipart/form-data" method="POST">
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="">

                        <div class="form-body">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="username" name="username">
                                <label for="username">{{ Lang::get('user.username') }}</label>
                                <span class="help-block">{{ Lang::get('user.help_username') }}</span>
                            </div>
                            <div class="form-group form-md-line-input ">
                                <textarea class="form-control" id="email" name="email"></textarea>
                                <label for="email">{{ Lang::get('user.email') }}</label>
                                <span class="help-block">{{ Lang::get('user.help_email') }}</span>
                            </div>
                            <div class="form-group form-md-line-input ">
                                <textarea class="form-control" id="password" name="password" rows="2"></textarea>
                                <label for="password">{{ Lang::get('user.password') }}</label>
                                <span class="help-block">{{ Lang::get('user.help_password') }}</span>
                            </div>
                            <div class="form-group form-md-line-input ">
                                <textarea class="form-control" id="first_name" name="first_name" rows="2"></textarea>
                                <label for="first_name">{{ Lang::get('user.first_name') }}</label>
                                <span class="help-block">{{ Lang::get('user.help_first_name') }}</span>
                            </div>
                            <div class="form-group form-md-line-input ">
                                <textarea class="form-control" id="last_name" name="last_name" rows="2"></textarea>
                                <label for="last_name">{{ Lang::get('user.last_name') }}</label>
                                <span class="help-block">{{ Lang::get('user.help_last_name') }}</span>
                            </div>
                            <div class="form-group form-md-line-input ">
                                <textarea class="form-control" id="name_kana" name="name_kana" rows="2"></textarea>
                                <label for="name_kana">{{ Lang::get('user.name_kana') }}</label>
                                <span class="help-block">{{ Lang::get('user.help_name_kana') }}</span>
                            </div>
                            <div class="form-group form-md-line-input ">
                                <textarea class="form-control" id="phone_number" name="phone_number" rows="2"></textarea>
                                <label for="phone_number">{{ Lang::get('user.phone_number') }}</label>
                                <span class="help-block">{{ Lang::get('user.help_phone_number') }}</span>
                            </div>
                            <div class="form-group form-md-line-input ">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div>
                                        <label for="avatar">{{ Lang::get('user.avatar') }}</label>
                                        <span class="help-block">{{ Lang::get('user.help_avatar') }}</span>
                                    </div>
                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                        <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                    <div>
                                        <span class="default btn-file">
                                            <span class="fileinput-new">
                                                <input type="file" id="avatar" name="avatar">
                                            </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input ">
                                <textarea class="form-control" id="address" name="address" rows="2"></textarea>
                                <label for="address">{{ Lang::get('user.address') }}</label>
                                <span class="help-block">{{ Lang::get('user.help_address') }}</span>
                            </div>
                            <div class="form-group form-md-line-input ">
                                <label for="roles">{{ Lang::get('user.roles') }} ({{ Lang::get('department.select_one') }}):</label>
                                <select class="form-control" id="roles" name="roles">
                                    <option value="0"></option>
                                    <option value="1"></option>
                                </select>
                                <span class="help-block">{{ Lang::get('user.help_roles') }}</span>
                            </div>
                            <div class="form-group form-md-line-input ">
                                <textarea class="form-control" id="confirmation_code" name="confirmation_code" rows="2"></textarea>
                                <label for="confirmation_code">{{ Lang::get('user.confirmation_code') }}</label>
                                <span class="help-block">{{ Lang::get('user.help_confirmation_code') }}</span>
                            </div>
                            
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <a href="javascript:void(0)" class="btn green btn-submit">Submit</a> -->
                                    <input type="submit" name="submit" value="{{ Lang::get('button.form.submit.title') }}" class="btn green btn-submit">
                                    <a href="javascript:;" class="btn default btn-cancel">{{ Lang::get('button.form.cancel.title') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
    </div>
@endsection