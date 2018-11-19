@extends('layouts/admin/master')

@section('title')
    <title>{{ Lang::get('menu.permission') }}</title>
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
    <script src="{{ URL::asset('js/manage/permission/category.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/lib/helper.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('js/lib/spr.js') }}" type="text/javascript"></script>

    <script type="text/javascript">

        Category.init();
        Helper.ResetValue();

    </script>

    <script>
        // $('.checkbox').prop('checked', false); // change actual state



        $('#select_role').on('change', function() {

            var id = this.value;
            var token   = $('#token').val();

            var data = {
                id: id,
                _token: token
            };

            var callBack = function(data) {
                if (data.meta.success) {

                    console.log(data.response);

                    if (!$.isEmptyObject(data.response)) {

                        $.each(data.response, function (obj, item) {

                            console.log($('input[type=checkbox][data-module_id='+item.module_id+'][data-name=read]'));
                            $('input[type=checkbox][data-module_id='+item.module_id+'][data-name=read]').attr('checked',item.read);
                            $('input[type=checkbox][data-module_id='+item.module_id+'][data-name=write]').attr('checked',item.write);
                            $('input[type=checkbox][data-module_id='+item.module_id+'][data-name=confirm]').attr('checked',item.confirm);
                            $('input[type=checkbox][data-module_id='+item.module_id+'][data-name=deletable]').attr('checked',item.deletable);
                            $('input[type=checkbox][data-module_id='+item.module_id+'][data-name=export]').attr('checked',item.export);
                            $('input[type=checkbox][data-module_id='+item.module_id+'][data-name=import]').attr('checked',item.import);
                        });
                    }
                }
                $.uniform.update('.checkbox'); // sync the UI

            };

            Spr.ajaxDefault('/ajax-select-permission', data, callBack,$(this));

        });

        $.uniform.update('.checkbox'); // sync the UI
    </script>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption ">
                        <i class="icon-settings font-green"></i>
                        <span class="caption-subject bold uppercase font-green">{{ Lang::get('permission.title') }}</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group">

                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <form action="#" method="POST" class="" id="">
                        <div class="form-group">
                            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                            <label for="select_role">{{ Lang::get('permission.select_role') }}:</label>
                            <select class="form-control input-medium" id="select_role">
                                @if(isset($role))
                                    @foreach ($role['response'] as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </form>

                    <table class="table table-striped table-hover table-checkable order-column dataTable" id="dataTable">
                        <thead>
                            <tr>
                                <th></th>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($permission, Lang::get("permission.read"),'',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($permission, Lang::get("permission.write"),'',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($permission, Lang::get("permission.deletable"),'',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($permission, Lang::get("permission.confirm"),'',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($permission, Lang::get("permission.comment"),'',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($permission, Lang::get("permission.import"),'',''); ?>
                                <?php echo Spr\Base\Controllers\Views\DataTable::headerCellTable($permission, Lang::get("permission.export"),'',''); ?>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($permission))
                            <?php
                            // echo "<pre>";
                            // print_r($permission['response']);
                            // exit;
                            ?>

                            @foreach ($permission['response'] as $key => $value)
                            <tr>
                                <td>{{ $value->name }}</td>
                                <td>
                                    <input type="checkbox" class="checkbox" data-name="read" data-module_id="{{ $value->module_id }}" data-roles_id="{{ $value->roles_id }}" value="" name="read" {{ $value->read == 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="checkbox" data-name="write" data-module_id="{{ $value->module_id }}" data-roles_id="{{ $value->roles_id }}" value="" name="write" {{ $value->write == 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="checkbox" data-name="deletable" data-module_id="{{ $value->module_id }}" data-roles_id="{{ $value->roles_id }}" value="" name="deletable" {{ $value->deletable == 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="checkbox" data-name="confirm" data-module_id="{{ $value->module_id }}" data-roles_id="{{ $value->roles_id }}" value="" name="confirm" {{ $value->confirm == 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="checkbox" data-name="comment" data-module_id="{{ $value->module_id }}" data-roles_id="{{ $value->roles_id }}" value="" name="comment" {{ $value->comment == 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="checkbox" data-name="import" data-module_id="{{ $value->module_id }}" data-roles_id="{{ $value->roles_id }}" value="" name="import" {{ $value->import == 1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="checkbox" data-name="export" data-module_id="{{ $value->module_id }}" data-roles_id="{{ $value->roles_id }}" value="" name="export" {{ $value->export == 1 ? 'checked' : '' }}>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection