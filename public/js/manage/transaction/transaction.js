var Transaction = function () {

    var elem_block_loadding;
    var elm_active;

    var callback_get_data   =   function(data){

        if(data.meta.success){
            var tr_id           = data.response[0].transaction_id;
            var tr_current      = $('tr[data-id="'+ tr_id +'"]').first();

            var exchange_rate   = parseFloat(tr_current.attr('data-exchange_rate'));

            var tbody_current = tr_current.parents('tbody').first();

            // create table display
            var attr_tr_next = {
                'data-id' : tr_id
            };
            var tr_next     =   Spr.createElm("tr","odd gradeX show-transaction-detail", "", attr_tr_next);


            var td_parent          =   Spr.createElm("td","", "", "");
            td_parent.setAttribute('colspan',"12");
            
            var table       =   Spr.createElm("table","table table-striped table-hover", "", "");


            var thead       =   Spr.createElm("thead","", "", "");
            table.appendChild(thead);

            var tr_thead    =   Spr.createElm("tr","warning", "", "");
            thead.appendChild(tr_thead);

            // Tao header
            var attr = {
                'style':"font-weight:bold"
            };
            var td_thead    =   Spr.createElm("td","", "", attr);
            var text        =   Spr.createTextNode("Product Code");
            td_thead.appendChild(text);
            tr_thead.appendChild(td_thead);

            var attr = {
                'style':"font-weight:bold"
            };
            var td_thead    =   Spr.createElm("td","", "", attr);
            var text        =   Spr.createTextNode("Product Name");
            td_thead.appendChild(text);
            tr_thead.appendChild(td_thead);


            var attr = {
                'style':"font-weight:bold"
            };
            var td_thead    =   Spr.createElm("td","", "", attr);
            var text        =   Spr.createTextNode("Product Image");
            td_thead.appendChild(text);
            tr_thead.appendChild(td_thead);

            var td_thead    =   Spr.createElm("td","", "", attr);
            var text        =   Spr.createTextNode("Order On Amazon");
            td_thead.appendChild(text);
            tr_thead.appendChild(td_thead);

            var td_thead    =   Spr.createElm("td","", "", attr);
            var text        =   Spr.createTextNode("Quantity");
            td_thead.appendChild(text);
            tr_thead.appendChild(td_thead);

            var td_thead    =   Spr.createElm("td","", "", attr);
            var text        =   Spr.createTextNode("Price Product");
            td_thead.appendChild(text);
            tr_thead.appendChild(td_thead);

            var td_thead    =   Spr.createElm("td","", "", attr);
            var text        =   Spr.createTextNode("Discount");
            td_thead.appendChild(text);
            tr_thead.appendChild(td_thead);


            var td_thead    =   Spr.createElm("td","", "", attr);
            var text        =   Spr.createTextNode("Total Price");
            td_thead.appendChild(text);
            tr_thead.appendChild(td_thead);

            // Tao Body

            var tbody       =   Spr.createElm("tbody","", "", "");

            var data =  data.response;

            var total_price     =   0;
            var total_product   =   0;
            var total_discount  =   0;

            for(var obj in data){

                total_product ++;
                // du lieu dung chung 
                var price       =   data[obj].price;
                var discount    =   data[obj].price_save;
                var quantity    =   data[obj].quantity;


                //==================================================

                var tr  =  Spr.createElm("tr","odd gradeX", "", "");
                tbody.appendChild(tr);

                // Create td Product Code .

                var td      =   Spr.createElm("td","product-code", "", "");
                    var attr    = {
                        'target'  : "_blank",
                        'href'    : '' + window.location.origin +'/dp?code='+ data[obj].product_code + '',
                    };
                    var a = Spr.createElm('a',"","",attr);
                var text    =   Spr.createTextNode(data[obj].product_code);
                a.appendChild(text);
                td.appendChild(a);
                tr.appendChild(td);

                // End create td Product Code


                // Create td product name

                var td      =   Spr.createElm("td","name-product", "", "");
                var text    =   Spr.createTextNode(data[obj].name);
                td.appendChild(text);
                tr.appendChild(td);

                // End create td product name

                // create td image product

                var td      =   Spr.createElm("td","name-product", "", attr);

                var attr    = {
                        'src' : data[obj].img,
                        'style' : "width:96px;height:72px",
                    };
                var img     =   Spr.createElm("img","", "", attr);    
                td.appendChild(img);
                tr.appendChild(td);
                // end create td image product

                // Create td Order Product on Amazon

                var td      =   Spr.createElm("td","product-amazon", "", "");
                    var attr    = {
                        'target'  : "_blank",
                        'href'    : 'https://www.amazon.co.jp/dp/'+ data[obj].product_code + '',
                    };
                    var a = Spr.createElm('a',"","",attr);
                var text    =   Spr.createTextNode('View on Amazon');
                a.appendChild(text);
                td.appendChild(a);
                tr.appendChild(td);


                // End td Order Product on Amazon

                // Create td quantity Product

                var td      =   Spr.createElm("td","quantity-product", "", attr);
                var text    =   Spr.createTextNode(data[obj].quantity);
                td.appendChild(text);
                tr.appendChild(td);   
                // End create td quantity Product

                // Create td price Product 

                var td          =   Spr.createElm("td","price-product", "", "");
                var span        =   Spr.createElm("span","font-red", "","");
                var sup         =   Spr.createElm("sup","", "", "");
                var text_sup    =   Spr.createTextNode(" đ ");
                var text_span   =   Spr.createTextNode(Helper.formatNumber(Math.floor(price * exchange_rate), 0));
                sup.appendChild(text_sup);
                span.appendChild(text_span);
                span.appendChild(sup);
                td.appendChild(span);
                tr.appendChild(td);

                
                // End create td price Product 


                // Create td discount Product 

                var td          =   Spr.createElm("td","discount", "", "");
                var span        =   Spr.createElm("span","font-red", "","");
                var sup         =   Spr.createElm("sup","", "", "");
                var text_sup    =   Spr.createTextNode(" đ ");
                var text_span   =   Spr.createTextNode(Helper.formatNumber(Math.floor(discount * exchange_rate), 0));
                sup.appendChild(text_sup);
                span.appendChild(text_span);
                span.appendChild(sup);
                td.appendChild(span);
                tr.appendChild(td);

                
                // End create td discount Product 

                // Create td Total price Product 

                var td          =   Spr.createElm("td","total-price", "", "");
                var span        =   Spr.createElm("span","font-red", "","");
                var sup         =   Spr.createElm("sup","", "", "");
                var text_sup    =   Spr.createTextNode(" đ ");
                var text_span   =   Spr.createTextNode(Helper.formatNumber(Math.floor(price * exchange_rate * quantity), 0));
                sup.appendChild(text_sup);
                span.appendChild(text_span);
                span.appendChild(sup);
                td.appendChild(span);
                tr.appendChild(td);

                
                // End create td discount Product in japan

                // Caculator Total

                total_price += (Math.floor(price * exchange_rate * quantity));

            }

            var tr  =  Spr.createElm("tr","odd gradeX warning", "", "");
            tbody.appendChild(tr);

            var attr = {
                'style':"font-weight:bold"
            };
            var td_total    =   Spr.createElm("td","total", "", attr);
                td_total.setAttribute('colspan','7');
                var text    = Spr.createTextNode('Total :');
                td_total.appendChild(text);

            var td_value    =   Spr.createElm("td","total", "", ""); 
                var span        =   Spr.createElm("span","font-red", "","");
                var sup         =   Spr.createElm("sup","", "", "");
                var text_sup    =   Spr.createTextNode(" đ ");
                var text_span   =   Spr.createTextNode(Helper.formatNumber(total_price, 0));
                sup.appendChild(text_sup);
                span.appendChild(text_span);
                span.appendChild(sup);
                td_value.appendChild(span);
            var td_first          =   Spr.createElm("td","", "", "");   
            tr.appendChild(td_total);
            tr.appendChild(td_value);  
            table.appendChild(tbody);
            td_parent.appendChild(table);
            tr_next.appendChild(td_first);
            tr_next.appendChild(td_parent);
            $(tr_next).insertAfter(tr_current);

        }


    }

    var callback_get_data_info   =   function(data){

        if(data.meta.success){

            $('#transaction-code').text(data.response.code);
            $('#transaction-created-at').text(Spr.format_date(data.response.created_at));
            if(isNaN(data.response.expected_day)==false){
                $('#transaction-expected-day').text(Spr.format_date(data.response.expected_day));
            }
            $('#transaction-payment-type').text(data.response.title);
            $('#transaction-status').text(data.response.status  + ' - ' +  data.response.verify);
            $('#transaction-payment-method').text(data.response.payment_method);
            TableDatatablesScroller.init();
        }


    }

    var callback_verify         =   function(data){

        if(data.meta.success){

            var id      =   data.response.id;
            var a       =   $('a[data-id="'+ id +'"]').first();
            var tr      =   $('tr[data-id="'+ id +'"]').first();
            var span       =   a.find('span').first();

            tr.attr('data-verify',1);
            a.attr('data-active',1);
            span.removeClass('label-danger');
            span.addClass('label-success');
            span.text('Đã xác Nhận');

        }

    }

    return {

        //main function

        init: function () {

            $(document).ready(function(){

                $(document).on('click','.btn-delete', function(e){

                    e.preventDefault();

                    $('#frm_del').find('#id').val($(this).attr('data-id'));
                    
                });

                $(document).on('click','.btn-view', function(e){

                    e.preventDefault();

                    var code                =   $(this).attr('data-code');
                    var payment_type        =   $(this).attr('data-payment-type');
                    var payment_method      =   $(this).attr('data-payment-method');

                    var data    =   {

                        code    :   code,
                        payment_type : payment_type,
                        payment_method : payment_method,

                    };

                    Spr.ajaxDefault('/manager/ajax/get-info-transaction-detail', data, callback_get_data_info,$(this));
                    
                });

                $(document).on('click','.show',function(e){
                    e.preventDefault();

                    var transaction_id  =   $(this).attr('data-id');
                    var display         =   $(this).attr('data-display');

                    if(display ==0){
                        
                        var data = {

                            t : transaction_id
                        };

                        Spr.ajaxDefault('/manager/ajax/get-transaction-detail', data, callback_get_data,$(this));

                        $(this).attr('data-display',1);

                    }else{

                        $(this).attr('data-display',0);

                        var elm =  $(this).parents('tbody').find('.show-transaction-detail');

                        elm.each(function(){

                            if($(this).attr('data-id') == transaction_id){
                                $(this).remove();
                            }

                        });
                        

                    }
                   
                });

                $(document).on('click','.btn-change-active',function(e){

                        var verify  =   $(this).attr('data-active');
                        var id      =   $(this).attr('data-id');

                        if(verify == 0){

                            verify = 1;
                        }
                        if(verify != 0  && verify !=1){

                            return;
                        }

                        var data =  {

                            verify  :   verify,
                            id      :   id,
                        };

                        Spr.ajaxDefault('/manager/ajax/verify-transaction', data, callback_verify,$(this));

                });
                                
            });
        }
    };

}();