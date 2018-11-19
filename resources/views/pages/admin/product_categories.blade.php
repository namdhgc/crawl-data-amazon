@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('menu.product_categories') }}</title>
@endsection

@section('css')

    <link href="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/socicon/socicon.css" rel="stylesheet') }}" type="text/css" />
    <style type="text/css">
        [data-icon]:before {
            content: none !important;
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
    <script src="{{ URL::asset('js/manage/permission/supplier.js') }}" type="text/javascript"></script>

    <!-- preview image before store into database -->
    <script src="{{ URL::asset('js/manage/add_image/upload_image.js') }}" type="text/javascript"></script>
    <!-- end -->

    <script src="{{ URL::asset('assets/global/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('js/manage/category/categories.js') }}" type="text/javascript"></script>



    <script type="text/javascript">
        Categories.init();
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

                    <form action="{{ URL::Route('auth-get-product-categories') }}" method="GET" id="search-tool" >
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
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('form.categories.title') }}</span>
                    </div>
                    @if(count($data['data']['response']) == 0)
                    <div class="actions">
                        <form method="POST" action="{{ URL::Route('auth-post-categories-manager') }}">
                            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" name="submit" value="{{ Lang::get('button.form.update.title') }}" class="btn green btn-submit">
                        </form>
                    </div>
                    @endif
                </div>
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover order-column dataTable" id="dataTable">
                            <thead>
                                <tr>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','','id'); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('categories.amazon_name.title'),'',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('categories.name.title'),'',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('categories.amazon_id.title'),'',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('categories.parent.title'),'',''); ?>
                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('categories.action.title'),'',''); ?>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($data['data']['response'] as $key => $item)
                                    <tr class="odd gradeX" <?php echo Spr\Base\Controllers\Views\DataTable::attrData($item); ?>>
                                        <td class=" sorting id">
                                            {{ $item->id}}
                                        </td>
                                        <td class="code">
                                            {{ $item->name}}
                                        </td>
                                        <td class="parent_name">
                                            @if($item->title == '' || $item->title == null)
                                             {{ $item->name}}
                                            @else 
                                             {{ $item->title}}
                                            @endif
                                        </td>
                                        <td class="amazon_id">
                                            {{ $item->amazon_id}}
                                        </td>
                                        <td class="parent_id">
                                            {{ $item->parent_id}}
                                        </td>
                                        
                                        <td>
                                             <a href="javascript:;" class="btn btn-xs blue {{ Lang::get('button.form.edit.class') }}" data-role-id="{{ $item->id}}" title="{{ Lang::get('button.form.edit.title') }}">
                                                <i class="{{ Lang::get('button.form.edit.icon') }}"></i> <span class="title-btn-action"> {{ Lang::get('button.form.edit.text') }} </span>
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
                <div class="modal fade modal-form-data bs-modal-lg in" id="modalEdit" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <div class="caption">
                                    <i class=" icon-layers font-red"></i>
                                    <span class="caption-subject font-red sbold uppercase">{{ Lang::get('navigation.nav.form-action.title') }}</span>
                                </div>    
                            </div>
                            <form action="{{ URL::Route('auth-post-update-lang-image') }}" method="POST" class="form-edit form-action form-horizontal form-bordered" id="form-action-navigation" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" class="no-clear" id="token" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="id" id="id" value="">
                                    <input type="hidden" name="level" id="level" value="">
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3 font-blue bold" for="title">{{ Lang::get('categories.name.title') }}</label>
                                            <div class="col-md-9">
                                               <input type="text" class="form-control clear-msg" id="title" name="title" value="{{ old('title') }}">
                                                <span class="help-block">{{ Lang::get('categories.name.help-block') }}</span> 
                                            </div>
                                        </div>
                                        
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3 font-blue bold">{{ Lang::get('categories.icon.title') }}</label>
                                            <div class="col-md-9">
                                                <div class="fileinput fileinput-new clear-msg" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> 
                                                        <img class="img-preview" name="icon" src="">
                                                    </div>
                                                    <div>
                                                        <span class="btn red btn-outline btn-file">
                                                            <span class="fileinput-new">{{ Lang::get('navigation.nav.form.image.select') }}</span>
                                                            <span class="fileinput-exists"> {{ Lang::get('navigation.nav.form.image.change') }} </span>
                                                            <input id="image" type="file" name="icon_update"> </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ Lang::get('navigation.nav.form.image.remove') }} </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3 font-blue bold">{{ Lang::get('categories.background.title') }}</label>
                                            <div class="col-md-9">
                                                <div class="fileinput fileinput-new clear-msg" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> 
                                                        <img class="img-preview" name="background_image" src="">
                                                    </div>
                                                    <div>
                                                        <span class="btn red btn-outline btn-file">
                                                            <span class="fileinput-new">{{ Lang::get('navigation.nav.form.image.select') }}</span>
                                                            <span class="fileinput-exists"> {{ Lang::get('navigation.nav.form.image.change') }} </span>
                                                            <input id="image" type="file" name="background_image_update"> </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ Lang::get('navigation.nav.form.image.remove') }} </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="submit" class="btn btn-success" value="{{ Lang::get( Config::get('spr.system.button.form.submit.text')) }}" />
                                                <a href="javascript:;" class="btn default {{ Lang::get( Config::get('spr.system.button.form.cancel.class')) }}" data-dismiss="modal">{{ Lang::get( Config::get('spr.system.button.form.cancel.text')) }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection