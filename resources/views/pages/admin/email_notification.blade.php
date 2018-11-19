@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('menu.email-notification') }}</title>
@endsection

@section('css')
@endsection

@section('js')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="todo-container">
                
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

                        <form action="{{ URL::Route('auth-get-email-notification') }}" method="GET" id="search-tool" >
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

                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered clearfix">
                            <div class="portlet-title">
                                <div class="caption ">
                                    <i class="icon-settings font-green"></i>
                                    <span class="caption-subject bold uppercase font-green">{{ Lang::get('form.email-notification.title') }}</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover order-column dataTable" id="dataTable">
                                        <thead>
                                            <tr>
                                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','',''); ?>
                                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('email-notification.email'),'','email'); ?>
                                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('email-notification.status'),'','status'); ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                @foreach($data['data']['response'] as $key => $item)
                                                <tr class="odd gradeX" <?php echo Spr\Base\Controllers\Views\DataTable::attrData($item); ?>>
                                                    <td class=" sorting id">
                                                        {{ $item->id }}
                                                    </td>
                                                    <td class="email">
                                                        {{ $item->email }}
                                                    </td>
                                                    <td class="status">
                                                        {{ ($item->status == 0) ? Lang::get('email-notification.received') : Lang::get('email-notification.processed') }}
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
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection