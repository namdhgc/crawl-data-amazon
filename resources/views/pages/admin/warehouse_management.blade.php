@extends('layouts/admin/master')

@section('title')
	<title>{{ Lang::get('menu.warehouse-management') }}</title>
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
@endsection

@section('js')
	<script src="{{ URL::asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/datatables.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('assets/pages/scripts/table-datatables-managed.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/warehouse/warehouse.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        Warehouse.init();
        Warehouse.custom();
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

                    <form action="{{ URL::Route('auth-get-warehouse-management') }}" method="GET" id="search-tool" >
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
            
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption ">
                        <i class="icon-settings font-green"></i>
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('warehouse-management.manage_table') }}</span>
                    </div>
                    <div class="actions">
                        <a data-toggle="modal" data-target="#modalEdit" class="btn btn-xs blue" title="{{ Lang::get( Config::get('spr.system.button.form.add_new.title')) }}">
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
                    <table class="table table-striped table-hover table-checkable order-column dataTable" id="dataTable">
                        <thead>
                            <tr>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','','id'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('warehouse-management.name'),'','Name'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('warehouse-management.agency_id'),'','Agency'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('warehouse-management.phone_number'),'',''); ?>
                                <?php //echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('warehouse-management.address'),'','Address'); ?>
                                <?php //echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('warehouse-management.country'),'','Country'); ?>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data))
                                @foreach($data['data']['response'] as $key => $item)
                                <tr class="odd gradeX" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-agency_id="{{ $item->agency_id }}" data-phone_number="{{ $item->phone_number }}" data-address="{{ $item->address }}" data-country="{{ $item->country }}">
                                    <td class=" sorting id">
                                        {{ $item->id }}
                                    </td>
                                    <td class="name">
                                        {{ $item->name }}
                                    </td>
                                    <td class="agency_id">
                                        @foreach ($agency['data']['response'] as $k => $a)
                                            @if ( $item->agency_id == $a->id )
                                                {{ $a->name }}
                                                <?php break; ?>
                                            @endif
                                        @endforeach
                                    </td>
                                    <td class="status">
                                        {{ $item->phone_number }}
                                    </td>
                                    <!-- <td class="status">
                                        {{ $item->address }}
                                    </td>
                                    <td class="status">
                                        {{ $item->country }}
                                    </td> -->
                                    <td>
                                        <!-- <a href="javascript:;" class="btn btn-xs green btn-view ">
                                            <i class="fa fa-search"></i> {{ Lang::get('warehouse-management.view') }}
                                        </a> -->
                                        <a href="javascript:;" class="btn btn-xs blue btn-edit">
                                            <i class="fa fa-edit"></i> {{ Lang::get('warehouse-management.edit') }}
                                        </a>
                                        <!-- <a href="javascript:;" class="btn btn-xs red btn-delete">
                                            <i class="fa fa-times"></i> Delete
                                        </a> -->
                                        <a href="javascript:;" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}"
                                        data-from-delete="form-delete">
                                            <i class="fa {{ Config::get('spr.system.button.form.delete.icon') }}"></i> {{ Lang::get( Config::get('spr.system.button.form.delete.text')) }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Modal Header</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ URL::Route('auth-post-delete-warehouse-management') }}" method="POST" class="delete_form form-delete">
                                        <table class="table table-striped" id="tblGrid">
                                            <thead id="tblHead">
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ Lang::get('warehouse-management.name') }}</th>
                                                    <th>{{ Lang::get('warehouse-management.phone_number') }}</th>
                                                    <th>{{ Lang::get('warehouse-management.address') }}</th>
                                                    <th>{{ Lang::get('warehouse-management.country') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="id" id="id" value="">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <span id="modal_id"></span>
                                                    </td>
                                                    <td>
                                                        <span id="modal_name"></span>
                                                    </td>
                                                    <td>
                                                        <span id="modal_phone_number"></span>
                                                    </td>
                                                    <td>
                                                        <span id="modal_address"></span>
                                                    </td>
                                                    <td>
                                                        <span id="modal_country"></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger btn_modal_delete" data-dismiss="modal">{{ Lang::get('warehouse-management.delete') }}</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('warehouse-management.close') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                    <center>
                        @if(!empty($data) && ( is_numeric($data['limit']) || $data['limit'] =='' ))
                        {!! $data['data']['response']->appends(['sort' => $data['sort'],'limit' => $data['limit'],'sort_type' => $data['sort_type']])->render() !!}
                        @endif
                    </center>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>

        <div class="modal fade modal-form-data" id="modalEdit" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <form action="{{ URL::Route('auth-post-update-warehouse-management') }}" method="POST" class="form-action" id="form-action-add-agency" method="POST">

                        <div class="modal-header">
                            <div class="caption">
                                <i class=" icon-layers font-red"></i>
                                <span class="caption-subject font-red sbold uppercase">{{ Lang::get('warehouse-management.form_add_edit') }}</span>
                            </div>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="">

                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" id="name" name="name">
                                    <label for="name">{{ Lang::get('warehouse-management.name') }}</label>
                                    <span class="help-block">{{ Lang::get('warehouse-management.help_name') }}</span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <select class="form-control" id="agency_id" name="agency_id">
                                        <span>Select agency</span>
                                        @foreach ($agency['data']['response'] as $key => $item)
                                            <option value="{{ $item->id }}">
                                                <span>{{ $item->name }}</span>
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="name">Agency</label>
                                    <span class="help-block">Chose agency ...</span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" id="phone_number" name="phone_number">
                                    <label for="phone_number">{{ Lang::get('warehouse-management.phone_number') }}</label>
                                    <span class="help-block">{{ Lang::get('warehouse-management.help_phone_number') }}</span>
                                </div>
                                <div class="form-group form-md-line-input ">
                                    <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                                    <label for="address">{{ Lang::get('warehouse-management.address') }}</label>
                                    <span class="help-block">{{ Lang::get('warehouse-management.help_address') }}</span>
                                </div>
                                <div class="form-group form-md-line-input ">
                                    <textarea class="form-control" id="country" name="country" rows="3"></textarea>
                                    <label for="country">{{ Lang::get('warehouse-management.country') }}</label>
                                    <span class="help-block">{{ Lang::get('warehouse-management.help_country') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="btn_submit" value="{{ Lang::get('button.form.submit.title') }}" class="btn green btn-submit">
                            <a href="javascript:;" class="btn default btn-cancel">{{ Lang::get('button.form.cancel.title') }}</a>        
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection