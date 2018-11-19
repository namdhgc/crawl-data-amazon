@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('banner.banner.page-title.title') }}</title>
@endsection

@section('css')

    <link href="{{ URL::asset('assets/global/plugins/datatables/datatables.min.css" rel="stylesheet') }}" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
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
    <script src="{{ URL::asset('assets/pages/scripts/table-datatables-responsive.min.js') }}" type="text/javascript"></script>
    <!--End Datatable js -->
    <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/banner/banner.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/add_image/upload_image.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        Banner.init();
    </script>
    @if($errors->any())

        <script type="text/javascript" >

            $('#modalEdit').modal('show');
        </script>
    @endif
@endsection

@section('content')
    <div class="row">
        <?php

            $a = null;

            ($errors->any()) ? $a = $errors->get('error'):[];
        ?>

        <div class="col-md-12">
            <!-- Search tool -->
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
                    <form action="{{ URL::Route('auth-get-banner') }}" method="GET" id="search-tool" >
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

            <!-- End search tool -->
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered clearfix">
                <div class="portlet-title">
                    <div class="caption ">
                        <i class="icon-settings font-green"></i>
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('banner.banner.show-data.title') }}</span>
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
                    <div class="table-responsive">
                    <table class="table table-striped table-hover order-column dataTable" id="dataTable">
                        <thead class="">
                            <tr>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','','id'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Tiêu đề','',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Icon','',''); ?>
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
                                    <td class="title">
                                        {{ $item->title }}
                                    </td>
                                    <td class="path">
                                        <div class="thumbnail"  style="width: 64px; height: 48px;border: none;">
                                            <img class="img-res" name="path" src="{{ URL::asset( $item->path ) }}" style="width: 64px; height: 48px;">
                                        </div>
                                    </td>
                                    <td class="description">
                                        {{ $item->description }}
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-xs green {{ Config::get('spr.system.button.form.view.class') }} " title="{{ Lang::get( Config::get('spr.system.button.form.view.title')) }}">
                                        <i class="{{ Config::get('spr.system.button.form.view.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.view.text') }} </span>
                                        </a>
                                        <a href="javascript:;" class="btn btn-xs blue {{ Config::get('spr.system.button.form.edit.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.edit.title')) }}">
                                            <i class="{{ Config::get('spr.system.button.form.edit.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.edit.text') }} </span>
                                        </a>
                                        <a href="javascript:;" data-id="{{ $item->id }}" data-from-delete="form-delete" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}">
                                            <i class="{{ Config::get('spr.system.button.form.delete.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.delete.text') }} </span>
                                        </a>
                                        <a href="{{ URL::Route('auth-get-banner-detail', ['banner_id' => $item->id ]) }}" class="btn btn-xs blue {{ Config::get('spr.system.button.form.add_detail.class') }}"  data-role-id="{{ $item->id}}" title="{{ Lang::get('button.form.add_detail.title') }}">
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

            <!-- Modal Insert, update, view banner -->
            <div class="modal fade modal-form-data" id="modalEdit" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="caption">
                                <i class=" icon-layers font-red"></i>
                                <span class="caption-subject font-red sbold uppercase">{{ Lang::get('banner.banner-detail.form-action.title') }}</span>
                            </div>
                        </div>
                        <!-- BEGIN FORM-->
                    <form action="{{ URL::Route('auth-post-insert-update-banner') }}" method="POST" class="form-edit form-action form-horizontal form-bordered" id="form-action-category" enctype="multipart/form-data">
                        <input type="hidden" class="no-clear" id="token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" id="id">
                        <div class="modal-body">
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3 font-blue bold" for="title">{{ Lang::get('banner.banner.title.title') }}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control clear-msg" id="title" name="title" value="{{ old('title') }}">
                                    <span class="help-block">{{ Lang::get('banner.banner.title.help-block') }}</span>
                                    @if(isset($a['title']))
                                        <div class="alert alert-danger">{{ $a['title'] }}</div>
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
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3 font-blue bold">{{ Lang::get('banner.banner-detail.image.title') }}</label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                            <img class="img-preview" name="path" src="">
                                        </div>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new">{{ Lang::get('banner.banner-detail.image.select') }}</span>
                                                <span class="fileinput-exists"> {{ Lang::get('banner.banner-detail.image.change') }} </span>
                                                <input type="file" name="image"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ Lang::get('banner.banner-detail.image.remove') }} </a>
                                        </div>
                                        @if(isset($a['img']))
                                            <div class="alert alert-danger">{{ $a['img'] }}</div>
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
            <!--End Modal Insert, update, view banner -->

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
                        <form  method="POST" class="form-delete" action="{{ URL::Route('auth-post-delete-banner') }}" id="frm_del" >
                        <div class="modal-body">

                                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" id ="id" name = "id" value ="">
                                <p class=""><font color="red">{{ Lang::get('message.confirm.delete') }}</font></p>

                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="{{ Lang::get('button.form.submit.title') }}" />
                            <a href="javascript:;" class="btn default {{ Config::get('spr.system.button.form.cancel.class') }}">{{ Lang::get( Config::get('spr.system.button.form.cancel.text')) }}</a>
                         </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal delete -->
        </div>
    </div>
@endsection