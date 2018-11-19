@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('menu.media_library') }}</title>
@endsection


@section('css')
	<link href="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/apps/css/inbox.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/jstree/dist/themes/default/style.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('assets/global/plugins/dropzone/basic.min.css') }}" rel="stylesheet" type="text/css" />

    <style type="text/css" media="screen">
        .jstree-node-input {

            padding: 0px !important;
            margin-bottom: 0px !important;
        }
        .jstree-node-input input.form-control {

            height: initial !important;
            padding: 0px !important;
            width: 50% !important;
            display: inline !important;
        }
        .jstree-node-input a {

            background: none !important;
            border: none !important;
            box-shadow: none !important;
            width: 95% !important;
        }

        .jstree-node-input a i {

            padding-top : 10px;
        }
        .box-action {
            background: #f6f7fb;
            padding: 8px 0 8px 8px;
            margin: 15px 0px;
        }
        .portlet-none-body .portlet-title {
            margin :0px !important;
            padding: 10px 20px 10px !important;
        }
        .portlet-none-body .portlet-title .actions {
            padding: 6px 0 0px !important;
        }
        .dropzone-file-area {
            text-align: left !important;
        }

        .dropzone-file-area h3, .dropzone-file-area p{
            text-align: center !important;
        }
        .dz-error-mark g {

            fill: rgba(241, 29, 29, 0.86) !important;
        }

        .dz-success-mark g path {

            fill: rgba(145, 239, 172, 0.86) !important;
        }

        .dropzone .dz-preview .dz-error-message {
            color: white;
        }

    </style>
@endsection


@section('js')
	<script src="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/jstree/dist/jstree.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/pages/scripts/ui-tree.js') }}" type="text/javascript"></script>

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ URL::asset('assets/global/plugins/dropzone/dropzone.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{ URL::asset('assets/pages/scripts/form-dropzone.js') }}" type="text/javascript"></script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->

    <script type="text/javascript">
        UITree.init();
    </script>
@endsection


@section('content')
<div class="inbox">
    <div class="row">
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="col-md-12">
            <div class="portlet light portlet-fit bordered clearfix portlet-none-body">
                <div class="portlet-title font-blue sbold uppercase">
                    <div class="caption font-blue pull-left">
                        <i class=" icon-layers font-blue"></i>
                        <span class="caption-subject ">Media Library</span>
                    </div>
                    <div class="actions font-blue pull-right">
                        <a href="javascript:;" class="btn blue btn-upload">
                            <span class="icon-cloud-upload">
                            </span>
                        Upload
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="portlet light portlet-fit bordered clearfix ">
                <div class="portlet-title font-blue sbold uppercase">
                    <div class="caption font-blue">
                        <i class="icon-social-dropbox  font-blue"></i>
                        <span class="caption-subject ">Group image</span>
                    </div>
                    <div class="actions font-blue">
                        <a href="javascript:void(0)" class="pull-right btn-add-new-item-tree" title="{{ Lang::get('button.form.add_new.title') }}">
                            <i class="{{ Lang::get('button.form.add_new.icon') }}"></i>
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="group-image" class="tree-demo" data-url-add-group="{{ URL::Route('auth-post-new-group-media') }}">
                        <ul>
                            <li data-id="0"> All
                            </li>
                            <?php $group_media = Cache::get('group_media_'. Auth::guard('web')->user()->id); ?>
                            @foreach($group_media as $key => $value)
                                <li data-id="{{ $value['id'] }}">
                                    {{ $value['name'] }}
                                    @if(!empty($value['child']))
                                        <ul>
                                        @foreach($value['child'] as $_key => $_value)
                                            <li data-id="{{ $_value['id'] }}">
                                                {{ $_value['name'] }}
                                                @if(!empty($_value['child']))
                                                    <ul>
                                                    @foreach($_value['child'] as $__key => $__value)
                                                        <li data-id="{{ $__value['id'] }}">
                                                            {{ $__value['name'] }}
                                                        </li>
                                                    @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="inbox-body">
                <div class="inbox-header">
                    <div class="box-search">
                        <form class="form-inline" action="index.html">
                            <div class="input-group input-medium  pull-left">
                                <input type="text" class="form-control" placeholder="{{Lang::get('Manage_form.search.placeholder')}}">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn green">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <div class="pull-right">
                                <label>{{Lang::get('Manage_form.search.sort-by')}}</label>
                                <select class="media-status">
                                    @foreach( Config::get('spr.system.type.media.status') as $key => $value)
                                        <option value="{{ $value['value'] }}"> {{ Lang::get($value['title']) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="inbox-content">
                    <div class="col-md-12 box-action">
                        <input type="checkbox" > Select all
                    </div>
                    <div class="list-data">
                        <div class="list-folder">

                        </div>
                        <div class="list-media">
                            @foreach($data['data']['response'] as $key => $item)

                                <div class="item">
                                    <div class="item-action"></div>
                                    <div class="item-preview-default">
                                        <img src="{{ $value->tmp_path.'/'.$value->tmp_name }}" title="{{ $value->title }}">
                                    </div>
                                    <div class="name-item">
                                        {{ $value->title }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    <!-- MODAL -->
    <div class="modal fade bs-modal-lg" id="modal-upload-media" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload Media</h4>
                </div>
                <div class="modal-body clearfix">
                    <div class="col-md-4">
                        <div id="group-upload-image" class="tree-demo" data-url-add-group="{{ URL::Route('auth-post-new-group-media') }}">
                            <ul>
                                <li data-id="0"> No Group
                                </li>
                                <?php $group_media = Cache::get('group_media_'. Auth::guard('web')->user()->id); ?>
                                @foreach($group_media as $key => $value)
                                    <li data-id="{{ $value['id'] }}">
                                        {{ $value['name'] }}
                                        @if(!empty($value['child']))
                                            <ul>
                                            @foreach($value['child'] as $_key => $_value)
                                                <li data-id="{{ $_value['id'] }}">
                                                    {{ $_value['name'] }}
                                                    @if(!empty($_value['child']))
                                                        <ul>
                                                        @foreach($_value['child'] as $__key => $__value)
                                                            <li data-id="{{ $__value['id'] }}">
                                                                {{ $__value['name'] }}
                                                            </li>
                                                        @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form action="{{ URL::Route('auth-post-upload-media') }}" data-action-remove="{{ URL::Route('auth-post-remove-media-tmp') }}" data-action-remove-all="{{ URL::Route('auth-post-remove-all-media-tmp') }}" class="dropzone dropzone-file-area" id="my-dropzone" method="post" enctype="multipart/form-data">
                            <h3 class="sbold">Drop files here or click to upload</h3>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn_modal_update" data-dismiss="modal">{{ Lang::get('button.form.update.title') }}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('button.form.close.title') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL -->
</div>
@endsection
