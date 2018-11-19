<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\NewsCategories as ModelNewsCategories;
use App\Http\Models\News as ModelNews;
use Spr\Base\Controllers\Helper as HelperController;
use Intervention\Image\Exception\NotReadableException;
use Input;
use Config;
use Auth;
use Lang;
use Session;

class NewsCategoriesController  extends Controller
{


    public function __construct()
    {
    }

    public function insertData($data_output_validate_param){

        if ($data_output_validate_param['meta']['success']) {
            $where          = [];
            $name           = $data_output_validate_param['response']['name'];
            $lang_code      = $data_output_validate_param['response']['lang_code'];
            $description    = $data_output_validate_param['response']['description'];
            $created_at     = $data_output_validate_param['response']['created_at'];

            $data = [

                'name'          =>  $name,
                'lang_code'     =>  $lang_code,
                'description'   =>  $description,
                'created_at'    =>  $created_at,

            ];

            $ModelNewsCategories =  new ModelNewsCategories();
            $data    = $ModelNewsCategories->insertData($data);

            if($data['meta']['success']){

                $data_output_validate_param['meta']['msg']['insert'] = Lang::get('message.web.success.0002');

            }else{

                $data_output_validate_param['meta']['msg']['insert'] = Lang::get('message.web.error.0017');
            }

        }
        return $data_output_validate_param;
    }

    public function updateData($data_output_validate_param){

        if ($data_output_validate_param['meta']['success']) {

            $where          = [];
            $id             = $data_output_validate_param['response']['id'];
            $name           = $data_output_validate_param['response']['name'];
            $lang_code      = $data_output_validate_param['response']['lang_code'];
            $description    = $data_output_validate_param['response']['description'];
            $updated_at     = $data_output_validate_param['response']['created_at'];

            $data = [

                'name'          =>  $name,
                'lang_code'     =>  $lang_code,
                'description'   =>  $description,
                'updated_at'    =>  $updated_at,

            ];
            $tmp = [
                'fields'    => 'id',
                'operator'  => '=',
                'value'     => $id
            ];

            array_push($where, $tmp);

            $ModelNewsCategories =  new ModelNewsCategories();
            $data = $ModelNewsCategories->updateData($data,$where);

            if($data['meta']['success']){

                $data_output_validate_param['meta']['msg']['update'] = Lang::get('message.web.success.0001');

            }else{

                $data_output_validate_param['meta']['msg']['update'] = Lang::get('message.web.error.0018');
            }
            

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

    public function deleteData($data_output_validate_param){

        if($data_output_validate_param['meta']['success']){

            $id             =   $data_output_validate_param['response']['id'];
            $deleted_at     =   $data_output_validate_param['response']['created_at'];

            $ModelNewsCategories        =   new ModelNewsCategories();
            $ModelNews                  =   new ModelNews();

            $where = [
                [
                    'fields'    =>  'id',
                    'operator'  =>  '=',
                    'value'     =>  $id
                ]
            ];

            $where_sub_news     =   [

                [

                    'fields'    =>  'category_id',
                    'operator'  =>  '=',
                    'value'     =>  $id,
                ]

            ];




            $data = [   

                'deleted_at'    =>  $deleted_at

            ];


            $data_sub   =   $ModelNews->updateData('news',$data,$where_sub_news);

            if($data_sub['meta']['success']){

                $result = $ModelNewsCategories->updateData($data,$where);

                if($result['meta']['success']){

                    $data_output_validate_param['meta']['msg']['delete'] = Lang::get('message.web.success.0004');

                }else{

                    $data_output_validate_param['meta']['msg']['delete'] = Lang::get('message.web.error.0019');

                }

            }else{

                $data_output_validate_param['meta']['msg']['delete'] = Lang::get('message.web.error.0019');

            }    
            
            
        }
        Session::flash('message', $data_output_validate_param['meta']['msg']);
        return $data_output_validate_param;

    }

}
?>