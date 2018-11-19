@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('news-cate.categories.data-list') }}</title>
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
    <script type="text/javascript">
        
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
                        <a href="javascript:;" class="collapse">
                        </a>
                    </div>
                </div>
                <div class="portlet-body"  style="display: block;">
                    <form action="{{ URL::Route('auth-get-news-categories') }}" method="GET" id="search-tool" >
                        <input type="hidden" name="sort" value="{{ $data['sort'] }}">
                        <input type="hidden" name="sort_type"  value="{{ $data['sort_type'] }}">
                        <div class="tab-content clearfix">
                            <div class="form-group last col-md-6">
                                <label><b>{{ Lang::get('manager_form.search.sub_title') }}</b></label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <input type="text" rows="3" cols="5" class="form-control"  name="key_search"  id="key_search" value="{{ $data['key_search'] }}" placeholder="{{ Lang::get('manager_form.search.placeholder') }}" ></input>
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
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered clearfix">
                <div class="portlet-title">
                    <div class="caption ">
                        <i class="icon-settings font-green"></i>
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('news-cate.categories.data-list') }}</span>
                    </div>
                    <div class="actions">
                        <a href="javascript:;" data-from-action="form-edit" class="btn btn-xs blue {{ Config::get('spr.system.button.form.add_new.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.add_new.title')) }}">
                            <i class="fa {{ Config::get('spr.system.button.form.add_new.icon') }}"></i> {{ Lang::get( Config::get('spr.system.button.form.add_new.text')) }}
                        </a>                        
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
                    <div class="table-toolbar">
                        <div class="row">
                        </div>
                    </div>
                    <table class="table table-striped table-hover order-column dataTable" id="dataTable">
                        <thead>
                            <tr>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','','id'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Tên','',''); ?>
                                <?php //echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Language','',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Mô tả','',''); ?>
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
                                    <td class="name">
                                        {{ $item->name }}
                                    </td>
                                    <!-- <td class="lang_code">
                                        @foreach(Config::get('spr.system.lang.language') as $k => $val)
                                            @if($k==$item->lang_code)
                                                {{ $val }}
                                            @endif
                                        @endforeach
                                    </td> -->
                                    <td class="description">
                                        {{ $item->description }}
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-xs green {{ Config::get('spr.system.button.form.view.class') }} " title="{{ Lang::get( Config::get('spr.system.button.form.view.title')) }}">
                                            <i class="fa {{ Config::get('spr.system.button.form.view.icon') }}"></i> {{ Lang::get( Config::get('spr.system.button.form.view.text')) }}
                                        </a>
                                        <a href="javascript:;" class="btn btn-xs blue {{ Config::get('spr.system.button.form.edit.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.edit.title')) }}">
                                            <i class="fa {{ Config::get('spr.system.button.form.edit.icon') }}"></i> {{ Lang::get( Config::get('spr.system.button.form.edit.text')) }}
                                        </a>
                                        <a href="javascript:;" data-id="{{ $item->id }}" data-from-delete="form-delete" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}">
                                            <i class="{{ Config::get('spr.system.button.form.delete.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.delete.text') }} </span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <center>
                        {!! Spr\Base\Controllers\Views\DataTable::paginate($data); !!}
                    </center>
                    <!-- Modal Insert, update, view price list -->
                    <div class="modal fade modal-form-data" id="modalEdit" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <div class="caption">
                                        <i class=" icon-layers font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase">{{ Lang::get('news-cate.categories.form-action.title') }}</span>
                                    </div>
                                </div>
                                <form action="{{ URL::Route('auth-post-insert-update-news-categories') }}" method="POST" class="form-edit form-action" id="form-action-transaction-status">
                                    <div class="modal-body">
                                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" id="id" value="">
                                        <div class="form-body">
                                            <div class="form-group form-md-line-input">
                                                <label class="control-label col-md-3 font-blue bold" for="name">{{ Lang::get('news-cate.categories.name.title') }}</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control" id="name" name="name">
                                                    <span class="help-block">{{ Lang::get('news-cate.categories.name.help-block') }}</span>
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="control-label col-md-3 font-blue bold" for="lang_code">{{ Lang::get('banner.banner.lang_code.title') }}</label>
                                                <div class="col-md-9">
                                                <select class="form-control clear-msg" id="lang_code" name="lang_code" style="">
                                                    @foreach (Config::get('spr.system.lang.language') as $key => $value)
                                                        <option value="{{ $key }}" <?php echo (!empty(old("lang_code")) && $key==old("lang_code")) ? "selected" : ""?>>
                                                            <span>{{ $value }}</span>
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span class="help-block">{{ Lang::get('banner.banner.lang_code.help-block') }}</span>
                                                @if(isset($a['lang_code']))
                                                    <div class="alert alert-danger">{{ $a['lang_code'] }}</div>
                                                @endif
                                                </div>
                                            </div>
                                            <div class="form-group form-md-line-input">
                                                <label class="control-label col-md-3 font-blue bold" for="description">{{ Lang::get('banner.banner.description.title') }}</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control clear-msg" id="description" name="description">{{ old('description') }}</textarea>
                                                    <span class="help-block">{{ Lang::get('banner.banner.description.help-block') }}</span>
                                                    @if(isset($a['description']))
                                                        <div class="alert alert-danger">{{ $a['description'] }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="submit" name="submit" value="{{ Lang::get('button.form.submit.title') }}" class="btn green {{ Config::get('spr.system.button.form.submit.class') }}">
                                                    <a href="javascript:;" class="btn default {{ Config::get('spr.system.button.form.cancel.class') }}">{{ Lang::get( Config::get('spr.system.button.form.cancel.text')) }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--End Modal Insert, update, view price list -->

                    <!-- Modal delete -->
                    <div id="deleteModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="caption">
                                    <i class=" icon-layers font-red"></i>
                                    <span class="caption-subject font-red sbold uppercase">{{ Lang::get('banner.banner-detail.modal-delete.form-action.title') }}</span>
                                </div> 
                              </div>
                              <div class="modal-body">
                                    <form  method="POST" class="form-delete" action="{{ URL::Route('auth-post-delete-news-categories') }}" id="frm_del" >
                                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" id ="id" name = "id" value ="">
                                        <input type="submit" class="btn btn-success" value="{{ Lang::get('button.form.submit.title') }}" />
                                        <a href="javascript:;" class="btn default {{ Config::get('spr.system.button.form.cancel.class') }}">{{ Lang::get( Config::get('spr.system.button.form.cancel.text')) }}</a>
                                    </form>
                              </div>
                            </div>
                        </div>
                    </div>            
                     <!-- End Modal delete -->
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection\