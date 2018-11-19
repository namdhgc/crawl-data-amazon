@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('transaction.transaction.title') }}</title>
@endsection

@section('css')

    <link href="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css') }}" />
@endsection

@section('js')
    <script src="{{ URL::asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/datatables.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/pages/scripts/table-datatables-managed.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/permission/supplier.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/transaction/report_transaction/report-transaction.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        ReporTransaction.init();
    </script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
        <div class="portlet box blue" id="search-tool">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-search"></i>{{ Lang::get('manager_form.search.title') }}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="expand">
                        </a>
                    </div>
                </div>
                <div class="portlet-body"  style="display: none;">
                    <form action="{{ URL::Route('auth-get-report-transaction') }}" method="GET" id="search-tool" >
                        <input type="hidden" name="sort" value="">
                        <input type="hidden" name="sort_type"  value="">
                        <div class="tab-content clearfix">
                            <div class="form-group last col-md-6">
                                <label class="col-md-3 control-label font-blue bold"><b>{{ Lang::get('manager_form.search.sub_title') }}</b></label>
                                <div class="col-md-9">
                                    <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                        <input id="from-date" type="text" class="form-control" name="from">
                                        <input id="begin-date" type="hidden" class="form-control" name="beginDate">
                                            <span class="input-group-addon"> to </span>
                                        <input id="to-date" type="text" class="form-control" name="to">
                                        <input id="end-date" type="hidden" class="form-control" name="endDate">
                                    </div>
                                    <span> Format date (dd/mm/yyyy)</span>
                                </div>
                            </div>
                            <div class="form-group last col-md-6">
                                <label class="col-md-3 control-label font-blue bold"><b>{{ Lang::get('manager_form.search.type-search') }}</b></label>
                                <div class="input-group">
                                    <div class="checkbox-list">
                                        <select id="limit" name="limit" class="form-control">
                                            @foreach( Config::get('spr.system.type.item_on_paginate') as $key => $value )
                                                <option value="{{ $value['value'] }}" @if(isset($data) && $data['limit'] == $value['value'] ) selected="selected" @endif>{{ Lang::get($value['text']) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <span class="help-block">
                                        <label>{{ Lang::get('manager_form.search.help-block-paginate') }}</label>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group  col-md-12" >
                                <button type="submit" class="btn green search-user {{ Lang::get('button.form.search.class') }}" data-violate="0"><i class="{{ Lang::get('button.form.search.icon') }}"></i> {{ Lang::get('button.form.search.text') }}</button>
                                <button type="button" class="btn default {{ Lang::get('button.form.reset.class') }}" title="{{ Lang::get('button.form.reset.title') }}">{{ Lang::get('button.form.reset.text') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection