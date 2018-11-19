@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('menu.user-roles') }}</title>
@endsection

@section('css')
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
    </style>
@endsection

@section('js')
    <script src="{{ URL::asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/datatables.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/pages/scripts/table-datatables-managed.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/lib/helper.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/lib/spr.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/permission/user_roles.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        UserRoles.init();
    </script>

    <script>
        
    </script>
@endsection

<?php
    $roles = Cache::get('roles');
    $arr_department = Config::get('defined_array.department');
?>

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption ">
                        <i class="fa fa-cogs font-green"></i>
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('userRoles.tool-box') }}</span>
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                        <!-- <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                        <a href="javascript:;" class="remove" data-original-title="" title=""> </a> -->
                    </div>
                </div>
                <div class="portlet-body table-toolbar">
                    <div class="row">
                    </div>
                    <div class="form-group">
                        <form class="form-horizontal" role="form" action="{{ URL::Route('auth-get-user-roles') }}" method="GET">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{ Lang::get('userRoles.username') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa fa-user"></i>
                                            <input type="text" class="form-control" name="username" value="{{ @$data['username'] }}" placeholder="{{ Lang::get('userRoles.username') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{ Lang::get('userRoles.first_name') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa fa-user-secret"></i>
                                            <input type="text" class="form-control" name="first_name" value="{{ @$data['first_name'] }}" placeholder="{{ Lang::get('userRoles.first_name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{ Lang::get('userRoles.last_name') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa fa-user-secret"></i>
                                            <input type="text" class="form-control" name="last_name" value="{{ @$data['last_name'] }}" placeholder="{{ Lang::get('userRoles.last_name') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{ Lang::get('userRoles.email') }}</label>
                                    <div class="col-md-6">
                                        <div class="input-icon right">
                                            <i class="fa fa-envelope"></i>
                                            <input type="text" class="form-control" name="email" value="{{ @$data['username'] }}" placeholder="{{ Lang::get('userRoles.email') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">{{ Lang::get('userRoles.select_roles') }}</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="roles">
                                            <option value="">{{ Lang::get('userRoles.all') }}</option>
                                            @foreach ($roles as $key => $value)
                                                <option value="{{ $key }}" {{ @$data['roles'] == $key ? 'selected' : '' }}>{{ $value['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="submit" class="btn btn-primary" value="{{ Lang::get('button.form.search.title') }}">
                                        <input type="button" class="btn btn-warning btn-reset " value="{{ Lang::get('button.form.reset.title') }}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box light bordered">
                <div class="portlet-title">
                    <div class="caption ">
                        <i class="icon-settings font-green"></i>
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('menu.user-roles') }}</span>
                    </div>
                    <div class="actions">

                        <div class="btn-group">
                            <?php
                                // $tableInformation = Spr\Base\Controllers\Views\DataTable::dataInformation($data);
                                // $formItem = $tableInformation['formItem'];
                                // echo $tableInformation['html'];
                            ?>
                        </div>
                    </div>
                </div>
                <div class="portlet-body flip-scroll">
                    <table class="table table-striped table-hover table-bordered table-checkable flip-content order-column dataTable" id="dataTable">
                        <thead>
                            <tr>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','','id'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('userRoles.username'),'',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('userRoles.fullname'),'',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('userRoles.email'),'',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('userRoles.roles'),'',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, Lang::get('userRoles.action'),'',''); ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // echo "<pre>";
                            // print_r($data);
                            // exit;
                            ?>
                            @if(isset($data) && $data['data']['response']->total() != 0)
                                @foreach($data['data']['response'] as $key => $item)
                                    <tr class="odd gradeX" data-id="{{ $item->id }}" data-username="{{ $item->username }}" data-fullname="{{ $item->first_name . ' ' . $item->last_name }}" data-email="{{ $item->email }}" data-roles="{{ $item->roles }}">
                                        <td class=" sorting id">
                                            {{ $item->id }}
                                        </td>
                                        <td class="username">
                                            {{ $item->username }}
                                        </td>
                                        <td class="fullname">
                                            {{ $item->first_name . ' ' . $item->last_name }}
                                        </td>
                                        <td class="email">
                                            {{ $item->email }}
                                        </td>
                                        <td class="email">
                                            @foreach ($roles as $key => $value)
                                                {{ $key == $item->roles ? $value['name'] : '' }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-xs green btn-view ">
                                                <i class="fa fa-search"></i> {{ Lang::get('button.form.view.title') }}
                                            </a>
                                            <!-- <a href="javascript:;" class="btn btn-xs blue btn-edit">
                                                <i class="fa fa-edit"></i> Edit
                                            </a> -->
                                            <!-- <a href="{{ URL::Route('auth-post-delete-category') }}" class="btn btn-xs red btn-delete">
                                                <i class="fa fa-times"></i> Delete
                                            </a> -->
                                            <input type="button" id="btn_update" value="{{ Lang::get('button.form.update.title') }}" class="btn btn-xs blue btn-edit" data-toggle="modal" data-target="#modalUpdate">
                                            <!-- <input type="button" id="btn_delete" value="Delete" class="btn btn-xs red btn-delete" data-toggle="modal" data-target="#modalDelete"> -->
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    
                    <!-- Modal update-->
                    @if(isset($data) && $data['data']['response']->total() != 0)
                    <div class="modal fade" id="modalUpdate" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{ Lang::get('userRoles.update-roles') }}</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ URL::Route('auth-post-update-user-roles') }}" method="POST" class="update_form form-edit">
                                        <table class="table table-striped" id="tblGrid">
                                            <thead id="tblHead">
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ Lang::get('userRoles.username') }}</th>
                                                    <th>{{ Lang::get('userRoles.fullname') }}</th>
                                                    <th>{{ Lang::get('userRoles.email') }}</th>
                                                    <th>{{ Lang::get('userRoles.roles') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="id" id="id" value="">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <span id="modal_update_id"></span>
                                                    </td>
                                                    <td>
                                                        <span id="modal_update_username"></span>
                                                    </td>
                                                    <td>
                                                        <span id="modal_update_fullname"></span>
                                                    </td>
                                                    <td>
                                                        <span id="modal_update_email"></span>
                                                    </td>
                                                    <td>
                                                        <span id="modal_update_roles"></span>
                                                        <select class="form-control" name="roles">
                                                            @foreach ($roles as $key => $value)
                                                                <option value="{{ $key }}" {{ $key == $item->roles ? 'selected' : '' }} >{{ $value['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger btn_modal_update" data-dismiss="modal">{{ Lang::get('userRoles.update') }}</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('userRoles.close') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- End modal update -->

                    <!-- Modal delete-->
                    <div class="modal fade" id="modalDelete" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{ Lang::get('userRoles.update-roles') }}</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ URL::Route('auth-post-delete-category') }}" method="POST" class="delete_form">
                                        <table class="table table-striped" id="tblGrid">
                                            <thead id="tblHead">
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ Lang::get('userRoles.username') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="id" id="id" value="">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <span id="modal_delete_id"></span>
                                                    </td>
                                                    <td>
                                                        <span id="modal_delete_name"></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger btn_modal_delete" data-dismiss="modal">{{ Lang::get('userRoles.delete') }}</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('userRoles.close') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End modal delete -->

                    <center>
                        @if(!empty($data) && ( is_numeric($data['limit']) || $data['limit'] =='' ))
                        {!! $data['data']['response']->appends([
                                'sort' => $data['sort'],
                                'limit' => $data['limit'],
                                'sort_type' => $data['sort_type']
                            ])->render() !!}
                        @endif
                    </center>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection