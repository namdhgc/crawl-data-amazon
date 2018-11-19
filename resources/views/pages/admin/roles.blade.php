@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('menu.roles') }}</title>
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
    </style>
@endsection

@section('js')
    <script src="{{ URL::asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/datatables.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/pages/scripts/table-datatables-managed.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('js/lib/validate.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/manage/permission/roles.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        Roles.init();
    </script>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-4">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet light portlet-fit portlet-form bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class=" icon-layers font-red"></i>
                        <span class="caption-subject font-red sbold uppercase">Form thêm/sửa</span>
                    </div>
                    <div class="actions">
                    </div>
                </div>
                <div class="portlet-body clearfix">
                    <!-- BEGIN FORM-->
                    <form action="{{ URL::Route('auth-post-update-roles') }}" method="POST" class="form-edit form-action" id="form-action-roles">
                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" id="id" value="">

                        <div class="form-body">
                            <div class="form-group form-md-line-input">
                                <input type="text" class="form-control" id="name" name="name">
                                <label for="name">Tên</label>
                                <span class="help-block">Nhập tên của nhóm quyền ...</span>
                            </div>
                            <div class="form-group form-md-line-input ">
                                <textarea class="form-control" id="remake" name="remake" rows="3"></textarea>
                                <label for="remake">Mô tả</label>
                                <span class="help-block">Mô tả cho nhóm quyền...</span>
                            </div>
                        </div>


                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- <a href="javascript:void(0)" class="btn green btn-submit">Submit</a> -->
                                    <input type="submit" name="submit" value="{{ Lang::get('button.form.submit.title') }}" class="btn green btn-submit">
                                    <a href="javascript:;" class="btn default btn-cancel">{{ Lang::get('button.form.cancel.title') }}</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END VALIDATION STATES-->
        </div>
        <div class="col-md-8">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption ">
                        <i class="icon-settings font-green"></i>
                        <span class="caption-subject bold uppercase font-green"> Bảng quản lý</span>
                    </div>
                    <div class="actions">

                        <div class="btn-group">
                            <?php
                                $tableInformation = Spr\Base\Controllers\Views\DataTable::dataInformation($data);
                                $formItem = $tableInformation['formItem'];
                                echo $tableInformation['html'];
                            ?>
                        </div>
                    </div>
                </div>
                <div class="portlet-body clearfix">
                    <div class="table-toolbar">
                        <div class="row">
                        </div>
                    </div>
                    <table class="table table-striped table-hover order-column dataTable" id="dataTable">
                        <thead>
                            <tr>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, '#','','id'); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Tên','',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Trạng thái','',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($data, 'Hành động','',''); ?>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data))
                                @foreach($data['data']['response'] as $key => $item)
                                <tr class="odd gradeX"  <?php echo Spr\Base\Controllers\Views\DataTable::attrData($item); ?>>
                                    <td class=" sorting id">
                                        {{ $item->id}}
                                    </td>
                                    <td class="name">
                                        {{ $item->name}}
                                    </td>
                                    <td class="status">
                                        {{ $item->status}}
                                    </td>
                                    <td>
                                        <a href="javascript:;" class="btn btn-xs green btn-view ">
                                            <i class="fa fa-search"></i> Xem
                                        </a>
                                        <a href="javascript:;" class="btn btn-xs blue btn-edit">
                                            <i class="fa fa-edit"></i> Sửa
                                        </a>
                                        <a href="javascript:;" class="btn btn-xs purple btn-change-permission">
                                            <i class="fa fa-lock"></i> Thay đổi quyền hạn
                                        </a>
                                        <a href="javascript:;" class="btn btn-xs red btn-delete-permission" data-role_id="{{ $item->id}}">
                                            <i class="fa fa-times"></i> Xóa
                                        </a>
                                        <!-- <input type="button" id="btn_delete" value="Delete" class="btn btn-xs red btn-delete" data-toggle="modal" data-target="#myModal"> -->
                                    </td>
                                </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>

                    <!-- MODAL ROLES_PERMISSION -->
                    <div class="modal fade bs-modal-lg" id="modal-permission-role" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Quyền hạn</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="#" method="POST" class="delete_form">
                                        <div class="portlet-body flip-scroll table-responsive">
                                            <table class="table table-striped table-condensed flip-content" id="table-permission-role">
                                                <thead class="flip-content">
                                                    <tr>
                                                        <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable([], Lang::get("permission.module_name"),'',''); ?>
                                                        <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable([], Lang::get("permission.read"),'',''); ?>
                                                        <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable([], Lang::get("permission.write"),'',''); ?>
                                                        <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable([], Lang::get("permission.permit"),'',''); ?>
                                                        <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable([], Lang::get("permission.all"),'',''); ?>
                                                    </tr>
                                                </thead>
                                                <?php
                                                    // echo "<pre>";
                                                    // echo "roles <br>";
                                                    // print_r(Cache::get('roles'));
                                                    // echo "permissionRoles <br>";
                                                    // print_r(Cache::get('permissionRoles'));
                                                    // echo "module <br>";
                                                    // print_r(Cache::get('module'));
                                                    
                                                    // exit;
                                                ?>
                                                <tbody id="permission_roles_body">
                                                @foreach (Cache::get('module') as $m_key => $m_value)
                                                    <tr data-m-id="{{ $m_value }}">
                                                        <td ><span style="text-align: left;">{{ Cache::get('module-lang')[$m_key]['lang'] }}</span></td>
                                                        <td>
                                                            <input type="checkbox" class="ckb-permission" data-name="read" data-module_id="{{ $m_value }}" value="" name="read">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="ckb-permission" data-name="write" data-module_id="{{ $m_value }}" value="" name="write">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="ckb-permission" data-name="permit" data-module_id="{{ $m_value }}" value="" name="permit">
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" class="checkbox" data-name="all"  value="" name="all">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Xong</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL -->

                    <!-- Modal delete-->
                    <div class="modal fade" id="modal-delete-permission-role" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">{{ Lang::get('permission.delete_roles') }}</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="#" method="POST" class="delete_form">
                                        <table class="table table-striped" id="tblGrid">
                                            <thead id="tblHead">
                                                <tr>
                                                    <th>#</th>
                                                    <th>{{ Lang::get('permission.name') }}</th>
                                                    <th>{{ Lang::get('permission.status') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="id" id="id" value="">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <span id="modal_id"></span>
                                                    </td>
                                                    <td>
                                                        <span id="modal_name"></span>
                                                    </td>
                                                    <td>
                                                        <span id="modal_status"></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger btn_modal_delete" data-dismiss="modal">{{ Lang::get('permission.delete') }}</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ Lang::get('permission.close') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->

                    <center>
                        {!! Spr\Base\Controllers\Views\DataTable::paginate($data); !!}
                    </center>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection