@extends('layouts/admin/master')

@section('title')
	<title>{{ Lang::get('menu.agency-management') }}</title>
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
    <script src="{{ URL::asset('js/manage/agency/new-agency.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        NewAgency.init();
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
                        <span class="caption-subject font-red sbold uppercase">{{ Lang::get('agency-management.title') }}</span>
                    </div>
                    <div class="actions">
                    </div>
                </div>
                <div class="portlet-body">
                    <!-- BEGIN FORM-->
                    <form action="{{ URL::Route('auth-post-add-agency') }}" class="form-edit" id="form-action-add-agency" method="POST">
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="">

                        <div class="form-body">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="name" name="name">
                                <label for="name">{{ Lang::get('agency-management.name') }}</label>
                                <span class="help-block">{{ Lang::get('agency-management.help_name') }}</span>
                            </div>
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="phone_number" name="phone_number">
                                <label for="phone_number">{{ Lang::get('agency-management.phone_number') }}</label>
                                <span class="help-block">{{ Lang::get('agency-management.help_phone_number') }}</span>
                            </div>
                            <div class="form-group form-md-line-input ">
                                <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                                <label for="address">{{ Lang::get('agency-management.address') }}</label>
                                <span class="help-block">{{ Lang::get('agency-management.help_address') }}</span>
                            </div>
                            <div class="form-group form-md-line-input ">
                                <textarea class="form-control" id="country" name="country" rows="3"></textarea>
                                <label for="country">{{ Lang::get('agency-management.country') }}</label>
                                <span class="help-block">{{ Lang::get('agency-management.help_country') }}</span>
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