<?php

namespace App\Http\Controllers;

use Auth;
use Lang;
use Input;
use Config;
use App\Http\Models\FavoriteProduct as ModelFavoriteProduct;
use Spr\Base\Response\Response;


/**
*
*/
class FavoriteProductController extends Controller
{

	protected $table = "favorite_product";

	function __construct()
	{
		# code...
	}

	public function getData($data_output_validate_param) {

        $sort           = $data_output_validate_param['response']['sort'];
        $limit          = $data_output_validate_param['response']['limit'];
        $sort_type      = $data_output_validate_param['response']['sort_type'];
        $key_search     = $data_output_validate_param['response']['key_search'];

        if($data_output_validate_param['meta']['success']) {

            $ModelFavoriteProduct = new ModelFavoriteProduct();

            $data = $ModelFavoriteProduct->getDataManage($key_search, $limit, $sort, $sort_type);

            $data_output_validate_param['response']['data'] = $data;
        }else {

            $data_output_validate_param['response']['data'] = array();
        }

        return $data_output_validate_param['response'];
    }

	public function insertData($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

        	if (!(Auth::guard('customer')->user())) {

        		// user not login yet
        		// $data_output_validate_param['meta']['success'] 	= false;
        		// $data_output_validate_param['meta']['code'] 	= 400;
        		$data_output_validate_param['meta']['msg'] 		= [Lang::get('message.web.error.0020')];
        	} else {

	            $ModelFavoriteProduct 	= new ModelFavoriteProduct();
        		$customer_id 			= Auth::guard('customer')->user()->id;
        		$product_code 			= $data_output_validate_param['response']['product_code'];
	            $product_name  			= $data_output_validate_param['response']['product_name'];
	            $product_image 			= $data_output_validate_param['response']['product_image'];

	            $check = $ModelFavoriteProduct->checkExistsRecord($customer_id, $product_code);

	            if ($check['response'] != null) {

	            	// product has been exists in favorite list
		         	// $data_output_validate_param['meta']['success'] 	= false;
	        		// $data_output_validate_param['meta']['code'] 	= 401;
	        		$data_output_validate_param['meta']['msg'] 		= [Lang::get('message.web.error.0021')];

	            } else {

	            	$where = [];

		            $data = [
		                'customer_id' 		=> $customer_id,
		                'product_code' 		=> $product_code,
		                'product_name'  	=> $product_name,
		                'product_image' 	=> $product_image,
		                'created_at'		=> strtotime(\Carbon\Carbon::now()->toDateTimeString())
		            ];

		            $result = $ModelFavoriteProduct->insertData($this->table, $data, $where);
	        		$data_output_validate_param['meta']['msg'] 		= [Lang::get('message.web.success.0005')];
	            }
        	}
        } else {

            $data_output_validate_param['response'] = array();
            $data_output_validate_param['response']['data'] = $data_output_validate_param;
        }

        return $data_output_validate_param;
    }

    public function deleteData($data_output_validate_param) {

        if($data_output_validate_param['meta']['success']) {

        	$id 					= $data_output_validate_param['response']['id'];
	    	$customer_id 			= $data_output_validate_param['response']['customer_id'];
	    	$product_code 			= $data_output_validate_param['response']['product_code'];
            $ModelFavoriteProduct 	= new ModelFavoriteProduct();

            $check = $ModelFavoriteProduct->checkExistsRecord($customer_id, $product_code);

            if ($check['response'] != null) {
	            
	            // product exists in favorite list

            	$data = [
            		'deleted_at'	=> strtotime(\Carbon\Carbon::now()->toDateTimeString())
            	];

            	$where = [
            		[
		        		'fields'    =>  'customer_id',
		                'operator'  =>  '=',
		                'value'     =>  $customer_id
		        	],
		        	[
		        		'fields'    =>  'product_code',
		                'operator'  =>  '=',
		                'value'     =>  $product_code
		        	]
            	];

		     	$result = $ModelFavoriteProduct->updateData($this->table, $data, $where);

	        	$data_output_validate_param['meta']['msg'] 		= ['alert' => Lang::get('message.web.success.0003')];
	        	$data_output_validate_param['response']['data'] = $result;

            } else {

            	// product not exists
	        	$data_output_validate_param['meta']['msg'] 		= ['alert' => Lang::get('message.web.error.0011')];
            }
    	}

        return $data_output_validate_param;
    }
}