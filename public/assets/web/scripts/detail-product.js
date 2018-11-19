
var DetailProduct = function () {

    var elem_block_loadding;
    var elm_active;
    var dimension_to_asin_map, variationValues, data_img, data_key_image, dimension;
    var size_selected, color_selected, color_flavor_selected = null;
    var currency, current_price, save_price, old_price, price_list, count_price_list;
    // public functions


    var updatePriceList = function(quantity) {

        if(isNaN(quantity)) {
            quantity = 1;
            $('.quantity-input').val('1');
        }
 
        var data_price_list = [];
        var total_price = 0;
        var total_price_old = 0;
        $('.price-tb tbody').html('');
        if(count_price_list != 0){

            for (var i = count_price_list - 1; i >= 0; i--) {

                var person_price = parseFloat( price_list[i]['value'] );

                var price_item = Math.ceil( ( ( current_price * quantity ) * price_list[i]['value'] )  / 100 );
                total_price_old += Math.ceil( ( ( old_price * quantity) * price_list[i]['value'] )  / 100 );
                total_price     += price_item;
                price_list[i]['price'] = price_item;

            }

            var tr = Spr.createElm('tr');
                var td = Spr.createElm('td','lbl');
                td.appendChild(Spr.createTextNode('Giá trọn gói về Việt Nam'));
            tr.appendChild(td);
                var td = Spr.createElm('td','val');
                    var attr = {
                        'data-value' : total_price + ( current_price * quantity ),
                        'data-decimals' : 0
                    };
                    var span = Spr.createElm('span','format-currency','', attr);
                    span.appendChild(Spr.createTextNode(Helper.formatNumber(total_price + ( current_price * quantity ),0)));
                td.appendChild(span);
                    var sup = Spr.createElm('sup');
                    sup.appendChild(Spr.createTextNode('đ'));
                td.appendChild(sup);
            tr.appendChild(td);

            $('.price-tb tbody').append(tr);

            var tr = Spr.createElm('tr');
                var td = Spr.createElm('td','lbl');
                td.appendChild(Spr.createTextNode('Giá sau thuế tại Nhật'));
            tr.appendChild(td);
                var td = Spr.createElm('td','val');
                    var attr = {
                        'data-value' : ( current_price * quantity ),
                        'data-decimals' : 0
                    };
                    var span = Spr.createElm('span','format-currency','', attr);
                    span.appendChild(Spr.createTextNode(Helper.formatNumber(( current_price * quantity ),0)));
                td.appendChild(span);
                    var sup = Spr.createElm('sup');
                    sup.appendChild(Spr.createTextNode('đ'));
                td.appendChild(sup);
            tr.appendChild(td);

            $('.price-tb tbody').append(tr);

            for (var i = count_price_list - 1; i >= 0; i--) {

                var tr = Spr.createElm('tr');
                    var td = Spr.createElm('td','lbl');
                    td.appendChild(Spr.createTextNode( price_list[i]['key']));
                tr.appendChild(td);
                    var td = Spr.createElm('td','val');
                        var attr = {
                            'data-value' :  price_list[i]['price'],
                            'data-decimals' : 0
                        };
                        var span = Spr.createElm('span','format-currency','', attr);
                        span.appendChild(Spr.createTextNode(Helper.formatNumber(price_list[i]['price'],0)));
                    td.appendChild(span);
                        var sup = Spr.createElm('sup');
                        sup.appendChild(Spr.createTextNode('đ'));
                    td.appendChild(sup);
                tr.appendChild(td);

                $('.price-tb tbody').append(tr);
            }
            $('.main-price').html('');

                var attr = {
                    'data-value' :  total_price + ( current_price * quantity ),
                    'data-decimals' : 0
                };
                var span = Spr.createElm('span','format-currency','', attr);
                span.appendChild(Spr.createTextNode(Helper.formatNumber(total_price + ( current_price * quantity ),0)));
            $('.main-price').append(span);
                var sup = Spr.createElm('sup');
                sup.appendChild(Spr.createTextNode('đ'));
            $('.main-price').append(sup);
            $('.price-save').html('');
            if(save_price != 0) {

                    var attr = {
                        'data-value' :  total_price_old + ( old_price * quantity ),
                        'data-decimals' : 0
                    };
                    var span = Spr.createElm('span','format-currency old-price','', attr);
                    span.appendChild(Spr.createTextNode(Helper.formatNumber(total_price_old + ( old_price * quantity ),0)));
                $('.price-save').append(span);
                    var sup = Spr.createElm('sup');
                    sup.appendChild(Spr.createTextNode('đ'));
                $('.price-save').append(sup);

            }

            showListPrice();
        }else {

            $('.box-loadding .help-block-no-price').show();
            $('.box-loadding .box-foot').hide();
            $('.box-loadding .box-head img').hide();
            $('#bt-buy-now').hide();
            $('#bt-add-to-cart').hide();
            $('#bt-add-favourite').hide();
            $('#bt-add-quotation').show();
        }
    }
    var callBackGetPriceDetail = function(res){

        if(res.meta != undefined && res.meta.success && res.response.current_price != 0) {

            var data        = res.response;
            currency        = Math.ceil(parseFloat(data.currency));
            current_price   = parseFloat(data.current_price) * currency;
            save_price      = parseFloat(data.save) * currency;
            old_price       = save_price + current_price;
            price_list      = data.price_list;
            count_price_list= price_list.length;
            var quantity    = parseInt($('.quantity-input').val());

            updatePriceList(quantity);

        }else {

            if(res.meta != undefined && res.meta.success && res.response.current_price == 0){

                $('.box-loadding .help-block-select-type').show();
            }else {

                $('.box-loadding .help-block-no-price').show();
            }
            $('.box-loadding .box-foot').hide();
            $('.box-loadding .box-head img').hide();
            $('#bt-buy-now').hide();
            $('#bt-add-to-cart').hide();
            $('#bt-add-favourite').hide();
            $('#bt-add-quotation').show();

        }
    }

    var getPriceDetail = function(code) {

        var url  = $('#data-price').attr('data-url');
        var data = {code: code};
        showLoadding();
        Spr.ajaxDefault(url, data, callBackGetPriceDetail,"");
    }

    var changeImage = function(map){

        var $fotoramaDiv = $('.fotorama').first().fotorama();

        // 2. Get the API object.
        var fotorama            = $fotoramaDiv.data('fotorama');
        var length_dimension    = dimension.length;
        var key = '';

        for (var i = 0; i < length_dimension; i++ ) {

            key += variationValues[dimension[i]][map[i]] + " ";
        }

        key = key.trim();

        var img         = data_img[key];
        if(img == undefined) {

            for (var i = 0; i < length_dimension; i++ ) {

                var dump = variationValues[dimension[i]];
                var done = false;
                for (var j = map.length - 1;j >= 0; j--) {

                    key = variationValues[dimension[i]][map[j]];
                    img = data_img[key]
                    if(img != undefined){
                        done = true;
                        break;
                    }
                }
                if(done) break;
            }
        }
        var length_img  = img.length;


        var data_img_product_detail = [];
        for (var i = 0; i < length_img; i++) {


            var data = {img: img[i]['large'], thumb: img[i]['thumb']}
            data_img_product_detail.push(data);

        }
        fotorama.load(data_img_product_detail);
    }

    var setSelectedCustomerChoice = function(code) {

        if(dimension_to_asin_map.length > 0) {
            $.each(dimension_to_asin_map, function(map) {

                var map_code = dimension_to_asin_map[map];
                if(map_code == code){

                    var dump             = map.toString().split("_");
                    var length_dimension = dimension.length;
                    var index = length_dimension - 1;
                    for (var i = length_dimension - 1; i >= 0; i--) {

                        $('.p-size[data-name="'+dimension[i]+'"] .item-type-product').addClass('out-of-stock');
                        $('.p-size[data-name="'+dimension[i]+'"]').val(dump[i]);
                        $('.p-size[data-name="'+dimension[i]+'"]').find('[data-value="' + dump[i] + '"]').addClass('selected');

                        if(dimension[i] == "color_name") {

                            changeImage(dump);
                        }
                    }
                    $('.p-size[data-name="'+dimension[index]+'"] .item-type-product').removeClass('out-of-stock');
                    var value = $('.p-size[data-name="'+dimension[index]+'"] .selected').first().attr('data-value');
                    changeStatusOptionOfProduct(index, value);
                    getPriceDetail(code);
                    return;
                }
            });
        }else {
            getPriceDetail(code);
        }
    };

    var callBack_favorite_product = function(data) {

        if (data.meta.success) {

            openModal(data);
        }
    };

    var callBack_remove_favorite_product = function(data) {

        if (data.meta.success) {

            window.location.reload();

            // openModal(data.response.data);
        }
    };

    var openModal = function (data) {

        $("#modal_alert").modal();
        var msg = '';

        for (var key in data['meta']['msg']) {
            msg += data['meta']['msg'][key];
            msg += "<br>";
        }

        $("#modal_message").html(msg);
        $("#modal_message").prop("style", "display: block");
    };

    var showLoadding = function() {

        $('.box-loadding .box-foot').show();
        $('.box-loadding .box-head img').show();
        $('.box-loadding .help-block-no-price').hide();
        $('.box-loadding .help-block-select-type').hide();
        $('#data-price').hide(200);
        $('.box-loadding').show();
        $('#bt-buy-now').hide();
        $('#bt-add-to-cart').hide();
        $('#bt-add-favourite').hide();
        $('#bt-add-quotation').show();
    }

    var showListPrice = function () {

        $('.price-tb').removeClass('hide');
        $('#data-price').show(200);
        $('.box-loadding').hide();
        $('#bt-buy-now').show();
        $('#bt-add-to-cart').show();
        $('#bt-add-favourite').show();
        $('#bt-add-quotation').hide();
    }
    var removeProduct = function () {
        $(document).ready(function () {
            $('.btnRemoveFavouriteProduct').click(function (e) {

                e.preventDefault();

                var token           = $("#token").val();
                var id              = $(this).attr('data-id');
                var customer_id     = $(this).attr('data-customer_id');
                var product_code    = $(this).attr('data-product_code');

                var data = {
                    _token          : token,
                    id              : id,
                    customer_id     : customer_id,
                    product_code    : product_code,
                };

                bootbox.confirm('<b>Bạn có chắc chắn muốn xóa sản phẩm này?', function (result) {
                    if (result === true) {

                        Spr.ajaxDefault('/delete-favorite-product', data, callBack_remove_favorite_product,".block-main");
                    }
                });
            });
        });
    };

    var  changeStatusOptionOfProduct = function(index, value) {

        var length_dimension = dimension.length;

        for (var key in dimension_to_asin_map) {

            var data_map = key.split('_');
            if(data_map[index] == value) {

                var length_data_map = data_map.length;

                for (var i = length_data_map - 1; i >= 0; i--) {

                    if(i != index) {
                        $('.p-size[data-name="'+dimension[i]+'"').find('[data-value="'+data_map[i]+'"]').first().removeClass('out-of-stock');
                    }
                }
            }
        }
        $('.selected').each(function(){

            if($(this).hasClass('out-of-stock')) {

                $(this).removeClass('selected');
                $(this).parent('.p-size').first().val(-1);
            }
        });
    }

    return {

        //main function

        init: function () {

            $(document).ready(function(){

                $( document ).on( 'click' , "div.expand-btn" , function ( ) {

                    $msg_box = $( this ).prev();

                    if($msg_box.hasClass( 'is-expand' )){

                        $msg_box.removeClass( 'is-expand' );
                        $( this ).html( '+ Hiện nội dung' );
                    }else {

                        $msg_box.addClass( 'is-expand' );
                        $( this ).html( '- Ẩn nội dung' );
                    }
                });


                $(document).on('click','#bt-add-favourite', function(e){

                    e.preventDefault();
                    var url             = window.location.href;
                    var dp_index        = url.indexOf("code=");
                    var param_index     = url.indexOf("&param=");
                    var product_code    = url;

                    if (param_index >= 0) {
                        
                        product_code    = url.substring(dp_index, param_index);
                    }
                    
                    var product_code    = product_code.split('=')[1];
                    var key_img         = data_key_image[product_code];

                    var product_name    = "";
                    var product_image   = "";
                    var customer_id     = "";
                    var token           = $("#token").val();

                    product_code        = product_code.replace("code=", "");
                    product_name        = $(".pd-title").text();
                    product_image       = data_img[key_img][0]['large'];

                    var data = {
                        _token          : token,
                        product_code    : product_code,
                        product_name    : product_name,
                        product_image   : product_image,
                    };

                    // App.blockUI({
                    //     target: '.portlet-body',
                    //     boxed: true,
                    //     textOnly: true
                    // });

                    // window.setTimeout(function() {
                    //     App.unblockUI('.portlet-body');
                    // }, 4000);

                    Spr.ajaxDefault('/favorite-product', data, callBack_favorite_product,".block-main");
                });
            });
        },
        showLoadding : function(){

            showLoadding();
        },
        config: function (data) {

            dimension_to_asin_map   = data.dimension_to_asin_map;
            variationValues         = data.variationValues;
            data_img                = data.data_img;
            data_key_image          = data.data_key_image;
            dimension               = data.dimension;

        },
        updatePriceList: function(quantity) {
            updatePriceList(quantity);
        },
        changeImage: function(color){
            changeImage(color);
        },
        getImageDefault : function(color) {

            var color_name = data_color[color];
            return data_img[color_name][0]['thumb'];
        },
        setSelectedCustomerChoice: function(code) {

            setSelectedCustomerChoice(code);
            $( '#config' ).remove();
        },
        getDimension_to_asin_map : function () {

            return dimension_to_asin_map;
        },
        getVariationValues : function () {

            return variationValues;
        },
        getData_img : function () {

            return data_img;
        },
        getData_key_image : function () {

            return data_key_image;
        },
        getDimension : function () {

            return dimension;
        },
        custom : function (data) {

            openModal(data);
        },
        favoriteProduct : function () {
            removeProduct();
        },
        changeProductType : function(Elm) {
            var map     = dimension_to_asin_map;

            var key     = "";
            var length_dimension = dimension.length;
            var index   = 0;
            var value   = Elm.find('.selected').first().attr('data-value');

            Elm.find('.out-of-stock').removeClass('out-of-stock');

            for (var i = 0; i < length_dimension; i++) {

                if(dimension[i] == Elm.attr('data-name')){

                    index = i;

                }else {
                    $('.p-size[data-name="'+dimension[i]+'"] .item-type-product').addClass('out-of-stock');
                }

                key += $('.p-size[data-name="'+dimension[i]+'"]').first().find('.selected').first().attr('data-value') + '_';
            }
            key = key.substring(0, key.length - 1);

            if(map[key] == undefined){

                $('.box-loadding .box-foot').hide();
                $('.box-loadding').show();
                $('.box-loadding .box-head img').hide();
                $('.box-loadding .help-block-select-type').show();
                $('.box-loadding .help-block-no-price').hide();
                $('#data-price').hide();
                $('#bt-buy-now').hide();
                $('#bt-add-to-cart').hide();
                $('#bt-add-favourite').hide();
                $('#bt-add-quotation').show();
            }else {

                updatePrice(map[key]);
            }

            changeStatusOptionOfProduct(index, value);
        }
    };

}();

DetailProduct.init();