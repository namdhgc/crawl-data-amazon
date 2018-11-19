@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('menu.news-management') }}</title>
@endsection

@section('css')
<link href="{{ URL::asset('css/indication/style.css') }}" rel="stylesheet" type="text/css" media="screen" />
<link href="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ URL::asset('assets/global/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

<!-- <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/manage/news/news.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    News.init();
</script> -->

<script>
    $(document).ready(function(){

        $(".btn_edit").on("click", function() {

            var id              = $(this).closest('[data-id]').data("id");
            var title           = $(this).closest('[data-title]').data("title");
            var description     = $(this).closest('[data-description]').data("description");
            var sub_description = $(this).closest('[data-sub_description]').data("sub_description");
            var category_id     = $(this).closest('[data-category_id]').data("category_id");
            var lang_code       = $(this).closest('[data-description]').data("lang_code");

            $("#id").attr("value", id);
            $("#modal_edit_id").val(id);
            $('#modal_title').val(title);
            $('#ckeditor').val(description);
            $('#modal_sub_description').val(sub_description);
            $('#modal_category_id').val(category_id);
            $('#modal_lang_code').val(lang_code);

            CKEDITOR.instances['ckeditor'].setData(description);

        });

        $(".btn_modal_edit").on("click", function() {

            $(".edit_form").submit();
        });

        $(document).on('click','.btn-delete', function(e){

            e.preventDefault();

            id = $(this).closest('[data-id]').data("id");

            $('#modal_delete_id').val(id);
        });
    });
</script>
@endsection


@section('content')
<div class="page-content-wrapper">
    <div class="page-head">
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

                <form action="{{ URL::Route('auth-get-news-management') }}" method="GET" id="search-tool" >
                    <input type="hidden" name="sort" value="{{ $data['sort'] }}">
                    <input type="hidden" name="sort_type"  value="{{ $data['sort_type'] }}">
                    <!-- <input type="hidden" name="slide_id" data-fix="true"  value=""> -->

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
                    <span class="caption-subject bold uppercase font-green">{{ Lang::get('menu.news-management') }}</span>
                </div>
            </div>

            <div class="portlet-body form">
                <!-- <div> -->
                    <!-- <div class="form-body">
                        <div class="add-image link-group">

                            <a href="javascript:void(0)" class="btn btn-success  btn-create-new" data-toggle="modal" data-from-action="form-action-view-edit">
                                <i class="fa fa-plus"></i> {{ Lang::get('button.form.add_new.text') }}
                            </a>
                        </div>
                    </div> -->
                <!-- </div> -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-checkable order-column dataTable" id="dataTable">
                        <thead>
                            <tr>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','','id'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('news.title'),'',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('news.sub_description'),'',''); ?>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data))
                                @foreach($data['data']['response'] as $key => $item)
                                <tr class="odd gradeX" data-id="{{ $item->id }}" data-title="{{ $item->title }}" data-description="{{ $item->description }}" data-sub_description="{{ $item->sub_description }}" data-category_id="{{ $item->category_id }}" data-lang_code="{{ $item->lang_code }}">
                                    <td class=" sorting id">
                                        {{ $item->id }}
                                    </td>
                                    <td class="title">
                                        {{ $item->title }}
                                    </td>
                                    <td class="description">
                                        {{ $item->sub_description }}
                                    </td>
                                    <td>
                                        <a class="btn btn-xs green btn-view" data-toggle="modal" data-from-action="form-action-view-edit">
                                            <i class="fa fa-search"></i> {{ Lang::get('button.form.view.text') }}
                                        </a>
                                        <a data-from-action="form-action-view-edit" class="btn btn-xs blue btn-edit btn_edit" >
                                            <i class="fa fa-edit"></i> {{ Lang::get('button.form.edit.text') }}
                                        </a>
                                        <a class="btn btn-xs red btn-delete" data-toggle="modal" data-target="#modal_delete">
                                            <i class="fa fa-times"></i> {{ Lang::get('button.form.delete.text') }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- Start modal edit -->
                <div class="modal fade bs-modal-lg" id="modal_edit" tabindex="-1" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form action="{{ URL::Route('auth-post-edit-news') }}" class="form-action-view-edit"  method="POST" enctype="multipart/form-data">
                                <input type="hidden" value="" id="modal_edit_id" name="id">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">{{ Lang::get('news.form-update') }}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="error" id="modal_error"></div>
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3" for="title">{{ Lang::get('news.title') }}</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="modal_title" name="title" value="{{ old('title') }}">
                                                <span class="help-block">{{ Lang::get('news.help-block-title') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">{{ Lang::get('news.description') }}</label>
                                            <div class="col-md-9">
                                                <textarea class="ckeditor" id="ckeditor" name="description" rows="6"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">{{ Lang::get('news.sub_description') }}</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" class="form-control" id="modal_sub_description" name="sub_description" rows="5">{{ old('sub_description') }}</textarea>
                                            </div>
                                        </div>


                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">{{ Lang::get('news.category') }}</label>
                                            <div class="col-md-9">
                                                <select class="form-control input-medium" id="modal_category_id" name="category_id">
                                                @foreach ($category['data']['response'] as $key => $item)
                                                    <option value="{{ $item->id }}">
                                                        <span>{{ $item->name }}</span>
                                                    </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">{{ Lang::get('news.lang_code') }}</label>
                                            <div class="col-md-9">
                                                <select class="form-control input-medium" id="modal_lang_code" name="lang_code">
                                                @foreach (Config::get('spr.system.lang.language') as $key => $value)
                                                    <option value="{{ $key }}">
                                                        <span>{{ $value }}</span>
                                                    </option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3">{{ Lang::get('news.image') }}</label>
                                            <div class="col-md-9">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                        <img class="img-preview" name="path" src="">
                                                    </div>
                                                    <div>
                                                        <span class="btn red btn-outline btn-file">
                                                            <span class="fileinput-new">{{ Lang::get('news.select') }}</span>
                                                            <span class="fileinput-exists"> {{ Lang::get('news.change') }} </span>
                                                            <input type="file" name="image"> </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ Lang::get('news.remove') }} </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="_token" class="no-clear" value="{{ csrf_token() }}">
                                    <button type="button" class="btn dark btn-outline btn-cancel" data-dismiss="modal">{{ Lang::get('button.form.close.text') }}</button>
                                    <button type="submit" class="btn green">{{ Lang::get('button.form.save.text') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End modal edit -->

                <!-- Start modal delete -->
                <div class="modal fade bs-modal-lg" id="modal_delete" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form action="{{ URL::Route('auth-post-delete-news') }}" method="POST">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">{{ Lang::get('news.form-delete') }}</h4>
                                </div>
                                <div class="modal-body">
                                    <h4>{{ Lang::get('news.sure-delete') }}</h4>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id" id="modal_delete_id" value="">
                                    <input type="hidden" name="_token" class="no-clear" value="{{ csrf_token() }}">
                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">{{ Lang::get('button.form.close.text') }}</button>
                                    <button type="submit" class="btn green">{{ Lang::get('button.form.delete.text') }}</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!-- End modal delete -->

            </div>
        </div>

    </div>
</div>
@endsection