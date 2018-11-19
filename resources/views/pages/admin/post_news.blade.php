@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('news.post_news_title') }}</title>
@endsection

@section('css')
<link href="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('js')
    <script src="{{ URL::asset('assets/global/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js') }}" type="text/javascript"></script>

    <!-- <script src="{{ URL::asset('assets/pages/scripts/form-validation.min.js') }}" type="text/javascript"></script> -->
    <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/news/news.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $('.btn_submit').click(function () {
            CKEDITOR.instances['description'].updateElement();
        });

        News.init();
    </script>
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="page-head">
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXTRAS PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>{{ Lang::get('news.post_news_title') }}</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="{{ URL::Route('auth-post-post-news') }}" id="form-upload-news" class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="form-group last">
                                    <label class="control-label col-md-2">{{ Lang::get('news.title') }}</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <label class="control-label col-md-2">{{ Lang::get('news.avatar') }}</label>
                                    <div class="col-md-9">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                <img class="img-preview" name="path" src="">
                                            </div>
                                            <div>
                                                <span class="btn red btn-outline btn-file">
                                                    <span class="fileinput-new">{{ Lang::get('button.form.select.text') }}</span>
                                                    <span class="fileinput-exists"> {{ Lang::get('button.form.change.text') }} </span>
                                                    <input type="file" name="image">
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ Lang::get('button.form.remove.text') }} </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <label class="control-label col-md-2">{{ Lang::get('news.category') }}</label>
                                    <div class="col-md-9">
                                        <select class="form-control input-medium" id="category_id" name="category_id">
                                        @foreach ($category['data']['response'] as $key => $item)
                                            <option value="{{ $item->id }}">
                                                <span>{{ $item->name }}</span>
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <label class="control-label col-md-2">{{ Lang::get('news.lang_code') }}</label>
                                    <div class="col-md-9">
                                        <select class="form-control input-medium" id="lang_code" name="lang_code">
                                        @foreach (Config::get('spr.system.lang.language') as $key => $value)
                                            <option value="{{ $key }}">
                                                <span>{{ $value }}</span>
                                            </option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <label class="control-label col-md-2">{{ Lang::get('news.sub_description') }}</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="sub_description" name="sub_description" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <label class="control-label col-md-2">{{ Lang::get('news.description') }}</label>
                                    <div class="col-md-9">
                                        <textarea class="ckeditor" id="description" name="description" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-2 col-md-9">
                                        <button type="submit" class="btn green btn_submit" name="submit">
                                            <i class="fa fa-check"></i>{{ Lang::get('button.form.submit.text') }}
                                        </button>
                                        <a href="javascript:;" class="btn btn-outline grey-salsa">{{ Lang::get('button.form.cancel.text') }}</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END EXTRAS PORTLET-->
            </div>
        </div>
    </div>
</div>
@endsection