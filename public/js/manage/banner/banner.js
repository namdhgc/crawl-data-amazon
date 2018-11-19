var Banner = function () {

	var elem_block_loadding;
	var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                $(document).on('click','.clear-msg',function(e){

                     e.preventDefault();

                    $(this).closest('div').find('div.alert').hide();

                });

            });

        }
    };

}();