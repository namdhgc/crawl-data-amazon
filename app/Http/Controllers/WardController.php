<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Http\Models\Ward as ModelWard;
use Config;
use Mail;
use Lang;

use Input;
class WardController extends Controller
{
	public function insertData(){



		$data_insert = Input::All()['data'];

		$ModelWard 	=	new ModelWard();

		$result 	=	$ModelWard->insertData($data_insert);

		return $result;


		if($data_output_validate_param['meta']['success']){

			$code 			=	$data_output_validate_param['response']['code'];
			$district_id 	=	$data_output_validate_param['response']['district_id'];
			$name 			=	$data_output_validate_param['response']['name'];
			$home_payment 	=	$data_output_validate_param['response']['home_payment'];
			$free_shipping 	=	$data_output_validate_param['response']['free_shipping'];
			$focus 			=	$data_output_validate_param['response']['focus'];
			$rural 			=	$data_output_validate_param['response']['rural'];
			$created_at 	=	$data_output_validate_param['response']['created_at'];

			$data 			=	[

				'code'			=>	$code,
				'district_id'   =>  $district_id,
				'name'			=>	$name,
				'home_payment'	=>	$home_payment,
				'free_shipping'	=>	$free_shipping,
				'focus'			=>	$focus,
				'rural'			=>	$rural,
				'created_at'	=>	$created_at,
			];

			$ModelWard 			=	new ModelWard();

			$result 			=	$ModelWard->insertData($data);

			if($result['meta']['success']){

				$data_output_validate_param['id']				=	$result['response'];
				$data_output_validate_param['meta']['msg']		=	[Lang::get('message.web.success.0002')];

			}else{

				$data_output_validate_param['meta']['success']	=	false;
				$data_output_validate_param['meta']['msg']		=	[Lang::get('message.web.error.0017')];
			}
		}

		return $data_output_validate_param;
	}

	public function updateData($data_output_validate_param){

		if($data_output_validate_param['meta']['success']){

			$id 			=	$data_output_validate_param['response']['id'];
			$code 			=	$data_output_validate_param['response']['code'];
			$name 			=	$data_output_validate_param['response']['name'];
			$home_payment 	=	$data_output_validate_param['response']['home_payment'];
			$free_shipping 	=	$data_output_validate_param['response']['free_shipping'];
			$focus 			=	$data_output_validate_param['response']['focus'];
			$rural 			=	$data_output_validate_param['response']['rural'];
			$updated_at 	=	$data_output_validate_param['response']['created_at'];

			$data 			=	[

				'code'			=>	$code,
				'name'			=>	$name,
				'home_payment'	=>	$home_payment,
				'free_shipping'	=>	$free_shipping,
				'focus'			=>	$focus,
				'rural'			=>	$rural,
				'created_at'	=>	$created_at,
			];

			$where 			=	[

				[
					'fields'    => 'id',
                    'operator'  => '=',
                    'value'     => $id

				]

			];

			$ModelWard 			=	new ModelWard();

			$result 			=	$ModelWard->udpateData($data,$where);

			if($result['meta']['success']){

				$data_output_validate_param['id']				=	$result['response'];
				$data_output_validate_param['meta']['msg']		=	[Lang::get('message.web.success.0001')];

			}else{

				$data_output_validate_param['meta']['success']	=	false;
				$data_output_validate_param['meta']['msg']		=	[Lang::get('message.web.error.0018')];
			}
		}

		return $data_output_validate_param;

	}

	public function getData($data_output_validate_param){

        if($data_output_validate_param['meta']['success']) {
	        $sort           = $data_output_validate_param['response']['sort'];
	        $limit          = $data_output_validate_param['response']['limit'];
	        $sort_type      = $data_output_validate_param['response']['sort_type'];
	        $key_search     = $data_output_validate_param['response']['key_search'];

            $ModelWard 		= new ModelWard();

            $data 			= $ModelWard->getData($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response'] = $data;
        }else {

            $data_output_validate_param['response'] = array();
        }

        return $data_output_validate_param;
    }

    public function getDataByDistrictID($data_output_validate_param){

    	if($data_output_validate_param['meta']['success']){

    		$district_id        = 	$data_output_validate_param['response']['district_id'];
    		$ModelWard 			=	new ModelWard();
    		$data 				=	$ModelWard->getWardByDistrictID($district_id);

    		$data_output_validate_param = $data;
    	}

    	return $data_output_validate_param;
    }
}