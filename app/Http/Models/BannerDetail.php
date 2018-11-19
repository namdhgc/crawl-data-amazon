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
class BannerDetail extends Model
{

    protected $table = "banner_detail";

    public  function insertData( $data) {
        $results = Helper::insert($this->table, $data);
        return $results;
    }

    public function updateData($data,$where = array()){
        $results =  Helper::update_db($this->table,$data,$where);
        return $results;
    }

    public function getTotalSize($banner_id){

        $results = Response::response();

        try{

            $query  =   DB::table($this->table)
                        ->select(DB::raw('sum(size) as total'))
                        ->where('banner_id', '=', $banner_id)
                        ->whereNull('deleted_at')
                        ->first();

            $results['response']    =   $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }
        return $results;

    }

    public function checkSizeLarge($banner_id){

        $results = Response::response();

        try{

            $query  =   DB::table($this->table)
                        ->select(DB::raw('count(id) as total'))
                        ->where('banner_id','=',$banner_id)
                        ->where('size',2)
                        ->whereNull('deleted_at')
                        ->first();

            $results['response'] = $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;

    }

    

    public function getSizeById($id){

        $results = Response::response();

        try{

            $query  =   DB::table($this->table)
                        ->select('size')
                        ->where('id','=',$id)
                        ->first();

            $results['response'] = $query;

        }catch(Exception $ex){
            $results['meta']['success'] = false;
            $results['meta']['code']    =  500;
        }

        return $results;

    }

    public function getData($where, $limit = null, $offset = null, $selectType = null, $fields = null, $order = null){

        $results    =   Response::response();

        try{

            $query    =   DB::table('banner_detail as b')
                            ->select(
                                        'b.id',
                                        'b.link',
                                        'b.mod_link',
                                        'b.size',
                                        'b.media_id',
                                        'm.path'
                                    )
                            ->join('media as m','m.id','=','b.media_id');

            foreach ($where as $key => $value) {

                switch ($value['operator']) {
                    case 'in':
                        $query = $query->whereIn($value['fields'], $value['value']);
                        break;
                    case 'null':
                        $query = $query->whereNull($value['fields']);
                        break;
                    default:
                        $query = $query->where($value['fields'], $value['operator'], $value['value']);
                        break;
                }
            }

            if(!is_null($limit)  && !is_null($offset) && $selectType != Config::get('spr.system.type.query.paginate')){
                $query = $query->take($limit)->skip($offset);
            }
            if($order !== null) {

                foreach ($order as $key => $value) {

                    if($value['fields'] != ''){
                        $query = $query->orderBy($value['fields'],$value['operator']);
                    }
                }
            }

            switch ($selectType) {
                case Config::get('spr.system.type.query.count'):
                // DB::enableQueryLog();
                    $query = $query->count();
                    break;
                case Config::get('spr.system.type.query.max'):
                    $query = $query->max($fields);
                    break;
                case Config::get('spr.system.type.query.min'):
                    $query = $query->min($fields);
                    break;
                case Config::get('spr.system.type.query.paginate'):

                    $query = $query->paginate($limit);
                    break;
                default :
                    $query = $query->get();
                    break;
            }

            $results['response'] = $query;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();
        }
        return $results;

    }

    public function getDataByParentId($parent_id){

        $results = Response::response();

        try{

            $query = DB::table('banner_detail as b')->select(
                            'b.id',
                            'b.mod_link',
                            'b.size',
                            'm.path'
                    )
                    ->join('media as m','m.id','=','b.media_id')
                    ->where('b.banner_id',$parent_id)->whereNull('b.deleted_at')->get();

            $results['response'] = $query;

        }catch(Exception $ex){

            $results['meta']['success'] = false;
            $results['meta']['code'] = 500;
            $results['meta']['msg'] = $e->getMessage();
        }

        return $results;

    }

}