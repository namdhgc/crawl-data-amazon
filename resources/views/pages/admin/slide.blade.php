@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('menu.manager-slide') }}</title>
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
    <script src="{{ URL::asset('js/manage/slide/slide.js') }}" ></script>
    <script type="text/javascript">
        Slide.init();
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
                    <!-- <div class="actions">
                        <a  data-toggle="modal"  class="btn btn-xs blue {{ Config::get('spr.system.button.form.add_new.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.add_new.title')) }}" data-from-action="form-edit">
                            <i class="fa {{ Config::get('spr.system.button.form.add_new.icon') }}"></i> {{ Lang::get( Config::get('spr.system.button.form.add_new.text')) }}
                        </a>                       
                    </div> -->
                </div>
                <div class="portlet-body"  style="display: block;">

                    <form action="{{ URL::Route('auth-get-slide') }}" method="GET" id="search-tool" >
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
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('menu.manager-slide') }}</span>
                    </div>
                    <div class="actions">
                        <a  data-toggle="modal"  class="btn btn-xs blue {{ Config::get('spr.system.button.form.add_new.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.add_new.title')) }}" data-from-action="form-edit">
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
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Tiêu đề','',''); ?>
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
                                        <td class="title">
                                            {{ $item->title }}
                                        </td>
                                        <td class="description">
                                            {{ $item->description }}
                                        </td>
                                        <td class="status">
                                            <a href="javascript:;" class="btn_change_status btn btn-xs {{ ($item->status == 1) ? 'yellow' : 'grey-mint' }}" title="{{ Lang::get('button.form.change_status.title') }}">
                                                <i class="{{ Lang::get('button.form.change_status.icon') }}"></i>
                                                <span class="title-btn-action"> 
                                                    {{ ($item->status == 1) ? Lang::get('slide.active') : Lang::get('slide.inactive') }}
                                                </span>
                                            </a>
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
                                            <a href="{{ URL::Route('auth-get-slide-detail', ['slide_id' => $item->id ]) }}" class="btn btn-xs blue {{ Config::get('spr.system.button.form.add_detail.class') }}"  data-role-id="{{ $item->id}}" title="{{ Lang::get('button.form.add_detail.title') }}">
                                            <i class="{{ Config::get('spr.system.button.form.add_detail.icon') }}"></i> <span class="title-btn-action"> {{ Lang::get('button.form.add_detail.text') }} </span>
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
                        <h4 class="modal-title">{{ Lang::get('slide.form-delete') }}</h4>
                      </div>
                      <div class="modal-body">
                            <form class="form-action form-delete" method="POST" action="{{ URL::Route('auth-post-delete-slide') }}" id="frm_del" >
                                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" id ="id" name = "id" value ="">
                                <input type="submit" class="btn btn-success btn-submit" value="{{ Lang::get('button.form.submit.title') }}" />
                                <a href="javascript:;" class="btn default {{ Config::get('spr.system.button.form.cancel.class') }}">{{ Lang::get( Config::get('spr.system.button.form.cancel.text')) }}</a>
                            </form>
                      </div>
                    </div>
                </div>
            </div>            
            <!-- End Modal delete -->
        </div>

        <div class="modal fade modal-form-data" id="modalEdit" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <form action="{{ URL::Route('auth-post-insert-update-slide') }}" method="POST" class="form-edit form-action" id="form-add-slide">
                        <div class="modal-header">
                            <div class="caption">
                                <i class=" icon-layers font-red"></i>
                                <span class="caption-subject font-red sbold uppercase">{{ Lang::get('slide.add-edit-slide') }}</span>
                            </div>
                        </div>
                        <div class="modal-body">
                            @if(Session::get('message')!='' && Session::get('message')!=null)
                                <div class="alert alert-info">
                                    @foreach(Session::get('message') as $k => $v)
                                        <?php
                                            echo '<span class="font-red" >'.$k.':</span>'.' '.$v.'<br>';
                                        ?>
                                    @endforeach
                                </div>
                             @endif
                            <!-- BEGIN FORM-->
                                <input type="hidden" class="no-clear" id="token" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="id" id="id">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input">
                                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                                        <label for="title">{{ Lang::get('slide.title') }}</label>
                                        <span class="help-block">{{ Lang::get('slide.help-block-title') }}</span>

                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                                        <label for="slug">{{ Lang::get('slide.description') }}</label>
                                        <span class="help-block">{{ Lang::get('slide.help-block-description') }}</span>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <div class="checkbox">
                                            <label><input type="checkbox" data-item-relation="#slc_category" data-show="0" id="main_slide"  name="type">Slide trang chủ</label>
                                        </div>
                                        <div style="display: block;" id="slc_category">
                                            <label for="slc_category">Select category:</label>
                                            <select class="form-control" id="banner_id" name="banner_id">
                                            @if( isset($banner) && !empty($banner) )
                                                @foreach($banner as $key => $item)
                                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            @endif
                                            </select>    
                                        </div>
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