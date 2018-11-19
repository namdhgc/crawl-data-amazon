@extends('layouts/admin/master')

@section('title')
	<title>{{ Lang::get('menu.manager-bank') }}</title>
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
    <script src="{{ URL::asset('js/manage/bank/bank.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        Bank.init();
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
                </div>
                <div class="portlet-body"  style="display: block;">

                    <form action="{{ URL::Route('auth-get-bank') }}" method="GET" id="search-tool" >
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
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('bank.manage_table') }}</span>
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
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('bank.name'),'','name'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('bank.agency'),'','agency'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('bank.account_number'),'','account_number'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('bank.account_holder'),'','account_holder'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('bank.description'),'',''); ?>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data))
                                @foreach($data['data']['response'] as $key => $item)
                                <tr class="odd gradeX" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-agency="{{ $item->agency }}" data-account_number="{{ $item->account_number }}" data-account_holder="{{ $item->account_holder }}" data-description="{{ $item->description }}">
                                    <td class=" sorting id">
                                        {{ $item->id }}
                                    </td>
                                    <td class="name">
                                        {{ $item->name }}
                                    </td>
                                    <td class="agency">
                                        {{ $item->agency }}
                                    </td>
                                    <td class="account_number">
                                        {{ $item->account_number }}
                                    </td>
                                    <td class="account_holder">
                                        {{ $item->account_holder }}
                                    </td>
                                    <td class="description">
                                        {{ $item->description }}
                                    </td>
                                    <td>
                                        <a class="btn btn-xs blue {{ Config::get('spr.system.button.form.edit.class') }} btn-create-new" data-from-action="form-edit">
                                            <i class="fa {{ Config::get('spr.system.button.form.edit.icon') }}"></i> {{ Lang::get('button.form.edit.text') }}
                                        </a>
                                        <a class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}"
                                        data-from-action="form-delete">
                                            <i class="{{ Config::get('spr.system.button.form.delete.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.delete.text') }} </span>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <form action="{{ URL::Route('auth-post-delete-bank') }}" method="POST" class="form-delete">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">{{ Lang::get('bank.form_delete') }}</h4>
                                        <input type="hidden" name="id" id="id" value="">
                                    </div>
                                    <div class="modal-body">
                                        <h4>{{ Lang::get('bank.confirm_delete') }}</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger btn_modal_delete">{{ Lang::get('bank.delete') }}</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('bank.close') }}</button>
                                    </div>
                                </form>
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
                    <form action="{{ URL::Route('auth-post-insert-update-bank') }}" method="POST" class="form-action form-edit" id="form-action-bank" method="POST">

                        <div class="modal-header">
                            <div class="caption">
                                <i class=" icon-layers font-red"></i>
                                <span class="caption-subject font-red sbold uppercase">{{ Lang::get('bank.form_add_edit') }}</span>
                            </div>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="">

                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" id="name" name="name">
                                    <label for="name">{{ Lang::get('bank.name') }}</label>
                                    <span class="help-block">{{ Lang::get('bank.help_name') }}</span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" id="agency" name="agency">
                                    <label for="agency">{{ Lang::get('bank.agency') }}</label>
                                    <span class="help-block">{{ Lang::get('bank.help_agency') }}</span>
                                </div>
                                <div class="form-group form-md-line-input ">
                                    <input type="text" class="form-control" id="account_number" name="account_number"/>
                                    <label for="account_number">{{ Lang::get('bank.account_number') }}</label>
                                    <span class="help-block">{{ Lang::get('bank.help_account_number') }}</span>
                                </div>
                                <div class="form-group form-md-line-input ">
                                    <input type="text" class="form-control" id="account_holder" name="account_holder"/>
                                    <label for="account_holder">{{ Lang::get('bank.account_holder') }}</label>
                                    <span class="help-block">{{ Lang::get('bank.help_account_holder') }}</span>
                                </div>
                                <div class="form-group form-md-line-input ">
                                    <input type="text" class="form-control" id="description" name="description"/>
                                    <label for="description">{{ Lang::get('bank.description') }}</label>
                                    <span class="help-block">{{ Lang::get('bank.help_description') }}</span>
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
@endsection