/**
Custom module for you to write your own javascript functions
**/
var Slide = function () {

	var elem_block_loadding;
	var elm_active;

    var callBack_get_image_information = function(data) {
        
        if (data.meta.success) {

            var item = data.response.response;
            
            var node = '';
            node += '<input type="hidden" class="form-control" name="id" value="' + item.id + '">' + '<br/>';
            node += '<label for="title">Title:</label>';
            node += '<input type="text" class="form-control" name="title" value="' + item.title + '">' + '<br/>';
            node += '<label for="title">Description:</label>';
            node += '<input type="text" class="form-control" name="description" value="' + item.description + '">' + '<br/>';
            node += '<label for="title">Link:</label>';
            node += '<input type="text" class="form-control" name="link" value="' + item.link + '">' + '<br/>';

            $('#node').html(node);
        }
    };

    var callBack_get_image_information_view = function(data) {
        
        if (data.meta.success) {

            var item = data.response.response;
            
            var node = '';
            node += '<label for="title">Title:</label>';
            node += '<span class="form-control">' + item.title + '</span>' + '<br/>';
            node += '<label for="title">Description:</label>';
            node += '<span class="form-control">' + item.description + '</span>' + '<br/>';
            node += '<label for="title">Link:</label>';
            node += '<span class="form-control">' + item.link + '</span>' + '<br/>';

            $('#node_view').html(node);
        }
    };

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('#form-add-slide');
                var rules = {

                    lang_code: {
                        required: true
                    },
                    title: {
                        maxlength: 500
                    },
                    description: {
                        maxlength: 500
                    },
                    link: {
                        maxlength: 500,
                        required: true
                    }
                }
                Validate.base_validate(form, rules);
            });


            $(document).ready(function(){
                $("#banner_id").val(null);

                $(document).on('click','#main_slide', function(e){

                    if ($(this).is(':checked')) {
                        
                        $('#slc_category').attr('style', 'display: none');
                        $("#banner_id").val(null);
                    }
                    else {
                        $("#banner_id").val('1');
                        $('#slc_category').attr('style', 'display: block');
                    }
                });

                $(document).on('click','.btn-edit', function(e){

                    e.preventDefault();

                    id = $(this).closest('[data-id]').data("id");

                    var data = {
                        id: id,
                    };

                    App.blockUI({
                        target: '.portlet-body',
                        boxed: true,
                        textOnly: true
                    });

                    window.setTimeout(function() {
                        App.unblockUI('.portlet-body');
                    }, 1000);

                    Spr.ajaxDefault('/manager/ajax/get-image-information', data, callBack_get_image_information,$(this));
                });

                $(document).on('click','.btn-view', function(e){

                    e.preventDefault();

                    id = $(this).closest('[data-id]').data("id");

                    var data = {
                        id: id,
                    };

                    App.blockUI({
                        target: '.portlet-body',
                        boxed: true,
                        textOnly: true
                    });

                    window.setTimeout(function() {
                        App.unblockUI('.portlet-body');
                    }, 1000);

                    Spr.ajaxDefault('/manager/ajax/get-image-information', data, callBack_get_image_information_view,$(this));
                });

                $(document).on('click','.btn-delete', function(e){

                    e.preventDefault();

                    id = $(this).closest('[data-id]').data("id");

                    $('#modal_delete_id').val(id);
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