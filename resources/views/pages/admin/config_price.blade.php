@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('menu.manager-config-price') }}</title>
@endsection

@section('css')
@endsection

@section('js')
<script src="{{ URL::asset('assets/global/plugins/jquery-repeater/jquery.repeater.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/manage/config_price/config_price.js') }}" type="text/javascript"></script>

<script>
    ConfigPrice.init();
</script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-speech font-green"></i>
                        <span class="caption-subject bold font-green uppercase">{{ Lang::get('menu.manager-config-price') }}</span>
                    </div>
                    <div class="actions">
                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form role="form" action="#" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ Lang::get('config_price.transport_fee') }}</label>
                            <div class="col-md-9">
                                <input type="text" name="transport_fee" placeholder="{{ Lang::get('config_price.transport_fee') }}" class="form-control transport_fee">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ Lang::get('config_price.clearance_fee') }}</label>
                            <div class="col-md-9">
                                <input type="text" name="clearance_fee" placeholder="{{ Lang::get('config_price.clearance_fee') }}" class="form-control clearance_fee">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ Lang::get('config_price.surcharge_fee') }}</label>
                            <div class="col-md-9">
                                <input type="text" name="surcharge_fee" placeholder="{{ Lang::get('config_price.surcharge_fee') }}" class="form-control surcharge_fee">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label">{{ Lang::get('config_price.transaction_processing_fee') }}</label>
                            <div class="col-md-9">
                                <div class="mt-repeater" id="mt-repeater">
                                    <div data-repeater-list="group-b">
                                        <div data-repeater-item="" class="row">
                                            <div class="col-md-5">
                                                <label class="control-label">{{ Lang::get('config_price.prepay') }}</label>
                                                <input type="text" name="prepay" placeholder="{{ Lang::get('config_price.prepay') }}" class="form-control"> 
                                            </div>
                                            <div class="col-md-5">
                                                <label class="control-label">{{ Lang::get('config_price.fee') }}</label>
                                                <input type="text" name="transaction_processing_fee" placeholder="{{ Lang::get('config_price.fee') }}" class="form-control">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="control-label">&nbsp;</label>
                                                <a href="javascript:;" data-repeater-delete="" class="btn btn-danger">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <a href="javascript:;" data-repeater-create="" class="btn btn-info mt-repeater-add">
                                        <i class="fa fa-plus"></i> {{ Lang::get('config_price.add_more_transaction_processing_fee') }}</a>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-circle green">Submit</button>
                                    <button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
                                </div>
                            </div>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection