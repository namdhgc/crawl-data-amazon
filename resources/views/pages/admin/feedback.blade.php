@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('feedback.pages-title') }}</title>
@endsection

@section('css')

    <link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css" rel="stylesheet') }}" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
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
        #table-permission-role tr td, #table-permission-role tr th{
            max-width: 90px;
            min-width: 90px;
            word-wrap: break-word;
            text-align: center !important;
        }

        @media screen and (max-width: 900px) {
            #table-permission-role tr td:first; {
                text-align: left !important;
            }
        }

        .error {
            color: red;
        }
    </style>
@endsection

@section('js')
    <script src="{{ URL::asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/datatables.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/pages/scripts/table-datatables-managed.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>

    <!-- Datatable js -->
    <script src="{{ URL::asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <!--End Datatable js -->
    <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/feedback/feedback.js') }}" ></script>
    <script type="text/javascript">
        Feedback.init();
    </script>

@endsection

@section('content')
    <div class="row">

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

                    <form action="{{ URL::Route('auth-get-feedback') }}" method="GET" id="search-tool" >
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
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('feedback.data-list') }}</span>
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
                        <div class="error">
                        @if(Session::get('error')!='' && Session::get('error')!=null)
                            {{ Session::get('error') }}
                        @endif
                        </div>
                        <table class="table table-striped table-hover order-column dataTable" id="dataTable">
                            <thead>
                                <tr>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','','id'); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Tên khách hàng','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Email','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Số điện thoại','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Ngày gửi phản hồi','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Trạng thái','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Action','',''); ?>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($data))
                                    @foreach($data['data']['response'] as $key => $item)
                                    <tr class="odd gradeX"  <?php echo Spr\Base\Controllers\Views\DataTable::attrData($item); ?>>
                                        <td class=" sorting id">
                                            {{ $item->id }}
                                        </td>
                                        <td class="name">
                                            {{ $item->customer_name }}
                                        </td>
                                        <td class="email">
                                            {{ $item->email }}
                                        </td>
                                        <td class="phone_number">
                                            {{ $item->phone_number }}
                                        </td>
                                        <td class="created_at">
                                            <span class="date-time" dateTime="{{ $item->created_at }}"></span>
                                        </td>
                                        <td class="verify">
                                            <!-- @if($item->verify ==1)
                                            <a href="javascript:;" style="text-decoration: none;" data-active="{{ $item->verify }}" data-id="{{ $item->id }}" class="btn-change-verify">
                                                <span class="label label-sm label-success"> Hiển  thị </span>
                                            </a>
                                            @else
                                            <a href="javascript:;" style="text-decoration: none;"  data-active="{{ $item->verify }}" data-id="{{ $item->id }}" class="btn-change-verify">
                                                <span class="label label-sm label-danger"> Không hiển thị </span>
                                            </a>
                                            @endif -->
                                            @foreach (Config::get('spr.system.price_request_status') as $key => $value)
                                                {{ ($item->status == $key) ? $value : '' }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="javascript:;" data-from-action="form-view"  class="btn btn-xs green {{ Config::get('spr.system.button.form.view.class') }} " title="{{ Lang::get( Config::get('spr.system.button.form.view.title')) }}">
                                                <i class="{{ Config::get('spr.system.button.form.view.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.view.text') }} </span>
                                            </a>
                                            <a href="javascript:;" data-from-action="form-view" class="btn btn-xs blue {{ Lang::get('button.form.edit.class') }}"  title="{{ Lang::get('button.form.edit.title') }}">
                                                <i class="{{ Lang::get('button.form.edit.icon') }}"></i> <span class="title-btn-action"> {{ Lang::get('button.form.edit.text') }} </span>
                                            </a>
                                            <a href="javascript:;" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}"
                                            data-from-delete="form-delete" data-id="{{ $item->id}}">
                                                <i class="{{ Config::get('spr.system.button.form.delete.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.delete.text') }} </span>
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
            <!-- END EXAMPLE TABLE PORTLET-->
            <!-- Modal delete -->
            <div id="deleteModal" class="modal fade modal-form-data" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="caption">
                            <i class=" icon-layers font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">{{ Lang::get('banner.banner-detail.modal-delete.form-action.title') }}</span>
                        </div>
                      </div>
                      <form class="form-action form-delete" method="POST" action="{{ URL::Route('auth-post-delete-feedback') }}" id="frm_del" >
                      <div class="modal-body">
                            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" id ="id" name = "id" value ="">
                            <p class=""><font color="red">{{ Lang::get('message.confirm.delete') }}</font></p>
                      </div>
                      <div class="modal-footer">
                          <input type="submit" class="btn btn-success btn-submit" value="{{ Lang::get('button.form.submit.title') }}" />
                            <a href="javascript:;" class="btn default {{ Config::get('spr.system.button.form.cancel.class') }}">{{ Lang::get( Config::get('spr.system.button.form.cancel.text')) }}</a>
                      </div>
                      </form>
                    </div>
                </div>
            </div>
            <!-- End Modal delete -->

            <div class="modal fade in bs-modal-lg" role="dialog">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <form  class="form-view form-horizontal" action="{{ URL::Route('auth-post-update-feedback') }}" role="form" method="POST">
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
                                                    <label class="col-md-3 control-label font-blue bold" for="first_name">Tên khách hàng</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <span class="form-control">
                                                                <span name="customer_name"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label font-blue bold" for="first_name">Ngày gửi phản hồi</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <span class="form-control">
                                                                <span name="created_at" class="date-time"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label font-blue bold" for="first_name">Email</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <span class="form-control">
                                                                <span name="email"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label font-blue bold" for="first_name">Số điện thoại</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <span class="form-control">
                                                                <span name="phone_number"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label font-blue bold" for="first_name">Nội dung</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <span class="form-control">
                                                                 <span name="description"></span>
                                                            </span> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-md-line-input">
                                                    <label class="col-md-3 control-label font-blue bold" for="first_name">Phản hồi của admin</label>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <textarea class="form-control clear-msg" name="comment" id="comment" rows="3">{{ old('comment') }}</textarea>
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