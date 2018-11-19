/**
Custom module for you to write your own javascript functions
**/
var SlideDetail = function () {

    var elem_block_loadding;
    var elm_active;

    var openModal = function (data) {

        $("#modal_edit").modal();
        var msg = '';

        for (var key in data) {
            msg += data[key];
            msg += "<br>";
        }

        $("#modal_error").html(msg);
        $("#modal_error").prop("style", "display: block");
        $("#title").val(data['response']['title']);
        $("#link").val(data['response']['link']);


    };

    var callBack_get_image_information = function(data) {

        if (data.meta.success) {

            var item = data.response.response;

            var node = '';
            node += '<input type="hidden" class="form-control" name="id" value="' + item.id + '">' + '<br/>';
            node += '<label for="title">Title:</label>';
            node += '<input type="text" class="form-control" name="title" value="' + item.title + '">' + '<br/>';
            node += '<label for="title">Link:</label>';
            node += '<input type="text" class="form-control" name="link" value="' + item.link + '">' + '<br/>';
            node += '<label for="title">Image:</label>';
            node += '<img src="{{ URL::asset(' + item.path + ') }}" alt="{{ $item->path }}" style="width: 150px; height: 150px">';

            $('#node').html(node);
        }
    };

    var callBack_get_image_information_view = function(data) {

        if (data.meta.success) {

            var item = data.response.response;

            var node = '';
            node += '<label for="title">Title:</label>';
            node += '<span class="form-control">' + item.title + '</span>' + '<br/>';
            node += '<label for="title">Link:</label>';
            node += '<span class="form-control">' + item.link + '</span>' + '<br/>';
            node += '<label for="title">Image:</label>';
            node += '<img src="{{ URL::asset(' + item.path + ') }}" alt="{{ $item->path }}" style="width: 150px; height: 150px">';

            $('#node_view').html(node);
        }
    };

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                var form  = $('.form-action-view-edit');
                var rules = {

                    title: {
                        required: true,
                        minlength: 5,
                        maxlength: 500
                    },
                    link: {
                        required: true,
                        minlength: 5,
                        maxlength: 500
                    },
                    image: {
                        // required: true
                    }
                }
                Validate.base_validate(form, rules);

                $(document).on('click','.btn-delete', function(e){

                    e.preventDefault();
                    $("form#frm_del > input#id").val($(this).closest('[data-id]').data("id"));

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



                    $(document).on('click','.btn-delete', function(e){

                        e.preventDefault();

                        id = $(this).closest('[data-id]').data("id");

                        $('#modal_delete_id').val(id);
                    });
                });
            });
        },

        custom: function(data) {
            openModal(data);
        },
    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();