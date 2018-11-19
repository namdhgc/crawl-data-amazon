@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('transaction.transaction.title') }}</title>
@endsection

@section('css')

    <link href="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        table th {
            text-align: center;
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
    <!-- <script src="{{ URL::asset('js/manage/permission/supplier.js') }}" type="text/javascript"></script> -->
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/transaction/transaction.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/pages/scripts/table-datatables-scroller.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        Transaction.init();

        $(document).ready(function(){

          $('.export').click(function(e){

            e.preventDefault();

            console.log($('.search-tool').attr('data-url-export'));
            $('.search-tool').attr('action', $('.search-tool').attr('data-url-export'));
            $('.search-tool').submit();
            console.log('áđâsd');

          });
        });
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
            <form action="{{ URL::Route('auth-get-transaction') }}" data-url-export="{{ URL::Route('auth-get-export-transaction') }}" class="search-tool" method="GET" id="search-tool" >
               <input type="hidden" name="sort" value="{{ $data['sort'] }}">
               <input type="hidden" name="sort_type"  value="{{ $data['sort_type'] }}">
               <div class="tab-content clearfix">
                  <div class="form-group last col-md-4">
                     <label><b>{{ Lang::get('manager_form.form-search-transaction.code.sub_title') }}</b></label>
                     <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-search"></i>
                        </span>
                        <input type="text" rows="3" cols="5" class="form-control"  name="key_search"  id="key_search" value="{{ $data['key_search'] }}" placeholder="{{ Lang::get('manager_form.form-search-transaction.code.placeholder') }}" >
                     </div>
                     <span class="help-block">
                     {!! Lang::get('manager_form.form-search-transaction.code.help-block') !!}
                     </span>
                  </div>
                  <div class="form-group last col-md-4">
                     <label><b>{{ Lang::get('manager_form.form-search-transaction.status.sub_title') }}</b></label>
                     <div class="input-group">
                        <select name="status" class="form-control">
                           <option value="" <?php echo ($data['status']=="") ? "selected" :""?>>{{ Lang::get('manager_form.form-search-transaction.status.default-value') }}</option>
                           @foreach(Cache::get('transaction_status') as $key_status => $v_status)
                           <option value="{{ $key_status }}" <?php echo ($data['status']== $key_status) ? "selected" :""?>>{{ $v_status }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="form-group last col-md-4">
                     <label><b>{{ Lang::get('manager_form.form-search-transaction.type-search.sub_title') }}</b></label>
                     <div class="input-group">
                        <div class="checkbox-list">
                           <select id="limit" name="limit" class="form-control">
                           @foreach( Config::get('spr.system.type.item_on_paginate') as $key => $value )
                           <option value="{{ $value['value'] }}" @if(isset($data) && $data['limit'] == $value['value'] ) selected="selected" @endif>{{ Lang::get($value['text']) }}</option>
                           @endforeach
                           </select>
                        </div>
                        <span class="help-block">
                        <label>{{ Lang::get('manager_form.form-search-transaction.type-search.help-block-paginate') }}</label>
                        </span>
                     </div>
                  </div>
                  <div class="form-group  col-md-12" >
                     <button type="submit" class="btn green search-user {{ Lang::get('button.form.search.class') }}" data-violate="0"><i class="{{ Lang::get('button.form.search.icon') }}"></i> {{ Lang::get('button.form.search.text') }}</button>
                     <button type="button" class="btn default {{ Lang::get('button.form.reset.class') }}" title="{{ Lang::get('button.form.reset.title') }}">{{ Lang::get('button.form.reset.text') }}</button>
                     <button type="button" class="btn green export pull-right" data-violate="0"><i class="fa fa-file-excel-o"></i> Xuất dữ liệu ra excel</button>
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
               <span class="caption-subject bold uppercase font-green">{{ Lang::get('transaction.transaction.title') }}</span>
            </div>
         </div>
         <div class="portlet-body  table-both-scroll">
      
            <table class="table table-striped table-bordered table-hover order-column" id="dataTable">
               <thead>
                  <tr>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '','','','','2'); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('transaction.transaction.code.name'),'','code','','2'); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('transaction.transaction.amazon_id.name'),'','','','2'); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('transaction.transaction.total_price_product.name'),'',''); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Giá trị thực của đơn hàng','',''); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Chênh lệch','',''); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('transaction.transaction.total_fee_product.name'),'',''); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('transaction.transaction.cost_incurred.name'),'',''); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('transaction.transaction.total_amount.name'),'',''); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('transaction.transaction.amount_paid.name'),'',''); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('transaction.transaction.amount_unpaid.name'),'',''); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('transaction.transaction.status.name'),'','','','2'); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Hành động','','','3',''); ?>
                  </tr>
                  <tr>
                      <th>A</th>
                      <th>G</th>
                      <th>H = A - G</th>
                      <th>B</th>
                      <th>C</th>
                      <th>D = (A + B + C)</th>
                      <th>E</th>
                      <th>F = D - E</th>
                      <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Xem','','','',''); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Sửa','','','',''); ?>
                     <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Xóa','','','',''); ?>
                  </tr>
               </thead>
               <tbody>
                  @foreach($data['data']['response'] as $key => $item)
                  <tr class="odd gradeX" <?php echo Spr\Base\Controllers\Views\DataTable::attrData($item); ?>>
                     <td>
                        <i class="fa fa-plus show" data-id="{{ $item->id}}" data-display ="0"></i>
                     </td>
                     <td class="code">
                        {{ $item->code}}
                     </td>
                     <td class="verify">
                        {{ $item->amazon_id}}
                     </td>
                     <td class="total_amount">
                        <span class="format-currency font-red" data-decimals='0' data-value="{{ $item->total_price_in_jp }}">
                        </span>
                        <sup class="font-red">đ</sup>
                     </td>
                     <td class="total_amount">
                        <span class="format-currency font-red" data-decimals='0' data-value="{{ $item->real_price }}">
                        </span>
                        <sup class="font-red">đ</sup>
                     </td>
                     <td class="total_amount">
                        <span class="format-currency font-red" data-decimals='0' data-value="{{ (float)$item->total_price_in_jp - (float)$item->real_price }}">
                        </span>
                        <sup class="font-red">đ</sup>
                     </td>
                     <td class="total_amount">
                        <span class="format-currency font-red" data-decimals='0' data-value="{{ $item->total_fee }}">
                        </span>
                        <sup class="font-red">đ</sup>
                     </td>
                     <td class="total_amount">
                        <span class="format-currency font-red" data-decimals='0' data-value="{{ $item->cost_incurred }}">
                        </span>
                        <sup class="font-red">đ</sup>
                     </td>
                     <td class="total_amount">
                        <span class="format-currency font-red" data-decimals='0' data-value="{{ $item->total_amount }}">
                        </span>
                        <sup class="font-red">đ</sup>
                     </td>
                     <td class="amount_paid">
                        <span class="format-currency font-red" data-decimals='0' data-value="{{ $item->amount_paid }}">
                        </span>
                        <sup class="font-red">đ</sup>
                     </td>
                     <td class="amount_unpaid">
                        <span class="format-currency font-red" data-decimals='0' data-value="{{ $item->amount_unpaid }}">
                        </span>
                        <sup class="font-red">đ</sup>
                     </td>
                     <td class="status">
                        {{ Cache::get('transaction_status')[$item->status] }}
                     </td>
                     <td>
                        <a href="javascript:;" data-from-action="form-view" data-code="{{ $item->code }}" data-payment-type="{{ $item->payment_type }}" data-payment-method="{{ $item->payment_method }}" class="btn btn-xs green {{ Config::get('spr.system.button.form.view.class') }} " title="{{ Lang::get( Config::get('spr.system.button.form.view.title')) }}">
                        <i class="{{ Config::get('spr.system.button.form.view.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.view.text') }} </span>
                        </a>
                     </td>
                     <td>
                        <a href="javascript:;" data-from-action="form-edit" class="btn btn-xs blue {{ Lang::get('button.form.edit.class') }}" data-role-id="{{ $item->id}}" title="{{ Lang::get('button.form.edit.title') }}">
                        <i class="{{ Lang::get('button.form.edit.icon') }}"></i> <span class="title-btn-action"> {{ Lang::get('button.form.edit.text') }} </span>
                        </a>
                      
                     </td>
                     <td>
                        @if(empty($item->deleted_at))
                        <a href="javascript:;" data-id="{{ $item->id }}" data-from-delete="form-delete" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}">
                        <i class="{{ Config::get('spr.system.button.form.delete.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.delete.text') }} </span>
                        </a>
                        @endif
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
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
               <form class="form-delete" method="POST" action="{{ URL::Route('auth-post-delete-transaction') }}" id="frm_del" >
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
      <!-- BEGIN MODAL UPDATE TRANSACTION -->
      <div id="large" class="modal fade bs-modal-lg in" role="dialog">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <div class="caption">
                     <i class=" icon-layers font-red"></i>
                     <span class="caption-subject font-red sbold uppercase">{{ Lang::get('transaction.form-action.title') }}</span>
                  </div>
               </div>
               <form method="POST" action="{{ URL::Route('auth-post-transaction-manager') }}"  class="form-action form-edit form-horizontal" role="form" >
                  <div class="modal-body">
                     <input type="hidden" name="id" value="">
                     <div class="row">
                        <div class="portlet light  clearfix">
                           <div class="portlet-title">
                              <div class="caption ">
                                 <i class="icon-settings font-green"></i>
                                 <span class="caption-subject bold uppercase font-green"> Chi phí đơn hàng</span>
                              </div>
                           </div>
                           <div class="portlet-body">
                              <div class="form-group form-md-line-input col-md-6">
                                 <label class="col-md-6 control-label font-blue bold" for="first_name">Mã đơn hàng</label>
                                 <div class="col-md-6">
                                    <div class="row">
                                       <span class="form-control">
                                       <span name="code"></span>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group form-md-line-input col-md-6">
                                 <label class="col-md-6 control-label font-blue bold" for="first_name">Tổng giá trị đơn hàng</label>
                                 <div class="col-md-6">
                                    <div class="row">
                                       <span class="form-control">
                                       <span class="format-currency font-red" name="total_amount"></span>
                                       <sup class="font-red"> đ </sup>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group form-md-line-input col-md-6">
                                 <label class="col-md-6 control-label font-blue bold" for="first_name">Số tiền đã thanh toán</label>
                                 <div class="col-md-6">
                                    <div class="row">
                                       <span class="form-control">
                                       <span class="format-currency font-red" name="amount_paid"></span>
                                       <sup class="font-red"> đ </sup>
                                       </span> 
                                    </div>
                                 </div>
                              </div>
                              <div class="form-group form-md-line-input col-md-6">
                                 <label class="col-md-6 control-label font-blue bold" for="first_name">Số tiền phải thanh toán</label>
                                 <div class="col-md-6">
                                    <div class="row">
                                       <span class="form-control">
                                       <span class="format-currency font-red" name="amount_unpaid"></span>
                                       <sup class="font-red"> đ </sup>
                                       </span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="portlet light  clearfix">
                           <div class="portlet-title">
                              <div class="caption ">
                                 <i class="icon-settings font-green"></i>
                                 <span class="caption-subject bold uppercase font-green">Cập nhật thông tin</span>
                              </div>
                           </div>
                           <div class="portlet-body">
                              <div class="form-group form-md-line-input col-md-6">
                                 <label class="col-md-6 control-label font-blue bold" for="first_name">Trạng thái đơn hàng</label>
                                 <div class="col-md-6">
                                    <select name="status" class="form-control">
                                       @foreach(Cache::get('transaction_status') as $k_status => $val_status)
                                       <option value="{{ $k_status }}"> {{ $val_status }} </option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                              @if(Auth::user()->roles == 1)
                              <div class="form-group form-md-line-input col-md-6">
                                 <label class="col-md-6 control-label font-blue bold" for="first_name">Giá trị thực tế của đơn hàng </label>
                                 <div class="col-md-6">
                                    <input type="text" name="real_price" class="form-control">
                                 </div>
                              </div>
                              @endif
                              <div class="form-group form-md-line-input col-md-6">
                                 <label class="col-md-6 control-label font-blue bold" for="first_name">Thanh toán</label>
                                 <div class="col-md-6">
                                    <input type="text" name="payment" class="form-control">
                                 </div>
                              </div>
                              <div class="form-group form-md-line-input col-md-6">
                                 <label class="col-md-6 control-label font-blue bold" for="first_name">Ngày giao hàng dự kiến</label>
                                 <div class="col-md-6">
                                    <input type="text" name="expected_date" class="form-control date-picker date-time">
                                 </div>
                              </div>
                              <div class="form-group form-md-line-input col-md-6">
                                 <label class="col-md-6 control-label font-blue bold" for="first_name">Amazon ID</label>
                                 <div class="col-md-6">
                                    <input type="text" name="amazon_id" class="form-control">
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
      <!-- END MODAL UPDATE TRANSACTION -->
      <div class="modal fade in" role="dialog">
         <div class="modal-dialog modal-full">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <div class="caption">
                     <i class=" icon-layers font-red"></i>
                     <span class="caption-subject font-red sbold uppercase">{{ Lang::get('transaction.form-info.title') }}</span>
                  </div>
                  <div class="tools">
                     <a href="javascript:;" class="expand">
                     </a>
                  </div>
               </div>
               <div class="modal-body">
                  <form  class="form-view form-horizontal" role="form" >
                     <div class="row">
                        <div class="col-md-6">
                           <div class="portlet light  clearfix">
                              <div class="portlet-title">
                                 <div class="caption ">
                                    <i class="icon-settings font-green"></i>
                                    <span class="caption-subject bold uppercase font-green">{{ Lang::get('transaction.transaction_information.title') }}</span>
                                 </div>
                              </div>
                              <div class="portlet-body">
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="first_name">Ngày tạo đơn hàng</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span id="transaction-created-at"></span>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="first_name">Ngày giao hàng dự kiến</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span id="transaction-expected-day"></span>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="first_name">Mã đơn hàng</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span id="transaction-code"></span>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="first_name">Trạng thái đơn hàng</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span id="transaction-status"></span>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="first_name">Phương thức thanh toán</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span id="transaction-payment-type"></span>
                                          </span> 
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="first_name">Hình thức thanh toán</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span id="transaction-payment-method"></span>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="portlet light  clearfix">
                              <div class="portlet-title">
                                 <div class="caption ">
                                    <i class="icon-settings font-green"></i>
                                    <span class="caption-subject bold uppercase font-green">{{ Lang::get('transaction.transaction_detail.title') }}</span>
                                 </div>
                              </div>
                              <div class="portlet-body">
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-5 control-label font-blue bold" for="first_name">Tổng chi phí đơn hàng</label>
                                    <div class="col-md-7">
                                       <div class="row">
                                          <span class="form-control">
                                          <span class="format-currency font-red" name="total_amount" data-decimals='0' data-value=""></span>
                                          <sup class="font-red">đ</sup>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-5 control-label font-blue bold" for="first_name">Tổng giá trị sản phẩm trên amazon</label>
                                    <div class="col-md-7">
                                       <div class="row">
                                          <span class="form-control">
                                          <span class="format-currency font-red" name="total_price_in_jp" data-decimals='0' data-value=""></span>
                                          <sup class="font-red">đ</sup>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 @if(Auth::user()->roles == 1)
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-5 control-label font-blue bold" for="first_name">Tổng giá trị thực tế mua hàng trên amazon</label>
                                    <div class="col-md-7">
                                       <div class="row">
                                          <span class="form-control">
                                          <span class="format-currency font-red" name="real_price" data-decimals='0' data-value=""></span>
                                          <sup class="font-red">đ</sup>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 @endif
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-5 control-label font-blue bold" for="first_name">Chi phí đơn hàng</label>
                                    <div class="col-md-7">
                                       <div class="row">
                                          <span class="form-control">
                                          <span class="format-currency font-red" name="total_fee" data-decimals='0' data-value=""></span>
                                          <sup class="font-red">đ</sup>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-5 control-label font-blue bold" for="first_name">Chi phí phát sinh</label>
                                    <div class="col-md-7">
                                       <div class="row">
                                          <span class="form-control">
                                          <span class="format-currency font-red" name="cost_incurred" data-decimals='0' data-value=""></span>
                                          <sup class="font-red">đ</sup>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-5 control-label font-blue bold" for="first_name">Số tiền phải thanh toán trước </label>
                                    <div class="col-md-7">
                                       <div class="row">
                                          <span class="form-control">
                                          <span class="format-currency font-red" name="paid_before" data-decimals='0' data-value=""></span>
                                          <sup class="font-red">đ</sup>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-5 control-label font-blue bold" for="first_name">Số tiền còn phải thanh toán</label>
                                    <div class="col-md-7">
                                       <div class="row">
                                          <span class="form-control">
                                          <span class="format-currency font-red" name="remaining_amount" data-decimals='0' data-value=""></span>
                                          <sup class="font-red">đ</sup>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="portlet light  clearfix">
                              <div class="portlet-title">
                                 <div class="caption ">
                                    <i class="icon-settings font-green"></i>
                                    <span class="caption-subject bold uppercase font-green">{{ Lang::get('transaction.buyer_information.title') }}</span>
                                 </div>
                                 <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                    </a>
                                 </div>
                              </div>
                              <div class="portlet-body" style="display: block">
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="first_name">{{ Lang::get('transaction.transaction.infor_buyer.full_name.name') }}</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span name="ba_first_name"></span>
                                          <span name="ba_last_name"></span>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="email">{{ Lang::get('transaction.transaction.infor_buyer.email.name') }}</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span name="ba_email"></span>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="phone_number">{{ Lang::get('transaction.transaction.infor_buyer.phone_number.name') }}</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span name="ba_phone_number"></span>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="address">{{ Lang::get('transaction.transaction.infor_buyer.address.name') }}</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span name="ba_address"></span>,
                                          <span name="ba_wards"></span>,
                                          <span name="ba_districts"></span>,
                                          <span name="ba_city"></span>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="portlet light  clearfix">
                              <div class="portlet-title">
                                 <div class="caption ">
                                    <i class="icon-settings font-green"></i>
                                    <span class="caption-subject bold uppercase font-green">{{ Lang::get('transaction.receiver_information.title') }}</span>
                                 </div>
                                 <div class="tools">
                                    <a href="javascript:;" class="collapse">
                                    </a>
                                 </div>
                              </div>
                              <div class="portlet-body" style="display: block">
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="first_name">{{ Lang::get('transaction.transaction.info_receiver.full_name.name') }}</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span name="ra_first_name"></span>
                                          <span name="ra_last_name"></span>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="email">{{ Lang::get('transaction.transaction.info_receiver.email.name') }}</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span name="ra_email"></span>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="phone_number">{{ Lang::get('transaction.transaction.info_receiver.phone_number.name') }}</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span name="ra_phone_number"></span>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="form-group form-md-line-input">
                                    <label class="col-md-3 control-label font-blue bold" for="address">{{ Lang::get('transaction.transaction.info_receiver.address.name') }}</label>
                                    <div class="col-md-9">
                                       <div class="row">
                                          <span class="form-control">
                                          <span name="ra_address"></span>,
                                          <span name="ra_wards"></span>,
                                          <span name="ra_districts"></span>,
                                          <span name="ra_city"></span>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="modal-footer">
               </div>
            </div>
         </div>
      </div>
      <!-- Purchase History Modal -->
      <!-- End Purchase History -->
   </div>
</div>
@endsection