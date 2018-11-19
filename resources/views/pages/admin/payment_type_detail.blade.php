@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('menu.manager-payment-type-detail') }}</title>
@endsection

@section('css')
<link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css" rel="stylesheet') }}" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
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
<script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>

<script src="{{ URL::asset('js/manage/payment_type/payment_type_detail.js') }}" ></script>
<script type="text/javascript">
    PaymentTypeDetail.init();
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
                        <a href="javascript:;" class="expand">
                        </a>
                    </div>
                    <div class="actions">
                        <a  data-toggle="modal"  class="btn btn-xs blue {{ Config::get('spr.system.button.form.add_new.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.add_new.title')) }}" data-from-action="form-edit">
                            <i class="fa {{ Config::get('spr.system.button.form.add_new.icon') }}"></i> {{ Lang::get( Config::get('spr.system.button.form.add_new.text')) }}
                        </a>
                    </div>
                </div>
                <div class="portlet-body"  style="display: none;">

                    <form action="{{ URL::Route('auth-get-payment-type-detail') }}" method="GET" id="search-tool" >
                        <input type="hidden" name="sort" value="{{ $data['sort'] }}">
                        <input type="hidden" name="sort_type"  value="{{ $data['sort_type'] }}">
                        <input type="hidden" name="payment_type_id" class="no-clear" value="{{ $data['payment_type_id'] }}">
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
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('menu.manager-payment-type-detail') }}</span>
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
                                        echo '<span class="font-red" >'.$k.':</span>'.' '.$v.'<br>';
                                    ?>
                                @endforeach
                            </div>
                         @endif
                        <table class="table table-striped table-hover order-column dataTable" id="dataTable">
                            <thead>
                                <tr>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Title','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Payment value','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Type','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Cost incurred','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Specified value','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Bonus','',''); ?>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($data))
                                    @foreach($data['data']['response'] as $key => $item)
                                    <tr class="odd gradeX"  <?php echo Spr\Base\Controllers\Views\DataTable::attrData($item); ?>>
                                        <td class="title">
                                            {{ $item->title }}
                                        </td>
                                        <td class="payment_value">
                                            {{ $item->payment_value }}
                                        </td>
                                        <td class="type">
                                            @foreach( Config::get('spr.system.payment') as $key => $value )
                                                {{ ($item->type == $key) ? $value : '' }}
                                            @endforeach
                                        </td>
                                        <td class="cost_incurred">
                                            {{ $item->cost_incurred }}
                                        </td>
                                        <td class="specified_value">
                                            {{ $item->specified_value }}
                                        </td>
                                        <td class="bonus">
                                            {{ $item->bonus }}
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-xs green {{ Config::get('spr.system.button.form.view.class') }} " title="{{ Lang::get( Config::get('spr.system.button.form.view.title')) }}"
                                            data-from-action="form-edit" >
                                            <i class="{{ Config::get('spr.system.button.form.view.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.view.text') }} </span>
                                            </a>
                                            <a href="javascript:;" class="btn btn-xs blue {{ Config::get('spr.system.button.form.edit.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.edit.title')) }}"
                                            data-from-action="form-edit" >
                                                <i class="{{ Config::get('spr.system.button.form.edit.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.edit.text') }} </span>
                                            </a>
                                            <a href="javascript:;" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}"
                                            data-from-delete="form-delete">
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
            <!-- Modal delete -->
            <div id="deleteModal" class="modal fade modal-form-data" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{ Lang::get('payment-type-detail.form-delete') }}</h4>
                      </div>
                      <div class="modal-body">
                            <form class="form-action form-delete" method="POST" action="{{ URL::Route('auth-post-delete-payment-type-detail') }}" id="frm_del" >
                                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" id ="id" name = "id" value ="">
                                <input type="submit" class="btn btn-success btn-submit" value="{{ Lang::get('button.form.submit.text') }}" />
                                <a href="javascript:;" class="btn default {{ Config::get('spr.system.button.form.cancel.class') }}">{{ Lang::get('button.form.cancel.text') }}</a>
                            </form>
                      </div>
                    </div>
                </div>
            </div>
            <!-- End Modal delete -->
            <!-- End Modal edit -->
            <div class="modal fade modal-form-data" id="modalEdit" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <form action="{{ URL::Route('auth-post-insert-or-update-payment-type-detail', ['payment_type_id' => $data['payment_type_id']]) }}" method="POST" class="form-edit form-action" id="form-add-edit-payment-type-detail">
                            <div class="modal-header">
                                <div class="caption">
                                    <i class=" icon-layers font-red"></i>
                                    <span class="caption-subject font-red sbold uppercase">{{ Lang::get('payment-type-detail.add-edit-payment-type-detail') }}</span>
                                </div>
                            </div>
                            <div class="modal-body">
                                <!-- BEGIN FORM-->
                                    <input type="hidden" class="no-clear" id="token" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                                            <label for="title">{{ Lang::get('payment-type-detail.title') }}</label>
                                            <span class="help-block">{{ Lang::get('payment-type-detail.help-block-title') }}</span>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <textarea type="text" class="form-control" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                                            <label for="description">{{ Lang::get('payment-type-detail.description') }}</label>
                                            <span class="help-block">{{ Lang::get('payment-type-detail.help-block-description') }}</span>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" id="payment_value" name="payment_value" value="{{ old('payment_value') }}">
                                            <label for="payment_value">{{ Lang::get('payment-type-detail.payment_value') }}</label>
                                            <span class="help-block">{{ Lang::get('payment-type-detail.help-block-payment_value') }}</span>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <select id="type" name="type" class="form-control" value="{{ old('type') }}">
                                                @foreach( Config::get('spr.system.payment') as $key => $value )
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <label for="type">{{ Lang::get('payment-type-detail.type') }}</label>
                                            <span class="help-block">{{ Lang::get('payment-type-detail.help-block-type') }}</span>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" id="cost_incurred" name="cost_incurred" value="{{ old('cost_incurred') }}">
                                            <label for="cost_incurred">{{ Lang::get('payment-type-detail.cost_incurred') }}</label>
                                            <span class="help-block">{{ Lang::get('payment-type-detail.help-block-cost_incurred') }}</span>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" id="specified_value" name="specified_value" value="{{ old('specified_value') }}">
                                            <label for="specified_value">{{ Lang::get('payment-type-detail.specified_value') }}</label>
                                            <span class="help-block">{{ Lang::get('payment-type-detail.help-block-specified_value') }}</span>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <input type="text" class="form-control" id="bonus" name="bonus" value="{{ old('bonus') }}">
                                            <label for="bonus">{{ Lang::get('payment-type-detail.bonus') }}</label>
                                            <span class="help-block">{{ Lang::get('payment-type-detail.help-block-bonus') }}</span>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="btn_submit" value="{{ Lang::get('button.form.submit.text') }}" class="btn green btn-submit">
                                <a href="javascript:;" class="btn default btn-cancel">{{ Lang::get('button.form.cancel.text') }}</a>        
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal edit -->
            
        </div>

    </div>
@endsection