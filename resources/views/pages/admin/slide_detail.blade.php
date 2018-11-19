@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('menu.manager-slide') }}</title>
@endsection

@section('css')
<link href="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

<style type="text/css">

    .table img {
        width: 40px;
        height: 40px;
    }

    .error {
        display: none;
        color: red;
    }
</style>
@endsection

@section('js')
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/slide/slide_detail.js') }}" ></script>


    <script type="text/javascript">
        // $(document).ready(function () {
        //     QuotationDesktop.worldWideQuotation();
        // });
        SlideDetail.init();
    </script>

    @if($errors->any())
    <script type="text/javascript">

        $(document).ready(function () {
            var data = <?php echo json_encode($errors->all()); ?>;
            SlideDetail.custom(data);
        });
    </script>
    @endif

@endsection


@section('content')
<div class="row">
    <div class="col-md-12">

        <!-- <div class="portlet box blue" id="search-tool">
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

                <form action="{{ URL::Route('auth-get-slide-detail') }}" method="GET" id="search-tool" >
                    <input type="hidden" name="sort" value="{{ $data['sort'] }}">
                    <input type="hidden" name="sort_type"  value="{{ $data['sort_type'] }}">
                    <input type="hidden" name="slide_id" data-fix="true"  value="{{ $data['slide_id'] }}">

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
        </div> -->
        <div class="portlet light bordered clearfix">
            <div class="portlet-title">
                <div class="caption ">
                    <i class="icon-settings font-green"></i>
                    <span class="caption-subject bold uppercase font-green">{{ Lang::get('menu.manager-slide') }}</span>
                </div>
            </div>

            <div class="portlet-body form">
                <!-- <div> -->
                    <div class="form-body">
                        <div class="add-image link-group">

                            <a href="javascript:void(0)" class="btn btn-success  btn-create-new" data-toggle="modal" data-from-action="form-action-view-edit">
                                <i class="fa fa-plus"></i> {{ Lang::get('button.form.add_new.text') }}
                            </a>
                        </div>
                    </div>
                <!-- </div> -->
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-checkable order-column dataTable" id="dataTable">
                        <thead>
                            <tr>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','','id'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('slide.title'),'',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('slide.link'),'',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('slide.image'),'',''); ?>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data))
                                @foreach($data['data']['response'] as $key => $item)
                                <tr class="odd gradeX" data-id="{{ $item->id }}" data-link="{{ $item->link }}" data-title="{{ $item->title }}" data-path="{{ $item->path }}">
                                    <td class=" sorting id">
                                        {{ $item->id }}
                                    </td>
                                    <td class="title">
                                        {{ $item->title }}
                                    </td>
                                    <td class="link">
                                        <a target="_blank" href="{{ $item->mod_link }}">{{ Lang::get('banner.banner-detail.link.display') }}</a>
                                    </td>
                                    <td class="path">
                                        <img src="{{ URL::asset( $item->path ) }}" alt="{{ $item->path }}">
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-xs green btn-view" data-toggle="modal" data-from-action="form-action-view-edit">
                                            <i class="fa fa-search"></i> {{ Lang::get('button.form.view.text') }}
                                        </a>
                                        <a href="javascript:void(0)" data-from-action="form-action-view-edit" class="btn btn-xs blue btn-edit" >
                                            <i class="fa fa-edit"></i> {{ Lang::get('button.form.edit.text') }}
                                        </a>
                                        <a href="javascript:void(0)" class="btn btn-xs red btn-delete" data-toggle="modal" data-target="#modal_delete">
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
                            <form action="{{ URL::Route('auth-post-insert-update-slide-detail', ['slide_id' => $data['slide_id']]) }}" class="form-action-view-edit"  method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="" name="id">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">{{ Lang::get('slide.form-update') }}</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="error" id="modal_error"></div>
                                    <div class="form-body">
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3" for="title">{{ Lang::get('slide.title') }}</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                                                <span class="help-block">{{ Lang::get('slide.help-block-title') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input">
                                            <label class="control-label col-md-3" for="link">{{ Lang::get('banner.banner-detail.link.title') }}</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}">
                                                <span class="help-block">{{ Lang::get('slide.help-block-link') }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group form-md-line-input clearfix">
                                            <label class="control-label col-md-3">{{ Lang::get('slide.image') }}</label>
                                            <div class="col-md-9">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                        <img class="img-preview" name="path" src="">
                                                    </div>
                                                    <div>
                                                        <span class="btn red btn-outline btn-file">
                                                            <span class="fileinput-new">{{ Lang::get('slide.select') }}</span>
                                                            <span class="fileinput-exists"> {{ Lang::get('slide.change') }} </span>
                                                            <input type="file" name="image"> </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ Lang::get('slide.remove') }} </a>
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
                            <form action="{{ URL::Route('auth-post-delete-image') }}" method="POST">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                    <h4 class="modal-title">{{ Lang::get('slide.form-delete') }}</h4>
                                </div>
                                <div class="modal-body">
                                    <h4>{{ Lang::get('slide.sure-delete') }}</h4>
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

            <!-- <div class="portlet-body form">
                <div class="{{ (Session::get('message') == true) ? 'alert alert-success' : '' }}">
                    <strong>{{ (Session::get('message') == true) ? Session::get('message') : '' }}</strong>
                </div>
                <div class="form-horizontal" role="form">
                    <form action="{{ URL::Route('auth-post-add-slide') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="add-image link-group">
                                <button class="add-product-btn btn btn-success" type="button"><i class="fa fa-plus"></i>{{ Lang::get('slide.add-image') }}</button>

                                <div class="lbl"><br></div>
                                <div class="input input-large"><input type="file" name="image[]" class="form-control input-md" required=""></div>
                            </div>
                        </div>

                        <div class="form-action">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green">{{ Lang::get('button.form.submit.title') }}</button>
                                    <button type="button" class="btn default">{{ Lang::get('button.form.cancel.title') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> -->
        </div>
    </div>
</div>
@endsection