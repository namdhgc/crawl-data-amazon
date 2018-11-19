 @extends('layouts/admin/master')

@section('title')
<title>{{ Lang::get('menu.setting') }}</title>
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
        [data-icon]:before {
            content : "" !important;
            display: none;
        }
    </style>
@endsection

@section('js')
    <!-- <script src="{{ URL::asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script> -->
    <!-- <script src="{{ URL::asset('assets/global/plugins/datatables/datatables.js') }}" type="text/javascript"></script> -->
    <!-- <script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script> -->
    <script src="{{ URL::asset('assets/pages/scripts/table-datatables-managed.js') }}" type="text/javascript"></script>
    <!-- <script src="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script> -->
    <!-- <script src="{{ URL::asset('assets/pages/scripts/components-date-time-pickers.min.js') }}" type="text/javascript"></script> -->

    <!-- Datatable js -->
    <!-- <script src="{{ URL::asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script> -->
    <script src="{{ URL::asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/pages/scripts/table-datatables-responsive.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/jquery-repeater/jquery.repeater.js') }}" type="text/javascript"></script>
    <!--End Datatable js -->
    <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/add_image/upload_image.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/setting/setting.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/happy_code/price_happy_code.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
            var cur_tab = localStorage.current_tab_setting;

            if (cur_tab == undefined || cur_tab == "" || $('.nav-tabs li a[href="'+cur_tab+'"]').length == 0) {

                cur_tab = "#tab_1";
                
            }

            $('.nav-tabs li').removeClass('active');
            $('.nav-tabs li a[href="'+cur_tab+'"]').first().parent('li').first().addClass('active');
            $('.tab-pane').removeClass('in active');
            $(cur_tab).addClass('in active');

            Setting.init();
            PriceHappyCode.init();

            $(document).ready(function() {

                $(document).on('click', '.tab', function () {

                    var current_tab = $(this).attr('href');

                    localStorage.setItem("current_tab_setting", current_tab);
                });

            });
    </script>
@endsection

@section('content')

<!-- BEGIN PAGE BASE CONTENT -->
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-social-dribbble font-purple-soft"></i>
                    <span class="caption-subject font-purple-soft bold uppercase">Cấu hình hệ thống</span>
                </div>
                <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-wrench"></i>
                    </a>
                </div>
            </div>
            <div class="portlet-body">
                <ul class="nav nav-tabs">
                    <li >
                        <a href="#tab_1" data-toggle="tab" class="tab"> Thông tin cơ bản </a>
                    </li>
                    <li>
                        <a href="#tab_2" data-toggle="tab" class="tab"> Giá mã đại lý </a>
                    </li>
                    <li>
                        <a href="#tab_3" data-toggle="tab" class="tab"> Nhân viên hỗ trợ </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade" id="tab_1">
                        <section class="home-feature-block">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-social-dribbble font-white"></i>
                                                <span class="caption-subject font-white bold uppercase">{{ Lang::get('setting.form-title.company-info.title') }}</span>
                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="expand">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <form action="{{ URL::Route('auth-post-update-company-info') }}" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                                                <input type="hidden" name="icon" id="icon"  value=" <?php echo isset($data['logo'][0]) ? $data['logo'][0]->icon:""?>">
                                                <div class="form-body">
                                                    <div class="form-group form-md-line-input">
                                                        <label class="control-label col-md-3 font-blue bold">{{ Lang::get('setting.form.logo.name') }}</label>
                                                        <div class="col-md-9">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                                    @if(isset($data['logo'][0]))
                                                                    <img class="img-preview" name="path" src="{{ URL::asset( $data['logo'][0]->path ) }}">
                                                                    @else
                                                                    <img class="img-preview" name="path" src="">
                                                                    @endif
                                                                </div>
                                                                <div>
                                                                    <span class="btn red btn-outline btn-file">
                                                                        <span class="fileinput-new">{{ Lang::get('setting.form.logo.select') }}</span>
                                                                        <span class="fileinput-exists"> {{ Lang::get('setting.form.logo.change') }} </span>
                                                                        <input type="file" id="logo" name="image"> </span>
                                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">{{ Lang::get('setting.form.logo.remove') }}</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        <label class="control-label col-md-3 font-blue bold">{{ Lang::get('setting.form.company_name.name') }}</label>
                                                        <div class="col-md-9">
                                                             <input type="text" class="form-control com-info" id="company_name" name="company_name" value="<?php echo isset($data['company_name'][0]) ? $data['company_name'][0]->title:""?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        <label class="control-label col-md-3 font-blue bold">{{ Lang::get('setting.form.email.name') }}</label>
                                                        <div class="col-md-9">
                                                             <input type="text" class="form-control com-info" id="email_support" name="email_support" value="<?php echo isset($data['email_support'][0]) ? $data['email_support'][0]->title:""?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        <label class="control-label col-md-3 font-blue bold">{{ Lang::get('setting.form.hotline.name') }}</label>
                                                        <div class="col-md-9">
                                                             <input type="text" class="form-control com-info" id="hotline" name="hotline" value="<?php echo isset($data['hotline'][0]) ? $data['hotline'][0]->title:""?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        <label class="control-label col-md-3 font-blue bold">{{ Lang::get('setting.form.total_products.name') }}</label>
                                                        <div class="col-md-9">
                                                             <input type="text" class="form-control com-info" id="total_products" name="total_products" value="<?php echo isset($data['total_products'][0]) ? $data['total_products'][0]->title:""?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        <label class="control-label col-md-3 font-blue bold">{{ Lang::get('setting.form.transaction_success.name') }}</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control com-info" id="total_transaction_success" name="transaction_success" value="<?php echo isset($data['total_transaction_success'][0]) ? $data['total_transaction_success'][0]->title:""?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        <label class="control-label col-md-3 font-blue bold" for="description">{{ Lang::get('setting.form.description.name') }}</label>
                                                        <div class="col-md-9">
                                                            <textarea class="ckeditor" id="sub_description" name="description" rows="6"><?php echo isset($data['sub_description'][0]) ? $data['sub_description'][0]->description:""?></textarea>
                                                        </div>
                                                     </div>
                                                </div>
                                                <div class="form-footer">
                                                    <input type="submit" name="submit" value="{{ Lang::get('button.form.submit.title') }}" class="btn green {{ Config::get('spr.system.button.form.submit.class') }}">
                                                    <a href="javascript:;" class="btn default {{ Config::get('spr.system.button.form.cancel.class') }}">{{ Lang::get( Config::get('spr.system.button.form.cancel.text')) }}</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- END SAMPLE TABLE PORTLET-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="icon-social-dribbble font-white"></i>
                                                <span class="caption-subject font-white bold uppercase">{{ Lang::get('setting.form-title.rules.title') }}</span>
                                            </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="expand">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <form action="{{ URL::Route('auth-post-update-setting-rules') }}" method="POST" class="form-horizontal form-bordered" enctype="multipart/form-data">
                                                <div class="form-body">
                                                    <div class="form-group form-md-line-input">
                                                        <label class="control-label col-md-3 font-blue bold">{{ Lang::get('setting.form.rules.title.name') }}</label>
                                                        <div class="col-md-9">
                                                             <input type="text" class="form-control com-info" id="title" name="title" value="<?php echo isset($data['rules'][0]) ? $data['rules'][0]->title:""?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        <label class="control-label col-md-3 font-blue bold" for="description">{{ Lang::get('setting.form.rules.description.name') }}</label>
                                                        <div class="col-md-9">
                                                            <textarea class="ckeditor" id="sub_description" name="description" rows="10"><?php echo isset($data['rules'][0]) ? $data['rules'][0]->description:""?></textarea>
                                                        </div>
                                                     </div>
                                                </div>
                                                <div class="form-footer">
                                                    <input type="submit" name="submit" value="{{ Lang::get('button.form.submit.title') }}" class="btn green {{ Config::get('spr.system.button.form.submit.class') }}">
                                                    <a href="javascript:;" class="btn default {{ Config::get('spr.system.button.form.cancel.class') }}">{{ Lang::get( Config::get('spr.system.button.form.cancel.text')) }}</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- END SAMPLE TABLE PORTLET-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-comments uppercase"></i>{{ Lang::get('setting.form-title.commitment-of-company.title') }}</div>
                                            <div class="actions">
                                                <a href="javascript:;" data-id="commitment_of_company" data-from-action="form-edit" class="btn btn-xs blue {{ Config::get('spr.system.button.form.add_new.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.add_new.title')) }}">
                                                    <i class="fa {{ Config::get('spr.system.button.form.add_new.icon') }}"></i> {{ Lang::get( Config::get('spr.system.button.form.add_new.text')) }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th> Tiêu đề </th>
                                                            <th> Icon </th>
                                                            <th> Icon Class </th>
                                                            <th> Mô tả  </th>
                                                            <th> Hành động </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(isset($data['commitment_of_company']))
                                                            @foreach($data['commitment_of_company'] as $key => $item)
                                                                <tr class=""  <?php echo Spr\Base\Controllers\Views\DataTable::attrData($item); ?> >
                                                                    <td class="title">
                                                                        {{ $item->title }}
                                                                    </td>
                                                                    <td class="path">
                                                                        <div class="thumbnail"  style="width: 48px; height: 48px;border: none;">
                                                                            <img class="img-res" name="path" src="{{ URL::asset( $item->path ) }}" style="width: 48px; height: 48px;">
                                                                        </div>
                                                                    </td>
                                                                    <td class="icon_class">
                                                                        {{ $item->icon_class }}
                                                                    </td>
                                                                    <td class="description">
                                                                        <?php echo $item->description;?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:;" data-from-action="form-action-company" class="btn btn-xs blue {{ Config::get('spr.system.button.form.edit.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.edit.title')) }}">
                                                                            <i class="{{ Config::get('spr.system.button.form.edit.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.edit.text') }} </span>
                                                                        </a>
                                                                        <a href="javascript:;" data-id="{{ $item->id }}" data-from-delete="form-delete" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}">
                                                                            <i class="{{ Config::get('spr.system.button.form.delete.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.delete.text') }} </span>
                                                                        </a>
                                                                    </td>
                                                                 </tr>
                                                             @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END SAMPLE TABLE PORTLET-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-comments uppercase"></i>{{ Lang::get('setting.form-title.services-of-company.title') }}</div>
                                            <div class="actions">
                                                <a href="javascript:;" data-id="services_of_company" data-from-action="form-edit" class="btn btn-xs blue {{ Config::get('spr.system.button.form.add_new.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.add_new.title')) }}">
                                                    <i class="fa {{ Config::get('spr.system.button.form.add_new.icon') }}"></i> {{ Lang::get( Config::get('spr.system.button.form.add_new.text')) }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                                <table class="table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th> Tiêu đề </th>
                                                            <th> Icon </th>
                                                            <th> Icon Class </th>
                                                            <th> Mô tả  </th>
                                                            <th> Hành động </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(isset($data['services_of_company']))
                                                            @foreach($data['services_of_company'] as $key => $item)
                                                                <tr class="odd gradeX"  <?php echo Spr\Base\Controllers\Views\DataTable::attrData($item); ?>>
                                                                    <td class="title">
                                                                        {{ $item->title }}
                                                                    </td>
                                                                    <td class="path">
                                                                        <div class="thumbnail"  style="width: 48px; height: 48px;border: none;">
                                                                            <img class="img-res" name="path" src="{{ URL::asset( $item->path ) }}" style="width: 48px; height: 48px;">
                                                                        </div>
                                                                    </td>
                                                                    <td class="icon_class">
                                                                        {{ $item->icon_class }}
                                                                    </td>
                                                                    <td class="description">
                                                                        <?php echo $item->description;?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:;" data-from-action="form-action-company" class="btn btn-xs blue {{ Config::get('spr.system.button.form.edit.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.edit.title')) }}">
                                                                            <i class="{{ Config::get('spr.system.button.form.edit.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.edit.text') }} </span>
                                                                        </a>
                                                                        <a href="javascript:;" data-id="{{ $item->id }}" data-from-delete="form-delete" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}">
                                                                            <i class="{{ Config::get('spr.system.button.form.delete.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.delete.text') }} </span>
                                                                        </a>
                                                                    </td>
                                                                 </tr>
                                                             @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END SAMPLE TABLE PORTLET-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- BEGIN SAMPLE TABLE PORTLET-->
                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-comments uppercase"></i>{{ Lang::get('setting.form-title.why-choose-us.title') }}</div>
                                            <div class="actions">
                                                <a href="javascript:;" data-id="why_choose_us" data-from-action="form-edit" class="btn btn-xs blue {{ Config::get('spr.system.button.form.add_new.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.add_new.title')) }}">
                                                    <i class="fa {{ Config::get('spr.system.button.form.add_new.icon') }}"></i> {{ Lang::get( Config::get('spr.system.button.form.add_new.text')) }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                                <table class="table table-striped table-hover dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th> Tiêu đề </th>
                                                            <th> Icon </th>
                                                            <th> Icon Class </th>
                                                            <th> Mô tả  </th>
                                                            <th> Hành động </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(isset($data['why_choose_us']))
                                                            @foreach($data['why_choose_us'] as $key => $item)
                                                                <tr class="odd gradeX"  <?php echo Spr\Base\Controllers\Views\DataTable::attrData($item); ?>>
                                                                    <td class="title">
                                                                        {{ $item->title }}
                                                                    </td>
                                                                    <td class="path">
                                                                        <div class="thumbnail"  style="width: 48px; height: 48px;border: none;">
                                                                            <img class="img-res" name="path" src="{{ URL::asset( $item->path ) }}" style="width: 48px; height: 48px;">
                                                                        </div>
                                                                    </td>
                                                                    <td class="icon_class">
                                                                        {{ $item->icon_class }}
                                                                    </td>
                                                                    <td class="description">
                                                                        <?php echo $item->description;?>
                                                                    </td>
                                                                    <td>
                                                                        <a href="javascript:;" data-from-action="form-action-company" class="btn btn-xs blue {{ Config::get('spr.system.button.form.edit.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.edit.title')) }}">
                                                                            <i class="{{ Config::get('spr.system.button.form.edit.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.edit.text') }} </span>
                                                                        </a>
                                                                        <a href="javascript:;" data-id="{{ $item->id }}" data-from-delete="form-delete" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}">
                                                                            <i class="{{ Config::get('spr.system.button.form.delete.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.delete.text') }} </span>
                                                                        </a>
                                                                    </td>
                                                                 </tr>
                                                             @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END SAMPLE TABLE PORTLET-->
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="tab-pane fade" id="tab_2">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->

                                <div class="portlet box blue" id="search-tool">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-search"></i>{{ Lang::get('manager_form.search.title') }}
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="expand">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body"  style="display: none;">

                                        <form action="{{ URL::Route('auth-get-setting') }}" method="GET" id="search-tool" >
                                            <input type="hidden" name="sort" value="{{ $data_price_happy_code['sort'] }}">
                                            <input type="hidden" name="sort_type"  value="{{ $data_price_happy_code['sort_type'] }}">
                                            <div class="tab-content clearfix">
                                                <div class="form-group last col-md-6">
                                                    <label><b>{{ Lang::get('manager_form.search.sub_title') }}</b></label>
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="fa fa-search"></i>
                                                        </span>
                                                        <input type="text" rows="3" cols="5" class="form-control"  name="key_search"  id="key_search" value="{{ $data_price_happy_code['key_search'] }}" placeholder="{{ Lang::get('manager_form.search.placeholder') }}" />
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
                                                                    <option value="{{ $value['value'] }}" @if(isset($data_price_happy_code) && $data_price_happy_code['limit'] == $value['value'] ) selected="selected" @endif>{{ Lang::get($value['text']) }}</option>
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

                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption ">
                                            <i class="icon-settings font-green"></i>
                                            <span class="caption-subject bold uppercase font-green">{{ Lang::get('happy-code.manage_table') }}</span>
                                        </div>
                                        <div class="actions">
                                            <a data-toggle="modal" data-target="" data-from-action="form-edit-happy-code" class="btn btn-xs blue btn-create-new" title="{{ Lang::get( Config::get('spr.system.button.form.add_new.title')) }}">
                                                <i class="fa {{ Config::get('spr.system.button.form.add_new.icon') }}"></i> {{ Lang::get( Config::get('spr.system.button.form.add_new.text')) }}
                                            </a>
                                        </div>
                                        <div class="pull-right hide">
                                            <?php
                                                $tableInformation = Spr\Base\Controllers\Views\DataTable::dataInformation($data_price_happy_code);
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
                                        <table class="table table-striped table-hover table-checkable order-column dataTable" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data_price_happy_code, '#','','id'); ?>
                                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data_price_happy_code, Lang::get('happy-code.title'),'','title'); ?>
                                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data_price_happy_code, Lang::get('happy-code.discount'),'','discount'); ?>
                                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data_price_happy_code, Lang::get('happy-code.expired_day'),'','expired_day'); ?>
                                                    <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data_price_happy_code, Lang::get('happy-code.price'),'','price'); ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(isset($data_price_happy_code))
                                                    @foreach($data_price_happy_code['data']['response'] as $key => $item)
                                                    <tr class="odd gradeX" data-id="{{ $item->id }}" data-title="{{ $item->title }}" data-discount="{{ $item->discount }}" data-expired_day="{{ $item->expired_day }}" data-price="{{ $item->price }}">
                                                        <td class=" sorting id">
                                                            {{ $item->id }}
                                                        </td>
                                                        <td class="title">
                                                            {{ $item->title }}
                                                        </td>
                                                        <td class="discount">
                                                            {{ $item->discount }}
                                                        </td>
                                                        <td class="expired_day">
                                                            {{ $item->expired_day }}
                                                        </td>
                                                        <td class="price">
                                                            {{ $item->price }}
                                                        </td>
                                                        <td>
                                                            <!-- <a href="javascript:;" class="btn btn-xs green btn-view ">
                                                                <i class="fa fa-search"></i> {{ Lang::get('happy-code.view') }}
                                                            </a> -->
                                                            <a href="javascript:;" class="btn btn-xs blue btn-edit" data-from-delete="form-edit-happy-code">
                                                                <i class="fa fa-edit"></i> {{ Lang::get('happy-code.edit') }}
                                                            </a>
                                                            <!-- <a href="javascript:;" class="btn btn-xs red btn-delete">
                                                                <i class="fa fa-times"></i> Delete
                                                            </a> -->
                                                            <a href="javascript:;" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}"
                                                            data-from-delete="form-delete-happy-code">
                                                                <i class="{{ Config::get('spr.system.button.form.delete.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.delete.text') }} </span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>

                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <form action="{{ URL::Route('auth-post-delete-price-happy-code') }}" method="POST" class="form-delete-happy-code">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h4 class="modal-title">{{ Lang::get('happy-code.form_delete') }}</h4>
                                                            <input type="hidden" name="id" id="id" value="">
                                                        </div>
                                                        <div class="modal-body">
                                                            <h4>{{ Lang::get('happy-code.confirm_delete') }}</h4>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger btn_modal_delete">{{ Lang::get('happy-code.delete') }}</button>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('happy-code.close') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->

                                        <center>
                                            @if(!empty($data_price_happy_code) && ( is_numeric($data_price_happy_code['limit']) || $data_price_happy_code['limit'] =='' ))
                                            {!! $data_price_happy_code['data']['response']->appends(['sort' => $data_price_happy_code['sort'],'limit' => $data_price_happy_code['limit'],'sort_type' => $data_price_happy_code['sort_type']])->render() !!}
                                            @endif
                                        </center>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>

                            <div class="modal fade modal-form-data" id="modalEdit" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <form action="{{ URL::Route('auth-post-insert-update-price-happy-code') }}" method="POST" class="form-action form-edit-happy-code" id="form-action-happy-code" method="POST">

                                            <div class="modal-header">
                                                <div class="caption">
                                                    <i class=" icon-layers font-red"></i>
                                                    <span class="caption-subject font-red sbold uppercase">{{ Lang::get('happy-code.form_add_edit') }}</span>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="id" value="">

                                                <div class="form-body">
                                                    <div class="form-group form-md-line-input">
                                                        <input type="text" class="form-control" id="title" name="title">
                                                        <label for="title">{{ Lang::get('happy-code.title') }}</label>
                                                        <span class="help-block">{{ Lang::get('happy-code.help_title') }}</span>
                                                    </div>
                                                    <div class="form-group form-md-line-input ">
                                                        <input type="text" class="form-control" id="discount" name="discount"/>
                                                        <label for="discount">{{ Lang::get('happy-code.discount') }}</label>
                                                        <span class="help-block">{{ Lang::get('happy-code.help_discount') }}</span>
                                                    </div>
                                                    <div class="form-group form-md-line-input">
                                                        <input type="text" class="form-control" id="expired_day" name="expired_day"/>
                                                        <label for="expired_day">{{ Lang::get('happy-code.expired_day') }}</label>
                                                        <span class="help-block">{{ Lang::get('happy-code.help_expired_day') }}</span>
                                                    </div>
                                                    <div class="form-group form-md-line-input ">
                                                        <input type="text" class="form-control" id="price" name="price"/>
                                                        <label for="price">{{ Lang::get('happy-code.price') }}</label>
                                                        <span class="help-block">{{ Lang::get('happy-code.help_price') }}</span>
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
                    </div>

                    <div class="tab-pane fade" id="tab_3">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN SAMPLE TABLE PORTLET-->
                                <div class="portlet box green">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-comments uppercase"></i>{{ Lang::get('setting.form-title.support.title') }}</div>
                                        <div class="actions">
                                            <a href="javascript:;" data-from-action="form-edit-support" class="btn btn-xs blue {{ Config::get('spr.system.button.form.add_new.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.add_new.title')) }}">
                                                <i class="fa {{ Config::get('spr.system.button.form.add_new.icon') }}"></i> {{ Lang::get( Config::get('spr.system.button.form.add_new.text')) }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-scrollable">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th> Ảnh đại diện </th>
                                                        <th> Tên nhân viên </th>
                                                        <th> Loại hỗ trợ </th>
                                                        <th> Số điện thoại  </th>
                                                        <th> Trạng thái </th>
                                                        <th> Hành động </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(isset($support['data']['response']))
                                                        @foreach($support['data']['response'] as $key => $item)
                                                            <tr class=""  <?php echo Spr\Base\Controllers\Views\DataTable::attrData($item); ?> >
                                                                <td class="avatar">
                                                                    <div class="thumbnail"  style="width: 48px; height: 48px;border: none;">
                                                                        <img class="img-res" name="path" src="{{ URL::asset( $item->path ) }}" style="width: 48px; height: 48px;">
                                                                    </div>
                                                                </td>
                                                                <td class="employee">
                                                                    {{ $item->employee_name }}
                                                                </td>
                                                                <td class="field_support">
                                                                    {{ $item->field_support }}
                                                                </td>
                                                                <td class="phone">
                                                                    {{ $item->phone }}
                                                                </td>
                                                                <td class="status">
                                                                    @if($item->status ==1)
                                                                        <a href="javascript:;"  data-id="{{ $item->id }}" class="btn btn-xs yellow btn-change-active">Hoạt động</a>
                                                                    @else
                                                                        <a href="javascript:;"  data-id="{{ $item->id }}" class="btn btn-xs grey-mint btn-change-active">Không hoạt động</a>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:;" data-from-action="form-action-support" class="btn btn-xs blue {{ Config::get('spr.system.button.form.edit.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.edit.title')) }}">
                                                                        <i class="{{ Config::get('spr.system.button.form.edit.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.edit.text') }} </span>
                                                                    </a>
                                                                    <a href="javascript:;" data-id="{{ $item->id }}" data-from-delete="form-delete-support" class="btn btn-xs red {{ Config::get('spr.system.button.form.delete.class') }}" title="{{ Lang::get( Config::get('spr.system.button.form.delete.title')) }}">
                                                                        <i class="{{ Config::get('spr.system.button.form.delete.icon') }}"></i><span class="title-btn-action"> {{ Lang::get('button.form.delete.text') }} </span>
                                                                    </a>
                                                                </td>
                                                             </tr>
                                                         @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- END SAMPLE TABLE PORTLET-->
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- END PAGE BASE CONTENT -->



    <!-- BEGIN MODAL MANAGER SERVICE OF COMPANY -->
        <div class="modal fade modal-form-data bs-modal-lg in" id="modalEditSetting" role="dialog">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="caption">
                                <i class=" icon-layers font-red"></i>
                                <span class="caption-subject font-red sbold uppercase">{{ Lang::get('setting.form.form-action') }}</span>
                            </div>
                        </div>
                        <!-- BEGIN FORM-->
                    <form action="{{ URL::Route('auth-post-insert-update-setting') }}" method="POST" class="form-edit form-action-company form-horizontal form-bordered" id="form-action-setting" enctype="multipart/form-data">
                        <input type="hidden" class="no-clear" id="token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" class="no-clear" id="key" name="key" value="" >
                        <input type="hidden" class="no-clear" id="icon" name="icon" value="" >
                        <input type="hidden" name="id" id="id">
                        <div class="modal-body">
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3 font-blue bold">{{ Lang::get('setting.form.icon.name') }}</label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 96px; height: 96px;">
                                            <img class="img-preview" name="path" src="">
                                        </div>
                                        <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new">{{ Lang::get('setting.form.icon.select') }}</span>
                                                <span class="fileinput-exists"> {{ Lang::get('setting.form.icon.change') }} </span>
                                                <input type="file" name="image"> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ Lang::get('setting.form.icon.remove') }} </a>
                                        </div>
                                        @if(isset($a['image']))
                                            <div class="alert alert-danger">{{ $a['image'] }}</div>
                                         @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3 font-blue bold" for="title">{{ Lang::get('setting.form.title.name') }}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control clear-msg" id="title" name="title" value="{{ old('title') }}">
                                    <span class="help-block">{{ Lang::get('setting.form.title.help-block') }}</span>
                                    @if(isset($a['title']))
                                        <div class="alert alert-danger">{{ $a['title'] }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3 font-blue bold" for="description">{{ Lang::get('setting.form.description.name') }}</label>
                                <div class="col-md-9">
                                    <textarea class="ckeditor" id="ckeditor" name="description" rows="6"></textarea>
                                    <span class="help-block">{{ Lang::get('setting.form.description.help-block') }}</span>
                                    @if(isset($a['description']))
                                        <div class="alert alert-danger">{{ $a['description'] }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group form-md-line-input">
                                <label class="control-label col-md-3 font-blue bold" for="title">{{ Lang::get('setting.form.icon-class.name') }}</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control clear-msg" id="icon_class" name="icon_class" value="{{ old('icon_class') }}">
                                    @if(isset($a['title']))
                                        <div class="alert alert-danger">{{ $a['icon_class'] }}</div>
                                    @endif
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
    <!-- END MODAL MANAGER SERVICE OF COMPANY -->
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
                    <form  method="POST" class="form-delete" action="{{ URL::Route('auth-post-delete-setting') }}" id="frm_del" >
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

    <!-- Begin modal manager Employee support -->
        <div class="modal fade modal-form-data bs-modal-lg in" id="modalSupport" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="caption">
                            <i class=" icon-layers font-red"></i>
                            <span class="caption-subject font-red sbold uppercase">{{ Lang::get('setting.form.form-action') }}</span>
                        </div>
                    </div>
                    <!-- BEGIN FORM-->
                <form action="{{ URL::Route('auth-post-insert-or-update-support') }}" method="POST" class="form-edit-support form-action-support form-horizontal form-bordered" id="form-action-support" enctype="multipart/form-data">
                    <input type="hidden" class="no-clear" id="token" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <div class="form-group form-md-line-input">
                            <label class="control-label col-md-3 font-blue bold">{{ Lang::get('setting.support.avatar.name') }}</label>
                            <div class="col-md-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                        <img class="img-preview" name="path" src="">
                                    </div>
                                    <div>
                                        <span class="btn red btn-outline btn-file">
                                            <span class="fileinput-new">{{ Lang::get('setting.form.icon.select') }}</span>
                                            <span class="fileinput-exists"> {{ Lang::get('setting.form.icon.change') }} </span>
                                            <input type="file" name="image"> </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{ Lang::get('setting.form.icon.remove') }} </a>
                                    </div>
                                    @if(isset($a['image']))
                                        <div class="alert alert-danger">{{ $a['image'] }}</div>
                                     @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="control-label col-md-3 font-blue bold" for="employee">{{ Lang::get('setting.support.employee.name') }}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control clear-msg" id="employee_name" name="employee_name" value="{{ old('name') }}">
                                <span class="help-block">{{ Lang::get('setting.support.employee.help-block') }}</span>
                                @if(isset($a['name']))
                                    <div class="alert alert-danger">{{ $a['name'] }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="control-label col-md-3 font-blue bold" for="field_support">{{ Lang::get('setting.support.field_support.name') }}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control clear-msg" id="field_support" name="field_support" value="{{ old('field_support') }}">
                                <span class="help-block">{{ Lang::get('setting.support.field_support.help-block') }}</span>
                                @if(isset($a['field_support']))
                                    <div class="alert alert-danger">{{ $a['field_support'] }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label class="control-label col-md-3 font-blue bold" for="phone">{{ Lang::get('setting.support.phone.name') }}</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control clear-msg" id="phone" name="phone" value="{{ old('phone') }}">
                                <span class="help-block">{{ Lang::get('setting.support.phone.help-block') }}</span>
                                @if(isset($a['phone']))
                                    <div class="alert alert-danger">{{ $a['phone'] }}</div>
                                @endif
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
    <!-- End modal manager Employee support -->

    <!-- Modal delete support -->
        <div id="deleteSupportModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="caption">
                        <i class=" icon-layers font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">{{ Lang::get('banner.banner-detail.modal-delete.form-action.title') }}</span>
                    </div>
                    </div>
                    <form  method="POST" class="form-delete-support" action="{{ URL::Route('auth-post-delete-support') }}" id="frm_del_support" >
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
    <!-- End Modal delete support-->



@endsection