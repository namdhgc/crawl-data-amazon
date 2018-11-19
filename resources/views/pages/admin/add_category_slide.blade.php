@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('menu.add-image') }}</title>
@endsection

@section('css')
@endsection

@section('js')
<script src="{{ URL::asset('js/manage/add_image/add_image.js') }}" ></script>

<script type="text/javascript">
    $(document).ready(function () {
        QuotationDesktop.worldWideQuotation();
    });
</script>
@endsection


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered clearfix">
            <div class="portlet-title">
                <div class="caption ">
                    <i class="icon-settings font-green"></i>
                    <span class="caption-subject bold uppercase font-green">{{ Lang::get('form.add-category-slide.title') }}</span>
                </div>
            </div>

            <div class="portlet-body form">

                <div class="form-horizontal" role="form">
                    <div class="form-body">
                        <div class="add-image link-group">
                            <button class="add-product-btn btn btn-success" type="button"><i class="fa fa-plus"></i>{{ Lang::get('slide.add-image') }}</button>
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
                </div>

                
            </div>
        </div>
    </div>
</div>
@endsection