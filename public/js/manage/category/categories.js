/**
Custom module for you to write your own javascript functions
**/
var Categories = function () {

	var elem_block_loadding;
	var elm_active;

    var callBack_get_data_select = function(data) {
        if (data.meta.success) {

            var item = data.response;
            if(item.response.length == 1){
                $('#lang_id').val(item.response[0].id);
                $('#name_region').val(item.response[0].name);
            }else{
                $('#lang_id').val("");
                $('#name_region').val("");
            }
        }
    };
    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

            	$(document).on('click','.btn-edit', function(e){

                    var level              = $(this).closest('[data-level]').data("level");
                    if(level > 0){
                        $('#title_upload').css("display", "none");
                        $('#upload').css("display", "none");
                        $('#title_lang').attr('class','active');
                    }else{
                        $('#title_upload').css("display", "");
                        $('#upload').css("display", "");
                        $('#title_lang').attr('class','');
                    }

                    $('#lang_code').val("");
                    $('#name_region').val("");
                    $('#lang_id').val("");          
                    
                });

                $(document).on('change','#lang_code', function(e){

                    var lang_code                = $(this).val();
                    var id                       = $('#id').val();

                    if(lang_code != '' && id != ''){

                        var data = {
                            id: id,
                            lang_code:lang_code,

                        };

                        Spr.ajaxDefault('/manager/ajax/get-product-category-lang', data, callBack_get_data_select,$(this));
                    }           
                    
                });
            	
            });
        }
    };

}();

/***
Usage
***/
//Custom.init();
//Custom.doSomeStuff();