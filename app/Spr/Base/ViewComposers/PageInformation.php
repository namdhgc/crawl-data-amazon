<?php
// Đây là file cung cấp data cho các file được include mà route ko thể tác động
namespace Spr\Base\ViewComposers;

use Illuminate\Contracts\View\View;
// use Illuminate\Users\Repository as UserRepository;
use App\Http\Models\User as  ModelsUser;
// use App\Http\Models\Message as ModelMessage;
use Auth;
use Cache;
use Config;
use Lang;
use Spr\Base\Controllers\Helper as HelperController;

class PageInformation
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
    	$data = array(

	    	'hor-menu' => [
	    			[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.dashboard'),
			    		'slug'	=> 'dashboard',
			    		'url'	=> 'dashboard',
			    		'icon'	=> 'icon-home',
			    		'route' => 'auth-get-dashboard',
			    		'sub'	=> ''
			    	],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.manager-admin'),
			    		'slug'	=> 'manager-admin',
			    		'url'	=> 'manager-admin',
			    		'icon'	=> 'icon-users',
			    		'route' => 'auth-get-manager-admin',
			    		'sub'	=> ''
			    	],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.roles'),
			    		'slug'	=> 'manager-roles',
			    		'url'	=> 'roles',
			    		'icon'	=> 'icon-shield',
			    		'route' => 'auth-get-permission-roles',
			    		'sub'	=> ''
			    	],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.manager-slide'),
			    		'slug'	=> 'manager-slide',
			    		'url'	=> 'slide',
			    		'icon'	=> 'icon-picture',
			    		'route' => 'auth-get-slide',
			    		'sub'	=> ''
			    	],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.manager-banner'),
			    		'slug'	=> 'manager-banner',
			    		'url'	=> 'banner',
			    		'icon'	=> 'icon-picture',
			    		'route' => 'auth-get-banner',
			    		'sub'	=> ''
			    	],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.manager-navigation'),
			    		'slug'	=> 'manager-navigation',
			    		'url'	=> 'navigation',
			    		'icon'	=> 'icon-picture',
			    		'route' => 'auth-get-navigation',
			    		'sub'	=> ''
			    	],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.agency-management'),
			    		'slug'	=> 'manager-agency',
			    		'url'	=> 'agency-management',
			    		'icon'	=> 'icon-directions',
			    		'route' => 'auth-get-agency-management',
			    		'sub'	=> ''
			    	],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.product-categories'),
			    		'slug'	=> 'product-categories',
			    		'url'	=> 'product-categories',
			    		'icon'	=> 'icon-notebook',
			    		'route' => 'auth-get-product-categories',
			    		'sub'	=> ''
			    	],
			    	// [
	    			// 	'id'	=> '',
	    			// 	'use' 	=> false,
			    	// 	'name' 	=> Lang::get('menu.warehouse-management'),
			    	// 	'slug'	=> 'manager-warehouse',
			    	// 	'icon'	=> 'icon-direction',
			    	// 	'route' => 'auth-get-warehouse-management',
			    	// 	'sub'	=> ''
			    	// ],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.transaction-manage'),
			    		'slug'	=> 'manager-transaction',
			    		'url'	=> '',
			    		'icon'	=> 'icon-direction',
			    		'route' => '',
			    		'sub'	=> [

			    			[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.transaction'),
					    		'slug'	=> 'manager-transaction',
			    				'url'	=> 'transaction',
					    		'icon'	=> 'icon-handbag',
					    		'route' => 'auth-get-transaction',
					    		'sub'	=> ''
					    	],
					    	[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.transaction-status'),
					    		'slug'	=> 'manager-transaction',
			    				'url'	=> 'transaction-status',
					    		'icon'	=> 'icon-equalizer',
					    		'route' => 'auth-get-transaction-status',
					    		'sub'	=> ''
					    	]
			    		]
			    	],
			    	// [
	    			// 	'id'	=> '',
	    			// 	'use' 	=> false,
			    	// 	'name' 	=> Lang::get('menu.transaction-detail'),
			    	// 	'slug'	=> 'transaction_detail',
			    	// 	'icon'	=> 'icon-compass',
			    	// 	'route' => 'auth-get-transaction-detail',
			    	// 	'sub'	=> ''
			    	// ],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.price-manage'),
			    		'slug'	=> '',
			    		'icon'	=> 'icon-note',
			    		'route' => '',
			    		'sub'	=> [
			    			[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.price-list'),
					    		'slug'	=> 'manager-price',
			    				'url'	=> 'price-list',
					    		'icon'	=> 'icon-pie-chart',
					    		'route' => 'auth-get-price-list',
					    		'sub'	=> ''
					    	],
					    	[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.surcharge-price-list'),
					    		'slug'	=> 'manager-price',
			    				'url'	=> 'surcharge-price-list',
					    		'icon'	=> 'icon-vector',
					    		'route' => 'auth-get-surcharge-price-list',
					    		'sub'	=> ''
					    	]
			    		]
			    	],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.payment-manage'),
			    		'slug'	=> '',
			    		'icon'	=> 'icon-badge',
			    		'route' => '',
			    		'sub'	=> [
			    			[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.manager-payment-type'),
					    		'slug'	=> 'manager-payment-type',
			    				'url'	=> 'payment-type',
					    		'icon'	=> 'icon-badge',
					    		'route' => 'auth-get-payment-type',
					    		'sub'	=> ''
					    	],
					    	[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.manager-bank'),
					    		'slug'	=> 'manager-bank',
			    				'url'	=> 'bank',
					    		'icon'	=> 'icon-diamond',
					    		'route' => 'auth-get-bank',
					    		'sub'	=> ''
					    	],
			    		]
			    	],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.manage-promotion'),
			    		'slug'	=> '',
			    		'icon'	=> 'icon-pin',
			    		'route' => '',
			    		'sub'	=> [

			    			[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.happy-code'),
					    		'slug'	=> 'manager-happy-code',
			    				'url'	=> 'happy-code',
					    		'icon'	=> 'icon-pin',
					    		'route' => 'auth-get-happy-code',
					    		'sub'	=> ''
					    	],
					    	[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.manager-happy-code-order'),
					    		'slug'	=> 'manager-happy-code-order',
			    				'url'	=> 'manager-happy-code-order',
					    		'icon'	=> 'icon-pin',
					    		'route' => 'auth-get-manager-happy-code-order',
					    		'sub'	=> ''
					    	],
			    		]
			    	],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.news-manage'),
			    		'slug'	=> '',
			    		'icon'	=> 'icon-note',
			    		'route' => '',
			    		'sub'	=> [

			    			[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.news-categories'),
					    		'slug'	=> 'manager-categories',
			    				'url'	=> 'news-categories',
					    		'icon'	=> 'icon-note',
					    		'route' => 'auth-get-news-categories',
					    		'sub'	=> ''
					    	],
					    	[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.post-news'),
					    		'slug'	=> 'manager-news',
			    				'url'	=> 'post-news',
					    		'icon'	=> 'icon-pin',
					    		'route' => 'auth-get-post-news',
					    		'sub'	=> ''
					    	],
					    	[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.news-management'),
					    		'slug'	=> 'manager-news',
			    				'url'	=> 'news-management',
					    		'icon'	=> 'icon-puzzle',
					    		'route' => 'auth-get-news-management',
					    		'sub'	=> ''
					    	],
			    		]
			    	],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.customer-management'),
			    		'slug'	=> '',
			    		'icon'	=> 'icon-grid',
			    		'route' => '',
			    		'sub'	=> [

			    			[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.price-request-management'),
					    		'slug'	=> 'manager-price-request',
			    				'url'	=> 'price-request-management',
					    		'icon'	=> 'icon-shield',
					    		'route' => 'auth-get-price-request-management',
					    		'sub'	=> ''
					    	],
					    	[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.feedback-management'),
					    		'slug'	=> 'manager-feedback',
			    				'url'	=> 'feedback',
					    		'icon'	=> 'icon-shield',
					    		'route' => 'auth-get-feedback',
					    		'sub'	=> ''
					    	],
					    	[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.email-notification'),
					    		'slug'	=> 'manager-email-notification',
			    				'url'	=> 'email-notification',
					    		'icon'	=> 'icon-envelope-letter',
					    		'route' => 'auth-get-email-notification',
					    		'sub'	=> ''
					    	],
					    	[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.manager-group-customer'),
					    		'slug'	=> 'manager-group-customer',
			    				'url'	=> 'group-customer',
					    		'icon'	=> 'icon-grid',
					    		'route' => 'auth-get-group-customer',
					    		'sub'	=> ''
					    	],
					    	[
			    				'id'	=> '',
			    				'use' 	=> false,
					    		'name' 	=> Lang::get('menu.manager-frequently-asked-questions'),
					    		'slug'	=> 'manager-frequently-asked-questions',
			    				'url'	=> 'frequently-asked-questions',
					    		'icon'	=> 'icon-question',
					    		'route' => 'auth-get-frequently-asked-questions',
					    		'sub'	=> ''
					    	],
					    	[
			    				'id'	=> '',
			    				'use' 	=> true,
					    		'name' 	=> Lang::get('menu.manager-customer'),
					    		'slug'	=> 'manager-customer',
			    				'url'	=> 'manager-customer',
					    		'icon'	=> 'icon-user-following',
					    		'route' => 'auth-get-manager-customer',
					    		'sub'	=> ''
					    	]
			    		]

			    	],
			    	[
	    				'id'	=> '',
	    				'use' 	=> true,
			    		'name' 	=> Lang::get('menu.setting'),
			    		'slug'	=> 'setting',
			    		'icon'	=> 'icon-settings',
	    				'url'	=> 'setting',
			    		'route' => 'auth-get-setting',
			    		'sub'	=> ''
			    	],	
			    	[
	    				'id'	=> '',
	    				'use' 	=> false,
			    		'name' 	=> Lang::get('menu.report'),
			    		'slug'	=> 'manager-report',
			    		'url'	=> 'manager-customer',
			    		'icon'	=> 'icon-wallet',
			    		'route' => 'auth-get-report',
			    		'sub'	=> ''
			    	],
		    	],
			'top-menu' => [
			]

	    );


		$count = COUNT($data['hor-menu']);
        for ($i=0; $i < $count; $i++) {
        	$slug = $data['hor-menu'][$i]['slug'];

        	
        	$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, $slug, 'read');
			if($permission){
	                $data['hor-menu'][$i]['use'] = true;
	                if($data['hor-menu'][$i]['sub'] != ''){
	                	$count_sub = COUNT($data['hor-menu'][$i]['sub']);

	                	for ($j=0; $j < $count_sub; $j++) {
	                		$sub_slug = $data['hor-menu'][$i]['sub'][$j]['slug'];

	                		$permission = HelperController::checkPermission(Auth::guard('web')->user()->roles, $sub_slug, 'read');
							if($permission){
                				$data['hor-menu'][$i]['sub'][$j]['use'] = true;
                			}else {
                				$data['hor-menu'][$i]['sub'][$j]['use'] = false;
                			}
	                	}
	                }
	            }else {
	                $data['hor-menu'][$i]['use'] = false;
	            }
            
        }
		$actual_link = $_SERVER['REQUEST_URI'];
		$list_segment = explode('/', $actual_link);
		// $ModelsUser = new ModelsUser();
		// $dataUser = $ModelsUser->getDataById(Auth::user()->id);
        $view->with('data', array(
        	'data' => $data,
        	'actual_link' => $actual_link,
        	'list_segment' => $list_segment,
        	// 'user'	=> $dataUser['response'][0],
        ));
    }
};
?>