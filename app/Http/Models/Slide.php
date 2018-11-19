<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Spr\Base\Response\Response;
use Spr\Base\Models\Helper;
use Config;
use DB;

/**
*
*/
class Slide extends Model
{

	protected $table = "slide";

	public static function insertData($table, $data, $where) {

		$results = Helper::insertGetId($table, $data, $where);

		return $results;
	}

	public static function selectData($table, $where, $limit = null, $offset = null, $selectType = null, $fields = null, $order = null) {

		$results = Helper::select($table, $where, $limit, $offset, $selectType, $fields, $order);

		return $results;
	}

	public static function updateData($table, $data, $where) {

		$results = Helper::update_db($table, $data, $where);

		return $results;
	}

	public function getDataManage ($key_search, $limit, $sort, $sort_type) {

        $where = [
            [
                'operator' => 'raw',
                'sql' =>  "(
                    title like '%".$key_search."%'

                    OR

                    description like '%".$key_search."%'

                )"
            ],
            [
                'fields'    =>  'deleted_at',
                'operator'  =>  'null',
                'value'     =>  'NULL'
            ]
        ];

        $order = [
            [
                'fields' => $sort,
                'operator'  => $sort_type
            ]
        ];
        $results = Helper::select($this->table, $where , $limit, null, Config::get('spr.system.type.query.paginate'), null, $order );
        return $results;
    }

    public function getImageInformation($id) {

        $results = null;

        try {

            $data = DB::table('slide_detail as s')
                ->join('media as m', 's.image_id', '=', 'm.id')
                ->select('s.id', 's.title', 's.link', 's.title', 's.link', 's.status', 'm.path', 'm.tmp_path')
                ->where('s.id', '=', $id)
                ->get();

                $results['response'] = $data[0];

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg'] = $e->getMessage();
        }

        return $results;
    }

    public function checkExistsRecord($id) {

        try {

            $results['response'] = DB::table('slide')->where('id', '=', $id)->first();;

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg']     = $e->getMessage();
        }

        return $results;
    }

    public function getFirstRecord() {

        try {

            $results['response'] = DB::table('slide')->where('status', '=', '1')->first();

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg']     = $e->getMessage();
        }

        return $results;
    }

    public function selectMainSlide() {

        try {

            $results['response'] = DB::table('slide as s')
                                        ->join('slide_detail as sd', 'sd.slide_id', '=', 's.id')
                                        ->join('media as m', 'sd.image_id', '=', 'm.id')
                                        ->select(
                                                's.id as slide_id',
                                                's.status',
                                                's.lang_code',
                                                'sd.id as slide_detail_id',
                                                'sd.slide_id',
                                                'sd.image_id',
                                                'sd.title',
                                                'sd.link',
                                                'm.id as media_id',
                                                'm.path',
                                                'm.tmp_path',
                                                'm.description'
                                            )
                                        ->where('s.status', '=', '1')
                                        ->whereNull('sd.deleted_at')
                                        ->whereNull('s.banner_id')
                                        ->get();

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg'] = $e->getMessage();
        }

        return $results;
    }

    public function getImageSlideByBanner($banner_id) {

        $results = Response::response();

        try {

            $data = DB::table('slide_detail as sd')
                ->join('slide as s', 's.id', '=', 'sd.slide_id')
                ->join('media as m', 'sd.image_id', '=', 'm.id')
                ->select('s.id as slide_id', 
                        's.title', 
                        's.description', 
                        's.lang_code', 
                        's.banner_id', 
                        'sd.id as slide_detail_id', 
                        'sd.slide_id', 
                        'sd.title', 
                        'sd.link', 
                        'm.path', 
                        'm.tmp_path'
                        )
                ->where('s.banner_id', '=', $banner_id)
                ->where('s.status','=',1)
                ->get();

                $results['response'] = $data;

        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg'] = $e->getMessage();
        }

        return $results;
    }

    public function checkIsmain($id){

        $results = Response::response();

        try {

            $data = DB::table($this->table)
                    ->select('banner_id')
                    ->where('id','=',$id)
                    ->first();

                 
            $results['response'] = $data;
        } catch (PDOException $e) {

            $results['meta']['success'] = false;
            $results['meta']['msg'] = $e->getMessage();
        }
        return $results;
    }

    public function checkIsStatus($id){

        $results = Response::response();

        try {

            $data = DB::table($this->table)
                    ->select('status')
                    ->where('id','=',$id)
                    ->first();

                $results['response'] = $data;

        } catch (PDOException $e) {
            
            $results['meta']['success'] = false;
            $results['meta']['msg'] = $e->getMessage();
        }

        return $results;
    }


    public function statusMain(){

        $results = Response::response();

        try {

            $data = DB::table($this->table)
                    ->select(DB::raw('count(id) as total'))
                    ->whereNull('banner_id')
                    ->where('status','=',1)
                    ->first();

                $results['response'] = $data;

        } catch (PDOException $e) {
            
            $results['meta']['success'] = false;
            $results['meta']['msg'] = $e->getMessage();
        }

        return $results;
    }

    public function statusBannerGroupByBannerID($banner_id){

        $results = Response::response();

        try {

            $data = DB::table($this->table)
                    ->select(DB::raw('count(id) as total'))
                    ->where('banner_id','=',$banner_id)
                    ->where('status','=',1)
                    ->first();

                $results['response'] = $data;

        } catch (PDOException $e) {
            
            $results['meta']['success'] = false;
            $results['meta']['msg'] = $e->getMessage();
        }

        return $results;
    }


}