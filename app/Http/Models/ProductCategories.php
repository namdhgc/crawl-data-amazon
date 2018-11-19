<?php
namespace App\Http\Models;

use DB;
use Spr\Base\Models\Helper;
use Illuminate\Database\Eloquent\Model;
use Spr\Base\Response\Response;
use lang;
use Config;
use Cache;
/**
*
*/
class ProductCategories extends Model
{

    protected $table = "product_categories";

    public  function insertData( $data) {
        $results = Helper::insert($this->table, $data);
        return $results;
    }

    public function updateData($data,$where = array()){
        $results =  Helper::update_db($this->table,$data,$where);
        return $results;
    }

    public function updateCategoriesId(){
        $results = Response::response();
        try{
            $sql =   "UPDATE product_categories as c "
                    ."INNER JOIN product_categories as p "
                    ."ON p.name = c.parent_name "
                    ."SET c.parent_id = p.id "
                    ."where c.id >0 AND p.level = ( c.level - 1 ) ";
            $query  =   DB::update($sql);

        }catch(Exception $e){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 503;
            $results['meta']['msg'] = Lang::get('message.web.error.0006');          
        }
        return $results;
    }
    public function getDataManage ($key_search = '', $limit = null, $sort = null, $sort_type = null) {


        $Response = new Response();
        $results =  $Response->response();
        try {
            $query = DB::table('product_categories as pc')
                                ->select(   
                                            'pc.id',
                                            'pc.amazon_id',
                                            'pc.name',
                                            'pc.title',
                                            'pc.parent_id',
                                            'pc.parent_name',
                                            'pc.level',
                                            DB::Raw('

                                                i.path as icon,
                                                bg.path as background_image

                                            ')
                                        )
                                ->leftJoin('media as i', 'i.id', '=', 'pc.icon')
                                ->leftJoin('media as bg', 'bg.id', '=', 'pc.background_image');

            $query = $query->whereRaw('
                ( pc.name like "%'.$key_search.'%" 
                    
                    OR 
                    pc.title like "%'.$key_search.'%" 

                    OR 
                    pc.amazon_id like "%'.$key_search.'%" 
                )
            ');
            if($sort != '' && $sort != null ) {
                
                $query = $query->orderBy($sort, $sort_type);              
            }

            if($limit != null) {
                
                $results['response'] = $query->paginate($limit);
            }else {
                $results['response'] = $query->get();
            }

        }catch(Exception $e){
            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = Lang::get('message.web.error.0006');
        }

        return $results;
    }


    public function deleteAllData(){
        $results = Response::response();
        DB::table($this->table)->truncate();
        $results['meta']['success'] = true;
        return $results;
    }


    public function get_product_id($link){
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
  

    public function getProductCategoriesForCache() {


        $results = $this->getDataManage();

        $data_Categories = $this->getDataCategoriesForMenu($results['response']);
        Cache::forever('product_categories', $data_Categories);
    }

    public function getDataCategoriesForMenu($data, $id = null) {

        $array_categories = [];
        $lengthData = COUNT($data);

        for($i = 0; $i < $lengthData ; $i++) {

            if($id == null) {

                if($data[$i]->parent_id == 0 || $data[$i]->parent_id == null) {

                    array_push($array_categories, $this->dataCategoryRecursive($data, $data[$i]));
                }
            }else {
                if($data[$i]->parent_id == $id) {

                    array_push($array_categories, $this->dataCategoryRecursive($data, $data[$i]));
                }

            }
        }

        return $array_categories;
    }

    public function dataCategoryRecursive($data, $item) {

        $category = [
            'id' => $item->id,
            'name' => $item->name,
            'title' => $item->title,
            'amazon_id' => $item->amazon_id,
            'parent_id' => $item->parent_id,
            'icon'      => $item->icon,
            'background_image'      => $item->background_image,
            'child'     => $this->getDataCategoriesForMenu($data, $item->id )   
        ];
        return $category;
    }

}