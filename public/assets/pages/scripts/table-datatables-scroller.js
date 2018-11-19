var TableDatatablesScroller = function () {

    var initTable = function () {
        var table = $('#dataTable');

        var oTable = table.dataTable({
            "bSort": false,
            "bFilter": false,
            "Bfrtip" :false,
            "info": false,
            "bLengthChange": false,
        });


    }

    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            initTable();
        }

    };

}();

jQuery(document).ready(function() {
    TableDatatablesScroller.init();
});