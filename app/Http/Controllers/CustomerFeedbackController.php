<?php
namespace App\Http\Controllers;

// use Spr\Base\Models\Media as Image;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Models\CustomerFeedBack as ModelCustomerFeedBack;
use Spr\Base\Controllers\Helper as HelperController;
use Intervention\Image\Exception\NotReadableException;
use Spr\Base\Response\Response;
use Input;
use Config;
use Auth;
use Lang;
use Session;

class CustomerFeedbackController  extends Controller
{

	public function insertFeedback($data_output_validate_param){

		if($data_output_validate_param['meta']['success']){

			$customer_name 	=	$data_output_validate_param['response']['name'];
			$email 			=	$data_output_validate_param['response']['email'];
			$description 	=	$data_output_validate_param['response']['description'];
			$phone_number 	=	$data_output_validate_param['response']['phone_number'];
			$created_at 	=	$data_output_validate_param['response']['created_at'];

			$ModelCustomerFeedback 	=	new 	ModelCustomerFeedback();

			$data 	=	[

				'customer_name'	=>	$customer_name,
				'email'			=>	$email,
				'description'	=>	$description,
				'created_at'    => 	$created_at,
				'phone_number'  =>  $phone_number

			];

			$data_insert 	=	$ModelCustomerFeedback->insertData($data);
			if($data_insert['meta']['success']){

				$data_output_validate_param['meta']['success'] 	=	true;

				Session::flash('msg','success');

			}else{

				Session::flash('msg','false');

			}
		}

		return $data_output_validate_param;

	}

	public function getFeedbackPending() {

		$return = Response::response();
		$ModelCustomerFeedBack      =   new ModelCustomerFeedBack();

        $return['response']['data'] =   $ModelCustomerFeedBack->getPending()['response'];

        return $return;
	}

	public function updateVerify($data_output_validate_param){

		if($data_output_validate_param['meta']['success']){

			$id 			=	$data_output_validate_param['response']['id'];
			$updated_at 	=	$data_output_validate_param['response']['created_at'];
			$data 	=	[

					'verify' 		=> 1,
					// 'updated_at'	=> $updated_at,
			];

			$where 	=	[

				[
	                'fields' => 'id',
	                'operator' => '=',
	                'value' => $id,
        		]
			];

			$ModelCustomerFeedback  	=	new 	ModelCustomerFeedback();

			if($ModelCustomerFeedback->checkVerified($id)['response']->total == 0){

				$data_update 	=	$ModelCustomerFeedback->updateData($data,$where);

				if($data_update['meta']['success'] == false){

					$data_output_validate_param['meta']['success']  = false;
				}

			}else{

				$data 	=	[

						'verify' 		=> 0,
						'updated_at'	=> $updated_at,
				];

				$data_update 	=	$ModelCustomerFeedback->updateData($data,$where);

				if($data_update['meta']['success'] == false){

					$data_output_validate_param['meta']['success']  = false;
				}

			}

		}
		$data_output_validate_param['response']['verify'] = $data['verify'];
		return $data_output_validate_param;
	}

	public function updateStatus($data_output_validate_param){

		if($data_output_validate_param['meta']['success']){
			$id 			=	$data_output_validate_param['response']['id'];
			$updated_at 	=	$data_output_validate_param['response']['created_at'];
			$ModelCustomerFeedback  	=	new 	ModelCustomerFeedback();

			if($ModelCustomerFeedback->checkStatus($id)['response']->total == 0){

				$data 	=	[

						'status' 		=> 1,
						// 'updated_at'	=> $updated_at,
				];

				$where 	=	[

					[
		                'fields' => 'id',
		                'operator' => '=',
		                'value' => $id,
            		]
				];

				$data_update 	=	$ModelCustomerFeedback->updateData($data,$where);

				if($data_update['meta']['success'] == false){

					$data_output_validate_param['meta']['success']  = false;
				}

			}else{

				$data_output_validate_param['meta']['success']  = false;
			}

		}

		return $data_output_validate_param;
	}

	public function getFeedBack($data_output_validate_param){

		if($data_output_validate_param['meta']['success']){

			$key_search    	= $data_output_validate_param['response']['key_search'];
        	$sort           = $data_output_validate_param['response']['sort'];
        	$limit          = $data_output_validate_param['response']['limit'];
        	$sort_type      = $data_output_validate_param['response']['sort_type'];

            $ModelCustomerFeedback 	=	new 	ModelCustomerFeedback();

            $data = $ModelCustomerFeedback->getDataForUser($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response']['data'] = array();
        }

		return $data_output_validate_param;

	}


	public function deleteData($data_output_validate_param){

		if($data_output_validate_param['meta']['success']){

			$id 			=	$data_output_validate_param['response']['id'];
			$deleted_at 	=	$data_output_validate_param['response']['created_at'];

			$ModelCustomerFeedback  	=	new 	ModelCustomerFeedback();

			$data 	=	[

					'deleted_at'	=> $deleted_at,
			];

			$where 	=	[

				[
	                'fields' => 'id',
	                'operator' => '=',
	                'value' => $id,
        		]
			];

			$data_update 	=	$ModelCustomerFeedback->updateData($data,$where);

			if($data_update['meta']['success'] == false){

				$data_output_validate_param['meta']['success']  = false;
			}

		}

		return $data_output_validate_param;

	}

	public function updateComment($data_output_validate_param){

		if($data_output_validate_param['meta']['success']){

			$id 		=	$data_output_validate_param['response']['id'];
			$comment 	=	$data_output_validate_param['response']['comment'];
			$updated_at	=	$data_output_validate_param['response']['created_at'];
			$status		=	$data_output_validate_param['response']['status'];

			$ModelCustomerFeedback  	=	new 	ModelCustomerFeedback();

			$data 	=	[

					'comment'		=> $comment,
					'updated_at' 	=> $updated_at,
					'status' 		=> $status,
			];

			$where 	=	[

				[
	                'fields' => 'id',
	                'operator' => '=',
	                'value' => $id,
        		]
			];

			$data_update 	=	$ModelCustomerFeedback->updateData($data,$where);

			if($data_update['meta']['success'] == false){

				$data_output_validate_param['meta']['success']  = false;
			}

		}

		return $data_output_validate_param;

	}

	public function getData($data_output_validate_param){

		if($data_output_validate_param['meta']['success']){

			$key_search    	= $data_output_validate_param['response']['key_search'];
        	$sort           = $data_output_validate_param['response']['sort'];
        	$limit          = $data_output_validate_param['response']['limit'];
        	$sort_type      = $data_output_validate_param['response']['sort_type'];

            $ModelCustomerFeedback 	=	new 	ModelCustomerFeedback();

            $data = $ModelCustomerFeedback->getData($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response']['data'] = array();
        }
		return $data_output_validate_param;
	}
}