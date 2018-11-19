
var DetailProduct = function () {

	var elem_block_loadding;
	var elm_active;

    // public functions
    return {

        //main function

        init: function () {

            $(document).ready(function(){

                $( document ).on( 'click' , "div.expand-btn" , function ( ) {
                    
                    $msg_box = $( this ).prev();

                    if($msg_box.hasClass('is-expand')){

                        $msg_box.removeClass('is-expand');
                        $( this ).html( '+ Hiện nội dung' );
                    }else {

                        $msg_box.addClass('is-expand');
                        $( this ).html( '- Ẩn nội dung' );
                    }
                });
            });
        }
    };

}();

DetailProduct.init();