<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

|
*/

use Illuminate\Http\Request;
use Spr\Base\Response\Response;
use Spr\Base\Controllers\Helper as HelperController;

Route::get('maintenance',['as' => 'maintenance', function(){

	if(Config::get('spr.system.maintenance.system')){

		return view('maintenance.maintenance');

	}else {

		return Redirect::route('auth-get-dashboard');
	}
}]);

Route::group(['middleware' => 'maintenance'], function () {

	Route::group(['prefix' => 'manager'], function () {

		Route::group(['middleware' => 'auth:web', 'as' => 'auth-'], function () {

			Route::group(['as' => 'get-'], function () {

				Route::get('/dashboard',  ['as' => 'dashboard', function() {

						$config                     = Config::get('spr.param.manage.transaction.transaction_pending');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);

						$result_transaction_pending 	= 	App::make('App\Http\Controllers\TransactionController')
															->getTransactionPending($data_output_validate_param);

						$config                     = Config::get('spr.param.manage.price_request.price_request_pending');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);

						$result_request_pending 	= 	App::make('App\Http\Controllers\PriceRequestController')
															->getPriceRequestPending($data_output_validate_param);
						$result_feedBack_pending    =   App::make('App\Http\Controllers\CustomerFeedbackController')
															->getFeedbackPending();
						$total_user    				=   App::make('App\Http\Controllers\CustomerController')
															->getTotalUser();
						return view('pages.admin.index')->with('pending',$result_transaction_pending['response'])
														->with('request_pending',$result_request_pending['response'])
														->with('feedBack_pending', $result_feedBack_pending['response'])
														->with('total_user', $total_user['response']);
				}]);

				Route::get('/new-agency',  ['as' => 'new-agency', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-agency');
					if($permission){

						return view('pages.admin.new_agency');
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/agency-management',  ['as' => 'agency-management', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-agency');
					if($permission){

						$config 					= Config::get('spr.param.manage.agency.agencyManagement');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\AgencyController')->getData($data_output_validate_param);

						return view('pages.admin.agency_management')->with('data', $results);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/warehouse-management',  ['as' => 'warehouse-management', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-warehouse');
					if($permission){

						$config 					= Config::get('spr.param.manage.warehouse.warehouseManagement');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\WarehouseController')->getData($data_output_validate_param);

						$config_agency 						= Config::get('spr.param.manage.agency.agencyManagement');
						$data_output_get_param_agency 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config_agency);
						$data_output_validate_param_agency	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param_agency);
						$agency 								= App::make('App\Http\Controllers\AgencyController')->getData($data_output_validate_param_agency);

						return view('pages.admin.warehouse_management')->with('data', $results)
																		->with('agency', $agency);
					}else {

						return view('errors.550');
					}
				}]);


				Route::get('/logout' , ['as' => 'logout', function () {

					Auth::guard('web')->logout();
				    return Redirect::route('web-get-homePage');
				}]);


				Route::get('/transaction',['as' =>'transaction',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-transaction');
					if($permission){

						$config = Config::get('spr.param.manage.transaction.transactions');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\TransactionController')->getData($data_output_validate_param);
						$res_status                 = App::make('App\Http\Controllers\TransactionStatusController')->getDataSelectBox();

						return view('pages.admin.transaction')->with('data',$results)->with('selectBox',$res_status);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/export-transaction',['as' =>'export-transaction',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-transaction');
					if($permission){

						$config = Config::get('spr.param.manage.transaction.transactions');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\TransactionController')->getDataExport($data_output_validate_param);

						$companyName = "Sumoshipping";
	                    $arrayTitle = Config::get('excel.manage.transaction-detail.arrayTitle');
	                    $fileName   = Config::get('excel.manage.transaction-detail.file-Name');
	                    $title 		= Config::get('excel.manage.transaction-detail.title');
	                    return App::make('Spr\Base\Controllers\Download\ExportExcel')->ExportToExcelAndDownload($results, $fileName, $companyName, $title, $arrayTitle);

					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/transaction-status',['as' => 'transaction-status',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-transaction');
					if($permission){

						$config = Config::get('spr.param.manage.transaction_status.transaction_status');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\TransactionStatusController')->getData($data_output_validate_param);

						return view('pages.admin.transaction_status')->with('data',$results);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/product-categories',['as' => 'product-categories',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'product-categories');
					if($permission){

						$config = Config::get('spr.param.manage.product_categories.product_categories');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\ProductCategoriesController')->getData($data_output_validate_param);

						return view('pages.admin.product_categories')->with('data',$results);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/transaction-detail',['as' => 'transaction-detail',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-transaction');
					if($permission){

						$config = Config::get('spr.param.manage.transaction.transactionDetail');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);

						if($data_output_validate_param['meta']['success']==false){

							return redirect()->route('auth-get-transaction');

						}else{

							$results	= App::make('App\Http\Controllers\TransactionDetailController')->getData($data_output_validate_param);
							if($results['meta']['success'] == false){

								return redirect()->route('web-get-404');

							}else{

								return view('pages.admin.transaction-detail')->with('data',$results['response']);

							}
						}


					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/price-list',['as' => 'price-list',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-price');
					if($permission){

						$config = Config::get('spr.param.manage.price.price');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\PriceListController')->getData($data_output_validate_param);

						return view('pages.admin.price_list')->with('data',$results);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/news-categories',['as' => 'news-categories',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-categories');
					if($permission){

						$config = Config::get('spr.param.manage.news.categories.news_cate');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\NewsCategoriesController')->getData($data_output_validate_param);

						return view('pages.admin.news_categories')->with('data',$results);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/post-news',['as' => 'post-news',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-news');
					if($permission){

						$config = Config::get('spr.param.manage.news.categories.news_cate');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\NewsCategoriesController')->getData($data_output_validate_param);

						return view('pages.admin.post_news')->with('category', $results);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/news-management',['as' => 'news-management',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-news');
					if($permission){

						$config 					= Config::get('spr.param.manage.news.news');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\NewsController')->getData($data_output_validate_param);

						$config_category 						= Config::get('spr.param.manage.news.categories.news_cate');
						$data_output_get_param_category 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config_category);
						$data_output_validate_param_category	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param_category);
						$results_category						= App::make('App\Http\Controllers\NewsCategoriesController')->getData($data_output_validate_param_category);

						return view('pages.admin.news_management')->with('data', $results)
																	->with('category', $results_category);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/price-request-management',['as' => 'price-request-management',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-price-request');
					if($permission){

						$config 							= Config::get('spr.param.manage.price_request.price_request_management');
						$data_output_get_param 				= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param			= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results							= App::make('App\Http\Controllers\PriceRequestController')->getData($data_output_validate_param);

						$taken_config 						= Config::get('spr.param.manage.price_request.price_request_management');
						$taken_data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$taken_data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$taken_request						= App::make('App\Http\Controllers\PriceRequestController')->getTakenRequest($data_output_validate_param);

						return view('pages.admin.price_request_management')->with('data', $results)
																			->with('taken_request', $taken_request);
					}else {

						return view('errors.550');
					}
				}]);


				Route::get('/banner',['as' => 'banner',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-banner');
					if($permission){

						$config = Config::get('spr.param.manage.banner.banner');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\BannerController')->getData($data_output_validate_param);
						return view('pages.admin.banner')->with('data', $results['response']);
					}else {

						return view('errors.550');
					}
				}]);


				Route::get('/navigation',['as' => 'navigation',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-navigation');
					if($permission){

						$config = Config::get('spr.param.manage.navigation.navigation');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\NavigationController')->getData($data_output_validate_param);

						return view('pages.admin.navigation')->with('data', $results['response']);

					}else {

						return view('errors.550');
					}
				}]);

				Route::group(['as' => 'permission-'], function () {

					Route::get('roles/' , ['as' => 'roles', function () {

						$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-roles');
						if($permission){

							$config = Config::get('spr.param.manage.permission.roles');
							$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
							$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
							$results					= App::make('Spr\Base\Controllers\Permission\Roles')->getData($data_output_validate_param);

							return view('pages.admin.roles')->with('data', $results);
						}else {
							return view('errors.550');
						}
					}]);
				});

				Route::get('/email-notification',['as' => 'email-notification',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-email-notification');
					if($permission){

						$config = Config::get('spr.param.manage.email_notification.email_notification');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\EmailNotificationController')->getData($data_output_validate_param);

						return view('pages.admin.email_notification')->with('data', $results);
					}else {

						return view('errors.550');
					}
				}]);

				// Route::get('/slide',['as' => 'slide',function(){

				// 	if(Cache::get('permissionRoles')[Auth::user()->roles][Cache::get('module')['manager-slide']]['read'] == 1){

				// 		$config = Config::get('spr.param.manage.slide.slide');
				// 		$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				// 		$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				// 		$results					= App::make('App\Http\Controllers\SlideController')->getData($data_output_validate_param);

				// 		return view('pages.admin.add_slide')->with('data', $results);
				// 	}else {

				// 		return view('errors.550');
				// 	}
				// }]);

				Route::get('/banner-detail',['as' => 'banner-detail',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-banner');
					if($permission){

						$config = Config::get('spr.param.manage.banner.banner_detail');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);

						if($data_output_validate_param['meta']['success'] == false){

							return redirect()->route('auth-get-banner');

						}else{

							$results	= App::make('App\Http\Controllers\BannerDetailController')->getData($data_output_validate_param);

							if($results['meta']['success'] == false){

								return redirect()->route('web-get-404');

							}else{

								return view('pages.admin.banner_detail')->with('data',$results['response']);

							}

						}


					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/slide',['as' => 'slide',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-slide');
					if($permission){

						$config 					= Config::get('spr.param.manage.slide.slide');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\SlideController')->getData($data_output_validate_param);

						$config_banner 						= Config::get('spr.param.manage.banner.banner');
						$data_output_get_param_banner 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param_banner	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results_banner						= App::make('App\Http\Controllers\BannerController')->getData($data_output_validate_param);

						return view('pages.admin.slide')->with('data', $results['response'])
														->with('banner', $results_banner['response']['data']['response']);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/slide-detail',['as' => 'slide-detail',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-slide');
					if($permission){

						$config = Config::get('spr.param.manage.slide.slide_detail');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\SlideDetailController')->getData($data_output_validate_param);

						return view('pages.admin.slide_detail')->with('data',$results['response']);

					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/group-customer',['as' => 'group-customer',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-group-customer');
					if($permission){

						$config 									= Config::get('spr.param.manage.group_customer.group_customer');
						$data_output_get_param 						= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param					= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results									= App::make('App\Http\Controllers\GroupCustomerController')->getData($data_output_validate_param);

						$config_price_list 							= Config::get('spr.param.manage.price.price');
						$data_output_get_param_price_list 			= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config_price_list);
						$data_output_validate_param_price_list		= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param_price_list);
						$results_price_list							= App::make('App\Http\Controllers\PriceListController')->getData($data_output_validate_param_price_list);

						$config_payment_type 						= Config::get('spr.param.manage.payment_type.payment_type');
						$data_output_get_param_payment_type 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config_payment_type);
						$data_output_validate_param_payment_type 	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param_payment_type);
						$results_payment_type						= App::make('App\Http\Controllers\PaymentTypeController')->getData($data_output_validate_param_payment_type);

						return view('pages.admin.group_customer')->with('data',$results)
																	->with('price_list', $results_price_list)
																	->with('payment_type', $results_payment_type);

					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/surcharge-price-list',['as' => 'surcharge-price-list',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-price');
					if($permission){

						$config = Config::get('spr.param.manage.price.surcharge_price');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\PriceListSurchargeController')->getData($data_output_validate_param);

						return view('pages.admin.price_list_surcharge')->with('data',$results);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/happy-code',['as' => 'happy-code',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-happy-code');
					if($permission){

						$config = Config::get('spr.param.manage.happy_code.happy_code');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\HappyCodeController')->getData($data_output_validate_param);

						return view('pages.admin.happy_code')->with('data',$results);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/setting',['as' => 'setting',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-setting');
					if($permission){

						$results					= App::make('App\Http\Controllers\SettingController')->getAllData();

						$config_price_happy_code 						= Config::get('spr.param.manage.happy_code.price_happy_code');
						$data_output_get_param_price_happy_code 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config_price_happy_code);
						$data_output_validate_param_price_happy_code	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param_price_happy_code);
						$results_price_happy_code						= App::make('App\Http\Controllers\PriceHappyCodeController')->getData($data_output_validate_param_price_happy_code);

						$config 					= Config::get('spr.param.manage.support.support');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results_support 					= App::make('App\Http\Controllers\SupportController')->getData($data_output_validate_param);
						return view('pages.admin.setting')->with('data',$results['response'])
															->with('data_price_happy_code', $results_price_happy_code)->with('support',$results_support['response']);

					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/report-transaction',['as' => 'report-transaction',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-banner');
					if($permission){

						return view('pages.admin.report_transaction');
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/config-price',['as' => 'config-price',function(){

					// if(Cache::get('permissionRoles')[Auth::user()->roles][Cache::get('module')['manager-config-price']]['read'] == 1){

						return view('pages.admin.config_price');
					// }else {

					// 	return view('errors.550');
					// }
				}]);

				Route::get('/payment-type',['as' => 'payment-type',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-payment-type');
					if($permission){

						$config 					= Config::get('spr.param.manage.payment_type.payment_type');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\PaymentTypeController')->getData($data_output_validate_param);

						return view('pages.admin.payment_type')->with('data', $results);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/payment-type-detail',['as' => 'payment-type-detail',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-payment-type');
					if($permission){

						$config 					= Config::get('spr.param.manage.payment_type.payment_type_detail');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\PaymentTypeDetailController')->getData($data_output_validate_param);

						return view('pages.admin.payment_type_detail')->with('data', $results);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/frequently-asked-questions',['as' => 'frequently-asked-questions',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-frequently-asked-questions');
					if($permission){

						$config 					= Config::get('spr.param.manage.faq.frequently_asked_questions');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\FrequentlyAskedQuestionController')->getData($data_output_validate_param);

						return view('pages.admin.frequently_asked_questions')->with('data', $results);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/manager-customer',['as' => 'manager-customer',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-customer');
					if($permission){

						$config 									= Config::get('spr.param.manage.customer.manager_customer');
						$data_output_get_param 						= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param					= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results									= App::make('App\Http\Controllers\CustomerController')->getData($data_output_validate_param);

						$config_group_customer 						= Config::get('spr.param.manage.group_customer.group_customer');
						$data_output_get_param_group_customer 	 	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config_group_customer);
						$data_output_validate_param_group_customer 	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param_group_customer);
						$results_group_customer 					= App::make('App\Http\Controllers\GroupCustomerController')->getData($data_output_validate_param_group_customer);

						return view('pages.admin.manager_customer')->with('data', $results)
																	->with('group_customer', $results_group_customer);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/bank',['as' => 'bank',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-bank');
					if($permission){

						$config 									= Config::get('spr.param.manage.bank.bank');
						$data_output_get_param 						= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param					= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results									= App::make('App\Http\Controllers\BankController')->getData($data_output_validate_param);

						return view('pages.admin.bank_manager')->with('data', $results);
					}else {

						return view('errors.550');
					}
				}]);

				Route::get('/manager-admin',['as' => 'manager-admin',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-admin');
					if($permission){

						$config 							= Config::get('spr.param.manage.admin.manager_admin');
						$data_output_get_param 				= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param			= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results							= App::make('App\Http\Controllers\UserController')->getData($data_output_validate_param);

						$config_role 						= Config::get('spr.param.manage.roles.roles');
						$data_output_get_param_role 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config_role);
						$data_output_validate_param_role	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param_role);
						$results_role 						= App::make('App\Http\Controllers\RoleController')->getData($data_output_validate_param_role);

						return view('pages.admin.manager_admin')->with('data', $results)
																->with('data_role', $results_role);
					}else {

						return view('errors.550');
					}
				}]);


				Route::get('/manager-happy-code-order',['as' => 'manager-happy-code-order',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-happy-code');
					if($permission){


						$config 							= Config::get('spr.param.manage.happy_code.happy_code');
						$data_output_get_param 				= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param			= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results							= App::make('App\Http\Controllers\OrderHappyCodeController')->getDataManage($data_output_validate_param);

						return view('pages.admin.happy_code_order')->with('data', $results);

					}else {

						return view('errors.550');
					}
				}]);

				Route::get('feedback',['as' => 'feedback',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-feedback');
					if($permission){

						$config 							= Config::get('spr.param.manage.feedback.feedback');
						$data_output_get_param 				= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param			= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results							= App::make('App\Http\Controllers\CustomerFeedbackController')->getData($data_output_validate_param);

						return view('pages.admin.feedback')->with('data', $results['response']);

					}else {

						return view('errors.550');
					}
				}]);

				Route::get('report',['as' => 'report',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-report');
					if($permission){

						$config 							= Config::get('spr.param.manage.report.report');
						$data_output_get_param 				= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param			= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results							= App::make('App\Http\Controllers\ReportController')->getData($data_output_validate_param);

						return view('pages.admin.feedback')->with('data', $results['response']);

					}else {

						return view('errors.550');
					}
				}]);

				Route::get('change-password',['as' => 'change-password',function(){

					// if(Cache::get('permissionRoles')[Auth::user()->roles][Cache::get('module')['manager-report']]['write'] == 1){

						// $config 							= Config::get('spr.param.manage.report.report');
						// $data_output_get_param 				= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						// $data_output_validate_param			= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						// $results							= App::make('App\Http\Controllers\ReportController')->getData($data_output_validate_param);

						return view('pages.admin.change_password');

					// }else {

					// 	return view('errors.550');
					// }
				}]);
			});

			Route::group(['as' => 'post-'], function () {

				Route::post('/data-chart',  ['as' => 'data-chart', function() {


						$results_order = App::make('App\Http\Controllers\DashboardController')->getData();

						return response()->json($results_order);
				}]);

				Route::post('update-roles', ['as' => 'update-roles', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-roles', 'write');
					if($permission){

						$config = Config::get('spr.param.manage.permission.newRole');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\RoleController')->updateRole($data_output_validate_param);

						return redirect()->back();
					}else {

						return view('errors.550');
					}
				}]);

				Route::post('/add-agency',  ['as' => 'add-agency', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-agency', 'write');
					if($permission){

						$config 					= Config::get('spr.param.manage.agency.newAgency');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\AgencyController')->insertData($data_output_validate_param);

						return redirect()->back();
					}else {

						return view('errors.550');
					}
				}]);

				Route::post('/update-agency-management',  ['as' => 'update-agency-management', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-agency', 'write');
					if($permission){

						$config 					= Config::get('spr.param.manage.agency.newAgency');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\AgencyController')->updateData($data_output_validate_param);

						return redirect()->back();
					}else {

						return view('errors.550');
					}
				}]);

				Route::post('/delete-agency-management',  ['as' => 'delete-agency-management', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-agency', 'write');
					if($permission){

						$config 					= Config::get('spr.param.manage.agency.deleteAgency');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\AgencyController')->deleteData($data_output_validate_param);

						return redirect()->back();
					}else {

						return view('errors.550');
					}
				}]);


				Route::post('/transaction-manager',  ['as' => 'transaction-manager', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-transaction', 'write');
					if($permission){

						$config 					= Config::get('spr.param.manage.transaction.actionTransaction');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\TransactionController')->Update_Transaction($data_output_validate_param);

						if($results['meta']['success']){

							return Redirect::route('auth-get-transaction');

						}else {

							return Redirect::route('auth-get-transaction')->with('dataError', $results['meta']['msg']);
						}
					}else {

						return redirect()->route('web-get-404');
					}
				}]);

				Route::post('/update-warehouse-management',  ['as' => 'update-warehouse-management', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-warehouse', 'write');
					if($permission){

						$config 					= Config::get('spr.param.manage.warehouse.newWarehouse');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\WarehouseController')->updateData($data_output_validate_param);

						return redirect()->back();
					}else {

						return view('errors.550');
					}
				}]);

				Route::post('/transaction-status-manager',  ['as' => 'transaction-status-manager', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-warehouse', 'write');
					if($permission){

						$config 					= Config::get('spr.param.manage.transaction_status.actionTransactionStatus');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\TransactionStatusController')->actionInsert_Update_TransactionStatus($data_output_validate_param);
						Cache::forget('transaction_status');
						if($results['meta']['success']){

							return Redirect::route('auth-get-transaction-status');

						}else {

							if(isset($results['meta']['msg']['id']) && !empty($results['meta']['msg']['id'])){

								return redirect()->route('web-get-404');

							}else{

								return redirect()->back();
							}
						}

					}else {

						return view('errors.550');
					}
				}]);

				Route::post('/delete-warehouse-management',  ['as' => 'delete-warehouse-management', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-warehouse', 'write');
					if($permission){

						$config 					= Config::get('spr.param.manage.warehouse.deleteWarehouse');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\WarehouseController')->deleteData($data_output_validate_param);

						return redirect()->back();
					}else {

						return view('errors.550');
					}
				}]);

				Route::post('/categories-manager',['as' => 'categories-manager',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-categories', 'write');
					if($permission){


						$config 					= Config::get('spr.param.manage.product_categories.insert_product_categories');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\ProductCategoriesController')->actionInsert_ProductCategories($data_output_validate_param);

						return redirect()->back();
					}else {

						return view('errors.550');
					}
				}]);

				Route::post('/price-list-manager',['as' => 'price-list-manager',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-price', 'write');
					if($permission){

						$config = Config::get('spr.param.manage.price.update_insert_price_list');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\PriceListController')->actionInsertOrUpdate($data_output_validate_param);

						return redirect()->back()->with('message', $results);

					}else {

						return view('errors.550');
					}
				}]);

				Route::post('/post-news',['as' => 'post-news',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-news', 'write');
					if($permission){

						$config = Config::get('spr.param.manage.news.post_news');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\NewsController')->postNews($data_output_validate_param);

						return redirect()->back()->with('data', $results);
					}else {

						return view('errors.550');
					}
				}]);

				Route::post('/edit-news',['as' => 'edit-news',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-news', 'write');
					if($permission){

						$config = Config::get('spr.param.manage.news.post_news');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\NewsController')->editNews($data_output_validate_param);

						return redirect()->back();
					}else {

						return view('errors.550');
					}
				}]);

				Route::post('/delete-news',['as' => 'delete-news',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-news', 'write');
					if($permission){

						$config = Config::get('spr.param.manage.news.delete_news');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\NewsController')->deleteNews($data_output_validate_param);

						return redirect()->back();
					}else {

						return view('errors.550');
					}
				}]);

				Route::post('add-slide', ['as' => 'add-slide', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-slide', 'write');
					if($permission){

						$config 					= Config::get('spr.param.manage.slide.add_slide_image');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\SlideController')->insertData($data_output_validate_param);

						if ($results['meta']['success']) {

							return redirect()->back()->with('message', 'Success');
						} else {

							return redirect()->back()->with('message', $results['meta']['msg']);
						}


					} else {

						return view('errors.550');
					}
				}]);


				Route::post('update-lang-image', ['as' => 'update-lang-image', function() {

					$config 					= Config::get('spr.param.manage.product_categories.update_image_lang');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('App\Http\Validates\ValidateProductCategories')->updateData($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\ProductCategoriesController')->actionUpdateImage_Lang($data_output_validate_param);

					if($results['meta']['success']){

						return  Redirect::route('auth-get-product-categories');

					}else{

						return redirect()->back()->with('message', $results['meta']['msg']);
					}
				}]);

				Route::post('insert-update-banner', ['as' => 'insert-update-banner', function() {

					$config 					= Config::get('spr.param.manage.banner.insert_update_banner');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\BannerController')->actionInsertOrUpdate($data_output_validate_param);

					if($results['meta']['success']){
						return redirect()->back();
					}else{
						return redirect()->back()->withInput(Input::all())->withErrors([ 'error' => $results['meta']['msg']]);
					}


				}]);


				Route::post('insert-update-banner-detail', ['as' => 'insert-update-banner-detail', function() {

					$config 					= Config::get('spr.param.manage.banner.insert_update_banner_detail');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\BannerDetailController')->actionInsertOrUpdate($data_output_validate_param);


					if($results['meta']['success']){

						return redirect()->back();

					}else{

						return redirect()->back()->withInput(Input::all());

					}
				}]);

				Route::post('delete-banner-detail', ['as' => 'delete-banner-detail', function() {

					$config 					= Config::get('spr.param.manage.banner.delete_banner_detail');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\BannerDetailController')->deleteData($data_output_validate_param);

					return redirect()->back();
				}]);


				Route::post('delete-banner', ['as' => 'delete-banner', function() {

					$config 					= Config::get('spr.param.manage.banner.delete_banner');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);

					$results 					= App::make('App\Http\Controllers\BannerController')->deleteData($data_output_validate_param);

					return redirect()->back();
				}]);

				// Route::post('update-slide', ['as' => 'update-slide', function() {

				Route::post('delete-image', ['as' => 'delete-image', function() {

                    $config                     = Config::get('spr.param.manage.slide.get_image_infor');
                    $data_output_get_param         = App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                    $data_output_validate_param    = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
                    $results                     = App::make('App\Http\Controllers\SlideController')->deleteImage($data_output_validate_param);

                    return redirect()->back();
                }]);

                Route::post('insert-update-slide', ['as' => 'insert-update-slide', function() {

					$config 					= Config::get('spr.param.manage.slide.insert_update_slide');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\SlideController')->actionInsertOrUpdate($data_output_validate_param);

					if($results['meta']['success']){
						return redirect()->back();
					}else{
						return redirect()->back()->withInput(Input::all());
					}
				}]);

				Route::post('delete-slide', ['as' => 'delete-slide', function() {

					$config 					= Config::get('spr.param.manage.slide.delete_slide');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\SlideController')->deleteData($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('insert-update-slide-detail', ['as' => 'insert-update-slide-detail', function() {

					$config 					= Config::get('spr.param.manage.slide.insert_update_slide_detail');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\SlideDetailController')->actionInsertOrUpdate($data_output_validate_param);


					if($results['meta']['success']){

						return redirect()->back();

					}else{

						return redirect()->back()->withErrors($results['meta']['msg']);

					}
				}]);


				Route::post('delete-navigation', ['as' => 'delete-navigation', function() {

					$config 					= Config::get('spr.param.manage.navigation.delete_navigation');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\NavigationController')->deleteData($data_output_validate_param);

					return redirect()->back();
				}]);


				Route::post('insert-update-navigation', ['as' => 'insert-update-navigation', function() {

						$config 					= Config::get('spr.param.manage.navigation.update_navigation');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= [];

						if($data_output_validate_param['meta']['success'] == true && $data_output_validate_param['response']['id'] !=''){

							$results 	= App::make('App\Http\Controllers\NavigationController')->updateData($data_output_validate_param);

						}else{

							$config 					= Config::get('spr.param.manage.navigation.insert_navigation');
							$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
							$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
							$results 					= App::make('App\Http\Controllers\NavigationController')->insertData($data_output_validate_param);

						}

						if($results['meta']['success']){

							return redirect()->back();

						}else{

							return redirect()->back()->withInput(Input::all());

						}

					}]);

				Route::post('delete-transaction', ['as' => 'delete-transaction', function() {

					$config 					= Config::get('spr.param.manage.transaction.delete_transaction');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\TransactionController')->deleteData($data_output_validate_param);

					return redirect()->back();
				}]);


				Route::post('delete-price', ['as' => 'delete-price', function() {

					$config 					= Config::get('spr.param.manage.price.delete_price');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\PriceListController')->deleteData($data_output_validate_param);

					return redirect()->back()->with('message', $results);
				}]);

				Route::post('delete-transaction-detail', ['as' => 'delete-transaction-detail', function() {

					$config 					= Config::get('spr.param.manage.transaction.delete_transaction_detail');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\TransactionDetailController')->deleteData($data_output_validate_param);

					return redirect()->back();
				}]);


				Route::post('delete-news-categories', ['as' => 'delete-news-categories', function() {

					$config 					= Config::get('spr.param.manage.news_categories.delete_news_category');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\NewsCategoriesController')->deleteData($data_output_validate_param);

					return redirect()->back();
				}]);


				Route::post('insert-update-news-categories', ['as' => 'insert-update-news-categories', function() {

						$config 					= Config::get('spr.param.manage.news.categories.update_news_cate');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= [];

						if($data_output_validate_param['meta']['success'] == true && $data_output_validate_param['response']['id'] !=''){

							$results 	= App::make('App\Http\Controllers\NewsCategoriesController')->updateData($data_output_validate_param);

						}else{

							$config 					= Config::get('spr.param.manage.news.categories.insert_news_cate');
							$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
							$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
							$results 					= App::make('App\Http\Controllers\NewsCategoriesController')->insertData($data_output_validate_param);

						}

						if($results['meta']['success']){

							return redirect()->back();

						}else{

							return redirect()->back()->withInput(Input::all());

						}
				}]);

				Route::post('insert-update-group-customer', ['as' => 'insert-update-group-customer', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-group-customer', 'write');
					if($permission){

						$config 					= Config::get('spr.param.manage.group_customer.insert_update_group_customer');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\GroupCustomerController')->insertOrUpdate($data_output_validate_param);

						return redirect()->back()->with('message', $results);

					} else {

						return view('errors.550');
					}
				}]);

				Route::post('delete-group-customer', ['as' => 'delete-group-customer', function() {

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-group-customer', 'write');
					if($permission){

						$config 					= Config::get('spr.param.manage.group_customer.delete_group_customer');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\GroupCustomerController')->deleteData($data_output_validate_param);

						return redirect()->back()->with('message', $results);

					} else {

						return view('errors.550');
					}
				}]);

				Route::post('/surcharge-price-list-manager',['as' => 'surcharge-price-list-manager',function(){

					$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, 'manager-price', 'write');
					if($permission){

						$config = Config::get('spr.param.manage.price.update_insert_surcharge_price_list');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results					= App::make('App\Http\Controllers\PriceListSurchargeController')->actionInsertOrUpdate($data_output_validate_param);

						return redirect()->back();

					}else {

						return view('errors.550');
					}
				}]);

				Route::post('delete-surcharge-price', ['as' => 'delete-surcharge-price', function() {

					$config 					= Config::get('spr.param.manage.price.delete_surcharge_price');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\PriceListSurchargeController')->deleteData($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('insert-update-happy-code', ['as' => 'insert-update-happy-code', function() {

					$config 					= Config::get('spr.param.manage.happy_code.insert_update_happy_code');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\HappyCodeController')->insertUpdateData($data_output_validate_param);

					return redirect()->back()->with('message', $results);
				}]);

				Route::post('delete-happy-code', ['as' => 'delete-happy-code', function() {

					$config 					= Config::get('spr.param.manage.happy_code.delete_happy_code');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\HappyCodeController')->deleteData($data_output_validate_param);

					return redirect()->back()->with('message', $results);
				}]);

				Route::post('delete-payment-type', ['as' => 'delete-payment-type', function() {

					$config 					= Config::get('spr.param.manage.payment_type.delete_payment_type');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\PaymentTypeController')->deleteData($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('insert-or-update-payment-type', ['as' => 'insert-or-update-payment-type', function() {

					$config 					= Config::get('spr.param.manage.payment_type.insert_or_update_payment_type');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\PaymentTypeController')->insertOrUpdate($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('delete-payment-type-detail', ['as' => 'delete-payment-type-detail', function() {

					$config 					= Config::get('spr.param.manage.payment_type.delete_payment_type_detail');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\PaymentTypeDetailController')->deleteData($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('insert-or-update-payment-type-detail', ['as' => 'insert-or-update-payment-type-detail', function() {

					$config 					= Config::get('spr.param.manage.payment_type.insert_or_update_payment_type_detail');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\PaymentTypeDetailController')->insertOrUpdate($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('delete-frequently-asked-questions', ['as' => 'delete-frequently-asked-questions', function() {

					$config 					= Config::get('spr.param.manage.faq.delete_frequently_asked_questions');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\FrequentlyAskedQuestionController')->deleteData($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('insert-or-update-frequently-asked-questions', ['as' => 'insert-or-update-frequently-asked-questions', function() {

					$config 					= Config::get('spr.param.manage.faq.insert_or_update_frequently_asked_questions');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\FrequentlyAskedQuestionController')->insertOrUpdate($data_output_validate_param);

					return redirect()->back();
				}]);


				Route::post('update-manager-customer', ['as' => 'update-manager-customer', function() {

					$config 					= Config::get('spr.param.manage.customer.update_manager_customer');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\CustomerController')->updateGroupCustomer($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('insert-update-setting', ['as' => 'insert-update-setting', function() {

						$config 					= Config::get('spr.param.manage.setting.update_setting');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= [];
						if($data_output_validate_param['meta']['success'] == true && $data_output_validate_param['response']['id'] !=''){

							$results 	= App::make('App\Http\Controllers\SettingController')->updateData($data_output_validate_param);

						}else{

							$config 					= Config::get('spr.param.manage.setting.insert_setting');
							$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
							$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);

							$results 					= App::make('App\Http\Controllers\SettingController')->insertData($data_output_validate_param);

						}


					Cache::forget('support');
					Cache::forget('logo');
					Cache::forget('why_choose_us');
					Cache::forget('email_support');
					Cache::forget('hotline');
					Cache::forget('company_name');
					Cache::forget('total_products');
					Cache::forget('total_transaction_success');
					Cache::forget('description');
					Cache::forget('commitment');
					Cache::forget('services');


						if($results['meta']['success']){

							return redirect()->back();

						}else{

							return redirect()->back()->withInput(Input::all());

						}

				}]);

				Route::post('update-company-info', ['as' => 'update-company-info', function() {
						$config 					= Config::get('spr.param.manage.setting.update_company_info');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);

						$results 	= App::make('App\Http\Controllers\SettingController')->updateCompanyInfo($data_output_validate_param);


						Cache::forget('support');
						Cache::forget('logo');
						Cache::forget('why_choose_us');
						Cache::forget('email_support');
						Cache::forget('hotline');
						Cache::forget('company_name');
						Cache::forget('total_products');
						Cache::forget('total_transaction_success');
						Cache::forget('description');
						Cache::forget('commitment');
						Cache::forget('services');


						if($results['meta']['success']){

							return redirect()->back();

						}else{

							return redirect()->back()->withInput(Input::all());

						}

				}]);

				Route::post('delete-setting', ['as' => 'delete-setting', function() {

					$config 					= Config::get('spr.param.manage.setting.delete_setting');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\SettingController')->deleteData($data_output_validate_param);


					Cache::forget('support');
					Cache::forget('logo');
					Cache::forget('why_choose_us');
					Cache::forget('email_support');
					Cache::forget('hotline');
					Cache::forget('company_name');
					Cache::forget('total_products');
					Cache::forget('total_transaction_success');
					Cache::forget('description');
					Cache::forget('commitment');
					Cache::forget('services');

					return redirect()->back();
				}]);

				Route::post('insert-update-price-happy-code', ['as' => 'insert-update-price-happy-code', function() {

					$config 					= Config::get('spr.param.manage.happy_code.insert_update_price_happy_code');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\PriceHappyCodeController')->insertUpdateData($data_output_validate_param);

					return redirect()->back()->with('message', $results);
				}]);

				Route::post('delete-price-happy-code', ['as' => 'delete-price-happy-code', function() {

					$config 					= Config::get('spr.param.manage.happy_code.delete_price_happy_code');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\PriceHappyCodeController')->deleteData($data_output_validate_param);

					return redirect()->back()->with('message', $results);
				}]);

				Route::post('delete-bank', ['as' => 'delete-bank', function() {

					$config 					= Config::get('spr.param.manage.bank.delete_bank');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\BankController')->deleteData($data_output_validate_param);

					return redirect()->back()->with('message', $results);
				}]);

				Route::post('insert-update-bank', ['as' => 'insert-update-bank', function() {

					$config 					= Config::get('spr.param.manage.bank.insert_update_bank');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\BankController')->insertUpdateData($data_output_validate_param);

					return redirect()->back()->with('message', $results);
				}]);

				Route::post('update-manager-admin', ['as' => 'update-manager-admin', function() {

					$config 					= Config::get('spr.param.manage.admin.update_manager_admin');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\UserController')->updateAdminInformation($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('ajax/update-blocked-admin', ['as' => 'block-manager-admin', function() {

					$config 					= Config::get('spr.param.manage.admin.block');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\UserController')->blockAdmin($data_output_validate_param);

					return json_encode($results);
				}]);

				Route::post('delete-manager-admin', ['as' => 'delete-manager-admin', function() {

					$config 					= Config::get('spr.param.manage.admin.delete_manager_admin');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\UserController')->deleteAdminInformation($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('add-manager-admin', ['as' => 'add-manager-admin', function() {

					$config 					= Config::get('spr.param.manage.admin.add_manager_admin');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\UserController')->addManagerAdmin($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('delete-feedback', ['as' => 'delete-feedback', function() {

					$config 					= Config::get('spr.param.manage.feedback.update_feedback');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\CustomerFeedbackController')->deleteData($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('delete-transaction-status', ['as' => 'delete-transaction-status', function() {

					$config 					= Config::get('spr.param.manage.transaction_status.delete');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\TransactionStatusController')->deleteData($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('update-feedback', ['as' => 'update-feedback', function() {

					$config 					= Config::get('spr.param.manage.feedback.update_feedback');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\CustomerFeedbackController')->updateComment($data_output_validate_param);

					return redirect()->back();
				}]);

				Route::post('update-happy-code-order', ['as' => 'update-happy-code-order', function() {

					$config 					= Config::get('spr.param.manage.happy_code.update_happy_code_order');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\OrderHappyCodeController')->updateHappyCodeOrder($data_output_validate_param);

					return redirect()->back()->with('message', $results);
				}]);


				Route::post('update-setting-rules', ['as' => 'update-setting-rules', function() {

					$config 					= Config::get('spr.param.manage.setting.update_rules');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\SettingController')->updateRules($data_output_validate_param);


					Cache::forget('support');
					Cache::forget('logo');
					Cache::forget('why_choose_us');
					Cache::forget('email_support');
					Cache::forget('hotline');
					Cache::forget('company_name');
					Cache::forget('total_products');
					Cache::forget('total_transaction_success');
					Cache::forget('description');
					Cache::forget('commitment');
					Cache::forget('services');


					return redirect()->back()->with('message', $results);
				}]);

				Route::post('insert-or-update-support', ['as' => 'insert-or-update-support', function() {

					$config 					= Config::get('spr.param.manage.support.update_support');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					=  [];

					if($data_output_validate_param['meta']['success'] == true && $data_output_validate_param['response']['id'] !=''){

						$results 	= App::make('App\Http\Controllers\SupportController')->updateSupport($data_output_validate_param);

					}else{

					$config 					= Config::get('spr.param.manage.support.insert_support');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\SupportController')->insertSupport($data_output_validate_param);

					}

					Cache::forget('support');
					Cache::forget('logo');
					Cache::forget('why_choose_us');
					Cache::forget('email_support');
					Cache::forget('hotline');
					Cache::forget('company_name');
					Cache::forget('total_products');
					Cache::forget('total_transaction_success');
					Cache::forget('description');
					Cache::forget('commitment');
					Cache::forget('services');

					if($results['meta']['success']){

						return redirect()->back();

					}else{

						return redirect()->back()->withInput(Input::all());

					}
				}]);

				Route::post('delete-support', ['as' => 'delete-support', function() {

					$config 					= Config::get('spr.param.manage.support.delete_support');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\SupportController')->deleteSupport($data_output_validate_param);
					Cache::forget('support');
					return redirect()->back();
				}]);

				Route::post('update-status-price-request', ['as' => 'update-status-price-request', function() {

					$config 					= Config::get('spr.param.manage.price_request.update_status');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\PriceRequestController')->updateStatus($data_output_validate_param);

					// dd($results);

					return redirect()->back()->with('message', $results['meta']['msg']);
				}]);

				Route::post('/change-admin-password' , ['as' => 'change-admin-password', function () {

			  		$config 					= Config::get('spr.param.manage.admin.change_admin_password');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
			        $results    			 	= App::make('App\Http\Controllers\UserController')->changePassword($data_output_validate_param);

			       	if ($results['meta']['success']) {

						return Redirect::route('auth-get-change-password')->with('message', $results);

					}
					// else {

					// 	return Redirect::route('web-get-404');
					// }
			  	}]);

			  	Route::post('/data-chart-money',  ['as' => 'data-chart-money', function() {


						$results_order = App::make('App\Http\Controllers\DashboardController')->getDataAmount();

						return response()->json($results_order);
				}]);


				Route::group(['prefix' => 'ajax', 'as' => 'ajax-'], function() {

					Route::post('update-permission', ['as' => 'update-permission', function() {

						$config 					= Config::get('spr.param.manage.permission.ajaxGetPermission');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\PermissionController')->updatePermission($data_output_validate_param);

						return json_encode($results);
					}]);

					Route::post('get-permission', ['as' => 'get-permission', function() {

						$config 					= Config::get('spr.param.manage.permission_roles.getPermissionRoles');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\PermissionRolesController')->getData($data_output_validate_param);

						return json_encode($results);
					}]);

					Route::post('get-price-list-detail', ['as' => 'get-price-list-detail', function() {

						$config 					= Config::get('spr.param.manage.price.price_list_detail');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\PriceListDetailController')->getData($data_output_validate_param);

						return json_encode($results);

					}]);

					Route::post('new-price-list-detail', ['as' => 'new-price-list-detail', function() {

						$config 					= Config::get('spr.param.manage.price.insert_price_list_detail');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\PriceListDetailController')->insertData($data_output_validate_param);

						return json_encode($results);
					}]);

					Route::post('update-price-list-detail', ['as' => 'update-price-list-detail', function() {

						$config 					= Config::get('spr.param.manage.price.update_price_list_detail');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\PriceListDetailController')->updateData($data_output_validate_param);

						return json_encode($results);
					}]);

					Route::post('delete-price-list-detail', ['as' => 'delete-price-list-detail', function() {

						$config 					= Config::get('spr.param.manage.price.delete_price_list_detail');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\PriceListDetailController')->deleteData($data_output_validate_param);

						return json_encode($results);
					}]);

					Route::post('delete-roles', ['as' => 'delete-roles', function() {

						$config 					= Config::get('spr.param.manage.roles.deleteRoles');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\RoleController')->deleteData($data_output_validate_param);

						return json_encode($results);
					}]);

					Route::post('check-status-price-request', ['as' => 'check-status-price-request', function() {

						$config 					= Config::get('spr.param.manage.price_request.check_status');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\PriceRequestController')->checkExistsRecord($data_output_validate_param);

						return json_encode($results);
					}]);

					Route::post('update-status-price-request', ['as' => 'update-status-price-request', function() {

						$config 					= Config::get('spr.param.manage.price_request.update_status');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\PriceRequestController')->updateStatus($data_output_validate_param);

						return json_encode($results);
					}]);

					Route::post('get-detail-price-request', ['as' => 'get-detail-price-request', function() {

						$config 					= Config::get('spr.param.manage.price_request.price_request_management');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\PriceRequestController')->getData($data_output_validate_param);

						return json_encode($results);
					}]);

					Route::post('get-product-category-lang', ['as' => 'get-product-category-lang', function() {

						$config 					= Config::get('spr.param.manage.product_categories.get_category_lang');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\ProductCategoriesController')->getDataForLangCode($data_output_validate_param);

						return json_encode($results);
					}]);

					Route::post('get-image-information', ['as' => 'get-image-information', function() {

                        $config                     = Config::get('spr.param.manage.slide.get_image_infor');
                        $data_output_get_param         = App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param    = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
                        $results                     = App::make('App\Http\Controllers\SlideController')->getImageInformation($data_output_validate_param);

                        return json_encode($results);
                    }]);

                    Route::post('update-slide-status', ['as' => 'update-slide-status', function() {

						$config 					= Config::get('spr.param.manage.slide.slide_status');
						$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
						$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\SlideController')->updateStatus($data_output_validate_param);

                        return json_encode($results);
					}]);


                    Route::post('update-active-navigation', ['as' => 'update-active-navigation', function() {

                        $config                     = Config::get('spr.param.manage.navigation.update_active_navigation');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
                        $results                  	= App::make('App\Http\Controllers\NavigationController')->changeActive($data_output_validate_param);

                        return json_encode($results);
                    }]);

                    Route::post('transaction-pending', ['as' => 'transaction-pending', function() {
                    	$config                     = Config::get('spr.param.manage.transaction.transaction_pending');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);

                        $result_transaction_pending 	= 	App::make('App\Http\Controllers\TransactionController')
                        										->getTransactionPending($data_output_validate_param);
                        return json_encode($result_transaction_pending);
                    }]);

                    Route::post('price-request-pending', ['as' => 'price-request-pending', function() {
                    	$config                     = Config::get('spr.param.manage.price_request.price_request_pending');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);

						$result_request_pending 	= 	App::make('App\Http\Controllers\PriceRequestController')
															->getPriceRequestPending($data_output_validate_param);
                        return json_encode($result_request_pending);
                    }]);

                    Route::post('feed-back-pending', ['as' => 'feed-back-pending', function() {

						$result_feedBack_pending    =   App::make('App\Http\Controllers\CustomerFeedbackController')
															->getFeedbackPending();
                        return json_encode($result_feedBack_pending);
                    }]);


                    Route::post('update-type-price', ['as' => 'update-type-price', function() {

                    	$config                     = Config::get('spr.param.manage.price.change_type');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= 	App::make('App\Http\Controllers\PriceListController')
															->changeStatusPriceList($data_output_validate_param);
                        return json_encode($results);
                    }]);


                    Route::post('update-type-transaction-status', ['as' => 'update-type-transaction-status', function() {

                    	$config                     = Config::get('spr.param.manage.price.change_type');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= 	App::make('App\Http\Controllers\TransactionStatusController')
															->changeStatusTransactionStatus($data_output_validate_param);
                        return json_encode($results);
                    }]);


                    Route::post('update-config-price', ['as' => 'update-config-price', function() {

                    	$config                     = Config::get('spr.param.manage.config_price.config_price');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\ConfigPriceController')->updateData($data_output_validate_param);
                        return json_encode($results);

                    }]);

                    Route::post('get-transaction-detail', ['as' => 'get-transaction-detail', function() {

                    	$config                     = Config::get('spr.param.manage.transaction.transactionDetail');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\TransactionDetailController')->getDataForAjax($data_output_validate_param);
                        return json_encode($results);

                    }]);

                    Route::post('get-info-transaction-detail', ['as' => 'get-info-transaction-detail', function() {

                    	$config                     = Config::get('spr.param.manage.transaction.info_transaction_detail');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\TransactionController')->getInformationTransactionDetail($data_output_validate_param);
                        return json_encode($results);

                    }]);

                    Route::post('verify-transaction', ['as' => 'verify-transaction', function() {

                    	$config                     = Config::get('spr.param.manage.transaction.verify_transaction');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\TransactionController')->verifyTransaction($data_output_validate_param);
                        return json_encode($results);

                    }]);

                    Route::post('verify-transaction', ['as' => 'verify-transaction', function() {

                    	$config                     = Config::get('spr.param.manage.transaction.verify_transaction');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\TransactionController')->verifyTransaction($data_output_validate_param);
                        return json_encode($results);

                    }]);

                    Route::post('change-status-feedback', ['as' => 'change-status-feedback', function() {

                    	$config                     = Config::get('spr.param.manage.feedback.update_feedback');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\CustomerFeedbackController')->updateStatus($data_output_validate_param);
                        return json_encode($results);

                    }]);

                    Route::post('change-verify-feedback', ['as' => 'change-status-feedback', function() {

                    	$config                     = Config::get('spr.param.manage.feedback.update_feedback');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\CustomerFeedbackController')->updateVerify($data_output_validate_param);
                        return json_encode($results);

                    }]);

                    Route::post('change-status-support', ['as' => 'change-status-support', function() {

                    	$config                     = Config::get('spr.param.manage.support.update_status');
                        $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                        $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
						$results 					= App::make('App\Http\Controllers\SupportController')->changeStatus($data_output_validate_param);
                        return json_encode($results);

                    }]);

				});
			});

		});

		Route::group(['middleware' => 'guest', 'as' => 'guest-'], function () {

			Route::group(['as' => 'get-'], function () {

				Route::get('' , ['as' => '', function () {

					return view('pages.user.index');
				}]);

				Route::get('login' , ['as' => 'login', function () {

					return view('login.login');
				}]);

				Route::get('reset-password' , ['as' => 'reset-password', function () {

					$config 					= Config::get('spr.param.web.password.check_reset_password');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\UserController')->checkResetPassword($data_output_validate_param);

					if ($results == true) {

						return view('login.reset_pass');
					} else {

						return redirect()->route('web-get-404');
					}
				}]);

			});

			Route::group(['as' => 'post-'], function () {

				Route::post('login' , ['as' => 'login', function () {

				    $checkLogin = App::make('App\Http\Controllers\UserController')->login();

					if ( $checkLogin ) {

						if(Auth::user()->blocked == 0 ){

							Auth::logout();
							return Redirect::back()->withErrors(['email'=>'tài khoản của bạn đã bị khóa!']);
						}

						return Redirect::route('auth-get-dashboard');
					}else{

						return Redirect::back()->withErrors(['email'=>'tên đăng nhập hoặc mật khẩu không đúng vui lòng thử lại!']);
					}
				}]);

				Route::post('/reset-password' , ['as' => 'reset-password', function () {
			  		$config 					= Config::get('spr.param.web.password.reset_password');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
			        $results    			 	= App::make('App\Http\Controllers\UserController')->resetPassword($data_output_validate_param);

			        if($results['meta']['success']) {

			       		return redirect()->route('web-get-thanks');
			        }else {

			        	return Redirect::route('guest-get-login')->withErrors($results['meta']['msg']);
			        }

			  	}]);


			  	Route::post('/change-password' , ['as' => 'change-password', function () {

			  		$config 					= Config::get('spr.param.web.password.action_reset_password');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
			        $results    			 	= App::make('App\Http\Controllers\UserController')->actionResetPassword($data_output_validate_param);

			       	return redirect()->route('guest-get-login');
			  	}]);
			});

		});

	});


	Route::group(['as' => 'web-'], function () {

		Route::group(['as' => 'get-'], function () {


			Route::group(['middleware' => 'auth:customer'], function () {

				Route::get('/logout' , ['as' => 'logout', function () {

					if( isset($_COOKIE['shopping_cart']) && Cache::get('shopping_cart_'.$_COOKIE['shopping_cart']) != null ){

						Cache::forget('shopping_cart_'.$_COOKIE['shopping_cart']);
					}
					Auth::guard('customer')->logout();
				    return Redirect::route('web-get-homePage');
				}]);

				Route::get('favorite-product', ['as' => 'favorite-product', function(){

					$config 					= Config::get('spr.param.web.favorite_product.product');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\FavoriteProductController')->getData($data_output_validate_param);

					return view('pages.'.MOBILE_OR_WEB.'.favorite_product')->with('data', $results);
				}]);

				Route::get('show-price-request', ['as' => 'show-price-request', function(){

					$config 					= Config::get('spr.param.web.price_request.price_request');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$data_output_validate_param['response']['customer_id'] = Auth::user()->id;
					$results 					= App::make('App\Http\Controllers\PriceRequestController')->getData($data_output_validate_param);

					return view('pages.'.MOBILE_OR_WEB.'.show_price_request')->with('data', $results);
				}]);

				Route::get('user-information', ['as' => 'user-information', function(){

					$config 					= Config::get('spr.param.web.user.user');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\CustomerController')->getUserInformation($data_output_validate_param);

					return view('pages.'.MOBILE_OR_WEB.'.user_information')->with('data', $results);
				}]);

				Route::get('change-password', ['as' => 'change-password', function(){

					return view('pages.'.MOBILE_OR_WEB.'.change_password');
				}]);

				Route::get('happy-code', ['as' => 'happy-code', function(){

					$config 					= Config::get('spr.param.web.happy_code.happy_code');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\OrderHappyCodeController')->getData($data_output_validate_param);

					$config_type_happy_code 					= Config::get('spr.param.manage.happy_code.price_happy_code');
					$data_output_get_param_type_happy_code 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config_type_happy_code);
					$data_output_validate_param_type_happy_code	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param_type_happy_code);
					$results_type_happy_code					= App::make('App\Http\Controllers\PriceHappyCodeController')->getData($data_output_validate_param_type_happy_code);

					return view('pages.'.MOBILE_OR_WEB.'.happy_code')->with('data', $results)
																		->with('happy_code_type', $results_type_happy_code);
				}]);
			});

			Route::group(['middleware' => 'guest:customer'], function () {

				Route::get('/register' , ['as' => 'register', function () {

				    return view('pages.'.MOBILE_OR_WEB.'.register');
				}]);

				Route::get('/forget-password' , ['as' => 'forget-password', function () {

				    return view('pages.'.MOBILE_OR_WEB.'.forget_password');
				}]);

				Route::get('/login' , ['as' => 'login', function () {


					return view('pages.'.MOBILE_OR_WEB.'.login');
				}]);

				Route::get('login-facebook', ['as' => 'login-facebook', function(Request $request){

					$results = App::make('App\Http\Controllers\FacebookController')->loginWithFacebook($request);

					return $results;
				}]);

				Route::get('auth/facebook/callback', ['as' => 'login-facebook-callback', function(Request $request){

					$results = App::make('App\Http\Controllers\FacebookController')->callbackFacebook($request);

					if(is_array($results)) {

						if ($results['meta']['success']) {

							return redirect()->route('web-get-homePage');
						} else {

							return redirect()->route('web-get-404');
						}
					}

					return $results;
				}]);

				Route::get('auth/google', ['as' => 'login-google', function(Request $request){

					$results = App::make('App\Http\Controllers\GoogleController')->loginWithGoogle($request);

					return $results;
				}]);

				Route::get('auth/google/callback', ['as' => 'login-google-callback', function(Request $request){

					$results = App::make('App\Http\Controllers\GoogleController')->callbackGoogle($request);

					if(is_array($results)) {

						if ($results['meta']['success']) {

							return redirect()->route('web-get-homePage');
						} else {

							return redirect()->route('web-get-404');
						}
					}

					return $results;
				}]);

				Route::get('reset-password', ['as' => 'reset-password', function(){

					$config 					= Config::get('spr.param.web.password.check_reset_password');
					$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
					$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
					$results 					= App::make('App\Http\Controllers\CustomerController')->checkResetPassword($data_output_validate_param);

					if ($results == true) {

						return view('pages.user.reset_password');
					} else {

						return redirect()->route('web-get-404');
					}
				}]);
			});

			Route::get('' , ['as' => 'homePage', function () {


				$config 					= Config::get('spr.param.web.home_page.home_page');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\SlideController')->getActiveMainSlide($data_output_validate_param);


				$config 					= Config::get('spr.param.web.navigation.navigation');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results_navigation 		= App::make('App\Http\Controllers\NavigationController')->getDataForClient($data_output_validate_param);


				$config 					= Config::get('spr.param.web.banner.banner');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results_banner 			= App::make('App\Http\Controllers\BannerController')->getBanner($data_output_validate_param);

				$results_hotDeals 			= App::make('App\Http\Controllers\HotDealsController')->getHotDealsForIndex();
				$result_setting          	=  App::make('App\Http\Controllers\SettingController')->getAllData();

				return view('pages.'.MOBILE_OR_WEB.'.index')->with('main_slide', $results)->with('nav_right',$results_navigation['response'])->with('banner',$results_banner['response'])->with('hot_deals',$results_hotDeals['response'])->with('setting',$result_setting['response']);

			}]);

			Route::get('404',['as' => '404', function(){

				return view('errors.404');
			}]);


			Route::get('/p' , ['as' => 'product-by-category', function () {

				$config = Config::get('spr.param.web.product.getProductByCate');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\ProductController')->get_product_by_cate($data_output_validate_param);

				if($results['meta']['success']) {

					return view('pages.'.MOBILE_OR_WEB.'.list_product')->with('data', $results);
				}else {

					return Redirect::route('web-get-homePage');
				}
			}]);

			Route::get('/s' , ['as' => 'search-product-by-key', function () {

				$results = App::make('App\Http\Controllers\ProductController')->search_product();

				if($results['meta']['success']) {
					return view('pages.'.MOBILE_OR_WEB.'.list_product')->with('data', $results);
				}else {

					return Redirect::route('web-get-homePage');
				}
			}]);

			Route::get('/dp' , ['as' => 'detail-product', function () {

		        $config = Config::get('spr.param.web.product.detailProduct');
		        $data_output_get_param        	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
		        $data_output_validate_param   	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
		        $results                   		= App::make('App\Http\Controllers\ProductController')->detailProduct($data_output_validate_param);

		        if($results['meta']['success']) {

		            return view('pages.'.MOBILE_OR_WEB.'.detail_product')->with('data', $results['response']);
		        }else {

		            return Redirect::route('web-get-homePage');
		        }
		  	}]);

		 //  	Route::get('/customer-consult',  ['as' => 'customer-consult', function() {

			// 	return view('pages.user.customer_consult');
			// }]);

			Route::get('price-request' , ['as' => 'price-request', function () {

				return view('pages.'.MOBILE_OR_WEB.'.price_request');
			}]);

			Route::get('thanks' , ['as' => 'thanks', function () {

				return view('pages.user.thanks');
			}]);

			Route::get('all-deals', ['as' => 'all-deals', function(){

				$config 					= Config::get('spr.param.web.hot_deals.hot_deal');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\HotDealsController')->getAllHotDeals($data_output_validate_param);

				return view('pages.'.MOBILE_OR_WEB.'.list_hot_deals')->with('data', $results);
			}]);


			Route::get('order-tracking', ['as' => 'order-tracking', function(){

				$config 					= Config::get('spr.param.web.order_tracking.order_tracking');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\OrderTrackingController')->getData($data_output_validate_param);

				return view('pages.'.MOBILE_OR_WEB.'.order_tracking')->with('data', $results);
			}]);

			Route::get('order-tracking-detail', ['as' => 'order-tracking-detail', function(){

				$config 					= Config::get('spr.param.web.order_tracking.order_tracking_detail');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\OrderTrackingController')->getOrderTrackingDetail($data_output_validate_param);

				return view('pages.'.MOBILE_OR_WEB.'.order_tracking_detail')->with('data', $results);
			}]);

			Route::get('confirm-orders-information', ['as' => 'confirm-orders-information', function(){

				$config 					= Config::get('spr.param.web.confirm.get_confirm_orers');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\CustomerController')->getUserInformation($data_output_validate_param);

				return view('pages.'.MOBILE_OR_WEB.'.confirm_orders_info');
			}]);

			Route::get('confirm-payment/{order_code}', ['as' => 'confirm-payment', function($order_code){

				$config 					= Config::get('spr.param.web.payment.get_payment');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config, $order_code);
				$data_output_validate_param	= App::make('App\Http\Validates\validateConfirmPayment')->validateGetConfirmPayment($data_output_get_param);
				$results = App::make('App\Http\Controllers\TransactionController')->getPaymentInformation($data_output_validate_param);

				if($results['meta']['success']) {

					if($results['response']['transaction']->verify == 0 && $results['response']['transaction']->deleted_at == null){

						return view('pages.'.MOBILE_OR_WEB.'.payment')->with('data',$results);

					}else if($results['response']['transaction']->verify == 1 && $results['response']['transaction']->deleted_at == null){

						echo "OK";

					}else{

						return view('pages.'.MOBILE_OR_WEB.'.transaction_error')->with('data',$results['response']);

					}
				}else if($results['meta']['code'] == '0033') {

				}else {
					return Redirect::route('web-get-404');
				}

			}]);

			Route::get('my-shopping-cart', ['as' => 'my-shopping-cart', function(){

				// $results = App::make('App\Http\Controllers\ShoppingCartController')->updatePriceOfProductOnShoppingCart();
				return view('pages.'.MOBILE_OR_WEB.'.shopping_cart');

			}]);

			Route::get('news', ['as' => 'news', function(){

				$config 					= Config::get('spr.param.web.news.news');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\NewsController')->getDataUser($data_output_validate_param);

				return view('pages.'.MOBILE_OR_WEB.'.news')->with('data', $results);
			}]);

			Route::get('frequently-asked-questions', ['as' => 'frequently-asked-questions', function(){

				$config 					= Config::get('spr.param.web.faq.frequently_asked_questions');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\FrequentlyAskedQuestionController')->getData($data_output_validate_param);

				return view('pages.'.MOBILE_OR_WEB.'.frequently_asked_questions')->with('data', $results);
			}]);

			Route::get('confirm-completed', ['as' => 'confirm-completed', function(){

				return Redirect::route('web-get-homePage');

			}]);

			Route::get('news-detail', ['as' => 'news-detail', function(){

				$config 					= Config::get('spr.param.web.news.news');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\NewsController')->getDataUser($data_output_validate_param);

				if (!empty($results['data'])) {

					return view('pages.'.MOBILE_OR_WEB.'.news_detail')->with('data', $results);

				} else {

					return Redirect::route('web-get-404');
				}
			}]);
			Route::get('customer-feedback', ['as' => 'customer-feedback', function(){

				$config 					= Config::get('spr.param.web.customer.customer_feedback');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\CustomerFeedbackController')->getFeedBack($data_output_validate_param);
				return view('pages.'.MOBILE_OR_WEB.'.customer_feedback')->with('data',$results['response']);
			}]);
			Route::get('callback-payment-online', ['as' => 'callback-payment-online', function(){

				$config 					= Config::get('spr.param.web.payment.confirm_payment_online');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\PaymentController')->callback_payment_online($data_output_validate_param);

				if($results['meta']['success']) {

					return Redirect::route('web-get-order-tracking-detail',$results['response']);
				}else {
					return Redirect::route('web-get-homePage');
				}
			}]);

			Route::get('payment-method', ['as' => 'payment-method', function(){

				return view('pages.'.MOBILE_OR_WEB.'.payment_method');
			}]);

			Route::get('introduce', ['as' => 'introduce', function(){

				return view('pages.'.MOBILE_OR_WEB.'.introduce');
			}]);

			Route::get('shopping-guide', ['as' => 'shopping-guide', function(){

				return view('pages.'.MOBILE_OR_WEB.'.shopping_guide');
			}]);


		});

		Route::group(['as' => 'post-'], function () {

			Route::post('/detail-price-of-product' , ['as' => 'price-of-product', function () {

		        $config = Config::get('spr.param.web.product.getProductPrice');
		        $data_output_get_param        	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
		        $data_output_validate_param   	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
		        $results                   		= App::make('App\Http\Controllers\ProductController')->getPriceOfProduct($data_output_validate_param);

		        return response()->json($results);
		  	}]);

			Route::post('new-price-request', ['as' => 'new-price-request', function () {

				$config 					= Config::get('spr.param.web.price_request.new_price_request');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results					= App::make('App\Http\Controllers\PriceRequestController')->insertData($data_output_validate_param);

				return redirect()->back()->with('data', $results);
			}]);

			Route::post('add-email-notification', ['as' => 'add-email-notification', function () {

				$config 					= Config::get('spr.param.web.email_notification.email_notification');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results					= App::make('App\Http\Controllers\EmailNotificationController')->insertData($data_output_validate_param);

				return Redirect::route('web-get-thanks');
			}]);

			Route::post('register-user', ['as' => 'register-user', function () {


				$config 					= Config::get('spr.param.web.register.register_user');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results					= App::make('App\Http\Controllers\CustomerController')->insertData($data_output_validate_param);

				if ($results['meta']['success']) {

					return Redirect::route('web-get-thanks');
				} else {

					return redirect()->back()->withErrors(['register' => $results['meta']['msg']])->withInput(Input::All());
				}
			}]);

			Route::post('ajax-register-user', ['as' => 'ajax-register-user', function () {


				$config 					= Config::get('spr.param.web.register.register_user');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results					= App::make('App\Http\Controllers\CustomerController')->insertData($data_output_validate_param);

				// if ($results['meta']['success']) {

				// 	return Redirect::route('web-get-thanks');
				// } else {

					return json_encode($results);
				// }
			}]);

		  	Route::post('/reset-password' , ['as' => 'reset-password', function () {

	  			$config 					= Config::get('spr.param.web.password.reset_password');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\CustomerController')->resetPassword($data_output_validate_param);

		       	return redirect()->route('web-get-thanks');
		  	}]);

		  	Route::post('/ajax-reset-password' , ['as' => 'ajax-reset-password', function () {

	  			$config 					= Config::get('spr.param.web.password.reset_password');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\CustomerController')->resetPassword($data_output_validate_param);

		       	return json_encode($results);
		  	}]);

		  	Route::post('/action-reset-password' , ['as' => 'action-reset-password', function () {
		  		$config 					= Config::get('spr.param.web.password.action_reset_password');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
		        $results    			 	= App::make('App\Http\Controllers\CustomerController')->actionResetPassword($data_output_validate_param);

		       	if ($results['meta']['success']) {

					return Redirect::route('web-get-thanks');
				} else {

					return Redirect::route('web-get-404');
				}
		  	}]);

		  	Route::post('favorite-product', ['as' => 'favorite-product', function() {

                $config                    	= Config::get('spr.param.web.favorite_product.favorite_product');
                $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
                $results                   	= App::make('App\Http\Controllers\FavoriteProductController')->insertData($data_output_validate_param);

                return json_encode($results);
            }]);

            Route::post('delete-favorite-product', ['as' => 'delete-favorite-product', function() {

                $config                    	= Config::get('spr.param.web.favorite_product.delete_favorite_product');
                $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
                $results                   	= App::make('App\Http\Controllers\FavoriteProductController')->deleteData($data_output_validate_param);

                return json_encode($results);
            }]);

		  	Route::post('/change-user-information' , ['as' => 'change-user-information', function () {

		  		$config 					= Config::get('spr.param.web.user.change_user_information');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
		        $results    			 	= App::make('App\Http\Controllers\CustomerController')->changeInformation($data_output_validate_param);

		       	if ($results['meta']['success']) {

		       		if ($results['response']['type'] == 'user_information') {

						return Redirect::route('web-get-user-information')->with('message', $results);

			        } else if($results['response']['type'] == 'change_password') {

						return Redirect::route('web-get-change-password')->with('message', $results);
			        }

				} else {

					return Redirect::route('web-get-404');
				}
		  	}]);

		  	Route::post('register-happy-code', ['as' => 'register-happy-code', function(){

				$config 					= Config::get('spr.param.web.happy_code.register_happy_code');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\OrderHappyCodeController')->insertData($data_output_validate_param);

				return Redirect::route('web-get-happy-code')->with('message', $results);
			}]);

			Route::post('add-product-to-shopping-cart', ['as' => 'add-product-to-shopping-cart', function(){

				$config 					= Config::get('spr.param.web.shopping_cart.add_product');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\ShoppingCartController')->addProductToShoppingCart($data_output_validate_param);
				if(Auth::check()){
					$results['meta']['auth'] = 1;
				}else{
					$results['meta']['auth'] = 0;
				}
				return $results;

			}]);

			Route::post('delete-favorite-product', ['as' => 'delete-favorite-product', function() {

                $config                    	= Config::get('spr.param.web.favorite_product.delete_favorite_product');
                $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
                $results                   	= App::make('App\Http\Controllers\FavoriteProductController')->deleteData($data_output_validate_param);

                return json_encode($results);
            }]);

			Route::post('buy-now', ['as' => 'buy-now', function(){

				$config 					= Config::get('spr.param.web.shopping_cart.add_product');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\ShoppingCartController')->addProductToShoppingCart($data_output_validate_param);

				return $results;
			}]);

			Route::post('confirm-orders', ['as' => 'confirm-orders', function(){
				$config 					= Config::get('spr.param.web.confirm.update_confirm');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\TransactionController')->confirmTransaction($data_output_validate_param);
				if($results['meta']['success']){

					return Redirect::route('web-get-confirm-payment',array('order_code'=> $results['meta']['code'][0]))->with('data', $results);

				}else{

					return view('pages.'.MOBILE_OR_WEB.'.confirm_orders_info')->with('data', $results);
				}
			}]);

			Route::post('update-shoping-cart', ['as' => 'update-shoping-cart', function(){

				$config 					= Config::get('spr.param.web.shopping_cart.update_quantity');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\ShoppingCartController')->updateProductToShoppingCart($data_output_validate_param);
				if($results['meta']['success']){

					return Redirect::route('web-get-confirm-orders-information')->with('data', $results);

				}else{

					return view('pages.'.MOBILE_OR_WEB.'.payment')->with('data', $results);
				}
			}]);

			Route::post('update-shoping-cart-2', ['as' => 'update-shoping-cart-2', function(){

				$config 					= Config::get('spr.param.web.shopping_cart.update_quantity');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\ShoppingCartController')->updateProductToShoppingCart($data_output_validate_param);
				if($results['meta']['success']){

					return Redirect::route('web-get-my-shopping-cart')->with('data', $results);

				}else{

					return view('pages.'.MOBILE_OR_WEB.'.payment')->with('data', $results);
				}
			}]);

			Route::post('update-shoping-cart-3', ['as' => 'update-shoping-cart-3', function(){

				$config 					= Config::get('spr.param.web.shopping_cart.update_quantity_payment');
				$data_output_get_param 		= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
				$data_output_validate_param	= App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
				$results 					= App::make('App\Http\Controllers\ShoppingCartController')->updateProductToShoppingCartStepPayment($data_output_validate_param);
				if($results['meta']['success']){

					return Redirect::route('web-get-confirm-payment',array('order_code' => $results['response']));

				}else{

					return Redirect::route('web-get-homePage');
				}
			}]);

			Route::post('delete-shoping-cart', ['as' => 'delete-shoping-cart', function() {

                $config                    	= Config::get('spr.param.web.shopping_cart.delete_product');
                $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
                $results                   	= App::make('App\Http\Controllers\ShoppingCartController')->deleteProductToShoppingCart($data_output_validate_param);

                return json_encode($results);
            }]);

            Route::post('use-promotion-code', ['as' => 'use-promotion-code', function() {

                $config                    	= Config::get('spr.param.web.promotion.use-promotion-code');
                $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                $data_output_validate_param = App::make('App\Http\Validates\ValidatePromotion')->usePromtion($data_output_get_param);
                $results                   	= App::make('App\Http\Controllers\PromotionController')->addPromotionCodeToShoppingCart($data_output_validate_param);

                return json_encode($results);
            }]);

            Route::post('use-happy-code', ['as' => 'use-happy-code', function() {

                $config                    	= Config::get('spr.param.web.happy_code.use-happy-code');
                $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                $data_output_validate_param = App::make('App\Http\Validates\ValidateHappyCode')->useHappyCode($data_output_get_param);
                $results                   	= App::make('App\Http\Controllers\HappyCodeController')->addHappyCodeToShoppingCart($data_output_validate_param);

                return json_encode($results);
            }]);

            Route::post('confirm-completed', ['as' => 'confirm-completed', function() {

                $config                    	= Config::get('spr.param.web.payment.confirm_complete');
                $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
                $results                   	= App::make('App\Http\Controllers\TransactionController')->updateTransactionByCode($data_output_validate_param);

                if($results['meta']['success']){
                	if($results['response']['payment_method'] == 0){
						return redirect($results['response']['url']);
                	}else {

                		return view('pages.user.confirm_complete')->with('data', $results['response']);
                	}
                }else{
                	// dd($results);

                }
            }]);

            Route::post('update-transaction-step-payment', ['as' => 'update-transaction-step-payment', function() {

                $results   = App::make('App\Http\Controllers\TransactionController')->updateTransactionStepPayment();
                if($results['meta']['success']){

                }
            }]);

            Route::post('/delete-shoping-cart-2', ['as' => '/delete-shoping-cart-2', function() {

                $config                    	= Config::get('spr.param.web.shopping_cart.delete_product');
                $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
                $results                   	= App::make('App\Http\Controllers\ShoppingCartController')->deleteProductToShoppingCartStepPayment($data_output_validate_param);

                return json_encode($results);
            }]);

            Route::post('customer-feedback', ['as' => 'customer-feedback', function(){

            	$config                    	= Config::get('spr.param.web.customer.add_feedback');
                $data_output_get_param    	= App::make('Spr\Base\Controllers\Http\Request')->getDataRequest($config);
                $data_output_validate_param = App::make('Spr\Base\Validates\Helper')->baseValidate($data_output_get_param);
                $results                   	= App::make('App\Http\Controllers\CustomerFeedbackController')->insertFeedback($data_output_validate_param);

                if($results['meta']['success']){

					return Redirect::route('web-get-customer-feedback');
                }else {

                	return Redirect::back()->withInput(Input::all())->withErrors($results['meta']['msg']);
                }
			}]);


		});

	});

	Route::group(['as' => 'customer-'], function () {

		Route::group(['as' => 'get-'], function () {

		});

		Route::group(['as' => 'post-'], function () {

			Route::post('login' , ['as' => 'login', function () {

			    $results = App::make('App\Http\Controllers\CustomerController')->login();

				return json_encode($results);
			}]);

			Route::post('auth-login' , ['as' => 'auth-login', function () {

				$results 	= 	Response::response();

			    $checkLogin = App::make('App\Http\Controllers\CustomerController')->login();

			    if($checkLogin ==false){

					$results['meta']['success'] 	=	false;

			    }

			    return $results;
			}]);
		});

	});


	Route::group(['as' => 'setting-'], function () {

		Route::group(['as' => 'get-'], function () {

		});

		Route::group(['as' => 'post-'], function () {

			Route::post('change-locale' , ['as' => 'change-locale', function () {

				$results  = App::make('App\Http\Controllers\LocaleController')->setLocale();
				return Redirect::back();
			}]);
		});
	});

});



