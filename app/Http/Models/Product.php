<?php
namespace App\Http\Models;

use DB;
use Spr\Base\Models\Helper;
use Illuminate\Database\Eloquent\Model;
use Spr\Base\Response\Response;
use lang;
use Config;
/**
*
*/
class Product extends Model
{

    protected $table = "product";

   

    public function get_product_list($html,$product_key){
        
    }


    public function get_product_id($link){
        
    }

    public function changeSizeImage($src){

        $image = explode("_", $src);

        for ($i=0; $i < count($image); $i++) { 
            if($i ==1){
                $image[$i] = "SR420,420_";
            }
        }

        $img = implode(".", $image);
    }

    public function getProductId($link){
        $url_base = explode("?",$link);
        $product_id = "";
        if(array_key_exists('1',$url_base))
        {
            $url_params = explode('&',$url_base[1]);        
            for($n = 0; $n < count($url_params);$n++)
            {
                if(strpos($url_params[$n],'node=') !== false){
                    $product_id = str_replace('node=','',$url_params[$n]);
                }
            }
        }
        return $product_id; 
    }
    public static function checkIsVN($str) {
        $key = strtolower($str);
        $flag = "";
        if(preg_match("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/",$key) ||
            preg_match("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/",$key) ||
            preg_match("/(ì|í|ị|ỉ|ĩ)/",$key) ||
            preg_match("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/",$key) ||
            preg_match("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/",$key) ||
            preg_match("/(ỳ|ý|ỵ|ỷ|ỹ)/",$key) ||
            preg_match("/(đ)/",$key)
         )
        {
            $flag = true;
        }
        
        return $flag;
    }

}