@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('transaction.transaction-status.title') }}</title>
@endsection

@section('css')

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

    <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/transaction_status/transaction-status.js') }}" type="text/javascript"></script>
    <script type="text/javascript">

        TransactionStatus.init();
    </script>

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered clearfix">
                <div class="portlet-title">
                    <div class="caption ">
                        <i class="icon-settings font-green"></i>
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('transaction.transaction-status.title') }}</span>
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
                    <table class="table table-striped table-hover order-column dataTable" id="dataTable"> 
                        <thead>
                            <tr>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','','id'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Tên','',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Mô tả','',''); ?>
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
                                    <td class="name">
                                        {{ $item->name }}
                                    </td>
                                    <td class="code">
                                        {{ $item->description }}
                                    </td>
                                    <td class="code">
                                        @if($item->type ==1)
                                            <a href="javascript:;"  data-type="{{ $item->type }}" data-id="{{ $item->id }}" class="btn btn-xs yellow btn-change-active">{{ Lang::get('price.price-list.type.normal') }}</a>
                                        @else
                                            <a href="javascript:;" data-type="{{ $item->type }}" data-id="{{ $item->id }}" class="btn btn-xs grey-mint btn-change-active">{{ Lang::get('price.price-list.type.default') }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="javascript:;" data-from-action="form-edit" class="btn btn-xs green {{ Config::get('spr.system.button.form.view.class') }} " title="{{ Lang::get( Config::get('spr.system.button.form.view.title')) }}>
                                            <i class="fa {{ Config::get('spr.system.button.form.view.icon') }}"></i> {{ Lang::get( Config::get('spr.system.button.form.view.text')) }}
                                        </a>
                                        <a href="javascript:;" data-from-action="form-edit" class="btn btn-xs blue {{ Config::get('spr.system.button.form.edit.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.edit.title')) }}">
                                            <i class="fa {{ Config::get('spr.system.button.form.edit.icon') }}"></i> {{ Lang::get( Config::get('spr.system.button.form.edit.text')) }}
                                        </a>
                                        <a href="javascript:;" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}"
                                        data-from-action="form-delete" data-id="{{ $item->id}}">
                                            <i class="{{ Config::get('spr.system.button.form.delete.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.delete.text') }} </span>
                                        </a>
                                        <!--<input type="button"  value="Delete" class="btn btn-xs red btn_delete" data-toggle="modal" data-target="#myModal"> -->
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <center>
                        {!! Spr\Base\Controllers\Views\DataTable::paginate($data); !!}
                    </center>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>

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
                  <form class="form-action form-delete" method="POST" action="{{ URL::Route('auth-post-delete-transaction-status') }}" id="frm_del" >
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

        <div class="modal fade modal-form-data " id="modalEdit" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ URL::Route('auth-post-transaction-status-manager') }}" method="POST" class="form-edit form-action" id="form-action-transaction-status">

                        <div class="modal-header">
                            <div class="caption">
                                <i class=" icon-layers font-red"></i>
                                <span class="caption-subject font-red sbold uppercase">{{ Lang::get('transaction.form-action.title') }}</span>
                            </div>
                            <div class="actions">
                            </div>
                            <?php

                                $a = null;

                                (Session::get('message')!=null) ? $a = Session::get('message'):[]; 
                            ?>
                        </div>
                        <div class="modal-body">
                                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id" value="">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="name" name="name">
                                        <label for="name">{{ Lang::get('transaction.transaction-status.name.title') }}</label>
                                        <span class="help-block">{{ Lang::get('transaction.transaction-status.name.help-block') }}</span>
                                        @if(isset($a['name']))
                                            <div class="alert alert-danger">{{ $a['name'] }}</div>
                                        @endif

                                    </div>
                                    <div class="form-group form-md-line-input ">
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                        <label for="description">{{ Lang::get('transaction.transaction-status.description.title') }}</label>
                                        <span class="help-block">{{ Lang::get('transaction.transaction-status.description.help-block') }}</span>
                                        @if(isset($a['description']))
                                            <div class="alert alert-danger">{{ $a['description'] }}</div>
                                        @endif
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" name="submit" value="{{ Lang::get('button.form.submit.title') }}" class="btn green {{ Config::get('spr.system.button.form.submit.class') }}">
                            <a href="javascript:;" class="btn default {{ Config::get('spr.system.button.form.cancel.class') }}">{{ Lang::get( Config::get('spr.system.button.form.cancel.text')) }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection