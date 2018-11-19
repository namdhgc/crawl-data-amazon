<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group(['prefix' => 'v1'], function () {

	Route::group(['as' => 'get-'], function () {

	});

	Route::group(['as' => 'post-'], function () {

		Route::post('get-data-city',  ['as' => 'get-data-city', function() {


				$result = App::make('App\Http\Controllers\CityController')->getDataApi();

				return response()->json($result);
		}]);

		Route::post('get-data-district',  ['as' => 'get-data-district', function() {

				$config                     = Config::get('spr.param.api.getDataDistrict');
	            $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
	            $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$result 					= App::make('App\Http\Controllers\DistrictController')->getDataByCityID($data_output_validate_param);

				return response()->json($result);
		}]);

		Route::post('get-data-ward',  ['as' => 'get-data-ward', function() {

				$config                     = Config::get('spr.param.api.getDataWard');
	            $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
	            $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$result 					= App::make('App\Http\Controllers\WardController')->getDataByDistrictID($data_output_validate_param);

				return response()->json($result);
		}]);
	});
});