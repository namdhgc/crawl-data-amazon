@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('transaction.transaction-detail.title') }}</title>
@endsection

@section('css')

    <link href="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
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
    <script src="{{ URL::asset('js/manage/transaction/transaction.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        Transaction.init();
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
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('transaction.transaction-detail.title') }}</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover order-column dataTable" id="dataTable">
                            <thead>
                                <tr>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','','id'); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Product Code','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Order On Amazon','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Quantity','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Price in Japan','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Discount in Japan','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Price in Vietnamese','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Total','',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Action','',''); ?>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($data['data']['response'] as $key => $item)
                                    <tr class="odd gradeX" <?php echo Spr\Base\Controllers\Views\DataTable::attrData($item); ?>>
                                        <td class=" sorting id">
                                            {{ $item->id}}
                                        </td>
                                        <td class="product_code">
                                            <a target="_blank" href="{{ URL::Route('web-get-detail-product')}}?code={{ $item->product_code}}">{{ $item->product_code}}</a>
                                        </td>
                                        <td class="product_code">
                                            <a target="_blank" href="https://www.amazon.co.jp/dp/{{ $item->product_code}}">Link Amazon</a>
                                        </td>
                                        <td class="quantity">
                                            {{ $item->quantity}}
                                        </td>
                                        <td class="price_in_japan">
                                        <span class="format-currency font-red" data-decimals='0' data-value="<?php echo (isset($item->price) && isset($data['exchange_rate'])) ? ceil((float)$item->price * (float)$data['exchange_rate']):0;?>">
                                            </span>
                                            <sup class="font-red">đ</sup>
                                            
                                        </td>
                                        <td class="discount_in_japan">
                                        <span class="format-currency font-red" data-decimals='0' data-value="<?php echo (isset($item->price_save) && isset($data['exchange_rate'])) ? ceil((float)$item->price_save * (float)$data['exchange_rate']):0;?>">
                                            </span>
                                            <sup class="font-red">đ</sup>
                                            
                                        </td>
                                        <td class="price_in_vietnamese">
                                            <span class="format-currency font-red" data-decimals='0' data-value="<?php echo (isset($item->price_save) && isset($data['exchange_rate'])) ? ceil((float)$item->price * (float)$data['exchange_rate']):0;?>">
                                            </span>
                                            <sup class="font-red">đ</sup>
                                        </td>
                                         <td class="Total">
                                         <span class="format-currency font-red" data-decimals='0' data-value="<?php echo (isset($item->price_save) && isset($data['exchange_rate'])) ? ceil((float)$item->price  * (float)$data['exchange_rate']) * (float)$item->quantity:0;?>">
                                            </span>
                                            <sup class="font-red">đ</sup>
                                            
                                        </td>
                                        <td>
                                            <a href="javascript:;" data-id="{{ $item->id }}" data-from-delete="form-delete" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}">
                                                <i class="{{ Config::get('spr.system.button.form.delete.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.delete.text') }} </span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    <center>
                        {!! Spr\Base\Controllers\Views\DataTable::paginate($data); !!}
                    </center>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
            <!-- BEGIN MODAL DELETE TRANSACTION -->
            <div id="deleteModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="caption">
                            <i class=" icon-layers font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">{{ Lang::get('transaction.form-delete.title') }}</span>
                        </div>
                      </div>
                      <form class="form-delete" method="POST" action="{{ URL::Route('auth-post-delete-transaction-detail') }}" id="frm_del" >
                            <div class="modal-body">
                                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" id ="id" name = "id" value ="">
                                <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label bold font-blue" for="comment">{{ Lang::get('transaction.transaction.comment.name') }}</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="comment" id="comment"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-success" value="{{ Lang::get('button.form.submit.title') }}" />
                                <a href="javascript:;" class="btn default {{ Config::get('spr.system.button.form.cancel.class') }}">{{ Lang::get( Config::get('spr.system.button.form.cancel.text')) }}</a>
                             </div>
                      </form>
                    </div>
                </div>
            </div>
            <!-- END MODAL DELETE TRANSACTION -->
        </div>
    </div>
@endsection