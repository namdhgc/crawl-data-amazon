<?php
// Đây là file cung cấp data cho các file được include mà route ko thể tác động
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Http\Models\ProductCategories as ModelCategories;
use Auth;
use Cache;
use Config;
use Lang;
class DataCategories
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
    	// $ModelCategories = new ModelCategories();
    	// $data = $ModelCategories->getProductCategories();

     //    $view->with('data', $data['response']);
    }
};
?>