var PriceDatatablesEditable = function () {
    var oTable = null;
    var elem_block_loadding;
    var elm_active;
    var id_parent = null;
    var table = $('#price-list-detal-editable');
    var form = $('#form-price-list-detal-editable');
    var n_Row = null;

    var handleTable = function () {

        function restoreRow( nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                oTable.fnUpdate(aData[i], nRow, i, false);
            }

            oTable.fnDraw();
        }

        function editRow( nRow) {
            var aData = oTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            jqTds[1].innerHTML = '<input type="text" id="key" name="key" class="form-control input-small" value="' + aData[1] + '">';
            jqTds[2].innerHTML = '<input type="text" id="value" name="value" class="form-control input-small" value="' + aData[2] + '">';
            jqTds[3].innerHTML = '<a class="edit" href="">Save</a>';
            jqTds[4].innerHTML = '<a class="cancel" href="">Cancel</a>';
            var rules = {

                key: {
                    required: true,
                    minlength: 3,
                    maxlength: 200
                },
                value: {
                    numeric:true,
                    min: 0,
                    max: 100,
                }
            }
            Validate.base_validate(form, rules);
        }

        function saveRow( nRow) {
            n_Row = nRow;
            var aData = oTable.fnGetData(nRow);
            var jqInputs = $('input', nRow);

            var url = "/manager/ajax/update-price-list-detail";
            var id  = aData[0];
            var data = {
                'id' : id,
                'price_id' : '',
                'key': jqInputs[0].value,
                'value':jqInputs[1].value,
            };

            if(id == '' || id == null){

                data.price_id = id_parent;
                url = "/manager/ajax/new-price-list-detail";
                Spr.ajaxDefault(url, data, callBack_insert_price_list_detail,$(this));
            }else{
                Spr.ajaxDefault(url, data, callBack_update_price_list_detail,$(this));
            }

        }

        function cancelEditRow( nRow) {
            var jqInputs = $('input', nRow);
            oTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
            oTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
            oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 3, false);
            oTable.fnDraw();
        }

        oTable = table.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js).
            // So when dropdowns used the scrollable div should be removed.
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "lengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            "columns" : [
                { 'title' : '#'},
                { 'title' : 'Loại Chi Phí'},
                { 'title' : 'Mức Phí'},
                { 'title' : 'Edit'},
                { 'title' : 'Delete'},
            ],
            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // set the initial value
            "pageLength": 5,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var nEditing = null;
        var nNew = false;

        $('#add-new').click(function (e) {
            e.preventDefault();

            if (nNew && nEditing) {
                if (confirm("Previose row not saved. Do you want to save it ?")) {
                    saveRow( nEditing); // save
                    $(nEditing).find("td:first").html("Untitled");
                    nEditing = null;
                    nNew = false;

                } else {
                    oTable.fnDeleteRow(nEditing); // cancel
                    nEditing = null;
                    nNew = false;
                    return;
                }
            }

            var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
            oTable.fnDraw();
            var nRow = oTable.fnGetNodes(aiNew[0]);
            editRow( nRow);
            nEditing = nRow;
            nNew = true;
        });

        table.on('click', '.delete', function (e) {
            e.preventDefault();

            if (confirm("Are you sure to delete this row ?") == false) {
                return;
            }

            var nRow = $(this).parents('tr')[0];
            var aData = oTable.fnGetData(nRow);
            oTable.fnDeleteRow(nRow);
            var url = "/manager/ajax/delete-price-list-detail";
            var id  = aData[0];
            var data = {
                'id' : id,
            };
            Spr.ajaxDefault(url, data, callBack_delete_price_list_detail,$(this));
        });

        table.on('click', '.cancel', function (e) {
            e.preventDefault();
            if (nNew) {
                oTable.fnDeleteRow(nEditing);
                nEditing = null;
                nNew = false;
            } else {
                restoreRow( nEditing);
                nEditing = null;
            }
        });

        table.on('click', '.edit', function (e) {
            e.preventDefault();

            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];
            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                restoreRow( nEditing);
                editRow(nRow);
                nEditing = nRow;
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveRow( nEditing);
                nEditing = null;
            } else {
                /* No edit in progress - let's start one */
                editRow( nRow);
                nEditing = nRow;
            }
        });
    }

    var callBack_get_price_list_detail = function(data){
        if (data.meta.success) {

            var item = data.response;
            $('#price-list-detal-editable').DataTable().clear().draw();;
            $.each(item, function(key, item){

                var aiNew = oTable.fnAddData([item.id, item.key, item.value, '', '']);
                oTable.fnUpdate('<a class="edit" href="">Edit</a>', aiNew, 3, true);
                oTable.fnUpdate('<a class="delete" href="">Delete</a>', aiNew, 4, true);
                oTable.fnDraw();

            });
            $('#modal-price-list-detail').modal('show');
        }
    }
    var callBack_delete_price_list_detail = function(data){


    }
    var callBack_insert_price_list_detail = function(data){

        var jqInputs = $('input', n_Row);

        if(data.meta.success){

            if(data.response.id != null || data.response.id!=''){

                var id = data.response.id;

                oTable.fnUpdate(id, n_Row, 0, false);

                oTable.fnUpdate(jqInputs[0].value, n_Row, 1, false);

                oTable.fnUpdate(jqInputs[1].value, n_Row, 2, false);

                oTable.fnUpdate('<a class="edit" href="">Edit</a>', n_Row, 3, false);

                oTable.fnUpdate('<a class="delete" href="">Delete</a>', n_Row, 4, false);

                oTable.fnDraw();
            }
        }
    }
    var callBack_update_price_list_detail = function(data){

            var jqInputs = $('input', n_Row);

            oTable.fnUpdate(jqInputs[0].value, n_Row, 1, false);

            oTable.fnUpdate(jqInputs[1].value, n_Row, 2, false);

            oTable.fnUpdate('<a class="edit" href="">Edit</a>', n_Row, 3, false);

            oTable.fnUpdate('<a class="delete" href="">Delete</a>', n_Row, 4, false);

            oTable.fnDraw();
    }

    var callBack_change_type =  function(data){

        if (data.meta.success) {

           var selected_id  = data.response.id;
           var type       = data.response.type;


           var tr   = $('tr[data-id="'+ selected_id +'"]').first();

           var a    = $('a[data-id="'+ selected_id +'"]').first();

           if(type == 0){

                a.removeClass('yellow').addClass('grey-mint');
                a.text('Mặc định');

           }else{

                a.removeClass('grey-mint').addClass('yellow');
                a.text('Bình thường');
           }

           tr.attr('data-type',type); 
           a.attr('data-type',type);       
        }
    }
    return {

        //main function to initiate the module
        init: function () {

            handleTable();

            $(document).ready(function(){

                $(document).on('click','.btn-add-more-than', function(e){

                    e.preventDefault();
                    id_parent = $(this).closest('[data-id]').data("id");
                    var data = {
                            id: id_parent,
                        };
                    Spr.ajaxDefault('/manager/ajax/get-price-list-detail', data, callBack_get_price_list_detail,$(this));
                });

                $(document).on('click','.btn-delete', function(e){

                    e.preventDefault();

                    $('#frm_del').find('#id').val($(this).attr('data-id'));

                });

                $(document).on('click','.btn-change-active',function(e){

                    e.preventDefault();

                    var id      = $(this).attr('data-id');
                    var type    = $(this).attr('data-type');

                    var data = {

                        id          : id,
                        type        :type,

                    };

                    Spr.ajaxDefault('/manager/ajax/update-type-price', data, callBack_change_type,'.portlet-body');
                });
                               
            });
        }

    };

}();
