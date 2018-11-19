<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use \Request as RequestBase;
use App\Http\Requests;
use App\Http\Models\Product as ModelProduct;
use Spr\Base\Controllers\Helper as HelperController;
use Spr\Base\Controllers\CrawlData\simple_html_dom as SimpleHtmlDom;
use Intervention\Image\Exception\NotReadableException;
use Spr\Base\Controllers\Http\Request as BaseRequest;
use Spr\Base\Response\Response;
use App\Http\Models\GroupCustomer as ModelGroupCustomer;
use App\Http\Models\PriceListDetail as ModelPriceListDetail;
use App\Http\Models\PaymentTypeDetail as ModelPaymentTypeDetail;
use App\Http\Models\PaymentType as ModelPaymentType;
use App\Http\Models\Promotion as ModelPromotion;
use App\Http\Models\HappyCode as ModelHappyCode;
use App\Http\Models\Transaction as ModelTransaction;
use App\Http\Models\TransactionDetail as ModelTransactionDetail;

use Spr\Base\Controllers\GoogleTranslate\TranslateClient as Translate;
use App\Http\Controllers\ProductController;
use Input;
use Config;
use Auth;
use Lang;
use Session;
use DB;
use Cookie;
use Cache;

class ShoppingCartController  extends Controller
{


    public function __construct()
    {

    }


    public function addProductToShoppingCart ($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

            $ProductController = new ProductController();
            $code           = $data_output_validate_param['response']['code'];
            $name           = $data_output_validate_param['response']['name'];
            $quantity       = (int)$data_output_validate_param['response']['quantity'];
            $spc_id         = '';


            $data_item = [

                'img'       => '',
                'name'      => $name,
                'code'      => $code,
                'quantity'  => $quantity,
                'price_list'=> [],
                'type_product' => [],
                'price'     => 0,
                'price-total' => 0
            ];
            $data_shopping_cart = [
                'products' => [],
                'promotion' => [
                    'code'  => '',
                    'discount'  => 0
                ],
                'happy_code' => [
                    'code'  => '',
                    'discount'  => 0
                ],
            ];
            $product_exit = false;

            if( isset($_COOKIE['shopping_cart']) && Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null) {

                $spc_id = $_COOKIE['shopping_cart'];

                $data_shopping_cart = Cache::get('shopping_cart_'.$spc_id);

                for ($i = COUNT($data_shopping_cart['products']) - 1 ; $i >= 0; $i-- ) {

                    if($data_shopping_cart['products'][$i]['code'] == $code) {
                        $data_shopping_cart['products'][$i]['quantity']     =   (int)$quantity + (int)$data_shopping_cart['products'][$i]['quantity'];
                        $data_shopping_cart['products'][$i]['name']         =   $name;
                        $data_shopping_cart['products'][$i]['price-total']  =   $data_shopping_cart['products'][$i]['price'] * (int)$data_shopping_cart['products'][$i]['quantity'];
                        $product_exit = true;
                        break;
                    }
                }
            }else {

                $spc_id     = bin2hex(random_bytes(16));
                setcookie('shopping_cart', $spc_id);
            }

            if(!$product_exit) {

                $updatePrice = $this->getPriceOfProduct ($data_item);

                if($updatePrice['meta']['success']) {

                    array_push($data_shopping_cart['products'], $updatePrice['response']);
                }else {

                    $data_output_validate_param = $updatePrice;
                }
            }

            if($data_output_validate_param['meta']['success']) {

                Cache::forget('shopping_cart_'.$spc_id);
                Cache::forever('shopping_cart_'.$spc_id, $data_shopping_cart);
                $data_output_validate_param['meta']['msg']      = [Lang::get('message.web.success.0006')];
                $data_output_validate_param['meta']['code']     = 0006;
                $data_output_validate_param['response']         = $data_shopping_cart;
            }
        }

        return $data_output_validate_param;
    }

    public function updateProductToShoppingCart ($data_output_validate_param) {


        if($data_output_validate_param['meta']['success']) {
            $product    =   [];
            $ProductController = new ProductController();

            $product           =    $data_output_validate_param['response']['product'];
            $spc_id         = '';

            $data_shopping_cart = [
                'products' => [],
                'promotion' => [
                    'code'  => '',
                    'discount'  => 0
                ],
                'happy_code' => [
                    'code'  => '',
                    'discount'  => 0
                ]
            ];

            if( isset($_COOKIE['shopping_cart']) && Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null) {

                $spc_id = $_COOKIE['shopping_cart'];
                $data_shopping_cart = Cache::get('shopping_cart_'.$spc_id);
                for ($i = COUNT($data_shopping_cart['products']) - 1 ; $i >= 0; $i-- ) {
                    if(array_key_exists($data_shopping_cart['products'][$i]['code'],$product))
                    {
                        $data_shopping_cart['products'][$i]['quantity']     =   $product[$data_shopping_cart['products'][$i]['code']]['quantity'] ;
                        $data_shopping_cart['products'][$i]['price-total']  =   $data_shopping_cart['products'][$i]['price'] *  $product[$data_shopping_cart['products'][$i]['code']]['quantity'];
                    }
                }
            }


            Cache::forget('shopping_cart_'.$spc_id);
            Cache::forever('shopping_cart_'.$spc_id, $data_shopping_cart);
            $data_output_validate_param['meta']['msg']      = [Lang::get('message.web.success.0007')];
            $data_output_validate_param['meta']['code']     = 0006;
            $data_output_validate_param['response']         = $data_shopping_cart;
        }

        return $data_output_validate_param;
    }

    public function updateProductToShoppingCartStepPayment($data_output_validate_param) {


        if($data_output_validate_param['meta']['success']) {
            $product    =   [];
            $ProductController = new ProductController();

            $product           =    $data_output_validate_param['response']['product'];
            $code              =    $data_output_validate_param['response']['code'];
            $spc_id         = '';

            $data_shopping_cart = [
                'products' => [],
                'promotion' => [
                    'code'  => '',
                    'discount'  => 0
                ],
                'happy_code' => [
                    'code'  => '',
                    'discount'  => 0
                ]
            ];

            if( isset($_COOKIE['shopping_cart']) && Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null) {

                $spc_id = $_COOKIE['shopping_cart'];
                $data_shopping_cart = Cache::get('shopping_cart_'.$spc_id);
                for ($i = COUNT($data_shopping_cart['products']) - 1 ; $i >= 0; $i-- ) {
                    if(array_key_exists($data_shopping_cart['products'][$i]['code'],$product))
                    {
                        $data_shopping_cart['products'][$i]['quantity']     =   $product[$data_shopping_cart['products'][$i]['code']]['quantity'] ;
                        $data_shopping_cart['products'][$i]['price-total']  =   $data_shopping_cart['products'][$i]['price'] *  $product[$data_shopping_cart['products'][$i]['code']]['quantity'];
                    }
                }
            }


            Cache::forget('shopping_cart_'.$spc_id);
            Cache::forever('shopping_cart_'.$spc_id, $data_shopping_cart);
            
            // update price in transaction-detail and transaction

            $ModelTransaction   =   new ModelTransaction();
            $dataTransaction    =   $ModelTransaction->getDataByCode($code);
            
            if(count($dataTransaction['response']) == 0 || (count($dataTransaction['response']) >0 && !empty($dataTransaction['response'][0]) && $dataTransaction['response'][0]->verify ==1)) {
               
                $data_output_validate_param['meta']['success']  = false;
                return $data_output_validate_param;
            }
            $price_list_id      =   $dataTransaction['response'][0]->price_list_id;
            $transaction_id     =   $dataTransaction['response'][0]->id;



            // get total price and price list detail
            $total_price        =   0;
            $total_price_in_jp  =   0;
            $price_list_detail  =   null;
            $total_fee          =   0;


            // Doan duoi nay se lu ly gia Total chua co happy code vs promotion code
            if(count($data_shopping_cart) > 0){

                $ModelPriceListDetail       = new ModelPriceListDetail();
                $price_list_detail          = $ModelPriceListDetail->selectData($price_list_id)['response'];

                foreach ($data_shopping_cart['products'] as $k_product => $val_product) {

                    $price_product              =   ceil(((float)$val_product['price_jp'] * (float)$val_product['exchange-rate']) * $val_product['quantity']);
                    $temp_price_list_detail     =   [];
                    $fee                        =   0;

                    foreach ($price_list_detail as $k_price_list => $val_price_list) {

                        $tmp            = [];
                        $price          = ceil((($price_product * (float)$val_price_list->value))/100); 

                        (float)$fee    +=   $price;

                        $tmp['id']      = $val_price_list->id;
                        $tmp['title']   = $val_price_list->key;
                        $tmp['price']   = $price;

                        array_push($temp_price_list_detail,$tmp);

                    }

                    $data_shopping_cart['products'][$k_product]['total_price']        =   ($price_product + $fee);
                    $data_shopping_cart['products'][$k_product]['price_list_detail']  =   json_encode($temp_price_list_detail);
                    $total_price_in_jp  += $price_product;   
                    $total_price        += ($price_product + $fee);
                    $total_fee          += $fee;
                    
                }
            }

            // Xu ly cua promotion code
            $promotion = null;
            $price_list_promotion_code  =   0;
            if($data_shopping_cart['promotion']['code'] != "") {

                $ModelPromotion = new ModelPromotion();
                $data_promotion = $ModelPromotion->getDataByCode($data_shopping_cart['promotion']['code']);

                if($data_promotion['meta']['success'] && COUNT($data_promotion['response']) > 0 ) {

                    if($data_promotion['response'][0]->used_by == null && $data_promotion['response'][0]->expired_time <= strtotime(\Carbon\Carbon::now()->toDateTimeString()) ) {

                        $promotion = $data_promotion['response'][0]->id;

                        $discount   =   0;

                        if($data_promotion['response'][0]->discount > 100){

                            $discount   =   $data_promotion['response'][0]->discount;
                              

                        }else{

                            $discount  =   ceil(((float)$data_promotion['response'][0]->discount * $total_price)/100);

                        }

                        $price_list_promotion_code  = $discount;
                        $total_price -= $discount;                      

                    }
                }
            }

            // Xu ly cua happy code    
            $happy_code = null;
            $price_list_happy_code  =   0;
            if($data_shopping_cart['happy_code']['code'] != "") {

                $ModelHappyCode     = new ModelHappyCode();
                $data_happy_code    = $ModelHappyCode->getDataByCode($data_shopping_cart['happy_code']['code']);

                if($data_happy_code['meta']['success'] && COUNT($data_happy_code['response']) > 0 ) {

                    if($data_happy_code['response'][0]->used_by == null && $data_happy_code['response'][0]->expired_time <= strtotime(\Carbon\Carbon::now()->toDateTimeString()) ) {

                        $happy_code = $data_happy_code['response'][0]->id;

                        $discount   =   0;

                        if($data_happy_code['response'][0]->discount > 100){

                            $discount   =   $data_happy_code['response'][0]->discount;
                              

                        }else{

                            $discount  =   ceil(((float)$data_happy_code['response'][0]->discount * $total_price)/100);

                        }
                        $price_list_happy_code  = $discount;
                        $total_price -= $discount;
                    }
                }
            }


            // update transaction
            $dataTransaction = [

                'total_price_in_vn'         => $total_price,
                'total_price_in_jp'         => $total_price_in_jp,
                'total_fee'                 => $total_fee,
                'updated_at'                => strtotime(\Carbon\Carbon::now()->toDateTimeString())

            ];
            $where             =    [
                    [
                        'fields'    =>  'code',
                        'operator'  =>  '=',
                        'value'     =>  $code,
                    ]
            ];  

            $data_transaction   =    $ModelTransaction->updateData($dataTransaction,$where);

            // update transaction detail

            $ModelTransactionDetail                 = new ModelTransactionDetail();
            $flag_update    =   true;
            foreach ($data_shopping_cart['products'] as $key => $value) {

                $item =  [
                    'quantity'                  => $value['quantity'],
                    'price'                     => $value['price_jp'],
                    'price_save'                => $value['price_save_jp'],
                    'price_list_detail'         => $value['price_list_detail'],
                    'price_in_vn'               => $value['total_price'],
                    'type_product'              => json_encode($value['type_product']),
                    'img'                       => $value['img'],
                    'name'                      => $value['name'],
                    'updated_at'                => strtotime(\Carbon\Carbon::now()->toDateTimeString()),
                ];

                $where_item  = [

                    [

                        'fields'    =>  'transaction_id',
                        'operator'  =>  '=',
                        'value'     =>  $transaction_id,
                    ],
                    [
                        'fields'    =>  'product_code',
                        'operator'  =>  '=',
                        'value'     =>  $value['code'],
                    ]
                ];

                $data_update    =   $ModelTransactionDetail->updateData($item,$where_item);

                if($data_update['meta']['success'] ==false){

                    $flag_update = false;

                }

            }

            if($data_transaction['meta']['success'] && $flag_update){

                $data_output_validate_param['meta']['success']  =   true;
                $data_output_validate_param['response']         =   $code;
            }else{

                $data_output_validate_param['meta']['success']  =   false;

            }

        }

        return $data_output_validate_param;
    }

    public function deleteProductToShoppingCart($data_output_validate_param){

        if($data_output_validate_param['meta']['success']) {

            $ProductController = new ProductController();
            $code           = $data_output_validate_param['response']['code'];
            $spc_id         = '';

            $data_shopping_cart = [
                'products' => [],
                'promotion' => [
                    'code'  => '',
                    'discount'  => 0
                ]
            ];

            if( isset($_COOKIE['shopping_cart']) && Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null) {

                $spc_id = $_COOKIE['shopping_cart'];

                $data_shopping_cart = Cache::get('shopping_cart_'.$spc_id);

                for ($i = COUNT($data_shopping_cart['products']) - 1 ; $i >= 0; $i-- ) {

                    if($data_shopping_cart['products'][$i]['code'] == $code) {

                        unset($data_shopping_cart['products'][$i]);
                        break;
                    }
                }
                $data_shopping_cart['products']     =   array_values($data_shopping_cart['products']);
            }

            Cache::forget('shopping_cart_'.$spc_id);
            Cache::forever('shopping_cart_'.$spc_id, $data_shopping_cart);
            $data_output_validate_param['meta']['msg']      = [Lang::get('message.web.success.0008')];
            $data_output_validate_param['meta']['code']     = 0006;
            $data_output_validate_param['response']         = $data_shopping_cart;

        }
        return $data_output_validate_param;
    }

    public function updatePriceOfProductOnShoppingCart () {

        if( isset($_COOKIE['shopping_cart']) && Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null && !empty(Cache::get('shopping_cart_'.$_COOKIE['shopping_cart'])['products'])) {

            $spc_id = $_COOKIE['shopping_cart'];
            $data = Cache::get('shopping_cart_'.$spc_id);
            // dd(Cache::get('shopping_cart_'.$spc_id));
            $data_shopping_cart = $data;
            $data_shopping_cart['products'] = [];

            foreach ($data['products'] as $key => $value) {

                $item_updated_at = $value['updated_at'];
                $now = strtotime(\Carbon\Carbon::now()->toDateTimeString());
                $time_Update = $now - $item_updated_at;

                if($time_Update >= 3600 * 10 ) {

                    $updatePrice = $this->getPriceOfProduct($value);

                    if($updatePrice['meta']['success']) {

                        array_push($data_shopping_cart['products'], $updatePrice['response'] );
                    }
                }else {

                    array_push($data_shopping_cart['products'], $updatePrice['response'] );
                }
            }
            Cache::forget('shopping_cart_'.$spc_id);
            Cache::forever('shopping_cart_'.$spc_id, $data_shopping_cart);
        }
    }

    public function getPriceOfProduct ($data_item) {

        $ProductController = new ProductController();
        $response = Response::response();

        $code       = $data_item['code'];
        $quantity   = $data_item['quantity'];
        $url        = Config::get('spr.system.link_get_data.amazon.jp.detail-product') . $code . '?th=1&psc=1';
        $html       = $ProductController->getHtmlDom($url);

        $data_price         = $ProductController->getDetailPriceOfProduct($html);
        $data_type          = $ProductController->getSizeAndColor($html, $code)['response'];
        $current_price_jp   = $current_price  = (int)$data_price['current_price'];
        $save_price_jp      = (int)$data_price['save'];
        $key_image          = $data_type['data_key_image'][$code];
        $data_map_detail    = $data_type['data_map_detail'][$code];
        $dimension          = $data_type['dimension'];
        $type_product       = [];

        foreach ($dimension as $key => $value) {

            $type_product[str_replace('_name', '', $value)] = $data_map_detail[$key];
        }
        if($current_price == 0) {

            $response['meta']['success']  = false;
            $response['meta']['code']     = '0028';
            $response['meta']['msg']      = [Lang::get('message.web.error.0028')];
            $response['response']         = '';

        }else {

            $currency   = (float)$data_price['currency'];


            $curent_price = $currency * $current_price;
            $price        = $curent_price;
            for ($i = COUNT($data_price['price_list']) - 1 ; $i >= 0; $i-- ) {

                $current_price_item = ceil(( (float)$data_price['price_list'][$i]->value * $curent_price ) / 100 );
                $price += $current_price_item;
                $data_price['price_list'][$i]->price = $current_price_item;
            }
            $data_item['price_list']    = $data_price['price_list'];
            $data_item['price']         = $price;
            $data_item['price_jp']      = $current_price_jp;
            $data_item['exchange-rate'] = $currency;
            $data_item['price_save']    = $save_price_jp * $currency;
            $data_item['price_save_jp'] = $save_price_jp;
            $data_item['price-total']   = $price * $quantity;
            $data_item['type_product']  = $type_product;
            $data_item['updated_at']    = strtotime(\Carbon\Carbon::now()->toDateTimeString());

            if(isset($data_type['data_img'][$key_image][0])) {

                $data_item['img']       = $data_type['data_img'][$key_image][0]['large'];
            }
            $response['response'] = $data_item;
        }

        return $response;
    }

    public function deleteProductToShoppingCartStepPayment($data_output_validate_param){

        if($data_output_validate_param['meta']['success']) {

            $ProductController  =   new ProductController();
            $code               =   $data_output_validate_param['response']['code'];
            $transaction_code   =   $data_output_validate_param['response']['transaction_code'];
            $spc_id         = '';

            $data_shopping_cart = [
                'products' => [],
                'promotion' => [
                    'code'  => '',
                    'discount'  => 0
                ]
            ];

            if( isset($_COOKIE['shopping_cart']) && Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null) {

                $spc_id = $_COOKIE['shopping_cart'];

                $data_shopping_cart = Cache::get('shopping_cart_'.$spc_id);

                for ($i = COUNT($data_shopping_cart['products']) - 1 ; $i >= 0; $i-- ) {

                    if($data_shopping_cart['products'][$i]['code'] == $code) {

                        unset($data_shopping_cart['products'][$i]);
                        break;
                    }
                }
                $data_shopping_cart['products']     =   array_values($data_shopping_cart['products']);
            }

            Cache::forget('shopping_cart_'.$spc_id);

            // update price in transaction-detail and transaction

            $ModelTransaction   =   new ModelTransaction();
            $dataTransaction    =   $ModelTransaction->getDataByCode($transaction_code);
            
            if(count($dataTransaction['response']) == 0 || (count($dataTransaction['response']) >0 && !empty($dataTransaction['response'][0]) && $dataTransaction['response'][0]->verify ==1)) {
               
                $data_output_validate_param['meta']['success']  = false;
                return $data_output_validate_param;
            }

            $transaction_id             =   $dataTransaction['response'][0]->id;
            $ModelTransactionDetail     =   new ModelTransactionDetail();

            $dataTransactionDetail      =   $ModelTransactionDetail->getDataByTransactionId($transaction_id,$code);

            if(count($dataTransactionDetail['response']) == 0) {
               
                $data_output_validate_param['meta']['success']  = false;
                return $data_output_validate_param;
            }

            $where_detail   =   [
                [
                    'fields'    =>  'id',
                    'operator'  =>  '=',
                    'value'     =>  $dataTransactionDetail['response'][0]->id,
                ]
            ];

            $data_detail    =   [
                'deleted_at'    =>   strtotime(\Carbon\Carbon::now()->toDateTimeString()),
                'comment'       =>   'Customer deleted it',
            ];

            $dataDeleteDetail       =   $ModelTransactionDetail->updateData($data_detail,$where_detail);


            $price_list_detail      =     json_decode($dataTransactionDetail['response'][0]->price_list_detail);
            $product_fee            =     0;

            foreach ($price_list_detail as $key => $value) {
                  $product_fee += (float)$value->price;
            }


            // check quantity product detail

            $dataQuantityDetail      =   $ModelTransactionDetail->getDataByTransactionId($transaction_id);


            // update transaction
            $data_transaction = [];

            if(count($dataQuantityDetail['response'])> 0)
            {
                $data_transaction = [

                    'total_price_in_vn'         => (ceil((float)$dataTransaction['response'][0]->total_price_in_vn - (float)$dataTransactionDetail['response'][0]->price_in_vn)),
                    'total_price_in_jp'         => ceil((float)$dataTransaction['response'][0]->total_price_in_jp - ((float)$dataTransactionDetail['response'][0]->price * $dataTransaction['response'][0]->exchange_rate) *$dataTransactionDetail['response'][0]->quantity),
                    'total_fee'                 => ceil((float)$dataTransaction['response'][0]->total_fee - $product_fee),
                    'updated_at'                => strtotime(\Carbon\Carbon::now()->toDateTimeString())

                ];
                
            }else{

                $data_transaction = [

                    'total_price_in_vn'         =>  0,
                    'total_price_in_jp'         =>  0,
                    'total_fee'                 =>  0,
                    'comment'                   =>  'Customers have canceled all products.',
                    'deleted_at'                =>  strtotime(\Carbon\Carbon::now()->toDateTimeString()),

                ];
                $data_output_validate_param['meta']['code'] =   1000;


            }

            $where             =    [
                    [
                        'fields'    =>  'code',
                        'operator'  =>  '=',
                        'value'     =>  $transaction_code,
                    ]
            ];



            $data_update_transaction   =    $ModelTransaction->updateData($data_transaction,$where);

            // update transaction detail

            if($dataDeleteDetail['meta']['success'] && $data_update_transaction['meta']['success']){

                $data_output_validate_param['meta']['success']  =   true;
                $data_output_validate_param['response']         =   $transaction_code;

            }else{

                $data_output_validate_param['meta']['success']  =   false;

            }

        }
        return $data_output_validate_param;
    }
}
?>