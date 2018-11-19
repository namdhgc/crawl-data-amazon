@extends('layouts/admin/master')

@section('title')
	<title>{{ Lang::get('menu.group-customer') }}</title>
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

        .success {
            color: green;
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

    <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/group_customer/group_customer.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        GroupCustomer.init();
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

                    <form action="{{ URL::Route('auth-get-group-customer') }}" method="GET" id="search-tool" >
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
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('group_customer.manage_table') }}</span>
                    </div>
                    <div class="actions">
                        <a data-toggle="modal" class="btn btn-xs blue {{ Config::get('spr.system.button.form.add_new.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.add_new.title')) }}" data-from-action="form-action">
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

                @if(Session::get('message')!='' && Session::get('message')!=null)
                <div class="{{ (Session::get('message')['meta']['code'] == 200) ? 'success' : 'error' }}">
                    <h4> {{ Session::get('message')['meta']['msg'][0] }} </h4>
                </div>
                @endif  

                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-checkable order-column dataTable" id="dataTable">
                        <thead>
                            <tr>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','','id'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('group_customer.name'),'','Name'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('group_customer.price_list_id'),'','Agency'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('group_customer.payment_type_id'),'','Agency'); ?>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data))
                                @foreach($data['data']['response'] as $key => $item)
                                <tr class="odd gradeX" data-id="{{ $item->id }}" data-name="{{ $item->group_customer_name }}" data-price_list_id="{{ $item->price_list_id }}" data-payment_type_id="{{ $item->payment_type_id }}">
                                    <td class=" sorting id">
                                        {{ $item->id }}
                                    </td>
                                    <td class="name">
                                        {{ $item->group_customer_name }}
                                    </td>
                                    <td class="price_list_id">
                                        {{ $item->price_list_name }}
                                    </td>
                                    <td class="payment_type_id">
                                        {{ $item->payment_type_name }}
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-xs blue {{ Config::get('spr.system.button.form.edit.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.edit.title')) }}">
                                            <i class="fa {{ Config::get('spr.system.button.form.edit.icon') }}"></i>
                                            {{ Lang::get( Config::get('spr.system.button.form.edit.text')) }}
                                        </a>
                                        <a href="javascript:;" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}"
                                        data-from-delete="form-delete">
                                            <i class="fa {{ Config::get('spr.system.button.form.delete.icon') }}"></i>
                                            {{ Lang::get( Config::get('spr.system.button.form.delete.text')) }}
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
                            <form action="{{ URL::Route('auth-post-delete-group-customer') }}" class="form-delete" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">{{ Lang::get('group_customer.form-delete') }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="POST" class="delete_form form-delete">
                                            <input type="hidden" name="id" id="id" value="">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <span><h4>{{ Lang::get('group_customer.message-confirm-delete') }}</h4></span>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" >
                                            {{ Lang::get( Config::get('spr.system.button.form.delete.text')) }}
                                        </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                            {{ Lang::get( Config::get('spr.system.button.form.cancel.text')) }}
                                        </button>
                                    </div>
                                </div>
                            </form>
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
        <?php //dd($price_list); ?>

        <div class="modal fade modal-form-data" id="modalEdit" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <form action="{{ URL::Route('auth-post-insert-update-group-customer') }}" method="POST" class="form-action" id="form-action" method="POST">

                        <div class="modal-header">
                            <div class="caption">
                                <i class=" icon-layers font-red"></i>
                                <span class="caption-subject font-red sbold uppercase">{{ Lang::get('group_customer.form_add_edit') }}</span>
                            </div>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="">

                            <div class="form-body">
                                <div class="form-group form-md-line-input">
                                    <input type="text" class="form-control" id="name" name="name">
                                    <label for="name">{{ Lang::get('group_customer.name') }}</label>
                                    <span class="help-block">{{ Lang::get('group_customer.help_name') }}</span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    @if(isset($price_list))
                                        <select class="form-control" id="price_list_id" name="price_list_id">
                                        @foreach($price_list['data']['response'] as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                        </select>
                                    @endif
                                    <label for="price_list_id">{{ Lang::get('group_customer.price_list_id') }}</label>
                                    <span class="help-block">{{ Lang::get('group_customer.help_price_list_id') }}</span>
                                </div>
                                <div class="form-group form-md-line-input">
                                    @if(isset($payment_type))
                                        <select class="form-control" id="payment_type_id" name="payment_type_id">
                                        @foreach($payment_type['data']['response'] as $key => $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                        </select>
                                    @endif
                                    <label for="payment_type_id">{{ Lang::get('group_customer.payment_type_id') }}</label>
                                    <span class="help-block">{{ Lang::get('group_customer.help_payment_type_id') }}</span>
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