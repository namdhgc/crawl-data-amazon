<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
           
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <?php
                    function getElementsByClass($parentNode, $tagName, $className) {
                        $nodes=[];

                        $childNodeList = $parentNode->getElementsByTagName($tagName);
                        for ($i = 0; $i < $childNodeList->length; $i++) {
                            $temp = $childNodeList->item($i);
                            if (stripos($temp->getAttribute('class'), $className) !== false) {
                                $nodes[]=$temp;
                            }
                        }

                        return $nodes;
                    }
                    $url = 'https://www.amazon.com/magazines/b/ref=nav_shopall_magazines_t3?ie=UTF8&node=599858';

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_URL, $url);
                    // need change USERAGENT to connect to amazon. Because amazon security block robot
                    // On here get  USER_AGENT of client for connect
                    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
                    $result = curl_exec($ch);
             
                    curl_close($ch);
              

                    $dom = new DOMDocument();
                    @$dom->loadHTML($result);
                    $xPath = new DOMXPath($dom);
               
                    $classname="s-result-list";
                    $elements = $xPath->query("//*[contains(@class, '$classname')]");
                    $data_product = [];
                    $li = $elements[0]->getElementsByTagName('li');

                    foreach ($li as $e) {

                        // e is DOMElement 

                        // get img of product
                        $href_img = [];
                        $img = $e->getElementsByTagName("img");

                        foreach ($img as $img_product ) {

                            array_push($href_img, $img_product->getAttribute('src'));
                            break;
                        }

                        // get product name
                        $node_title_product = $e->getElementsByTagName("h2");

                        $product_name = "";
                        foreach ($node_title_product as $node_title) {
                            
                            $product_name = $node_title->getAttribute('data-attribute');
                            break;
                        }


                        //get link detail of product
                        $href_product_detail = "";

                        $node_link_product = $e->getElementsByTagName("a");

                        foreach ($node_link_product as $node_link) {
                            

                            if($node_link->getAttribute('title') == $product_name) {

                                $href_product_detail = $node_link->getAttribute('href');
                                break;
                            }
                        }

                        // get rate of product
                        $rate = ""; 
                        $total_rate = 0;
                        $node_rate_product = getElementsByClass($e, "div","a-spacing-top-micro");

                        foreach ($node_rate_product as $node_rate) {
                            
                            //get star rate of product
                            $node_star_rate_product = getElementsByClass($node_rate, "span","a-icon-alt");

                            foreach ($node_star_rate_product as $star_node) {
                                
                                $rate = $star_node->nodeValue;
                                $array_text_rate = explode(" ", $rate);
                                $rate = $array_text_rate[0];
                                break;
                            }

                            // get all link on div rate
                            $node_total_rate_product = $node_rate->getElementsByTagName("a");

                            foreach ($node_total_rate_product as $node_totle_rate) {
                                
                                $href_node_total_rate = $node_totle_rate->getAttribute('href');
                                // get link not blank
                                if($href_node_total_rate != "javascript:void(0)" && $href_node_total_rate != "#"){

                                    $total_rate = $node_totle_rate->nodeValue;
                                }
                            }

                            // get price 

                            $price = [];
                            $node_price_product = $e->getElementsByTagName("span");

                            foreach ($node_price_product as $node_price) {

                                if($node_price->hasAttribute('aria-label')) {

                                    $value_of_node = $node_price->getAttribute('aria-label');
                                    $price_dum = explode('$', $value_of_node)[1];
                                    if(is_numeric($price_dum)) {

                                        array_push($price, $price_dum);
                                    }
                                }
                            }
                        }

                        array_push($data_product, [
                            'title' => $product_name,
                            'img' => $href_img,
                            'rate' => [
                                'star'  => $rate,
                                'total_vote' => $total_rate
                            ],
                            'link' => $href_product_detail,
                            'price' => $price
                        ]);
                    }
                    dd($data_product);
                ?>
            </div>
        </div>
    </body>
</html>
