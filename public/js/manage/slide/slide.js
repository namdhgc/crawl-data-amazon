/**
Custom module for you to write your own javascript functions
**/
var Slide = function () {

	var elem_block_loadding;
	var elm_active;

    var callBack_check_status = function(data) {

        if (data.meta.success) {

            var selected_id = data.response.id;
            var title       = data.response.title;
            var status      = data.response.status;
            var tr          = $('tr[data-id="'+ selected_id +'"]').first();
            window.location.reload();
            if(status == 0) {

                tr.find('a[class="btn_change_status btn btn-xs yellow"]').first().removeClass('yellow').addClass('grey-mint');
                tr.attr("data-status", status);
                tr.find('span[class="title-btn-action"]').first().text(title);
            }else{

                tr.find('a[class="btn_change_status btn btn-xs grey-mint"]').first().removeClass('grey-mint').addClass('yellow');
                tr.attr("data-status", status);
                tr.find('span[class="title-btn-action"]').first().text(title);
            }
        }
    };

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-add-slide');
                var rules = {

                    title: {
                        required: true,
                        minlength: 5,
                        maxlength: 500
                    },
                    description: {
                        required: true,
                        minlength: 5,
                        maxlength: 500
                    },
                    lang_code: {
                        required: true
                    }
                }
                Validate.base_validate(form, rules);

                // $(document).on('click','.btn-delete', function(e){

                //     e.preventDefault();
                //     $("form#frm_del > input#id").val($(this).attr('data-id'));

                // });

                $(document).on('click','.btn_change_status', function(e){

                    e.preventDefault();

                    id              = $(this).parents('tr').first().attr('data-id');
                    status          = $(this).parents('tr').first().attr('data-status');

                    var data = {
                        id      : id,
                        status  : status,
                    };



                    Spr.ajaxDefault('/manager/ajax/update-slide-status', data, callBack_check_status,'.portlet-body');
                });

                $("#banner_id").val(null);

                $(document).on('click','#main_slide', function(e){

                    if ($(this).is(':checked')) {

                        $('#slc_category').hide();
                    }
                    else {
                        $('#slc_category').show();
                    }
                });
            });
        },
    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();