<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\HotDeals as ModelHotDeals;
use Spr\Base\Controllers\Helper as HelperController;
use Spr\Base\Controllers\CrawlData\simple_html_dom as SimpleHtmlDom;
use Intervention\Image\Exception\NotReadableException;
use Spr\Base\Response\Response;
use Spr\Base\Controllers\Http\Request as Rep;
use Input;
use Config;
use Auth;
use Lang;
use Session;
use DB;

class HotDealsController  extends Controller
{


    public function __construct()
    {

    }

    public function getAllHotDeals($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']){

            $page           =  $data_output_validate_param['response']['page'];
            $item_on_page   =   Config::get('spr.system.hotdeal_config.item-on-page');
            $cate           = Input::get('cate');
            $discountRanges = Input::get('discountRanges');
            $limit          =   0;
            $html           =   [];
            $result         =   [];
            $url            = Config::get('spr.system.hotdeal_config.all-deals');
            
            $parameter                  = '?gb_f_GB-SUPPLE=sortOrder:BY_SCORE';
            $cate_parameter             = ',enforcedCategories:';
            $discount_ranges_parameter  = ',discountRanges:';
            
            // if($cate != '' && $cate != null) {
                // $url .= $parameter .$cate_parameter.$cate; 
            // }

            if($discountRanges != '' && $discountRanges != null) {
                $url .= $parameter . $discount_ranges_parameter . $discountRanges; 
            }

            // if(isset($_SERVER['REQUEST_URI'])) {

            //     $REQUEST_URI = str_replace('/all-deals', '', $_SERVER['REQUEST_URI']);

            //     $cate           = substr($REQUEST_URI, strpos($REQUEST_URI, 'cate'));
            //     // $cate           = str_replace('cate=', '', $cate);

            //     // dd($REQUEST_URI);


            //     $discountRanges = substr($REQUEST_URI, strpos($REQUEST_URI, 'discountRanges'));

            //     if ($cate != '') {
                    
            //         $url .= $parameter . $cate_parameter . $cate;
            //     }

            //     if ($discountRanges != '') {
            
            //         $url .= $parameter . $discount_ranges_parameter . $discountRanges;
            //     }
            // }
            // else
            // {
            //     $REQUEST_URI = '';
            // }

            // dd($_SERVER['REQUEST_URI']);
            $html           =   $this->getHtmlHotDeal($url);
            $result         =   $this->getDataKey($html);

            if($result['meta']['success'] == false){

                $html     =   $this->getHtmlPrimeDay();
                $result         =   $this->getDataKey($html);
            }
            $fillter = $this->getFilterCate($html);
            
            if($result['meta']['success']){

                $key = $result['meta']['key'];

                $list_key   =   $result['response'][$key];
                $total_item =   count($list_key);

                $total_page =   floor($total_item / $item_on_page);

                $list_data  = [];

                $limit      =   $page * $item_on_page;
                $link_api       =    Config::get('spr.system.hotdeal_config.api.get-hot-deals');
                if($limit < count($list_key)){

                    $list_data  =   array_slice($list_key, $limit,$item_on_page);

                    $data = '';

                    $index = 0;

                    foreach ($list_data as $k => $value) {
           
                        if($index !=(count($list_data)-1)){

                            $data .= '{"dealID":"'.$value.'"},';

                        }else{

                            $data .= '{"dealID":"'.$value.'"}';

                        }

                        $index ++;
                    }

                    $res    =   Rep::getHotDealsAmazon($data,$link_api,$key);

                    $data_json  =   json_decode($res,true);
                    $list       =   []; 
                    foreach ($data_json['dealDetails'] as $key => $value) {

                        if($this->modUrl($value['egressUrl']) !=false){

                            $tmp = [];

                            $tmp['title']           =   $value['title'];
                            $tmp['maxListPrice']    =   $value['maxListPrice'];
                            $tmp['maxCurrentPrice'] =   $value['maxCurrentPrice'];
                            $tmp['maxDealPrice']    =   $value['maxDealPrice'];
                            $tmp['maxPercentOff']   =   $value['maxPercentOff'];
                            $tmp['link']            =   $this->modUrl($value['egressUrl']);
                            $tmp['image']           =   $value['primaryImage'];
                            $tmp['type']            =   $value['type'];
                            $tmp['totalReviews']    =   $value['totalReviews'];
                            $tmp['time']            =   $value['msToEnd'];

                            $list[]     =   $tmp;

                        }

                    }

                    $data_output_validate_param['response']    =    $list;
                    $data_output_validate_param['item']        =    count($list);
                    $data_output_validate_param['total_page']  =    $total_page;
                    $data_output_validate_param['total_item']  =    $total_item;
                    $data_output_validate_param['fillter']     =    [ 'cate' => $fillter['response']];

                }else{
                    $data_output_validate_param['meta']['code'] = 500;
                    $data_output_validate_param['fillter']     =    [ 'cate' => $fillter['response']];
                    $data_output_validate_param['item']        =    0;
                    $data_output_validate_param['total_page']  =    0;
                    $data_output_validate_param['total_item']  =    0;
                    $data_output_validate_param['response']    =    [];
                } 
            }else{
                $data_output_validate_param['meta']['code'] = 400;
                $data_output_validate_param['response']    =    [];
                
            }   
                      
        }
        return $data_output_validate_param;  
    }

    public function getFilterCate($html){

        $results = Response::response();

        try{

            $filter_product = [];
            $arr_header     = [];
            $arr_ul         = [];

            $javascript_json = $html->find('script[type="text/javascript"]');

            $data_cate = [];
            foreach ($javascript_json as  $val_script) {
                
                $text = $val_script->innertext;

                if(strpos($text, 'categories') !==false){

                    $start  = strpos($text, 'categories');
                    $end    = strpos($text, 'marketingIDs');
                    
                    if($end !== false) {
                        
                        $string_data_dimensions = substr($text, $start, $end - $start);
                        $a = str_replace('categories', '', $string_data_dimensions);
                        $b = str_replace(': [', '[', $a);
                        $c = str_replace('],', ']', $b);
                        $data_cate = json_decode($c);            
                    }
                }
            }

            $results['response'] = $data_cate;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code']    = 501;
            $results['meta']['msg']     = ['error'];

        }
        return $results;
    }

    public function getHotDealsForIndex(){

        $html       =   $this->getHtmlHotDeal();
        $result     =   $this->getDataKey($html);

        if($result['meta']['success'] == false){

                $html     =   $this->getHtmlPrimeDay();
                $result         =   $this->getDataKey($html);
        }

        $results    =   Response::response();

        if($result['meta']['success']){

            $key            = $result['meta']['key'];

            $limit          =   0;

            $list_key       =   $result['response'][$key];
            $item_on_index  =   Config::get('spr.system.hotdeal_config.item-on-index');
            $list_data      =   array_slice($list_key, $limit,$item_on_index);
            $link_api       =   Config::get('spr.system.hotdeal_config.api.get-hot-deals');

            $data = '';
            $index = 0;
            foreach ($list_data as $k => $value) {
                
                if($index !=(count($list_data)-1)){

                    $data .= '{"dealID":"'.$value.'"},';

                }else{

                    $data .= '{"dealID":"'.$value.'"}';

                }

                $index ++;
            }
            $res    =   Rep::getHotDealsAmazon($data,$link_api,$key);

            $data_json  =   json_decode($res,true);
            $list       =   []; 
            foreach ($data_json['dealDetails'] as $key => $value) {

                if($this->modUrl($value['egressUrl']) !=false){
                    $tmp = [];

                    $tmp['title']           =   $value['title'];
                    $tmp['maxListPrice']    =   $value['maxListPrice'];
                    $tmp['maxCurrentPrice'] =   $value['maxCurrentPrice'];
                    $tmp['maxDealPrice']    =   $value['maxDealPrice'];
                    $tmp['maxPercentOff']   =   $value['maxPercentOff'];
                    $tmp['link']            =   $this->modUrl($value['egressUrl']);
                    $tmp['image']           =   $value['primaryImage'];
                    $tmp['type']            =   $value['type'];
                    $tmp['totalReviews']    =   $value['totalReviews'];
                    $tmp['time']            =   $value['msToEnd'];

                    $list[]     =   $tmp;
                }

            }

            $results['response']    =   $list;

        } 
        return $results;

    }

    public function getDataKey($html){

        $results = Response::response();

        try{

            $html                       =   $html->find('script[type=text/javascript]');



            $sortedDealIDs              = '"sortedDealIDs" : [';
            $marketplaceId              = '"marketplaceId" :';

            $dealDetails_text      =    "";
            $marketplaceId_text    =    "";
            $sortedDealIDs_text    =    "";

            foreach ($html as $k_script => $val_script) {

                $text = $val_script->innertext;

                if(strpos($text, $sortedDealIDs) !==false && strpos($text, '"dealDetails"') !==false){

                    $sortedDealIDs_text = $text;

                }else if(stripos($text, $marketplaceId) !==false){

                    $marketplaceId_text = $text;

                }

            }

            if(empty($marketplaceId_text) || empty($sortedDealIDs_text)){

                $results['meta']['success']  =   false;
                return  $results;

            }

            $start_martket  =   stripos($marketplaceId_text, $marketplaceId,0);

            $end_martket    =   stripos($marketplaceId_text, ',    "realm" :',0);
            $martket_id     =   substr($marketplaceId_text, $start_martket,$end_martket-$start_martket);
            $martket_id     =   trim(str_replace('"','',explode(":", $martket_id)[1]));
            $start_deals    =   stripos($sortedDealIDs_text, $sortedDealIDs, 0);
            $end_deals      =   stripos($sortedDealIDs_text, '"dealDetails"', 0);
            $sortedDealID   =   substr($sortedDealIDs_text, $start_deals,$end_deals-$start_deals);
            $sortedDealID   =   str_replace('],',']',str_replace('"sortedDealIDs" : ', '', $sortedDealID));

            $results['response'][$martket_id] = json_decode($sortedDealID,true);
            $results['meta']['key']           = $martket_id;


        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code']    = 501;
            $results['meta']['msg']     = ['error'];
        }

        return $results;
    }


    public function getHtmlHotDeal($url = null){

        if ($url == null) {
            
            $url    = Config::get('spr.system.hotdeal_config.all-deals');
        }
        $html   = Rep::get_data_curl($url);
        $dom    = new SimpleHtmlDom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
        $html   = $dom->load($html, true, true);
        return $html;

    }

    public function getHtmlPrimeDay(){

        $url    = Config::get('spr.system.hotdeal_config.prime-day');
        $html   = Rep::get_data_curl($url);
        $dom    = new SimpleHtmlDom(null, true, true, DEFAULT_TARGET_CHARSET, true, DEFAULT_BR_TEXT, DEFAULT_SPAN_TEXT);
        $html   = $dom->load($html, true, true);
        return $html;

    }

    public function modUrl($url){

        $param  =   "";

        if(strpos($url, '/dp/') !==false){

            $params = explode('/dp/', $url);
            if(count($params) > 1){
                $param = $params[1];
            }

        }else if(strpos($url, '&node=') !==false){

            $params = explode('&', $url);

            foreach ($params as $key => $value) {

                if(strpos($value, 'node') !==false){

                    $tmp = explode('=', $value);

                    if(count($tmp) >1){

                        $param = $tmp[1];
                    }
                }
            }

        }else{
            $param  =   false;
        }

        return $param;

    }

}
?>