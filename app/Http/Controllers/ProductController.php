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
use Spr\Base\Controllers\GoogleTranslate\TranslateClient as Translate;
use Input;
use Config;
use Auth;
use Lang;
use Session;
use DB;
use Cookie;

class ProductController  extends Controller
{


    public function __construct()
    {

    }

    public function search_product() {

        $key_search = [];
        foreach (Input::all() as $key => $value) {
            if(ModelProduct::checkIsVN($value)){
                $key_search[$key] = Translate::__callStatic('translate',['vi','en',$value]);
            }
        }
        if(count($key_search)==0){
            $key_search = Input::all();
        }
        $results    = Response::response();
        $url        = Config::get('spr.system.link_get_data.amazon.jp.search');
        $html       = $this->getHtmlDom($url, $key_search);

        $results['data']    = $this->getDataOnUrl($html);
        $results['filter']  = $this->getFilterCate($html);

        return $results;
    }

    public function get_product_by_cate($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']){

            $node = $data_output_validate_param['response']['n'];
            $url = Config::get('spr.system.link_get_data.amazon.jp.list-product-by-cate') . '?rh=n:'.$node.',p_n_publication_date:1250227011';

            $html       = $this->getHtmlDom($url);

            $data_output_validate_param['data']     = $this->getDataOnUrl($html);
            $data_output_validate_param['filter']   = $this->getFilterCate($html);
        }
        return $data_output_validate_param;
    }

    public function detailProduct($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']){
            $results = Response::response();
            //https://www.amazon.co.jp/gp/product/ajax-handlers/apparel-sizing-chart.html/ref=dp_sizechart?ie=UTF8&asin=B01KNY0UUW&isUDP=1
            // reques nhuong dan chon size
            $url = Config::get('spr.system.link_get_data.amazon.jp.detail-product').Input::get('code'). '?th=1&psc=1';
            $html = $this->getHtmlDom($url);
            $data_output_validate_param['response']                    =   [];
            $data_output_validate_param['response']['price']           =   $this->getProductPrice($html);
            $data_output_validate_param['response']['weight']          =   $this->getProductWeight($html)['response'];
            $data_output_validate_param['response']['type_product']    =   $this->getSizeAndColor($html, Input::get('code'))['response'];

            // if(empty($data_output_validate_param['response']['type_product']['data_img'])){

            //     if(isset($this->getProductImageBase($html)['response'])){

            //         $data_output_validate_param['response']['type_product']['data_img']     =   $this->getProductImageBase($html)['response'];
            //         // dd($data_output_validate_param['response']['type_product']['data_img']);
            //     }
            // }

            // $data_output_validate_param['response']['image_base']      =   $this->getSizeAndColor($html)['response'];
            $data_output_validate_param['response']['customer_review'] =   $this->getCustomerReview($html)['response'];
            $data_output_validate_param['response']['product_base']    =   $this->getProductBase($html)['response'];
            $data_output_validate_param['response']['product_des']     =   $this->getProductDescription($html)['response'];
            $data_output_validate_param['response']['product_infor']   =   $this->getProductInformation($html)['response'];
            $data_output_validate_param['response']['bread_crumb']     =   $this->getBreadCrumb($html)['response'];

        }
        return $data_output_validate_param;
    }


    public function getDataOnUrl($html) {

        $results = Response::response();

        try{

            $result = [];

            $item   = $html->find('li[data-asin]');

            foreach ($item as $key_item => $value_item) {

                $temp = [];
                $temp['old_price'] = 0;
                $temp['discount_price'] = 0;
                $temp['discount_percent'] = 0;
                $temp['price'] = 0;

                $img = $value_item->find('img');

                foreach ($img as $img_key => $img_value) {

                    $temp['img'] = $img_value->attr['src'];
                    break;

                }

                $link = $value_item->find('a[class=s-access-detail-page]');

                foreach ($link as $link_key => $link_value) {

                    $link = $link_value->attr['href'];
                    $link_detail = explode('/', $link);
                    foreach ($link_detail as $link_detail_key => $link_detail_value) {
                        if($link_detail_value == 'dp'){

                            $tmp = explode('&', $link_detail[$link_detail_key + 1]);
                            $temp['link']['code'] = $tmp[0];

                            break;
                        }
                    }

                    $temp['link']['param'] = explode('?', $link)[1];
                }

                $price = $value_item->find('span[class=s-price]');
                $price_value = "";
                $rate = '';
               
                foreach ($price as $p_key => $p_value) {

                    $price_value = $p_value->innertext;
                    $data_price_ranger =  explode("-", $price_value);

                    if(count($data_price_ranger) > 0){

                        $data_price     = explode("￥", $data_price_ranger[0]);
                        $data_price_up = 0;
                        if(isset($data_price_ranger[1])){
                            
                            $data_price_up  = explode("￥", $data_price_ranger[1]);
                        }
                        if(COUNT($data_price) > 1){

                            $temp['price'] = trim(str_replace(',', '', $data_price[1]));
                            
                        }

                        if(COUNT($data_price_up) > 1){
                            $temp['price_up'] = trim(str_replace(',', '', $data_price_up[1]));
                        }
                    }

                    

                    $a_price = $p_value->parent();
                    $span_discount = $a_price->next_sibling();
                    if($span_discount != null) $span_discount = $span_discount->next_sibling();

                    if($span_discount != null ){

                        $discount_value = $span_discount->innertext;
                        $data_discount = explode("￥", $discount_value);

                        if(COUNT($data_discount) > 1){

                            $temp['old_price'] = trim(str_replace(',', '', $data_discount[1]));
                            $price = (double)$temp['price'];
                            $old_price = (double)$temp['old_price'];
                            if($price < $old_price) {

                                $discount_price = $old_price - $price;

                                $temp['discount_percent'] = floor(($discount_price / $old_price) * 100);
                                $temp['discount_perice'] = $discount_price;

                            }else {
                                $temp['old_price'] = 0;
                            }
                        }
                    }
                    break;
                }

                $i = $value_item->find('i[class=a-icon-star]');
                foreach ($i as $i_key => $i_value) {

                    $rate = $i_value->find('span');
                    $temp['rate'] = str_replace('5つ星のうち ', '', $rate[0]->innertext);

                    break;
                }

                $h2 = $value_item->find('h2[class=s-access-title]');
                foreach ($h2 as $h2_key => $h2_value) {


                    $temp['title'] = html_entity_decode($h2_value->attr['data-attribute']);
                    break;
                }
                array_push($result, $temp);
            }
            $results['response'] = $result;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code']    = 501;
            $results['meta']['msg']     = ['error'];

        }
        return $results;
    }

    public function getFilterCate($html){

        $results = Response::response();

        try{

            $filter_product = [];
            $arr_header     = [];
            $arr_ul         = [];

            $header = $html->find('div[id=refinements] h2');
            $ul     = $html->find('div[id=refinements] ul[id^=ref]');

            foreach ($header as $val_h) {

                if(strcmp($val_h->text(),'アーティスト') && strcmp($val_h->text(),'配達日')!=0){
                    array_push($arr_header, $val_h->text());
                }
            }


            foreach ($ul as  $val_ul) {

                if(!isset($val_ul->attr['class'])){

                    $sub_ul = [];

                    $a_href = "";
                    $li_name= "";

                    $li = $val_ul->find('li');

                    foreach ($li as $val_li) {

                            $link = "";
                            $text = "";

                            $tag_a = $val_li->find('a',0);

                            if($tag_a != null) $link = $tag_a->getAttribute('href');

                            $listElement = $val_li->find('span,strong');

                            foreach ($listElement as $node) {

                                $text = trim($node->text());

                                if($text != '') break;
                            }

                            if($link != ""){
                                $param =  explode("?", $link);
                                $link =  $param[1];
                            }else{
                                $link = "";
                            }
                            $text = str_replace('<font>', '', $text);
                            $text = str_replace('</font>', '', $text);

                            $data = [
                                'link' => $link,
                                'name' => $text
                            ];
                            $sub_ul[] = $data;
                    }
                    $arr_ul[] =  $sub_ul;
                }
            }


            foreach($arr_header as $key => $value_header) {

                if(isset($arr_ul[$key])) {
                    $filter_product[$value_header] = $arr_ul[$key];
                }else {

                }

            }

            foreach ($filter_product as $k => $val) {
                if(empty($filter_product[$k])){
                    unset($filter_product[$k]);
                }
            }

            $results['response'] = $filter_product;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code']    = 501;
            $results['meta']['msg']     = ['error'];

        }
        return $results;
    }

    public function getHtmlDom($url,$param = array()){
        $html = null;
        if(isset($param) && !empty($param)){
            $html = BaseRequest::get_data_curl($url,$param);
        }else{
            $html = BaseRequest::get_data_curl($url);
        }
        $dom    = new SimpleHtmlDom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
        $html   = $dom->load($html, true, true);
        return $html;
    }

    public function getFeatureBase ($html) {


        $results        =   Response::response();
        $feature_base   =   [];

        try{

            $filter_feature_base = $html->find('div[id=feature-bullets] ul li');

            foreach ($filter_feature_base as  $val_ffb)
            {
                $feature    = "";
                if($val_ffb->find('span',0)!=null){

                    $tmp = [];
                    $feature    = $val_ffb->find('span',0)->text();
                    $base = explode(":", trim($feature));

                    if(count($base) > 1 ){

                        $tmp['lbl'] = $base[0];
                        $tmp['val'] = $base[1];
                        array_push($feature_base, $tmp);

                    }
                }
            }
            $results['response']    =   $feature_base;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code']    = 501;
            $results['meta']['msg']     = ['error'];
        }

        return $results;
    }

    public function getCustomerReview($html){

        $results            =   Response::response();
        $customer_review    =   [];
        try{

            $filter_customer_review = $html->find('div[class="a-section celwidget"]');
            foreach($filter_customer_review as $val_cr){
                $title      = "";
                $customer   = "";
                $date       = "";
                $comment    = "";
                $rate       = "";

                $tmp = [];

                $title      = $val_cr->find('div div a span[class="a-size-base a-text-bold"]',0);
                $customer   = $val_cr->find('div span span a[class="noTextDecoration"]',0);
                $date       = $val_cr->find('div span span[class="a-color-secondary"]',0);
                $comment    = $val_cr->find('div div[class="a-section"]',0);
                $rate       = $val_cr->find('span[class="votingStripe"] span[class="cr-vote-buttons"]',0);

                $tmp['title']       = ($title != null) ? $title->text():"";
                $tmp['customer']    = ($customer != null) ? $customer->text():"";
                $tmp['date']        = ($date != null) ? $date->text():"";
                $tmp['comment']     = ($comment != null) ? $comment->text():"";
                $tmp['rate']        = ($rate != null) ? $rate->text():"";

                array_push($customer_review, $tmp);
            }

            $results['response']    =   $customer_review;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code']    = 501;
            $results['meta']['msg']     = ['error'];
        }

        return $results;

    }

    public function getProductBase($html){

        $results        =   Response::response();
        $product_base   =   [];
        try{

            $name           = $html->find('span[id="productTitle"]',0);
            $made_by        = $html->find('a[id="brand"]',0);
            $sale           = $html->find('tr[id="regularprice_savings"] td span[class="a-span12 a-color-price a-size-base"]',0);
            $status         = $html->find('div[id="availability"] span[class="a-size-medium a-color-success"]',0);
            $review         = $html->find('span[id="acrCustomerReviewText"]',0);
            $reply          = $html->find('a[id="askATFLink"] span[class="a-size-base"]',0);
            $seller         = $html->find('div[id="merchant-info"] a',0);
            $original_price = $html->find('div[id="price"] table tbody tr td span[class="a-text-strike"]',0);
            $current_price  = $html->find('span[id="priceblock_ourprice"]',0);

            $name                   = ($name != null) ? trim($name->text()) : "";
            
            $name                   = str_replace('<font>', '', $name);
            $name                   = str_replace('</font>', '', $name);
            $product_base['name']   =  str_replace('</ font>', '', $name);


            $product_base['current_price']      = ($current_price != null) ? trim(str_replace(",","",str_replace("￥","", $current_price->text()))) : "";
            $product_base['original_price']      = ($original_price != null) ? trim(str_replace(",","",str_replace("￥","", $original_price->text()))) : "";
            $product_base['
            ']       = ($sale != null) ? trim($sale->text()) : "";
            $product_base['made_by']    = ($made_by != null) ? trim($made_by->text()) : "";
            $product_base['status']     = ($status != null) ? trim($status->text()) : "";
            $product_base['review']     = ($review != null)  ? trim($review->text()) : "";
            $product_base['reply']      = ($reply != null) ? trim($reply->text()) : "";
            $product_base['seller']     = ($seller != null) ? trim($seller->text()) : "";

            $results['response']    =   $product_base;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code']    = 501;
            $results['meta']['msg']     = ['error'];
        }

        return $results;

    }

    public function getProductDetail($html){

        $results        =   Response::response();
        $product_detail =   [];

        try{

            $filter = $html->find('div[id="detail_bullets_id"] table tbody tr td div ul li',0);

            if($filter != null){

                $filter_product_detail = $html->find('div[id="detail_bullets_id"] table tbody tr td div ul li');

                foreach ($filter_product_detail as $k_fpd => $val_fpd) {

                    $tmp = [];
                    $val    = $val_fpd->text();
                    $tmp['val']   = trim($val);

                    array_push($product_detail, $tmp);
                }
            }

            $results['response']    =    $product_detail;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code']    = 501;
            $results['meta']['msg']     = ['error'];
        }

        return $results;

    }

    public function getProductInformation($html){

        $results        =   Response::response();
        $product_infor  =   [];

        try{

            $filter = $html->find('div[id="aplus"] div[class="aplus-v2 desktop celwidget"]',0);

            if($filter != null){
                $product_infor =  $filter;
                foreach ($product_infor->find('script,span[class=a-expander-prompt]') as $node)
                {
                    $node->outertext = '';
                }

            }
            $results['response']    =    $product_infor;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code']    = 501;
            $results['meta']['msg']     = ['error'];
        }

        return $results;

    }

    public function getParentProduct($html){

        $filter = $html->find('div[id="wayfinding-breadcrumbs_feature_div"] ul[class="a-unordered-list a-horizontal a-size-small"]',0);
    }

    public function getProductDescription($html){

        $results = Response::response();
        $product_des = "";

        try{

            $product_des = $html->find('div[id="productDescription"] p',0);

            if($product_des != null){

                $product_des = trim($product_des->text());
            }

            $results['response']  = $product_des;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code']    = 501;
            $results['meta']['msg']     = ['error'];
        }
        return $results;

    }

    public function getBreadCrumb($html){

        $response       = Response::response();
        $ModelProduct   = new ModelProduct();
        $breadCrumb     = [];

        try{

            $filter      = $html->find('div[id="wayfinding-breadcrumbs_feature_div"] ul',0);
            $bread_crumb = [];

            if($filter != null){

                $a = $filter->find('li span a');

                foreach ($a as $key => $val) {
                    $tmp    = [];
                    $name   = $val->text();
                    $node   = $ModelProduct->getProductId($val->href);

                    $tmp['name']    = trim($name);
                    $tmp['node']    = $node;

                    array_push($bread_crumb, $tmp);
                }
            }

            $response['response'] = $bread_crumb;

        }catch(Exception $ex){

            $response['meta']['success'] = false;
            $response['meta']['code']    = 501;
            $response['meta']['msg']     = ['error'];
        }

        return $response;
    }

    public function getSizeAndColor($html, $node = ''){

        $response       = Response::response();

        try{
            $javascript_json = $html->find('script[type="text/javascript"]');
            $search_data_map = "updateDivLists";
            $search_data_img_color = 'data["colorImages"]';
            $string_data_map_size = "";
            $string_data_img_color = "";

            foreach ($javascript_json as $k_script => $val_script) {

                $text = $val_script->innertext;

                if(strpos($text, $search_data_map) !==false){

                    $string_data_map_size = $text;
                }else if(strpos($text, $search_data_img_color) !==false) {

                    $string_data_img_color = $text;
                }

                if($string_data_img_color != "" && $string_data_map_size != '') break;
            }

            $dimensionValuesDisplayData     =   $string_data_map_size;

            $start  = strpos($string_data_map_size, '"dimensions"');
            $end    = strpos($string_data_map_size, '"unselectedDimCount"');

            $string_data_dimensions = substr($string_data_map_size, $start, $end - $start);

            $dimension  = $this->getDataJsonOnStringDimensions($string_data_dimensions);

            $start  = strpos($string_data_map_size, 'dimensionToAsinMap');
            $end    = strpos($string_data_map_size, '"asinVariationValues"');

            $string_data_map_size = substr($string_data_map_size, $start, $end - $start);

            $start  = strpos($string_data_map_size, 'dimensionToAsinMap');
            $end    = strpos($string_data_map_size, '"variationValues"');

            $dimension_to_asin_map = $this->getDataJsonOnString(substr($string_data_map_size, $start, $end - $start));

            $start           = strpos($string_data_map_size, '"variationValues"');
            $variationValues = $this->getDataJsonOnString(substr($string_data_map_size, $start));

            $start  = strpos($string_data_img_color, 'data["colorImages"]');
            $end    = strpos($string_data_img_color, 'data["heroImage"]');

            $data_img = $this->getDataJsonOnStringImg(substr($string_data_img_color, $start, $end - $start));


            $start  = strpos($dimensionValuesDisplayData, 'dimensionValuesDisplayData');
            $end    = strpos($dimensionValuesDisplayData, '"prioritizeReqPrefetch"');
            $data_map_detail =  $this->getDataJsonOnString(substr($dimensionValuesDisplayData, $start, $end - $start));
            $data_key_image = [];

            if(empty($data_img)) {

                $html_img   =   $html->find('#altImages > img');
                // dd($html_img);
                $list_image =   [];
                $image      =   [];
                $img_large  =  'SR420,420_';

                foreach ($html_img as $key => $value) {

                    $temp   =   [];
                    $temp['thumb']          =   $value->getAttribute('src');
                    $tmp_large              =   explode('/images/',$temp['thumb']);
                    $tmp_change_size        =   explode('.', $tmp_large[1]);
                    $tmp_change_size[1]     =   $img_large;
                    $temp['large']          =  $tmp_large[0].'/images/'.implode('.', $tmp_change_size);
                    $image[]                =   $temp;
                }
                $data_img  =  [$node => $image];
            }

            if($data_map_detail == null){

                $data_map_detail = [$node => $node];
                $data_key_image[$node] = $node;
            } 
            foreach ($data_map_detail as $key => $value) {

                if(is_array($value)){
                    
                    $tmp = implode(' ', $value);
                }else {
                    $tmp = $value;
                }

                if(isset($data_img[$tmp])) {

                    $data_key_image[$key] = trim($tmp);
                }else {

                    foreach ($value as $sub_key => $sub_value) {

                        if(isset($data_img[$sub_value])) {

                            $data_key_image[$key] = trim($sub_value);
                            break;
                        }
                    }
                }
            }
            $response['response']['dimension_to_asin_map']  = ( $dimension_to_asin_map == null )? [] : $dimension_to_asin_map;
            $response['response']['variationValues']        = ( $variationValues == null )? [] : $variationValues;
            $response['response']['data_img']               = ( $data_img == null )? [] : $data_img;
            $response['response']['data_key_image']         = ( $data_key_image == null )? [] : $data_key_image;
            $response['response']['dimension']              = ( $dimension == null )? [] : $dimension;
            $response['response']['data_map_detail']        = ( $data_map_detail == null )? [] : $data_map_detail;

        }catch(Exception $ex){

            $response['meta']['success'] = false;
            $response['meta']['code']    = 501;
            $response['meta']['msg']     = ['error'];
        }
        return $response;
    }

    public function getDataJsonOnString ($string) {

        $dump = explode('" : ', $string);
        $data = "";
        if(count($dump) > 1){
            $data = str_replace('},','}',$dump[1]);
        }
        return json_decode($data, TRUE);
    }

    public function getDataJsonOnStringImg ($string) {

        $dump = explode(' = ', $string);
        $data = "";
        if(count($dump) > 1){
            $data = str_replace(';','',$dump[1]);
        }
        return json_decode($data, TRUE);
    }

    public function getDataJsonOnStringDimensions ($string) {

        $dump = explode(' : ', $string);
        $data = "";

        if(count($dump) > 1){
            $data = str_replace('[','',$dump[1]);
            $data = str_replace('],','',$data);
            $data = str_replace('"','',$data);
            $data = str_replace(' ','',$data);
        }
        return explode(",", $data);
    }
    public function getProductPrice($html){

        $results        =   Response::response();
        $price          =   [];
        $config         =   Config::get('spr.type.type.type-price');

        try{
            //priceblock_dealprice_row
            $priceblock_ourprice_row  =   $html->find('table[class=a-lineitem] tbody tr[id=priceblock_ourprice_row]',0);
            if($priceblock_ourprice_row == null){

                $priceblock_ourprice_row  =  $html->find('table[class=a-lineitem] tbody tr[id=priceblock_dealprice_row]',0);
            }
            $regularprice_savings     =   $html->find('table[class=a-lineitem] tbody tr[id=regularprice_savings]',0);
            if($regularprice_savings == null){

                $regularprice_savings =   $html->find('table[class=a-lineitem] tbody tr[id=dealprice_savings]',0);
            }
            $text_price               = ($priceblock_ourprice_row != null)? $priceblock_ourprice_row->find('td',1)->find('span', 0)->text() : '';
            $text_price_savings       = ($regularprice_savings != null)? $regularprice_savings->find('td',1)->text() : '';

            
            $price = [
                'current_price' => 0,
                'from'  => 0,
                'to'    => 0,
                'save'  => 0,
            ];

            $data_price = explode(' - ', $text_price);

            if(COUNT($data_price) > 1) {

                $price['from']          =  str_replace(',','',trim(str_replace('￥','' , $data_price[0])));
                $price['to']            =  str_replace(',','',trim(str_replace('￥','' , $data_price[1])));
            }else {

                $price['current_price'] = str_replace(',','',trim(str_replace('￥','' , $data_price[0])));
            }

            if($text_price_savings != '') {

                $text_price_savings = explode("(",  $text_price_savings)[0];
                $price['save']          = str_replace(',','',trim(str_replace('￥','' , $text_price_savings)));
            }

            $results['response'] = $price;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code']    = 501;
            $results['meta']['msg']     = ['error'];
        }

        return $results;

    }

    public function getPriceOfProduct($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']){

            $code   = $data_output_validate_param['response']['code'];
            $url    = Config::get('spr.system.link_get_data.amazon.jp.detail-product') . $code . '?th=1&psc=1';
            $html   = $this->getHtmlDom($url);

            $data_price = $this->getDetailPriceOfProduct($html);
            $data_output_validate_param['response'] = $data_price;

        }
        return $data_output_validate_param;
    }

    public function getDetailPriceOfProduct ($html)  {

        $price  = $this->getProductPrice($html);

        $ModelPriceListDetail = new ModelPriceListDetail();
        $price_list_id = null;

        if(Auth::guard('customer')->check()){

            $group_customer = Auth::guard('customer')->user()->group_customer;

            if($group_customer != null){
                $ModelGroupCustomer =new ModelGroupCustomer();
                $data_group_customer = $ModelGroupCustomer->getDataById($group_customer);

                if($data_group_customer['meta']['success'] && COUNT($data_group_customer['response']) > 0) {
                    $price_list_id = $data_group_customer['response'][0]->price_list_id;
                }
            }
        }

        $price_list = [];

        if($price_list_id != null) {

            $price_list = $ModelPriceListDetail->getPriceListById($price_list_id);

        }else {

            $price_list = $ModelPriceListDetail->getPriceListDefault() ;

        }
        $price['response']['price_list'] = [];
        $price['response']['currency'] = Session::get('ExchangeRateCurrency-'.RequestBase::ip())['JPY'];
        if($price_list['meta']['success'] && COUNT($price_list['response']) > 0) {

            $price['response']['price_list'] = $price_list['response'];
        }
        return $price['response'];
    }

    public function addProductToShoppingCart ($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

            $code           = $data_output_validate_param['response']['code'];
            $quantity       = $data_output_validate_param['response']['quantity'];
            $url            = Config::get('spr.system.link_get_data.amazon.jp.detail-product') . $code . '?th=1&psc=1';
            $html           = $this->getHtmlDom($url);
            $data_price     = $this->getDetailPriceOfProduct($html);

            $current_price  = (int)$data_price['current_price'];
            if($current_price == 0) {

                $data_output_validate_param['meta']['success']  = false;
                $data_output_validate_param['meta']['code']     = '0028';
                $data_output_validate_param['meta']['msg']      = [Lang::get('message.web.error.0028')];
                $data_output_validate_param['response']         = '';
            }else {

                $data_item = [

                    'code'      => $code,
                    'quantity'  => $quantity,
                    'price'     => $data_price,
                ];
                $data_shopping_cart = [];
                $product_exit = false;

                if( isset($_COOKIE['shopping_cart'])) {

                    $data_shopping_cart = json_decode( $_COOKIE['shopping_cart'] );

                    foreach ($data_shopping_cart as $key => $value) {

                        if($value->code == $code) {

                            $value->quantity +=  $quantity;
                            $product_exit = true;
                            break;
                        }
                    }
                }
                if(!$product_exit) {

                    array_push($data_shopping_cart, $data_item);
                }


                $data_output_validate_param['meta']['msg']      = [Lang::get('message.web.success.0006')];
                $data_output_validate_param['meta']['code']     = 0006;
                $data_output_validate_param['response']         = $data_shopping_cart;
            }
        }
        setcookie('shopping_cart', json_encode($data_shopping_cart));

        return $data_output_validate_param;
    }

    public function getProductImageBase($html){

        $results    =   Response::response();

        try{

            $html_img   =   $html->find('#altImages > img');
            $list_image =   [];
            $image      =   [];

            $img_large  =  'SR420,420_';

            foreach ($html_img as $key => $value) {

                $temp   =   [];

                $temp['thumb']          =   $value->getAttribute('src');
                $tmp_large              =   explode('/images/',$temp['thumb']);
                $tmp_change_size        =   explode('.', $tmp_large[1]);
                $tmp_change_size[1]     =   $img_large;

                $temp['large']          =  $tmp_large[0].'/images/'.implode('.', $tmp_change_size);
                $image[]                =   $temp;
            }
            $list_image []          =   $image;

            $results['response']        =   $list_image;
        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code']    = 501;
            $results['meta']['msg']     = ['error'];

        }
        return $results;
    }

    public function getProductWeight($html){

        
        $results    =   Response::response();

        $unit       =   Config::get('spr.type.type.weight');

        try{

            $html_weight        =   $html->find('.shipping-weight',0);

            $weight             =   [];

            if($html_weight != null){

                $text_weight     =   $html_weight->find('td.value',0)->text();

                $tmp             =   explode(' ', $text_weight);
                if(count($tmp) > 0){

                    $weight['value']    =  $tmp[0];
                    $weight['unit']     =  $tmp[1];

                }else{

                    $weight['value']    = null;
                }

            }
            if(isset($weight) && !empty($weight)){
                
                if(array_key_exists(strtolower($weight['unit']), $unit)){

                    $weight['value']    =   $unit[strtolower($weight['unit'])]['1'] * $weight['value'];

                }else{

                    $weight['value']    =   null;

                }

                $results['response']['current_weight']    =   $weight['value'];

            }else{

                $results['response']['current_weight']      =   null;
            }

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code']    = 501;
            $results['meta']['msg']     = ['error'];

        }
        return $results;        
    }
}
?>