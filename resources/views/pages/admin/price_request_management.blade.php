@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('menu.price-request-management') }}</title>
@endsection

@section('css')

    <link href="{{ URL::asset('assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/jquery-multi-select/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/apps/css/todo.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        
        #modal_link {
            /*display: inline-table;*/
            height: auto;
            word-wrap: break-word;
        }
    </style>
@endsection

@section('js')

<script src="{{ URL::asset('assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/global/plugins/jquery-multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/apps/scripts/todo.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/manage/price_request/price_request.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    PriceRequest.init();

    // $(document).ready(function() {

        $(document).on('click', '.btn-view, .btn-edit', function() {

            var link        = $(this).closest('[data-link]').data("link");
            var split_char  = "|";
            var array       = link.split(split_char);
            var arr_length  = array.length;
            var mod_link    = '';

            for (var i = 0; i < arr_length; i++) {

                // mod_link += '<input type="text" class="form-control" value="' + array[i] + '">' + '<br/>';
                mod_link += '<a href="' + array[i] +  '">Link ' + (i+1) + '</a>' + '<br/>';
            }

            $('#modal_link').html(mod_link);
        });
    // });
</script>
@endsection

@section('content')
    <div class="row">
    <?php //dd($data); ?>

        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue" id="search-tool">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-search"></i>{{ Lang::get('manager_form.search.title') }}
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                    <div class="actions">
                    </div>
                </div>
                <div class="portlet-body"  style="display: block;">

                    <form action="{{ URL::Route('auth-get-price-request-management') }}" method="GET" id="search-tool" >
                        <input type="hidden" name="sort" value="{{ $data['sort'] }}">
                        <input type="hidden" name="sort_type"  value="{{ $data['sort_type'] }}">
                        <div class="tab-content clearfix">
                            <div class="form-group last col-md-6">
                                <label><b>{{ Lang::get('manager_form.search.sub_title') }}</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" rows="3" cols="5" class="form-control"  name="key_search"  id="key_search" value="{{ $data['key_search'] }}" placeholder="{{ Lang::get('manager_form.search.placeholder') }}" />
                                </div>
                                <span class="help-block">
                                    {!! Lang::get('manager_form.search.help-block') !!}
                                </span>
                            </div>
                            <div class="form-group last col-md-6">
                                <label><b>{{ Lang::get('manager_form.search.type-search') }}</b></label>
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

            <div class="portlet light bordered clearfix">
                <div class="portlet-title">
                    <div class="caption ">
                        <i class="icon-settings font-green"></i>
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('price_request.price_request_title') }}</span>
                    </div>
                    <div class="actions">
                    </div>
                    <div class="pull-right hide">
                        <?php
                            $tableInformation = Spr\Base\Controllers\Views\DataTable::dataInformation($data);
                            $formItem = $tableInformation['formItem'];
                            echo $tableInformation['html'];

                        ?>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        @if(Session::get('message')!='' && Session::get('message')!=null)
                            <div class="alert alert-info">
                                @foreach(Session::get('message') as $k => $v)
                                    <?php
                                        echo '<span class="font-red" ></span>'.$v.'<br>';
                                    ?>
                                @endforeach
                            </div>
                         @endif
                        <table class="table table-striped table-hover order-column dataTable" id="dataTable">
                            <thead>
                                <tr>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','','id'); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Email','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Tên khách hàng','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Số điện thoại','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Ngày gửi phản hồi','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Trạng thái','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Hành động','',''); ?>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($data))
                                    @foreach($data['data']['response'] as $key => $item)
                                    <tr class="odd gradeX"  <?php echo Spr\Base\Controllers\Views\DataTable::attrData($item); ?>>
                                        <td class=" sorting id">
                                            {{ $item->id }}
                                        </td>
                                        <td class="email">
                                            {{ $item->email }}
                                        </td>
                                        <td class="fullName">
                                            {{ $item->fullName }}
                                        </td>
                                        <td class="phone">
                                            {{ $item->phone }}
                                        </td>
                                        <td class="created_at">
                                            <span class="date-time" dateTime="{{ $item->created_at }}"></span>
                                        </td>
                                        <td class="status">
                                            @foreach (Config::get('spr.system.price_request_status') as $key => $value)
                                                {{ ($item->status == $key) ? $value : '' }}
                                            @endforeach
                                        </td>
                                        <input type="hidden" value="{{ $item->link }}" id="link">
                                        <td>
                                            <a href="javascript:;" data-from-action="form-view"  class="btn btn-xs green {{ Config::get('spr.system.button.form.view.class') }} " title="{{ Lang::get( Config::get('spr.system.button.form.view.title')) }}">
                                                <i class="{{ Config::get('spr.system.button.form.view.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.view.text') }} </span>
                                            </a>
                                            <a href="javascript:;" data-from-action="form-view" class="btn btn-xs blue {{ Lang::get('button.form.edit.class') }}"  title="{{ Lang::get('button.form.edit.title') }}">
                                                <i class="{{ Lang::get('button.form.edit.icon') }}"></i> <span class="title-btn-action"> {{ Lang::get('button.form.edit.text') }} </span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <center>
                        {!! Spr\Base\Controllers\Views\DataTable::paginate($data); !!}
                    </center>
                </div>
            </div>

            <div class="modal fade in bs-modal-lg" role="dialog">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <form  class="form-view form-horizontal" action="{{ URL::Route('auth-post-update-status-price-request') }}" role="form" method="POST">
                            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="caption">
                                <i class=" icon-layers font-green"></i>
                                <span class="caption-subject font-green sbold uppercase">Thông tin chi tiết</span>
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="expand">
                                </a>
                            </div>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="">
                                        <div class="portlet light  clearfix">
                                            <div class="portlet-body">
                                                <input type="hidden" name="id">
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label font-blue bold" for="email">Email</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <span class="form-control">
                                                                <span name="email"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label font-blue bold" for="fullname">Tên khách hàng</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <span class="form-control">
                                                                <span name="fullname"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label font-blue bold" for="phone">Số điện thoại</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <span class="form-control">
                                                                <span name="phone"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label font-blue bold" for="created_at">Ngày gửi phản hồi</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <span class="form-control">
                                                                <span name="created_at" class="date-time"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label font-blue bold" for="message">Tin nhắn</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <span class="form-control">
                                                                <span name="message"></span>
                                                            </span> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label font-blue bold" for="link">Link</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <span class="form-control" id="modal_link">
                                                            </span> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label font-blue bold" for="status">Trạng thái</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <span class="form-control">
                                                                <span name="modal_status">
                                                                    <select class="form-control input-medium" name="status">
                                                                    @foreach (Config::get('spr.system.price_request_status') as $key => $value)
                                                                        <option value="{{ $key }}" >{{ $value }}</option>
                                                                    @endforeach
                                                                    </select>
                                                                </span>
                                                            </span> 
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-success" value="{{ Lang::get('button.form.submit.title') }}" />
                                <a href="javascript:;" class="btn default {{ Config::get('spr.system.button.form.cancel.class') }}" data-dismiss="modal">{{ Lang::get( Config::get('spr.system.button.form.cancel.text')) }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection