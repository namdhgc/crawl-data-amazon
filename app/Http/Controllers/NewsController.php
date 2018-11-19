<?php

namespace App\Http\Controllers;

use Spr\Base\Models\Helper;
use App\Http\Models\News as ModelNews;
use Config;
use Input;
use Auth;
use Lang;


/**
*
*/
class NewsController extends Controller
{

	protected $table = 'news';

	function __construct()
	{
		# code...
	}

	public function postNews($data_output_validate_param) {

        // dd($data_output_validate_param);

        if ($data_output_validate_param['meta']['success']) {

            $MediaController    = new MediaController();

            $where = [];

            $title              = $data_output_validate_param['response']['title'];
            $image              = $data_output_validate_param['response']['image'];
            $description        = $data_output_validate_param['response']['description'];
            $sub_description    = $data_output_validate_param['response']['sub_description'];
            $category_id        = $data_output_validate_param['response']['category_id'];
            $lang_code          = $data_output_validate_param['response']['lang_code'];
            $created_by_id      = Auth::guard('web')->user()->id;
            $image_id           = null;

            if (isset($image)) {

                $image_id = $MediaController->imageUpload($data_output_validate_param)['response']['data']['response'];
            }

            $slug = $this->convertAccentString(str_replace(' ', '-', $title));

            $data = [
                'title'             => $title,
                'avatar'            => $image_id,
                'description'       => $description,
                'sub_description'   => $sub_description,
                'category_id'       => $category_id,
                'lang_code'         => $lang_code,
                'slug'              => $slug,
                'created_by_id'     => $created_by_id,
                'created_at'        => strtotime(\Carbon\Carbon::now()->toDateTimeString()),
            ];

            $results = ModelNews::insertData($this->table, $data, $where);

            $data_output_validate_param['meta']['msg']      = Lang::get('web.success.0002');
            $data_output_validate_param['response']['data'] = $results;

        } else {

            $data_output_validate_param['meta']['code']     = 500;
            $data_output_validate_param['meta']['msg']      = Lang::get('web.error.0017');
        }

        return $data_output_validate_param;
    }

    public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {

            $ModelNews = new ModelNews();

            $data = $ModelNews->getDataManage($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response']['data'] = array();
        }

        return $data_output_validate_param['response'];
    }

    public function getDataUser($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];
        $post_id        = $data_output_validate_param['response']['post_id'];

        if($data_output_validate_param['meta']['success']) {

            $ModelNews = new ModelNews();

            $data = $ModelNews->getDataUser($key_search, $limit, $sort, $sort_type, $post_id);

            if (isset($data['response'][0])) {
                
                $data_output_validate_param['response']['data'] = $data;
            } else {
            
                $data_output_validate_param['response']['data'] = array();
            }

        }else {

            $data_output_validate_param['response']['data'] = array();
        }

        return $data_output_validate_param['response'];
    }

    public function editNews($data_output_validate_param) {

        if ($data_output_validate_param['meta']['success']) {

            $id                 = $data_output_validate_param['response']['id'];
            $title              = $data_output_validate_param['response']['title'];
            $image              = $data_output_validate_param['response']['image'];
            $description        = $data_output_validate_param['response']['description'];
            $sub_description    = $data_output_validate_param['response']['sub_description'];
            $category_id        = $data_output_validate_param['response']['category_id'];
            $lang_code          = $data_output_validate_param['response']['lang_code'];
            $updated_by_id      = Auth::guard('web')->user()->id;

            $where = [
                [
                    'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id
                ]
            ];

            if (isset($image) && $image != null) {

                $MediaController    = new MediaController();
                $image_id           = $MediaController->imageUpload($data_output_validate_param)['response']['data']['response'];
            }

            $data = [
                'title'             => $title,
                'description'       => $description,
                'sub_description'   => $sub_description,
                'category_id'       => $category_id,
                'lang_code'         => $lang_code,
                'updated_by_id'     => $updated_by_id,
                'updated_at'        => strtotime(\Carbon\Carbon::now()->toDateTimeString())
            ];

            if (isset($image_id)) {

                $data['avatar'] = $image_id;
            }

            $ModelNews = new ModelNews();

            $results = $ModelNews->updateData($this->table, $data, $where);

            $data_output_validate_param['meta']['msg']      = Lang::get('web.success.0001');
            $data_output_validate_param['response']['data'] = $results;

        } else {

            $data_output_validate_param['meta']['code']     = 500;
            $data_output_validate_param['meta']['msg']      = Lang::get('web.error.0018');
        }

        return $data_output_validate_param;
    }

    public function deleteNews($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']){

            $id =   $data_output_validate_param['response']['id'];

            $ModelNews            =   new ModelNews();

            $where = [
                [
                    'fields'    =>  'id',
                    'operator'  =>  '=',
                    'value'     =>  $id
                ]
            ];

            $data = [

                'deleted_at'    =>  strtotime(\Carbon\Carbon::now()->toDateTimeString())

            ];

            $data_output_validate_param = $ModelNews->updateData($this->table, $data,$where);
        }

        return $data_output_validate_param;
    }

    public function convertAccentString($str) {

        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);   

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);

        return $str;
    }
}