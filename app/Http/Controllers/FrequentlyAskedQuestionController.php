<?php

namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\FrequentlyAskedQuestion as ModelFrequentlyAskedQuestion;
use Hash;
use Input;
use Image;
use Config;
use File;
use Auth;
use Lang;
use Session;

class FrequentlyAskedQuestionController extends Controller
{

    protected $table = "frequently_asked_question";

    public function __construct()
    {

    }



    public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {

            $ModelFrequentlyAskedQuestion = new ModelFrequentlyAskedQuestion();

            $data = $ModelFrequentlyAskedQuestion->getDataManage($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response']['data'] = array();
        }

        return $data_output_validate_param['response'];
    }

    public function insertOrUpdate($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']){

            $id         =   $data_output_validate_param['response']['id'];
            $question   =   $data_output_validate_param['response']['question'];
            $answer     =   $data_output_validate_param['response']['answer'];
            $where      = [];

            $ModelFrequentlyAskedQuestion = new ModelFrequentlyAskedQuestion();

            if($id != null && $id != ""){

                $where  =   [
                    [
                        'fields'    => 'id',
                        'operator'  => '=',
                        'value'     => $id
                    ]
                ];

                $data   =   [
                    'question'      => $question,
                    'answer'        => $answer,
                    'updated_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString())
                ];

                $data_output_validate_param = $ModelFrequentlyAskedQuestion->updateData($this->table, $data,$where);

            }else{

                $data   =   [
                    'question'      => $question,
                    'answer'        => $answer,
                    'created_at'    => strtotime(\Carbon\Carbon::now()->toDateTimeString())
                ];

                $data_output_validate_param = $ModelFrequentlyAskedQuestion->insertData($this->table, $data,$where);
            }
            Session::flash('message','');

        }else{

            Session::flash('message', $data_output_validate_param['meta']['msg']);
        }

        return $data_output_validate_param;
    }

    public function deleteData($data_output_validate_param){

        $id =   $data_output_validate_param['response']['id'];

        $ModelFrequentlyAskedQuestion            =   new ModelFrequentlyAskedQuestion();

        if($data_output_validate_param['meta']['success']){

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

            $data_output_validate_param = $ModelFrequentlyAskedQuestion->updateData($this->table, $data,$where);

        }

        return $data_output_validate_param;
    }


}