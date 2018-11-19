<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\DetailNewsCategories as ModelDetailNewsCategories;
use Spr\Base\Controllers\Helper as HelperController;
use Intervention\Image\Exception\NotReadableException;
use Input;
use Config;
use Auth;
use Lang;
use Session;

class DetailNewsCategoriesController  extends Controller
{


    public function __construct()
    {
    }

    public function insertData($data_output_validate_param){

        if ($data_output_validate_param['meta']['success']) {

            $where      = [];
            $cate_id    = $data_output_validate_param['response']['cate_id'];
            $name       = $data_output_validate_param['response']['name'];
            $lang_code  = $data_output_validate_param['response']['lang_code'];
            $created_at = $data_output_validate_param['response']['created_at'];

            $data = [

                'cate_id'   =>  $id,
                'name'      =>  $name,
                'lang_code' =>  $lang_code,
                'created_at'=>  $created_at,

            ];

            $ModelDetailNewsCategories =  new ModelDetailNewsCategories();
            $id    = $ModelDetailNewsCategories->insertData($data);
            $data_output_validate_param['response']['id'] = $id;
            $data_output_validate_param['response']['msg'] = 'Add new success.';

        }
        return $data_output_validate_param;
    }

    public function updateData($data_output_validate_param){

        if ($data_output_validate_param['meta']['success']) {

            $where      = [];
            $cate_id    = $data_output_validate_param['response']['cate_id'];
            $name       = $data_output_validate_param['response']['name'];
            $lang_code  = $data_output_validate_param['response']['lang_code'];
            $updated_at = $data_output_validate_param['response']['created_at'];

            $data = [

                'cate_id'   =>  $id,
                'name'      =>  $name,
                'lang_code' =>  $lang_code,
                'updated_at'=>  $updated_at,

            ];

            $ModelDetailNewsCategories =  new ModelDetailNewsCategories();
            $id    = $ModelDetailNewsCategories->insertData($data);
            $data_output_validate_param['response']['id'] = $id;
            $data_output_validate_param['response']['msg'] = 'Add new success.';

        }
        return $data_output_validate_param;        
    }

    public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {

            $ModelNewsCategories = new ModelNewsCategories();

            $data = $ModelNewsCategories->getDataManage($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response'] = array();
            $data_output_validate_param['response']['data'] = [];
        }

        return $data_output_validate_param['response'];
    }
}
?>